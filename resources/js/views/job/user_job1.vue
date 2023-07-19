<template>
    <!-- Tables: Bordered -->
        <!-- Responsive Table Container -->
        <div class="border border-gray-200 rounded overflow-x-auto min-w-full bg-white dark:bg-gray-800 dark:border-gray-700">
            <!-- Table -->
            <table class="min-w-full text-sm align-middle whitespace-nowrap">
                <!-- Table Header -->
                <thead>
                <tr class="border-b border-gray-100 dark:border-gray-700/50">

                    <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                        Name
                    </th>
                    <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25">
                        Job Description
                    </th>

                    <th class="px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-center dark:text-gray-50 dark:bg-gray-700/25">
                        Actions
                    </th>
                </tr>
                </thead>
                <!-- END Table Header -->

                <!-- Table Body -->
                <tbody>
                <tr v-for="(item, index) in form.data" class="border-b border-gray-100 dark:border-gray-700/50">

                    <td class="p-3">
                        <div class="font-semibold inline-flex px-2 py-1 leading-4 text-xs rounded-full text-emerald-900 bg-emerald-100 dark:bg-emerald-200"> {{item.name}}</div>
                    </td>
                    <td class="p-3">
                        <div class="font-semibold inline-flex px-2 py-1 leading-4 text-xs rounded-full text-emerald-900 bg-emerald-100 dark:bg-emerald-200">  {{item.description}}</div>
                    </td>
                    <td class="p-3 text-center">
                        <button  type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-white text-gray-800 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:ring focus:ring-gray-300 focus:ring-opacity-25 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600 dark:focus:ring-opacity-40 dark:active:border-gray-700">
                            Edit
                        </button>
                    </td>
                </tr>
                </tbody>
                <!-- END Table Body -->
            </table>
            <!-- END Table -->
        </div>
        <!-- END Responsive Table Container -->
        <!-- END Tables: Bordered -->

    </template>
<script>
    import {byMethod, get} from '@/libs/api'
    import {form} from '@/libs/mixins'
    function initialize(to) {
        let urls = {
            add: `/api/user_plain/create`,
            edit: `/api/user_Plain/${to.params.id}/edit`,
        }
        return urls[to.meta.mode] || urls.add
    }
    export default {
        mixins: [form],
        data() {
            return {
                show: false,
                resource: '/user_job',
                store: '/api/job',
                method: 'POST',
                small: 'user_job',

            }

        },
        created() {
            get('api/job').then(res=>{
                this.setData(res)
                // console.log(res)
            })
        },
        methods: {
            setData(res) {
                this.form = res.data.data;
                this.show = true
            },
            // savePlain(e){
            //     byMethod('POST','/api/user_job',e).then(res=>{
            //
            //     })
            // }
        },
    }

</script>
