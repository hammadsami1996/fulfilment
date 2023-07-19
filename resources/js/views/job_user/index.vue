<template>
    <div class="flex-col">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Index
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Description
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" :key="index" @click="expandRow(index)" v-for="(item, index) in form">
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ index + 1 }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ item.name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ item.description }}</td>
            </tr>
             <tr v-if="selectedRow == index">
                <td colspan="3">
                    <table class="border  min-w-full divide-y divide-gray-100 ">
                        <thead class="bg-blue-400">
                        <tr>
                            <th class="border px-6 py-3 bg-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider font-bold">ID</th>
                            <th class="border px-6 py-3 bg-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider font-bold">Name</th>
                            <th class="border px-6 py-3 bg-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider font-bold">Email</th>
                            <th class="border px-6 py-3 bg-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider font-bold">Mobile No.</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr :key="index" v-for="(user, index) in item.users">
                            <td class="border px-6 py-4 whitespace-nowrap">{{ user.id }}</td>
                            <td class="border px-6 py-4 whitespace-nowrap">{{ user.name }}</td>
                            <td class="border px-6 py-4 whitespace-nowrap">{{ user.email }}</td>
                            <td class="border px-6 py-4 whitespace-nowrap">{{ user.mobile_no }}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>


<script>
    import {form} from "@/libs/mixins";
    import {get} from "@/libs/api";

    export default {
        mixins: [form],
        data() {
            return {
                selectedRow: -1
            };
        },
        methods: {
            expandRow(index) {
                if (this.selectedRow === index) {
                    this.selectedRow = -1;
                } else {
                    this.selectedRow = index;
                }
            },
            fetchData() {
                get("/api/job_user").then(res => {
                    this.form = res.data.data;
                });
            }
        },
        created() {
            this.fetchData();
        }
    };
</script>
