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
                        <div class="block font-medium text-sm text-gray-700" >
                        <label>Customer</label>
                        <span @click="customerbtn" v-if="permissions.includes(`create-customer`)" class="ml-2 items-right space-x-2 font-semibold text-sm text-blue-400 hover:text-blue-600 cursor-pointer transition duration-200 ease-in-out" style="float: right;">
                            New
                        </span>
                    </div>
                    <typeahead :initialize="form.customer" :url="customers" @input="onCustomer" display="name"/>
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

            <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-1">
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Country:</label>
                    <typeahead :initialize="form.country" :url="countries" @input="onCountries" display="name"/>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >City:</label>
                    <typeahead :initialize="form.city"
                               :url="form.country_id != null ? `/api/city?country_id=${form.country_id}` : cities"
                               @input="onCities($event,'city')" display="name"/>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Store <span class="text-red-600">*</span></label>
                    <typeahead :initialize="form.stores" :url="stores" @input="onStores" display="name"/>
                    <p class="text-red-600 text-xs italic" v-if="error.store_id">{{ error.store_id[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Warehouse
                        </label>
                    <typeahead :initialize="form.warehouse" :url="warehouses" @input="onWarehouse" display="name"/>
                    <p class="text-red-600 text-xs italic" v-if="error.warehouse_id">{{ error.warehouse_id[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Courier
                    </label>
                    <typeahead :initialize="form.courier"
                               :url="couriers"
                               @input="onCourier" display="name"/>
                </div>
            </div>
            <hr class="mt-4">
            <h1 class="font-bold mt-1">Shipping</h1>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Shipping Name </label>
                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="text"
                           v-model="form.s_name"/>
                    <p class="text-red-600 text-xs italic" v-if="error.name">{{ error.name[0] }}</p>
                </div>
<!--                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">-->
<!--                    <label class="block font-medium text-sm text-gray-700 mb-2">Shipping Email </label>-->
<!--                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="email"-->
<!--                           v-model="form.s_email"/>-->
<!--                    <p class="text-red-600 text-xs italic" v-if="error.email">{{ error.email[0] }}</p>-->
<!--                </div>-->
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2"> Shipping Phone </label>
                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="tel"
                           v-model="form.s_phone"/>
                    <p class="text-red-600 text-xs italic" v-if="error.phone">{{ error.phone[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Shipping Address </label>
                    <textarea class="w-full py-2 px-3 bg-white border border-gray-300 rounded-md" type="text"
                              v-model="form.s_address_1"/>
                </div>
            </div>
            <hr class="mt-4">
            <h1 class="font-bold mt-1">Billing</h1>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Billing Name </label>
                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="text"
                           v-model="form.b_name"/>
                    <p class="text-red-600 text-xs italic" v-if="error.name">{{ error.name[0] }}</p>
                </div>
<!--                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">-->
<!--                    <label class="block font-medium text-sm text-gray-700 mb-2">Billing Email </label>-->
<!--                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="email"-->
<!--                           v-model="form.b_email"/>-->
<!--                    <p class="text-red-600 text-xs italic" v-if="error.email">{{ error.email[0] }}</p>-->
<!--                </div>-->
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Billing Phone </label>
                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="tel"
                           v-model="form.b_phone"/>
                    <p class="text-red-600 text-xs italic" v-if="error.phone">{{ error.phone[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Billing Address </label>
                    <textarea class="w-full py-2 px-3 bg-white border border-gray-300 rounded-md" type="text"
                              v-model="form.b_address_1"/>
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-2">
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2"> Instructions </label>
                    <textarea class="w-full py-2 px-3 bg-white border border-gray-300 rounded-md" type="number"
                              v-model="form.instructions"/>
                    <p class="text-red-600 text-xs italic" v-if="error.instructions">{{ error.instructions[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Item Summary </label>
                    <textarea class="w-full py-2 px-3 bg-white border border-gray-300 rounded-md" type="number"
                              v-model="form.item_summary"/>
                    <p class="text-red-600 text-xs italic" v-if="error.item_summary">{{ error.item_summary[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2"> Item Summary Mannual </label>
                    <textarea class="w-full py-2 px-3 bg-white border border-gray-300 rounded-md" type="number"
                              v-model="form.item_summary_mannual"/>
                    <p class="text-red-600 text-xs italic" v-if="error.item_summary_mannual">{{ error.item_summary_mannual[0] }}</p>
                </div>
            </div>
            <div class="border border-gray-200 rounded-lg bg-gray-100 ml-3 mt-4">
                <p class="text-center p-2 font-bold bg-gray-200">Item Details</p>
                <div class="rounded ml-3 mt-4">
                    <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-9 gap-4 mb-4"  v-for="(item,index) in form.items">
                        <div class="sm:col-span-2">
                            <label class="block font-medium text-sm text-gray-700 mb-2">Item Description</label>
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
                            <span class="item-dark">{{ subTotal }}</span>
                        </div>
                        <div class="item-empty align-right"></div>

                        <div class="item-empty align-left panel-title">
                            <span class="item-dark font-semibold">Sub Total</span>
                        </div>
                        <!-- <div class="item-empty align-right panel-title">
                            <span class="item-dark">{{ subTotal }}</span>
                        </div> -->
                        <!-- <div class="item-empty align-right"></div> -->
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
                    @click="formSubmitted" :disabled="isSubmitting"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200  text-white"
                    style="background-color: blue;"
                    type="button">
                    <svg aria-hidden="true" class="inline w-4 h-4 mr-3 text-white animate-spin" fill="none"
                     role="status" v-if="isSubmitting" viewBox="0 0 100 101"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="#E5E7EB"/>
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentColor"/>
                </svg>
                    {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Add" }}
                </button>
                <button
                    @click="successfull()"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white"
                    type="button">
                    Cancel
                </button>
                <Modal :show="showcustomer" closeable="true" @cancel="handleCancelCustomer">
                    <Customer @resp="()=>{showcustomer = !true}" :show="true" additionalProp="global" @save-customer="handleCancelCustomer"  @cancel-customer="handleCancelCustomer" ></Customer>
                </Modal>
            </div>
        </div>
    </div>
</template>

<script>
    import {byMethod, get} from '@/libs/api'
    import {form} from '@/libs/mixins'
    import Modal from "@/Components/Modal.vue";
    import Typeahead from "@/Components/typeahead/typeahead.vue";
    import Customer from "../customer/form.vue";
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
            Typeahead,Customer, Modal
        },
        data() {
            return {
                // dateA: '19-11-13000',
                // dateB: '21-10-2000',
                isProcess: true,
                error: {},
                alert: false,
                isSubmitting: false,
                showcustomer: false,
                // count: null,
                color: 'blue',
                ids: {},
                // show: false,
                resource: '/order',
                store: '/api/order',
                method: 'POST',
                small: 'order',
                capital: 'Order',
                title: 'Add',
                message: 'New order Added',
                permissions:[],
                customers: '/api/customer',
                products: '/api/product',
                stores: '/api/stores',
                warehouses: '/api/warehouse',
                cities: '/api/city',
                countries: '/api/country',
                couriers: "/api/cus_courier",
                // couriers: "/api/courier",
                // ordertype: '/api/order_type',
            }
        },
        created() {
            this.permissions = window.apex.user.permission
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
            // total() {
            //     var total = 0;
            //      var total = (this.subTotal + Number(this.form.mtax_amount));
            //     var total = (this.subTotal + Number(this.form.tax_amount));
            //      Vue.set(this.$data.form, 'tvalue_inc_tax', total);
            //     this.form.value_inc_tax = total;
            //      this.form.tvalue_inc_tax = total;
            //     this.form.value_ex_tax = this.subTotal;
            //      this.form.tvalue_ex_tax = this.subTotal;
            //      Vue.set(this.$data.form, 'tvalue_ex_tax', this.subTotal);
            //     return (total);
            // },
            total() {
                var total = this.form.items.reduce((carry, item) => {
                    return carry + Number(item.value_inc_tax);
                }, 0);
                this.form.value_inc_tax = total;
                this.form.value_ex_tax = this.subTotal;
                return total;
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
                // console.log(i , this.form.city, this.form.city.id);
                if (i && this.form.city) {
                    // console.log('j');
                    byMethod('GET', `/api/get_delivery_charges/${this.form.city.id}?weight=${i}&country_id=${this.form.city.country_id}`)
                }
                this.form.weight = i;
            },
            // onOrder_type(e) {
            //     const ordertype = e.target.value
            //     this.form.ordertype = ordertype
            //     this.form.order_type_id = ordertype.id == 1
            // },
            onCountries(e) {
                const country = e.target.value
                this.form.country = country
                this.form.country_id = country.id
                // console.log(e.target.value);
            },
            customerbtn(){
                this.showcustomer = true;
            },
            handleCancelCustomer() {
                this.showcustomer = false;
            },
            // onCourier(e) {
            //     const courier = e.target.value;
            //     this.form.courier = courier;
            //     this.form.courier_id = courier.id;
            // },
            onCourier(e) {
                const courier = e.target.value;
                this.form.courier = courier;
                this.form.courier_id = courier.id;
            },
            onCities(e) {
                const city = e.target.value
                this.form.city = city
                this.form.city_id = city.id
                if (city.couriers){
                    let f = {
                            target:{
                                value:city.couriers[0]
                            }
                        }
                    this.onCourier(f);
                }
                // console.log(city);
                this.get_charges(this.total_weight);
            },
            onWarehouse(e) {
                const warehouse = e.target.value
                this.form.warehouse = warehouse
                this.form.warehouse_id = warehouse.id
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
                this.form.s_name = customer.s_name

                this.form.s_email = customer.s_email
                this.form.b_name = customer.b_name
                this.form.b_email = customer.b_email
                this.form.b_phone = customer.b_phone
                this.form.s_phone = customer.s_phone
                this.form.s_address_1 = customer.s_address_1
                this.form.b_address_1 = customer.b_address_1
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
                // this.count = 0;
                this.data = [
                    e,
                    this.form.warehouse_id
                ]
                byMethod('POST', '/api/remaining', this.data).then(res => {
                    if (res.data.data == null) {

                        this.ids = e;
                        this.alert = true;
                    } else {

                        this.count = res.data.data;
                    }

                })
            },
            setData(res) {

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
                this.isSubmitting = true;
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

                })
                .finally(() => {
                this.isSubmitting = false; // Enable the button and hide the spinner
                });
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
