<template>
    <div class="p-3">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center border-b-2 border-gray-200 w-full">
    <h3 class="text-2xl leading-3 font-medium text-gray-900">{{ capital }}</h3>
</div>
<div class=" pl-4 pt-3">
    <label class="block font-medium text-sm text-gray-700 mb-2">
        Message
    </label>
    <div class="w-full">
    
        <textarea name=""  class="w-full bg-white border border-gray-300 text-gray-700 py-4 px-4 rounded leading-tight focus:outline-none focus:border-gray-500"></textarea>
    </div>
    
</div>
<div class="  pl-4 pt-3">
    <label class="block font-medium text-sm text-gray-700 mb-2">
        Response
    </label>
    <div class="w-full">
    
        <textarea name=""  class="w-full bg-white border border-gray-300 text-gray-700 py-4 px-4 rounded leading-tight focus:outline-none focus:border-gray-500"></textarea>
    </div>
    
</div>
        <div class="flex flex-row mb-2 mt-2 pl-3">
           
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
    <label class="block font-medium text-sm text-gray-700 mb-2">
        Stock Qty:
    </label>
    <div class="relative">
        <select class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:border-gray-500">
            <option value="">None</option>
            <option value="">Plus</option>
            <option value="">Minus</option>
        </select>
   
    </div>
</div>

<div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
    <label class="block font-medium text-sm text-gray-700 mb-2">
        Sort:
    </label>
    <div class="relative">
        <input type="number" class="block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded leading-tight focus:outline-none focus:border-gray-500">
    </div>
</div>
<div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2 ">
    <label class="block font-medium text-sm text-gray-700 mb-2">
        Order Status Title:
    </label>
    <div class="relative flex">
        <input type="text" class="block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded leading-tight focus:outline-none focus:border-gray-500">
        <button class=" px-3 py-2 bg-blue-400 hover:bg-blue-500 text-white rounded">Save</button>
    </div>
