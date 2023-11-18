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
                    <label class="block font-medium text-sm text-gray-700 mb-2">Platform</label>
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
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="block font-medium text-sm text-gray-700 mb-2"
            >Store Image</label>
            <div class="flex items-center">
                <input
                    class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                    id="store_image"
                    name="store_image" type="file"
                    v-on:change="onImageChange"
                     >
                <img width="100" :src="ImgUrl" v-if="ImgUrl">
                <div class="w-full sm:w-1/2 mb-4 sm:ml-0 p-2 " v-else-if="form.img">
                    <img width="100" :src="`/uploads/store/img/`+form.img">
                </div>
                <!-- <div class="w-full sm:w-1/2 mb-4 sm:ml-0 p-2 " v-if="form.img == null && form.store_type == 'online' ">
                    <div v-if="form.plate_form == 'WooCommerce'">
                        <img width="100" :src="`/images/woocommerce.png`">
                    </div>
                </div> -->
            </div>

            <p class="text-red-600 text-xs italic" v-if="error.img">{{ error.img[0] }}</p>
        </div>

            <div class="flex justify-end mt-8 space-x-4">
<!--                <button-->
<!--                    @click="formSubmitted()" v-if="!connectionBtn || form.store_type == 'Physical'"-->
<!--                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"-->
<!--                    type="button">-->
<!--                    {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Save" }}-->
<!--                </button>-->
<!--                <button @click="testConnection" v-if="connectionBtn && form.store_type == 'Online'"-->
<!--                        class=" inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-orange-400 text-white"-->
<!--                        type="button">-->
<!--                    Test Connection-->
<!--                </button>-->
<!--                <button-->
<!--                    @click="formSubmitted()" v-if="connectionBtn && form.store_type == 'Online'"-->
<!--                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"-->
<!--                    type="button">-->
<!--                    {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Save" }}-->
<!--                </button>-->
                <!-- <button
                    @click="formSubmitted()"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                    type="button"
                    v-if="!connectionBtn || (form.store_type == 'Physical' || (connectionBtn && form.store_type == 'Online'))"
                >
                    {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Save" }}
                </button> -->
                <button
                    @click="formSubmitted()"
                    :disabled="isSubmittingdata"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                    type="button"
                    v-if="!connectionBtn || (form.store_type == 'Physical' || (connectionBtn && form.store_type == 'Online'))"
                >
                <svg aria-hidden="true" class="inline w-4 h-4 mr-3 text-white animate-spin" fill="none"
                     role="status" v-if="isSubmittingdata" viewBox="0 0 100 101"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="#E5E7EB"/>
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentColor"/>
                </svg>
                    {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Save" }}
                </button>
                <!-- <button
                    @click="testConnection"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-orange-400 text-white"
                    type="button"
                    v-if="connectionBtn && form.store_type == 'Online'"
                >
                    Test Connection
                </button> -->
                <button @click="testConnection"
                :disabled="isSubmitting"
                class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2
                leading-5 text-sm border-gray-300 bg-orange-400 text-white hover:bg-orange-500 transition duration-200
                ease-in-out"
                type="button"
                v-if="connectionBtn && form.store_type === 'Online'"
        >
            <svg aria-hidden="true" class="inline w-4 h-4 mr-3 text-white animate-spin" fill="none" role="status" v-if="isSubmitting" viewBox="0 0 100 101"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="#E5E7EB"/>
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentColor"/>
            </svg>
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
    import {objectToFormData} from "@/libs/helpers";

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
    show: Boolean,
    additionalProp: String ,

  },
        data() {
            return {
                ImgUrl: null,
                save_button: false,
                isSubmitting: false,
                isSubmittingdata: false,
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
            onImageChange(e) {
                this.form.imgN = e.target.files;
                this.ImgUrl = URL.createObjectURL(e.target.files[0]);

            },
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

                    }
                )
            },
            formSubmitted() {
                this.isSubmittingdata = true;
                this.form.selectedPermissions = this.selectedPermissions

                byMethod(this.method, this.store, objectToFormData(this.form)).then(res => {
                    this.additionalProp ? this.formSubmiting():this.successfull(res)
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                        type: 'success',
                        duration: 3000
                    });
                    this.$emit('resp', true);
                }).catch(err => {
                    this.error = err.response.data.errors;
                    this.$toast.open({
                        position: 'top-right',
                        message: 'Error',
                        type: 'error',
                        duration: 3000
                    });
                })
                // .finally(() => {
                // this.isSubmittingdata = false; // Enable the button and hide the spinner
                // });
                this.isSubmittingdata = false;
            },
            successfull(res) {
                this.$router.push({path: `${this.resource}`})
            },
            // testConnection() {
            //     let data = {}
            //     let connention_url = ''
            //     if (this.form.plate_form == 'Shopify') {
            //         data = {
            //             store_address: this.form.store_address,
            //             access_token: this.form.access_token
            //         }
            //         connention_url = '/api/shopify_fetch_data'
            //     } else if (this.form.plate_form == 'WooCommerce') {
            //         data = {
            //             api_key: this.form.api_key,
            //             word_address: this.form.word_address,
            //             api_secret: this.form.api_secret,
            //         }
            //         connention_url = '/api/ecommerce'

            //     } else if (this.form.plate_form == 'MimCart') {
            //         data = {
            //             mim_api_key: this.form.mim_api_key,
            //             mim_store_address: this.form.mim_store_address
            //         }
            //         connention_url = '/api/mimcart_fetch_data'
            //     }
            //     if (data && connention_url) {
            //         byMethod('post', connention_url, data).then(res => {
            //             this.connectionBtn = false
            //         }).catch(err => {
            //             // console.log(err);
            //         })
            //     }
            // },
            testConnection() {
  this.isSubmitting = true;
  let data = {};
  let connention_url = '';
  if (this.form.plate_form == 'Shopify') {
    data = {
      store_address: this.form.store_address,
      access_token: this.form.access_token
    };
    connention_url = '/api/shopify_fetch_data';
  } else if (this.form.plate_form == 'WooCommerce') {
    data = {
      api_key: this.form.api_key,
      word_address: this.form.word_address,
      api_secret: this.form.api_secret,
    };
    connention_url = '/api/ecommerce';
  } else if (this.form.plate_form == 'MimCart') {
    data = {
      mim_api_key: this.form.mim_api_key,
      mim_store_address: this.form.mim_store_address,
    };
    connention_url = '/api/mimcart_fetch_data';
  }

  if (data && connention_url) {
    byMethod('post', connention_url, data)
      .then(res => {
        this.connectionBtn = false;
        this.isSubmitting = false;
      })
      .catch(err => {
        this.isSubmitting = false;
        this.$toast.open({
            position: 'top-right',
          message: 'Connection Failed',
          type: 'error',
          duration: 3000,
        });
      });
  }
},

            Shopify() {
                byMethod('get', `/api/fetch_data?store_address=${this.form.store_address}&access_token=${this.form.access_token}`).then((res) => {
                    if (res.error) {
                        this.errorMessage = res.error;
                    } else {
                        this.buttonText = 'Connection Successful';
                        setTimeout(() => {
                            this.buttonText = 'Test Connection';
                        }, 3000);
                    }
                }).catch((error) => {
                        console.error(error);
                    });
            },
            storeBtn(){
                this.connectionBtn = true
            },
            successfully(res) {
                this.$emit('cancel-stores', {

                })
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
