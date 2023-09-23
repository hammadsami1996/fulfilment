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
                    <div class="card cursor-pointer" :class="{ 'border-4 border-blue-500 rounded-full': selectedCompany == item }" @click="onCompany(item)">
                        <img :src="`/uploads/company/logo/` + item.logo">
                    </div>
                    <span class="font-bold font-sm pl-2">{{ item.name }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="font-bold text-center bg-gray-300 rounded-md text-black pt-1 pb-1 mt-4 mb-4">
        Stores
    </div>
    <div v-if="store.length">
        <div class="card-container mb-6">
            <div class="flex-auto flex flex-row sm:flex-nowrap sm:items-center" v-for="data in store">
                <div class="w-full sm:w-1/8 pl-3 sm:mb-0 shows" >
                    <!-- <button class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-bold py-1 px-5 ml-3 rounded-full shadow-lg transform transition-all duration-500 ease-in-out hover:scale-110 hover:brightness-110 hover:animate-pulse active:animate-bounce">{{data.name}}</button> -->
                    <div v-if="data.plate_form == 'WooCommerce'">
                        <div class="card bg-gray-200 cursor-pointer" @click="wooButton = !wooButton" :class="!wooComLoader ? 'w-16 h-16 rounded-full border-4 border-t-4 border-blue-500 border-opacity-50 animate-pulse' : ''">
                            <img src="/images/WooCommerce.png"/>
                        </div>
                        <p class="text-black rounded-md font-bold text-sm">{{data.name}}</p>
                        <button v-if="!wooButton" @click="woocommerce_fetch_data(data)" class="bg-blue-400 hover:bg-blue-600 inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-2 leading-5 text-sm border-gray-200 text-white">Fetch</button>
                    </div>
                    <div v-if="data.plate_form == 'Shopify'">
                        <div class="card bg-gray-200 cursor-pointer" @click="shopifyButton = !shopifyButton" :class="!shopifyLoader ? 'w-16 h-16 rounded-full border-4 border-t-4 border-blue-500 border-opacity-50 animate-pulse' : ''">
                            <img src="/images/Shopify-bag.png"/>
                        </div>
                        <p class="text-black rounded-md font-bold text-sm">{{data.name}}</p>
                        <button v-if="!shopifyButton" @click="shopify_fetch_data(data.id)" class="bg-blue-400 hover:bg-blue-600 inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-2 leading-5 text-sm border-gray-200 text-white">Fetch</button>
                    </div>
                    <div v-if="data.plate_form == 'MimCart'">
                        <div class="card bg-gray-200 cursor-pointer" @click="mimCartButton = !mimCartButton" :class="!mimCartLoader ? 'w-16 h-16 rounded-full border-4 border-t-4 border-blue-500 border-opacity-50 animate-pulse' : ''">
                            <img src="/images/MimCart.jpg"/>
                        </div>
                        <p class="text-black rounded-md font-bold text-sm">{{data.name}}</p>
                        <button v-if="!mimCartButton" @click="mimcart_fetch_data(data.id)" class="bg-blue-400 hover:bg-blue-600 inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-2 py-2 leading-5 text-sm border-gray-200 text-white">Fetch</button>
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
import Panel from "@/components/panel/panel.vue";
import {form} from "@/libs/mixins";
import {byMethod} from "@/libs/api";
import Typeahead from "@/Components/typeahead/typeahead.vue";

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
                wooComLoader: true,
                shopifyLoader: true,
                mimCartLoader: true,
                wooButton: true,
                shopifyButton: true,
                mimCartButton: true,
            }
        },
        created() {
            // this.permissions = window.apex.user.permission
            byMethod('get', `/api/company`)
                .then((res) => {
                    console.log(res.data.data.data)
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
            returns(e) {
                byMethod("get", `/api/stores_data?company_id=${e}`).then(
                    (res) => {
                    (this.show_company_data = true);
                    console.log(res.data.data)
                    this.store = res.data.data.data
                    }
                );
            },
            woocommerce_fetch_data(e){
                this.wooComLoader = false 
                byMethod("POST", `/api/woocommerce_store_data/${e.id}`).then(
                    (res) => {
                        if(res.data.saved == true){
                            this.wooComLoader = true
                            this.$toast.success(`${res.data.new} Fetch Order Successfully`);
                        }
                    }
                );
            },
            shopify_fetch_data(e){
                this.shopifyLoader = false 
                byMethod("POST", `/api/shopify_store_data/${e}`).then(
                    (res) => {
                        if(res.data.saved == true){
                            this.shopifyLoader = true 
                            this.$toast.success(`${res.data.new} Fetch Order Successfully`);
                        }
                    }
                );
            },
            mimcart_fetch_data(e){
                this.mimCartLoader = false 
                byMethod("POST", `/api/mimcart_store_data/${e}`).then(
                    (res) => {
                        if(res.data.saved == true){
                            console.log(res)
                            this.mimCartLoader = true 
                            this.$toast.success(`${res.data.new} Fetch Order Successfully`);
                        }
                    }
                );
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
