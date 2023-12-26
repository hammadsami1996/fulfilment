<template>
    <div v-if="show">
        <div class="p-6">
            <h1 class="text-lg font-bold mb-4">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: `Add New ${capital}`}}
            </h1>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/3 mb-4 sm:mb-0 ">
                <!-- <div class="w-full sm:w-1/3 mb-4 sm:mb-0 -mt-12 md:mt-14"> -->
                    <label class="block font-medium text-sm text-gray-700 mb-2" >Voucher Date</label>
                    <input class="w-full py-2 px-3 bg-white-100 border border-gray-300 rounded-md" type="date" v-model="form.voucher_date"   />
                    </div>
                    <div class="w-full sm:w-1/3 mb-4 sm:mb-0  pl-2">
                    <!-- <div class="w-full sm:w-1/3 mb-4 sm:mb-0 -mt-12 ml-3"> -->
                    <label class="block font-medium text-sm text-gray-700 mb-2" >Voucher  Number</label>
                    <input class="w-full py-2 px-3  bg-gray-100 border border-gray-300 rounded-md" type="text" placeholder="Auto Generated" readonly v-model="form.voucher_number" />
                    </div>
                <div class="w-full sm:w-2/3 mb-2 sm:mb-0 pl-4 pt-6">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Remarks</label>
                    <textarea class="w-full py-2 px-3 bg-white-100 border border-gray-400 rounded-md" style="height: 100px" v-model="form.detail_remarks"></textarea>
                </div>
            </div>
            <div class="mt-4 ml-2 border border-gray-200 rounded overflow-x-auto min-w-full bg-white dark:bg-gray-800 dark:border-gray-700 -z-1">
    <table class="min-w-full text-sm md:text-base whitespace-nowrap">
        <thead>
            <tr class="border-b border-gray-100 dark:border-gray-700/50">
                
                <th colspan="1" class="p-2 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                    Account
                </th>
                <!-- <th colspan="3" class="pl-4 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                    Subledger
                </th> -->
             
                <th colspan="1" class="text-gray-900 pl-2 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                    Remarks
                </th>
                <th colspan="1" class="text-gray-900 text-center bg-gray-100/75 font-semibold dark:text-gray-50 dark:bg-gray-700/25">
                    Debit
                </th>
                <th colspan="1" class="text-gray-900 text-center bg-gray-100/75 font-semibold dark:text-gray-50 dark:bg-gray-700/25">
                    Credit
                </th>
                <th colspan="2" class="text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25"></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item,index) in form.items" :key="index" class="border-gray-100 dark:border-gray-700/50">
             
                <td colspan="1" class="py-2 ">
                    <typeahead :initialize="item.account" :url="accounts" class="w-full md:w-48 max-[640px]:w-48  text-sm rounded-md ml-3 border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        @input="onAccount(item, index, $event)" display="accounttitle" />
                    <p class="text-red-600 text-xs italic" v-if="error['items.' + index + '.account']">
                        {{ error['items.' + index + '.account'][0] }}
                    </p>
                </td>
                <!-- <td colspan="3" class="py-2 px-1">
                    <typeahead :initialize="item.subledger" :url="customers" class="w-full md:w-60 text-sm rounded-md ml-3 border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        @input="onCustomer(item, index, $event)" display="name" />
                </td> -->
                <td colspan="1" class="py-2 ">
                    <input class="w-full md:w-60 sm:w-60 max-[640px]:w-60 py-4 px-2 bg-white h-8 border border-gray-300 rounded-md" v-model="item.master_remarks" />
                </td>
                <td colspan="1" class="text-center py-2 ">
                    <input type="number" @input="onDebitInput(item.debit)" class="w-full md:w-20 sm:w-20 max-[640px]:w-20 py-2 px-2 bg-white h-8 border border-gray-300 rounded-md" v-model="item.debit" />
                </td>
                <td colspan="1" class="text-center py-2 ">
                    <input type="number" @input="onCreditInput(item.credit)" class="w-full md:w-20 sm:w-20  max-[640px]:w-20 py-4 px-3 bg-white h-8 border border-gray-300 rounded-md" v-model="item.credit" />
                </td>
                <td colspan="1" class="text-center py-2 px-1">
                    <button @click="removeProduct(item,index)" type="button" class="inline-flex items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:opacity-90 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:opacity-75">
                        <i class="fa fa-trash mr-1"></i>
                    </button>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td class="item-empty" colspan="2">
                    <button @click="addNewLine" class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:bg-yellow-600 text-white font-semibold p-2 ml-3 mt-2 rounded inline-flex items-center space-x-2">
                        <i class="fa fa-plus-circle"></i>
                        <span></span>
                    </button>
                </td>
            </tr>
            <tr >
                <td colspan="7">
                    <div class="flex   justify-end">
                        <div class="flex items-center space-x-2 md:space-x-10 pr-24 " >
                            <div class="font-bold mr-3">Total</div>
                            <div>
                                <input v-model="totalDebit" type="number" class="w-20 md:w-20 px-2 py-1 rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" min="0" placeholder="0" />
                            </div>
                            <div>
                                <input type="number" v-model="totalCredit" class="w-20 md:w-20 px-2 py-1 rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="0" />
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr></tr>
        </tfoot>
    </table>
