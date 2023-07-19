<template>
    <div class="p-6">
        <!--        <h1 class="font-bold">/Admin</h1>-->
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label class="font-medium"> Bank</label>
                <input class="block border border-gray-200 rounded  w-full" type="text" v-model="form.bank.bank_name">
                <p class="text-red-600 text-xs italic" v-if="error.bank_name">{{ error.bank_name[0] }}</p>

            </div>
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label class="font-medium"> Sort Code</label>
                <input
                    class="block border border-gray-200 rounded  w-full" type="text" v-model="form.bank.sort_code">
                <small>NN-NN-NN-(N = Number)</small>
                <p class="text-red-600 text-xs italic" v-if="error.sort_code">{{ error.sort_code[0] }}</p>

            </div>
        </div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label class="font-medium"> Account Number</label>
                <input
                    class="block border border-gray-200 rounded  w-full" type="text"
                    v-model="form.bank.account_number">
                <p class="text-red-600 text-xs italic" v-if="error.account_number">{{ error.account_number[0] }}</p>

            </div>
        </div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label class="font-medium">Other Details</label>
                <input class="block border border-gray-200 rounded  w-full" type="text" v-model="form.bank.other_detail">
                <p class="text-red-600 text-xs italic" v-if="error.other_detail">{{ error.other_detail[0] }}</p>

            </div>
        </div>
        <div class="flex justify-end mt-8">
            <button
                @click="formSubmitted"
                class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-50 px-4 py-3 leading-6 rounded border-primary-700 bg-emerald-400 text-white hover:text-white hover:bg-primary-800 hover:border-primary-800 focus:ring focus:ring-primary-500 focus:ring-opacity-50 active:bg-primary-700 active:border-primary-700">
                Save Changes
            </button>
        </div>
    </div>
</template>
<script>
    import {byMethod, get} from "@/libs/api";
    import {form} from "@/libs/mixins";

    export default {
        name: "bank_account",
        mixins: [form],
        props: {
            data: {
                type: Object,
                required: true
            },
            id: {
                required: false
            },
        },
        data() {
            return {
                resource: '/bank',
                error: {},
                store: '/api/user',
                method: 'POST',
            }
        },
        created() {
            this.form.bank = {}
            get('api/bank/' + this.id).then(res => {
                // console.log(res.data.form.bank);
                if (res.data.form.bank) {
                    this.form = res.data.form;
                }
                this.form.bank.user_id =this.id;
                // console.log(res)
            })
        },
        methods: {
            formSubmitted() {
                byMethod('POST', '/api/bank/' + this.id, this.form.bank).then(res => {
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                        type: 'success',
                        duration: 3000
                    });
                    this.$emit('tabChange', 'medical');
                    // console.log(res)
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
        }
    }
</script>

<style scoped>

</style>