</div>
        </div>
        <div class="flex-col">
            <panel :columns="columns" :urlApi="urlApi" ref="TableData" :searchEnable="false">
                <template v-slot:sortes="props">
                    <div>
                        <input type="number" class="block w-3/6 bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded leading-tight focus:outline-none focus:border-gray-500">
                    </div>
                </template>
                <template v-slot:emailes="props">
                    <div>
                        <input
                type="checkbox"
                id="switch2"
                :checked="props.item.manage_inventory === 1" 
                @change="updateManageInventory(props.item,props.item.id)"
                name="switch2"
                class="h-7 w-12 rounded-full text-primary-500 transition-all duration-150 ease-out form-switch focus:ring focus:ring-primary-500 focus:ring-opacity-50 dark:bg-gray-700 dark:ring-offset-gray-900 dark:checked:bg-current"/>
                    </div>
                </template>
                <template v-slot:smses="props">
                    <div>
                        <input
                type="checkbox"
                id="switch2"
                :checked="props.item.manage_inventory === 1" 
                @change="updateManageInventory(props.item,props.item.id)"
                name="switch2"
                class="h-7 w-12 rounded-full text-primary-500 transition-all duration-150 ease-out form-switch focus:ring focus:ring-primary-500 focus:ring-opacity-50 dark:bg-gray-700 dark:ring-offset-gray-900 dark:checked:bg-current"/>
                    </div>
                </template>
                
                <template v-slot:actives="props">
                    <div>
                        <input
                type="checkbox"
                id="switch2"
                :checked="props.item.manage_inventory === 1" 
                @change="updateManageInventory(props.item,props.item.id)"
                name="switch2"
                class="h-7 w-12 rounded-full text-primary-500 transition-all duration-150 ease-out form-switch focus:ring focus:ring-primary-500 focus:ring-opacity-50 dark:bg-gray-700 dark:ring-offset-gray-900 dark:checked:bg-current"/>
                    </div>
                </template>
                <template v-slot:sale_ons="props">
                    <div>
                        <input
                type="checkbox"
                id="switch2"
                :checked="props.item.manage_inventory === 1" 
                @change="updateManageInventory(props.item,props.item.id)"
                name="switch2"
                class="h-7 w-12 rounded-full text-primary-500 transition-all duration-150 ease-out form-switch focus:ring focus:ring-primary-500 focus:ring-opacity-50 dark:bg-gray-700 dark:ring-offset-gray-900 dark:checked:bg-current"/>
                    </div>
                </template>
                
                <template v-slot:action="props">

                    <div class="text-sm font-medium flex">
            <span>
              <a @click.prevent="edit(props.item.id, props.item.couriers[0].id, props.item.couriers[0].pivot ? props.item.couriers[0].pivot.delivery_charges : delivery_charges)"
                 href="#">
                <!-- <i class="fa-solid fa-check-double text-2xl text-blue-400"></i> -->
                <svg class="h-6 w-6 text-blue-400" fill="none" stroke="currentColor"
                                 stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" stroke="none"/>
                                <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"/>
                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"/>
                                <line x1="16" x2="19" y1="5" y2="8"/>
                            </svg>
              </a>
            </span> |
            <span>
              <a @click.prevent="edit(props.item.id, props.item.couriers[0].id, props.item.couriers[0].pivot ? props.item.couriers[0].pivot.delivery_charges : delivery_charges)"
                 href="#"
                 >
                <!-- <i class="fa-solid fa-check-double text-2xl text-blue-400"></i> -->
                <svg class="h-6 w-6  text-red-400" fill="none" stroke="currentColor" stroke-linecap="round"
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
            Panel,
            Typeahead,
        },
        name: "Index",
        data() {
            return {
                isSubmitting: false,
                permissions: [],
                // form: {
                //     delivery_charges: "",
                //     shipping_charges: "0.00",
                // },
                urlApi: "/api/order_status",
                small: "Order Status",
                capital: "Order Status",
                columns: [
                    {label: "S.No", field: "id", format: "index"},
                    {label: "Title", field: "name", },
                    {label: "Response", field: "response"},
                    {label: "Message", field: "message"},
                    {label: "Stock Qty", field: "stock_qty", slot:true},
                    {label: "Sort", field: "sortes",slot:true},
                    {label: "Email", field: "emailes", slot:true},
                    {label: "Sales On", field: "sale_ons",slot:true},
                    {label: "SMS", field: "smses", slot:true},
                    {label: "Active", field: "actives",slot:true},
                    {label: "Action", field: "action", action: true},
                ],
            };
        },
        created() {
            this.permissions = window.apex.user.permission;
        },
        methods: {
            formSubmitted() {
                this.isSubmitting = true; // Disable the button and show the spinner
                byMethod("post", "/api/store_cities", this.form).then((res) => {
                    if (res.data.error) {
                        // this.$swal('Quantity cannot be greater than available product quantity for any item!');
                        this.$toast.open({
                            position: 'top-right',
                            message: 'Quantity cannot be greater than available product quantity for any item!',
                            type: 'error',
                            duration: 3000
                        });
                    } else {
                        // successfull(res)
                        this.$toast.open({
                            position: 'top-right',
                            message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                            type: 'success',
                            duration: 3000
                        });
                    }
                })
                    .finally(() => {
                        this.isSubmitting = false; // Enable the button and hide the spinner
                    });
            },
      
            onCourierss(e, f) {
                const courier = e.target.value;
                f.couriers[0] = courier;
                f.courier_id = courier.id;
            },
       
            edit(id, courier_id, charges) {
                byMethod("post", `/api/store_cities?city_id=${id}&courier_id=${courier_id}&shipping_charges=${charges}`).then((res) => {
                    if (res.data.saved) {
                        this.$toast.open({
                            position: "top-right",
                            message: "Successful",
                            type: "success",
                            duration: 3000,
                        });
                    }
                });
            },
            deleteRole(e) {
                byMethod("delete", `/api/cities/${e}`).then((res) => {
                    if (res.data.deleted) {
                        this.$refs.TableData.reload();
                        this.$toast.error(this.capital + " Deleted successfully!");
                    }
                });
            },
            clear(e) {
                this.form[e] = {};
                this.form[e + "_id"] = null;
            },
        },
    };
