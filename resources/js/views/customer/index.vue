<template>
    <div>
        <div class="px-4 py-5  sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ capital }}</h3>
            <div class="mt-3 pb-4 sm:mt-0 sm:ml-4 flex justify-end">
                <router-link :to="{name:`create-${small}`}"
                             type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white">
                     + New Customer
                </router-link>
                <router-link :to="{name:`create-customer_category`}"
                             type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white">
                    New Customer Category
                </router-link>
            </div>
        </div>
        <div class="flex-col">
            <div class="flex justify-end">
                <div class="flex items-center px-4 py-2">
                    <label class="text-gray-600 mr-2">Search:</label>
                    <div class="relative">
                        <input
                            @keyup="search()"
                            class="rounded-md py-1 pl-4 pr-8 w-64 border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Search"
                            type="text"
                            v-model="searchTerm"
                        />
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <svg class="text-gray-400 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 15l4 4m0 0l-4-4m4 4H4" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <panel :columns="columns" :urlApi="urlApi" ref="TableData" :search-Enable="false">
                <template v-slot:action="props">
                    <div class="text-sm font-medium flex">
                         <span v-if="permissions.includes(`edit-${small}`)"
                         class="bg-blue-400 p-1 text-white border rounded border-blue-500 mr-2 hover:bg-blue-600 transition-colors duration-300"
                         >
                        <a
                            @click.prevent="edit(props.item.id)"
                            href="#"
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
                        <span v-if="permissions.includes(`delete-${small}`)" class="bg-red-500 p-1 border rounded border-red-500 text-white hover:bg-red-600 transition-colors duration-300">
                        <a
                            @click.prevent="deleteRole(props.item.id)"
                            href="#"
                        >
                            <svg class="h-5 w-5 " fill="none" stroke="currentColor" stroke-linecap="round"
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
    </div>
</template>

<script>
    import Panel from "@/components/panel/panel.vue";
    import {form} from "@/libs/mixins";
    import {byMethod} from "@/libs/api";

    export default {
        mixins: [form],
        components: {
            Panel,
        },
        name: "Index",
        data() {
            return {
                permissions: [],
                urlApi: "/api/customer",
                urlApi1: "/api/customer",
                resource: "/customer",
                searchTerm: '',
                small: "customer",
                capital: "Customer",
                columns: [
                    {label: 'S.No', field: 'id', format: 'index'},
                    {label: 'Name', field: 'name',},
                    {label: 'Email', field: 'email'},
                    {label: 'Phone', field: 'phone'},
                    {label: 'Category', field: 'customer_category', displayText: 'category'},
                    // {label: 'Balance', field: 'balance'},
                    {label: 'Action', field: 'action', action: true},
                    {label: 'Extra', field: 'extra', slot: true}
                    ]
            }
        },
        created() {
            this.permissions = window.apex.user.permission
        },
        methods: {
            search() {
                this.urlApi = this.urlApi1
                let param = "?q=";
                if (this.searchTerm != null) {
                        param += `&searchTerm=${this.searchTerm}`;
                    }
                    this.urlApi += param
                    this.$refs.TableData.reload();
                },
            edit(id) {
                this.$router.push(`${this.resource}/${id}/edit`)
            },
            deleteRole(e) {
                byMethod('delete', `/api/customer/${e}`)
                    .then((res) => {
                        if (res.data.deleted) {
                            this.$refs.TableData.reload();
                            this.$toast.error( this.capital + " Deleted successfully!");
                        }
                    })
            },
        },
    }
</script>
