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
                    >Title <span class="text-red-600">*</span></label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="text"
                        v-model="form.title"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.title">{{ error.title[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 pl-2 pt-6">
                    <label class="flex items-center space-x-2">
                        <!-- <input type="checkbox"  class="form-checkbox h-6 w-6 text-indigo-600" checked  v-model="if (form.status && form.status == 1) {

                        } "> -->
                        <input :checked="form.status === 1" @change="form.status = (form.status === 1) ? '' : 1"
                               class="form-checkbox h-6 w-6 text-indigo-600" type="checkbox">
                        <!-- <input type="checkbox" class="form-checkbox h-6 w-6 text-indigo-600" checked v-model="form.status"> -->
                        <span class="text-gray-700">Status</span>
                    </label>
                    <!--                    <label-->
                    <!--                        class="block font-medium text-sm text-gray-700 mb-2"-->
                    <!--                    >Status </label>-->
                    <!--                    <input-->
                    <!--                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"-->
                    <!--                        v-model="form.status"-->
                    <!--                    /><p class="text-red-600 text-xs italic" v-if="error.status">{{ error.status[0] }}</p>-->
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


    function initialize(to) {
        let urls = {
            add: `/api/brand/create`,
            edit: `/api/brand/${to.params.id}/edit`,
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
                resource: '/brand',
                store: '/api/brand',
                method: 'POST',
                small: 'brand',
                capital: 'Brand',
                title: 'Add',
                message: 'New brand Added',
                permissions: {},
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
