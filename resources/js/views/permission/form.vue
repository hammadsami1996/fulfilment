<template>
    <div v-if="show">
        <div class="p-6 w-full">
            <h1 class="text-lg font-bold mb-4">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}` : `Add New ${capital}` }}
            </h1>

            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <div class="flex justify-between mb-2">
                        <label class="block font-medium text-sm text-gray-700">Permissions</label>
                        <span @click="assignPermission" class="hover:bg-gray-700 bg-blue-400 text-white rounded-md px-2 cursor-pointer">New</span>
                    </div>
                    <typeahead :initialize="form.menu" :url="permission_menu" @input="onPermissions" display="menu" />
                    <p class="text-red-600 text-xs italic" v-if="error.menu_id">{{ error.menu_id[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                        for="mc-role-name"
                    >Name <span class="text-red-600">*</span></label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        id="mc-role-name"
                        placeholder=" Name"
                        v-model="form.name"
                    />
                    <p class="text-red-600 text-xs italic" v-if=" error.name">{{ error.name[0] }}</p>
                </div>
            </div>

            <div class="flex justify-end mt-8 space-x-4">
                <!-- <button @click="formSubmitted" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white" type="button">
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
                <button @click="successfull" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white" type="button">
                    Cancel
                </button>
            </div>
        </div>
        <!-- <TransitionRoot :show="isOpen" appear as="template">
            <Dialog @close="isOpen = false" as="div" class="relative z-90">

                <TransitionChild
                    as="template"
                    enter="ease-out duration-200"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-100"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-gray-800 bg-opacity-75"></div>
                </TransitionChild>



                <div class="fixed inset-0 overflow-y-auto p-4 lg:p-8" style="top: 27%">
                    <TransitionChild
                        as="template"
                        enter="ease-out duration-200"
                        enter-from="opacity-0 scale-125"
                        enter-to="opacity-100 scale-100"
                        leave="ease-in duration-100"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-125"
                    >
                        <DialogPanel class="flex flex-col rounded shadow-sm bg-white overflow-hidden max-w-md mx-auto" style="width: 50%; height: 60%">
                            <div class="py-2 px-5 lg:px-6 w-full bg-gray-100 flex justify-between items-center">
                                <DialogTitle as="h3" class="font-medium">New Permissions</DialogTitle>
                                <div class="-my-4">
                                    <button @click="isOpen = false" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-transparent text-gray-600 hover:text-gray-400 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:text-gray-600" type="button">
                                        <svg class="hi-solid hi-x inline-block w-4 h-4 -mx-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path clip-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" fill-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                                <label class="flex items-center text-gray-700 text-lg font-bold ml-2">Roles</label>
                                <input class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md" placeholder=" Name" v-model="name" />
                            </div>
                            <div class="flex justify-end bg-gray-100 bottom-bar">
                                <button @click="updatePermission" class="bg-blue-400 space-x-8 rounded-full p-2 mx-1 bottom-0 right-0">save</button>
                                <button @click="resetModal" class="rounded-full p-2 mx-1 bottom-0 right-0">cancel</button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>

            </Dialog>
        </TransitionRoot> -->
    </div>
</template>

<script>
    import {byMethod, get, post} from '@/libs/api'
    import {form} from '@/libs/mixins'
    import Typeahead from "@/Components/typeahead/typeahead.vue";

    // import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from "@headlessui/vue";

    function initialize(to) {
        let urls = {
            add: `/api/permission/create`,
            edit: `/api/permission/${to.params.id}/edit`,
        }
        return urls[to.meta.mode] || urls.add
    }

    export default {
        mixins: [form],
        components: {
            // TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle,
            Typeahead,
        },
        data() {
            return {
                meun: {},
                isOpen: false,
                isSubmitting: false,
                error: {},
                show: false,
                resource: '/permission',
                store: '/api/permission',
                method: 'POST',
                small: 'permission',
                capital: 'Permission',
                title: 'Add',
                message: 'New permission Added',
                permissions: {},
                permission_menu: '/api/permission_menu',

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
        methods:

            {
                onPermissions(e) {
                    const permission_menu = e.target.value
                    this.form.menu = permission_menu
                    this.form.menu_id = permission_menu.id

                },
                assignPermission() {
                    this.isOpen = true
                },
                updatePermission() {
                    let data = {
                        name: this.name
                    }
                    post('/api/permission_menu', data).then(res => {
                        this.resetModal()
                    })
                },
                resetModal() {
                    this.name = null
                    this.isOpen = false
                },

                setData(res) {
                    this.form = res.data.form;
                    if (this.$route.meta.mode === 'edit') {
                        this.store = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
                        this.title = 'Edit';
                        this.message = `${this.capital} has been updated`;
                    }
                    this.show = true
                },

                formSubmitted() {
                this.isSubmitting = true;
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
    /*span {*/
    /*    float: right;*/
    /*    right: 0;*/
    /*}*/

</style>
