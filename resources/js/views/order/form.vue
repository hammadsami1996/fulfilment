<template>
    <div v-if="show">
        <div class="p-2">
            <h1 class="text-lg font-bold mb-4">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: `Add New ${capital}`}}
            </h1>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 pl-3">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Order Date <span class="text-red-600">*</span></label>
                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="date"
                           v-model="form.order_date"/>
                    <p class="text-red-600 text-xs italic" v-if="error.order_date">{{ error.order_date[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Customer <span class="text-red-600">*</span></label>
                    <typeahead :initialize="form.customer" :url="customers" @input="onCustomer" display="name"/>
                                       <p class="text-red-600 text-xs italic" v-if="error.customer_id">{{ error.customer_id[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">External Order No</label>
                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="number"
                           v-model="form.external_order_no"/>
                    <p class="text-red-600 text-xs italic" v-if="error.external_order_no">{{ error.external_order_no[0]
                        }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Tracking ID</label>
                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="number"
                           v-model="form.tracking_id"/>
                    <p class="text-red-600 text-xs italic" v-if="error.tracking_id">{{ error.tracking_id[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2" v-if="$route.meta.mode && $route.meta.mode == 'edit'">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >SO Number:<small>(Auto Generated)</small></label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        disabled
                        placeholder=" SO No."
                        v-model="form.so_number"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.so_number">{{error.so_number[0] }}</p>
                </div>
            </div>

            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">

                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2"> Name </label>
                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="text"
                           v-model="form.name"/>
                    <p class="text-red-600 text-xs italic" v-if="error.name">{{ error.name[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2"> Email </label>
                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="email"
                           v-model="form.email"/>
                    <p class="text-red-600 text-xs italic" v-if="error.email">{{ error.email[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2"> Phone </label>
                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="number"
                           v-model="form.phone"/>
                    <p class="text-red-600 text-xs italic" v-if="error.phone">{{ error.phone[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">City:</label>
                    <typeahead :initialize="form.city" :url="city" @input="onCity"
                               display="name"/>
                    <!--                    <p class="text-red-600 text-xs italic" v-if="error.b_address_2">{{error.b_address_2[0] }}</p>-->
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-2">
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2"> Address </label>
                    <textarea class="w-full py-2 px-3 bg-white border border-gray-300 rounded-md" type="text"
                              v-model="form.s_addres_1"/>
                    <!-- <p class="text-red-600 text-xs italic" v-if="error.address">{{ error.address[0] }}</p> -->
                </div>

                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2"> Instructions </label>
                    <textarea class="w-full py-2 px-3 bg-white border border-gray-300 rounded-md" type="number"
                              v-model="form.instruction"/>
                    <p class="text-red-600 text-xs italic" v-if="error.instruction">{{ error.instruction[0] }}</p>
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-1">
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Store <span class="text-red-600">*</span></label>
                    <typeahead :initialize="form.stores" :url="stores" @input="onStores" display="name"/>
                    <p class="text-red-600 text-xs italic" v-if="error.store_id">{{ error.store_id[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Wearhouse <span class="text-red-600">*</span></label>
                    <typeahead :initialize="form.wearhouse" :url="wearhouses" @input="onWearhouse" display="name"/>
                    <p class="text-red-600 text-xs italic" v-if="error.warehouse_id">{{ error.warehouse_id[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-1">Order Type</label>
                    <typeahead :initialize="form.ordertype" :url="ordertype" @input="onOrder_type" display="name"/>
                </div>
            </div>

            <!-- <div
                class="mt-4 ml-3 border border-gray-200 rounded overflow-x-auto min-w-full bg-white dark:bg-gray-800 dark:border-gray-700">
                <table class="min-w-full text-sm align-middle whitespace-nowrap">
                    <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-700/50">
                        <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-center dark:text-gray-50 dark:bg-gray-700/25">
                            Item Description
                        </th>
                        <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                            Qty
                        </th>
                        <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                            Price
                        </th>
                        <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                            Value Ex.Tax
                        </th>
                        <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                            Tax %
                        </th>
                        <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                            Tax Amount
                        </th>
                        <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                            Value Inc. Tax
                        </th>
                        <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-center dark:text-gray-50 dark:bg-gray-700/25">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="border-b border-gray-100 dark:border-gray-700/50" v-for="(item,index) in form.items">
                        <td class="text-center">
                            <typeahead
                                :initialize="item.product"
                                :url="products"
                                @input="onProduct(item, index, $event)"
                                class="w-64 text-sm rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                display="title"
                            />
                            <span @click="pushroute"
                                  style="color: red; font-weight: bold; margin-right: 120px; cursor: pointer;"
                                  v-if=" count !=null && index == index? count < item.qty :''">Stock Short(Only {{ count }}:Remianing)</span>
                            <span @click="pushroute"
                                  style="color: #ff0000; font-weight: bold; margin-right: 120px; cursor: pointer;"
                                  v-if="alert && ids == item.product_id &&  item.product_id !=null">No Stock Available in this Warehouse</span>

                        </td>
                        <td>
                            <input @blur="caltax(item, index)" @input="caltax(item, index)"
                                   class="w-24 px-2 py-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                   type="number"
                                   v-model="item.qty"
                            >
                        </td>
                        <td>
                            <input @blur="caltax(item, index)" @input="caltax(item, index)"
                                   class="w-24 px-2 py-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                   type="number"
                                   v-model="item.unit_price"
                            >
                        </td>
                        <td>
                            <input @blur="caltax(item,index)" @input="caltax(item, index)"
                                   class="w-24 px-2 py-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                   type="number"
                                   v-model="item.value_ex_tax"
                            >
                        </td>
                        <td>
                            <input @blur="caltax(item,index)" @input="caltax(item, index)"
                                   class="w-24 px-2 py-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                   type="number" v-model="item.tax_percent">
                        </td>
                        <td>
                            <input
                                class="w-24 px-2 py-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                disabled type="number" v-model="item.tax_amount">
                        </td>
                        <td>
                            <input
                                class="w-24 px-2 py-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                type="number" v-model="item.value_inc_tax">
                        </td>
                        <td class=" text-center">
                            <button @click="removeProduct(item,index)"
                                    class="inline-flex items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:opacity-90 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:opacity-75"
                                    type="button">
                                <i class="fa fa-trash mr-1"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="item-empty" colspan="2">
                            <button @click="addNewLine"
                                    class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:bg-yellow-600 text-white font-semibold py-1 px-2 rounded-full inline-flex items-center space-x-1">
                                <i class="fa fa-plus-circle"></i>
                            </button>
                            <span class="text-sm text-gray-600">Total Units: {{ qtySum }} | Total Items: {{ form.items.length }}</span>
                        </td>
                        <td class="item-empty align-right panel-title">
                            <span class="item-dark font-semibold">Sub Total</span>
                        </td>
                        <td class="item-empty align-right panel-title">
                            <span class="item-dark">{{ subTotal}}</span>
                        </td>
                        <td class="item-empty align-right"></td>
                        <td class="item-empty align-right panel-title">
                            <span class="item-dark">{{ tot_tax_amt }}</span>
                        </td>
                        <td class="item-empty align-right panel-title" colspan="1">
                            <span class="item-dark">{{ total }} </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <div class="flex justify-end">
                                <div class="flex items-center space-x-4">
                                    <div class="font-bold">Discount</div>
                                    <div>
                                        <input @input="discountamt(form.discount_percent)"
                                               class="w-24 px-2 py-1 rounded-md rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                               min="0"
                                               placeholder="%"
                                               type="number" v-model="form.discount_percent"/>
                                    </div>
                                    <div>
                                        <input @input="discountper"
                                               class="w-24 px-2 py-1 rounded-md rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                               type="number" v-model="form.discount"/>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4 p-2">
                                    <div class="font-bold">Dilvery Charges</div>
                                    <div>
                                        <input @input="discountamt(form.delivery_charges)"
                                               class="w-24 px-2 py-1 rounded-md rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                               min="0"
                                               type="number" v-model="form.delivery_charges"/>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <table>
                                <tr>
                                    <td class="text-right py-2 pr-4" colspan="4">
                                        <strong class="text-lg text-blue-600">Total</strong>
                                    </td>
                                    <td class="text-lg font-bold py-2">
                                        <strong class="text-red-500">{{ total_discount }}</strong>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div> -->

            <div class="border border-gray-200 rounded-lg bg-gray-100 ml-3 mt-4">
                <p class="text-center p-2 font-bold bg-gray-200">Item Details</p>
                <div class="rounded ml-3 mt-4">
                    <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-9 gap-4 mb-4"  v-for="(item,index) in form.items">
                        <div class="sm:col-span-2">
                            <label class="block font-medium text-sm text-gray-700 mb-2">Item Description</label>
                            <!-- <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="text"/> -->
                            <typeahead
                                :initialize="item.product"
                                :url="products"
                                @input="onProduct(item, index, $event)"
                                class="text-sm rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                display="title"
                            />
                            <span @click="pushroute"
                                  style="color: red; font-weight: bold; margin-right: 120px; cursor: pointer;"
                                  v-if=" count !=null && index == index? count < item.qty :''">Stock Short(Only {{ count }}:Remianing)
                            </span>
                            <span @click="pushroute"
                                  style="color: #ff0000; font-weight: bold; margin-right: 120px; cursor: pointer;"
                                  v-if="alert && ids == item.product_id &&  item.product_id !=null">No Stock Available in this Warehouse
                            </span>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-2">Qty</label>
                            <input @blur="caltax(item, index)" @input="caltax(item, index)"
                                class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                                type="number"
                                v-model="item.qty" />
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-2">Price</label>
                            <input @blur="caltax(item, index)" @input="caltax(item, index)"
                                class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                                type="number"
                                v-model="item.unit_price"
                                />
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-2">Value Ex.Tax</label>
                            <input @blur="caltax(item, index)" @input="caltax(item, index)"
                                class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                                type="number"
                                v-model="item.value_ex_tax"/>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-2">Tax %</label>
                            <input @blur="caltax(item, index)" @input="caltax(item, index)"
                                class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                                type="number"
                                v-model="item.tax_percent"/>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-2">Tax Amount</label>
                            <input class="w-full py-2 px-3 h-8 border border-gray-300 rounded-md" 
                                type="number"
                                disabled 
                                v-model="item.tax_amount"/>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-2">Value Inc. Tax</label>
                            <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" 
                                type="number"
                                v-model="item.value_inc_tax"/>
                        </div>
                        <div class="text-center">
                            <button @click="removeProduct(item,index)"
                                    class="mt-7 inline-flex items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:opacity-90 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:opacity-75"
                                    type="button">
                                <i class="fa fa-trash mr-1"></i>
                            </button>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-9 gap-4 mb-4">
                        <div class="item-empty sm:col-span-3">
                            <button @click="addNewLine"
                                    class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:bg-yellow-600 text-white font-semibold py-1 px-2 rounded-full inline-flex items-center space-x-1">
                                <i class="fa fa-plus-circle"></i>
                            </button>
                            <span class="text-sm text-gray-600 pl-3">Total Units: {{ qtySum }} | Total Items: {{ form.items.length }}</span>
                        </div>
                        <div class="item-empty align-right panel-title">
                            <span class="item-dark font-semibold">Sub Total</span>
                        </div>
                        <div class="item-empty align-right panel-title">
                            <span class="item-dark">{{ subTotal}}</span>
                        </div>
                        <div class="item-empty align-right"></div>
                        <div class="item-empty align-right panel-title">
                            <span class="item-dark">{{ tot_tax_amt }}</span>
                        </div>
                        <div class="item-empty align-right panel-title sm:col-span-2">
                            <span class="item-dark">{{ total }} </span>
                        </div>
                        <div class="sm:col-span-2 item-empty text-gray-100">.</div>
                        <div class="">
                            <p class="font-bold">Discount</p>
                        </div>
                        <div>
                            <input @input="discountamt(form.discount_percent)"
                                class="w-24 px-2 py-1 rounded-md rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                min="0"
                                placeholder="%"
                                type="number" v-model="form.discount_percent"/>
                        </div>
                        <div>
                            <input @input="discountper"
                                   class="w-24 px-2 py-1 rounded-md rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                   type="number" v-model="form.discount"/>
                        </div>
                        <div class="font-bold sm:col-span-2 pl-12">Delivery Charges</div>
                        <div class="">
                            <input @input="discountamt(form.delivery_charges)"
                                   class="w-24 px-2 py-1 rounded-md rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                   min="0"
                                   type="number" v-model="form.delivery_charges"/>
                        </div>
                        <div>
                        </div>
                        <div>
                            <strong class="text-lg text-blue-600">Total</strong>
                            <strong class="text-red-500 pl-3">{{ total_discount }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8 space-x-4">
                <button
                    @click="formSubmitted"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200  text-white"
                    style="background-color: blue;"
                    type="button">
                    {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Add" }}
                </button>
                <button
                    @click="successfull()"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white"
                    type="button">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import {byMethod, get} from '@/libs/api'
    import {form} from '@/libs/mixins'
    import Typeahead from "@/Components/typeahead/typeahead.vue";
    import moment from 'moment';

    function initialize(to) {
        let urls = {
            add: `/api/order/create`,
            edit: `/api/order/${to.params.id}/edit`,
        }
        return urls[to.meta.mode] || urls.add
    }

    export default {
        mixins: [form],
        components: {
            Typeahead,
        },
        data() {
            return {
                isProcess: true,
                error: {},
                alert: false,
                // count: null,
                color: 'blue',
                ids: {},
                show: false,
                resource: '/order',
                store: '/api/order',
                method: 'POST',
                small: 'order',
                capital: 'Order',
                title: 'Add',
                message: 'New order Added',
                permissions: {},
                customers: '/api/customer',
                products: '/api/product',
                stores: '/api/stores',
                wearhouses: '/api/wearhouse',
                city: '/api/city',
                ordertype: '/api/order_type',
            }
        },
        created() {
            this.form.order_date = moment().format('YYYY-MM-DD');
        },
        // watch: {
        //     'form.weight': function (newValue, oldValue) {
        //         // Check if the new value is different from the old value
        //         if (newValue !== oldValue) {
        //             this.get_charges(newValue);
        //         }
        //     }
        // },
        computed: {

            subTotal() {
                return this.form.items.reduce((carry, item) => {
                    return carry + Number(item.unit_price) * Number(item.qty);
                }, 0);
            },
            total() {
                var total = (this.subTotal + Number(this.form.mtax_amount));
                // Vue.set(this.$data.form, 'tvalue_inc_tax', total);
                this.form.tvalue_inc_tax = total;
                this.form.tvalue_ex_tax = this.subTotal;
                // Vue.set(this.$data.form, 'tvalue_ex_tax', this.subTotal);
                return (total);
            },
            qtySum() {
                var total = this.form.items.reduce((carry, item) => {
                    return carry + Number(item.qty);
                }, 0);
                // Vue.set(this.$data.form, "total_units", total);
                this.$data.form.total_units = total;
                return total;
            },
            tot_tax_amt() {
                var total = 0;
                total = this.form.items.reduce((carry, item) => {
                    return carry + Number(item.tax_amount);
                }, 0);
                // Vue.set(this.$data.form, "mtax_amount", total);
                this.form.mtax_amount = total;
                return total;
            },
            total_discount() {
                var final = (this.total - Number(this.form.discount));
                this.form.finaltotal = final;
                // return (this.total - Number(this.form.discount));
                return final;
            },
            total_weight() {
                var total = 0;
                total = this.form.items.reduce((carry, item) => {
                    return carry + Number(item.total_weight);
                }, 0);
                // this.form.weight = total;
                this.get_charges(total);
                return total;
            },
        },

        beforeRouteEnter(to, from, next) {
            get(initialize(to))
                .then((res) => {
                    next(vm => vm.setData(res))
                })
        },
        beforeRouteUpdate(to, from, next) {
            get(initialize(to))
                .then((res) => {
                    this.setData(res);
                    next()
                })
        },
        methods: {
            get_charges(i) {
                console.log(i , this.form.city, this.form.city.id);
                if (i && this.form.city) {
                    console.log('j');
                    byMethod('GET', `/api/get_delivery_charges/${this.form.city.id}?weight=${i}&country_id=${this.form.city.country_id}`)
                }
                this.form.weight = i;
                console.log('i');
                // let e = {
                //     weight : i ,
                //     city_id : this.form.city_id,
                // }
                // byMethod('GET',`/api/get_delivery_charges/weight=${i}&city_id=${this.form.city_id}`)
                // byMethod('POST',`/api/get_delivery_charges/weight=${i}&city_id=${this.form.city_id}`)
                // byMethod('POST',`/api/get_delivery_charges`,e)
            },
            onOrder_type(e) {
                const ordertype = e.target.value
                this.form.ordertype = ordertype
                this.form.order_type_id = ordertype.id
            },
            onCity(e) {
                const city = e.target.value
                this.form.city = city
                this.form.city_id = city.id
                this.get_charges(this.total_weight);
            },
            onWearhouse(e) {
                const wearhouse = e.target.value
                this.form.wearhouse = wearhouse
                this.form.warehouse_id = wearhouse.id
            },
            isSaveDisabled() {
                for (const item of this.form.items) {
                    if (this.count < item.qty) {
                        // isProcess = false;
                        this.color = 'gray'
                        return true;
                    } else {
                        this.color = 'blue';
                    }
                }
                return false;
            },
            addNewLine() {
                if (!this.form.items) {
                    this.form.items = [];
                }
                this.form.items.push({
                    product: null,
                    product_id: null,
                    qty: 1,
                    unit_price: 0,
                    value_ex_tax: 0,
                    tax_percent: 0,
                    tax_amount: 0,
                    value_inc_tax: 0,
                });
            },
            removeProduct(item, index) {
                if (this.form.items.length > 1) {
                    this.form.items.splice(index, 1);
                }
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
            onStores(e) {
                const stores = e.target.value
                this.form.stores = stores
                this.form.store_id = stores.id
            },
            onProduct(item, index, e) {
                this.alert = false;
                const product = e.target.value
                item.product = product
                item.product_id = product.id
                item.unit_price = product.selling_price
                item.quantity = product.quantity
                item.weight = product.weight
                item.total_weight = (item.weight * item.qty);
                this.caltax(item, index);
                this.remain(item.product_id);
            },

            remain(e) {
                // console.log(e);
                // this.count = 0;
                this.data = [
                    e,
                    this.form.warehouse_id

                ]
                byMethod('POST', '/api/remianing', this.data).then(res => {
                    if (res.data.data == null) {
                        // console.log('abcd');
                        this.ids = e;
                        this.alert = true;
                    } else {
                        // console.log('efg')
                        this.count = res.data.data;
                    }
                    // console.log(res.data.data);
                })
            },
            setData(res) {
                // console.log(res);
                this.form = res.data.form;
                if (this.$route.meta.mode == 'edit') {
                    this.store = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
                    this.title = 'Edit';
                    this.message = `${this.capital} has been updated`;
                }
                if (!this.form.items) {
                    this.addNewLine();
                }
                this.form.order_date = moment().format('YYYY-MM-DD');
                this.show = true
            },
            caltax(item) {
                const {qty, unit_price, tax_percent} = item;

                // Calculate and assign values directly to item properties
                // item.total_weight = item.weight * qty;
                item.value_ex_tax = qty * unit_price;
                item.tax_amount = (item.value_ex_tax * tax_percent) / 100;
                item.value_inc_tax = item.value_ex_tax + item.tax_amount;
            },
            discountamt(discount) {
                if (discount > 100) {
                    this.form.discount_percent = 100;

                }
                this.form.discount = this.total * Number(this.form.discount_percent) / 100;
                this.form.discount_percent = Number(((this.form.discount / this.total) * 100).toFixed(2));
                this.isLoading = false;
            },
            discountper() {
                this.form.discount = this.total * Number(this.form.discount_percent) / 100;
            },
            formSubmitted() {
                this.form.selectedPermissions = this.selectedPermissions
                byMethod(this.method, this.store, this.form).then(res => {
                    if (res.data.error) {
                        // this.$swal('Quantity cannot be greater than available product quantity for any item!');
                        this.$toast.open({
                            position: 'top-right',
                            message: 'Quantity cannot be greater than available product quantity for any item!',
                            type: 'error',
                            duration: 3000
                        });
                    } else {
                        this.successfull(res)
                        this.$toast.open({
                            position: 'top-right',
                            message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                            type: 'success',
                            duration: 3000
                        });
                    }
                }).catch(err => {
                    this.error = err.response.data.errors;
                    this.$toast.open({
                        position: 'top-right',
                        message: 'Error',
                        type: 'error',
                        duration: 3000
                    });
                    // console.log(err);
                })
            },
            successfull(res) {
                this.$router.push({path: `${this.resource}`})
            },
            // pushroute() {
            //     this.$router.push({path: `/purchase/create`})
            // }
        },
    }
</script>

<style scoped>

</style>
