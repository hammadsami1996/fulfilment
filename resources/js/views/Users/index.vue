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

        <Modal :show="isOpen" closeable="true">
            <div class="bg-gray-100" >
                <div class="p-5 grow" style="height: 250px">
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
            </div>
        </Modal>
    </div>
</template>

<script>
    import Panel from "@/components/panel/panel.vue";
    import Modal from "@/components/Modal.vue";
    import typeahead from "@/components/typeahead/typeahead.vue";
    import {byMethod, post} from "@/libs/api";
    import {form} from "@/libs/mixins";

    export default {
        mixins: [form],
        components: {
            Modal, Panel, typeahead
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
