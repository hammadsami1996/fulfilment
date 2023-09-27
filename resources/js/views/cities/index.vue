<template>
    <div>
        <div class="px-4 py-5  sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ capital }}</h3>
            <!-- <div class="mt-3 pb-4 sm:mt-0 sm:ml-4 flex justify-end">
                <router-link :to="{name:`create-${small}`}"
                             type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white">
                    Create
                </router-link>
            </div> -->
             
                </div>

         <div class="flex flex-row mb-4">
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            
                <label
                        class="block  font-medium text-sm text-gray-700 mb-2"
                    >Country:</label>
                    <typeahead :initialize="form.country" :url="countries" @input="onCountries"
                               display="name"/>


            </div>

           
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >leopard</label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="number"
                        v-model="form.tax_number"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.tax_number">{{ error.tax_number[0] }}</p>
                </div>

                
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >Trax</label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="number"
                        v-model="form.tax_number"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.tax_number">{{ error.tax_number[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >rider</label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="number"
                        v-model="form.tax_number"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.tax_number">{{ error.tax_number[0] }}</p>
                </div>

                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >Shipping Charges</label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="number"
                        v-model="form.tax_number"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.tax_number">{{ error.tax_number[0] }}</p>
                </div>
                
           
           

            
        </div>

        <div class="flex flex-row mb-4" v-if="form.country_id">
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >City</label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="text"
                        v-model="form.city"
                        @keyup.enter="handleEnterKey"
                    />
                  
                </div>
        </div>
        <div class="mt-3 pb-4 sm:mt-0 sm:ml-4 flex justify-end">
            <button
                    @click="formSubmitted"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white hover:bg-blue-600  transition duration-200 ease-in-out"
                    type="button">
                    Save
                </button>
            </div>

                
           
        <div class="flex-col">
            <panel :columns="columns" :urlApi="urlApi" ref="TableData">
                <template v-slot:action="props">
                    <div class="text-sm font-medium flex">
                         <span v-if="permissions.includes(`edit-${small}`)">
                        <a
                            @click.prevent="edit(props.item.id)"
                            href="#"
                        >
                            <svg class="h-5 w-5 " fill="none" stroke="currentColor"
                                 stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" stroke="none"/>
                                <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"/>
                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"/>
                                <line x1="16" x2="19" y1="5" y2="8"/>
                            </svg>
                        </a>
                         </span>
                        <span v-if="permissions.includes(`delete-${small}`)">
                        <a
                            @click.prevent="deleteRole(props.item.id)"
                            href="#"
                        >
                            <svg class="h-5 w-5 " fill="none" stroke="currentColor" stroke-linecap="round"
                                 stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                <polyline points="3 6 5 6 21 6"/>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                            </svg>
                        </a>
                        </span>
                    </div>
                </template>
            </panel>
        </div>
    </div>
</template>

<script>
    import Panel from "@/components/panel/panel.vue";
    import {form} from "@/libs/mixins";
    import {byMethod} from "@/libs/api";
    import Typeahead from "@/Components/typeahead/typeahead.vue";

    export default {
        mixins: [form],
        components: {
            Panel,Typeahead
        },
        name: "Index",
        data() {
            return {
                permissions: [],
                countries: '/api/country',
                urlApi: "/api/cities",
                urlApis:"/api/cities",
                resource: "/cities",
                small: "cities",
                capital: "Cities",
                columns: [
                    {label: 'S.No', field: 'id', format: 'index'},
                    {label: 'Cities', field: 'name',},
                    {label: 'leopard' , field: ''},
                    {label: 'trax', field: ''},
                    {label: 'rider', field: ''},
                    {label: 'Shiping Charges', field: ''},


                    {label: 'Action', field: 'action', action: true}
                    ]
            }
        },
        created() {
            this.permissions = window.apex.user.permission
        },
        methods: {
            handleEnterKey() {
                setTimeout(() => {
                    this.urlApi = this.urlApis
                }, 100)
                setTimeout(() => {
                    this.urlApi += '?country_id=' + this.form.country_id + '&city=' + this.form.city;
                }, 100)
                setTimeout(() => {

                    this.$refs.TableData.reload();
                }, 100)
        },
            onCountries(e) {
                const country = e.target.value
                this.form.country = country
                this.form.country_id = country.id
                this.filter(this.form.country_id)
            },
            filter(e){

                setTimeout(() => {
                    this.urlApi = this.urlApis
                }, 100)
                setTimeout(() => {
                    this.urlApi += '?country_id=' + e
                }, 100)
                setTimeout(() => {

                    this.$refs.TableData.reload();
                }, 100)
            },
            edit(id) {
                this.$router.push(`${this.resource}/${id}/edit`)
            },
            deleteRole(e) {
                byMethod('delete', `/api/cities/${e}`)
                    .then((res) => {
                        // console.log(res);
                        if (res.data.deleted) {
                            this.$refs.TableData.reload();
                            this.$toast.error( this.capital + " Deleted successfully!");
                        }
                    })
            },
        },
    }
</script>
