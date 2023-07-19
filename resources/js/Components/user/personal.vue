<template>
    <div class="p-6">
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2  sm:mb-0 pl-3">
                <label class="font-medium">First Name</label>
                <input class="block border border-gray-200 rounded w-full" id="name" name="name"
                       placeholder="Enter your first name" type="text" v-model="form.firstname">
            </div>
            <div class="w-full sm:w-1/2  sm:mb-0  pl-3">
                <label class="font-medium">Last Name</label>
                <input class="block border border-gray-200 rounded w-full" id="lname" name="lname"
                       placeholder="Enter your last name" type="text" v-model="form.lastname">
            </div>
            <div class="w-full sm:w-1/2  sm:mb-0 pl-3 ">
                <label class="font-medium" for="gender">Gender</label>
                <select class="block border border-gray-200 rounded w-full" id="gender" v-model="form.gender">
                    <option selected>Choose a gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label class="font-medium" for="email">Email</label>
                <input class="block border border-gray-200 rounded w-full" disabled id="email"
                       name="email" placeholder="Enter your email" type="email" v-model="form.email">
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label class="font-medium" for="date_of_birth">Date Of Birth</label>
                <input class="block border border-gray-200 rounded w-full" id="date_of_birth" name="date_of_birth"
                       placeholder="Enter your date_of_birth" type="date" v-model="form.dob">
            </div>
            <div class="w-full sm:w-1/2 pl-3  sm:mb-0">
                <label class="font-medium" for="mobile_no">Mobile Number</label>
                <input class="block border border-gray-200 rounded w-full" disabled id="mobile_no"
                       name="mobile_no" placeholder="Enter your Mobile Number" type="number" v-model="form.mobile_no">
                <p class="text-red-600 text-xs italic" v-if="error.mobile_no">{{ error.mobile_no[0] }}</p>
            </div>
        </div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label class="font-medium">Nationality</label>
                <typeahead :initialize="form.nationality" :url="countries" @input="onNationality" display="title"/>
            </div>
            <div class="w-full sm:w-1/2 pl-3  sm:mb-0">
                <label class="font-medium">Country</label>
                <typeahead :initialize="form.country" :url="countries" @input="onCountries" display="title"/>
            </div>
            <div class="w-full sm:w-1/2 pl-3  sm:mb-0">
                <label class="font-medium">City/Town</label>
                <typeahead :initialize="form.city"
                           :url="form.country_id != null ? `/api/city?country_id=${form.country_id}` : cities"
                           @input="onCities" display="title"/>
            </div>
        </div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 pl-3  sm:mb-0">
                <label class="font-medium" for="address">Address</label>
                <textarea class="block border border-gray-200 rounded w-full" id="address" name="address"
                          placeholder="Enter your address" type="number" v-model="form.address"></textarea>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label class="font-medium" for="postal_code">Postal Code</label>
                <input class="block border border-gray-200 rounded w-full" id="postal_code" name="postal_code"
                       placeholder="Enter your postal_code" type="text" v-model="form.postal_code">
            </div>
        </div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 pl-3  sm:mb-0">
                <label class="font-medium" for="file">Upload CV</label>
                <input class="block border border-gray-200 rounded w-full" id="file" name="file" ref="file" type="file"
                       v-on:change="onFileChange">
                <div class="w-full sm:w-1/2 mb-4 sm:ml-0 p-2 " v-if="form.cv != null">
                    <a :href="`uploads/basic_info/file/` + form.cv" target="_blank">file</a>
                </div>
            </div>
            <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                <label class="font-medium" for="profile_picture">Profile Picture</label>
                <input class="block border border-gray-200 rounded w-full" id="profile_picture" name="profile_picture"
                       type="file" v-on:change="onImageChange">
                <img :src="ImgUrl" v-if="ImgUrl">
                <div class="w-full sm:w-1/2 mb-4 sm:ml-0 p-2 " v-else-if="form.img != null">
                    <img :src="`uploads/basic_info/img/`+form.img">
                </div>
            </div>
        </div>
        <div class="flex justify-end mt-8">
            <button @click="formSubmitted"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-50 px-4 py-3 leading-6 rounded border-primary-700 bg-emerald-400 text-white hover:text-white hover:bg-primary-800 hover:border-primary-800 focus:ring focus:ring-primary-500 focus:ring-opacity-50 active:bg-primary-700 active:border-primary-700">
                Submit
            </button>
        </div>
    </div>
</template>

<script>
    import Typeahead from "@/Components/typeahead/typeahead.vue";
    import {byMethod, get} from "@/libs/api";
    import {objectToFormData} from "@/libs/helpers";
    import {form} from "@/libs/mixins";

    export default {
        components: {Typeahead},
        mixins: [form],
        name: "personal",
        props: {
            id: {
                required: false
            },
        },

        data() {
            return {
                error: {},
                file: null,
                ImgUrl: null,
                cities: '/api/city',
                countries: '/api/country',
                store: '/api/user',
                method: 'POST',
            }
        },
        created() {
            get('api/basic_info/' + this.id).then(res => {
                // console.log(res.data.form);
                this.form = res.data.form;
                // console.log(res)
            })
        },
        methods: {
            formSubmitted() {
                byMethod('POST', '/api/basic_info/' + this.id, objectToFormData(this.form)).then(res => {
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                        type: 'success',
                        duration: 3000
                    });
                    this.$emit('tabChange', 'eligibility');
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
            onCities(e) {
                const city = e.target.value
                this.form.city = city
                this.form.city_id = city.id
            },
            onCountries(e) {
                const country = e.target.value
                if (this.form.country_id != country.id) {
                    this.form.city = null
                    this.form.city_id = null
                }
                this.form.country = country
                this.form.country_id = country.id

            },
            onNationality(e) {
                const nationality = e.target.value
                this.form.nationality = nationality
                this.form.nationality_id = nationality.id

            },
            onImageChange(e) {
                // console.log('test')
                // console.log(e.target.files);
                this.form.imgN = e.target.files;
            },
            onFileChange(e) {
                this.form.CV = e.target.files;
                this.ImgUrl = URL.createObjectURL(e.target.files[0]);
            }
        }
    }
</script>