</script>
<style scoped>
    .tooltip {
        visibility: hidden;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 4px;
        padding: 6px;
        position: absolute;
        z-index: 1;
        bottom: 125%; /* Position the tooltip above the button */
        left: 50%;
        transform: translateX(-50%); /* Center the tooltip horizontally */
        opacity: 0;
        transition: opacity 0.2s;
    }

    .button:hover .tooltip {
        visibility: visible;
        opacity: 1;
    }

</style>


<!--<template>-->
<!--    <div>-->
<!--        <div class="px-4 py-5  sm:px-6 flex justify-between items-center">-->
<!--            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ capital }}</h3>-->
<!--            &lt;!&ndash; <div class="mt-3 pb-4 sm:mt-0 sm:ml-4 flex justify-end">-->
<!--                <router-link :to="{name:`create-${small}`}"-->
<!--                             type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white">-->
<!--                    Create-->
<!--                </router-link>-->
<!--            </div> &ndash;&gt;-->
<!--        </div>-->
<!--        <div class="flex flex-row mb-4">-->
<!--            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">-->
<!--                <label class="block  font-medium text-sm text-gray-700 mb-2"-->
<!--                >Country:-->
<!--                    <button @click="clear('country')" class="text-red-400 text-sm hover:text-red-600">Clear</button>-->
<!--                </label>-->
<!--                <typeahead :initialize="form.country" :url="countries" @input="onCountries"-->
<!--                           display="name"/>-->
<!--            </div>-->
<!--            &lt;!&ndash; <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">-->
<!--                    <label class="block font-medium text-sm text-gray-700 mb-2"-->
<!--                    >City</label>-->
<!--                    <input-->
<!--                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"-->
<!--                        type="text"-->
<!--                        v-model="form.city"-->
<!--                        @keyup.enter="handleEnterKey"-->
<!--                    />-->
<!--                </div> &ndash;&gt;-->
<!--            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">-->
<!--                <label class="block  font-medium text-sm text-gray-700 mb-2"-->
<!--                >Cities:-->
<!--                    <button @click="clear('city')" class="text-red-400 text-sm hover:text-red-600">Clear</button>-->
<!--                </label>-->
<!--                <typeahead :initialize="form.city"-->
<!--                           :url="form.country_id != null ? `/api/city?country_id=${form.country_id}` : city"-->
<!--                           @input="onCity" display="name"/>-->
<!--            </div>-->
<!--            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">-->
<!--                <label class="block  font-medium text-sm text-gray-700 mb-2">-->
<!--                    Courier:-->
<!--                    <button @click="clear('courier')" class="text-red-400 text-sm hover:text-red-600">Clear</button>-->
<!--                </label>-->
<!--                <typeahead :initialize="form.courier" :url="courier" @input="onCourier"-->
<!--                           display="name"/>-->
<!--            </div>-->
<!--            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">-->
<!--                <label class="block font-medium text-sm text-gray-700 mb-2"-->
<!--                >Shipping Charges</label>-->
<!--                <input-->
<!--                    class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"-->
<!--                    type="number"-->
<!--                    v-model="form.shipping_charges"-->
<!--                />-->
<!--                <p class="text-red-600 text-xs italic" v-if="error.tax_number">{{ error.tax_number[0] }}</p>-->
<!--            </div>-->
<!--        </div>-->

<!--        <div class="mt-3 pb-4 sm:mt-0 sm:ml-4 flex justify-end">-->
<!--            <button-->
<!--                @click="formSubmitted"-->
<!--                class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white hover:bg-blue-600  transition duration-200 ease-in-out"-->
<!--                type="button">-->
<!--                Bulk Update-->
<!--            </button>-->
<!--        </div>-->


<!--        <div class="flex-col">-->
<!--            <panel :columns="columns" :urlApi="urlApi" ref="TableData">-->
<!--                <template v-slot:couriersss="props">-->
<!--                    <div v-if="props.item.couriers[0]  ">-->
<!--                        <img src="~@/images/karachi.png" style="height: 50px; width: 50px; border-radius:50%"-->
<!--                             v-if="props.item.couriers[0].id === 4 ">-->

