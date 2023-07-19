<template>
    <div>
        <div class="bg-white shadow overflow-hidden rounded-lg">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">{{ capital }}</h3>
                <div class="mt-3 sm:mt-0 sm:ml-4 flex justify-end">
                    <router-link
                        v-if="permissions.includes(`create-${small}`)"
                        :to="{name:`create-${small}`}"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-800 transition duration-150 ease-in-out"
                    >
                        Create
                    </router-link>
                </div>
            </div>
            <div class="flex-col">
                <panel ref="TableData" :url-api="urlApi" :columns="columns">
                    <template #action="{ item }">
                        <div class="text-sm font-medium">
                            <span v-if="permissions.includes(`display-${small}`)">
                                <a
                                    href="#"
                                    class="text-indigo-600 hover:text-indigo-900"
                                    @click.prevent="display(item.id)"
                                >
                                    Show
                                </a>
                            </span>
                            <span v-if="permissions.includes(`edit-${small}`)">
                                <a
                                    href="#"
                                    class="ml-4 text-indigo-600 hover:text-indigo-900"
                                    @click.prevent="edit(item.id)"
                                >
                                    Edit
                                </a>
                            </span>
                            <span v-if="permissions.includes(`delete-${small}`)">
                                <a
                                    href="#"
                                    class="ml-4 text-red-600 hover:text-red-900"
                                    @click.prevent="delete(item.id)"
                                >
                                    Delete
                                </a>
                            </span>
                        </div>
                    </template>
                </panel>
            </div>
        </div>
    </div>
</template>

<script>
    import Panel from "@/components/panel/Panel";
    import {form} from "@/libs/mixins";

    export default {
        mixins: [form],
        components: {
            Panel,
        },
        name: "Index",
        data() {
            return {
                permissions: [],
                urlApi: "/api/user",
                resource: "/user",
                small: "user",
                capital: "User",
                panel_sort_enabled: true,
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
            display(id) {
                this.$router.push(`${this.resource}/${id}`)
            },
            edit(id) {
                this.$router.push(`${this.resource}/${id}/edit`)
            },
            delete(id) {
                const r = confirm("Are you sure!")
                if (r != true) {
                    return
                }
                this.destroy(`${this.urlApi}/${id}`, (res) => {
                    this.$refs.TableData.reload();
                    this.success(`You have successfully deleted ` + this.capital`!`)
                });
            }
        },
    }
</script>

<style scoped>

</style>
