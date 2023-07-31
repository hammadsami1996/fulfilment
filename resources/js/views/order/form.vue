<template>
    <div v-if="show">
        <div class="p-2">
            <h1 class="text-lg font-bold mb-4">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: `Add New ${capital}`}}
            </h1>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Order Date *</label>
                    <input class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md" type="date"
                           v-model="form.order_date"/>
                    <p class="text-red-600 text-xs italic" v-if="error.order_date">{{ error.order_date[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">External Order No</label>
                    <input class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md" type="number"
                           v-model="form.external_order_no"/>
                    <p class="text-red-600 text-xs italic" v-if="error.external_order_no">{{ error.external_order_no[0]
                        }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Tracking ID</label>
                    <input class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md" type="number"
                           v-model="form.tracking_id"/>
                    <p class="text-red-600 text-xs italic" v-if="error.tracking_id">{{ error.tracking_id[0] }}</p>
                </div>

                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Customer</label>
                    <typeahead :initialize="form.customer" :url="customers" @input="onCustomer" display="name"/>
                    <p class="text-red-600 text-xs italic" v-if="error.customer_id">{{ error.customer_id[0] }}</p>
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Store</label>
                    <typeahead :initialize="form.stores" :url="stores" @input="onStores" display="name"/>
                    <p class="text-red-600 text-xs italic" v-if="error.store_id">{{ error.store_id[0] }}</p>
                </div>
            </div>
            <div
                class="mt-4 border border-gray-200 rounded overflow-x-auto min-w-full bg-white dark:bg-gray-800 dark:border-gray-700">
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
                                class="w-64  text-sm rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                display="name"
                            />
                        </td>
                        <td>
                            <input @blur="caltax(item, index)" @input="caltax(item, index)"
                                   class="w-12 px-2 py-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
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
                                    class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded inline-flex items-center space-x-2">
                                <i class="fa fa-plus-circle"></i>
                                <span>Add Products</span>
                            </button>
                            <span class="text-sm text-gray-600">Total Units: {{ qtySum }} | Total Items: {{ form.items.length }}</span>
                        </td>
                        <td class="item-empty align-right panel-title">
                            <span class="item-dark font-semibold">Sub Total</span>
                        </td>
                        <td class="item-empty align-right panel-title">
                            <span class="item-dark">{{ subTotal | formatMoney }}</span>
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
                                        <input @input="discountamt"
                                               class="w-24 px-2 py-1 rounded-md rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                               type="number" v-model="form.discount_percent"/>
                                    </div>
                                    <div>
                                        <input @input="discountper"
                                               class="w-24 px-2 py-1 rounded-md rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                               type="number" v-model="form.discount"/>
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

                    <!--END Table Body -->
                </table>
                <!-- END Table -->
            </div>
            <hr>
            <div class="flex justify-end mt-8 space-x-4">
                <button
                    @click="formSubmitted"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
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
                error: {},
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
            }
        },
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
                return (this.total - Number(this.form.discount));
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
                this.form.customer_id = customer.id
            },
            onStores(e) {
                const stores = e.target.value
                this.form.stores = stores
                this.form.store_id = stores.id
            },
            onProduct(item, index, e) {
                const product = e.target.value
                item.product = product
                // this.form.items[index].product = product
                item.product_id = product.id
                item.unit_price = product.price
                this.caltax(item, index);
            },
            setData(res) {
                // console.log(res);
                this.form = res.data.form;
                if (this.$route.meta.mode === 'edit') {
                    this.order = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
                    this.title = 'Edit';
                    this.message = `${this.capital} has been updated`;
                }
                if (!this.form.items) {
                    this.addNewLine();
                }
                this.show = true
            },
            caltax(item, index) {
                const {qty, unit_price, tax_percent} = item;
                // Perform the calculations here
                // For example, to calculate value_ex_tax and tax_amount
                item.value_ex_tax = qty * unit_price;
                item.tax_amount = (qty * unit_price * tax_percent) / 100;
                item.value_inc_tax = item.value_ex_tax + item.tax_amount;
            },
            discountamt() {
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
                    this.successfull(res)
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                        type: 'success',
                        duration: 3000
                    });
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
            }
        },
    }
</script>

<style scoped>

</style>
