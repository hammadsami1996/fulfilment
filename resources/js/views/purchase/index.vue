<template>
    <div>
        <div class="bg-gray-100 py-4">
            <nav class="container mx-auto flex justify-center" style="cursor: pointer;">
                <a @click="show_data(0)"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-blue-500 focus:text-gray-700 focus:border-blue-300">
                    All
                </a>
                <a @click="show_data(23)"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-purple-500 focus:text-gray-700 focus:border-purple-300">
                    Draft
                </a>
                <a @click="show_data(24)"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-green-500 focus:text-gray-700 focus:border-green-300">
                    Sent
                </a>
                <a @click="show_data(25)"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-rose-500 focus:text-gray-700 focus:border-rose-300">
                    Confiremd
                </a>
                <a @click="show_data(27)"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-yellow-500 focus:text-gray-700 focus:border-yellow-300">
                    Received
                </a>
                <a @click="show_data(29)"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-lime-500 focus:text-gray-700 focus:border-lime-300">
                    Partially Received
                </a>
                <a @click="show_data(28)"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-cyan-500 focus:text-gray-700 focus:border-cyan-300">
                    Bill
                </a>
                <a @click="show_data(30)"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-cyan-500 focus:text-gray-700 focus:border-cyan-300">
                    Cancelled
                </a>
                <a @click="show_data(26)"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-cyan-500 focus:text-gray-700 focus:border-cyan-300">
                    Closed
                </a>
            </nav>
        </div>
        <div class="px-4 py-5  sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ capital }}</h3>
            <div class="mt-3 pb-4 sm:mt-0 sm:ml-4 flex justify-end">
                <router-link :to="{name:`create-${small}`}"
                             type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white">
                    Create
                </router-link>
            </div>
        </div>
        <div class="flex-col">
            <panel :columns="columns" :urlApi="urlApi" ref="TableData">
                <template v-slot:statuses="props" >
                    <div>
                        <typeahead 
                        :initialize="props.item.status"
                        :url="delivery+'?head=purchase&id='+ props.item.status.id"
                        @input="onDelivery($event ,props.item.id)" display="name"
                      
                        v-if="props.item.status"
                        />
                    </div>
                        <!-- <span v-else> {{'This Order Not Packable'}}</span> -->
                        <!-- :initialize="props.item.status.name" -->
                    <!-- <button   :style="{ background: props.item.status.color } " @click="shows(1 ,props.item.id) " >
                           {{ props.item.status ? props.item.status.name :'' }}
                                </button> -->
                                <!-- <button @click="shows(1 ,props.item.id) ">Draft</button> -->


                                <!-- <div v-if="sts && props.item.id == ids"> -->
                                    <!-- <div> -->
                                        <!-- <button  style="width:50% ; height: 70%; background-image: linear-gradient(90deg,#93b194,green); font-weight: bold;" @click="Update(form.deliver ,props.item.id) ">
                                    Update
                                </button> -->
                                <!-- <button  style="width:50% ; height: 70%; background-image: linear-gradient(90deg,#975252,rgb(197, 13, 13)); font-weight: bold;" @click="Cancel() ">
                                    Hide
                                </button> -->


                                    <!-- </div> -->
                                    <!-- <typeahead :initialize="form.deliver" :url="delivery+'?head=purchase&id='+ props.item.status.id"   @input="onDelivery($event ,props.item.id)" display="name" class="z-99"/> -->


                         <!-- </div> -->
                </template>
                <template v-slot:action="props">
                    <div class="text-sm font-medium flex">
                         <span v-if="permissions.includes(`edit-${small}`) && props.item.status_id < 25">
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
            Panel, Typeahead
        },
        name: "Index",
        data() {
            return {
                sts:false,
                id:null,
                ids:null,
                permissions: [],
                urlApi: "/api/purchase",
                urlApi_new: "/api/purchases",
                resource: "/purchase",
                small: "purchase",
                capital: "Purchase",
                delivery:'/api/sts',
                columns: [
                    {label: 'S.No', field: 'id', format: 'index'},
                    {label: 'Supplier', field: 'name', displayText: 'supplier'},
                    {label: 'PO Number', field: 'po_number'},
                    {label: 'PO Number Reference', field: 'po_reference_number'},
                    {label: 'Total', field: 'sub_total'},
                    {label: 'Tax', field: 'tax'},
                    {label: 'Status', field: 'statuses' , slot:true},
                    {label: 'Partail Remaining', field: 'partial_remaining' ,align:'center' },


                    {label: 'Action', field: 'action', action: true}
                    ]
            }
        },
        created() {
            this.permissions = window.apex.user.permission
        },
        methods: {
            show_data(e){
                setTimeout(() => {
                    this.urlApi = this.urlApi_new
                }, 100)
                setTimeout(() => {
                    this.urlApi += '?status_id=' + e
                }, 100)
                setTimeout(() => {
                    // console.log(this.$refs);
                    this.$refs.TableData.reload();
                }, 100)
                // byMethod('GET', '/api/purchases?status_id='+e  ).then(res => {



                // })
            },
            Cancel(){
                this.sts = false;
                this.form.deliver = null;
            },
            shows(e,status_id){
                this.sts = true;
                this.ids = status_id;
                this.id = e
            },
            onDelivery(e ,id) {
                const deliver = e.target.value
                this.form.deliver = deliver
                this.form.deliver_id = deliver.id
                this.Update(this.form.deliver ,id);

            },
            edit(id) {
                this.$router.push(`${this.resource}/${id}/edit`)
            },
            Update(e ,id){
               // console.log(e.id);
               if(e.id == 27){

                this.$router.push(`/recieve_order/${id}/edit`)
                }
                else{

                    byMethod('POST', '/api/updated?ids='+id , e).then(res => {
                        if (res.data.saved) {
                            this.sts = false,
                            this.form.deliver = null;

                            this.$refs.TableData.reload();
                        }
                    })
                }


           },
            deleteRole(e) {
                byMethod('delete', `/api/purchase/${e}`)
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
font-weight: bold !important;
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


</style>
