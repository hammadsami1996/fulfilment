<template>
    <div v-if="show">
        <div class="p-6">
            <h1 class="text-lg font-bold mb-4">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: `Add New ${capital}`}}
            </h1>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/3 mb-4 sm:mb-0 -mt-12">
                    <label class="block font-medium text-sm text-gray-700 mb-2" >Code</label>
                    <input class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md" type="number" placeholder="Auto Generated" disabled v-model="form.accountcode" />
                    </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 pl-4 -mt-12">
                    <label class="block font-medium text-sm text-gray-700 mb-2" >Account Title <span class="text-red-600">*</span></label>
                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="text" v-model="form.accounttitle" />
                    <p class="text-red-600 text-xs italic" v-if="error.accounttitle">{{ error.accounttitle[0] }}</p>
                </div>
                <div class="w-full sm:w-2/3 mb-2 sm:mb-0 pl-4 pt-6">
                    <label class="block font-medium text-sm text-gray-700 mb-2" >Descrpition</label>
                    <textarea   class="w-full py-2 px-3 bg-white-100 border border-gray-400 rounded-md" placeholder="Leave a comment here"  style="height: 100px" v-model="form.description"></textarea>
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                    <div class="w-full sm:w-1/3 mb-4 sm:mb-0 p-2" >
                    <label class="block font-medium text-sm text-gray-700 mb-2" >Account Group</label>
                    <typeahead :initialize="form.group" :url="accountgroup" @input="onGroup" display="groupname"/>
                    </div>
                    <!-- <div class="w-full sm:w-1/2 mb-4 sm:mb-0 pl-2 pt-6">
                        <label class="flex items-center space-x-2">
                            <input :checked="form.active === 1" @change="form.active = (form.active === 1) ? '' : 1"
                            class="form-checkbox h-6 w-6 text-indigo-600 py-2 px-3" type="checkbox">
                            <span class="text-gray-700">Active</span>
                        </label>
                    </div> -->
                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0 pl-2 pt-4">
                    <label class="flex items-center space-x-2 mb-2"> <span class="text-gray-700">Active</span>   </label>
                    <div class="space-x-2" style="margin-bottom: 10px;">
                    <div class="inline-flex items-center space-x-3">
                        <input type="checkbox" id="switch2" :checked="form.active === 1" @change="form.active = (form.active === 1) ? 0 : 1" name="switch2"
                        class="h-8 w-16 rounded-full text-primary-500 transition-all duration-150 ease-out form-switch focus:ring focus:ring-primary-500 focus:ring-opacity-50 dark:bg-gray-700 dark:ring-offset-gray-900 dark:checked:bg-current"/>
                    </div>
                    </div>
                </div>
                </div>
                    
            <div class="flex justify-end mt-8 space-x-4">
                <button @click="formSubmitted" :disabled="isSubmitting" type="button"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white" >
                    <svg aria-hidden="true" class="inline w-4 h-4 mr-3 text-white animate-spin" fill="none" role="status" v-if="isSubmitting" viewBox="0 0 100 101" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="#E5E7EB"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentColor"/>
                </svg>
                    {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Add" }}
                </button>
                <button @click="additionalProp ? successfully():successfull()" type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white" >
                    Cancel
                </button>
            </div>
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
            add: `/api/accounts/create/`,
            edit: `/api/accounts/${to.params.id}/edit`,
        }
        return urls[to.meta.mode] || urls.add
    }   

    export default {
        mixins: [form],
        props: {
            show: Boolean,
            additionalProp: String,
        },
        components: {
            Typeahead,
        },
        data() {
            return {
                error: {},
                // show: false,
                show: Boolean,
                isSubmitting: false,
                group_ids: null,
                resource: '/accounts',
                accountgroup : '/api/accounts_group',
                store: '/api/accounts',
                method: 'POST',
                small: 'accounts',
                capital: 'Account',
                title: 'Add',
                message: 'New accounts Added',
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
            onGroup(e){
                const groups = e.target.value
                this.form.group = groups
                this.form.group_id = groups.id
                this.group_ids = this.form.group_id
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
                    this.$emit('resp', true);
                }).catch(err => {
                    this.error = err.response.data.errors;
                    console.log(err.response.data.errors)
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
            successfully(res) {
                this.$emit('cancel-account', {

                })
            },
            formSubmiting() {
                this.$emit('save-account', {})
            },
        },
    }
</script>