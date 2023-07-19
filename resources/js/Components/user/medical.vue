<template>
    <h1 class="font-bold">Medical information</h1>
    <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-5">
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="font-medium"> Do you have any medical conditions that will affect you ability to work with
                us?</label>
        </div>
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <input
                class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                type="text" v-model="form.medical.ability_work">
            <p class="text-red-600 text-xs italic" v-if="error.ability_work">{{ error.ability_work[0] }}</p>
        </div>
    </div>
    <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-5">
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="font-medium">Have you been vaccinated against COVID-19?</label>
        </div>
        <div class="flex justify-between sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="items-center">
                <input class="form-checkbox h-5 w-5 text-blue-600" type="radio" v-model="form.medical.covid_19" :value="0">
                <span class="ml-2 text-gray-700">yes</span>
            </label>
            <label class="items-center">
                <input class="form-checkbox h-5 w-5 " type="radio" v-model="form.medical.covid_19" :value="1">
                <span class="ml-2 text-gray-700">No</span>
            </label>
        </div>
    </div>
    <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-5">
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="font-medium"> When was your most recent vaccination?</label>
        </div>
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <input
                class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                type="text"
                v-model="form.medical.vaccination">
            <p class="text-red-600 text-xs italic" v-if="error.vaccination">{{ error.vaccination[0] }}</p>

        </div>
    </div>
    <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-5">
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="font-medium"> Do You have any allergies</label>
        </div>
        <div class="flex justify-between sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="items-center">
                <input class="form-checkbox h-5 w-5 text-blue-600" type="radio"   v-model="form.medical.allergies" :value="0">
                <span class="ml-2 text-gray-700">yes</span>
            </label>
            <label class="items-center">
                <input class="form-checkbox h-5 w-5 text-blue-600" type="radio"  v-model="form.medical.allergies" :value="1">
                <span class="ml-2 text-gray-700">No</span>
            </label>
        </div>
    </div>
    <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-5">
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="font-medium"> What are they?</label>
        </div>
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <input
                class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                type="text"
                v-model="form.medical.what_are_they">
            <p class="text-red-600 text-xs italic" v-if="error.what_are_they">{{ error.what_are_they[0] }}</p>

        </div>
    </div>
    <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-5">
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="font-medium"> Do you carry any medication in case of emergency?</label>
        </div>
        <div class="flex justify-between sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="items-center">
                <input class="form-checkbox h-5 w-5 text-blue-600" type="radio" v-model="form.medical.case_of_emergency" :value="0">
                <span class="ml-2 text-gray-700">yes</span>
            </label>
            <label class="items-center">
                <input class="form-checkbox h-5 w-5 text-blue-600" type="radio" v-model="form.medical.case_of_emergency" :value="1">
                <span class="ml-2 text-gray-700">No</span>
            </label>
        </div>
    </div>
    <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-5">
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="font-medium"> What medication?</label>
        </div>
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <input
                class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                type="text"
                v-model="form.medical.medication">
            <p class="text-red-600 text-xs italic" v-if="error.medication">{{ error.medication[0] }}</p>

        </div>
    </div>
    <div class="flex justify-end mt-8">
        <button
            @click="formSubmitted"
            class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-50 px-4 py-3 leading-6 rounded border-primary-700 bg-emerald-400 text-white hover:text-white hover:bg-primary-800 hover:border-primary-800 focus:ring focus:ring-primary-500 focus:ring-opacity-50 active:bg-primary-700 active:border-primary-700">
            Save Changes
        </button>
    </div>
</template>

<script>
    import {byMethod, get} from "@/libs/api";
    import {form} from "@/libs/mixins";

    export default {
        name: "medical",
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
                resource: '/medical',
                error: {},
                store: '/api/user',
                method: 'POST',
            }
        },
        created() {
            this.form.medical = {}
            get('api/medical/' + this.id).then(res => {

                // console.log(res.data.form.medical);
                if (res.data.form.medical) {
                    this.form = res.data.form;
                }

                this.form.medical.user_id =this.id;

                // console.log(res)
            })
        },
        methods: {
            formSubmitted() {
                byMethod('POST', '/api/medical/' + this.id, this.form.medical).then(res => {
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                        type: 'success',
                        duration: 3000
                    });
                    this.$emit('tabChange', 'submitInformation');
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
