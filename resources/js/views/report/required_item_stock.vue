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
        <!-- <button @click="selectall">Download</button> -->

        <div class="flex-row">

            <div class="flex flex-row">
            <div class=" flex-col-6 ml-6 mt-4" colspan="8">
                <button

                @click="downloadImage"
                class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-3 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                type="button">
                <svg style="margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" fill="white"/></svg>
                Download Images
                </button>



            </div>

            <div  class="ml-6 col-6 mt-4" style="float:right" >



                <button

                @click="exportTableToExcel('print', 'Order Stock Report')"
                class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                type="button">

               Excel
                </button>

            </div>
            <span class="ml-4 mt-6">Suppliers:</span>

            <div  class="ml-2 col-6 "  >


            <span style="font-size: x-small; font-weight: bold; color:red; cursor: pointer;" @click="clearsupp">clear:</span>

                <typeahead :initialize="form.supplier" :url="Supplier"   @input="onSupplier" display="name" title="Supplier"/>

           </div>
        </div>
            <panel :columns="columns" :urlApi="urlApi" ref="TableData" id="print">

                <template v-slot:images="props">



                  <div class="flex items-center">
                    <div  v-if="props.item.product_image !=null  " class="w-20 h-20 rounded object-cover image-container">

                                            <img :src="`/uploads/product/img/` +  props.item.product_image" >

                                    </div>
                                        <div  v-else class="w-20 h-20 rounded object-cover image-container" >
                                            <img src="~@/images/no-picture-taking.png" alt="No Picture">

                                        </div>
                                        </div>

               </template>
                <template v-slot:Po_required="props">

                           {{ props.item.ordered_qty - props.item.inventory_qty }}


                        </template>

                        <template v-slot:new_qty="props">
                            <input
                                   class=" px-2 py-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                   type="number"
                                   v-model="props.item.new_qty"
                            >
               </template>
                <template v-slot:details="props">
                    <div class="text-sm font-medium flex">

                        <button @click="image_model(props.item)" style="color: blue;">Details</button>

                        <!-- <input type="checkbox" class="form-checkbox h-6 w-6 text-indigo-600"  v-model="props.item.download"> -->


                    </div>

                </template>
                <template v-slot:action="props">
                    <div class="text-sm font-medium flex">
        <input type="checkbox" class="form-checkbox h-6 w-6 text-indigo-600"
               :checked="download.includes(props.item.product_id)"
               @click="isChecked(props.item, props.item.product_id)">
    </div>
                <!-- <div class="text-sm font-medium flex">
                    <input type="checkbox" class="form-checkbox h-6 w-6 text-indigo-600" @change="isChecked(props.item.product_image)" :value="props.item.product_id">
                </div> -->
            </template>

            </panel>



        </div>

         <Modal :show="true"

                         height="900"

                         v-if="show_image_modal"
                         >
                         <div class="p-6" style="background-color:#273746 ; color:white">
                            <h1 class="text-lg font-bold mb-4 text-center">
                                    Product Details
                            </h1>
                         </div>
                         <div >
                            <div class="col-12 ">
                         <div  style=" max-width: 70%; height: 100%; justify-content: center; align-items: center; margin-left: 15%; ">

                                <img :src="`/uploads/product/img/` +  modal_data.product_image" >
                            </div>
                        </div>
                        <div class="col-6 text-center flex justify-center">
                            <ul style="margin-left: 50px;  font-weight: bold; font-size: large;">
                                <li>SKU:{{ modal_data.sku }}</li>
                                <li>Title:{{ modal_data.title }}</li>

                            </ul>




                            <!-- <span>{{ modal_data.sku }}</span>
                            <span>{{ modal_data.title }}</span> -->

                        </div>

                    </div>



                    <div class="flex justify-center mt-4 space-x-4 mb-6 mr-6" style="background-color:#273746 ; color:white">

                        <h1 class="text-lg font-bold mb-4 text-center">
                            Quantity Required in order no.
                            </h1>
                            <div class="flex" v-for="(order) in order_id" >

                                <span>{{ order }}.</span>
                            </div>


           </div>


                         <div class="flex justify-end mt-4 space-x-4 mb-6 mr-6">

                <button
                @click="close"
                    class=" inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white"
                    type="button">
                    Cancel
                </button>
            </div>
                        </Modal>





    </div>

</template>




