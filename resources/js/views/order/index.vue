<template>
    <div>
        <div class="bg-gray-100 py-4">
            <nav class="container mx-auto flex justify-center">
                <a @click="showRecords('0')"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-blue-500 focus:text-gray-700 focus:border-blue-300">
                    All
                </a>
                <a @click="showRecords('1')"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-yellow-500 focus:text-gray-700 focus:border-yellow-300">
                    Pending
                </a>
                <a @click="showRecords('2')"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-green-500 focus:text-gray-700 focus:border-green-300">
                    Confirmed
                </a>
                <a @click="showRecords('6')"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-purple-500 focus:text-gray-700 focus:border-purple-300">
                    On Hold
                </a>
                <a @click="showRecords('14')"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-rose-500 focus:text-gray-700 focus:border-rose-300">
                    Fake
                </a>
            </nav>
            <!-- <a @click="showRecords('?packability=packable')"
               class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-orange-500 focus:text-gray-700 focus:border-orange-300">
                Packable
            </a>
            <a @click="showRecords('?packability=unpackable')"
               class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-lime-500 focus:text-gray-700 focus:border-lime-300">
                Unpackable
            </a> -->
        </div>
        <div class="container px-4 py-5  sm:px-6 flex justify-end items-center">
            <div class="mt-3 pb-4 sm:mt-0 sm:ml-4 flex justify-end">
                <router-link :to="{name:`create-${small}`}"
                             class="ml-1 buttonn inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-1 leading-5 text-sm border-gray-200 bg-blue-500 text-white"
                             type="button">
                    Create Order
                </router-link>
                <button @click='toggle = !toggle'
                        class="ml-1 buttonn inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-1 leading-5 text-sm border-gray-200 bg-purple-500 text-white"
                        type="button">
                    Advanced Search
                </button>
                <button
                    @click="bulkCN(selectedItems)"
                    class="ml-1 buttonn inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-1 leading-5 text-sm border-gray-200 bg-green-500 text-white"
                    type="button">Bulk CN Generate
                </button>
<!--                <button-->
<!--                    @click="BulkCourierUpdate"-->
<!--                    class="ml-1 buttonn inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-1 leading-5 text-sm border-gray-200 bg-orange-500 text-white"-->
<!--                    type="button">Bulk Courier Update-->
<!--                </button>-->
<!--                <button-->
<!--                    @click="BulkStatusUpdate"-->
<!--                    class="ml-1 buttonn inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-1 leading-5 text-sm border-gray-200 bg-yellow-500 text-white"-->
<!--                    type="button">Bulk Status Update-->
<!--                </button>-->
<!--                <div class="flex-auto flex flex-col sm:flex-row sm:items-center ">-->
                    <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                        <label class="block font-medium text-sm text-gray-700 mb-1" >Select Courier</label>
                        <typeahead :initialize="selectedcourier" :url="courier" @input="onbulkShippeds($event, selectedcourier)"  display="name" class="ml-3" style="position: absolute; z-index: 9999;"></typeahead>
                    </div>
                    <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                        <label class="block font-medium text-sm text-gray-700 mb-1"  >Select Status</label>
                        <typeahead :initialize="selectedstatus" :url="delivery+'?head=order'" @input="onbulkstatus($event, selectedstatus)"  display="name" class="ml-3" style="z-index: 99999;"></typeahead>
                    </div>
<!--                </div>-->
            </div>
        </div>
        <div class="container px-4 py-5  sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ capital }}</h3>
            <div class="" style="display: contents">
                <a @click="showpackable('packable',pack)"
                   class="w-1/6 sm:mx-auto    py-4 px-6  text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-orange-500 focus:text-gray-700 focus:border-orange-300">
                    Packable
                </a>
                <a @click="showpackable('unpackable',pack)"
                   class="w-1/6 sm:mx-auto  py-4 px-6 text-center border-b-2 font-medium md:mx-auto lg:ml-[-10pc]   text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-lime-500 focus:text-gray-700 focus:border-lime-300">
                    Unpackable
                </a>
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
                    <typeahead :initialize="form.courier" :url="courier" @input="onshippedby" display="name"/>
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
                        <select
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:border-blue-300"
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
                    <select
                        class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:border-blue-300"
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
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Quantity" type="number" v-model="form.quantity"/>
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
            <panel :columns="columns" :urlApi="urlApi" @selectAll="selectAll" ref="TableData">
