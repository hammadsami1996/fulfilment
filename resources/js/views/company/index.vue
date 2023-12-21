<template>
    <div>
        <div class="px-4 py-5  sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ capital }}</h3>
            <div class="mt-3 pb-4 sm:mt-0 sm:ml-2 flex justify-end">
                <router-link :to="{name:`create-${small}`}"
                             class="inline-flex mr-3 justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm hover:bg-blue-600 border-gray-200 bg-blue-400 text-white"
                             type="button">
                    + Create Company
                </router-link>
                <router-link :to="{name:`create-stores`}"
                             class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 hover:bg-blue-600 bg-blue-400 text-white"
                             type="button">
                    + Create Store
                </router-link>
<!--                <button class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 hover:bg-blue-600 bg-blue-400 text-white"-->
<!--                        type="button">-->
<!--                    Manually Fetch Orders-->
<!--                </button>-->
                <button @click="automatically"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 hover:bg-blue-600 bg-blue-400 text-white"
                        type="button">
                    Automatically Fetch Orders
                </button>
            </div>
        </div>
        <div class="overflow-x-auto scrollbar-color">
            <table class="min-w-full whitespace-nowrap align-middle text-sm ">
                <thead>
                <tr>
                    <th class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                        S.No
                    </th>
                    <th class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                        Image
                    </th>
                    <th class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                        Name
                    </th>
                    <th class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                        Email
                    </th>
                    <th class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                        Phone
                    </th>
                    <th class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                        Address
                    </th>
                    <th class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                <template :key="company.id" v-for="(company, companyIndex) in this.companies">
                    <tr class="even:bg-gray-50 dark:even:bg-gray-900/50">
                        <td class="p-3 text-center">{{ companyIndex + 1 }}</td>
                        <td class="p-3 text-center">
                            <div class="w-full pl-6">
                                <img :src="getImagePath(company.logo)" class="shadow-xl h-10  rounded-md"/>
                            </div>
                        </td>
                        <td class="p-3 text-center">{{ company.name }}</td>
                        <td class="p-3 text-center">{{ company.email }}</td>
                        <td class="p-3 text-center">{{ company.phone }}</td>
                        <td class="p-3 text-center">{{ company.address }}</td>

                        <td class=" text-center ">
                            <div class="text-sm font-medium flex pl-20">
                      <span class="bg-blue-400 p-1 text-white border rounded border-blue-500 mr-2 hover:bg-blue-600 transition-colors duration-300"
                            v-if="permissions.includes(`edit-${small}`)">
                        <a @click.prevent="edit(company.id)" href="#">
                          <svg class="icon-edit h-5 w-5 " fill="none" stroke="currentColor" stroke-linecap="round"
                               stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                            <!-- Your SVG path for edit icon -->
                            <path d="M0 0h24v24H0z" stroke="none"/>
                                <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"/>
                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"/>
                                <line x1="16" x2="19" y1="5" y2="8"/>
                          </svg>
                        </a>
                      </span>
                                <span class="bg-red-500 p-1 border rounded border-red-500 text-white hover:bg-red-600 transition-colors duration-300"
                                      v-if="permissions.includes(`delete-${small}`)">
                        <a @click.prevent="deleteRole(company.id)" href="#">
                          <svg class="icon-delete h-5 w-5" fill="none" stroke="currentColor" stroke-linecap="round"
                               stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                            <!-- Your SVG path for delete icon -->
                            <polyline points="3 6 5 6 21 6"/>
                                      <path
                                          d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>

                          </svg>
                        </a>
                      </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <table class="min-w-full ml-12 whitespace-nowrap align-middle text-sm border ">
                                <thead>
                                <tr>
                                    <th class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                                        S.No
                                    </th>
                                    <th class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                                        Image
                                    </th>
                                    <th class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                                        Name
                                    </th>
                                    <th class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                                        Location
                                    </th>
                                    <th class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                                        Store Type
                                    </th>
                                    <th class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                                        Platform
                                    </th>
                                    <th class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                                        Auto Fetch
                                    </th>
                                    <th class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr :key="storeIndex" class="even:bg-gray-300 dark:even:bg-gray-900/50"
                                    v-for="(store, storeIndex) in company.stores">
                                    <td class="p-3 text-center">{{ storeIndex + 1 }}</td>
                                    <td class="p-3 text-center">
                                        <div class="w-full pl-6">
                                            <img :src="getImagePathstore(store.img)"
                                                 class="shadow-xl h-10  rounded-md"/>
                                        </div>
                                    </td>
                                    <td class="p-3 text-center">{{ store.name }}</td>
                                    <td class="p-3 text-center">{{ store.location }}</td>
                                    <td class="p-3 text-center">{{ store.store_type }}</td>
                                    <td class="p-3 text-center">{{ store.plate_form }}</td>
                                    <td class="p-3 text-center" >
                                        <input
                                            v-if="store.store_type == 'Online'"
                                            disabled
                                            true-value="1"
                                            false-value="0"
                                            type="checkbox"
                                            id="switch2"
                                            :checked="store.fetch_order"
                                            name="switch2"
                                            class="h-7 w-12 rounded-full text-primary-500 transition-all duration-150 ease-out form-switch focus:ring focus:ring-primary-500 focus:ring-opacity-50 dark:bg-gray-900 dark:ring-offset-gray-900 dark:checked:bg-current"
                                        />
                                    </td>
                                    <td class=" text-center ">
                                        <div class="text-sm font-medium flex pl-12">
                  <span class="bg-blue-400 p-1 text-white border rounded border-blue-500 mr-2 hover:bg-blue-600 transition-colors duration-300"
                        v-if="permissions.includes(`edit-${small}`)">
                    <a @click.prevent="storeedit(store.id)" href="#">
                      <svg class="icon-edit h-5 w-5 " fill="none" stroke="currentColor" stroke-linecap="round"
                           stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                        <!-- Your SVG path for edit icon -->
                        <path d="M0 0h24v24H0z" stroke="none"/>
                            <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"/>
                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"/>
                            <line x1="16" x2="19" y1="5" y2="8"/>
                      </svg>
                    </a>
                  </span>
                                            <span class="bg-red-500 p-1 border rounded border-red-500 text-white hover:bg-red-600 transition-colors duration-300"
                                                  v-if="permissions.includes(`delete-${small}`)">
                    <a @click.prevent="storedeleteRole(store.id)" href="#">
                      <svg class="icon-delete h-5 w-5" fill="none" stroke="currentColor" stroke-linecap="round"
                           stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                        <!-- Your SVG path for delete icon -->
                        <polyline points="3 6 5 6 21 6"/>
                                  <path
                                      d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>

                      </svg>
                    </a>
                  </span>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import Panel from "@/components/panel/panel.vue";
    import {form} from "@/libs/mixins";
    import {byMethod} from "@/libs/api";
    import axios from 'axios';

    export default {
        mixins: [form],
        components: {
            Panel,
        },
        name: "Index",
        data() {
            return {
                permissions: [],
                resourcestore: "/stores",

                storesmall: "stores",
                storecapital: "Store",
                urlApi: "/api/company",
                resource: "/company",
                small: "company",
                capital: "Company",
                companies: {},
            }
        },
        created() {
            this.permissions = window.apex.user.permission
            this.fetchCompanies();
        },
        methods: {
            automatically(e){
                byMethod('POST', '/api/auto_order', e).then(res => {
                    if (res.data.saved === true) {
                        this.$toast.success(`${res.data.new} Fetch Order Successfully`);
                    }
                    this.$router.push({path: "/order"})
                })
            },
            async fetchCompanies() {
                try {
                    const response = await axios.get("/api/company");
                    // console.log(response.data.data.data)
                    this.companies = response.data.data.data; // Assuming the response data is an array of companies
                    console.log(this.companies);
                } catch (error) {
                    console.error("Error fetching companies:", error);
                }
            },
            reloadData() {
                this.fetchCompanies(); // Call the method that fetches data
            },
            getImagePath(item) {
                if (item) {
                    return `/uploads/company/logo/${item}`;
                } else {
                    // If no logo is uploaded, use a default image
                    return "images/noimage.jpg";
                }
            },
            getImagePathstore(item) {
                if (item) {
                    return `/uploads/store/img/${item}`;
                } else {
                    // If no logo is uploaded, use a default image
                    return "images/noimage.jpg";
                }
            },

            edit(id) {
                this.$router.push(`${this.resource}/${id}/edit`)
            },
            storeedit(id) {
                this.$router.push(`${this.resourcestore}/${id}/edit`)
            },
            deleteRole(e) {
                byMethod('delete', `/api/company/${e}`)
                    .then((res) => {
                        if (res.data.deleted) {
                            // this.$refs.TableData.reload();
                            this.reloadData();
                            this.$toast.error(this.capital + " Deleted successfully!");
                        }
                    })
            },
            storedeleteRole(e) {
                byMethod('delete', `/api/stores/${e}`)
                    .then((res) => {
                        if (res.data.deleted) {
                            this.reloadData();
                            // this.$refs.TableData.reload();
                            this.$toast.error(this.storecapital + " Deleted successfully!");
                        }
                    })
            },
        },
    }
</script>
