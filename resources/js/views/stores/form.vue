<template>
    <div v-if="show">
        <div class="p-6">

            <h1 class="text-lg font-bold mb-4">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: `Add New ${capital}`}}
            </h1>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Name <span class="text-red-600">*</span></label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        placeholder=" Name"
                        v-model="form.name"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.name">{{ error.name[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Location <span class="text-red-600">*</span></label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        placeholder=" location"
                        v-model="form.location"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.location">{{ error.location[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Company <span class="text-red-600">*</span></label>
                    <typeahead :initialize="form.company" :url="companys" @input="onCompany" display="name"/>
                    <p class="text-red-600 text-xs italic" v-if="error.company_id">{{ error.company_id[0] }}</p>
                </div>

                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Warehouse</label>
                    <typeahead :initialize="form.warehouse" :url="warehouse" @input="onWarehouse" display="name"/>
                    <p class="text-red-600 text-xs italic" v-if="error.warehouse_id">{{ error.warehouse_id[0] }}</p>
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center mt-2">
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Store Type  <span class="text-red-600">*</span></label>
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:border-blue-300"
                            v-model="form.store_type">
                            <option value="Physical">Physical</option>
                            <option value="Online">Online</option>
                        </select>
                    </div>
                    <p class="text-red-600 text-xs italic" v-if="error.store_type">{{ error.store_type[0] }}</p>
                </div>

                <div class="w-full sm:w-1/2 pl-3 sm:mb-0" v-if="form.store_type == 'Online'">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Plate Form</label>
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:border-blue-300"
                            v-model="form.plate_form" @click="storeBtn">
                            <option value="WooCommerce">WooCommerce</option>
                            <option value="Shopify">Shopify</option>
                            <option value="MimCart">MimCart</option>
                        </select>
                    </div>
                    <p class="text-red-600 text-xs italic" v-if="error.plate_form">{{ error.plate_form[0] }}</p>
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center mt-4" v-if="form.store_type  == 'Online'">
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0"
                     v-if="form.plate_form == 'Shopify'">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Store Address</label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        placeholder="https://example.com"
                        type="url"
                        v-model="form.store_address"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.access_token">{{ error.access_token[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0"
                     v-if="form.plate_form == 'Shopify'">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Access Token</label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        v-model="form.access_token"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.access_token">{{ error.access_token[0] }}</p>
                </div>

                <div class="w-full sm:w-1/2 pl-3 sm:mb-0"
                     v-if="form.plate_form == 'WooCommerce'">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Store Address</label>
                    <input
                        class="w-full py-2 px-3 bg-bg-white h-8 border border-gray-300 rounded-md"
                        v-model="form.word_address" placeholder="https://example.com"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.access_token">{{ error.access_token[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0"
                     v-if="form.plate_form == 'WooCommerce'">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Api Key</label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        v-model="form.api_key"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.access_token">{{ error.access_token[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0" v-if="form.plate_form == 'WooCommerce'">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Api Secret</label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        v-model="form.api_secret"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.access_token">{{ error.access_token[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0"
                     v-if="form.plate_form == 'MimCart'">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Store Address</label>
                    <input
                        class="w-full py-2 px-3 bg-bg-white h-8 border border-gray-300 rounded-md"
                        v-model="form.mim_store_address" placeholder="https://example.com"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.access_token">{{ error.access_token[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0"
                     v-if="form.plate_form == 'MimCart'">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Api Key</label>
                    <input
                        class="w-full py-2 px-3 bg-bg-white h-8 border border-gray-300 rounded-md"
                        v-model="form.mim_api_key"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.access_token">{{ error.access_token[0] }}</p>
                </div>

            </div>
            <div class="flex justify-end mt-8 space-x-4">
                <button
                    @click="formSubmitted()" v-if="!connectionBtn || form.store_type == 'Physical'"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                    type="button">
                    {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Save" }}
                </button>
                <button @click="testConnection" v-if="connectionBtn && form.store_type == 'Online'"
                        class=" inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-orange-400 text-white"
                        type="button">
                    Test Connection
                </button>
                <button
                    @click="additionalProp ? successfully():successfull()"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white"
                    type="button">
                    Cancel
                </button>
                <!-- <button
                    @click="successfull()"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white"
                    type="button">
                    Cancel
                </button> -->
            </div>
        </div>
    </div>
</template>

<script>
    import {byMethod, get} from '@/libs/api'
    import {form} from '@/libs/mixins'
    import Typeahead from "@/Components/typeahead/typeahead.vue";

    function initialize(to) {
        let urls = {
            add: `/api/stores/create`,
            edit: `/api/stores/${to.params.id}/edit`,
        }
        return urls[to.meta.mode] || urls.add
    }

    export default {
        mixins: [form],
        components: {
            Typeahead,
        },
        props: {
    show: Boolean ,
    additionalProp: String ,

  },
        data() {
            return {
                save_button: false,
                error: {},
                show: Boolean,
                resource: '/stores',
                store: '/api/stores',
                method: 'POST',
                small: 'stores',
                capital: 'Store',
                title: 'Add',
                message: 'New stores Added',
                permissions: {},
                companys: '/api/company',
                warehouse:'/api/warehouse',
                errorMessage: '',
                buttonText: 'Test Connection',
                connectionBtn : true
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
            onCompany(e) {
                const company = e.target.value
                this.form.company = company
                this.form.company_id = company.id
            },
            onWarehouse(e) {
                const warehouse = e.target.value
                this.form.warehouse = warehouse
                this.form.warehouse_id = warehouse.id
            },
            setData(res) {
                // console.log(res);
                this.connectionBtn = false
                this.form = res.data.form;
                if (this.$route.meta.mode == 'edit') {
                    this.store = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
                    this.title = 'Edit';
                    this.message = `${this.capital} has been updated`;
                }
                this.show = true
            },
            wordpress() {
                byMethod("post", '/api/ecommerce', this.form).then(
                    (res) => {
                        if (res.data.data) {
                            this.$toast.open({
                                position: "top-right",
                                message:
                                    "Connection Successful",
                                type: "success",
                                duration: 3000,
                            });
                            this.save_button = true,
                                this.connectionBtn = false

                        }
                        if (res.data.woocommerce_error) {
                            this.$toast.open({
                                position: "top-right",
                                message: res.data.woocommerce_error,
                                type: "error",
                                duration: 7000,
                            });
                            // this.message = res.data.woocommerce_error
                        }

                        if (res.data.error) {
                            this.$toast.open({
                                position: "top-right",
                                message: "Connection Failed",
                                type: "error",
                                duration: 3000,
                            });
                            // this.message = res.data.error
                        }
                        // console.log(res.data.error)

                    }
                )
            },
            formSubmitted() {
                this.form.selectedPermissions = this.selectedPermissions
                byMethod(this.method, this.store, this.form).then(res => {

                    this.additionalProp ? this.formSubmiting():this.successfull(res)
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
            },
            testConnection() {
                let data = {}
                let connention_url = ''
                if (this.form.plate_form == 'Shopify') {
                    data = {
                        store_address: this.form.store_address,
                        access_token: this.form.access_token
                    }
                    connention_url = '/api/shopify_fetch_data'
                } else if (this.form.plate_form == 'WooCommerce') {
                    data = {
                        api_key: this.form.api_key,
                        word_address: this.form.word_address,
                        api_secret: this.form.api_secret,
                    }
                    connention_url = '/api/ecommerce'

                } else if (this.form.plate_form == 'MimCart') {
                    data = {
                        mim_api_key: this.form.mim_api_key,
                        mim_store_address: this.form.mim_store_address
                    }
                    connention_url = '/api/mimcart_fetch_data'
                }
                if (data && connention_url) {
                    byMethod('post', connention_url, data).then(res => {
                        this.connectionBtn = false
                    }).catch(err => {
                        console.log(err);
                    })
                }
            },


            Shopify() {
                byMethod('get', `/api/fetch_data?store_address=${this.form.store_address}&access_token=${this.form.access_token}`).then((res) => {
                    // console.log(res);
                    if (res.error) {
                        this.errorMessage = res.error;
                    } else {
                        this.buttonText = 'Connection Successful';
                        setTimeout(() => {
                            this.buttonText = 'Test Connection';
                        }, 3000);
                    }
                })
                    .catch((error) => {
                        console.error(error);
                    });


            },
            storeBtn(){
                this.connectionBtn = true
            },
            successfully(res) {
                this.$emit('cancel-stores', {

                })
                // console.log('aaaa');
                // this.isOpen = false
                // this.isOpenStore = false
                // this.form = []
                // this.ImgUrl = null
            },

            formSubmiting(){
                this.$emit('save-stores', {

            })
            }

        },


    }
</script>

<style scoped>

</style>
