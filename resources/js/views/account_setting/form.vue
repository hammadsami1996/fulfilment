<template>
    <div v-if="show">
        <div class="p-6">
            <h1 class="text-lg font-bold mb-4">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: `Add New ${capital}`}}
            </h1>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2" >Key <span class="text-red-600">*</span></label>
                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="text" v-model="form.key" />
                        <!-- <p class="text-red-600 text-xs italic" v-if="error.key">{{ error.key[0] }}</p> -->
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 pl-2 p-2">
                    <label class="flex items-center space-x-2 mb-2"> <span class="text-gray-700">Value</span>   </label>
                    <!-- <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="text" v-model="form.value" /> -->
                    <typeahead :initialize="form.account" :url="account" @input="onaccount" display="accounttitle"/>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-8 space-x-4">
                <button @click="formSubmitted" :disabled="isSubmitting" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                    type="button">
                    <svg aria-hidden="true" class="inline w-4 h-4 mr-3 text-white animate-spin" fill="none" role="status" v-if="isSubmitting" viewBox="0 0 100 101" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="#E5E7EB"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentColor"/>
                </svg>
                    {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Add" }}
                </button>
                <button @click="successfull()" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white" type="button"> 
                    Cancel
                </button>
            </div>
        </div>
</template>

<script>
    import {byMethod, get} from '@/libs/api'
    import {form} from '@/libs/mixins'
    import {objectToFormData} from "@/libs/helpers";
    import Typeahead from "@/Components/typeahead/typeahead.vue";

    function initialize(to) {
        let urls = {
            add: `/api/account_setting/create/`,
            edit: `/api/account_setting/${to.params.id}/edit`,
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
            additionalProp: String,
        },
        data() {
            return {
                error: {},
                // show: false,
                show: Boolean,
                isSubmitting: false,
                resource: '/account_setting',
                account: '/api/accounts',
                method: 'POST',
                small: 'account_setting',
                capital: 'Account Setting',
                store: '/api/account_setting',
                title: 'Add',
                message: 'New Account Setting Added',
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
                this.form = res.data.form;
                if (this.$route.meta.mode === 'edit') {
                    this.store = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
                    this.title = 'Edit';

                    this.message = `${this.capital} has been updated`;
                }
                this.show = true
            },
            // onaccount(e) {
            //     const values = e.target.value;
            //     this.form.value = values;
            //     this.form.value_id = values.id;
            // },
            onaccount(e) {
            const values = e.target.value;
            this.form.account = values;
            this.form.value = values.id;
        },

            formSubmitted() {
                this.isSubmitting = true;
                this.form.selectedPermissions = this.selectedPermissions
                byMethod(this.method, this.store, objectToFormData(this.form)).then(res => {
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
                })
                .finally(() => {
                this.isSubmitting = false; 
                });
            },
            successfull(res) {
                this.$router.push({path: `${this.resource}`})
            },
        
        },
    }
</script>
