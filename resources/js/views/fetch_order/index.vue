<template>
    <!-- <div class="font-bold pl-5">
        Companies
    </div> -->
    <div class="font-bold text-center bg-gray-300 rounded-md text-black pt-2 pb-2 mt-4 mb-4">
        Companies
    </div>
    <!-- <div class="flex flex-auto flex-wrap">
        <div class="sm:w-"></div>
    </div> -->
    <!-- <div class="grid grid-cols-4 gap-4 lg:gap-8" v-for="(item, index) in companies" :key="index">
        <div class="relative group flex flex-col rounded-md shadow-sm text-white bg-gray-200 overflow-hidden p-2">
            <div class="px-4 py-2">
                <p class="font-bold text-md text-center text-black">{{ item.name }}</p>
                <div class="text-center pt-4 text-3xl">
                </div>
            </div>
          </div>
      </div> -->

    <!-- <div  class="flex-auto flex flex-wrap sm:flex-nowrap sm:items-center" v-for="(item, index) in companies" :key="index" >
        <div class="w-full sm:w-1/8 pl-3 sm:mb-0">
            <div class="grid grid-cols-4 gap-4 lg:gap-8">
                <div class="relative group rounded-md shadow-sm text-white bg-gray-200 overflow-hidden p-2">
                    <div class="px-4 py-2">
                        <p class="font-bold text-md text-center text-black">{{ item.name }}</p>
                        <div class="text-center pt-4 text-3xl">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div>
        <div class="card-container mb-6">
            <div class="flex-auto flex flex-row sm:flex-nowrap sm:items-center" v-for="(item) in companies">
                <div class="w-full sm:w-1/8 pl-3 sm:mb-0 shows">
                    <div :class="{ 'border-4 border-blue-500 rounded-full': selectedCompany == item }"
                         @click="onCompany(item)"
                         class="card cursor-pointer">
                        <img :src="getImagePath(item)"/>
                    </div>
                    <span class="font-bold font-sm pl-2">{{ item.name }}</span>
                </div>
                <!-- <div class="w-full sm:w-1/8 pl-3 sm:mb-0 shows">
                    <div class="card cursor-pointer" :class="{ 'border-4 border-blue-500 rounded-full': selectedCompany == item }" @click="onCompany(item)">
                        <img :src="`/uploads/company/logo/` + item.logo">
                    </div>
                    <span class="font-bold font-sm pl-2">{{ item.name }}</span>
                </div> -->
            </div>
        </div>
    </div>
    <div class="font-bold text-center bg-gray-300 rounded-md text-black pt-1 pb-1 mt-4 mb-4">
        Stores
    </div>
    <div v-if="store.length">

        <div class="card-container mb-6">

            <div class="flex-auto flex flex-row sm:flex-nowrap sm:items-center" v-for="data in store">

                <div v-if="data.plate_form == 'WooCommerce'">

                    <div :class="activePlatform == data.id  ? 'border-4 border-blue-500 rounded-full'  : ''"
                         @click="setActivePlatform(data.id)" class="card bg-gray-200 cursor-pointer">
                        <img src="~@/images/WooCommerce.png" v-if="!data.img"/>

                        <img :src="`/uploads/store/img/` + data.img" v-else/>
                    </div>
                    <p class="text-black rounded-md font-bold text-sm">{{data.name}}</p>
                    <!-- <button   v-if="activePlatform === data.id"
                    @click="woocommerce_fetch_data(data)" class="bg-blue-400 hover:bg-blue-600 inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-2 leading-5 text-sm border-gray-200 text-white">Fetch</button> -->

                    <div>
                        <button
                            :disabled="loadingWoo"
                            @click="woocommerce_fetch_data(data.id)" class="bg-blue-400 hover:bg-blue-600 inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-2 leading-5 text-sm border-gray-200 text-white"
                            v-if="activePlatform === data.id"
                        >
                            Fetch
                            <svg
                                aria-hidden="true" class="inline w-4 h-4 mr-3 ml-3 text-white animate-spin"
                                fill="none"
                                role="status"
                                v-if="loadingWoo"
                                viewBox="0 0 100 101"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="#E5E7EB"
                                />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentColor"
                                />
                            </svg>
                        </button>

                        <!-- <button
                        v-else-if="activePlatform === data.id && loading"
                          disabled
                          type="button"
                          class="bg-blue-400 hover:bg-blue-600 inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-2 leading-5 text-sm border-gray-200 text-white"
                        >
                          <svg
                            aria-hidden="true"
                            role="status"
                            class="inline w-4 h-4 mr-3 ml-3 text-white animate-spin"
                            viewBox="0 0 100 101"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                              fill="#E5E7EB"
                            />
                            <path
                              d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                              fill="currentColor"
                            />
                          </svg>
                        </button> -->
                    </div>

                </div>
                <div v-if="data.plate_form == 'Shopify'">
                    <div :class="activePlatform === data.id  ? 'border-4 border-blue-500 rounded-full' : ''"
                         @click="setActivePlatform(data.id)" class="card bg-gray-200 cursor-pointer">
                        <img src="~@/images/Shopify-bag.png" v-if="!data.img"/>
                        <img :src="`/uploads/store/img/` + data.img" v-else/>
                    </div>
                    <p class="text-black rounded-md font-bold text-sm">{{data.name}}</p>
                    <!-- <button  v-if="activePlatform === data.id"
                    @click="shopify_fetch_data(data.id)" class="bg-blue-400 hover:bg-blue-600 inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-2 leading-5 text-sm border-gray-200 text-white"

                    >
                    Fetch
                    </button> -->

                    <div>
                        <button
                            :disabled="loadingshop" @click="shopify_fetch_data(data.id)"
                            class="bg-blue-400 hover:bg-blue-600 inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-2 leading-5 text-sm border-gray-200 text-white"
                            v-if="activePlatform === data.id "
                        >
                            Fetch
                            <svg aria-hidden="true"
                                 class="inline w-4 h-4 mr-3 ml-3 text-white animate-spin"
                                 fill="none"
                                 role="status"
                                 v-if="loadingshop"
                                 viewBox="0 0 100 101"
                                 xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="#E5E7EB"
                                />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentColor"
                                />
                            </svg>
                        </button>

                        <!-- <button
                        v-else-if="activePlatform === data.id && loading"
                          disabled
                          type="button"
                          class="bg-blue-400 hover:bg-blue-600 inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-2 leading-5 text-sm border-gray-200 text-white"
                        >
                          <svg
                            aria-hidden="true"
                            role="status"
                            class="inline w-4 h-4 mr-3 ml-3 text-white animate-spin"
                            viewBox="0 0 100 101"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                              fill="#E5E7EB"
                            />
                            <path
                              d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                              fill="currentColor"
                            />
                          </svg>
                        </button> -->
                    </div>


                </div>
                <div v-if="data.plate_form == 'MimCart'">
                    <div
                        :class="activePlatform === data.id  ? 'border-4 border-blue-500 rounded-full' || shopifyButton === true || wooButton === true : ''"
                        @click="setActivePlatform(data.id)" class="card bg-gray-200 cursor-pointer">
                        <img src="~@/images/MimCart.jpg" v-if="!data.img"/>
                        <img :src="`/uploads/store/img/` + data.img" v-else/>
                    </div>
                    <p class="text-black rounded-md font-bold text-sm">{{data.name}}</p>
                    <!-- <button v-if="activePlatform === data.id"
                    @click="mimcart_fetch_data(data.id)" class="bg-blue-400 hover:bg-blue-600 inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-2 leading-5 text-sm border-gray-200 text-white" >Fetch</button>

                    <button disabled type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center">
                    <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Loading...
                </button> -->

                    <div>
                        <button
                            :disabled="loadingmim" @click="mimcart_fetch_data(data.id)"
                            class="bg-blue-400 hover:bg-blue-600 inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-2 leading-5 text-sm border-gray-200 text-white"
                            v-if="activePlatform === data.id"
                        >
                            Fetch
                            <svg aria-hidden="true"
                                 class="inline w-4 h-4 mr-3 ml-3 text-white animate-spin"
                                 fill="none"
                                 role="status"
                                 v-if="loadingmim"
                                 viewBox="0 0 100 101"
                                 xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="#E5E7EB"
                                />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentColor"
                                />
                            </svg>

                        </button>

                        <!-- <button
                        v-else-if="activePlatform === data.id && loading"
                          disabled
                          type="button"
                          class="bg-blue-400 hover:bg-blue-600 inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-2 leading-5 text-sm border-gray-200 text-white"
                        >
                          <svg
                            aria-hidden="true"
                            role="status"
                            class="inline w-4 h-4 mr-3 ml-3 text-white animate-spin"
                            viewBox="0 0 100 101"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                              fill="#E5E7EB"
                            />
                            <path
                              d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                              fill="currentColor"
                            />
                          </svg>

                        </button> -->
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div v-else>
        <p class="font-bold text-black text-lg"> No Store Found</p>
    </div>


