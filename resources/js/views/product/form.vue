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
                                    class="w-full py-1 px-2 text-xs bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-100"
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
                                class="block w-full px-4 py-2 pr-8 leading-tight bg-gray-100 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-100 text-gray-800 text-sm"
                                v-model="form.product_types"
                            >
                                <option value="0">Simple</option>
                                <option value="1">Variation</option>
                            </select>
                            <p class="text-red-600 text-xs italic" v-if="error.product_types">{{ error.product_types[0]}}</p>
                        </div>

                        <div class="relative mt-4" v-if="form.product_types == 1">
                            <div class="bg-white shadow rounded-lg mt-2 ">
                                <div class="mt-4 border border-gray-200 rounded  min-w-full bg-white dark:bg-gray-800 dark:border-gray-700">
                                    <table class="min-w-full text-sm align-middle whitespace-nowrap">
                                        <thead>
                                        <tr class="bg-gray-200 dark:bg-gray-600">
                                            <th class="px-4 py-2">Attribute Group</th>
                                            <th class="px-4 py-2">Attribute Values</th>
                                            <th class="px-4 py-2">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="border-b-2 border-gray-300 " v-for="(item, index) in form.product_attribute">
                                            <td>
                                                <div class="mb-2 py-3 px-2 custom-typeahead">
                                                    <typeahead :initialize="item.group" @input="onGroup($event, item)" display="title" url="/api/product_attribute_group" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-2 2 py-3 px-2 custom-typeahead">
                                                    <typeahead :initialize="item.values" :url="item.group_id != null ? '/api/product_attribute_value?group_id='+item.group_id :'/api/product_attribute_value'" @input="onValue($event,item)" display="title" multi-select="true" />
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <button @click="removeProductAttribute(item, index)" class="inline-flex items-center space-x-1 border font-semibold rounded-md px-2 py-1 leading-4 text-xs text-white bg-gradient-to-r from-red-500 to-red-600 hover:bg-red-700 focus:ring focus:ring-red-200 focus:ring-opacity-50 active:opacity-75" type="button">
                                                    <i class="fa fa-trash text-sm mr-1"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td class="item-empty " colspan="2">
                                                <button
                                                    @click="addNewProductAttribute"
                                                    class="inline-flex items-center space-x-2 rounded-md bg-yellow-500 hover:bg-yellow-500 text-white font-semibold px-3 py-2 transition duration-200 ease-in-out mt-1">
                                                    <i class="fa fa-plus-circle text-sm"></i>
                                                    <span class="text-md">Add New Attribute</span>
                                                </button>
                                            </td>
                                        </tr>
                                        </tfoot>

                                    </table>

                                </div>
                            </div>

                            <div class="bg-white shadow rounded-lg mt-4 "
                                 v-if="$route.meta.mode && form.sub_products.length">
                                <div class="mt-3 pb-4 sm:mt-0 sm:ml-4 flex justify-end">
                                    <button
                                        @click="saveProductAttribute(selectedItems)"
                                        class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-md px-4 py-2 text-xs border-gray-300 bg-blue-500 text-white hover:bg-blue-600 transition duration-200 ease-in-out"
                                        type="button"
                                    >
                                        Bulk Update
                                    </button>
                                </div>
                                <div class=" bg-white dark:bg-gray-800 rounded-lg overflow-x-auto">
                                    <table class="min-w-full text-sm">
                                        <thead>
                                        <tr class="bg-gray-200 dark:bg-gray-600">
                                            <th class="px-4 py-2"></th>
                                            <th class="px-4 py-2"
                                                v-for="sub_prod in form.sub_products[0].sub_attributes">
                                                <div class="flex items-center">
                                                    <span class="font-semibold">{{ sub_prod.group.title }}</span>
                                                </div>
                                            </th>
                                            <th class="px-4 py-2">
                                                <div class="text-center">
                                                    <span class="font-semibold">Value</span>
                                                </div>
                                            </th>
                                            <th class="px-4 py-2">
                                                <div class="text-center">
                                                    <span class="font-semibold">Image</span>
                                                </div>
                                            </th>
                                            <th class="px-4 py-2">
                                                <div class="text-center">
                                                    <span class="font-semibold">Action</span>
                                                </div>
                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <tr class="border-b-2 border-gray-400 dark:border-gray-700/50 "
                                            v-for="(item, index) in form.sub_products">
                                            <td class="text-center">
                                                <input :value="item" class="form-checkbox h-5 w-5 text-blue-500" type="checkbox"
                                                       v-model="selectedItems"/>
                                            </td>
                                            <td v-for="sub_attr in item.sub_attributes">
                                                <div class="mb-1">
                                                    <h5 class="text-sm font-semibold">{{sub_attr.value.title }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="w-full sm:w-1/2 p-1">
                                                    <label class="block font-semibold text-sm  mb-1">Quantity</label>
                                                    <input
                                                        class="w-20 py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 text-sm"
                                                         type="text"
                                                        v-model="item.quantity">
                                                </div>
                                                <div class="w-full sm:w-1/2 p-1">
                                                    <label class="block font-semibold text-sm mb-1"> SKU</label>
                                                    <input
                                                        class="w-20 py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 text-sm"
                                                         type="text" v-model="item.sku">
                                                </div>
                                                <div class="w-full sm:w-1/2 p-1">
                                                    <label class="block font-semibold text-sm mb-1">Barcode</label>
                                                    <input
                                                        class="w-20 py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 text-sm"
                                                         type="text" v-model="item.barcode">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-1 w-full">
                                                    <input class="flex-grow border border-gray-300 rounded w-50 mr-2 focus:ring-indigo-100"
                                                           type="file" v-on:change="onChildImageChange($event, item)"/>
                                                    <img :src="ImgUrl[item].img" class="w-20 h-20 rounded object-cover"
                                                         v-if="ImgUrl[item] && ImgUrl[item].img"/>
                                                    <div class="w-10 h-10 rounded object-cover"
                                                         v-else-if="item.product_img">
                                                        <img :src="`/uploads/product/img/` + item.img"/>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-center space-x-2">
                                                <button @click="saveProductAttribute([item])"
                                                        class="inline-flex items-center space-x-2 bg-blue-500 to-indigo-600 px-2 py-1 rounded text-xs text-white hover:bg-indigo-700 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:opacity-75"
                                                        type="button">
                                                    <i class="fa fa-save mr-1 text-sm"></i>
                                                </button>
                                                <button @click="removeProductAttribute(item, index)"
                                                        class="inline-flex items-center space-x-2 bg-red-500 to-red-600 px-2 py-1 rounded text-xs text-white hover:bg-red-700 focus:ring focus:ring-red-200 focus:ring-opacity-50 active:opacity-75 mt-2"
                                                        type="button">
                                                    <i class="fa fa-trash mr-1 text-sm"></i>
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
                                    class="w-full py-1 px-2 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-100"
                                    type="text"
                                    v-model="form.cost_price">
                                <p class="text-red-600 text-xs italic" v-if="error.cost_price">{{ error.cost_price[0]
                                    }}</p>

                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Selling Price</label>
                                <input
                                    @input="form.selling_price = form.selling_price.replace(/[^0-9]/g, '')"
                                    class="w-full py-1 px-2 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-100"
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
                                <!-- <label class="block text-sm font-medium text-gray-700">Suppliers</label> -->
                                <div class="block font-medium text-sm text-gray-700" >
                                <label>Supplier</label>
                                <span @click="supplierbtn" class="ml-2 items-right space-x-2 font-semibold text-sm text-blue-400 hover:text-blue-600 cursor-pointer transition duration-200 ease-in-out" style="float: right;">
                                    New
                                </span>
                            </div>
                                <typeahead
                                    :initialize="form.supplier"
                                    :url="supplier"
                                    @input="onSupplier"
                                    class="w-full py-1 px-1 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-100"
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
                                <div class="block font-medium text-sm text-gray-700" >
                                <label>Category</label>
                                <span @click="ProductCategorybtn" class="ml-2 items-right space-x-2 font-semibold text-sm text-blue-400 hover:text-blue-600 cursor-pointer transition duration-200 ease-in-out" style="float: right;">
                                    New
                                </span>
                            </div>
                                <typeahead
                                    :initialize="form.category"
                                    :url="category"
                                    @input="onCategory"
                                    class="w-full py-1 px-1 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-100"
                                    display="text"
                                />
                                <p class="text-red-600 text-xs italic" v-if="error.category_id">{{ error.category_id[0]
                                    }}</p>

                            </div>
                            <div class="mb-4">
                                <div class="block font-medium text-sm text-gray-700" >
                                <label>Brand</label>
                                <span @click="Brandbtn" class="ml-2 items-right space-x-2 font-semibold text-sm text-blue-400 hover:text-blue-600 cursor-pointer transition duration-200 ease-in-out" style="float: right;">
                                    New
                                </span>
                            </div>
                                <div class="relative">
                                    <typeahead
                                        :initialize="form.brand"
                                        :url="brands"
                                        @input="onBrand"
                                        class="w-full py-1 px-1 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-100"
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
                                        class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-100"
                                        type="text" v-model="form.sku"
                                    />
                                    <p class="text-red-600 text-xs italic" v-if="error.sku">{{ error.sku[0] }}</p>

                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Barcode</label>
                                    <input
                                        @input="form.barcode = form.barcode.replace(/[^0-9]/g, '')"
                                        class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-100"
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
                                        class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-100"
                                        placeholder="Quantity" type="text"
                                        v-model="form.quantity"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Weight</label>
                                    <input
                                        @input="form.weight = form.weight.replace(/[^0-9]/g, '')"
                                        class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-100"
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
                <!-- <button
                    @click="formSubmitted"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                    type="button">
                    {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Add" }}
                </button> -->
                <button :disabled="isSubmitting" @click="formSubmitted"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white hover:bg-blue-600  transition duration-200 ease-in-out"
            >
                <svg aria-hidden="true" class="inline w-4 h-4 mr-3 text-white animate-spin" fill="none"
                     role="status" v-if="isSubmitting" viewBox="0 0 100 101"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="#E5E7EB"/>
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentColor"/>
                </svg>
                {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Add" }}

            </button>
                <button
                    @click="successfull()"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white"
                    type="button">
                    Cancel
                </button>
                <Modal :show="showsupplier" closeable="true" @cancel="handleCancelSupplier" >
                    <Supplier @resp="()=>{showsupplier = !true}" :show="true" additionalProp="global" @save-supplier="handleCancelSupplier"  @cancel-supplier="handleCancelSupplier" ></Supplier>
                </Modal>
                <Modal :show="showProductCategory" closeable="true" @cancel="handleCancelProductCategory" >
                    <ProductCategory @resp="()=>{showProductCategory = !true}" :show="true" additionalProp="global" @save-Productcategory="handleCancelProductCategory"  @cancel-Productcategory="handleCancelProductCategory" ></ProductCategory>
                </Modal>
                <Modal :show="showbrand" closeable="true" @cancel="handleCancelBrand" >
                    <Brand @resp="()=>{showbrand = !true}" :show="true" additionalProp="global" @save-brand="handleCancelBrand"  @cancel-brand="handleCancelBrand" ></Brand>
                </Modal>
            </div>
        </div>
    </div>
</template>

<script>
    import {byMethod, get} from '@/libs/api'
    import Modal from "@/Components/Modal.vue";
    import {form} from '@/libs/mixins'
    import Typeahead from "@/Components/typeahead/typeahead.vue";
    import Supplier from "../supplier/form.vue";
    import ProductCategory from "../product_category/form.vue";
    import Brand from "../brand/form.vue";
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
            Typeahead, Modal,Supplier,ProductCategory,Brand
        },
        data() {
            return {
                selectedItems: [],
                error: {},
                ImgUrl: [],
                show: false,
                showsupplier: false,
                showProductCategory: false,
                showbrand: false,
                isSubmitting: false,
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
            onChildImageChange(e, item) {
                // this.ImgUrl[item].img = URL.createObjectURL(e.target.files[0]);
                item.product_img = e.target.files[0]

            },
            removeImg(item, index) {
                byMethod('DELETE', '/api/destroy_product_image/' + item.id)
                    .then(res => {
                        // Image deleted from the database, now update local data
                        if (this.form.product_img.length > 1) {
                            this.form.product_img.splice(index, 1);
                            this.ImgUrl.splice(index, 1);
                        }
                        this.$toast.open({
                            position: 'top-right',
                            message: 'Delete Image Successfully',
                            type: 'success',
                            duration: 3000
                        });
                    })
                    .catch(error => {
                        console.error('Error deleting image:', error);
                        this.$toast.open({
                            position: 'top-right',
                            message: 'Failed to delete image',
                            type: 'error',
                            duration: 3000
                        });
                    });

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
            saveProductAttribute(item) {
                byMethod(this.method, '/api/product_single', objectToFormData(item)).then(res => {
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
            ProductCategorybtn(){
               this.showProductCategory = true;
            },
            handleCancelProductCategory() {
               this.showProductCategory = false;
            },
            onSupplier(e) {
                const supplier = e.target.value
                this.form.supplier = supplier
                this.form.supplier_id = supplier.id
            },
            supplierbtn(){
                this.showsupplier = true;
            },
            handleCancelSupplier() {
                this.showsupplier = false;
             },

            onBrand(e) {
                const brand = e.target.value
                this.form.brand = brand
                this.form.brand_id = brand.id
            },
            Brandbtn(){
                this.showbrand = true;
            },
            handleCancelBrand() {
                this.showbrand = false;
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
                this.isSubmitting = true; // Disable the button and show the spinner
                this.form.sub_products = []
                // this.form.selectedPermissions = this.selectedPermissions
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

                })
                .finally(() => {
                this.isSubmitting = false; // Enable the button and hide the spinner
                });
            },
            successfull(res) {
                this.$router.push({path: `${this.resource}`})
            }
        },
    }
</script>

<style scoped>

</style>
