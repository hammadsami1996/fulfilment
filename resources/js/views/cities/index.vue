<template>
    <div>
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ capital }}</h3>
        </div>
        <div class="flex flex-row mb-4">
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label class="block font-medium text-sm text-gray-700 mb-2">
                    Country:
                    <button @click="clear('country')" class="text-red-400 text-sm hover:text-red-600">Clear</button>
                </label>
                <typeahead :initialize="form.country" :url="countries" @input="onCountries" display="name"/>
            </div>
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label class="block font-medium text-sm text-gray-700 mb-2">
                    Cities:
                    <!-- <button @click="clear('city')" class="text-red-400 text-sm hover:text-red-600">Clear</button> -->
                </label>
                <div class="custom-typeahead">
                    <typeahead
                    :initialize="form.city"
                    :url="form.country_id != null ? `/api/city?country_id=${form.country_id}` : city"
                    @input="onCity"
                    display="name"
                    multi-select="true"/>
                </div>
            </div>
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label class="block font-medium text-sm text-gray-700 mb-2">
                    Courier:
                    <button @click="clear('courier')" class="text-red-400 text-sm hover:text-red-600">Clear</button>
                </label>
                <typeahead :initialize="form.courier" :url="courier" @input="onCourier" display="name"/>
            </div>
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label class="block font-medium text-sm text-gray-700 mb-2">Shipping Charges</label>
                <input
                    class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                    type="number"
                    v-model="form.shipping_charges"
                />
                <p class="text-red-600 text-xs italic" v-if="error.tax_number">{{ error.tax_number[0] }}</p>
            </div>
        </div>

        <div class="mt-3 pb-4 sm:mt-0 sm:ml-4 flex justify-end">
            <button :disabled="isSubmitting" @click="formSubmitted"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2
                leading-5 text-sm border-gray-200 bg-blue-400 text-white hover:bg-blue-600 transition duration-200
                ease-in-out"
            >
                <svg aria-hidden="true" class="inline w-4 h-4 mr-3 text-white animate-spin" fill="none"
                     role="status" v-if="isSubmitting" viewBox="0 0 100 101"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="#E5E7EB"/>
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentColor"/>
                </svg>
                Bulk Update
            </button>
        </div>


        <div class="flex-col">
            <panel :columns="columns" :urlApi="urlApi" ref="TableData">
                <template v-slot:couriersss="props">
                    <div v-if="props.item.couriers[0]">
                        <img
                            v-if="props.item.couriers[0].id === 4"
                            src="~@/images/karachi.png"
                            style="height: 50px; width: 50px; border-radius: 50%"
                        />
                        <img
                            v-if="props.item.couriers[0].id === 3"
                            src="~@/images/rider.png"
                            style="height: 50px; width: 50px; border-radius: 50%"
                        />
                        <img
                            v-if="props.item.couriers[0].id ===  1 || props.item.couriers[0].id === 5"
                            src="~@/images/trax.png" 
                            style="height: 50px; width: 50px; border-radius: 50%"
                        />
                        <img
                            v-if="props.item.couriers[0].id === 6 || props.item.couriers[0].id === 2"
                            src="~@/images/leopard.jpeg"
                            style="height: 50px; width: 50px; border-radius: 50%"
                        />
                    </div>
                </template>

                <template v-slot:courierss="props">
                    <typeahead :initialize="props.item.couriers[0]" :url="courier" @input="onCourierss($event, props.item)" display="name" />
                </template>

                <template v-slot:charges="props">
                    <input
                        class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                        type="text"
                        v-if="props.item.couriers[0] && props.item.couriers[0].pivot"
                        v-model="props.item.couriers[0].pivot.delivery_charges"
                    />
                    <input class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md" type="number" v-else v-model="delivery_charges" />
                </template>

                <template v-slot:action="props">
                    <div class="text-sm font-medium flex">
            <span>
              <a @click.prevent="edit(props.item.id, props.item.couriers[0].id, props.item.couriers[0].pivot ? props.item.couriers[0].pivot.delivery_charges : delivery_charges)" href="#">
                <i class="fa-solid fa-check-double text-2xl text-blue-400"></i>
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
                form: {
                    delivery_charges: "",
                },
                countries: "/api/country",
                courier: "/api/courier",
                city: "/api/cities",
                urlApi: "/api/cities",
                urlApis: "/api/cities",
                resource: "/cities",
                small: "cities",
                capital: "Countries",
                columns: [
                    { label: "S.No", field: "id", format: "index" },
                    { label: "Cities", field: "name" },
                    { label: "", field: "couriersss", slot: true },
                    { label: "Courier", field: "courierss", slot: true },
                    { label: "Leopard", field: 'id', displayText: 'leopards' },
                    { label: "Trax", field: 'id' , displayText: 'trax'},
                    { label: "Rider", field: 'id' , displayText: 'tcs'},
                    { label: "shipping charges", field: "charges", slot: true },
                    { label: "Action", field: "action", action: true },
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
                    // Handle the response here
                    this.isSubmitting = false; // Re-enable the button and hide the spinner
                });
            },
            onCountries(e) {
                const country = e.target.value;
                if (country.id != this.form.country_id) {
                    this.clear("city");
                }
                this.form.country = country;
                this.form.country_id = country.id;
                this.filter();
            },
            onCity(e) {
                const city = e.target.value;
                this.form.city = city;
                this.form.city_id = city.id;
                this.filter();
            },
            onCourier(e) {
                const courier = e.target.value;
                this.form.courier = courier;
                this.form.courier_id = courier.id;
            },
            onCourierss(e, f) {
                const courier = e.target.value;
                f.couriers[0] = courier;
                f.courier_id = courier.id;
            },
            filter() {
                setTimeout(() => {
                    this.urlApi = this.urlApis;
                }, 100);
                setTimeout(() => {
                    this.urlApi += "?q=";
                    if (this.form.city_id) {
                        this.urlApi += "&city_id=" + this.form.city_id;
                    }
                    if (this.form.country_id) {
                        this.urlApi += "&country_id=" + this.form.country_id;
                    }
                }, 100);
                setTimeout(() => {
                    this.$refs.TableData.reload();
                }, 100);
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
