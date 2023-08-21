<template>
    <div v-if="show">
        <div class="p-6">
            <h1 class="text-lg font-bold mb-4">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: `Add New ${capital}`}}
            </h1>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
<!--                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">-->
<!--                    <label class="block font-medium text-sm text-gray-700 mb-2">Category Name</label>-->
<!--                    <div class="relative">-->
<!--                        <typeahead-->
<!--                            :initialize="form.category"-->
<!--                            :url="category"-->
<!--                            @input="onCategory"-->
<!--                            class="w-64 text-sm rounded-md border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"-->
<!--                            display="text"-->
<!--                        />-->
<!--                        <p class="text-red-600 text-xs italic absolute bottom-0">{{ error.category_id?.[0] }}</p>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 py-2 mt-3">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Category Name</label>
                    <input
                        v-model="form.name"
                        class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.name">{{ error.name[0] }}</p>
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
            add: `/api/product_category/create`,
            edit: `/api/product_category/${to.params.id}/edit`,
        }
        return urls[to.meta.mode] || urls.add
    }

    export default {
        mixins: [form],
        components: {
            Typeahead
        },
        data() {
            return {
                error: {},
                show: false,
                resource: '/product_category',
                store: '/api/product_category',
                method: 'POST',
                small: 'product_category',
                capital: 'Product Category',
                title: 'Add',
                message: 'New product_category Added',
                permissions: {},
                // companys: '/api/company',
                category: '/api/product_category',
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
            onCategory(e) {
                const category = e.target.value
                this.form.category = category
                this.form.head_id = category.id
            },
            setData(res) {
                // console.log(res);
                this.form = res.data.form;
                if (this.$route.meta.mode == 'edit') {
                    this.store = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
                    this.title = 'Edit';
                    this.message = `${this.capital} has been updated`;
                } else {
                    this.form.category = {};
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