</template>
<script>
    import {form} from "@/libs/mixins";
    import {byMethod} from "@/libs/api";

    export default {
        mixins: [form],
        // components: {
        //     Panel, Typeahead,
        // },
        name: "Index",
        data() {
            return {
                permissions: [],
                companies: {},
                store: [],
                selectedCompany: null,
                wooButton: true,
                shopifyButton: true,
                mimCartButton: true,
                activePlatform: '',
                loadingWoo: false, // Initialize loading state as false
                loadingshop: false, // Initialize loading state as false
                loadingmim: false, // Initialize loading state as false
                resource: '/order',

            }
        },
        created() {
            // this.permissions = window.apex.user.permission
            byMethod('get', `/api/company`)
                .then((res) => {
                    console.log(res.data.data.data);
                    this.companies = res.data.data.data;
                })
        },
        methods: {
            onCompany(e) {
                const company = e;

                this.form.company_id = company.id;
                this.returns(this.form.company_id);
                this.selectedCompany = e;
            },
            getImagePath(item) {
                if (item.logo) {
                    return `/uploads/company/logo/${item.logo}`;
                } else {
                    // If no logo is uploaded, use a default image
                    return "/images/mimsoft.jpg";
                }
            },
            setActivePlatform(platform) {
                this.activePlatform = platform;
            },
            returns(e) {
                byMethod("get", `/api/stores_data?company_id=${e}`).then(
                    (res) => {
                        (this.show_company_data = true);
                        // console.log(res.data.data);
                        this.store = res.data.data.data;
                        // console.log('nband');
                    }
                );
            },
            // woocommerce_fetch_data(e){
            //     this.wooButton = false
            //     byMethod("POST", `/api/woocommerce_store_data/${e.id}`).then(
            //         (res) => {
            //             if(res.data.saved == true){
            //                 this.wooButton = true
            //                 this.$toast.success(`${res.data.new} Fetch Order Successfully`);
            //             }
            //         }
            //     );
            // },
            async woocommerce_fetch_data(id) {
                // this.loadingshop = this.loadingmim = false;
                this.loadingWoo = true; // Set loading state to true when the fetch starts
                try {
                    // Make your fetch request here
                    const res = await byMethod("POST", `/api/woocommerce_store_data/${id}`);

                    if (res.data.saved === true) {
                        this.$toast.success(`${res.data.new} Fetch Order Successfully`);
                    }
                } catch (error) {
                    // Handle any errors
                    this.$toast.error('Error fetching data');
                } finally {
                    this.loadingWoo = false; // Ensure loading is set back to false even if there is an error
                }
                this.$router.push({path: `${this.resource}`})
            },
            // shopify_fetch_data(e){
            //     this.shopifyButton = false
            //     byMethod("POST", `/api/shopify_store_data/${e}`).then(
            //         (res) => {
            //             if(res.data.saved == true){
            //                 this.shopifyButton = true
            //                 this.$toast.success(`${res.data.new} Fetch Order Successfully`);
            //             }
            //         }
            //     );
            // },
            async shopify_fetch_data(id) {
                // this.loadingWoo = this.loadingmim = false;
                this.loadingshop = true;// Set loading state to true when the fetch starts
                try {
                    // Make your fetch request here
                    const res = await byMethod("POST", `/api/shopify_store_data/${id}`);

                    if (res.data.saved === true) {
                        this.$toast.success(`${res.data.new} Fetch Order Successfully`);
                    }
                } catch (error) {
                    // Handle any errors
                    this.$toast.error('Error fetching data');
                } finally {
                    this.loadingshop = false;// Ensure loading is set back to false even if there is an error
                }
                this.$router.push({path: `${this.resource}`})
            },

            // mimcart_fetch_data(e){
            //     this.mimCartButton = false
            //     byMethod("POST", `/api/mimcart_store_data/${e}`).then(
            //         (res) => {
            //             if(res.data.saved == true){
            //                 // console.log(res)
            //                 this.mimCartButton = true
            //                 this.$toast.success(`${res.data.new} Fetch Order Successfully`);
            //             }
            //         }
            //     );
            // }

            async mimcart_fetch_data(id) {
                // this.loadingWoo = this.loadingshop = false;
                this.loadingmim = true;
                try {
                    // Make your fetch request here
                    const res = await byMethod("POST", `/api/mimcart_store_data/${id}`);

                    if (res.data.saved === true) {
                        this.$toast.success(`${res.data.new} Fetch Order Successfully`);
                    }
                } catch (error) {
                    // Handle any errors
                    this.$toast.error('Error fetching data');
                } finally {
                    this.loadingmim = false;  // Ensure loading is set back to false even if there is an error
                }
                this.$router.push({path: `${this.resource}`})

            }

        },
    }