<script>
    import Panel from "@/components/panel/panel.vue";
    import {form} from "@/libs/mixins";
    import {byMethod} from "@/libs/api";
    import Modal from "@/Components/Modal.vue";
    import Typeahead from "@/Components/typeahead/typeahead.vue";
    // import VueHtml2pdf from 'vue-html2pdf'





    export default {
        mixins: [form],
        components: {
            Panel, Modal ,Typeahead
        },
        name: "Index",
        data() {
            return {
                Supplier:'/api/supplier',
                pdf:'pdf-content',
                show_image_modal: false,
                show:false,
                items:[],
                download: [],
                ids: [],
                model:[],
                order_id:[],
                modal_data:{},
                modal_data:[],

                permissions: [],
                urlApi: "/api/required_stock",
                urlApis: "/api/required_stock",

                resource: "/required_stock",
                small: "required_stock",
                capital: "Required Items Stock",
                columns: [
                    {label: 'S.No', field: 'id', format: 'index'},
                    {label: 'Sku ', field: 'sku'},
                    {label: 'barcode', field: 'barcode',},
                    {label: 'Product', field: 'title'},
                    {label: 'Product Images', field: 'images' , slot:true},

                    {label: 'Qty Reqiured(in order)', field: 'ordered_qty',},
                    {label: 'Qty Available', field: 'inventory_qty',},
                    // {label: 'Purchase Reqiured', field: 'ordered_qty' },
                    {label: 'Purchase Reqiured', field: 'Po_required' , slot:true},
                    {label: 'New Quantity', field: 'new_qty' , slot:true},





                    // {label: 'Price', field: 'price',},
                    {label: 'Details', field: 'details', slot:true},
                    {label: 'Action', field: 'action', action: true},

                    ]
            }
        },



        created() {
            this.permissions = window.apex.user.permission
        },



        methods: {
            clearsupp(){
                this.form.supplier = null
                this.form.supplier_id = null
                this.urlApi = this.urlApis
                setTimeout(() => {

                    this.$refs.TableData.reload();
                }, 100)

            },
            onSupplier(e) {
                const supplier = e.target.value
                this.form.supplier = supplier
                this.form.supplier_id = supplier.id
                this.filter(this.form.supplier_id)


            },
            filter(e){

                setTimeout(() => {
                    this.urlApi = this.urlApis
                }, 100)
                setTimeout(() => {
                    this.urlApi += '?id=' + e
                }, 100)
                setTimeout(() => {

                    this.$refs.TableData.reload();
                }, 100)
                // byMethod('get', '/api/required_stock?id=' +e).then((res) => {


                // })
            },
            generateReport () {
            this.$refs.html2Pdf.generatePdf()
        },


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

                        onProgress(e) {

                        // console.log(e, 'e');

                        },


                           close() {
                this.show = false,
                    this.show_image_modal = false
            },

            image_model(e) {


                // console.log(e);
                this.modal_data = e,
                byMethod('get', '/api/product_details?id=' +e.product_id).then((res) => {
                        // console.log(res.data.data);
                        this.order_id = res.data.data,
                    this.show = true,
                        this.show_image_modal = true
                })
            },

            isChecked(e , id) {
        // console.log(e);
        if (this.download.includes(e)) {
            this.download.splice(this.download.indexOf(e), 1);

        } else {
            this.download.push(e);
        }

        if (this.ids.includes(id)) {
            this.ids.splice(this.ids.indexOf(id), 1);

        } else {
            this.ids.push(id);
        }
    },
            // isChecked(e) {
            //     return this.download = e;
            // },

            downloadimage(){
                // console.log(this.download);
                // console.log(this.ids);


                byMethod('get', '/api/download_images?id=' +this.download).then((res) => {
                    const zipPath = res.data.zipPath;

                    const downloadUrl = '/download_zip/' + encodeURIComponent(zipPath);

                    window.open(downloadUrl, '_blank');
                })

            },

            downloadImage() {
                // console.log(this.download);
    byMethod('get', '/api/download_images?id=' + this.ids).then((res) => {
        this.model = res.data.data.data;
        this.vendor = res.data.id;

        // console.log(res.data.id);

        this.download.forEach((item, index) => {
            const image = new Image();
            image.src = `uploads/product/img/${item.product_image}`;

            image.onload = () => {
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.width = image.width;
                canvas.height = image.height;

                context.drawImage(image, 0, 0);

                const productData = this.model[index];
                if (productData) {
                    const title = `Title: ${productData.title}`;
                    const barcode = `Barcode: ${productData.barcode}`;
                    const purchasesLabel2 = `Supplier: ${productData.purchases[0].purchase.supplier.name}`;
                    const purchasesLabel3 = `Purchase Qunatity: ${ this.download[index].new_qty}`;

                    const purchasesLabel = 'Last 3 Purchases';


                    context.font = 'bold 18px Arial';
                    context.fillStyle = 'white';
                    context.fillText(title, 10, 30);

                    context.font = 'bold 18px Arial';
                    context.fillText(barcode, 10, 50);
                    context.font = 'bold 16px Arial';
                    context.fillText(purchasesLabel2, 10, 70);
                    context.font = 'bold 16px Arial';
                    context.fillText(purchasesLabel3, 10, 90);
                    context.font = 'bold 16px Arial';
                    context.fillText(purchasesLabel, 10, 110);



                    let offsetY = 140; // Initial Y-coordinate for purchase info

                    if (productData.purchases && productData.purchases.length > 0) {
                        productData.purchases.forEach(purchase => {
                            const purchaseInfo = `Date: ${purchase.created_at}`;
                            context.font = '14px Arial';
                            context.fillText(purchaseInfo, 10, offsetY);

                            const purchaseInfo2 = `Quantity : ${purchase.qty}`;
                            context.font = '14px Arial';
                            context.fillText(purchaseInfo2, 10, offsetY + 20);

                            const purchaseInfo3 = `Price : ${purchase.unit_price}`;
                            context.font = '14px Arial';
                            context.fillText(purchaseInfo3, 10, offsetY + 40);



                            offsetY += 120;
                        });
                        offsetY += 20;
                    }
                }

                const link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = `image_${item.product_id}.png`;
                link.click();
            };
        });
    });
},


            downloadImagessss() {
                byMethod('get', '/api/download_images?id=' +this.ids).then((res) => {
                        this.model = res.data.data.data;
                    this.download.forEach((item, index) => {

                const image = new Image();
                image.src = `uploads/product/img/${item.product_image}`;

                image.onload = () => {
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    canvas.width = image.width;
                    canvas.height = image.height;

                    context.drawImage(image, 0, 0);


                    const productData = this.model[index];
                if (productData) {
                    const title = `Title: ${productData.title}`;
                    const barcode = `Barcode: ${productData.barcode}`;
                    const Purchases = ' Last 3 Purchases';


                    context.font = '18px Arial';
                    context.fillStyle = 'white';
                    context.fillText(title, 10, 30);

                    context.font = '18px Arial';
                    context.fillText(barcode, 10, 50);
                    context.font = '18px Arial';
                    context.fillText(Purchases, 10, 70);


                    if (productData.purchases && productData.purchases.length > 0) {
                        productData.purchases.forEach(purchase => {
                            const purchaseInfo = `Date: ${purchase.purchase.po_date}`; // Customize with your purchase data
                            context.font = '14px Arial';
                            context.fillText(purchaseInfo, 10, 90);

                            const purchaseInfo2 = `Quantity : ${purchase.qty}`; // Customize with your purchase data
                            context.font = '14px Arial';
                            context.fillText(purchaseInfo2, 10, 110);// Adjust the Y coordinate as needed

                            const purchaseInfo3 = `Price : ${purchase.unit_price}`; // Customize with your purchase data
                            context.font = '14px Arial';
                            context.fillText(purchaseInfo3, 10, 130);
                        });
                    }

                    // const purchaseInfo = `Date: ${productData.purchases.purchase.po_date}`; // Customize with your purchase data
                            // context.font = '14px Arial';
                            // context.fillText(purchaseInfo, 10, 90);

                            // const purchaseInfo2 = `Quantity : ${productData.purchases.qty}`; // Customize with your purchase data
                            // context.font = '14px Arial';
                            // context.fillText(purchaseInfo2, 10, 110);// Adjust the Y coordinate as needed

                            // const purchaseInfo3 = `Price : ${productData.purchases.unit_price}`; // Customize with your purchase data
                            // context.font = '14px Arial';
                            // context.fillText(purchaseInfo3, 10, 130);

                    // ...
                }


                    //     const text = `Product ID: ${items.title}`;

                    // context.font = '24px Arial';
                    // context.fillStyle = 'white';
                    // context.fillText(text, 10, 30);

                    // const additionalText1 = 'Purchases';
                    // const additionalText2 = `Barcode: ${items.barcode}`;
                    // context.font = '18px Arial';
                    // context.fillText(additionalText1, 10, 60);
                    // context.fillText(additionalText2, 10, 90);




                    const link = document.createElement('a');
                    link.href = canvas.toDataURL(`uploads/product/img/${item.product_image}`);
                    link.download = `image_${item.product_id}.png`;
                    link.click();
                };
            });
        })


    //             this.download.forEach(item => {
    //     const link = document.createElement('a');
    //     link.href = `uploads/product/img/${item.product_image}`;
    //     link.download = `image_${item.product_id}.png`;
    //     link.click();
    // });


    },

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
    transform: scale(2.6);

}
</style>

