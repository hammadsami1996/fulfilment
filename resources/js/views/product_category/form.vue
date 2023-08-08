<template>
    <div v-if="show">
        <div class="p-6">
            <h1 class="text-lg font-bold mb-4">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: `Add New ${capital}`}}
            </h1>
            <div class="flex items-center mb-2">
                <input
                    type="text"
                    v-model="inputs[0]"
                    class="w-full py-2 px-3 border rounded"
                    placeholder="Input 1"
                />
                <button @click="addInput" class="ml-2 py-2 px-3 bg-blue-500 text-white rounded">
                    +
                </button>
            </div>
            <div v-for="(input, index) in inputs.slice(1)" :key="index" class="flex items-center mb-2">
                <input
                    type="text"
                    v-model="inputs[index]"
                    class="w-full py-2 px-3 border rounded"
                    :placeholder="`Input ${index + 1}`"
                />
                <button @click="removeInput(index)" class="ml-2 py-2 px-3 bg-red-500 text-white rounded">
                    -
                </button>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Name <span class="text-red-600">(Required)</span></label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        placeholder=" Name"
                        v-model="form.name"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.name">{{ error.name[0] }}</p>
                </div>
<!--                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">-->
<!--                    <label-->
<!--                        class="block font-medium text-sm text-gray-700 mb-2"-->
<!--                    >Location</label>-->
<!--                    <input-->
<!--                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"-->
<!--                        placeholder=" vaccation"-->
<!--                        v-model="form.location"-->
<!--                    />-->
<!--                    <p class="text-red-600 text-xs italic" v-if="error.location">{{ error.location[0] }}</p>-->
<!--                </div>-->
            </div>
            <div class="flex justify-end mt-8 space-x-4">
                <button
                    @click="formSubmitted"
                    type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white">
                    {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Add" }}
                </button>
                <button
                    @click="successfull()"
                    type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white">
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
            Typeahead,
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
                inputs: [""],
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
            addInput() {
                this.inputs.push("");
            },
            removeInput(index) {
                this.inputs.splice(index, 1);
            },
            // onCompany(e) {
            //     const company = e.target.value
            //     this.form.company = company
            //     this.form.company_id = company.id
            // },
            setData(res) {
                // console.log(res);
                this.form = res.data.form;
                if (this.$route.meta.mode == 'edit') {
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
