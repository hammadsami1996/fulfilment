<template>
    <div v-if="show" class="p-4">
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label class="block font-medium text-sm text-gray-700 mb-2">Customer Category</label>
                <input class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" type="text" v-model="form.customer_category" />
                <p class="text-red-600 text-xs italic" v-if="error.customer_category">{{ error.customer_category[0] }}</p>
            </div>
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
</template>

<script>
    import {byMethod, get} from '@/libs/api'
    import {form} from '@/libs/mixins'
    // import Typeahead from "@/Components/typeahead/typeahead.vue";


    function initialize(to) {
        let urls = {
            add: `/api/category/create`,
            edit: `/api/category/${to.params.id}/edit`,
        }
        return urls[to.meta.mode] || urls.add
    }

    export default {
        mixins: [form],
        components: {
            // Typeahead,
        },
        data() {
            return {
                error: {},
                show: false,
                resource: '/customer',
                store: '/api/category',
                method: 'POST',
                small: 'category',
                capital: 'Category',
                title: 'Add',
                message: 'New Category Added',
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
                console.log(res);
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
