<template>
    <div class="p-4" v-if="show">
        <h1 class="text-lg font-bold mb-4">
            {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: `Add New ${capital}`}}
        </h1>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label class="block font-medium text-sm text-gray-700 mb-2">Date *</label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    type="date" v-model="form.date"/>
                <p class="text-red-600 text-xs italic" v-if="error.date">{{ error.date[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label class="block font-medium text-sm text-gray-700 mb-2">Customer</label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    type="text" v-model="form.name"/>
                <p class="text-red-600 text-xs italic" v-if="error.name">{{ error.name[0] }}</p>
            </div>
        </div>

        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Category</label>
                <typeahead :initialize="form.category" :url="categorys" @input="onCategory"
                           display="customer_category"/>
                <p class="text-red-600 text-xs italic" v-if="error.category_id">{{error.category_id[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Type</label>
                <typeahead :initialize="form.type" :url="typess" @input="onType" display="name"/>
                <p class="text-red-600 text-xs italic" v-if="error.type_id">{{error.type_id[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Balance</label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md"
                    type="number"
                    v-model="form.balance"

                />
                <p class="text-red-600 text-xs italic" v-if="error.balance">{{error.balance[0] }}</p>
            </div>
        </div>
        <hr class="mt-6">
        <h1 class="font-bold mt-2">Personal Contact</h1>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Email</label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md"
                    type="email"
                    v-model="form.email"
                />
                <p class="text-red-600 text-xs italic" v-if="error.email">{{error.email[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Phone</label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md"
                    type="number"
                    v-model="form.phone"
                />
                <p class="text-red-600 text-xs italic" v-if="error.phone">{{error.phone[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >CNIC</label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md"
                    type="number"
                    v-model="form.cnic"
                />
<!--                <p class="text-red-600 text-xs italic" v-if="error.cnic">{{error.cnic[0] }}</p>-->
            </div>
        </div>
        <hr class="mt-6">
        <h1 class="font-bold mt-2">Billing Address</h1>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Name</label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md"
                    v-model="form.b_name"
                />
                <p class="text-red-600 text-xs italic" v-if="error.b_name">{{error.b_name[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Phone</label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md"
                    type="number"
                    v-model="form.b_phone"
                />
                <p class="text-red-600 text-xs italic" v-if="error.b_phone">{{error.b_phone[0] }}</p>
            </div>
        </div>

        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Address #1</label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md"
                    v-model="form.b_address_1"
                />
                <p class="text-red-600 text-xs italic" v-if="error.b_address_1">{{error.b_address_1[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Address #2</label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md"
                    v-model="form.b_address_2"
                />
                <p class="text-red-600 text-xs italic" v-if="error.b_address_2">{{error.b_address_2[0] }}</p>
            </div>
        </div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <!--            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">-->
            <!--                <label-->
            <!--                    class="block font-medium text-sm text-gray-700 mb-2"-->
            <!--                >State:</label>-->
            <!--                <typeahead :initialize="form.nationality" :url="countries" @input="onNationality" display="title"/>-->
            <!--                &lt;!&ndash;                    <p class="text-red-600 text-xs italic" v-if="error.b_address_2">{{error.b_address_2[0] }}</p>&ndash;&gt;-->
            <!--            </div>-->
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Country:</label>
                <typeahead :initialize="form.b_country" :url="countries" @input="onCountries($event,'b_')"
                           display="title"/>
                <!--                    <p class="text-red-600 text-xs italic" v-if="error.b_address_1">{{error.b_address_1[0] }}</p>-->
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >City:</label>
                <typeahead :initialize="form.b_city"
                           :url="form.b_country_id != null ? `/api/city?country_id=${form.b_country_id}` : cities"
                           @input="onCities($event,'b_city')" display="title"/>
                <!--                    <p class="text-red-600 text-xs italic" v-if="error.b_address_2">{{error.b_address_2[0] }}</p>-->
            </div>
        </div>
        <hr class="mt-6">
        <h1 class="font-bold mt-2">Shipping Address  <input type="checkbox" class="form-checkbox h-6 w-6 text-indigo-600" @click="showShipment" v-model="form.copyBilling"></h1>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Name</label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md"
                    v-model="form.s_name"
                />
                <p class="text-red-600 text-xs italic" v-if="error.s_name">{{error.s_name[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Phone</label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md"
                    type="number"
                    v-model="form.s_phone"
                />
                <p class="text-red-600 text-xs italic" v-if="error.s_phone">{{error.s_phone[0] }}</p>
            </div>
        </div>

        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Address #1</label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md"
                    v-model="form.s_address_1"
                />
                <p class="text-red-600 text-xs italic" v-if="error.s_address_1">{{error.s_address_1[0] }}</p>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Address #2</label>
                <input
                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md"
                    v-model="form.s_address_2"
                />
                <p class="text-red-600 text-xs italic" v-if="error.s_address_2">{{error.s_address_2[0] }}</p>
            </div>
        </div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <!--            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">-->
            <!--                <label-->
            <!--                    class="block font-medium text-sm text-gray-700 mb-2"-->
            <!--                >State:</label>-->
            <!--                <typeahead :initialize="form.nationality" :url="countries" @input="onNationality" display="title"/>-->
            <!--                &lt;!&ndash;                    <p class="text-red-600 text-xs italic" v-if="error.s_address_2">{{error.s_address_2[0] }}</p>&ndash;&gt;-->
            <!--            </div>-->
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >Country:</label>
                <typeahead :initialize="form.s_country" :url="countries" @input="onCountries($event,'s_')" display="title"/>
                <!--                    <p class="text-red-600 text-xs italic" v-if="error.s_address_1">{{error.s_address_1[0] }}</p>-->
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                >City:</label>
                <typeahead :initialize="form.s_city"
                           :url="form.s_country_id != null ? `/api/city?country_id=${form.s_country_id}` : cities"
                           @input="onCities($event,'s_city')" display="title"/>
                <!--                    <p class="text-red-600 text-xs italic" v-if="error.s_address_2">{{error.s_address_2[0] }}</p>-->
            </div>
        </div>
        <div class="flex justify-end mt-8 space-x-4">
            <button
                @click="formSubmitted"
                class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                type="button">
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
        data() {
            return {
                error: {},
                show: false,
                resource: '/customer',
                store: '/api/customer',
                method: 'POST',
                small: 'customer',
                capital: 'Customer',
                title: 'Add',
                message: 'New Customer Added',
                permissions: {},
                typess: '/api/type',
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
                // console.log(this.form.copyBilling)
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
            // onNationality(e) {
            //     const nationality = e.target.value
            //     this.form.nationality = nationality
            //     this.form.nationality_id = nationality.id
            //
            // },
            onType(e) {
                const type = e.target.value
                this.form.type = type
                this.form.type_id = type.id
            },
            onCategory(e) {
                const category = e.target.value
                this.form.category = category
                this.form.category_id = category.id
            },
            setData(res) {
                console.log(res);
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
                    // console.log(err);
                })
            },
            successfull(res) {
                this.$router.push({path: `${this.resource}`})
            }
        },
    }
</script>

<style scoped>

</style>
