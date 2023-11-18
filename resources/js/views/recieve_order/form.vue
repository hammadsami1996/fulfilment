<template>
    <div v-if="mention">
        <div class="p-6">
            <h1 class="text-lg font-bold mb-4">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? `Create ${capital}`: `Add New ${capital}`}}
            </h1>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">

                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Supplier</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        disabled
                        type="text"
                        v-model="form.supplier.name"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.supplier_id">{{error.supplier_id[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >PO#</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"

                        disabled
                        v-model="form.po_number"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.po_number">
                        {{error.po_number[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2" v-if="$route.meta.mode && $route.meta.mode == 'edit'">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >RO Number:<small>(Auto Generated)</small></label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        disabled
                        placeholder=" RO No."
                        v-model="form.number"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.number">{{error.number[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Date:</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        type="date"
                        v-model="form.date"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.date">{{error.date[0] }}</p>
                </div>
            </div>
            <br>
            <hr>
            <div
                class="mt-4 border border-gray-200 rounded overflow-x-auto min-w-full bg-white dark:bg-gray-800 dark:border-gray-700">
                <table class="min-w-full text-sm align-middle whitespace-nowrap">
                    <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-700/50">
                        <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                            Item Image
                        </th>
                        <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-center dark:text-gray-50 dark:bg-gray-700/25">
                            Item Description
                        </th>
                        <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                            Qty in Order
                        </th>
                        <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25"
                            v-if="form.status_id == 29">
                            Partial Remaining
                        </th>
                        <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                        </th>
                        <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                        </th>
                    </tr>
                    </thead>
                    <tbody v-for="(item,index) in form.items">
                    <tr class="border-b border-gray-100 dark:border-gray-700/50">
                        <td class="w-48" v-if="item.product && item.product.product_img && item.product.product_img[0]">
                            <div
                                class="image-container"
                                style=" max-width: 30%; height: auto;  justify-content: center; align-items: center; margin-left: 15%;">
                                <img :src="`/uploads/product/img/` +  item.product.product_img[0].img">
                            </div>
                        </td>
                        <td v-else class="w-48">
                            <div
                                style=" max-width: 20%; height: auto;  justify-content: center; align-items: center; margin-left: 15%;">
                                <img alt="No Picture" src="~@/images/no-picture-taking.png">
                                <span class="text-center" style="font-weight: bold;"> No Product Image</span>
                            </div>
                        </td>
                        <td>
                            <input
                                class=" w-64 px-2 py-1  rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                disabled type="text" v-if="item.product" v-model="item.product.title">
                        </td>
                        <td>
                            <input @blur="caltax(item, index)" @input="caltax(item, index)"
                                   class=" px-2 py-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                   disabled type="number" v-model="item.qty">
                        </td>
                        <td v-if="form.status_id == 29">
                            <input @blur="caltax(item, index)" @input="caltax(item, index)"
                                   class=" w-32 px-2 py-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                   disabled type="number" v-model="item.partail_remaining">
                        </td>
                        <td class="text-right">
                            <button @click="addchild(index)"
                                    class="mt-6 inline-flex items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm text-white bg-gradient-to-r from-yellow-300 to-yellow-600 hover:opacity-90 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:opacity-75 mb-3"
                                    style=" margin-top: 10px; color:white; border-radius: 10%;"
                                    type="button" v-if="item.partail_remaining != 0">
                                <i class="fa fa-plus-circle"></i> Add Warehouses
                            </button>
                        </td>
                    </tr>
                    <tr class="text-center" v-for="(child, childIndex) in item.child">
                        <td style="display: none;">Total Qty Deliver: {{ item.total_qty_deliver || 0 }}</td>
                        <td>
                            <label
                                class="block font-bold text-sm text-gray-700 mb-2 " style=" margin-right: 35%;"
                            >Warehouse </label>
                            <typeahead
                                :initialize="child.warehouse"
                                :url="warehouses"
                                @input="onWearhouse(childIndex, index, $event ,child)"
                                class="Z-20 relative h-8 w-64 text-sm rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                display="name"
                            />
                        </td>
                        <td>
                            <label
                                class="block font-bold text-sm text-gray-700 mb-2"
                            >Quantity Shift</label>
                            <input
                                :max="item.partail_remaining"
                                @input="sumchild(index,childIndex,child.qty_deliver)"
                                class="h-8 text-sm rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="number" v-model="child.qty_deliver">
                        </td>
                        <td class=" text-left">
                            <button @click="removeProduct(child,childIndex,index)"
                                    class="mt-6 inline-flex items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm text-white bg-gradient-to-r from-red-500 to-indigo-600 hover:opacity-90 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:opacity-75"
                                    type="button">
                                <i class="fa fa-trash mr-1"></i>
                            </button>
                        </td>
                    </tr>
                    <hr>
                    <br>
                    </tbody>
                </table>
            </div>
            <br>
            <hr>
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2" style="width: 60%;">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Internal Note:</label>
                <textarea class="form-control" style="width:100%" v-model="form.note"></textarea>
                <p class="text-red-600 text-xs italic" v-if="error.note">{{error.note[0] }}</p>
            </div>
            <div class="flex justify-end mt-8 space-x-4">
                <button
                    @click="formSubmitted" :disabled="isSubmitting"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
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
                    Add
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
    import Modal from "@/Components/Modal.vue";
    import moment from 'moment';

    function initialize(to) {
        let urls = {
            add: `/api/receive_order/create`,
            edit: `/api/receive_order/${to.params.id}/edit`,
        }
        return urls[to.meta.mode] || urls.add
    }

    export default {
        mixins: [form],
        components: {
            Typeahead,
            Modal
        },
        data() {
            return {
                form: {
                    date: null,
                    items: {
                        children: []
                    }
                },
                show_size_modal: false,
                error: {},
                show: false,
                isSubmitting: false,
                child: [],
                mention: false,
                resource: '/receive_order',
                store: '/api/receive_order',
                send: '/api/receive_order_inventory',
                method: 'POST',
                small: 'recieve order',
                capital: 'recieve order',
                title: 'Add',
                message: 'New recieve order Added',
                permissions: {},
                suppliers: '/api/supplier',
                products: '/api/product',
                warehouses: '/api/warehouse',
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
            this.form.date = moment().format('YYYY-MM-DD');
        },
        computed: {
            subTotal() {
                return this.form.items.reduce((carry, item) => {
                    return carry + Number(item.unit_price) * Number(item.qty);
                }, 0);
            },
            total() {
                var total = (this.subTotal + Number(this.form.mtax_amount));
                this.form.tvalue_inc_tax = total;
                this.form.tvalue_ex_tax = this.subTotal;
                return (total);
            },
            qtySum() {
                var total = this.form.items.reduce((carry, item) => {
                    return carry + Number(item.qty);
                }, 0);
                this.$data.form.total_units = total;
                return total;
            },
            tot_tax_amt() {
                var total = 0;
                total = this.form.items.reduce((carry, item) => {
                    return carry + Number(item.tax_amount);
                }, 0);
                this.form.mtax_amount = total;
                return total;
            },
            total_discount() {
                var final = (this.total - Number(this.form.discount));
                this.form.finaltotal = final;
                return final;
            },
        },
        methods: {
            addchild(index) {
                if (!this.form.items[index].child) {
                    this.form.items[index].child = [{
                        title: null,
                        qty_deliver: null,
                    }];
                } else {
                    const newChild = {
                        title: null,
                        qty_deliver: null,
                    };
                    this.form.items[index].child.push(newChild);
                }
                const totalQtyDeliver = this.form.items[index].child.reduce(
                    (total, child) => total + (child.qty_deliver || 0),
                    0
                );
                this.form.items[index].total_qty_deliver = totalQtyDeliver;
            },
            sumchild(index, childIndex, max) {
                if (this.form.items[index].partail_remaining != null && max > this.form.items[index].partail_remaining) {
                    this.form.items[index].child[childIndex].qty_deliver = this.form.items[index].partail_remaining;
                }
                const totalQtyDeliver = this.form.items[index].child.reduce(
                    (total, child) => total + (child.qty_deliver || 0),
                    0
                );
                this.form.items[index].total_qty_deliver = totalQtyDeliver;
            },
            onWearhouse(childIndex, index, e, child) {
                const warehouse = e.target.value
                this.global_warehouse_id = warehouse.id;
                child.warehouse = warehouse;
                child.warehouse_id = warehouse.id;
            },
            close() {
                this.show = false,
                    this.show_size_modal = false
            },
            discountamt() {
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
                item.product_name = product.name

                // this.form.items[index].product = product
                item.product_id = product.id
                item.unit_price = product.price
                this.caltax(item, index);
            },
            caltax(item, index) {
                const {qty, unit_price, tax_percent} = item;
                item.value_ex_tax = qty * unit_price;
                item.tax_amount = (qty * unit_price * tax_percent) / 100;
                item.value_inc_tax = item.value_ex_tax + item.tax_amount;
            },
            removeProduct(item, childIndex, index) {
                if (this.form.items[index].child.length > 1) {
                    this.form.items[index].child.splice(childIndex, 1);
                }
            },
            onSupplier(e) {
                const supplier = e.target.value
                this.form.supplier = supplier
                this.form.supplier_id = supplier.id
            },
            setData(res) {
                this.form = res.data.form;
                if (this.$route.meta.mode === 'edit') {
                    this.purchase = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
                    this.title = 'Edit';
                    this.message = `${this.capital} has been updated`;
                }
                if (!this.form.items) {
                    this.addNewLine();
                }
                this.form.items.child = []
                this.form.date = moment().format('YYYY-MM-DD');
                this.mention = true
            },
            formSubmitted() {
               this.isSubmitting = true;
                for (const item of this.form.items) {
                    if (item.total_qty_deliver > item.qty) {
                        this.$toast.open({
                            position: 'top-right',
                            message: 'Product quantity shift to warehouse should not be greater than Product Qunatity In Order',
                            type: 'error',
                            duration: 3000,
                        });
                        return;
                    }
                }
                this.form.selectedPermissions = this.selectedPermissions
                byMethod(this.method, this.store, this.form).then(res => {
                    if (res.data.saved) {
                        this.$toast.open({
                            position: 'top-right',
                            message: 'Create Successfully',
                            type: 'success',
                            duration: 3000,
                        });
                        this.successfull()
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
                // .finally(() => {
                // this.isSubmitting = false; // Enable the button and hide the spinner
                // });
                this.isSubmitting = false;
            },
            saveinvent() {
                this.form.selectedPermissions = this.selectedPermissions
                byMethod(this.method, this.send, this.form.items).then(res => {
                    if (res.data.error) {
                        this.$toast.open({
                            position: 'top-right',
                            message: 'Product quantity shift to warehouse should not be greater than Product Received',
                            type: 'error',
                            duration: 3000,

                        });
                    }
                    if (res.data.saved) {
                        this.$toast.open({
                            position: 'top-right',
                            message: 'Successfully Shift Product to Warehouse',
                            type: 'success',
                            duration: 3000,
                        });
                        this.show_size_modal = false;
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
            },
            successfull(res) {
                this.$router.push({path: `/purchase`})
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

        transition: transform 0.3s ease-in-out; /* Apply a smooth transition effect */
        z-index: 9999;
    }

    .image-container:hover {
        /* margin-left:25%; */
        transform: scale(1.2); /* Increase the image size on hover */
        /* margin-left:25% */

    }
</style>
