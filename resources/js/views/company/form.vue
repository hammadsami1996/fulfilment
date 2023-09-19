<template>
    <div v-if="show">
        <div class="p-6">
            <h1 class="text-lg font-bold mb-4">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: `Add New ${capital}`}}
            </h1>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >Name <span class="text-red-600">*</span></label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        placeholder=" Name"
                        v-model="form.name"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.name">{{ error.name[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >Email <span class="text-red-600">*</span></label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        placeholder=" Email" type="email"
                        v-model="form.email"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.email">{{ error.email[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >Phone <span class="text-red-600">*</span></label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="number"
                        v-model="form.phone"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.phone">{{ error.phone[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >Tax Number</label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="number"
                        v-model="form.tax_number"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.tax_number">{{ error.tax_number[0] }}</p>
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">

                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Country:</label>
                    <typeahead :initialize="form.country" :url="countries" @input="onCountries"
                               display="name"/>
                    <!--                    <p class="text-red-600 text-xs italic" v-if="error.b_address_1">{{error.b_address_1[0] }}</p>-->
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >City:</label>
                    <typeahead :initialize="form.city"
                               :url="form.country_id != null ? `/api/city?country_id=${form.country_id}` : cities"
                               @input="onCities($event,'city')" display="name"/>
                    <!--                    <p class="text-red-600 text-xs italic" v-if="error.b_address_2">{{error.b_address_2[0] }}</p>-->
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >Postal/ Zip Code</label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="number"
                        v-model="form.postal"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.postal">{{ error.postal[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >Province/State</label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="text"
                        v-model="form.province"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.province">{{ error.province[0] }}</p>
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >Address <span class="text-red-600">*</span></label>
                    <textarea
                        class="w-full py-2 px-3 bg-white border border-gray-300 rounded-md"
                        type="text"
                        v-model="form.address"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.address">{{ error.address[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >Logo</label>
                    <div class="flex items-center">
                        <input
                            class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                            id="profile_picture"
                            name="profile_picture" type="file" v-on:change="onImageChange">
                        <img width="100" :src="ImgUrl" v-if="ImgUrl">
                        <div class="w-full sm:w-1/2 mb-4 sm:ml-0 p-2 " v-else-if="form.logo">
                            <img width="100" :src="`/uploads/company/logo/`+form.logo">
                        </div>
                    </div>

                    <p class="text-red-600 text-xs italic" v-if="error.logo">{{ error.logo[0] }}</p>
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
    </div>
</template>

<script>
    import {byMethod, get} from '@/libs/api'
    import {form} from '@/libs/mixins'
    import Typeahead from "@/Components/typeahead/typeahead.vue";
    import {objectToFormData} from "@/libs/helpers";


    function initialize(to) {
        let urls = {
            add: `/api/company/create`,
            edit: `/api/company/${to.params.id}/edit`,
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
                ImgUrl: null,
                error: {},
                show: false,
                resource: '/company',
                store: '/api/company',
                method: 'POST',
                small: 'company',
                capital: 'Company',
                title: 'Add',
                message: 'New company Added',
                permissions: {},
                cities: '/api/city',
                countries: '/api/country',
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
            onImageChange(e) {
                // console.log('test')
                this.form.imgN = e.target.files;
                // console.log(e.target.files);
                this.ImgUrl = URL.createObjectURL(e.target.files[0]);
            },
            onCities(e) {
                const city = e.target.value
                this.form.city = city
                this.form.city_id = city.id
            },
            onCountries(e) {
                const country = e.target.value
                this.form.country = country
                this.form.country_id = country.id
            },
            setData(res) {
                // console.log(res);
                this.form = res.data.form;
                if (this.$route.meta.mode === 'edit') {
                    this.store = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
                    this.title = 'Edit';
                    this.message = `${this.capital} has been updated`;
                }
                this.show = true
            },

            formSubmitted() {
                byMethod(this.method, this.store, objectToFormData(this.form)).then(res => {
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