<!--                        <img src="~@/images/rider.png" style="height: 50px; width: 50px; border-radius:50%"-->
<!--                             v-if="props.item.couriers[0].id === 3 ">-->

<!--                        <img src="~@/images/trax.png"-->
<!--                             style="height: 50px; width: 50px; border-radius:50%" v-if="props.item.couriers[0].id === 2 || props.item.couriers[0].id === 5">-->

<!--                        <img src="~@/images/leopard.jpeg"-->
<!--                             style="height: 50px; width: 50px; border-radius:50%" v-if="props.item.couriers[0].id === 6 || props.item.couriers[0].id === 1">-->
<!--                    </div>-->

<!--                </template>-->


<!--                <template v-slot:courierss="props">-->
<!--                    &lt;!&ndash; <img src="~@/images/leopard.jpeg" style="height: 50px; width: 50px; border-radius:50%"> &ndash;&gt;-->

<!--                    <typeahead :initialize="props.item.couriers[0]" :url="courier"-->
<!--                               @input="onCourierss($event , props.item)"-->
<!--                               display="name"/>-->
<!--                </template>-->

<!--                <template v-slot:charges="props">-->

<!--                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"-->
<!--                           type="text"-->
<!--                           v-if="props.item.couriers[0] && props.item.couriers[0].pivot"-->

<!--                           v-model=" props.item.couriers[0].pivot.delivery_charges"-->

<!--                    />-->
<!--                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"-->
<!--                           type="number"-->
<!--                           v-else-->
<!--                           v-model="delivery_charges"-->

<!--                    />-->
<!--                </template>-->
<!--                <template v-slot:action="props">-->
<!--                    <div class="text-sm font-medium flex">-->
<!--                         <span>-->
<!--                        <a-->
<!--                            @click.prevent="edit(props.item.id , props.item.couriers[0].id , props.item.couriers[0].pivot ? props.item.couriers[0].pivot.delivery_charges:delivery_charges)"-->
<!--                            href="#"-->
<!--                        >-->
<!--                           <i class="fa-solid fa-check-double text-2xl text-blue-400"></i>-->


<!--                            &lt;!&ndash; <i data-tooltip-target="tooltip-default" class="fa-solid fa-check-double text-xl text-blue-400"></i>-->
<!--                            <div id="tooltip-default" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">-->
<!--                            Tooltip content-->
<!--                            <div class="tooltip-arrow" data-popper-arrow></div>-->
<!--                        </div> &ndash;&gt;-->
<!--                            &lt;!&ndash; <svg style="color: rgb(29, 129, 223);" class="h-5 w-5 " fill="none" stroke="currentColor"-->
<!--                                 stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">-->
<!--                                <path d="M0 0h24v24H0z" stroke="none"/>-->
<!--                                <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"/>-->
<!--                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"/>-->
<!--                                <line x1="16" x2="19" y1="5" y2="8"/>-->
<!--                            </svg> &ndash;&gt;-->
<!--                        </a>-->
<!--                         </span>-->
<!--                        &lt;!&ndash; <span >-->
<!--                        <a-->
<!--                            @click.prevent="deleteRole(props.item.id)"-->
<!--                            href="#"-->
<!--                        >-->
<!--                            <svg style="color: red;" class="h-5 w-5 " fill="none" stroke="currentColor" stroke-linecap="round"-->
<!--                                 stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">-->
<!--                                <polyline points="3 6 5 6 21 6"/>-->
<!--                                <path-->
<!--                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>-->
<!--                            </svg>-->
<!--                        </a>-->
<!--                        </span> &ndash;&gt;-->
<!--                    </div>-->
<!--                </template>-->
<!--            </panel>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--    import Panel from "@/components/panel/panel.vue";-->
<!--    import {form} from "@/libs/mixins";-->
<!--    import {byMethod} from "@/libs/api";-->
<!--    import Typeahead from "@/Components/typeahead/typeahead.vue";-->