<!--                   :search-enable="false">-->

                <template v-slot:statuses="props">
                    <!--                    <button :style="{ background: props.item.status.color } " @click="shows(1 ,props.item.id) "-->
                    <!--                            class="button">-->
                    <div>
                        <typeahead :initialize="props.item.status"
                                   :url="delivery+'?head=order&id='+ props.item.status.id"
                                   @input="onStatus($event ,props.item)" display="name"
                                   v-if="props.item.packability == 'packable' "/>
                        <span v-else> {{'This Order Not Packable'}}</span>
                    </div>
                </template>
                <template v-slot:checkbox="props">
                    <div class="text-center">
                        <input :value="props.item.id" class="form-checkbox h-5 w-5 text-blue-500" type="checkbox"
                               v-model="selectedItems"/>
                    </div>
                </template>

                <template v-slot:customers="props">
                    <div>
                        <p v-if="props.item.customer">{{props.item.customer.name}}</p>
                        <p v-else>-</p>
                        <p v-if="props.item.customer && props.item.customer.phone">
                            <i class="fas fa-phone text-black"></i>
                            {{props.item.customer.phone}}
                        </p>
                        <p v-else>-</p>
                        <p v-if="props.item.customer && props.item.customer.email">
                            <i class="fas fa-envelope text-black"></i>
                            {{props.item.customer.email}}
                        </p>
                        <p v-else>-</p>
                        <p v-if="props.item.customer && props.item.customer.b_address_1">
                            {{props.item.customer.b_address_1}}
                        </p>
                        <p v-else>-</p>
                    </div>
                </template>
                <template v-slot:company="props">
                    <div>
                        <!--                        <img :src="`/uploads/company/logo/${props.item.stores.company.logo}`"-->
                        <!--                             class="shadow-xl h-10 w-10 rounded-full"/>-->
                        <img :src="getImagePath(props)" class="shadow-xl h-10 w-10 rounded-full"/>
                        <!-- <p class="h-8 w-8">{{props.item.company.logo}}</p> -->
                        <!-- <p>{{props.item.stores.name}}</p> -->
                    </div>
                </template>
                <template v-slot:store="props">
                    <div v-if="props.item.stores.plate_form == 'Shopify'">
                        <img class="h-10 w-10 rounded-full shadow-xl" src="~@/images/Shopify-bag.png"/>
                    </div>
                    <div v-if="props.item.stores.plate_form == 'WooCommerce'">
                        <img class="h-10 w-10 rounded-full shadow-xl" src="~@/images/WooCommerce.png"/>
                    </div>
                    <div v-if="props.item.stores.plate_form == 'MimCart'">
                        <img class="h-10 w-10 rounded-full shadow-xl" src="~@/images/MimCart.jpg"/>
                    </div>
                </template>
                <template v-slot:couriers="props">
                    <typeahead :initialize="props.item.courier" :url="courier"
                               @input="onShippeds($event, props.item)" display="name"
                               v-if="props.item.city_id && !props.item.tracking_id"/>
                    <div v-else>
                        <span v-if="props.item.courier">{{ props.item.courier.name }}</span><br>
                        <span>CN: {{props.item.tracking_id}}</span>
                    </div>
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
                        <a @click.prevent="generateCN(props.item.id)" href="#"
                           v-if="props.item.status_id == 2 && props.item.courier_id">
                            <svg aria-hidden="true" class="hi-mini hi-banknotes inline-block w-5 h-5"
                                 fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd"
                                      d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                      fill-rule="evenodd"/>
                            </svg>
                        </a>
                        <a @click.prevent="showss(props.item.id)" href="#">
                            <svg class="h-5 w-5 "
                                 height="1em"
                                 viewBox="0 0 576 512"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                            </svg>
                        </a>
                        <a @click="show_msg_modal">
                            <i class="fas fa-message pl-1 pt-1 text-md"></i>
                        </a>
                    </div>
                </template>
            </panel>
        </div>
    </div>
<!--    <template style="width:200px">-->
<!--        <Modal :show="isOpenCourier" :closeable="true" >-->
<!--            <div class="bg-white rounded-lg shadow-lg w-1\2">-->
<!--                <div  style="height: 250px">-->
<!--                    <div class="justify-start bg-gray-100 header-bg-color">-->
<!--                    <h2 class="text-2xl p-3 font-semibold mb-4">Select Courier</h2>-->
<!--                    </div>-->
<!--                    <typeahead :initialize="selectedcourier" :url="courier" @input="onbulkShippeds($event, selectedcourier)" display="name" class="ml-3" style="position: absolute; z-index: 9999;"></typeahead>-->
<!--                </div>-->
<!--                <div class="flex justify-end p-4 bg-gray-100 dark:bg-gray-900">-->
<!--                    <button @click="updateModalCourier" class="px-4 py-2 bg-blue-500 text-white rounded-lg mr-2 hover:bg-blue-600">Save</button>-->
<!--                    <button @click="resetModalCourier" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </Modal>-->
<!--    </template>-->

