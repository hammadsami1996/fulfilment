<template>
    <div class="p-2">

        <div class="grid grid-cols-5 gap-4 lg:gap-8">
            <!-- Course Card -->
            <a class="relative group flex flex-col rounded-md shadow-sm text-white bg-blue-100 overflow-hidden transition hover:ring-4 hover:ring-blue-400 active:opacity-90 p-2"
               href="#">
                <div class="px-4 py-2">
                    <div class="font-bold text-lg mb-1 text-blue-500">Payment%</div>
                    <div class="flex items-center pt-4">
                        <p class="text-blue-500 text-2xl font-bold">{{form.total_orders_amount}}</p>
                    </div>
                </div>

            </a>
            <!-- END Course Card -->


            <!-- Course Card -->
            <a class="relative group flex flex-col rounded-md shadow-sm text-white bg-yellow-100 overflow-hidden transition hover:ring-4 hover:ring-yellow-400 active:opacity-90 p-2"
               href="#">
                <div class="px-4 py-2">
                    <div class="font-bold text-lg mb-1 text-yellow-500">Return Received</div>
                    <div class="flex items-center pt-4">
                        <p class="text-yellow-500 text-2xl font-bold">{{form.total_order_return_received}}</p>
                    </div>
                </div>
            </a>
            <!-- END Course Card -->


            <!-- Course Card -->
            <a class="relative group flex flex-col rounded-md shadow-sm text-white bg-red-100 overflow-hidden transition hover:ring-4 hover:ring-red-400 active:opacity-90 p-2"
               href="#">
                <div class="px-4 py-2">
                    <div class="font-bold text-lg mb-1 text-red-500">Cancel%</div>
                    <div class="flex items-center pt-4">
                        <p class="text-red-500 text-2xl font-bold">{{form.total_order_cancel}}</p>
                    </div>
                </div>
            </a>
            <!-- END Course Card -->


            <!-- Course Card -->
            <a class="relative group flex flex-col rounded-md shadow-sm text-white bg-green-100 overflow-hidden transition hover:ring-4 hover:ring-green-400 active:opacity-90 p-2"
               href="#">
                <div class="px-4 py-2">
                    <div class="font-bold text-lg mb-1 text-green-500">Fulfilment%</div>
                    <div class="flex items-center pt-4">
                        <p class="text-green-500 text-2xl font-bold">512</p>
                    </div>
                </div>
            </a>
            <!-- END Course Card -->


            <!-- Course Card -->
            <a class="" href="#">
                <div class="relative">
                    <select class="block appearance-none w-full bg-white px-4 py-2 pr-8 rounded leading-tight"
                    >
                        <option value="0">Daily</option>
                        <option value="1">Weekly</option>
                        <option value="2">Monthly</option>
                        <option value="3">Yearly</option>
                    </select>
                </div>
            </a>
            <!-- END Course Card -->

        </div>


        <div class="grid grid-cols-4 gap-4 lg:gap-8 mt-8">
            <!-- Course Card -->
            <a class="relative group flex flex-col rounded-md shadow-sm text-white bg-gray-200 overflow-hidden transition hover:ring-4 hover:ring-blue-400 active:opacity-90 p-2"
               href="#">
                <div class="px-4 py-2">
                    <div class="font-bold text-lg mb-1 text-black">Due Recievable</div>
                    <div class="flex items-center pt-4">
                        <p class="text-black text-2xl font-bold">2150.00</p><span class="text-gray-500 pl-2 font-bold">PKR</span>
                    </div>
                    <div class="flex justify-between items-center pt-5">
                        <p class="text-gray-700 text-base">
                            <strong class="font-bold">174</strong> orders
                        </p>
                        <button
                            class="text-gray-400 py-1 px-2 rounded-full text-sm transition hover:bg-blue-200 hover:text-blue-500 active:opacity-90 p-2">
                            VIEW
                        </button>
                    </div>
                </div>
            </a>
            <!-- END Course Card -->


            <!-- Course Card -->
            <a class="relative group flex flex-col rounded-md shadow-sm text-white bg-gray-200 overflow-hidden transition hover:ring-4 hover:ring-blue-400 active:opacity-90 p-2"
               href="#">
                <div class="px-4 py-2">
                    <div class="font-bold text-lg mb-1 text-black">Orders</div>
                    <div class="flex items-center pt-4">
                        <p class="text-black text-2xl font-bold">{{form.total_orders}}</p>
                    </div>
                    <div class="flex justify-between items-center pt-5">
                        <p class="text-gray-700 text-base">
                            <strong class="font-bold">174</strong> orders Unsettled
                        </p>
                        <button
                            @click="this.$router.push('/order')"
                            class="text-gray-400 py-1 px-2 rounded-full text-sm transition hover:bg-blue-200 hover:text-blue-500 active:opacity-90 p-2">
                            VIEW
                        </button>
                    </div>
                </div>
            </a>
            <!-- END Course Card -->

            <!-- Course Card -->
            <a class="relative group flex flex-col rounded-md shadow-sm text-white bg-gray-200 overflow-hidden transition hover:ring-4 hover:ring-blue-400 active:opacity-90 p-2"
               href="#">
                <div class="px-4 py-2">
                    <div class="font-bold text-lg mb-1 text-black">On Hold</div>
                    <div class="flex items-center pt-4">
                        <p class="text-black text-2xl font-bold">{{form.total_order_onHold}}</p>
                    </div>
                    <div class="flex justify-between items-center pt-5">
                        <p class="text-gray-700 text-base">
                            <strong class="font-bold">174</strong> orders Unsettled
                        </p>
                        <button
                            @click="this.$router.push('/order')"
                            class="text-gray-400 py-1 px-2 rounded-full text-sm transition hover:bg-blue-200 hover:text-blue-500 active:opacity-90 p-2">
                            VIEW
                        </button>
                    </div>
                </div>
            </a>
            <!-- END Course Card -->

            <!-- Course Card -->
            <a class="relative group flex flex-col rounded-md shadow-sm text-white bg-gray-200 overflow-hidden transition hover:ring-4 hover:ring-blue-400 active:opacity-90 p-2"
               href="#">
                <div class="px-4 py-2">
                    <div class="font-bold text-lg mb-1 text-black">Confirmed</div>
                    <div class="flex items-center pt-4">
                        <p class="text-black text-2xl font-bold">{{form.total_order_confirmed}}</p>
                    </div>
                    <div class="flex justify-between items-center pt-5">
                        <p class="text-gray-700 text-base">
                            <strong class="font-bold">174</strong> orders Unsettled
                        </p>
                        <button
                            @click="this.$router.push('/order')"
                            class="text-gray-400 py-1 px-2 rounded-full text-sm transition hover:bg-blue-200 hover:text-blue-500 active:opacity-90 p-2">
                            VIEW
                        </button>
                    </div>
                </div>
            </a>
            <!-- END Course Card -->

        </div>

        <div class="grid grid-cols-3 gap-4 lg:gap-8 mt-8">

            <!-- Course Card -->
            <a class="relative group flex-col rounded-md shadow-sm text-white bg-gray-200 overflow-hidden transition hover:ring-4 hover:ring-blue-400 active:opacity-90 p-2"
               href="#">
                <div class="px-4 py-2">
                    <div class="font-bold text-xl mb-1 text-black">Recent Transaction</div>
                </div>
            </a>
            <!-- END Course Card -->


            <!-- Course Card -->
            <a class="relative group sm:col-span-2 flex flex-col rounded-md shadow-sm text-white bg-gray-200 overflow-hidden transition hover:ring-4 hover:ring-blue-400 active:opacity-90 p-2"
               href="#">
                <div class="px-4 py-2">
                    <div class="font-bold text-xl mb-1 text-black">Delivered Orders</div>
                    <div class="flex items-center pt-4">
                        <div id="chart">
                            <apexchart :options="chartOptions" :series="series" height="250" type="line"
                                       width="700"></apexchart>
                        </div>
                    </div>
                </div>
            </a>
            <!-- END Course Card -->

        </div>

        <div class="grid grid-cols-4 gap-4 lg:gap-8 mt-8">

            <a class="relative group sm:col-span-2 flex flex-col rounded-md shadow-sm text-white bg-gray-200 overflow-hidden transition hover:ring-4 hover:ring-blue-400 active:opacity-90 p-2"
               href="#">
                <div class="px-4 py-2">
                    <div class="flex items-center justify-between">
                        <p class="font-bold text-xl mb-1 text-black">Order Soap</p>
                        <div class="relative inline-block w-32">
                            <select
                                class="block appearance-none bg-white px-4 py-2 pr-8 rounded leading-tight border border-gray-300 text-sm text-black">
                                <option class="text-black" value="0">Daily</option>
                                <option class="text-black" value="1">Weekly</option>
                                <option class="text-black" value="2">Monthly</option>
                                <option class="text-black" value="3">Yearly</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center pt-4">
                        <div class="bg-white rounded-lg shadow-md w-full p-2">
                            <p class="text-gray-500 text-center font-bold">Total Orders</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">5130</p>
                        </div>
                        <div class="bg-white rounded-lg shadow-md w-full ml-5 p-2">
                            <p class="text-gray-500 text-center font-bold">Booked</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">3190</p>
                        </div>

                        <div class="bg-white rounded-lg shadow-md w-full ml-5 p-2">
                            <p class="text-gray-500 text-center font-bold">Unbooked</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">1428</p>
                        </div>
                    </div>
                    <div class="flex items-center pt-4">
                        <div class="bg-white rounded-lg shadow-md w-full p-2">
                            <p class="text-gray-500 text-center font-bold">Successful</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">510</p>
                        </div>
                        <div class="bg-white rounded-lg shadow-md w-full ml-5 p-2">
                            <p class="text-gray-500 text-center font-bold">Out for Delivery</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">1140</p>
                        </div>

                        <div class="bg-white rounded-lg shadow-md w-full ml-5 p-2">
                            <p class="text-gray-500 text-center font-bold">Delivered</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">969</p>
                        </div>
                    </div>
                    <div class="flex items-center pt-4">
                        <div class="bg-white rounded-lg shadow-md w-full p-2">
                            <p class="text-gray-500 text-center font-bold">Unsuccessful</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">510</p>
                        </div>
                        <div class="bg-white rounded-lg shadow-md w-full ml-5 p-2">
                            <p class="text-gray-500 text-center font-bold">Out for Return</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">510</p>
                        </div>

                        <div class="bg-white rounded-lg shadow-md w-full ml-5 p-2">
                            <p class="text-gray-500 text-center font-bold">Returned</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">319</p>
                        </div>
                    </div>
                </div>
            </a>
            <a class="relative group sm:col-span-2 flex flex-col rounded-md shadow-sm text-white bg-gray-200 overflow-hidden transition hover:ring-4 hover:ring-blue-400 active:opacity-90 p-2"
               href="#">
                <div class="px-4 py-2">
                    <div class="flex items-center justify-between">
                        <p class="font-bold text-xl mb-1 text-black">Key Matrixs</p>
                        <div class="relative inline-block w-32">
                            <select
                                class="block appearance-none bg-white px-4 py-2 pr-8 rounded leading-tight border border-gray-300 text-sm text-black">
                                <option class="text-black" value="0">Daily</option>
                                <option class="text-black" value="1">Weekly</option>
                                <option class="text-black" value="2">Monthly</option>
                                <option class="text-black" value="3">Yearly</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center pt-4">
                        <div class="bg-white rounded-lg shadow-md w-full p-2">
                            <p class="text-gray-500 text-center font-bold">Total Orders</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">5130</p>
                        </div>
                        <div class="bg-white rounded-lg shadow-md w-full ml-5 p-2">
                            <p class="text-gray-500 text-center font-bold">Day</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">5</p>
                        </div>

                        <div class="bg-white rounded-lg shadow-md w-full ml-5 p-2">
                            <p class="text-gray-500 text-center font-bold">Courier</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">TCS</p>
                        </div>
                    </div>
                    <div class="flex items-center pt-4">
                        <div class="bg-white rounded-lg shadow-md w-full p-2">
                            <p class="text-gray-500 text-center font-bold">Unsuccesful</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">510</p>
                        </div>
                        <div class="bg-white rounded-lg shadow-md w-full ml-5 p-2">
                            <p class="text-gray-500 text-center font-bold">Day</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">3</p>
                        </div>

                        <div class="bg-white rounded-lg shadow-md w-full ml-5 p-2">
                            <p class="text-gray-500 text-center font-bold">Courier</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">TCS</p>
                        </div>
                    </div>
                    <div class="flex items-center pt-4">
                        <div class="bg-white rounded-lg shadow-md w-full p-2">
                            <p class="text-gray-500 text-center font-bold">Delivered Orders</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">980</p>
                        </div>
                        <div class="bg-white rounded-lg shadow-md w-full ml-5 p-2">
                            <p class="text-gray-500 text-center font-bold">Day</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">2</p>
                        </div>

                        <div class="bg-white rounded-lg shadow-md w-full ml-5 p-2">
                            <p class="text-gray-500 text-center font-bold">Courier</p>
                            <p class="text-gray-600 text-center font-bold text-lg pt-3">TCS</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Course Card -->
            <!-- <a href="#" class="relative group flex flex-col rounded-md shadow-sm text-white bg-custom-color overflow-hidden transition hover:ring-4 hover:ring-blue-400 active:opacity-90 p-2">
                <div class="px-4 py-2">
                    <div class="text-md mb-1 text-yellow-300">TODAY'S ORDERS</div>
                    <p class="text-white font-bold">0.00</p>
                    <p class="text-gray-300">PKR</p>
                    <div class="mt-2 flex space-x-6">
                        <div>
                            <p class="text-blue-400 text-sm text-xl font-bold">0.00</p>
                            <p class="text-gray-300 text-xs">Pending Amount</p>
                        </div>
                        <div>
                            <p class="text-green-400 text-sm text-xl font-bold">0</p>
                            <p class="text-gray-300 text-xs">Pending Orders</p>
                        </div>
                        <div>
                            <p class="text-yellow-400 text-sm text-xl font-bold">0</p>
                            <p class="text-gray-300 text-xs">Total Orders</p>
                        </div>
                    </div>
                </div>
            </a> -->
            <!-- END Course Card -->
        </div>
    </div>
