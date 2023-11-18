<template>
    <div v-if="show">
        <div class="p-6">
            <h1 class="text-lg font-bold mb-4">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: `Add New ${capital}`}}
            </h1>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2">Date </label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="date"
                        v-model="form.date"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.date">{{ error.date[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Voucher Type</label>
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:border-blue-300"
                            v-model="form.voucher_type" >
                            <option value="Payment">Payment</option>
                            <option value="Receipt">Receipt</option>
                        </select>
                    </div>
                    <p class="text-red-600 text-xs italic" v-if="error.voucher_type">{{ error.voucher_type[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Payment Type</label>
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:border-blue-300"
                            v-model="form.payment_type">
                            <option value="Cash">Cash</option>
                            <option value="Bank">Bank</option>
                        </select>
                    </div>
                    <p class="text-red-600 text-xs italic" v-if="error.payment_type">{{ error.payment_type[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2">Number <span class="text-gray-500 ml-12">(Auto Generated)</span></label>
<!--                    <div class="relative">-->
<!--                        <select-->
<!--                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:border-blue-300"-->
<!--                            v-model="form.number">-->
<!--                            <option value="bank_payment_voucher">Bank Payment Voucher</option>-->
<!--                            <option value="cash_payment_voucher">Cash Payment Voucher</option>-->
<!--                            <option value="bank_receipt_voucher">Bank Receipt Voucher</option>-->
<!--                            <option value="cash_receipt_voucher">Cash Receipt Voucher</option>-->
<!--                        </select>-->
<!--                    </div>-->
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" disabled v-model="form.number"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.number">{{ error.number[0] }}</p>
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Remarks </label>
                    <textarea class="w-full py-2 px-3 bg-white border border-gray-300 rounded-md" type="text"
                              v-model="form.remarks"/>
                </div>
            </div>
            <div class="mt-4 ml-2 border border-gray-200 rounded overflow-x-auto min-w-full bg-white dark:bg-gray-800 dark:border-gray-700">
                <table class="min-w-full text-sm whitespace-nowrap">
                    <thead >
                    <tr class="border-b border-gray-100 dark:border-gray-700/50">
                        <th class="p-2 text-gray-900 bg-gray-100/75 font-semibold dark:text-gray-50 dark:bg-gray-700/25">
                            Account
                        </th>
                        <th class="text-gray-900 bg-gray-100/75 font-semibold dark:text-gray-50 dark:bg-gray-700/25">
                            Subledger
                        </th><th class="text-gray-900 bg-gray-100/75 font-semibold dark:text-gray-50 dark:bg-gray-700/25">
                            Reference#
                        </th>
                        <th class="text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                            Debit
                        </th>
                        <th class="text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                            Credit
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
                            <typeahead
                                :initialize="item.account"
                                :url="accounts"
                                @input="onAccount(item, index, $event)"
                                class="mr-3 text-sm rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                display="accounttitle"
                            />
                        </td>
                        <td >
                            <input
                                class="px-2 py-1 mr-3 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                type="text"
                                v-model="item.subledger">
                        </td>
                        <td >
                            <input
                                class="px-2 py-1 mr-3 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                type="text"
                                v-model="item.reference">
                        </td>
                        <td >
                            <input
                                class="w-full px-2 py-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                type="text"
                                v-model="item.debit">
                        </td>
                        <td >
                            <input
                                class="w-full px-2 py-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                type="text"
                                v-model="item.credit">
                        </td>
                        <td class=" text-center">
                            <button @click="removeLine(item,index)"
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
                            </button>
                        </td>
                    </tr>
                    <tr>

                        <td colspan="7">
                            <div class="flex justify-end">
                                <div class="flex items-center space-x-4" colspan="5">
                                    <strong class="text-lg text-blue-600" style="padding-right: 15px;">Total</strong>

                                    <div class="text-lg font-bold py-2" colspan="2">
<!--                                        <strong class="text-red-500" style="padding-right: 15px;">{{ total_discount }}</strong>-->
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tfoot>
                </table>
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
    import moment from "moment";
    import Typeahead from "@/Components/typeahead/typeahead.vue";

    function initialize(to) {
        let urls = {
            add: `/api/voucher/create`,
            edit: `/api/voucher/${to.params.id}/edit`,
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
                isSubmitting: false,
                resource: '/voucher',
                store: '/api/voucher',
                method: 'POST',
                small: 'voucher',
                capital: 'General Voucher',
                title: 'Add',
                message: 'New voucher Added',
                permissions: {},
                accounts: '/api/accounts',
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
        },watch: {
            'form.voucher_type': function(newVoucherType , oldVoucherType){
                this.checkAndCallGetNumber();
            },
            'form.payment_type':function(newPaymentType, oldPaymentType){
                this.checkAndCallGetNumber();
            }

            // form: {
            //     deep: true,
            //     handler(newFom, oldFom) {
            //         const newVoucherType = newFom.voucher_type;
            //         const newPaymentType = newFom.payment_type;
            //         const oldVoucherType = oldFom.voucher_type;
            //         const oldPaymentType = oldFom.payment_type;
            //
            //         if (newVoucherType !== null && newPaymentType !== null &&
            //             (newVoucherType !== oldVoucherType || newPaymentType !== oldPaymentType)) {
            //             this.getNumber(newVoucherType, newPaymentType);
            //         }
            //     }
            // }
        },

        methods: {
            checkAndCallGetNumber(){
                if(this.form.voucher_type !== null && this.form.payment_type !== null){
                    if(this.form.voucher_type !== this.oldVoucherType || this.form.payment_type !== this.oldPaymentType){
                        if(this.form.voucher_type && this.form.payment_type){
                            this.getNumber(this.form.voucher_type, this.form.payment_type);
                        }
                        this.oldVoucherType = this.form.voucher_type;
                        this.oldPaymentType = this.form.payment_type;
                    }
                }
            },
            getNumber(VoucherType, PaymentType){
                byMethod('Get', `/api/voucher_number?voucher_type=${VoucherType}&payment_type=${PaymentType}`).then(res=>{
                    this.form.number = res.data.results;
                })
                console.log(VoucherType, PaymentType)
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
                this.form.date = moment().format('YYYY-MM-DD');
                this.show = true
            },
            addNewLine() {
                if (!this.form.items) {
                    this.form.items = [];
                }
                this.form.items.push({
                    account: null,
                    subledger: null,
                    reference: null,
                    debit: 0,
                    credit: 0,
                });

            },
            removeLine(item, index) {
                if (this.form.items.length > 1) {
                    this.form.items.splice(index, 1);
                }
            },
            onAccount(item, index, e) {
                const account = e.target.value
                item.account = account
                item.account_id = account.id
            },
            formSubmitted() {
                this.isSubmitting = true;
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

</style>
