<template>
    <div v-if="show">
        <div class="p-6">
            <h1 class="text-lg font-bold mb-4">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: ` New ${capital}`}}
            </h1>
            <div class="flex mx-1">
                <div class="w-8/12 mx-2">
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <h3 class="text-lg font-bold mb-2 text-indigo-600">Add Product</h3>
                        <div class="col-span-12">
                            <div class="mb-2">
                                <label class="block text-xs font-medium text-gray-700">Title</label>
                                <input
                                    class="w-full py-1 px-2 text-xs bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    required type="text" v-model="form.title"
                                />
                                <p class="text-red-600 text-xs italic" v-if="error.title">{{ error.title[0] }}</p>
                            </div>
                        </div>
                    </div>
                    <!--            Image Gallery-->
                    <div class="bg-white shadow rounded-lg mt-4 p-4">
                        <h3 class="text-xl font-semibold mb-2 text-indigo-600">Image Gallery</h3>
                        <div
                            class="mt-4 border border-gray-200 rounded overflow-x-auto min-w-full bg-white dark:bg-gray-800 dark:border-gray-700">
                            <table class="min-w-full text-sm align-middle whitespace-nowrap">
                                <thead>
                                <tr class="border-b border-gray-100 dark:border-gray-700/50 ">
                                    <th class="w-full px-1 py-2 text-gray-900 bg-gray-100/75 font-semibold text-center dark:text-gray-50 dark:bg-gray-700/25"
                                        colspan="2">
                                        <div class="flex items-center justify-center space-x-2">
                                            <label class="text-xl">Image:</label>
                                        </div>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr class="border-b border-gray-100 dark:border-gray-700/50"
                                    v-for="(item,index) in form.product_img">
                                    <td>
                                        <div class="flex items-center">
                                            <input
                                                class="flex-grow border border-gray-200 rounded w-20 mr-2"
                                                name="profile_picture"
                                                type="file"
                                                v-on:change="onImageChange($event,index)"
                                            >
                                            <img :src="ImgUrl[index].img" class="w-20 h-20 rounded object-cover"
                                                 v-if="ImgUrl[index] && ImgUrl[index].img">
                                            <div class="w-20 h-20 rounded object-cover" v-else-if="item.img">
                                                <img :src="`/uploads/product/img/` + item.img">
                                            </div>
                                        </div>
                                    </td>
                                    <td class=" text-center">
                                        <button @click="removeImg(item,index)"
                                                class="inline-flex items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:opacity-90 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:opacity-75"
                                                type="button">
                                            <i class="fa fa-trash mr-1"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="item-empty" colspan="2">
                                        <button @click="addNewLine"
                                                class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded inline-flex items-center space-x-2">
                                            <i class="fa fa-plus-circle"></i>
                                            <span>Add Image</span>
                                        </button>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!--            Variantions-->
                    <div class="bg-white shadow rounded-lg mt-2 p-4">
                        <h3 class="text-xl font-semibold mb-2 text-indigo-600">Variants</h3>
                        <div class="relative">
                            <select
                                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:border-blue-300"
                                v-model="form.product_types">
                                <option value="0">Simple</option>
                                <option value="1">Variation</option>
                            </select>
                            <p class="text-red-600 text-xs italic" v-if="error.product_types">{{ error.product_types[0]
                                }}</p>
                        </div>
                        <div class="relative mt-4" v-if="form.product_types == 1">
                            <div class="bg-white shadow rounded-lg mt-4 p-4">
                                <div
                                    class="mt-4 border border-gray-200 rounded overflow-x-auto min-w-full bg-white dark:bg-gray-800 dark:border-gray-700">
                                    <table class="min-w-full text-sm align-middle whitespace-nowrap">
                                        <thead>
                                        <tr>
                                            <th class="px-4 py-2">Group</th>
                                            <th class="px-4 py-2">Value</th>
                                            <th class="px-4 py-2"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="border-b border-gray-100 dark:border-gray-700/50"
                                            v-for="(item, index) in form.product_attribute">
                                            <td>
                                                <div class="mb-4">
                                                    <typeahead :initialize="item.group" @input="onGroup($event, item)"
                                                               display="title" url="/api/product_attribute_group"/>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-4">
                                                    <typeahead :initialize="item.values"
                                                               :url="item.group_id != null ? '/api/product_attribute_value?group_id='+item.group_id :'/api/product_attribute_value'"
                                                               @input="onValue($event,item)" display="title"
                                                               multi-select="true"/>
                                                </div>
                                            </td>
                                            <td class=" text-center">
                                                <button @click="removeProductAttribute(item, index)"
                                                        class="inline-flex items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:opacity-90 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:opacity-75"
                                                        type="button">
                                                    <i class="fa fa-trash mr-1"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td class="item-empty" colspan="2">
                                                <button @click="addNewProductAttribute"
                                                        class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded inline-flex items-center space-x-2">
                                                    <i class="fa fa-plus-circle"></i>
                                                    <span>Add Variants</span>
                                                </button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="bg-white shadow rounded-lg mt-4 p-4" v-if="$route.meta.mode && form.sub_products.length">
                                <div
                                    class="mt-4 border border-gray-200 rounded overflow-x-auto min-w-full bg-white dark:bg-gray-800 dark:border-gray-700">
                                    <table class="min-w-full text-sm align-middle ">
                                        <thead>
                                        <tr>
                                            <th class="px-4 py-2"
                                                v-for="sub_prod in form.sub_products[0].sub_attributes">
                                                {{sub_prod.group.title}}
                                            </th>
                                            <th class="px-4 py-2">Value</th>
                                            <th class="px-4 py-2"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="border-b border-gray-100 dark:border-gray-700/50"
                                            v-for="(item, index) in form.sub_products">
                                            <td v-for="sub_attr in item.sub_attributes">
                                                <div class="mb-4">
                                                    <h5>{{sub_attr.value.title}}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                                                    <label
                                                        class="block font-medium text-sm text-gray-700 mb-2">Quantity</label>
                                                    <input
                                                        class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                        type="text" v-model="item.quantity"/>
                                                </div>
                                                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                                                    <label class="block font-medium text-sm text-gray-700 mb-2">Product
                                                        SKU</label>
                                                    <input
                                                        class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                        type="text" v-model="item.sku"/>
                                                </div>
                                                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                                                    <label
                                                        class="block font-medium text-sm text-gray-700 mb-2">Barcode</label>
                                                    <input
                                                        class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                        type="text" v-model="item.barcode"/>
                                                </div>

                                            </td>
                                            <td class=" text-center">
                                                <button @click="saveProductAttribute(item, index)"
                                                        class="inline-flex items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:opacity-90 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:opacity-75"
                                                        type="button">
                                                    <i class="fa fa-save mr-1"></i>
                                                </button>
                                                <button @click="removeProductAttribute(item, index)"
                                                        class="inline-flex items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:opacity-90 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:opacity-75"
                                                        type="button">
                                                    <i class="fa fa-trash mr-1"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-4/12  mx-4">
                    <div class="col-span-12">
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <h3 class="text-xl font-bold mb-4 text-indigo-600">Price & Stock</h3>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Cost Price</label>
                                <input
                                    @input="form.cost_price = form.cost_price.replace(/[^0-9]/g, '')"
                                    class="w-full py-1 px-2 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    type="text"
                                    v-model="form.cost_price">
                                <p class="text-red-600 text-xs italic" v-if="error.cost_price">{{ error.cost_price[0]
                                    }}</p>

                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Selling Price</label>
                                <input
                                    @input="form.selling_price = form.selling_price.replace(/[^0-9]/g, '')"
                                    class="w-full py-1 px-2 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    type="text"
                                    v-model="form.selling_price">
                                <p class="text-red-600 text-xs italic" v-if="error.selling_price">{{
                                    error.selling_price[0]
                                    }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="card-block mt-4 p-4 rounded-lg shadow-lg bg-white">
                            <h3 class="mb-4 text-xl font-semibold text-indigo-600">Product Supplier</h3>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Suppliers</label>
                                <typeahead
                                    :initialize="form.supplier"
                                    :url="supplier"
                                    @input="onSupplier"
                                    class="w-full py-1 px-1 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    display="text"
                                />
                                <p class="text-red-600 text-xs italic" v-if="error.supplier_id">{{ error.supplier_id[0]
                                    }}</p>

                            </div>

                        </div>
                    </div>
                    <!--            Product Organization-->
                    <div class="w-full">
                        <div class="card-block mt-4 p-4 rounded-lg shadow-lg bg-white">
                            <h3 class="mb-4 text-xl font-semibold text-indigo-600">Product Organization</h3>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Category</label>
                                <typeahead
                                    :initialize="form.category"
                                    :url="category"
                                    @input="onCategory"
                                    class="w-full py-1 px-1 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    display="text"
                                />
                                <p class="text-red-600 text-xs italic" v-if="error.category_id">{{ error.category_id[0]
                                    }}</p>

                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Brand</label>
                                <div class="relative">
                                    <typeahead
                                        :initialize="form.brand"
                                        :url="brands"
                                        @input="onBrand"
                                        class="w-full py-1 px-1 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                        display="title"
                                    />
                                    <p class="text-red-600 text-xs italic" v-if="error.brand_id">{{ error.brand_id[0]
                                        }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--          Inventory  -->
                    <div class="w-full">
                        <div class="card-block mt-4 p-4 rounded-lg shadow-lg bg-white">
                            <h3 class="text-2xl font-bold text-indigo-600 mb-4">Inventory</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4 px-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Product Sku</label>
                                    <input
                                        class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                        type="text" v-model="form.sku"
                                    />
                                    <p class="text-red-600 text-xs italic" v-if="error.sku">{{ error.sku[0] }}</p>

                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Barcode</label>
                                    <input
                                        @input="form.barcode = form.barcode.replace(/[^0-9]/g, '')"
                                        class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                        placeholder="Barcode" type="text"
                                        v-model="form.barcode"
                                    />
                                    <p class="text-red-600 text-xs italic" v-if="error.barcode">{{ error.barcode[0]
                                        }}</p>

                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Product Quantity</label>
                                    <input
                                        @input="form.quantity = form.quantity.replace(/[^0-9]/g, '')"
                                        class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                        placeholder="Quantity" type="text"
                                        v-model="form.quantity"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Weight</label>
                                    <input
                                        @input="form.weight = form.weight.replace(/[^0-9]/g, '')"
                                        class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                        type="text"
                                        v-model="form.weight"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8 space-x-4">
                <button
                    @click="formSubmitted"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                    type="button">
                    {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Add" }}
                </button>
                <button
                    @click="successfull()"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white"
                    type="button">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import {byMethod, get} from '@/libs/api'
    import {form} from '@/libs/mixins'
    import Typeahead from "@/Components/typeahead/typeahead.vue";
    import {objectToFormData} from "@/libs/helpers";

    function initialize(to) {
        let urls = {
            add: `/api/product/create`,
            edit: `/api/product/${to.params.id}/edit`,
        }
        return urls[to.meta.mode] || urls.add
    }

    export default {
        mixins: [form],
        components: {
            Typeahead
        },
        data() {
            return {
                error: {},
                ImgUrl: [],
                show: false,
                resource: '/product',
                store: '/api/product',
                method: 'POST',
                small: 'product',
                capital: 'Product Category',
                title: 'Add',
                message: 'New Product Added',
                permissions: {},
                parentUrl: '/api/product',
                supplier: '/api/supplier',
                category: '/api/product_category',
                brands: '/api/brand',
            }
        },

        beforeRouteEnter(to, from, next) {
            get(initialize(to))
                .then((res) => {
                    next(vm => vm.setData(res))
                })
        },
        beforeRouteUpdate(to, from, next) {
            get(initialize(to))
                .then((res) => {
                    this.setData(res);
                    next()
                })
        },
        methods: {
            onImageChange(e, index) {
                this.ImgUrl[index].img = URL.createObjectURL(e.target.files[0]);
                this.form.product_img[index].img = e.target.files[0];
            },
            removeImg(item, index) {
                if (this.form.product_img.length > 1) {
                    this.form.product_img.splice(index, 1);
                    this.ImgUrl.splice(index, 1);
                }
            },
            addNewLine() {
                if (!this.form.product_img) {
                    this.form.product_img = [];
                }
                this.form.product_img.push({
                    image: null,
                    image_id: null,
                });
                this.ImgUrl.push({
                    img: null,
                });
            },
            onGroup(e, i) {
                const group = e.target.value
                i.group = group
                i.group_id = group.id
            },
            onValue(e, i) {
                const value = e.target.value
                i.values = value
            },
            removeProductAttribute(item, index) {
                byMethod('DELETE', '/api/product/' + item.id).then(res => {
                    // this.successfull(res)
                    this.$toast.open({
                        position: 'top-right',
                        message: 'Delete Successfully',
                        type: 'success',
                        duration: 3000
                    });
                })
            },
            saveProductAttribute(item, index) {
                byMethod(this.method, '/api/product_single', [item]).then(res => {
                    // this.successfull(res)
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                        type: 'success',
                        duration: 3000
                    });
                })
            },
            addNewProductAttribute() {
                if (Array.isArray(this.form.product_attribute)) {
                    this.form.product_attribute = this.form.product_attribute ? this.form.product_attribute : [];
                }
                this.form.product_attribute.push({
                    group: [],
                    values: [],
                });
            },
            onCategory(e) {
                const category = e.target.value
                this.form.category = category
                this.form.category_id = category.id
            },
            onSupplier(e) {
                const supplier = e.target.value
                this.form.supplier = supplier
                this.form.supplier_id = supplier.id
            },
            onBrand(e) {
                const brand = e.target.value
                this.form.brand = brand
                this.form.brand_id = brand.id
            },
            setData(res) {
                this.form = res.data.form;
                if (this.$route.meta.mode == 'edit') {
                    this.store = `/api/${this.small}/${this.form.id}?_method=PUT`;
                    this.title = 'Edit';
                    this.message = `${this.capital} has been updated`;
                } else {
                    this.form.category = {};
                }
                this.show = true
            },

            formSubmitted() {
                this.form.sub_products = []
                byMethod(this.method, this.store, objectToFormData(this.form)).then(res => {
                    this.successfull(res)
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                        type: 'success',
                        duration: 3000
                    });
                }).catch(err => {
                    this.error = err.response.data.errors;
                    this.$toast.open({
                        position: 'top-right',
                        message: 'Error',
                        type: 'error',
                        duration: 3000
                    });
                    // console.log(err);
                })
            },
            successfull(res) {
                this.$router.push({path: `${this.resource}`})
            }
        },
    }
</script>

<style scoped>

</style>