</template>


<script>
    // import VueApexCharts from "vue3-apexcharts";
    import {get} from "@/libs/api";
    import {form} from "@/libs/mixins";

    function initialize(to) {
        let urls = {
            add: `/api/dashboard`,
        }
        return urls.add
    }

    export default {
        components: {
            // apexchart: VueApexCharts,
        },
        mixins: [form],
        data() {
            return {
                chartOptions: {
                    chart: {
                        height: 350,
                        type: 'line',
                        dropShadow: {
                            enabled: true,
                            color: '#000',
                            top: 18,
                            left: 7,
                            blur: 10,
                            opacity: 0.2
                        },
                        toolbar: {
                            show: false
                        }
                    },
                    colors: ['#3B82F6'],
                    dataLabels: {
                        enabled: true,
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    // title: {
                    //     text: 'Average High & Low Temperature',
                    //     align: 'left'
                    // },
                    grid: {
                        borderColor: '#e7e7e7',
                        row: {
                            colors: ['#f3f3f3', 'transparent'],
                            opacity: 0.5
                        },
                    },
                    markers: {
                        size: 1
                    },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                        title: {
                            text: 'Month'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Orders'
                        },
                        min: 5,
                        max: 40
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        floating: true,
                        offsetY: -25,
                        offsetX: -5
                    },
                },
                series: [
                    {
                        name: "Orders",
                        data: [20, 28, 25, 36, 32, 32, 33]
                    },
                ],
            }
        },
        beforeRouteEnter(to, from, next) {
            get(initialize(to))
                .then((res) => {
                    next(vm => vm.setData(res))
                })
        },
        beforeRouteUpdate(to, from, next) {
            get(initialize(to))
                .then((res) => {
                    this.setData(res);
                    next()
                })
        },
        created() {
        },
        methods: {
            setData(res) {
                this.form = res.data;
                console.log(res.data);
            }

        }
    };

</script>

<style scoped>
    .bg-custom-color {
        background-color: #685DD7;
    }
</style>
