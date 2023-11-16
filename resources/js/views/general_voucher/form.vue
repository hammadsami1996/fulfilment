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
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2">Number <span class="text-gray-500">(Auto Generated)</span></label>
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:border-blue-300"
                            v-model="form.number">
                            <option value="bank_payment_voucher">Bank Payment Voucher</option>
                            <option value="cash_payment_voucher">Cash Payment Voucher</option>
                            <option value="bank_receipt_voucher">Bank Receipt Voucher</option>
                            <option value="cash_receipt_voucher">Cash Receipt Voucher</option>
                        </select>
                    </div>
                    <p class="text-red-600 text-xs italic" v-if="error.number">{{ error.number[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Voucher Type</label>
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:border-blue-300"
                            v-model="form.voucher_type">
                            <option value="Payment">Payment</option>
                            <option value="Recipt">Recipt</option>
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
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2">Exchange Rate </label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="number"
                        v-model="form.exchange_rate"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.exchange_rate">{{ error.exchange_rate[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Remarks </label>
                    <textarea class="w-full py-2 px-3 bg-white border border-gray-300 rounded-md" type="text"
                              v-model="form.remarks"/>
                </div>
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
    function initialize(to) {
        let urls = {
            add: `/api/general_voucher/create`,
            edit: `/api/general_voucher/${to.params.id}/edit`,
        }
        return urls[to.meta.mode] || urls.add
    }
    export default {
        mixins: [form],
        data() {
            return {
                error: {},
                show: false,
                isSubmitting: false,
                resource: '/general_voucher',
                store: '/api/general_voucher',
                method: 'POST',
                small: 'general_voucher',
                capital: 'General Voucher',
                title: 'Add',
                message: 'New general_voucher Added',
                permissions: {},
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
        methods: {
            setData(res) {
                this.form = res.data.form;
                if (this.$route.meta.mode === 'edit') {
                    this.store = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
                    this.title = 'Edit';

                    this.message = `${this.capital} has been updated`;
                }
                this.show = true
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
