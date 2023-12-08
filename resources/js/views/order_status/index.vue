<template>
    <div class="p-3">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center border-b-2 border-gray-200 w-full">
    <h3 class="text-2xl leading-3 font-medium text-gray-900">{{ capital }}</h3>
</div>
<div class=" pl-4 pt-3">
    <label class="block font-medium text-sm text-gray-700 mb-2">
        Message
    </label>
    <div class="w-full">
    
        <textarea name=""  class="w-full bg-white border border-gray-300 text-gray-700 py-4 px-4 rounded leading-tight focus:outline-none focus:border-gray-500"></textarea>
    </div>
    
</div>
<div class="  pl-4 pt-3">
    <label class="block font-medium text-sm text-gray-700 mb-2">
        Response
    </label>
    <div class="w-full">
    
        <textarea name=""  class="w-full bg-white border border-gray-300 text-gray-700 py-4 px-4 rounded leading-tight focus:outline-none focus:border-gray-500"></textarea>
    </div>
    
</div>
        <div class="flex lg:flex-row mb-2 mt-2 pl-3 md:w-full md:flex-row flex-col flex-no-wrap">
           
            <div class="w-full md:w-1/2  mb-4 md:mb-0 p-2">
    <label class="block font-medium text-sm text-gray-700 mb-2">
        Stock Qty:
    </label>
    <div class="relative">
        <select class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:border-gray-500">
            <option value="">None</option>
            <option value="">Plus</option>
            <option value="">Minus</option>
        </select>
   
    </div>
</div>

<div class="w-full  mb-4 md:w-1/2 md:mb-0 p-2">
    <label class="block font-medium text-sm text-gray-700 mb-2">
        Sort:
    </label>
    <div class="relative">
        <input type="number" class="block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded leading-tight focus:outline-none focus:border-gray-500">
    </div>
</div>
<div class="w-full  mb-4 md:w-1/2  p-2 ">
    <label class="block font-medium text-sm text-gray-700 mb-2">
        Order Status Title:
    </label>
    <div class="relative flex">
        <input type="text" class="block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded leading-tight focus:outline-none focus:border-gray-500">
        <button class=" px-3 py-2 bg-blue-400 hover:bg-blue-500 text-white rounded">Save</button>
    </div>
