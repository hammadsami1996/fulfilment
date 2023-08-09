<template>
    <div class="p-4" v-if="show">
        <h1 class="text-lg font-bold mb-4">
            {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: `Add New ${capital}`}}
        </h1>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label class="block font-medium text-sm text-gray-700 mb-2"
                >SKU <span class="text-gray-700">(Autogenerate)</span></label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder=" Sku-123"
                    v-model="form.sku"
                />
                <p class="text-red-600 text-xs italic" v-if="error.sku">{{ error.sku[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Product Name <span class="text-red-600">(Required)</span></label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Product Name"
                    v-model="form.name"
                />
                <p class="text-red-600 text-xs italic" v-if="error.name">{{ error.name[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Product Category <span class="text-red-600">(Required)</span></label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                />
                <!--                    <p class="text-red-600 text-xs italic" v-if="error.price">{{ error.price[0] }}</p>-->
            </div>
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Description</label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                />
                <!--                    <p class="text-red-600 text-xs italic" v-if="error.price">{{ error.price[0] }}</p>-->
            </div>
        </div>
        <div class="form-group col-sm-8 mt-4">
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                    <tr class="text-center border bg-gray-200">
                        <th class="px-2 py-1">Basic Info</th>
                        <th class="px-2 py-1">Prices<span class="text-red-500">*</span></th>
                        <th class="px-2 py-1">More Info</th>
                        <th class="px-2 py-1">Picture</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="border-b border-gray-100 dark:border-gray-700/50">
                        <td class="border px-2 py-1">
                            <div>
                                <label class="font-medium">SKU</label>
                                <input
                                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    type="text">
                            </div>
                            <!--                            <hr class="my-2">-->
                            <div>
                                <label class="font-medium">Barcode</label>
                                <input
                                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    type="text">
                            </div>
                            <!--                            <hr class="my-2">-->
                            <div>
                                <label class="font-medium">Product Name</label>
                                <input
                                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    type="text">
                            </div>
                        </td>
                        <td class="border px-4 py-2">
                            <label class="font-medium">Cost Price<span class="text-red-500">*</span></label>
                            <input
                                class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                type="number">
                            <hr>
                            <label class="font-medium">Selling Price<span class="text-red-500">*</span></label>
                            <input
                                class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                type="number">
                            <hr>
                            <label class="font-medium">Maximum Retail Price (MRP)</label>
                            <input
                                class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                type="number">
                        </td>
                        <td class="border px-4 py-2">
                            <label class="font-medium">Re-order Threshold</label>
                            <input
                                class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                type="number">
                            <hr>
                            <label class="font-medium">Weight (kg)</label>
                            <input
                                class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                type="number">
                            <hr>
                            <label class="font-medium">Quantity Sync</label>
                            <!--                            <input class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"-->
                            <!--                                   type="number" >-->
                        </td>

                        <td class="border px-4 py-2">
                            <div class="form-group">
                                <a class="clearImageTimes" id="clearImage_" onclick="clearImage('')"
                                   style="display: none; "><i class="fas fa-times"></i></a>
                                <img alt="your image" class="h-24 w-24 object-cover rounded"
                                     id="picture_preview_" onclick="clickImageInput()"
                                     onerror="imgError(this);" src="/images/products/no-image.png">
                                <input accept=".png, .jpg, .jpeg" class="block w-full mt-1 form-input" id="picture_"
                                       name="picture[]" onchange="readURL(this,);"
                                       style="margin-top: 5px; display:none;"
                                       type="file">
                                <input class="form-control" id="img_name" name="img_name[]" type="hidden">

                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
<!--        <hr class="mt-6">-->
        <h1 class="font-bold mt-4">Product Type</h1>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label class="block font-medium text-sm text-gray-700 mb-2">
                    Select Product Variants
                </label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input
                            type="checkbox"
                            class="form-checkbox h-5 w-5 text-indigo-600"
                            v-model="selectedVariants.sku1"
                        />
                        <span class="ml-2">Variant 1</span>
                    </label>
                    <label class="flex items-center">
                        <input
                            type="checkbox"
                            class="form-checkbox h-5 w-5 text-indigo-600"
                            v-model="selectedVariants.sku2"
                        />
                        <span class="ml-2">Variant 2</span>
                    </label>
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

</template>

<script>
    import {byMethod, get} from '@/libs/api'
    import {form} from '@/libs/mixins'

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
            // Typeahead,
        },
        data() {
            return {
                error: {},
                show: false,
                resource: '/product',
                store: '/api/product',
                method: 'POST',
                small: 'product',
                capital: 'Product',
                title: 'Add',
                message: 'New product Added',
                permissions: {},

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
            setData(res) {
                // console.log(res);
                this.form = res.data.form;
                if (this.$route.meta.mode === 'edit') {
                    this.store = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
                    this.title = 'Edit';
                    this.message = `${this.capital} has been updated`;
                }
                this.show = true
            },

            formSubmitted() {
                this.form.selectedPermissions = this.selectedPermissions
                byMethod(this.method, this.store, this.form).then(res => {
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