<!--    export default {-->
<!--        mixins: [form],-->
<!--        components: {-->
<!--            Panel, Typeahead-->
<!--        },-->
<!--        name: "Index",-->
<!--        data() {-->
<!--            return {-->
<!--                permissions: [],-->
<!--                form: {-->
<!--                    delivery_charges: ''-->
<!--                },-->
<!--                countries: '/api/country',-->
<!--                courier: '/api/courier',-->
<!--                city: '/api/cities',-->
<!--                urlApi: "/api/cities",-->
<!--                urlApis: "/api/cities",-->
<!--                resource: "/cities",-->
<!--                small: "cities",-->
<!--                capital: "Cities",-->
<!--                columns: [-->
<!--                    {label: 'S.No', field: 'id', format: 'index'},-->
<!--                    {label: 'Cities', field: 'name',},-->
<!--                    {label: '', field: 'couriersss', slot: true},-->
<!--                    {label: 'Courier', field: 'courierss', slot: true},-->
<!--                    {label: 'leopard', field: ''},-->
<!--                    {label: 'trax', field: ''},-->
<!--                    {label: 'rider', field: ''},-->
<!--                    {label: 'Shiping Charges', field: 'charges', slot: true},-->
<!--                    {label: 'Action', field: 'action', action: true}-->
<!--                ]-->
<!--            }-->
<!--        },-->
<!--        created() {-->
<!--            this.permissions = window.apex.user.permission-->
<!--        },-->

<!--        methods: {-->
<!--            formSubmitted() {-->
<!--                byMethod('post', '/api/store_cities', this.form).then((res) => {-->

<!--                })-->
<!--            },-->
<!--            onCountries(e) {-->
<!--                const country = e.target.value-->
<!--                if (country.id != this.form.country_id){-->
<!--                    this.clear('city')-->
<!--                }-->
<!--                this.form.country = country-->
<!--                this.form.country_id = country.id-->
<!--                this.filter()-->
<!--            },-->
<!--            onCity(e) {-->
<!--                const city = e.target.value-->
<!--                this.form.city = city-->
<!--                this.form.city_id = city.id-->
<!--                this.filter()-->
<!--            },-->
<!--            onCourier(e) {-->
<!--                const courier = e.target.value-->
<!--                this.form.courier = courier-->
<!--                this.form.courier_id = courier.id-->
<!--            },-->
<!--            onCourierss(e, f) {-->
<!--                const courier = e.target.value-->
<!--                f.couriers[0] = courier-->
<!--                f.courier_id = courier.id-->
<!--            },-->
<!--            filter() {-->
<!--                setTimeout(() => {-->
<!--                    this.urlApi = this.urlApis-->
<!--                }, 100)-->
<!--                setTimeout(() => {-->
<!--                    this.urlApi += '?q='-->
<!--                    if (this.form.city_id) {-->
<!--                        this.urlApi += '&city_id=' + this.form.city_id-->
<!--                    }if (this.form.country_id) {-->
<!--                        this.urlApi += '&country_id=' + this.form.country_id-->
<!--                    }-->
<!--                }, 100)-->
<!--                setTimeout(() => {-->
<!--                    this.$refs.TableData.reload();-->
<!--                }, 100)-->
<!--            },-->
<!--            edit(id, courier_id, charges) {-->
<!--                byMethod('post', `/api/store_cities?city_id=${id}&courier_id=${courier_id}&shipping_charges=${charges}`).then((res) => {-->
<!--                    if (res.data.saved) {-->
<!--                        this.$toast.open({-->
<!--                            position: "top-right",-->
<!--                            message:-->
<!--                                "Successful",-->
<!--                            type: "success",-->
<!--                            duration: 3000,-->
<!--                        });-->
<!--                    }-->
<!--                })-->
<!--            },-->
<!--            deleteRole(e) {-->
<!--                byMethod('delete', `/api/cities/${e}`)-->
<!--                    .then((res) => {-->
<!--                        if (res.data.deleted) {-->
<!--                            this.$refs.TableData.reload();-->
<!--                            this.$toast.error(this.capital + " Deleted successfully!");-->
<!--                        }-->
<!--                    })-->
<!--            },-->
<!--            clear(e) {-->
<!--                this.form[e] = {}-->
<!--                this.form[e+'_id'] = null-->
<!--            }-->
<!--        },-->
<!--    }-->
<!--</script>-->
