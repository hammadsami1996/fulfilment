<template>
    <div v-if="show">
        <div class="p-6">
            <h1 class="text-lg font-bold mb-4">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: `Add New ${capital}`}}
            </h1>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                        for="mc-role-name"
                    >Name <span class="text-red-600">(Required)</span></label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        id="mc-role-name"
                        placeholder=" Name"
                        v-model="form.name"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.name">{{ error.name[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 sm:ml-4 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                        for="mc-role-guard_name"
                    >Description</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        id="mc-role-guard_name"
                        placeholder=" Name"
                        v-model="form.description"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.description">{{ error.description[0] }}</p>
                </div>
                <div class="w-20   p-2">
                    <label class="relative inline-block w-10 h-6">
                        <input class="hidden" type="checkbox"/>
                        <span class="rounded-full bg-gray-400 transition"></span>
                        <span
                            class="absolute top-0 left-0 w-4 h-4 rounded-full transition transform translate-x-0.5 translate-y-0.5 bg-white"></span>
                    </label>
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                        for="mc-role-guard_name"
                    >Status</label
                    >
                    <input
                        checked
                        class="form-switch transition-all duration-150 ease-out rounded-full h-7 w-12 text-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                        false-value="0"
                        role="switch"
                        true-value="1" type="checkbox" v-model="form.status"
                    />
                    <!--                    <p class="text-red-600 text-xs italic" v-if="error.status">{{ error.status[0] }}</p>-->
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="font-medium">Skills</label>
                    <typeahead :initialize="form.skill"
                               :url="skill" @input="onSkill"
                               display="name"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.skill_id">{{ error.skill_id[0] }}</p>

                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="font-medium">Location</label>
                    <typeahead :initialize="form.location"
                               :url="location" @input="onLocation"
                               display="name"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.location_id">{{ error.location_id[0] }}</p>

                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="font-medium">Specialities</label>
                    <typeahead :initialize="form.specialitiy"
                               :url="specialitiys" @input="onSpecialitiy"
                               display="name"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.specialitiy_id">{{ error.specialitiy_id[0] }}</p>

                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="font-medium">Type</label>
                    <typeahead :initialize="form.type"
                               :url="type" @input="onType"
                               display="name"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.type_id">{{ error.type_id[0] }}</p>

                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="font-medium">Role</label>
                    <typeahead :initialize="form.role"
                               :url="roles" @input="onRole"
                               display="name"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.role_id">{{ error.role_id[0] }}</p>

                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Last Date To Apply</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        placeholder=" Name" type="date"
                        v-model="form.last_date_to_apply"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.last_date_to_apply">{{
                        error.last_date_to_apply[0] }}</p>
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="font-medium">Short Description</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        v-model="form.short_des"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.short_des">{{ error.short_des[0] }}</p>

                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Salary</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md" type="number"
                        v-model="form.salary"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.salary">{{ error.salary[0] }}</p>
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:ml-0 p-2 ">
                    <label class="font-medium" for="profile_picture">Profile Picture</label>
                    <input

                        class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                        id="profile_picture"
                        name="profile_picture" type="file" v-on:change="onImageChange">
                    <img :src="ImgUrl" v-if="ImgUrl">
                    <div class="w-full sm:w-1/2 mb-4 sm:ml-0 p-2 " v-else-if="form.img != null">
                        <img :src="`../../uploads/job/img/`+form.img">
                    </div>
                    <p class="text-red-600 text-xs italic" v-if="error.img">{{ error.img[0] }}</p>
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
            add: `/api/job/create`,
            edit: `/api/job/${to.params.id}/edit`,
        }
        return urls[to.meta.mode] || urls.add
    }

    export default {
        mixins: [form],
        components: {
            Typeahead
            // Typeahead,
        },
        data() {
            return {
                ImgUrl: null,
                error: {},
                show: false,
                resource: '/job',
                store: '/api/job',
                method: 'POST',
                small: 'job',
                capital: 'Job',
                title: 'Add',
                message: 'New job Added',
                skill: '/api/job_skill',
                location: '/api/location',
                specialitiys: '/api/job_speciality',
                type: '/api/job_type',
                roles: '/api/job_role',
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
                this.form.img = e.target.files;
                // console.log(e.target.files);
                this.ImgUrl = URL.createObjectURL(e.target.files[0]);
            },
            onSkill(e) {
                // console.log(this.form.skill);
                const skill = e.target.value
                this.form.skill = skill
                this.form.skill_id = skill.id

            },
            onLocation(e) {
                // console.log(this.form.location);
                const location = e.target.value
                this.form.location = location
                this.form.location_id = location.id

            },
            onSpecialitiy(e) {
                // console.log(this.form.specialitiy);
                const specialitiy = e.target.value
                this.form.specialitiy = specialitiy
                this.form.specialitiy_id = specialitiy.id

            },
            onType(e) {
                // console.log(this.form.type);
                const type = e.target.value
                this.form.type = type
                this.form.type_id = type.id

            },
            onRole(e) {
                // console.log(this.form.role);
                const role = e.target.value
                this.form.role = role
                this.form.role_id = role.id

            },
            setData(res) {
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
