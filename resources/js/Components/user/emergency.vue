<template>
    <div class="p-6">
<!--    <h1 class="font-bold">Emergency Contact</h1>-->
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2  sm:mb-0 p-2">
                <label class="font-medium"> First Name</label>
                <input   class="block border border-gray-200 rounded  w-full"
                    placeholder="Enter your first name" type="text" v-model="form.emergency.first_name">
                <p class="text-red-600 text-xs italic" v-if="error.first_name">{{ error.first_name[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2  sm:mb-0 p-2">
                <label class="font-medium"> Last Name</label>
                <input class="block border border-gray-200 rounded  w-full" placeholder="Enter your last name" type="text" v-model="form.emergency.last_name">
                <p class="text-red-600 text-xs italic" v-if="error.last_name">{{ error.last_name[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2  sm:ml-0 p-2 ">
                <label class="font-medium">Mobile Number</label>
                <input class="block border border-gray-200 rounded  w-full"  placeholder="Enter your Mobile Number" type="number" v-model="form.emergency.mobile_number">
                <p class="text-red-600 text-xs italic" v-if="error.mobile_number">{{ error.mobile_number[0] }}</p>
            </div>
        </div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2  sm:ml-0 p-2 ">
                <label class="font-medium">Country</label>
                <typeahead :initialize="form.emergency.country"
                           :url="countries" @input="onCountries"
                           display="title"
                />
                <p class="text-red-600 text-xs italic" v-if="error.country_id">{{ error.country_id[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2  sm:mb-0 p-2">
                <label class="font-medium">Relationship</label>
                <input class="block border border-gray-200 rounded  w-full"  type="text" v-model="form.emergency.relationship" >
                <p class="text-red-600 text-xs italic" v-if="error.relationship">{{ error.relationship[0] }}</p>

            </div>
            <div class="w-full sm:w-1/2  sm:ml-0 p-2 ">
                <label class="font-medium" >Email</label>
                <input class="block border border-gray-200 rounded  w-full" placeholder="Enter your email" type="email" v-model="form.emergency.email">
                <p class="text-red-600 text-xs italic" v-if="error.email">{{ error.email[0] }}</p>
            </div>
        </div>
        <h1 class="font-bold" >Home Emergency Contact</h1>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center mt-2">
            <div class="w-full sm:w-1/2  sm:mb-0 p-2">
                <label class="font-medium"> First Name</label>
                <input class="block border border-gray-200 rounded  w-full" placeholder="Enter your first name" type="text" v-model="form.emergency.f_n_1">
                <p class="text-red-600 text-xs italic" v-if="error.f_n_1">{{ error.f_n_1[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2  sm:mb-0 p-2">
                <label class="font-medium"> Last Name</label>
                <input class="block border border-gray-200 rounded  w-full" placeholder="Enter your last name" type="text" v-model="form.emergency.l_n_2" >
                <p class="text-red-600 text-xs italic" v-if="error.l_n_2">{{ error.l_n_2[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2  sm:ml-0 p-2 ">
                <label class="font-medium" >Mobile Number</label>
                <input class="block border border-gray-200 rounded  w-full"  placeholder="Enter your Mobile Number" type="number" v-model="form.emergency.mobile_number_2">
                <p class="text-red-600 text-xs italic" v-if="error.mobile_number_2">{{ error.mobile_number_2[0] }}</p>
            </div>
        </div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">

            <div class="w-full sm:w-1/2  sm:ml-0 p-2 ">
                <label class="font-medium">Country</label>
                <typeahead :initialize="form.emergency.country"
                           :url="countries" @input="onCountries"
                           display="title"
                />
                <p class="text-red-600 text-xs italic" v-if="error.country_id">{{ error.country_id[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2  sm:ml-0 p-2 ">
                <label class="font-medium">City/Town</label>
                <typeahead :initialize="form.emergency.city"
                           :url=" form.emergency.country_id != null ? `/api/city?country_id=${form.emergency.country_id}` : cities"
                           @input="onCities"
                           display="title"
                />
                <p class="text-red-600 text-xs italic" v-if="error.city_id">{{ error.city_id[0] }}</p>
            </div>
        </div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2  sm:mb-0 p-2">
                <label class="font-medium">Relationship</label>
                <input
                    class="block border border-gray-200 rounded  w-full"  type="text" v-model="form.emergency.relationship_2" >
                <p class="text-red-600 text-xs italic" v-if="error.relationship_2">{{ error.relationship_2[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2  sm:ml-0 p-2 ">
                <label class="font-medium" >Email</label>
                <input
                    class="block border border-gray-200 rounded  w-full" placeholder="Enter your email" type="email" v-model="form.emergency.email_2">
                <p class="text-red-600 text-xs italic" v-if="error.email_2">{{ error.email_2[0] }}</p>
            </div>

        </div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">

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
    import Typeahead from "@/Components/typeahead/typeahead.vue";
    export default {
        components: {Typeahead},
        mixins: [form],
        name: "emergency",
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
                cities: '/api/city',
                countries: '/api/country',
                resource: '/emergency',
                error: {},
                store: '/api/user',
                method: 'POST',
            }
        },
        created() {
            this.form.emergency = {}
            get('api/emergency/' + this.id).then(res => {
                if (res.data.form.emergency){
                    this.form = res.data.form;
                    // this.form.emergency.city = res.data.form.city
                    // this.form.emergency.city_id = res.data.form.city_id
                    // this.form.emergency.country = res.data.form.country
                    // this.form.emergency.country_id = res.data.form.country_id
                }
                this.form.emergency.user_id =this.id;
            })
        },
        methods: {
            onCities(e) {
                const city = e.target.value
                this.form.emergency.city = city
                this.form.emergency.city_id = city.id
            },
            onCountries(e) {
                const country = e.target.value
                if (this.form.emergency.country_id != country.id) {
                    this.form.emergency.city = null
                    this.form.emergency.city_id = null
                }
                this.form.emergency.country = country
                this.form.emergency.country_id = country.id

            },
            formSubmitted() {
                byMethod('POST', '/api/emergency/' + this.id, this.form.emergency).then(res => {
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                        type: 'success',
                        duration: 3000
                    });
                    this.$emit('tabChange', 'bankAccount');
                }).catch(err => {
                    this.error = err.response.data.errors;
                    this.$toast.open({
                        position: 'top-right',
                        message: 'Error',
                        type: 'error',
                        duration: 3000
                    });
                    console.log(err);
                })
            },
        }
    }
</script>

<style scoped>

</style>
