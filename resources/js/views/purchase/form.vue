<template>
    <div v-if="show">
        <div class="p-6">
            <h1 class="text-lg font-bold mb-4">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: `Add New ${capital}`}}
            </h1>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">

                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <div class="block font-medium text-sm text-gray-700">
                        <label>Supplier</label>
                        <span @click="supplierbtn" class="ml-2 items-right space-x-2 font-semibold text-sm text-blue-400 hover:text-blue-600 cursor-pointer transition duration-200 ease-in-out"
                              style="float: right;"
                              v-if="permissions.includes(`create-supplier`)">
                            New
                        </span>
                    </div>
                    <typeahead :initialize="form.supplier" :url="suppliers" @input="onSupplier" display="name"/>
                    <p class="text-red-600 text-xs italic" v-if="error.supplier_id">{{error.supplier_id[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >PO Reference No.:</label>
                    <input
                        @input="form.po_reference_number = form.po_reference_number.replace(/[^0-9]/g, '')"
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        placeholder=" PO Reference No."
                        type="text"
                        v-model="form.po_reference_number"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.po_reference_number">
                        {{error.po_reference_number[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2" v-if="$route.meta.mode && $route.meta.mode == 'edit'">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >PO Number:<small>(Auto Generated)</small></label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        disabled
                        placeholder=" PO No."
                        v-model="form.po_number"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.po_number">{{error.po_number[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >PO Date:</label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="date"
                        v-model="form.po_date"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.po_date">{{error.po_date[0] }}</p>

                </div>

                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Due Date: <span class="text-red-600">*</span></label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="date"
                        v-model="form.due_date"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.due_date">{{error.due_date[0] }}</p>
                </div>
            </div>
            <div
                class="mt-4 ml-2 border border-gray-200 rounded overflow-x-auto min-w-full bg-white dark:bg-gray-800 dark:border-gray-700">
                <table class="min-w-full text-sm whitespace-nowrap">
                    <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-700/50">
                        <th class="p-2 text-gray-900 bg-gray-100/75 font-semibold dark:text-gray-50 dark:bg-gray-700/25">
                            Sku
                        </th>
                        <th class="pl-4 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                            Item Description
                        </th>
                        <th class="text-gray-900 bg-gray-100/75 font-semibold dark:text-gray-50 dark:bg-gray-700/25">
                            Image
                        </th>
                        <th class="text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                            Qty
                        </th>
                        <th class="text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                            Purchase Price
                        </th>
                        <th class="text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">

                        </th>
                        <th class="text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="border-gray-100 dark:border-gray-700/50" v-for="(item,index) in form.items">
                        <td class="text-center">
                            {{ item.product ? item.product.sku :'0' }}
                            <!-- {{  item.product ? item.product.product_img.lenght:'00' }} -->
                            <!-- <input
                                   class="w-12 px-2 py-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                   type="text"
                                   v-model="item.product.sku"
                            > -->
                        </td>
                        <td>
                            <typeahead
                                :initialize="item.product"
                                :url="products"
                                @input="onProduct(item, index, $event)"
                                class="text-sm rounded-md ml-3 border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                display="title"
                            />
                        </td>

                        <td v-if="item.product">

                            <div class="image-container"
                                 style=" max-width: 35%; height: auto;  justify-content: center; align-items: center; margin-left: 25%;"
                                 v-if="item.product && item.product.product_img && item.product.product_img[0] ">
                                <div class="flex items-center">
                                    <img :src="`/uploads/product/img/` +  item.product.product_img[0].img">
                                </div>
                            </div>
                            <div style=" max-width: 25%; height: auto;  justify-content: center; align-items: center; margin-left: 25%;"
                                 v-else>
                                <img alt="No Picture" src="~@/images/no-picture-taking.png">
                                <span class="text-center" style="font-weight: bold;"> No Product Image</span>
                            </div>

                        </td>
                        <td v-else>

                            <div
                                style=" max-width: 50%; height: auto;  justify-content: center; align-items: center; margin-left: 25%;">
                                <img src="~@/images/packaging.png"
                                     style=" max-width: 30%; height: auto;  justify-content: center; align-items: center; margin-left: 25%;">

                            </div>

                        </td>


                        <td>
                            <input @blur="caltax(item, index)" @input="caltax(item, index)"
                                   class=" px-2 py-1 mr-3 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                   type="number"
                                   v-model="item.qty"
                            >
                        </td>
                        <td>
                            <input @blur="caltax(item, index)" @input="caltax(item, index)"
                                   class=" px-2 py-1 mr-3 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                   type="text"
                                   v-model="item.unit_price"
                            >
                        </td>
                        <!-- <td>
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
                        </td> -->
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
                                    class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:bg-yellow-600 text-white font-semibold p-2 ml-3 mt-2 rounded inline-flex items-center space-x-2">
                                <i class="fa fa-plus-circle"></i>
                                <span>Add Products</span>
                            </button>
                            <span class="text-sm text-gray-600 font-semibold pl-3">Total Units: {{ qtySum }} | Total Items: {{ form.items.length }}</span>
                        </td>
                        <td class="item-empty align-right panel-title text-right" colspan="3">
                            <span class="item-dark font-semibold">Sub Total</span>
                        </td>
                        <td class="item-empty align-right panel-title text-center" colspan="2"
                            style="margin-left: .5rem;">


                            <span class="item-dark ">{{ subTotal | formatMoney }}</span>
                        </td>
                        <!-- <td class="item-empty align-right"></td> -->
                        <td class="item-empty align-right panel-title" style="display: none">
                            <span class="item-dark">{{ tot_tax_amt }}</span>
                        </td>
                        <td class="item-empty align-right panel-title" colspan="1" style="display: none">
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
                            </div>
                        </td>
                    </tr>
                    <tr>

                        <td colspan="7">
                            <div class="flex justify-end">
                                <div class="flex items-center space-x-4" colspan="5">
                                    <strong class="text-lg text-blue-600" style="padding-right: 15px;">Total</strong>

                                    <div class="text-lg font-bold py-2" colspan="2">
                                        <strong class="text-red-500" style="padding-right: 15px;">{{ total_discount
                                            }}</strong>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <!-- <td>
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
                        </td> -->
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="flex justify-end mt-8 space-x-4">
                <!-- <button
                    @click="formSubmitted"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                    type="button">
                    {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Add" }}
                </button> -->
                <button :disabled="isSubmitting" @click="formSubmitted"
                        class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white hover:bg-blue-600  transition duration-200 ease-in-out"

                >
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
                <Modal :show="showsupplier" @cancel="handleCancelSupplier" closeable="true">
                    <Supplier :show="true" @cancel-supplier="handleCancelSupplier" @resp="()=>{showsupplier = !true}"
                              @save-supplier="handleCancelSupplier" additionalProp="global"></Supplier>
                </Modal>

            </div>
        </div>

    </div>
</template>

<script>

    import {byMethod, get} from '@/libs/api';
    import Modal from "@/Components/Modal.vue";
    import {form} from '@/libs/mixins';
    import Supplier from "../supplier/form.vue";
    import Typeahead from "@/Components/typeahead/typeahead.vue";
    import moment from 'moment';


    function initialize(to) {
        let urls = {
            add: `/api/purchase/create`,
            edit: `/api/purchase/${to.params.id}/edit`,
        }
        return urls[to.meta.mode] || urls.add
    }

    export default {
        mixins: [form],
        components: {
            Typeahead, Modal, Supplier
        },
        data() {
            return {
                error: {},
                show: false,
                isSubmitting: false,
                showsupplier: false,
                show_modal: false,
                resource: '/purchase',
                store: '/api/purchase',
                method: 'POST',
                small: 'purchase',
                capital: 'Purchase',
                title: 'Add',
                message: 'New purchase Added',
                permissions: [],
                suppliers: '/api/supplier',
                products: '/api/product?head_id=!null',
            }
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
        created() {
            this.permissions = window.apex.user.permission
            this.form.po_date = moment().format('YYYY-MM-DD');
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
                var final = (this.total - Number(this.form.discount));
                this.form.finaltotal = final;
                // return (this.total - Number(this.form.discount));
                return final;

            },


        },
        methods: {

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
            onProduct(item, index, e) {
                const product = e.target.value
                item.product = product
                // this.form.items[index].product = product
                item.product_id = product.id
                item.unit_price = product.cost_price
                this.caltax(item, index);
            },
            caltax(item, index) {
                const {qty, unit_price, tax_percent} = item;
                // Perform the calculations here
                // For example, to calculate value_ex_tax and tax_amount
                item.value_ex_tax = qty * unit_price;
                item.tax_amount = (qty * unit_price * tax_percent) / 100;
                item.value_inc_tax = item.value_ex_tax + item.tax_amount;
            },
            removeProduct(item, index) {
                if (this.form.items.length > 1) {
                    this.form.items.splice(index, 1);
                }
            },
            onSupplier(e) {
                const supplier = e.target.value
                this.form.supplier = supplier
                this.form.supplier_id = supplier.id
            },
            supplierbtn() {
                this.showsupplier = true;
            },
            handleCancelSupplier() {
                this.showsupplier = false;
            },

            setData(res) {

                this.form = res.data.form;
                if (this.$route.meta.mode === 'edit') {
                    this.store = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;

                    this.title = 'Edit';
                    this.message = `${this.capital} has been updated`;
                }
                if (!this.form.items) {
                    this.addNewLine();
                }
                this.form.po_date = moment().format('YYYY-MM-DD');
                this.show = true
            },
            formSubmitted() {
                this.isSubmitting = true; // Disable the button and show the spinner
                this.form.selectedPermissions = this.selectedPermissions
                byMethod(this.method, this.store, this.form).then(res => {
                    this.additionalProp ? this.formSubmiting() : this.successfull(res)
                    // this.successfull(res)
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                        type: 'success',
                        duration: 3000
                    });
                    this.$emit('resp', true);
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
                    .finally(() => {
                        this.isSubmitting = false; // Enable the button and hide the spinner
                    });
            },
            successfull(res) {
                this.$router.push({path: `${this.resource}`})
            }
        },
    }
</script>

<style scoped>
    .image-container {
        max-width: 40%;
        height: auto;
        justify-content: center;
        align-items: center;
        margin-left: 25%;
        transition: transform 0.3s ease-in-out; /* Apply a smooth transition effect */
        z-index: 9999;
    }

    .image-container:hover {
        transform: scale(1.2); /* Increase the image size on hover */

    }
</style>
