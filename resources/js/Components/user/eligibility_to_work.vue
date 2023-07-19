<template>
    <div class="p-6">
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <label class="flex items-center">
                <input
                        class="form-checkbox h-4 w-4 text-indigo-700"
                        false-value="0"
                        true-value="1"
                        type="checkbox"
                        v-model="form.eligibility.uk_passport"
                />
                <span class="ml-2 text-gray-700">UK Passport</span>
            </label>
            <p class="text-red-600 text-xs italic" v-if="error.uk_passport">{{ error.uk_passport[0] }}</p>

        </div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-4">
            <label class="flex items-center">
                <input
                        checked
                        class="form-checkbox h-4 w-4 text-indigo-700"
                        type="checkbox"
                        v-model="form.eligibility.uk_ni_number"
                />
                <span class="ml-2 text-gray-700">Full UK birth certificate with proof of NI number</span>
                <p class="text-red-600 text-xs italic" v-if="error.uk_ni_number">{{ error.uk_ni_number[0] }}</p>
            </label>
        </div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-4">
            <label class="flex items-center">
                <input
                        class="form-radio h-4 w-4 text-indigo-700"
                        name="radio-group"
                        type="radio"
                        v-model="form.eligibility.eu_citizen_id_card"
                        value="Citizens"
                />
                <span class="ml-2 text-gray-700">EU Citizens - in date passport or national ID card</span>
                <p class="text-red-600 text-xs italic" v-if="error.eu_citizen_id_card">{{ error.eu_citizen_id_card[0] }}</p>

            </label>
        </div>
        <div
                class="flex-auto flex flex-col sm:flex-row sm:items-center pt-4"
                v-if="form.eligibility && form.eligibility.eu_citizen_id_card === 'Citizens'"
        >
            <label class="flex items-center">
                <input
                        :false-value="0"
                        :true-value="1"
                        class="form-checkbox h-4 w-4 text-indigo-700"
                        type="checkbox"
                        v-model="form.eligibility.right_to_work_document"
                />
                <span class="ml-2 text-gray-700">Do you have right to work document?</span>
            </label>
        </div>
        <div
                class="flex-auto flex flex-col sm:flex-row sm:items-center pt-4 pl-3"
                v-if="form.eligibility.eu_citizen_id_card === 'Citizens' && form.eligibility.right_to_work_document === 1"
        >
            <label class="flex items-center">
                <input
                        class="form-radio h-4 w-4 text-indigo-700"
                        name="right_to_work"
                        type="radio"
                        v-model="form.eligibility.right_to_work"
                        value="pre_settle"
                />
                <span class="ml-2 text-gray-700">Pre Settle</span>
            </label>
        </div>
        <div
                class="flex-auto flex flex-col sm:flex-row sm:items-center pt-4 pl-14"
                v-if="form.eligibility.eu_citizen_id_card === 'Citizens' && form.eligibility.right_to_work === 'pre_settle'"
        >
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label class="font-medium">Expiry Date</label>
                <input
                        class="block border border-gray-200 rounded px-3 py-2 w-full mt-1 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                        type="text"
                        v-model="form.eligibility.pre_settle_expiry"
                />
            </div>
        </div>
        <div
                class="flex-auto flex flex-col sm:flex-row sm:items-center pt-4 pl-3"
                v-if="form.eligibility.eu_citizen_id_card === 'Citizens' && form.eligibility.right_to_work_document === 1"
        >
            <label class="flex items-center">
                <input
                        class="form-radio h-4 w-4 text-indigo-700"
                        name="right_to_work"
                        type="radio"
                        v-model="form.eligibility.right_to_work"
                        value="full_settle"
                />
                <span class="ml-2 text-gray-700">Full Settle</span>
            </label>
        </div>
        <div
                class="flex-auto flex flex-col sm:flex-row sm:items-center pt-4 pl-14"
                v-if="form.eligibility.eu_citizen_id_card === 'Citizens' && form.eligibility.right_to_work === 'full_settle'"
        >
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label class="font-medium">Expiry Date</label>
                <input
                        class="block border border-gray-200 rounded px-3 py-2 w-full mt-1 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                        type="text"
                        v-model="form.eligibility.full_settle_expiry"
                />
            </div>
        </div>
        <div class="flex justify-end mt-8">
            <button
                    @click="formSubmitted"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-50 px-4 py-3 leading-6 rounded border-primary-700 bg-emerald-400 text-white hover:text-white hover:bg-primary-800 hover:border-primary-800 focus:ring focus:ring-primary-500 focus:ring-opacity-50 active:bg-primary-700 active:border-primary-700"
            >
                Save Changes
            </button>
        </div>
    </div>
</template>
<script>
    import {byMethod} from "@/libs/api";
    import {form} from "@/libs/mixins";

    export default {
        mixins: [form],
        name: "eligibility_to_work",
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
                error: {},
            }
        },
        created() {
            this.form.eligibility = {}
            byMethod('GET', 'api/eligibility_to_work/' + this.id).then(res => {
                if (res.data.form.eligibility) {
                    this.form = res.data.form;
                }
                this.form.eligibility.user_id = this.id;
            })
        },
        methods: {
            formSubmitted() {
                byMethod('POST', '/api/eligibility_to_work/' + this.id, this.form.eligibility).then(res => {
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                        type: 'success',
                        duration: 3000
                    });
                    this.$emit('tabChange', 'references');
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
        }

    }
</script>