</div>
        </div>
        <div class="flex-col">
            <panel :columns="columns" :urlApi="urlApi" ref="TableData" :searchEnable="false">
                <template v-slot:sortes="props">
                    <div class="w-full sm:w-full md:w-full lg:w-3/6">
                    <input type="number" class="block w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded leading-tight focus:outline-none focus:border-gray-500">
                    </div>
                </template>
                <template v-slot:emailes="props">
                    <div>
                        <input
                type="checkbox"
                id="switch2"
                :checked="props.item.email === 1" 
                @change="updateEmail(props.item,props.item.id)"
                name="switch2"
                class="h-7 w-12 rounded-full text-primary-500 transition-all duration-150 ease-out form-switch focus:ring focus:ring-primary-500 focus:ring-opacity-50 dark:bg-gray-700 dark:ring-offset-gray-900 dark:checked:bg-current"/>
                    </div>
                </template>
                <template v-slot:smses="props">
                    <div>
                        <input
                type="checkbox"
                id="switch2"
                :checked="props.item.sms === 1" 
                @change="updateSms(props.item,props.item.id)"
                name="switch2"
                class="h-7 w-12 rounded-full text-primary-500 transition-all duration-150 ease-out form-switch focus:ring focus:ring-primary-500 focus:ring-opacity-50 dark:bg-gray-700 dark:ring-offset-gray-900 dark:checked:bg-current"/>
                    </div>
                </template>
                
                <template v-slot:actives="props">
                    <div>
                        <input
                type="checkbox"
                id="switch2"
                :checked="props.item.active === 1" 
                @change="updateActive(props.item,props.item.id)"
                name="switch2"
                class="h-7 w-12 rounded-full text-primary-500 transition-all duration-150 ease-out form-switch focus:ring focus:ring-primary-500 focus:ring-opacity-50 dark:bg-gray-700 dark:ring-offset-gray-900 dark:checked:bg-current"/>
                    </div>
                </template>
                <template v-slot:sale_ons="props">
                    <div>
                        <input
                type="checkbox"
                id="switch2"
                :checked="props.item.sales_on === 1" 
                @change="updateSale(props.item,props.item.id)"
                name="switch2"
                class="h-7 w-12 rounded-full text-primary-500 transition-all duration-150 ease-out form-switch focus:ring focus:ring-primary-500 focus:ring-opacity-50 dark:bg-gray-700 dark:ring-offset-gray-900 dark:checked:bg-current"/>
                    </div>
                </template>
                
                <template v-slot:action="props">

                    <div class="text-sm font-medium flex">
            <span>
              <a @click.prevent="edit(props.item.id, props.item.couriers[0].id, props.item.couriers[0].pivot ? props.item.couriers[0].pivot.delivery_charges : delivery_charges)"
                 href="#">
                <!-- <i class="fa-solid fa-check-double text-2xl text-blue-400"></i> -->
                <svg class="h-6 w-6 text-blue-400" fill="none" stroke="currentColor"
                                 stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" stroke="none"/>
                                <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"/>
                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"/>
                                <line x1="16" x2="19" y1="5" y2="8"/>
                            </svg>
              </a>
            </span> |
            <span>
              <a @click.prevent="edit(props.item.id, props.item.couriers[0].id, props.item.couriers[0].pivot ? props.item.couriers[0].pivot.delivery_charges : delivery_charges)"
                 href="#"
                 >
                <!-- <i class="fa-solid fa-check-double text-2xl text-blue-400"></i> -->
                <svg class="h-6 w-6  text-red-400" fill="none" stroke="currentColor" stroke-linecap="round"
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
    import Typeahead from "@/Components/typeahead/typeahead.vue";

    export default {
        mixins: [form],
        components: {
            Panel,
            Typeahead,
        },
        name: "Index",
        data() {
            return {
                isSubmitting: false,
                permissions: [],
                // form: {
                //     delivery_charges: "",
                //     shipping_charges: "0.00",
                // },
                urlApi: "/api/order_status",
                small: "Order Status",
                capital: "Order Status",
                columns: [
                    {label: "S.No", field: "id", format: "index"},
                    {label: "Title", field: "name", },
                    {label: "Response", field: "response"},
                    {label: "Message", field: "message"},
                    {label: "Stock Qty", field: "stock_qty", slot:true},
                    {label: "Sort", field: "sortes",slot:true},
                    {label: "Email", field: "emailes", slot:true},
                    {label: "Sales On", field: "sale_ons",slot:true},
                    {label: "SMS", field: "smses", slot:true},
                    {label: "Active", field: "actives",slot:true},
                    {label: "Action", field: "action", action: true},
                ],
            };
        },
        created() {
            this.permissions = window.apex.user.permission;
        },
        methods: {
            formSubmitted() {
                this.isSubmitting = true; // Disable the button and show the spinner
                byMethod("post", "/api/store_cities", this.form).then((res) => {
                    if (res.data.error) {
                        // this.$swal('Quantity cannot be greater than available product quantity for any item!');
                        this.$toast.open({
                            position: 'top-right',
                            message: 'Quantity cannot be greater than available product quantity for any item!',
                            type: 'error',
                            duration: 3000
                        });
                    } else {
                        // successfull(res)
                        this.$toast.open({
                            position: 'top-right',
                            message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                            type: 'success',
                            duration: 3000
                        });
                    }
            })
                    .finally(() => {
                        this.isSubmitting = false; // Enable the button and hide the spinner
                    });
                },
       
            edit(id, courier_id, charges) {
                byMethod("post", `/api/store_cities?city_id=${id}&courier_id=${courier_id}&shipping_charges=${charges}`).then((res) => {
                    if (res.data.saved) {
                        this.$toast.open({
                            position: "top-right",
                            message: "Successful",
                            type: "success",
                            duration: 3000,
                        });
                    }
                });
            },
            deleteRole(e) {
                byMethod("delete", `/api/cities/${e}`).then((res) => {
                    if (res.data.deleted) {
                        this.$refs.TableData.reload();
                        this.$toast.error(this.capital + " Deleted successfully!");
                    }
                });
            },
            updateEmail(item,id){
                let record = {
                data: item.email === 1 ? 0 : 1,
                id: id
            }
             byMethod('POST', '/api/bulk_order_status_email', record).then(res => {
                    this.$refs.TableData.reload();
                    this.$toast.open({
                        position: 'top-right',
                        message: "Email Status Update Successfully",
                        type: 'success',
                        duration: 3000
                    });
                })
            },
            updateSms(item,id){
                let record = {
                data: item.sms === 1 ? 0 : 1,
                id: id
            }
             byMethod('POST', '/api/bulk_order_status_sms', record).then(res => {
                    this.$refs.TableData.reload();
                    this.$toast.open({
                        position: 'top-right',
                        message: "sms Status Update Successfully",
                        type: 'success',
                        duration: 3000
                    });
                })
            },
            updateActive(item,id){
                let record = {
                data: item.active === 1 ? 0 : 1,
                id: id
            }
             byMethod('POST', '/api/bulk_order_status_active', record).then(res => {
                    this.$refs.TableData.reload();
                    this.$toast.open({
                        position: 'top-right',
                        message: "Active Status Update Successfully",
                        type: 'success',
                        duration: 3000
                    });
                })
            },
            updateSale(item,id){
                let record = {
                data: item.sales_on === 1 ? 0 : 1,
                id: id
            }
             byMethod('POST', '/api/bulk_order_status_sale', record).then(res => {
                    this.$refs.TableData.reload();
                    this.$toast.open({
                        position: 'top-right',
                        message: "sales On Status Update Successfully",
                        type: 'success',
                        duration: 3000
                    });
                })
            },
          
         
        },
    };
</script>
<style scoped>
    .tooltip {
        visibility: hidden;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 4px;
        padding: 6px;
        position: absolute;
        z-index: 1;
        bottom: 125%; /* Position the tooltip above the button */
        left: 50%;
        transform: translateX(-50%); /* Center the tooltip horizontally */
        opacity: 0;
        transition: opacity 0.2s;
    }

    .button:hover .tooltip {
        visibility: visible;
        opacity: 1;
    }

</style>
