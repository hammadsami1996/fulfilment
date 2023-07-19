<template>
    <div class="p-6">
        <h1 class="text-lg font-bold mb-4">Change Password</h1>
        <div>
            <div class="mb-6 lg:pl-72 ">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="email">Your
                    Password</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block lg:w-72 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="email" type="password"
                       v-model="form.old_password">
            </div>
            <div class="mb-6 lg:pl-72">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="password">New
                    password</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block lg:w-72 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="newpassword" type="password"
                       v-model="form.new_password">
            </div>
            <div class="mb-6 lg:pl-72">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="password">Confirm
                    password</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block lg:w-72 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="confirmpassword" type="password"
                       v-model="form.password_confirmation">
            </div>
            <div class="flex justify-center mt-8">
                <button @click="save" class="border font-semibold focus:outline-none px-4 py-2 leading-6 rounded border-gray-300 bg-emerald-400 text-white  focus:ring"
                        type="submit">
                    Submit
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import {form} from "@/libs/mixins";
    import {byMethod} from "@/libs/api";


    export default {
        mixins: [form],
        name: "change_password",
        data() {
            return {
                form: {}
            };
        },
        methods: {
            save() {
                byMethod("POST", '/api/change_password', this.form).then(res => {
                    // console.log(res);
                })
            }
        }
    }
</script>

<style scoped>

</style>
