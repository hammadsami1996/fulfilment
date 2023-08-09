<template>
    <div>
        <div class="grid grid-rows-12 grid-flow-col gap-4 mx-1 px-2 pt-6">
            <h1 class="row-span-6 font-bold uppercase">{{ capital }}</h1>
            <div class="row-span-6 text-right" v-if="permissions.includes(`create-${small}`)">
                <router-link :to="{name:`create-${small}`}"
                             class="  inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                             type="button">
                    Create
                </router-link>
            </div>
        </div>

        <div class="flex-col">
            <panel :columns="columns" :urlApi="urlApi" ref="TableData">
                <template v-slot:action="props">
                    <div class="text-sm font-medium flex">
                        <a
                            @click="assignRole(props.item)"
                            href="#"
                        >
                            <svg class="h-5 w-5 " fill="none" stroke="currentColor" stroke-linecap="round"
                                 stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </a>
                        <span v-if="permissions.includes(`edit-${small}`)">
                        <a
                            @click.prevent="edit(props.item.id)" href="#"
                        >
                            <svg class="h-5 w-5 " fill="none" stroke="currentColor"
                                 stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" stroke="none"/>
                                <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"/>
                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"/>
                                <line x1="16" x2="19" y1="5" y2="8"/>
                            </svg>
                        </a>
                        </span>
                        <span v-if="permissions.includes(`delete-${small}`)">
                        <a
                            @click.prevent="deleteUser(props.item.id)"
                            href="#">
                            <svg class="h-5 w-5 ho" fill="none" stroke="currentColor" stroke-linecap="round"
                                 stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                <polyline points="3 6 5 6 21 6"/>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                            </svg>
                        </a>
                        </span>
                    </div>
                </template>
            </panel>
        </div>
        <!-- Modal Container -->
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
                    <div class="fixed inset-0 bg-gray-800 bg-opacity-75"/>
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
                        <DialogPanel
                            class="w-full max-w-md mx-auto flex flex-col rounded-lg shadow-sm bg-white overflow-hidden dark:text-gray-100 dark:bg-gray-800"
                            style="width: 25%; min-height: 60% "
                        >
                            <div class="flex justify-between items-center py-4 px-5 bg-gray-100 dark:bg-gray-900">
                                <DialogTitle
                                    as="h3"
                                    class="font-medium"
                                >
                                    Assign Roles
                                </DialogTitle>
                                <div class="-my-4">
                                    <button
                                        @click="isOpen = false"
                                        class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-transparent text-gray-600 hover:text-gray-400 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:text-gray-600"
                                        type="button"
                                    >
                                        <svg class="hi-solid hi-x inline-block w-4 h-4 -mx-1" fill="currentColor"
                                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path clip-rule="evenodd"
                                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                  fill-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-5 grow">
                                <label class="flex items-center text-gray-700 text-lg font-bold ml-2">Roles</label>
                                <typeahead :initialize="user_data.roles" @input="onRoles"
                                           display="name" url="/api/role"/>
                            </div>

                            <div class="space-x-2 py-4 px-5 bg-gray-100 dark:bg-gray-900" style="">
                                <button @click="updateRoles"
                                        class="bg-blue-400 space-x-8   rounded-full p-2 mx-1   bottom-0 right-0">save
                                </button>
                                <button @click="resetModal" class=" rounded-full p-2 mx-1  bottom-0 right-0">cancel
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
                
            </Dialog>
        </TransitionRoot> -->
       
    </div>
</template>

<script>
    import Panel from "@/components/panel/panel.vue";
    // import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue';
    import typeahead from "@/components/typeahead/typeahead.vue";
    import {byMethod, post} from "@/libs/api";
    import {form} from "@/libs/mixins";

    export default {
        mixins: [form],
        components: {
            // TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle,
            Panel,
            typeahead
        },
        name: "Index",
        data() {
            return {
                isOpen: false,
                user_data: {},
                assignRoleModal: false,
                permissions: [],
                urlApi: "/api/user",
                resource: "/user",
                small: "user",
                capital: "User",
                columns: [
                    {
                        label: '',
                        field: 'S.No',
                        format: 'index'
                    },
                    {
                        label: 'Name',
                        field: 'name',
                    },
                    {
                        label: 'Email',
                        field: 'email',
                    },
                    {
                        label: 'User Type',
                        field: 'user_type',
                        displayText: 'usertype'
                    },
                    {
                        label: 'Action',
                        field: 'action',
                        action: true
                    }
                ]
            }
        },
        created() {
            this.permissions = window.apex.user.permission
        },
        methods: {
            onRoles(e) {
                const roles = e.target.value;
                this.user_data.roles = roles;
                this.user_data.roles_id = roles.id;
            },
            updateRoles() {
                post('/api/assign_user_role', this.user_data).then(res => {
                    this.resetModal()
                })
            },
            resetModal() {
                this.user_data = {}
                this.isOpen = false
            },
            assignRole(data) {
                this.user_data = {
                    id: data.id,
                    roles: data.roles[0]
                };
                this.isOpen = true
            },
            display(id) {
                this.$router.push(`${this.resource}/${id}`)
            },
            edit(id) {
                this.$router.push(`${this.resource}/${id}/edit`)
            },
            deleteUser(e) {
                byMethod('delete', `/api/user/${e}`)
                    .then((res) => {
                        if (res.data.deleted) {
                            this.$refs.TableData.reload();
                            this.$toast.error(this.capital + " Deleted successfully!");
                        }
                    })
            },
        },
    }
</script>

<style scoped>

</style>
