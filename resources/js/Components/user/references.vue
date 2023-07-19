<template>
    <div class="p-6">
        <div class="flex justify-between">
            <div class="w-full sm:w-1/2 bg-gray-300 sm:mb-4">
                <h1 class="font-bold text-center">References 1</h1>
                <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                    <div class="w-full sm:w-1/2 sm:mb-0 p-2">
                        <label class="font-medium">Referee first name</label>
                        <input
                            class="block border border-gray-200 rounded w-full"
                            type="text"
                            v-model="form.reference.refree_f_n"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.refree_f_n">{{ error.refree_f_n[0] }}</p>

                    </div>
                    <div class="w-full sm:w-1/2 sm:mb-0 p-2">
                        <label class="font-medium">Referee last name</label>
                        <input
                            class="block border border-gray-200 rounded w-full"
                            type="text"
                            v-model="form.reference.refree_l_n"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.refree_l_n">{{ error.refree_l_n[0] }}</p>

                    </div>
                </div>
                <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                    <div class="w-full sm:w-1/2 sm:mb-0 p-2">
                        <label class="font-medium">Email</label>
                        <input
                            class="block border border-gray-200 rounded w-full"
                            type="text"
                            v-model="form.reference.email"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.email">{{ error.email[0] }}</p>

                    </div>
                    <div class="w-full sm:w-1/2 sm:mb-0 p-2">
                        <label class="font-medium">Contact Number</label>
                        <input
                            class="block border border-gray-200 rounded w-full"
                            type="number"
                            v-model="form.reference.contact_number"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.contact_number">{{ error.contact_number[0] }}</p>

                    </div>
                </div>
                <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                    <div class="w-full sm:w-1/2 sm:mb-0 p-2">
                        <label class="font-medium">Personal Type</label>
                        <select class="block border border-gray-200 rounded w-full" v-model="form.personal_type">
                            <option value="male">Personal</option>
                            <option value="female">Professional</option>
                        </select>
<!--                        <p class="text-red-600 text-xs italic" v-if="error.personal_type">{{ error.personal_type[0] }}</p>-->

                    </div>
                    <div class="w-full sm:w-1/2 sm:mb-0 p-2">
                        <label class="font-medium">How do you know that person?</label>
                        <input
                            class="block border border-gray-200 rounded w-full"
                            type="text"
                            v-model="form.reference.know_person"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.know_person">{{ error.know_person[0] }}</p>

                    </div>
                </div>
            </div>
            <div class="w-full sm:w-1/2 bg-gray-300 sm:mb-4 border-l-4">
                <h1 class="font-bold text-center">References 2</h1>
                <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                    <div class="w-full sm:w-1/2 sm:mb-0 p-2">
                        <label class="font-medium">Referee first name</label>
                        <input
                            class="block border border-gray-200 rounded w-full"
                            type="text"
                            v-model="form.reference.refree_f_n_2"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.refree_f_n_2">{{ error.refree_f_n_2[0] }}</p>

                    </div>
                    <div class="w-full sm:w-1/2 sm:mb-0 p-2">
                        <label class="font-medium">Referee last name</label>
                        <input
                            class="block border border-gray-200 rounded w-full"
                            type="text"
                            v-model="form.reference.refree_l_n_2"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.refree_l_n_2">{{ error.refree_l_n_2[0] }}</p>

                    </div>
                </div>
                <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                    <div class="w-full sm:w-1/2 sm:mb-0 p-2">
                        <label class="font-medium">Email</label>
                        <input
                            class="block border border-gray-200 rounded w-full"
                            type="text"
                            v-model="form.reference.email_2"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.email_2">{{ error.email_2[0] }}</p>

                    </div>
                    <div class="w-full sm:w-1/2 sm:mb-0 p-2">
                        <label class="font-medium">Contact Number</label>
                        <input
                            class="block border border-gray-200 rounded w-full"
                            type="number"
                            v-model="form.reference.contact_number_2"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.contact_number_2">{{ error.contact_number_2[0] }}</p>

                    </div>
                </div>
                <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                    <div class="w-full sm:w-1/2 sm:mb-0 p-2">
                        <label class="font-medium">Personal Type</label>
                        <select class="block border border-gray-200 rounded w-full" v-model="form.personal_type_2">
                            <option value="male">Personal</option>
                            <option value="female">Professional</option>
                        </select>
<!--                        <p class="text-red-600 text-xs italic" v-if="error.personal_type_2">{{ error.personal_type_2[0] }}</p>-->

                    </div>
                    <div class="w-full sm:w-1/2 sm:mb-0 p-2">
                        <label class="font-medium">Relationship</label>
                        <input
                            class="block border border-gray-200 rounded w-full"
                            type="text"
                            v-model="form.reference.relationship"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.relationship">{{ error.relationship[0] }}</p>

                    </div>
                </div>
                <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                    <div class="w-full sm:w-1/2 sm:mb-0 p-2">
                        <label class="font-medium">Company</label>
                        <input
                            class="block border border-gray-200 rounded w-full"
                            type="text"
                            v-model="form.reference.company"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.company">{{ error.company[0] }}</p>

                    </div>
                    <div class="w-full sm:w-1/2 sm:mb-0 p-2">
                        <label class="font-medium">Start Date</label>
                        <input
                            class="block border border-gray-200 rounded w-full"
                            type="date"
                            v-model="form.reference.start_date"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.start_date">{{ error.start_date[0] }}</p>

                    </div>
                </div>
                <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                    <div class="w-full sm:w-1/2 sm:mb-0 p-2">
                        <label class="font-medium">Last Date</label>
                        <input
                            class="block border border-gray-200 rounded w-full"
                            type="date"
                            v-model="form.reference.last_date"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.last_date">{{ error.last_date[0] }}</p>

                    </div>
                    <div class="w-full sm:w-1/2 sm:mb-0 p-2">
                        <label class="flex items-center" for="checkbox">
                            <input
                                class="form-checkbox h-5 w-5 text-blue-600"
                                id="checkbox"
                                type="checkbox"
                                v-model="form.reference.still_emp"
                            />
                            <span class="ml-2 text-gray-700">Still Employed</span>
<!--                            <p class="text-red-600 text-xs italic" v-if="error.refree_f_n">{{ error.refree_f_n[0] }}</p>-->

                        </label>
                    </div>
                </div>
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
        name: "references",
        props: {
            id: {
                required: false
            },
        },
        data() {
            return {
                resource: '/reference',
                error: {},
                store: '/api/user',
                method: 'POST',
            }
        },
        created() {
            this.form.reference = {}
            byMethod('GET', 'api/reference/' + this.id).then(res => {
                if (res.data.form.reference) {
                    this.form = res.data.form;
                }
                this.form.reference.user_id =this.id;
            })
        },
        methods: {
            formSubmitted() {
                byMethod('POST', '/api/reference/' + this.id, this.form.reference).then(res => {
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                        type: 'success',
                        duration: 3000
                    });
                    this.$emit('tabChange', 'emergency');
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
