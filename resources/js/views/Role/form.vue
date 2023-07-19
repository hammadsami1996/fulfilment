<template>
    <div v-if="show">
        <div class="p-6">
            <h1 class="text-lg font-bold mb-4">
                {{
                $route.meta.mode && $route.meta.mode === "edit"
                ? `Edit ${capital}`
                : `Add New ${capital}`
                }}
            </h1>

            <div class="flex-auto flex flex-col sm:flex-row sm:items-center ">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                        for="mc-role-name"
                    >Name <span class="text-red-600">(Required)</span></label
                    >
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        id="mc-role-name"
                        placeholder=" Name"
                        v-model="form.name"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.name">{{ error.name[0] }}</p>
                </div>
            </div>
            <div class="overflow-x-auto mt-6">
                <h3 class="text-xl font-bold mb-2">Permissions</h3>
                <table class="min-w-full table-auto">
                    <template :key="permission.id" v-for="permission in permissions">
                        <thead>
                        <tr>
                            <th class="px-2 py-2 items-center flex">{{permission.menu}}</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 mt-6">
                        <tr :key="menu.id" v-for="menu in permission.menus">
                            <td class="px-4 py-2 flex items-center">
                                <span class="font-semibold">{{menu.group}}</span></td>
                            <td :key="item.name" class="px-4 py-2 " v-for="item in menu.groups"><input
                                :value="item.name"
                                class="form-checkbox h-4 w-4 text-indigo-600" type="checkbox"
                                v-model="selectedPermissions"
                            ><span
                                class="ml-2 text-gray-700">{{item.name}}</span></td>
                        </tr>
                        </tbody>
                    </template>
                </table>
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

    function initialize(to) {
        let urls = {
            add: `/api/role/create`,
            edit: `/api/role/${to.params.id}/edit`,
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
                resource: '/role',
                store: '/api/role',
                method: 'POST',
                small: 'role',
                capital: 'Role',
                title: 'Add',
                selectedPermissions: [],
                message: 'New Role Added',
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
                // console.log(this.$route,this.$router.push({path: `${this.resource}`}));

                this.form = res.data.form;
                this.permissions = res.data.permissions;
                if (this.$route.meta.mode === 'edit') {
                    this.selectedPermissions = res.data.form.permissions
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
