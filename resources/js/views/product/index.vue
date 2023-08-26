<template>
    <div>
        <div class="bg-gray-100 py-4">
            <nav class="container mx-auto flex justify-center">
                <a @click="show_personal"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-blue-500 focus:text-gray-700 focus:border-blue-300">
                    All
                </a>
                <a @click="show_eligibility"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-purple-500 focus:text-gray-700 focus:border-purple-300">
                    In Stock
                </a>
                <a @click="show_references"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-green-500 focus:text-gray-700 focus:border-green-300">
                    Services
                </a>
                <a @click="show_emergency"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-rose-500 focus:text-gray-700 focus:border-rose-300">
                    Kit/Bundle
                </a>
                <a @click="show_bank_account"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-yellow-500 focus:text-gray-700 focus:border-yellow-300">
                    Out Of Stock
                </a>
                <a @click="show_medical"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-lime-500 focus:text-gray-700 focus:border-lime-300">
                    Low Stock
                </a>
            </nav>
        </div>
        <div class="px-4 py-5  sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ capital }}</h3>
            <div class="mt-3 pb-4 sm:mt-0 sm:ml-4 flex justify-end">
                <router-link :to="{name:`create-${small}`}"
                             class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                             type="button">
                    Create
                </router-link>
            </div>
        </div>
        
        <div class="flex-col">
            <div  class="ml-6 col-6"  >
               


               <button
               
               @click="exportTableToExcel('print', 'products')"
               class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
               type="button">
              
              Excel
               </button>
               
           </div>
            <panel :columns="columns" :urlApi="urlApi" ref="TableData" id="print">
                <template v-slot:action="props">
                    <div class="text-sm font-medium flex">
                         <span v-if="permissions.includes(`edit-${small}`)">
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
                        <span v-if="permissions.includes(`delete-${small}`)">
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
                urlApi: "/api/product",
                resource: "/product",
                small: "product",
                capital: "Product",
                columns: [
                    {label: 'S.No', field: 'id', format: 'index'},
                    {label: 'Name', field: 'title'},
                    {label: 'SKU', field: 'product_sku'},
                    {label: 'Cost Price', field: 'cost_price'},
                    {label: 'Selling Price', field: 'selling_price'},
                    {label: 'Action', field: 'action', action: true},
                ]
            }
        },
        created() {
            this.permissions = window.apex.user.permission
        },
        methods: {

            exportTableToExcel(tableID, filename = "") {
                        var downloadLink;
                        var dataType = "application/vnd.ms-excel";
                        var tableSelect = document.getElementById(tableID);


                        tableSelect.style.borderCollapse = "collapse";
                        
                        tableSelect.style.width = "100%";
                        tableSelect.style.textAlign = "center";

                        
                        var thead = tableSelect.querySelector("thead");
                        
                        var tableHTML = tableSelect.outerHTML.replace(/ /g, "%20");
                        filename = filename ? filename + ".xls" : "Pivot Report.xls";

                        downloadLink = document.createElement("a");
                        document.body.appendChild(downloadLink);

                        if (navigator.msSaveOrOpenBlob) {
                            var blob = new Blob(["\ufeff", tableHTML], {
                                type: dataType,
                            });
                            navigator.msSaveOrOpenBlob(blob, filename);
                        } else {
                            downloadLink.href = "data:" + dataType + ", " + tableHTML;
                            downloadLink.download = filename;
                            downloadLink.click();
                        }
                        },
            edit(id) {
                this.$router.push(`${this.resource}/${id}/edit`)
            },
            deleteRole(e) {
                byMethod('delete', `/api/product/${e}`)
                    .then((res) => {
                        // console.log(res);
                        if (res.data.deleted) {
                            this.$refs.TableData.reload();
                            this.$toast.error(this.capital + " Deleted successfully!");
                        }
                    })
            },
        },
    }
</script>
