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
                    >Name <span class="text-red-600">(Required)</span></label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        placeholder=" Name"
                        v-model="form.name"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.name">{{ error.name[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Location</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        placeholder=" location"
                        v-model="form.location"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.location">{{ error.location[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Company</label>
                    <typeahead :initialize="form.company" :url="companys" @input="onCompany" display="name"/>
                    <p class="text-red-600 text-xs italic" v-if="error.company_id">{{ error.company_id[0] }}</p>
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Store Type</label>
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
                            v-model="form.plate_form">
                            <option value="Woocommerce">Woocommerce</option>
                            <option value="Shopify">Shopify</option>
                        </select>
                    </div>
                    <p class="text-red-600 text-xs italic" v-if="error.plate_form">{{ error.plate_form[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0"
                     v-if="form.plate_form == 'Shopify' && form.store_type  == 'Online'">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Access Token</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        v-model="form.access_token"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.access_token">{{ error.access_token[0] }}</p>
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0"
                     v-if="form.plate_form == 'Shopify' && form.store_type  == 'Online'">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Store Address</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"  type="url"
                        placeholder="https://example.com"
                        v-model="form.store_address"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.access_token">{{ error.access_token[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0 mt-6"
                     v-if="form.plate_form == 'Shopify' && form.store_type  == 'Online'">
                    <button
                        @click="testconnection()"
                        class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white"
                        type="button">
                        Test Connection
                    </button>
                    <div class="error-message" v-if="errorMessage">{{ errorMessage }}</div>
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
        data() {
            return {

                error: {},
                show: false,
                resource: '/stores',
                store: '/api/stores',
                method: 'POST',
                small: 'stores',
                capital: 'Store',
                title: 'Add',
                message: 'New stores Added',
                permissions: {},
                companys: '/api/company',
                errorMessage: '',
                buttonText: 'Test Connection',
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
            setData(res) {
                // console.log(res);
                this.form = res.data.form;
                if (this.$route.meta.mode == 'edit') {
                    this.store = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
                    this.title = 'Edit';
                    this.message = `${this.capital} has been updated`;
                }
                this.show = true
            },
            testconnection() {
                byMethod('get', `/api/fetch_data?store_address=${this.form.store_address}&access_token=${this.form.access_token}`).then((res) => {
                    console.log(res);
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


            }

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
        },
    }
</script>

<style scoped>

</style>
