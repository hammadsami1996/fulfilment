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

            <!-- <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >City</label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="text"
                        v-model="form.city"
                        @keyup.enter="handleEnterKey"
                    />
                  
                </div> -->
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            
            <label
                    class="block  font-medium text-sm text-gray-700 mb-2"
                >Cities:</label>
                <typeahead :initialize="form.city" :url="city" @input="onCity"
                           display="name"/>


        </div>


            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            
            <label
                    class="block  font-medium text-sm text-gray-700 mb-2"
                >Courier:</label>
                <typeahead :initialize="form.courier" :url="courier" @input="onCourier"
                           display="name"/>


        </div>

           
           

                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label class="block font-medium text-sm text-gray-700 mb-2"
                    >Shipping Charges</label>
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="number"
                        v-model="form.shipping_charges"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.tax_number">{{ error.tax_number[0] }}</p>
                </div>
                
           
           

            
        </div>

       
        <div class="mt-3 pb-4 sm:mt-0 sm:ml-4 flex justify-end">
            <button
                    @click="formSubmitted"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white hover:bg-blue-600  transition duration-200 ease-in-out"
                    type="button">
                    Bulk Update
                </button>
            </div>

                
           
        <div class="flex-col">
            <panel :columns="columns" :urlApi="urlApi" ref="TableData">
                <template v-slot:couriersss="props">
                    <div v-if="props.item.couriers[0]  ">
                    <img v-if="props.item.couriers[0].id === 4 " src="/images/karachi.png" style="height: 50px; width: 50px; border-radius:50%">

                    <img v-if="props.item.couriers[0].id === 3 " src="/images/rider.png" style="height: 50px; width: 50px; border-radius:50%">

                    <img v-if="props.item.couriers[0].id === 2 || props.item.couriers[0].id === 5" src="/images/trax.png" style="height: 50px; width: 50px; border-radius:50%">

                    <img v-if="props.item.couriers[0].id === 6 || props.item.couriers[0].id === 1" src="/images/leopard.jpeg" style="height: 50px; width: 50px; border-radius:50%">
                </div>
                   
                </template>


                <template v-slot:courierss="props">
                    <!-- <img src="/images/leopard.jpeg" style="height: 50px; width: 50px; border-radius:50%"> -->
                 
                    <typeahead :initialize="props.item.couriers[0]" :url="courier" @input="onCourierss($event , props.item)"
                           display="name"/>
                </template>

                <template v-slot:charges="props">
                 
                    <input v-if="props.item.couriers[0] && props.item.couriers[0].pivot"
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="text"
                       
                        v-model=" props.item.couriers[0].pivot.delivery_charges"
                      
                    />
                    <input v-else
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="number"
                        v-model="delivery_charges"
                       
                    />
             </template>
                <template v-slot:action="props">
                    <div class="text-sm font-medium flex">
                         <span >
                        <a
                            @click.prevent="edit(props.item.id , props.item.couriers[0].id , props.item.couriers[0].pivot ? props.item.couriers[0].pivot.delivery_charges:delivery_charges)"
                            href="#"
                        >
                           <i class="fa-solid fa-check-double text-2xl text-blue-400"></i>

                        
                        <!-- <i data-tooltip-target="tooltip-default" class="fa-solid fa-check-double text-xl text-blue-400"></i>
                        <div id="tooltip-default" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Tooltip content
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div> -->
                            <!-- <svg style="color: rgb(29, 129, 223);" class="h-5 w-5 " fill="none" stroke="currentColor"
                                 stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" stroke="none"/>
                                <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"/>
                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"/>
                                <line x1="16" x2="19" y1="5" y2="8"/>
                            </svg> -->
                        </a>
                         </span>
                        <!-- <span >
                        <a
                            @click.prevent="deleteRole(props.item.id)"
                            href="#"
                        >
                            <svg style="color: red;" class="h-5 w-5 " fill="none" stroke="currentColor" stroke-linecap="round"
                                 stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                <polyline points="3 6 5 6 21 6"/>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                            </svg>
                        </a>
                        </span> -->
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
                form:{
                    delivery_charges:''
                },
                countries: '/api/country',
                courier: '/api/courier',
                city: '/api/cities',


                urlApi: "/api/cities",
                urlApis:"/api/cities",
                resource: "/cities",
                small: "cities",
                capital: "Cities",
                columns: [
                    {label: 'S.No', field: 'id', format: 'index'},
                    {label: 'Cities', field: 'name',},
                    {label: '', field: 'couriersss' , slot:true },
                    {label: 'Courier', field: 'courierss' , slot:true },


                    {label: 'leopard' , field: ''},
                    {label: 'trax', field: ''},
                    {label: 'rider', field: ''},
                    {label: 'Shiping Charges', field: 'charges' , slot:true},


                    {label: 'Action', field: 'action', action: true}
                    ]
            }
        },
        created() {
            // console.log();
            this.permissions = window.apex.user.permission
        },
       
        methods: {
            // pivots(e){
            //     this.props.item.delivery_charges = e;
            // },

            formSubmitted(){
                byMethod('post', '/api/store_cities' , this.form).then((res) => {

                })
            },
            handleEnterKey(e) {
                setTimeout(() => {
                    this.urlApi = this.urlApis
                }, 100)
                setTimeout(() => {
                    this.urlApi +='?city=' + e;
                }, 100)
                setTimeout(() => {

                    this.$refs.TableData.reload();
                }, 200)
        },
            onCountries(e) {
                const country = e.target.value
                this.form.country = country
                this.form.country_id = country.id
                this.filter(this.form.country_id)
            },


            onCity(e) {
                const city = e.target.value
                this.form.city = city
                this.form.city_id = city.id
                this.form.city_name = city.name

                this.handleEnterKey(this.form.city_name);
                // this.filter(this.form.city_id)
            },


            onCourier(e) {
                const courier = e.target.value
                this.form.courier = courier
                this.form.courier_id = courier.id
         
            },
            onCourierss(e , f) {
                // console.log(e)
                const courier = e.target.value
           
                f.couriers[0] = courier
                f.courier_id = courier.id

         
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
            edit(id , courier_id , charges) {
                byMethod('post', `/api/store_cities?city_id=${id}&courier_id=${courier_id}&shipping_charges=${charges}` ).then((res) => {
                    if(res.data.saved){
                        this.$toast.open({
                                position: "top-right",
                                message:
                                    "Successful",
                                type: "success",
                                duration: 3000,
                            });
                    }
                })
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