</script>
<style scoped>
    .card {
        position: relative;
        width: 70px;
        height: 70px;
        background-color: #f2f2f2;
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        perspective: 1000px;
        box-shadow: 0 0 0 5px #ffffff80;
        transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .card svg {
        width: 48px;
        fill: #333333;
        transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    /* .card:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 16px rgba(255, 255, 255, 0.2);
    } */

    .card__content {
        position: absolute;

        left: 0;
        width: 100%;
        height: 100%;
        padding: 10px;
        box-sizing: border-box;
        background-color: #f2f2f2;
        transform: rotateX(-90deg);
        transform-origin: bottom;
        transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .card:hover .card__content {
        transform: rotateX(0deg);
    }

    .card__title {
        margin: 0;
        font-size: 12px;
        color: #3985b1;
        font-weight: 700;
    }

    .card:hover svg {
        scale: 0;
    }

    .card__description {
        margin: 10px 0 0;
        font-size: 8px;
        font-weight: bold;
        color: #0c0c0c;
        line-height: 1.4;
    }

    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
    }

    /* .shows{
      flex: 0 0 calc(12.5% - 20px);
      margin-right: 20px;
      margin-bottom: 20px;
      box-sizing: border-box;
    } */

    .selected-card {
        border: 2px solid blue; /* Change this to your desired border style and color */
    }


    @keyframes rotate_4001510 {
        100% {
            transform: rotateY(360deg);
        }
    }

</style>
