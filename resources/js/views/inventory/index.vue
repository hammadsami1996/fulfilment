<template>
    <div>
        <div class="px-4 py-5  sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ capital }}</h3>
            <!-- <div class="mt-3 pb-4 sm:mt-0 sm:ml-4 flex justify-end">
                <router-link :to="{name:`create-${small}`}"
                             type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white">
                    Create
                </router-link>
            </div> -->
        </div>
        <div class="flex-col">
            <panel :columns="columns" :urlApi="urlApi" ref="TableData">
                <template v-slot:images="props">



                  <div class="flex items-center">
                    <div  v-if="props.item.product && props.item.product.product_img && props.item.product.product_img[0]  " class="w-20 h-20 rounded object-cover image-container">

                                            <img :src="`/uploads/product/img/` +   props.item.product.product_img[0].img" >

                                    </div>
                                        <div  v-else class="w-20 h-20 rounded object-cover image-container" >
                                            <img src="~@/images/no-picture-taking.png" alt="No Picture">

                                        </div>
                                        </div>

               </template>
                <template v-slot:action="props">
                    <div class="text-sm font-medium flex">
                         <!-- <span v-if="permissions.includes(`edit-${small}`)">
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
                         </span> -->
                        <span v-if="permissions.includes(`delete-${small}`)"
                        class="bg-red-500 p-1 border rounded border-red-500 text-white hover:bg-red-600 transition-colors duration-300">
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
                urlApi: "/api/inventory",
                resource: "/inventory",
                small: "inventory",
                capital: "Inventory",
                columns: [
                    {label: 'S.No', field: 'id', format: 'index'},
                    {label: 'Product Sku', field: 'sku',  displayText: 'product'},
                    {label: 'Barcode', field: 'barcode',  displayText: 'product'},

                    {label: 'Images', field: 'images' , slot:true},
                    {label: 'Product id', field: 'title',  displayText: 'product'},

                    {label: 'Warehouse id', field: 'name',  displayText: 'warehouse'},
                    {label: 'Qty', field: 'qty',},
                    // {label: 'Price', field: 'price',},
                    {label: 'Action', field: 'action', action: true}
                    ]
            }
        },
        created() {
            this.permissions = window.apex.user.permission
        },
        methods: {
            edit(id) {
                this.$router.push(`${this.resource}/${id}/edit`)
            },
            deleteRole(e) {
                byMethod('delete', `/api/inventory/${e}`)
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
<style scoped>
.image-container:hover {
    transform: scale(1.2);

}
</style>
