<template>
    <div>
        <div class="bg-gray-100 py-4">
            <nav class="container mx-auto flex justify-center">
                <a @click="showRecords('?status_id=0')"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-blue-500 focus:text-gray-700 focus:border-blue-300">
                    All
                </a>
                <a @click="showRecords('?status_id=1')"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-yellow-500 focus:text-gray-700 focus:border-yellow-300">
                    Pending
                </a>
                <a @click="showRecords('?status_id=2')"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-purple-500 focus:text-gray-700 focus:border-purple-300">
                    Confirmed
                </a>
                <a @click="showRecords('?status_id=6')"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-green-500 focus:text-gray-700 focus:border-green-300">
                    On Hold
                </a>
                <a @click="showRecords('?status_id=14')"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-rose-500 focus:text-gray-700 focus:border-rose-300">
                    Fake
                </a>
                <a @click="showRecords('?packability=packable')"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-orange-500 focus:text-gray-700 focus:border-orange-300">
                    Packable
                </a>
                <a @click="showRecords('?packability=unpackable')"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-lime-500 focus:text-gray-700 focus:border-lime-300">
                    Unpackable
                </a>
            </nav>
        </div>
        <div class="px-4 py-5  sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ capital }}</h3>
            <div class="mt-3 pb-4 sm:mt-0 sm:ml-4 flex justify-end">
                <router-link :to="{name:`create-${small}`}"
                             class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                             type="button">
                    Create Order
                </router-link>
                <button @click='toggle = !toggle'
                        class="ml-1 buttonn inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                        type="button">
                    Advaced Search
                </button>
            </div>
        </div>
        <div class="bg-gray-200 p-4" v-show='toggle'>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center ">
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-1">Customer</label>
                    <typeahead :initialize="form.customer" :url="customers" @input="onCustomer" display="name"/>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-1">Shipper</label>
                    <typeahead :initialize="form.shipped_by" :url="shipped" @input="onshippedby" display="name"/>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-1">Status</label>
                    <typeahead :initialize="form.deliver" :url="delivery" @input="onDeliverySearch" display="name"/>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-1">City</label>
                    <typeahead :initialize="form.city" :url="city" @input="onCity" display="name"/>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-1">Order Type</label>
                    <typeahead :initialize="form.ordertype" :url="ordertype" @input="onOrder_type" display="name"/>
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-1">Discount</label>
                    <div class="relative">
                        <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:border-blue-300"
                                v-model="form.discount">
                            <option value="Applied">Applied</option>
                            <option value="NotApplied">Not Applied</option>
                        </select>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-1">Packing Status</label>
                    <select
                        class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:border-blue-300"
                        name="payment-status" v-model="form.packability">
                        <option value="packable">packable</option>
                        <option value="unpackable">unpackable</option>
                    </select>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-1">Shipping Charges</label>
                    <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:border-blue-300"
                            v-model="form.discount">
                        <option value="Applied">Applied</option>
                        <option value="NotApplied">Not Applied</option>
                    </select>
                </div>
                <div class="w-full sm:w-1/2 pl-2 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-1 capitalize">Payment Status</label>
                    <select
                        class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:border-blue-300"
                        name="payment-status" v-model="form.payment_status">
                        <option value="0">Paid</option>
                        <option value="1">Unpaid</option>
                    </select>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-1 capitalize">Quantity</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Quantity" type="number" v-model="form.quantity"/>
                </div>
            </div>
            <button
                @click="onSearch()"
                class="mt-4 inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-4 py-2 leading-5 text-sm border-gray-200 bg-red-500 hover:bg-red-600 text-white focus:outline-none focus:ring focus:ring-red-300"
                type="button">
                Search
            </button>
        </div>

        <div class="flex-col ">
            <panel :columns="columns" :urlApi="urlApi" ref="TableData" >
                <template v-slot:statuses="props" >
                    <button class="button" :style="{ background: props.item.status.color } " @click="shows(1 ,props.item.id) ">
                        {{ props.item.status ? props.item.status.name :''}}
                    </button>
                    <div v-if="props.item.status.id == 9">
                        <button class="button bg-gray-400 mt-2" @click="generateCN">
                            Generate CN
                        </button>
                    </div>
                    <div v-if="sts && props.item.id == ids">
                        <div>
                            <button class="buttonHide"
                                @click="Cancel()"
                                style="width:50% ; height: 70%; background-image: linear-gradient(90deg,#975252,rgb(197,13,13)); font-weight: bold;">
                                Hide
                            </button>
                        </div>
                        <typeahead :initialize="form.deliver" :url="delivery+'?head=order&id='+ props.item.status.id"
                                   @input="onDelivery($event ,props.item.id)" display="name" v-if="props.item.packability == 'packable' " />
                        <span v-else > {{'This Order Not Packable'}}</span>
                    </div>
                </template>
                <template v-slot:customers="props" >
                    <div>
                        <p>{{props.item.name}}</p>
                            <!-- <p><i v-if="props.item.phone" class="fas fa-phone text-black"></i> {{props.item.phone}}</p>
                            <p><i v-if="props.item.email" class="fas fa-envelope text-black"></i> {{props.item.email}}</p> -->
                    </div>
                </template>
                <template v-slot:company="props" >
                    <div>
                        <img :src="`/uploads/company/logo/${props.item.stores.company.logo}`" class="shadow-xl h-10 w-10 rounded-full"/>
                        <!-- <p class="h-8 w-8">{{props.item.company.logo}}</p> -->
                        <!-- <p>{{props.item.stores.name}}</p> -->
                    </div>
                </template>

                <template v-slot:store="props" >
                    <div v-if="props.item.stores.plate_form == 'Shopify'">
                        <img src="~@/images/Shopify-bag.png" class="h-10 w-10 rounded-full shadow-xl"/>
                    </div>
                    <div v-if="props.item.stores.plate_form == 'WooCommerce'">
                        <img src="~@/images/WooCommerce.png" class="h-10 w-10 rounded-full shadow-xl"/>
                    </div>
                    <div v-if="props.item.stores.plate_form == 'MimCart'">
                        <img src="~@/images/MimCart.jpg" class="h-10 w-10 rounded-full shadow-xl"/>
                    </div>
                    <!-- <p>{{props.item.stores}}</p> -->
                </template>

                <template v-slot:courier="props">
                    <typeahead :initialize="props.item.shipped_by" :url="courier"
                               @input="onShipped($event , props.item)" display="name"/>
                </template>
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
                        <a
                            @click.prevent="showss(props.item.id)"
                            href="#"
                        >
                        <svg class="h-5 w-5 "  xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
                        </a>
                        <!-- <a>
                            <i class="fas fa-file-export pl-1"></i>
                        </a> -->
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
            Panel, Typeahead,
        },
        name: "Index",
        data() {
            return {
                toggle: false,
                sts: false,
                id: null,
                ids: null,
                permissions: [],
                urlApi: "/api/order",
                urlApi1: "/api/order",
                resource: "/order",
                delivery: '/api/status',
                courier: '/api/courier',
                customers: '/api/customer',
                ordertype: '/api/order_type',
                city: '/api/city',
                small: "order",
                capital: "Order",
                columns: [
                    {label: 'S.No', field: 'id', format: 'index'},
                    // {label: 'Sales Number', field: 'so_number'},
                    {label: 'Customer', field: 'customers', slot: true},
                    {label: 'Status', field: 'statuses', slot: true},
                    {label: 'Company', field: 'company', slot: true},
                    {label: 'Store', field: 'name', displayText: 'stores'},
                    {label: 'City', field: 'name', displayText: 'city'},
                    {label: 'Net Amount', field: 'total'},
                    {label: 'Packing Status', field: 'packability'},
                    // {label: 'Order Date', field: 'order_date'},
                    {label: 'Courier By', field: 'courier', slot: true},
                    {label: 'Action', field: 'action', action: true},
                ]
            }
        },
        created() {
            this.permissions = window.apex.user.permission
        },
        methods: {
            Cancel() {
                this.sts = false;
                this.form.deliver = null;
            },
            shows(e, status_id) {
                this.sts = true;
                this.ids = status_id;
                this.id = e
            },
            Update(e, id) {
                byMethod('POST', '/api/update?ids=' + id, e).then(res => {
                    if (res.data.saved) {
                        this.sts = false,
                            this.form.deliver = null;
                        this.$refs.TableData.reload();
                    }
                })
            },
            onDelivery(e, id) {
                const deliver = e.target.value
                this.form.deliver = deliver
                this.form.deliver_id = deliver.id
                this.Update(this.form.deliver, id);
            },
            onDeliverySearch(e, id) {
                const deliver = e.target.value
                this.form.deliver = deliver
                this.form.deliver_id = deliver.id
            },
            onShipped(e, f) {
                console.log(e,f)
                const shipped_by = e.target.value
                f.shipped_by = shipped_by
                f.shipped_by_id = shipped_by.id
                byMethod('POST', `/api/order/${f.id}?_method=PUT`, f)
            },
            onCustomer(e) {
                const customer = e.target.value
                this.form.customer = customer
                this.form.name = customer.name
                this.form.email = customer.email
                this.form.phone = customer.phone
                this.form.s_addres_1 = customer.s_address_1
                this.form.customer_id = customer.id
            },
            onshippedby(e) {
                const shipped_by = e.target.value
                this.form.shipped_by = shipped_by
                this.form.shipped_by_id = shipped_by.id
            },
            onOrder_type(e) {
                const ordertype = e.target.value
                this.form.ordertype = ordertype
                this.form.order_type_id = ordertype.id
            },
            onCity(e) {
                const city = e.target.value
                this.form.city = city
                this.form.cities = city.id
            },
            edit(id) {
                this.$router.push(`${this.resource}/${id}/edit`)
            },
            showss(id) {
                this.$router.push(`${this.resource}/${id}/show`)
            },
            deleteRole(e) {
                byMethod('delete', `/api/order/${e}`)
                    .then((res) => {
                        // console.log(res);
                        if (res.data.deleted) {
                            this.$refs.TableData.reload();
                            this.$toast.error(this.capital + " Deleted successfully!");
                        }
                    })
            },
            showRecords(e) {
                setTimeout(() => {
                    this.urlApi = this.urlApi1
                }, 500)
                setTimeout(() => {
                    this.urlApi += e
                    // this.urlApi += '?status_id=' + e
                }, 500)
                setTimeout(() => {
                    // console.log(this.$refs);
                    this.$refs.TableData.reload();
                }, 500)
            },
            onSearch() {
                setTimeout(() => {
                    this.urlApi = this.urlApi1
                }, 500)
                setTimeout(() => {
                    let param = "?q=";
                    if (this.form.customer != null) {
                        param += `&customer_id=${this.form.customer_id}`;
                    }
                    if (this.form.city != null) {
                        param += `&city_id=${this.form.city_id}`;
                    }
                    if (this.form.ordertype != null) {
                        param += `&order_type_id=${this.form.order_type_id}`;
                    }
                    if (this.form.shipped_by != null) {
                        param += `&shipped_by_id=${this.form.shipped_by_id}`;
                    }
                    if (this.form.discount != null) {
                        param += `&discount=${this.form.discount}`;
                    }
                    if (this.form.packability != null) {
                        param += `&packability=${this.form.packability}`;
                    }
                    if (this.form.payment_status != null) {
                        param += `&payment_status=${this.form.payment_status}`;
                    }
                    this.urlApi += param
                    // this.urlApi += '?status_id=' + e
                }, 500)
                setTimeout(() => {
                    // console.log(this.$refs);
                    this.$refs.TableData.reload();
                }, 500)

            },
            generateCN(){
                console.log('cn print')
            }

        },
    }
