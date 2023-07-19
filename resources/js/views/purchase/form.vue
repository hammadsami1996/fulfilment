<template>
    <div v-if="show">
        <div class="p-6">
            <h1 class="text-lg font-bold mb-4">
                {{ $route.meta.mode && $route.meta.mode === "edit" ? `Edit ${capital}`: `Add New ${capital}`}}
            </h1>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">

                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Supplier</label>
                    <typeahead :initialize="form.supplier" :url="suppliers" @input="onSupplier" display="name"/>
                    <p class="text-red-600 text-xs italic" v-if="error.supplier_id">{{error.supplier_id[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >PO Reference No.:</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        placeholder=" PO Reference No."
                        type="number"
                        v-model="form.po_reference_number"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.po_reference_number">
                        {{error.po_reference_number[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2" v-if="$route.meta.mode && $route.meta.mode == 'edit'">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >PO Number:<small>(Auto Generated)</small></label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        disabled
                        placeholder=" PO No."
                        v-model="form.po_number"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.po_number">{{error.po_number[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >PO Date:</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        type="date"
                        v-model="form.po_date"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.po_date">{{error.po_date[0] }}</p>

                </div>


            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Due Date:</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        type="date"
                        v-model="form.due_date"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.due_date">{{error.due_date[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Discount %:</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        type="number"
                        v-model="form.discount"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.discount">{{error.discount[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 pl-3 sm:mb-0">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Sku</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        v-model="form.sku"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.sku">{{error.sku[0] }}</p>
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
            add: `/api/purchase/create`,
            edit: `/api/purchase/${to.params.id}/edit`,
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
                resource: '/purchase',
                store: '/api/purchase',
                method: 'POST',
                small: 'purchase',
                capital: 'Purchase',
                title: 'Add',
                message: 'New purchase Added',
                permissions: {},
                suppliers: '/api/supplier',
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
            onSupplier(e) {
                const supplier = e.target.value
                this.form.supplier = supplier
                this.form.supplier_id = supplier.id
            },
            setData(res) {
                // console.log(res);
                this.form = res.data.form;
                if (this.$route.meta.mode === 'edit') {
                    this.purchase = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
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
