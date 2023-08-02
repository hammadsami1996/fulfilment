<template>
    <div>
        <div class="bg-gray-100 py-4">
            <nav class="container mx-auto flex justify-center">
                <a @click="all" class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-blue-500 focus:text-gray-700 focus:border-blue-300">
                    All
                </a>
                <a @click="unfulfilled" class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-purple-500 focus:text-gray-700 focus:border-purple-300">
                    Unfulfilled
                </a>
                <a @click="partially_fulfilled" class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-green-500 focus:text-gray-700 focus:border-green-300">
                    Partially Fulfilled
                </a>
                <a @click="cancelled" class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-rose-500 focus:text-gray-700 focus:border-rose-300">
                    Cancelled
                </a>
                <a @click="unpaid" class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-yellow-500 focus:text-gray-700 focus:border-yellow-300">
                    Unpaid
                </a>
                <a @click="duplicate" class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-lime-500 focus:text-gray-700 focus:border-lime-300">
                    Duplicate
                </a>
                <a @click="s" class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-cyan-500 focus:text-gray-700 focus:border-cyan-300">
                    +
                </a>
            </nav>
        </div>
        <div class="px-4 py-5  sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ capital }}</h3>
            <div class="mt-3 pb-4 sm:mt-0 sm:ml-4 flex justify-end">
                <router-link :to="{name:`create-${small}`}"
                             type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white">
                    Create Order
                </router-link>
            </div>
        </div>
        <div class="flex-col">
            <panel :columns="columns" :urlApi="urlApi" ref="TableData">
                <template v-slot:status="props">
               
                         <button v-if="props.item.status_id == 1" style=" background-image: linear-gradient(90deg,#f8d664,orange);  font-weight: bold;" @click="shows(1 ,props.item.id) ">
                            Pending
                                </button>
                                <button v-if="props.item.status_id == 2" style=" background-image: linear-gradient(90deg,#e8f571,greenyellow); font-weight: bold;" @click="shows(2 ,props.item.id) ">
                                    Confirmed
                                </button>
                                <button v-if="props.item.status_id == 3" style=" background-image: linear-gradient(90deg,#5b8da1,rgb(44, 44, 134)); font-weight: bold; " @click="shows(3 ,props.item.id) ">
                                    Shipped
                                </button>
                                <button v-if="props.item.status_id == 4" style=" background-image: linear-gradient(90deg,#587e5a,green); font-weight: bold;" @click="shows(4 , props.item.id) ">
                                    Delivered
                                </button>
                                <div v-if="sts && props.item.id == ids">
                                    <div>
                                        <button  style="width:50% ; height: 70%; background-image: linear-gradient(90deg,#93b194,green); font-weight: bold;" @click="Update(form.deliver ,props.item.id) ">
                                    Update
                                </button>
                                <button  style="width:50% ; height: 70%; background-image: linear-gradient(90deg,#975252,rgb(197, 13, 13)); font-weight: bold;" @click="Cancel() ">
                                    Cancel
                                </button>

                                    
                                    </div>
                                    <typeahead :initialize="form.deliver" :url="delivery+'?status='+id" @input="onDelivery" display="name"/>
                             
                            
                         </div>
                        </template>
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



                <!-- <template v-slot:show > 
                   
               <div class="uiverse">
                <span class="tooltip" style="color: black;">Confirmed</span>
              <img src="/images/icons8-confirm-48.png" >
         
            </div>
                      
              </template> -->
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
            Panel, Typeahead,
        },
        name: "Index",
        data() {
            return {
                sts:false,
                id:null,
                ids:null,

                permissions: [],
                urlApi: "/api/order",
                resource: "/order",
                delivery:'/api/status',
                small: "order",
                capital: "Order",
                columns: [
                    {label: 'S.No', field: 'id', format: 'index'},
                    {label: 'Store', field: 'name', displayText: 'stores'},
                    {label: 'Order Date', field: 'order_date'},
                    {label: 'Customer', field: 'name', displayText: 'customer'},
                    {label: 'Delivery Status', field: 'status' , slot:true},
                    {label: 'Payment Status', field: 'subTotal'},
                    {label: 'Action', field: 'action', action: true},
                    // {label: 'Status', field: 'show', slot:true}

                    ]
            }
        },
        created() {
            this.permissions = window.apex.user.permission
        },
        methods: {
            Cancel(){
                this.sts = false;
                this.form.deliver = null;
            },
            shows(e,status_id){
                this.sts = true;
                this.ids = status_id;
                this.id = e
            },
            Update(e ,id){
               
                byMethod('POST', '/api/update?ids='+id , e).then(res => {
                    if (res.data.saved) {
                        this.sts = false,
                        this.form.deliver = null;
                        this.$refs.TableData.reload();
                    }
                })


            },

          


            onDelivery(e) {
                const deliver = e.target.value
                this.form.deliver = deliver
                this.form.deliver_id = deliver.id
            },
            edit(id) {
                this.$router.push(`${this.resource}/${id}/edit`)
            },
            deleteRole(e) {
                byMethod('delete', `/api/order/${e}`)
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
<style scoped>
    
button {
  border-radius: .25rem;
  text-transform: uppercase;
  font-style: normal;
  font-weight: 400;
  padding-left: 25px;
  padding-right: 25px;
  color: #fff;
  -webkit-clip-path: polygon(0 0,0 0,100% 0,100% 0,100% calc(100% - 15px),calc(100% - 15px) 100%,15px 100%,0 100%);
  clip-path: polygon(0 0,0 0,100% 0,100% 0,100% calc(100% - 15px),calc(100% - 15px) 100%,15px 100%,0 100%);
  height: 40px;
  font-size: 0.7rem;
  line-height: 14px;
  letter-spacing: 1.2px;
  transition: .2s .1s;
  /* background-image: linear-gradient(90deg,#1c1c1c,#6220fb); */
  /* background-color: blue; */
  border: 0 solid;
  overflow: hidden;
}

button:hover {
  cursor: pointer;
  transition: all .3s ease-in;
  padding-right: 30px;
  padding-left: 30px;
}



.uiverse {
  position: relative;
  
  padding: 15px;
  margin: 10px;
  border-radius: 10px;
  width: 80px;
  height: 40px;
  font-size: 17px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;

  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.tooltip {
  position: absolute;
  top: 0;
  font-size: 14px;
  background: #ffffff;
  color: #ffffff;
  padding: 5px 8px;
  border-radius: 5px;
  box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
  opacity: 0;
  pointer-events: none;
  transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.tooltip::before {
  position: absolute;
  content: "";
  height: 8px;
  width: 8px;
  background: #ffffff;
  bottom: -3px;
  left: 50%;
  transform: translate(-50%) rotate(45deg);
  transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.uiverse:hover .tooltip {
  top: -45px;
  opacity: 1;
  visibility: visible;
  pointer-events: auto;
}

svg:hover span,
svg:hover .tooltip {
  text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.1);
}

.uiverse:hover,
.uiverse:hover .tooltip,
.uiverse:hover .tooltip::before {
  /* background: linear-gradient(320deg, rgb(3, 77, 146), rgb(0, 60, 255)); */
  background: #fff;
  color: #ffffff;
}

</style>
