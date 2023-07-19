<template>
    <div>
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ capital }}</h3>
            <div class="mt-3 pb-4 sm:mt-0 sm:ml-4 flex justify-end">
                <router-link
                    :to="{name: `create-${small}`}"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-50  px-4 py-3 leading-6 rounded border-gray-700 bg-emerald-400 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-gray-700 active:border-gray-700"
                >
                    <span class="mr-2">Create </span>
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            clip-rule="evenodd"
                            d="M10 12a2 2 0 100-4 2 2 0 000 4z"
                            fill-rule="evenodd"
                        />
                        <path
                            clip-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-3a1 1 0 00-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            fill-rule="evenodd"
                        />
                    </svg>
                </router-link>
            </div>
        </div>
        <div class="flex-col">
            <panel :columns="columns" :urlApi="urlApi" ref="TableData">
                <template v-slot:action="props">
                    <div class="text-sm font-medium flex">
                        <a
                            @click.prevent="edit(props.item.id)"
                            class="ml-4 text-indigo-600 hover:text-indigo-900"
                            href="#">
                            <svg  class="h-5 w-5 text-gray-500"  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />  <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />  <line x1="16" y1="5" x2="19" y2="8" /></svg>
                        </a>
                        <a
                            @click.prevent="deleteRole(props.item.id)"
                            class="ml-4 text-red-600 hover:text-red-900"
                            href="#">
                            <svg class="h-5 w-5 text-gray-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="3 6 5 6 21 6" />  <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" /></svg>
                        </a>
                    </div>
                </template>
            </panel>
        </div>
    </div>
</template>

<script>
    import Panel from "@/components/panel/panel.vue";
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
                urlApi: "/api/job",
                resource: "/job",
                small: "job",
                capital: "job",
                columns: [
                    {
                        label: 'S.No',
                        field: 'S.No',
                        format: 'index'
                    },
                    {
                        label: 'Name',
                        field: 'name',
                    },
                    {
                        label: 'Description',
                        field: 'description',
                    },
                    {
                        label: 'Is Actie',
                        field: 'status',
                        is_active: true,
                    },
                    {
                        label: 'Action',
                        field: 'action',
                        action: true
                    },
                ]
            }
        },
        created() {
            // console.log(window.apex.user.permission)
            this.permissions = window.apex.user.permission
        },
        methods: {
            display(id) {
                this.$router.push(`${this.resource}/${id}`)
            },
            edit(id) {
                this.$router.push(`${this.resource}/${id}/edit`)
            },
            deleteRole(id) {
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
