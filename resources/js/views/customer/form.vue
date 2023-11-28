<template>
    <div class="p-4" v-if="show">
        <h1  class="mb-4 border-b-2 border-gray-200 py-2 text-2xl font-bold dark:border-gray-700 lg:mb-8">
            {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: `Add New ${capital}`}}
        </h1>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <!-- <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label class="block font-medium text-sm text-gray-700 mb-2">Date <span class="text-red-600">*</span></label>
                <input
                    class="w-full py-1 px-2 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    type="date" v-model="form.date"/>
                <p class="text-red-600 text-xs italic" v-if="error.date">{{ error.date[0] }}</p>
            </div> -->
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label class="block font-medium text-sm text-gray-700 mb-2">Customer <span class="text-red-600">*</span></label>
                <input
                    class="w-full py-1 px-2 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    type="text" v-model="form.name"/>
                <p class="text-red-600 text-xs italic" v-if="error.name">{{ error.name[0] }}</p>
            </div>

            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Category</label>
                <typeahead :initialize="form.category" :url="categorys" @input="onCategory"
                           display="customer_category"/>
                <p class="text-red-600 text-xs italic" v-if="error.category_id">{{error.category_id[0] }}</p>
            </div>
        </div>
        <hr class="mt-6">
        <h1 class="font-bold mt-2 mb-2">Personal Contact</h1>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0 relative">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Email <span class="text-red-600">*</span></label>
                <input
                    class="w-full py-1 px-2 bg-white border border-gray-300 rounded-md"
                    type="email"
                    v-model="form.email"
                />
                <p class="text-red-600 text-xs italic" v-if="error.email">{{error.email[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Phone <span class="text-red-600">*</span></label>
                <input
                    class="w-full py-1 px-2 bg-white border border-gray-300 rounded-md"
                    type="text"
                    v-model="form.phone"
                    @input="form.phone = form.phone.replace(/[^0-9]/g, '')"
                />
                <p class="text-red-600 text-xs italic" v-if="error.phone">{{error.phone[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >CNIC </label>
                <input
                    class="w-full py-1 px-2 bg-white border border-gray-300 rounded-md"
                    type="text"
                    v-model="form.cnic"
                    @input="form.cnic = form.cnic.replace(/[^0-9]/g, '')"
                />
               <!-- <p class="text-red-600 text-xs italic" v-if="error.cnic">{{error.cnic[0] }}</p> -->
            </div>
        </div>
        <hr class="mt-6">
        <h1 class="font-bold mt-2 mb-2">Billing Address</h1>
<!--        <h1  class="mb-4 border-b-2 border-gray-200 py-2 text-2xl font-bold dark:border-gray-700 lg:mb-8">Billing Address</h1>-->
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center" style="position: relative">
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Name</label>
                <input
                    class="w-full py-1 px-2 bg-white border border-gray-300 rounded-md"
                    v-model="form.b_name"
                />
                <p class="text-red-600 text-xs italic" v-if="error.b_name">{{error.b_name[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2">Phone</label>
                <input
                    class="w-full py-1 px-2 bg-white border border-gray-300 rounded-md"
                    type="text"
                    v-model="form.b_phone"
                    @input="form.b_phone = form.b_phone.replace(/[^0-9]/g, '')"
                />
                <p class="text-red-600 text-xs italic" v-if="error.b_phone">{{error.b_phone[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Country:</label>
                <typeahead :initialize="form.b_country" :url="countries" @input="onCountries($event,'b_')"
                           display="name"/>
                <!--                    <p class="text-red-600 text-xs italic" v-if="error.b_address_1">{{error.b_address_1[0] }}</p>-->
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2 relative"
                >City:</label>
                <typeahead :initialize="form.b_city"
                           :url="form.b_country_id != null ? `/api/city?country_id=${form.b_country_id}` : cities"
                           @input="onCities($event,'b_city')" display="name"/>
                <!--                    <p class="text-red-600 text-xs italic" v-if="error.b_address_2">{{error.b_address_2[0] }}</p>-->
            </div>
        </div>

        <div class="flex-auto flex flex-col sm:flex-row sm:items-center mt-2">
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Address #1</label>
                <input
                    class="w-full py-1 px-2 bg-white border border-gray-300 rounded-md"
                    v-model="form.b_address_1"
                />
                <p class="text-red-600 text-xs italic" v-if="error.b_address_1">{{error.b_address_1[0] }}</p>
            </div>
        </div>
        <hr class="mt-6">
        <h1 class="font-bold mt-2">Shipping Address  <input type="checkbox" class="form-checkbox h-6 w-6 text-indigo-600" @click="showShipment" v-model="form.copyBilling"></h1>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center mt-2">
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Name</label>
                <input
                    class="w-full py-1 px-2 bg-white border border-gray-300 rounded-md"
                    v-model="form.s_name"
                />
                <p class="text-red-600 text-xs italic" v-if="error.s_name">{{error.s_name[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Phone</label>
                <input
                    class="w-full py-1 px-2 bg-white border border-gray-300 rounded-md"
                    type="text"
                    v-model="form.s_phone"
                    @input="form.s_phone = form.s_phone.replace(/[^0-9]/g, '')"
                />
                <p class="text-red-600 text-xs italic" v-if="error.s_phone">{{error.s_phone[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Country:</label>
                <typeahead :initialize="form.s_country" :url="countries" @input="onCountries($event,'s_')" display="name"/>
                <!--                    <p class="text-red-600 text-xs italic" v-if="error.s_address_1">{{error.s_address_1[0] }}</p>-->
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >City:</label>
                <typeahead :initialize="form.s_city"
                           :url="form.s_country_id != null ? `/api/city?country_id=${form.s_country_id}` : cities"
                           @input="onCities($event,'s_city')" display="name"/>
                <!--                    <p class="text-red-600 text-xs italic" v-if="error.s_address_2">{{error.s_address_2[0] }}</p>-->
            </div>
        </div>

        <div class="flex-auto flex flex-col sm:flex-row sm:items-center mt-2">
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Address #1</label>
                <input
                    class="w-full py-1 px-2 bg-white border border-gray-300 rounded-md"
                    v-model="form.s_address_1"
                />
                <p class="text-red-600 text-xs italic" v-if="error.s_address_1">{{error.s_address_1[0] }}</p>
            </div>
        </div>
        <div class="flex justify-end mt-8 space-x-4">
            <!-- <button
                @click="formSubmitted"
                class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white hover:bg-blue-600 transition duration-200 ease-in-out"
                type="button">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Add" }}
            </button> -->
            <button :disabled="isSubmitting" @click="formSubmitted"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white hover:bg-blue-600  transition duration-200 ease-in-out"

            >
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
                @click="additionalProp ? successfully():successfull()"
                class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white hover:bg-red-600 transition duration-200 ease-in-out"
                type="button">
                Cancel
            </button>
        </div>

    </div>
</template>

<script>
    import {byMethod, get} from '@/libs/api'
    import {form} from '@/libs/mixins'
    import Typeahead from "@/Components/typeahead/typeahead.vue";
    import moment from "moment";


    function initialize(to) {
        let urls = {
            add: `/api/customer/create`,
            edit: `/api/customer/${to.params.id}/edit`,
        }
        return urls[to.meta.mode] || urls.add
    }

    export default {
        mixins: [form],
        components: {
            Typeahead,
        },
         props: {
            show: Boolean,
            additionalProp: String,
        },
        data() {
            return {
                error: {},
                show: false,
                isSubmitting: false,
                resource: '/customer',
                show: Boolean,
                store: '/api/customer',
                method: 'POST',
                small: 'customer',
                capital: 'Customer',
                title: 'Add',
                message: 'New Customer Added',
                permissions: {},
                categorys: '/api/category',
                cities: '/api/city',
                countries: '/api/country',
                form: {
                    copyBilling: false
                }
            }
        },
        created() {
            this.form.date = moment().format('YYYY-MM-DD');
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
            showShipment() {
                if (this.form.copyBilling) {
                    this.form.s_name = this.form.b_name;
                    this.form.s_phone = this.form.b_phone;
                    this.form.s_address_1 = this.form.b_address_1;
                    this.form.s_address_2 = this.form.b_address_2;
                    this.form.s_country = this.form.b_country;
                    this.form.s_city = this.form.b_city;
                } else {
                    this.form.s_name = '';
                    this.form.s_phone = '';
                    this.form.s_address_1 = '';
                    this.form.s_address_2 = '';
                    this.form.s_country = '';
                    this.form.s_city = '';
                }

            },
            onCities(e, key) {
                const city = e.target.value
                this.form[key] = city
                this.form[key + '_id'] = city.id
            },
            onCountries(e, key) {
                const country = e.target.value
                if (this.form[key + 'country_id'] != country.id) {
                    this.form[key + 'city'] = null
                    this.form[key + 'city_id'] = null
                }
                this.form[key + 'country'] = country
                this.form[key + 'country_id'] = country.id
            },
            onCategory(e) {
                const category = e.target.value
                this.form.category = category
                this.form.category_id = category.id
            },
            setData(res) {
                this.form = res.data.form;
                if (this.$route.meta.mode === 'edit') {
                    this.store = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
                    this.title = 'Edit';
                    this.message = `${this.capital} has been updated`;
                }
                this.form.date = moment().format('YYYY-MM-DD');
                this.show = true
            },

            formSubmitted() {
                this.isSubmitting = true; // Disable the button and show the spinner
                this.form.selectedPermissions = this.selectedPermissions
                byMethod(this.method, this.store, this.form).then(res => {
                    this.additionalProp ? this.formSubmiting():this.successfull(res)
                    // this.successfull(res)
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
                    // console.log(err);
                })
                .finally(() => {
                this.isSubmitting = false; // Enable the button and hide the spinner
                });
            },
            successfull(res) {
                this.$router.push({path: `${this.resource}`})
            },
            successfully(res) {
                this.$emit('cancel-customer', {

                })
            },

            formSubmiting(){
                this.$emit('save-customer', {

            })
            }
        },
    }
</script>

<style scoped>

</style>