<!--    <template>-->
<!--        <Modal :show="isOpenStatus" :closeable="true">-->
<!--            <div class="bg-white rounded-lg shadow-lg">-->
<!--                <div  style="height: 200px">-->
<!--                    <div class="justify-start header-bg-color">-->
<!--                        <h2 class="text-2xl p-3 font-semibold bg-gray-100 mb-4 text-gray-700">Select Status</h2>-->
<!--                    </div>-->
<!--                    <typeahead :initialize="selectedstatus" :url="delivery+'?head=order'" @input="onbulkstatus($event, selectedstatus)" display="name" class="ml-3" style="z-index: 99999;"></typeahead>-->
<!--                </div>-->
<!--                <div class="flex justify-end p-4 bg-gray-100 dark:bg-gray-900">-->
<!--                    <button @click="updateModalStatus" class="px-6 py-2 bg-blue-500 text-white rounded-lg mr-2 hover:bg-blue-600">Save</button>-->
<!--                    <button @click="resetModalStatus" class="px-6 py-2 bg-gray-400 text-gray-700 text-white rounded-lg hover-bg-gray-300">Cancel</button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </Modal>-->
<!--    </template>-->
    <Modal :show="show_msg" closeable="true">
        <div class="">
            <h1 class="text-lg font-bold mt-4 mb-4 text-center">Send SMS</h1>
            <!-- <i class="fas fa-cancel" @click="sendMsg"></i> -->
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >Push SMS</label>
                    <textarea
                        class="w-full py-2 px-3 bg-white border border-gray-300 rounded-md"
                        type="text"
                        v-model="form.address"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.address">{{ error.address[0] }}</p>
                </div>
            </div>
            <div class="flex justify-end space-x-4 m-3">
                <button
                    @click="sendMsg"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white hover:bg-red-600  transition duration-200 ease-in-out"
                    type="button">
                    Cancel
                </button>
                <button
                    @click="sendMsg"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white hover:bg-blue-600  transition duration-200 ease-in-out"
                    type="button">
                    Send
                </button>
            </div>
        </div>
    </Modal>
</template>