</script>
<style scoped>

    .button {
        font-weight: bold !important;
        border-radius: .25rem;
        text-transform: uppercase;
        font-style: normal;
        font-weight: 400;
        padding-left: 15px;
        padding-right: 15px;
        color: #fff;
        /* -webkit-clip-path: polygon(0 0, 0 0, 100% 0, 100% 0, 100% calc(100% - 15px), calc(100% - 15px) 100%, 15px 100%, 0 100%); */
        /* clip-path: polygon(0 0, 0 0, 100% 0, 100% 0, 100% calc(100% - 15px), calc(100% - 15px) 100%, 15px 100%, 0 100%); */
        height: 30px;
        font-size: 0.7rem;
        line-height: 14px;
        letter-spacing: 1.2px;
        transition: .2s .1s;
        border: 0 solid;
        overflow: hidden;
    }

    .button:hover {
        cursor: pointer;
        transition: all .3s ease-in;
        padding-right: 30px;
        padding-left: 30px;
    }

    .buttonHide {
        font-weight: bold !important;
        border-radius: .25rem;
        text-transform: uppercase;
        font-style: normal;
        font-weight: 400;
        padding-left: 15px;
        padding-right: 15px;
        color: #fff;
        -webkit-clip-path: polygon(0 0, 0 0, 100% 0, 100% 0, 100% calc(100% - 15px), calc(100% - 15px) 100%, 15px 100%, 0 100%);
        clip-path: polygon(0 0, 0 0, 100% 0, 100% 0, 100% calc(100% - 15px), calc(100% - 15px) 100%, 15px 100%, 0 100%);
        height: 30px;
        font-size: 0.7rem;
        line-height: 14px;
        letter-spacing: 1.2px;
        transition: .2s .1s;
        border: 0 solid;
        overflow: hidden;
    }

    .buttonHide:hover {
        cursor: pointer;
        transition: all .3s ease-in;
        padding-right: 30px;
        padding-left: 30px;
    }

    .buttonn {
        font-weight: bold !important;
        border-radius: .25rem;
        text-transform: uppercase;
        font-style: normal;
        font-weight: 400;
        padding-left: 25px;
        padding-right: 25px;
        color: #fff;
        /* -webkit-clip-path: polygon(0 0, 0 0, 100% 0, 100% 0, 100% calc(100% - 15px), calc(100% - 15px) 100%, 15px 100%, 0 100%); */
        /* clip-path: polygon(0 0, 0 0, 100% 0, 100% 0, 100% calc(100% - 15px), calc(100% - 15px) 100%, 15px 100%, 0 100%); */
        height: 40px;
        font-size: 0.7rem;
        line-height: 14px;
        letter-spacing: 1.2px;
        transition: .2s .1s;
        border: 0 solid;
        overflow: hidden;
    }

    .buttonn:hover {
        cursor: pointer;
        transition: all .3s ease-in;
        padding-right: 30px;
        padding-left: 30px;
    }


    .uiverse {
        position: relative;

        padding: 15px;
        margin: 10px;
        border-radius: 10px;
        width: 80px;
        height: 40px;
        font-size: 17px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;

        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .uiverse:hover .tooltip {
        top: -45px;
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    svg:hover span,
    svg:hover .tooltip {
        text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.1);
    }

    .uiverse:hover,
    .uiverse:hover .tooltip,
    .uiverse:hover .tooltip::before {
        /* background: linear-gradient(320deg, rgb(3, 77, 146), rgb(0, 60, 255)); */
        background: #fff;
        color: #ffffff;
    }

/* .tooltip-container {
    position: relative;
    display: inline-block;
}

.tooltip-trigger {
    cursor: pointer;
}

.tooltip-content {
    visibility: hidden;
    background-color: #f3f4f6;
    color: #fff;
    text-align: center;
    border-radius: 4px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    bottom: -20%;
    left: 580%;
    transform: translateX(-50%);
    opacity: 0;
    transition: opacity 0.3s, visibility 0.3s;
}

.tooltip-container:hover .tooltip-content {
    visibility: visible;
    opacity: 1;
} */


</style>
