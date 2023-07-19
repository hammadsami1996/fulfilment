<template>
    <h1 class="font-bold">Submit above filled information</h1>
    <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-1 ">
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="font-medium"> Personal information</label>
        </div>
        <svg class="w-6 h-6 text-indigo-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
            <path d="M4.5 12.75l6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-1 ">
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="font-medium">Eligibility to work</label>
        </div>
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <svg class="w-6 h-6 text-indigo-700" fill="none" stroke="currentColor" stroke-width="1.5"
                 v-if="form.eligibility" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.5 12.75l6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <svg aria-hidden="true"
                 class="hi-mini hi-x-mark inline-block w-5 h-5 text-gray-500 hover:text-gray-700 underline mr-2 border-b"
                 fill="currentColor"
                 v-else viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
            </svg>
        </div>
    </div>
    <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-1">
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="font-medium">References</label>
        </div>
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <svg class="w-6 h-6 text-indigo-700" fill="none" stroke="currentColor" stroke-width="1.5"
                 v-if="form.reference" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.5 12.75l6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <svg aria-hidden="true"
                 class="hi-mini hi-x-mark inline-block w-5 h-5 text-gray-500 hover:text-gray-700 underline mr-2 border-b"
                 fill="currentColor"
                 v-else viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
            </svg>
        </div>
    </div>
    <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-1">
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="font-medium">Emergency contact</label>
        </div>
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <svg class="w-6 h-6 text-indigo-700" fill="none" stroke="currentColor" stroke-width="1.5"
                 v-if="form.emergency " viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.5 12.75l6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <svg aria-hidden="true"
                 class="hi-mini hi-x-mark inline-block w-5 h-5 text-gray-500 hover:text-gray-700 underline mr-2 border-b"
                 fill="currentColor"
                 v-else viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
            </svg>
        </div>
    </div>
    <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-1">
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="font-medium">Bank account details</label>
        </div>
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <svg class="w-6 h-6 text-indigo-700" fill="none" stroke="currentColor" stroke-width="1.5" v-if="form.bank"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.5 12.75l6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <svg aria-hidden="true"
                 class="hi-mini hi-x-mark inline-block w-5 h-5 text-gray-500 hover:text-gray-700 underline mr-2 border-b"
                 fill="currentColor"
                 v-else viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
            </svg>
        </div>
    </div>
    <div class="flex-auto flex flex-col sm:flex-row sm:items-center pt-1">
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="font-medium">Medical information</label>
        </div>
        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <svg class="w-6 h-6 text-indigo-700" fill="none" stroke="currentColor" stroke-width="1.5"
                 v-if="form.medical" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.5 12.75l6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <svg aria-hidden="true"
                 class="hi-mini hi-x-mark inline-block w-5 h-5 text-gray-500 hover:text-gray-700 underline mr-2 border-b"
                 fill="currentColor"
                 v-else viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
            </svg>
        </div>
    </div>
    <div class="flex justify-end mt-8">
        <button
            @click="formSubmitted"
            class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-50 px-4 py-3 leading-6 rounded border-primary-700 bg-emerald-400 text-white hover:text-white hover:bg-primary-800 hover:border-primary-800 focus:ring focus:ring-primary-500 focus:ring-opacity-50 active:bg-primary-700 active:border-primary-700"
        >
            Submitted
        </button>
    </div>
</template>

<script>
    import {byMethod} from "@/libs/api";
    import {form} from "@/libs/mixins";

    export default {
        mixins: [form],
        data() {
            return {
                resource: '/user',
                error: {},
                store: '/api/user',
                method: 'POST',
            }
        },
        props: {
            id: {
                required: false
            },
        },
        name: "submit_information",
        created() {
            byMethod('GET', 'api/user/' + this.id).then(res => {
                this.form = res.data.data;
            })
        },
        methods: {
            formSubmitted() {
                byMethod('get', '/api/submit/' + this.id, this.form).then(res => {
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                        type: 'success',
                        duration: 3000
                    });
                    // this.$emit('tabChange', 'emergency');
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

<style scoped>

</style>