<script>
    import Panel from "@/components/panel/panel.vue";
    import {form} from "@/libs/mixins";
    import {byMethod, post} from "@/libs/api";
    import Typeahead from "@/Components/typeahead/typeahead.vue";
    import Modal from "@/Components/Modal.vue";
    import {objectToFormData} from "@/libs/helpers";

    export default {
        mixins: [form],
        components: {
            Panel, Typeahead, Modal
        },
        name: "Index",
        data() {
            return {
                selectedcourier: [],
                selectedstatus: [],
                isOpenCourier: false,
                isOpenStatus: false,
                selectedItems: [],
                toggle: false,
                showtype: false,
                showtype1: false,
                show_msg: false,
                sts: false,
                id: null,
                ids: null,
                pack: null,
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
                    {label: 'S.No', field: 'checkbox', slot: true},
                    // {label: 'Sales Number', field: 'so_number'},
                    {label: 'Customer', field: 'customers', slot: true},
                    {label: 'Status', field: 'statuses', slot: true},
                    {label: 'Company', field: 'company', slot: true},
                    {label: 'Store', field: 'name', displayText: 'stores'},
                    {label: 'City', field: 'name', displayText: 'city'},
                    {label: 'Net Amount', field: 'total'},
                    {label: 'Packing Status', field: 'packability'},
                    // {label: 'Order Date', field: 'order_date'},
                    {label: 'Courier', field: 'couriers', slot: true},
                    {label: 'Action', field: 'action', action: true},
                ]
            }
        },
        created() {
            this.permissions = window.apex.user.permission
        },
        methods: {
            resetModalCourier() {
                this.selectedcourier = {}
                this.isOpenCourier = false
            },
            BulkCourierUpdate(data) {
                // this.user_data = {
                //     id: data.id,
                //     roles: data.roles[0]
                // };
                this.isOpenCourier = true
            },
            resetModalStatus() {
                this.selectedstatus = {}
                this.isOpenStatus = false
            },
            BulkStatusUpdate(data) {
                // this.user_data = {
                //     id: data.id,
                //     roles: data.roles[0]
                // };
                this.isOpenStatus = true
            },
            selectAll(e) {
                this.selectedItems = e
            },
            Cancel() {
                this.sts = false;
                this.form.deliver = null;
            },
            shows(e, status_id) {
                this.sts = true;
                this.ids = status_id;
                this.id = e
            },
            updateModalCourier() {
                let data= {
                    selectedItems : this.selectedItems,
                    selectedcourier: this.selectedcourier
                }
                byMethod('POST', '/api/bulk_courier', data).then(res => {
                    this.$refs.TableData.reload();
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode ===  'edit' ? 'Update Successfully' : 'All Courier Generated',
                        type: 'success',
                        duration: 3000
                    });
                  this.resetModalCourier()
                })
            },
            updateModalStatus() {
                let data= {
                    selectedItems : this.selectedItems,
                    selectedstatus: this.selectedstatus
                }
                byMethod('POST', '/api/bulk_status', data).then(res => {
                    this.$refs.TableData.reload();
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode === 'edit' ? 'Update Successfully' : 'All Status Generated',
                        type: 'success',
                        duration: 3000
                    });
                    this.resetModalStatus()
                })

                // post('/api/assign_user_role', this.user_data).then(res => {
                //     this.resetModalCourier()
                // })
            },
            getImagePath(props) {
                if (props.item.stores.company.logo) {
                    return `/uploads/company/logo/${props.item.stores.company.logo}`;
                } else {
                    // If no logo is uploaded, use a default image
                    return "/images/mimsoft.jpg";
                }
            },
            Update(e, id) {
                byMethod('POST', '/api/update?ids=' + id, e).then(res => {
                    if (res.data.saved) {
                        this.sts = false;
                        this.form.deliver = null;
                        this.$refs.TableData.reload();
                    }
                })
            },
            onbulkstatus(e){
                const deliver = e.target.value
                this.selectedstatus = deliver
            },
            onbulkShippeds(e) {
                const courier = e.target.value;
                this.selectedcourier = courier;
            },
            onStatus(e, value) {
                const status = e.target.value
                e.status = status
                e.status_id = status.id
                this.Update(status, value.id);
            },
            onDeliverySearch(e, id) {
                const deliver = e.target.value
                this.form.deliver = deliver
                this.form.deliver_id = deliver.id
            },
            onShipped(e, f, ids) {
                // console.log(e, f)
                const courier = e.target.value
                f.couriers[0] = courier
                ids.courier_id = courier.id
                byMethod('POST', `/api/order/${ids.id}?_method=PUT`, ids)
            },
            onShippeds(e, f) {
                const courier = e.target.value
                f.courier = courier
                f.courier_id = courier.id
                byMethod('POST', `/api/order/${f.id}?_method=PUT`, f)
            },
            onCustomer(e) {
                const customer = e.target.value
                this.form.customer = customer
                this.form.name = customer.name
                this.form.email = customer.email
                this.form.phone = customer.phone
                this.form.b_address_1 = customer.b_address_1
                this.form.customer_id = customer.id
            },
            onshippedby(e) {
                const courier = e.target.value
                this.form.courier = courier
                this.form.courier_id = courier.id
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
                        if (res.data.deleted) {
                            this.$refs.TableData.reload();
                            this.$toast.error(this.capital + " Deleted successfully!");
                        }
                    })
            },
            showRecords(e) {
                this.pack = e
                setTimeout(() => {
                    this.urlApi = this.urlApi1
                }, 500)
                setTimeout(() => {

                    this.urlApi += `?status_id=${this.pack}`;

                    // this.urlApi += '?status_id=' + e
                }, 500)
                setTimeout(() => {
                    this.$refs.TableData.reload();
                }, 500)
            },
            showpackable(packability, e) {

                setTimeout(() => {
                    this.urlApi = this.urlApi1

                }, 500)
                setTimeout(() => {

                    this.urlApi += `?status_id=${e}&packability=${packability}`
                    // this.urlApi += '?status_id=' + e.status_id;
                }, 500)
                setTimeout(() => {
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
                    if (this.form.courier != null) {
                        param += `&courier_id=${this.form.courier_id}`;
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
                    this.$refs.TableData.reload();
                }, 500)

            },
            bulkCN(item) {
                byMethod('POST', '/api/order_single', objectToFormData(item)).then(res => {
                    this.$refs.TableData.reload();
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode === 'edit' ? 'Update Successfully' : 'All CN Generated',
                        type: 'success',
                        duration: 3000
                    });
                })
            },
            generateCN(id) {
                byMethod('GET', `/api/generateCN/${id}`)
                    .then((res) => {
                        // console.log(res.data.data);
                    })
            },
            show_msg_modal() {
                this.show_msg = true
            },
            sendMsg() {
                this.show_msg = false
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