</div>



            
            <div class="flex justify-end mt-8 space-x-4">
                <button @click="formSubmitted" :disabled="isSubmitting || !canSave" type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white" >
                    <svg aria-hidden="true" class="inline w-4 h-4 mr-3 text-white animate-spin" fill="none" role="status" v-if="isSubmitting" viewBox="0 0 100 101" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="#E5E7EB"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentColor"/>
                </svg>
                    {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Add" }}
                </button>
                <button @click="additionalProp ? successfully():successfull()"  type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white" >
                    Cancel
                </button>
            </div>
    </div>
    </div>
</template>

<script>
    import {byMethod, get} from '@/libs/api'
    import {form} from '@/libs/mixins'
    import {objectToFormData} from "@/libs/helpers";
    import Typeahead from "@/Components/typeahead/typeahead.vue";
    import moment from 'moment';


    function initialize(to) {
        let urls = {
            add: `/api/journal_voucher/create/`,
            edit: `/api/journal_voucher/${to.params.id}/edit`,
        }
        return urls[to.meta.mode] || urls.add
    }   

    export default {
        mixins: [form],
        props: {
            show: Boolean,
            additionalProp: String,
        },
        components: {
            Typeahead,
        },
        data() {
            return {
                error: {},
                totalDebit: 0,
                totalCredit: 0,
                // show: false,
                show: Boolean,
                isSubmitting: false,
                resource: '/journal_voucher',
                accounts : '/api/accounts',
                customers : '/api/customer',
                store: '/api/journal_voucher',
                method: 'POST',
                small: 'journal_voucher',
                capital: 'Voucher',
                title: 'Add',
                message: 'New Finance Transaction Added',
                permissions: {},
            }
        },

        beforeRouteEnter(to, from, next) {
            get(initialize(to))
                .then((res) => {
                    next(vm => vm.setData(res))
                });
        },
        beforeRouteUpdate(to, from, next) {
            get(initialize(to))
                .then((res) => {
                    this.setData(res);
                    next()
                })
        },
        created() {
            this.form.voucher_date = new Date().toISOString().split('T')[0];
                },
                computed: {
                    canSave: function () {
            return this.totalDebit === this.totalCredit;
            },
        },

        methods: {
            onDebitInput(item) {
            this.calculateTotal();
            },

            onCreditInput(item) {
            this.calculateTotal();
            },
          
            calculateTotal() {
            if (this.form && this.form.items) {
                this.totalDebit = this.form.items.reduce((total, item) => total + parseFloat(item.debit || 0), 0);
                this.totalCredit = this.form.items.reduce((total, item) => total + parseFloat(item.credit || 0), 0);
            }
            },
            setData(res) {
                this.form = res.data.form;
                if (this.$route.meta.mode === 'edit') {
                    this.store = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
                    this.title = 'Edit';
                    this.message = `${this.capital} has been updated`;
                }
                    this.addNewLine();
                this.form.voucher_date = new Date().toISOString().split('T')[0];
                this.show = true
            },
            addNewLine() {
                if (!this.form.items) {
                    this.form.items = [];
                }
                this.form.items.push({
                    account: null,
                    account_id: null,
                    remarks: '',
                    credit: 0,
                    debit: 0,
                });

            },
            removeProduct(item, index) {
                if (this.form.items.length > 1) {
                    this.form.items.splice(index, 1);
                }
            },
            onAccount(item, index,e){
                const account = e.target.value;
                item.account = account;
                item.account_id = account.id;
            },
            onCustomer(item, index, e) {
                const customer = e.target.value
                item.subledger = customer
                item.subledger_id = customer.id
            },
            formSubmitted() {
                this.isSubmitting = true;
                this.form.selectedPermissions = this.selectedPermissions
                byMethod(this.method, this.store, objectToFormData(this.form)).then(res => {
                    this.additionalProp ? this.formSubmiting():this.successfull(res)
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
                })
                .finally(() => {
                this.isSubmitting = false; 
                });
            },
            successfull(res) {
                this.$router.push({path: `${this.resource}`})
                },
            },
        }
</script>