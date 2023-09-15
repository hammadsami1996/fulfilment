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
                <button @click="formSubmitted" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white" type="button">
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
                    // console.log(this.form.skill);
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
    /*span {*/
    /*    float: right;*/
    /*    right: 0;*/
    /*}*/

</style>
