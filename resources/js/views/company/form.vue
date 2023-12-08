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
                        type="text"
                        v-model="form.phone"
                        @input="form.phone = form.phone.replace(/[^0-9]/g, '')"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.phone">{{ error.phone[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >Tax Number</label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="text"
                        v-model="form.tax_number"
                        @input="form.tax_number = form.tax_number.replace(/[^0-9]/g, '')"
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
                        type="text"
                        v-model="form.postal"
                        @input="form.postal = form.postal.replace(/[^0-9]/g, '')"
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
            <div class="p-2" v-if="$route.meta.mode == 'edit'" >
            <h1 class="text-2xl text-center font-bold mb-4">All Courier</h1>
            <div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Courier Name
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Authentication Key
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    active
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Action
                </th>
                </tr>
                </thead>
                <tbody class=" divide-y divide-gray-200">
                    <tr v-for="item in courierdata" :key="item.id">
                        <td class="px-6 py-4 whitespace-nowrap">{{item.name}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="w-full mb-4 sm:mb-0 ">

                                <input class="w-2/3 py-2 px-2 bg-white h-8 border border-gray-300 rounded-md" type="input" v-model="item.authentication_key"/>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-start">
                                <input class="form-checkbox h-5 w-5 text-blue-500" false-value=0 true-value=1 type="checkbox" v-model="item.active">
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium flex">
                                <span>
                                    <a @click.prevent="edit_All_Courier(item)" href="#">
                                        <i class="fa-solid fa-check-double text-2xl text-blue-400"></i>
                                    </a>
                                </span>
                            </div>
                        </td>
                    </tr>
                </tbody>
                </table>
            </div>
            </div>
        </div>
            <div class="flex justify-end mt-8 space-x-4">
                <!-- <button
                    @click="formSubmitted"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white hover:bg-blue-600  transition duration-200 ease-in-out"
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
                    @click="additionalProp ? successfully():successfull();  ( !additionalProp ? anotherFunction() : '')"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white hover:bg-red-600  transition duration-200 ease-in-out"
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
        props: {
            show: Boolean,
            additionalProp: String,
        },
        data() {
            return {
                ImgUrl: null,
                error: {},
                item: [],
                courierdata: [],
                // show: false,
                show: Boolean,
                key: '',
                resource: '/company',
                store: '/api/company',
                isSubmitting: false,
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
    //     mounted() {
    //     this.allcouriertabs();
    // },
        methods: {
            onImageChange(e) {
                this.form.imgN = e.target.files;
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
            allcouriertabs() {
                this.key = "All_Courier";
                // byMethod("get", `/api/settings/create?key=${this.key}&company_id=${this.company_id}&count=All`).then((res) => {
                    byMethod("get", "/api/courier").then((resp) => {
                        byMethod("get", `/api/settings/create?key=${this.key}&company_id=${this.$route.params.id}&count=All`).then((res) => {
                        this.courierdata = resp.data.data.data;
                        this.item = res.data.form;
                       
                        // Map authentication_key from form to courierdata
                        this.courierdata.forEach((courier) => {
                            const matchingForm = this.item.find((formItem) => formItem.value.id === courier.id);
                            if (matchingForm) {
                                courier.authentication_key = matchingForm.value.authentication_key;
                                courier.active = matchingForm.active;
                            }
                        });
                    });
                    });
            },
            edit_All_Courier(item) {
                console.log("form id"+this.$route.params.id);
                let data = {
                    data: item,
                }
                byMethod("post", `/api/other_setting?key=${this.key}&company_id=${this.$route.params.id}`, data).then((res) => {
                    if (res.data.saved) {
                        this.$toast.open({
                            position: "top-right",
                            message: "Successful",
                            type: "success",
                            duration: 3000,
                        });
                    }
                });
            },
            setData(res) {
                this.allcouriertabs();
                this.form = res.data.form;
                if (this.$route.meta.mode === 'edit') {
                    this.store = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
                    this.title = 'Edit';
                    this.message = `${this.capital} has been updated`;
                }
                this.show = true
            },
            formSubmitted() {
                this.isSubmitting = true; // Disable the button and show the spinner
                this.form.selectedPermissions = this.selectedPermissions
                byMethod(this.method, this.store, objectToFormData(this.form)).then(res => {
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

            // formSubmitted() {
            //     byMethod(this.method, this.store, objectToFormData(this.form)).then(res => {
            //         this.successfull(res)
            //         this.$toast.open({
            //             position: 'top-right',
            //             message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
            //             type: 'success',
            //             duration: 3000
            //         });
            //     }).catch(err => {
            //         this.error = err.response.data.errors;
            //         this.$toast.open({
            //             position: 'top-right',
            //             message: 'Error',
            //             type: 'error',
            //             duration: 3000
            //         });
            //     })
            // },
            successfull(res) {
                this.$router.push({path: `${this.resource}`})
                // this.$router.push(`${this.resource}/${this.$route.params.id}/edit`)
            },
            anotherFunction(){
                this.$router.push({path: `${this.resource}`})
            },
            successfully(res) {
                this.$emit('cancel-company', {

                })
            },

            formSubmiting(){
                this.$emit('save-company', {

            })
            }
        },
    }
</script>

<style scoped>

</style>
