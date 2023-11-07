<template>
    <div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <h2 class="text-lg leading-6 font-medium text-blue-900"> Filter By Dates</h2>

                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-blue-900 mb-2"
                    >To Date </label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-blue-300 rounded-md"
                        type="date"
                        placeholder="Auto Generated"

                        v-model="search_start_date"
                    />
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-blue-900 mb-2"
                    >From Date</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-blue-300 rounded-md"
                        type="date"
                        v-model="search_end_date"
                    />
                </div>
                <div class="w-full sm:w-1/6 mb-4 sm:mb-0 p-2 text-right">
                    <button
                    @click="searchByDate"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-100 bg-gradient-to-r from-blue-400 via-indigo-600 to-indigo-900 text-white mt-8 "
                    type="button">
                   Filter
                </button>

                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <button
                    @click="clearsearchdata"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-100 bg-gradient-to-r from-red-400 via-red-600 to-red-900 text-white mt-8 "
                    type="button">
                   Clear
                </button>

                </div>
            </div>
        <div class="px-4 py-5  sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ capital }}</h3>


        </div>


        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <div class=" w-full sm:w-2/3 mb-4 sm:mb-0 p-2 col col-8">
                            <div class="panel-heading">
                                <span class="panel-title">
                                    <strong>Account Heads</strong>
                                </span>

                            </div>
                            <div class="panel-body"  >
                                <div class="row pl-3">
                         <ul :style="ul_height" class="col col-12 text-size">
                                        <li>
                                      <div class="bold">
                            <i :class="['arrow-icon', { 'open': one }]" @click="toggleSubMenu"></i>
                            <i class="fa fa-plus-circle mr-4" style="color:rgb(24, 125, 192)" @click="Addaccountclassgroup('Balance Sheet')"></i><i class="fa-solid fa-folder ml-2 mr-2" style="color:rgb(26, 182, 174)"></i><span @click="toggleSubMenu">Balance Sheet</span>
                            <ul class="context-menu" v-if="one">
                            <li :key="index"  v-for="(item, index) in chart">
                                <i  v-if="item.main_class == 'Balance Sheet'" :class="['arrow-icon', { 'open': subMenuOpen[index] }]" @click="right_click(index ,'Balance Sheet')"></i>
                                <i v-if="item.main_class == 'Balance Sheet'" class="fa fa-plus-circle mr-4" style="color:rgb(24, 125, 192)" @click="Addaccountclass(item.id , item.class_type)"></i><i v-if="item.main_class == 'Balance Sheet'" class="fa-solid fa-folder-minus ml-1 mr-2" style="color:rgb(24, 125, 192)"></i><span v-if="item.main_class == 'Balance Sheet'" @click="toggleSubSubmenu(index, 'Balance Sheet')">{{ item.text }}:<a class="ml-8" style="font-weight: lighter;">{{ item.balance }}</a></span>
                                <ul class="context-menu" v-if="subMenuOpen[index]">

                                <li :key="index1" v-for="(items, index1) in item.classes">
                                    <i v-if="item.main_class == 'Balance Sheet'" :class="['arrow-icon', { 'open': subMenuOpen1[index1] }]" @click="right_click1(index , index1 ,'Balance Sheet')"></i>
                                    <i  class="fa fa-plus-circle mr-4" style="color:rgb(24, 125, 192)" @click="Addaccountgroup(items.id , items.classname)" ></i><i class="fa-solid fa-folder-open mr-2 ml-1" style="color:navy"></i><span v-if="item.main_class == 'Balance Sheet' " @click="toggleSubSubmenu1(index, index1, 'Balance Sheet')">{{ items.classname }}:<a class="ml-8" style="font-weight: lighter;">{{ items.balance }}</a></span>

                                <ul class="context-menu" v-if="subMenuOpen1[index1]">
                                <li :key="index2" v-for="(item1, index2) in items.groups">
                                      <i v-if="item.main_class == 'Balance Sheet'" :class="['arrow-icon', { 'open': subMenuOpen2[index2] }]" @click="toggleSubSubmenu2(index , index1 ,index2,'Balance Sheet')"></i>
                                      <i  class="fa fa-plus-circle mr-4" style="color:rgb(24, 125, 192)" @click="Addaccounts(item1.id , item1.groupname)"></i><i class="fa-regular fa-folder-open mr-2" style="color:rgb(184, 150, 40)"></i><span @click="toggleSubSubmenu2(index, index1, index2,'Balance Sheet')">{{ item1.groupname }}:<a class="ml-8" style="font-weight: lighter;">{{ item1.balance }}</a></span>

                                    <ul class="context-menu" v-if="subMenuOpen2[index2]">
                                <li :key="index3" v-for="(item2, index3) in item1.accounts">

                                    <i class="fa-solid fa-user-tie mr-2" style="color:rgb(12, 202, 139)"></i><span @mouseleave="onleave()" @mouseover="onchange(item2)">{{item2.accounttitle.length > 0 ? item2.accounttitle:'No Record' }}:<a class="ml-8" style="font-weight: lighter;">{{item2.accounttitle.length > 0 ? item2.balance:'0.00' }}</a></span>
                                </li>
                                </ul>

                                </li>
                                </ul>
                            </li>
                                </ul>

                            </li>
                            </ul>
                        </div>


                                </li>
                                <li>
                                    <div class="bold">
                            <i :class="['arrow-icon', { 'open': one1 }]" @click="toggleSubMenu2"></i>
                            <i class="fa fa-plus-circle mr-4" style="color:rgb(24, 125, 192)" @click="Addaccountclassgroup('Income Statement')"></i><i class="fa-solid fa-folder ml-2 mr-2" style="color:rgb(26, 182, 174)"></i><span @click="toggleSubMenu2">Income Statement</span>
                            <ul class="context-menu" v-if="one1">
                            <li :key="index"  v-for="(item, index) in chart">
                                <i v-if="item.main_class == 'Income Statement'" :class="['arrow-icon', { 'open': subMenuOpen[index] }]" @click="right_click(index ,'Income Statement')"></i>
                                <i v-if="item.main_class == 'Income Statement'" class="fa fa-plus-circle mr-4" style="color:rgb(24, 125, 192)" @click="Addaccountclass(item.id , item.class_type)"></i><i v-if="item.main_class == 'Income Statement'" class="fa-solid fa-folder-minus ml-1 mr-2" style="color:rgb(24, 125, 192)"></i><span v-if="item.main_class == 'Income Statement'" @click="toggleSubSubmenu(index, 'Income Statement')">{{ item.text }}:<a class="ml-8" style="font-weight: lighter;">{{ item.balance }}</a></span>
                                <ul class="context-menu" v-if="subMenuOpen[index]">
                                <li :key="index1" v-for="(items, index1) in item.classes">
                                    <i v-if="item.main_class == 'Income Statement'" :class="['arrow-icon', { 'open': subMenuOpen1[index1] }]" @click="right_click1(index , index1 ,'Balance Sheet')"></i>
                                    <i  class="fa fa-plus-circle mr-4" style="color:rgb(24, 125, 192)" @click="Addaccountgroup(items.id , items.classname)" ></i><i class="fa-solid fa-folder-open mr-2 ml-1" style="color:navy"></i><span v-if="item.main_class == 'Income Statement' " @click="right_click1(index, index1, 'Income Statement')">{{ items.classname }}:<a class="ml-8" style="font-weight: lighter;">{{ items.balance }}</a></span>

                                    <ul class="context-menu" v-if="subMenuOpen1[index1]">
                                <li :key="index2" v-for="(item1, index2) in items.groups">
                                    <i v-if="item.main_class == 'Income Statement'" :class="['arrow-icon', { 'open': subMenuOpen2[index2] }]" @click="toggleSubSubmenu2(index , index1 ,index2,'Income Statement')"></i>
                                    <i  class="fa fa-plus-circle mr-4" style="color:rgb(24, 125, 192)" @click="Addaccounts(item1.id , item1.groupname)"></i><i class="fa-regular fa-folder-open mr-2" style="color:rgb(184, 150, 40)"></i><span @click="toggleSubSubmenu2(index, index1, index2,'Income Statement')">{{ item1.groupname }}:<a class="ml-8" style="font-weight: lighter;">{{ item1.balance }}</a></span>
                                    <ul class="context-menu" v-if="subMenuOpen2[index2]">
                                <li :key="index3" v-for="(item2, index3) in item1.accounts">

                                    <i class="fa-solid fa-user-tie mr-2" style="color:rgb(12, 202, 139)"></i><span >{{item2.accounttitle.length > 0 ? item2.accounttitle:'No Record' }}:<a class="ml-8" style="font-weight: lighter;">{{ item2.balance }}</a></span>
                                </li>
                                </ul>
                                </li>
                                </ul>
                                </li>
                                </ul>
                            </li>
                            </ul>
                        </div>

                            </li>
                            </ul>
                        </div>
                        </div>
                        </div>

                        <transition name="bounce" class=" w-full sm:w-1/3 mb-4 sm:mb-0 p-2 col col-8" v-if="active" style="z-index:9999;">
                    <div class=" flex col col-4 mt-5 pr-2" >
                        <table class="account-table">
                            <thead class="account-thead">
                            <tr>
                                <th class="align-center" colspan="4">{{ hoverdata.accounttitle }}</th>
                            </tr>
                            </thead>
                            <tbody class="account-tbody">
                            <tr>
                                <td>Code</td>
                                <td>{{ hoverdata.accountcode }}</td>
                                <td>Opening Type</td>
                                <td v-if="hoverdata.opening_type == 1">Credit</td>
                                <td v-else>Debit</td>
                            </tr>
                            <tr>
                                <td>Debit</td>
                                <td class="align-right">{{ hoverdata.debit !=null ? hoverdata.debit:''  }}</td>

                                <!-- <td class="align-right">{{ hoverdata.coa ? hoverdata.coa.debit:''  }}</td> -->
                                <td>Credit</td>
                                <td class="align-right">{{ hoverdata.credit !=null ? hoverdata.credit:''  }}</td>

                                <!-- <td class="align-right">{{ hoverdata.coa ? hoverdata.coa.credit:''}}</td> -->
                            </tr>
                            <tr>
                                <td>Rate</td>
                                <td class="align-right">{{ hoverdata.rate  }}</td>
                                <td>Opening Balance</td>
                                <td class="align-right">{{ hoverdata.opening_balance }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td colspan="3">{{ hoverdata.description }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </transition>






        </div>



        <div class="py-12 px-2">
            <div class="px-4 py-5  sm:px-6 flex justify-between items-center text-center">
            <h1 class="flex justify-between items-center text-xl leading-6 font-bold text-gray-900 text-center">Chart Of Accounts</h1>


        </div>
        <div class="flex justify-start mt-8 space-x-4 mb-4">
            <button
                    @click="subMenuOpenall1"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-gradient-to-r from-blue-400 to-indigo-600 text-white"
                    type="button">
                    Level 1
                </button>
                <button
                    @click="subMenuOpenall"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-gradient-to-r from-blue-400 to-indigo-600 text-white"
                    type="button">
                   Level 2
                </button>
                <button
                    @click="subMenuOpenall2"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-gradient-to-r from-blue-400 to-indigo-600 text-white"
                    type="button">
                   Level 3
                </button>
                <button
                    @click="subMenuOpenall3"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-gradient-to-r from-blue-400 to-indigo-600 text-white"
                    type="button">
                   Level 4
                </button>

            </div>
                <!-- Responsive Table Container -->
                <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 ">
                <thead class="bg-gray-100 h-12">
                    <th><i class="fa-solid fa-pen-fancy"></i></th>
                    <th>Code </th>
                    <th>Account Description</th>
                    <th>Balance BF</th>
                    <th>Debit</th>
                    <th>Credit</th>

                </thead>
                <br>
                <tbody class="bg-white divide-y divide-gray-200 ">
                    <template v-for="(item, index) in chart">
                    <tr class="bg-gray-50 text-blue-400"   @click="toggleSubSubmenu_new(index, 'Balance Sheet')" >
                        <td  class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center align-middle text-center">
                            <i @click="editgroupclasstype(item.id)" class="fa-regular fa-pen-to-square text-green-500 cursor-pointer"></i>
                            <i @click="deletegroupclasstype(item.id)" class="fa-solid fa-trash text-red-500 ml-4 cursor-pointer"></i>
                            </td>
                        <td  class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center align-middle text-center">
                                {{ item.code }}
                            </td>
                            <td  class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center align-center text-center">
                                {{ item.class_type }}
                            </td>
                            <td  class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">
                                {{ item.balance }}
                            </td>
                            <td  class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">
                                {{ item.debit }}
                            </td>
                            <td  class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">
                                {{ item.credit }}
                            </td>
                            <!-- <template v-if="column.action">
                                    <slot :item="row" name="action"></slot>
                                </template> -->



                    </tr>
                    <template :key="index1"  v-for="(items, index1) in item.classes" v-if="subMenuOpen_new[index]">
                    <tr class="bg-white-50 text-red-600" @click="toggleSubSubmenu11(index, index1, 'Balance Sheet')">
                        <td  class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center align-middle text-center">
                            <i @click="editgroupclass(items.id)" class="fa-regular fa-pen-to-square text-green-500 cursor-pointer"></i>
                            <i @click="deletegroupclass(items.id)" class="fa-solid fa-trash text-red-500 ml-4 cursor-pointer"></i>
                            </td>
                        <td class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">

                                {{ items.code }}
                                   </td>
                            <td  class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">

                             <span  >{{ items.classname }}</span>
                                </td>
                                <td class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">

                                {{ items.balance }}
                                   </td>
                                   <td class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">

                                {{ items.debit }}
                                   </td>

                                   <td class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">

                                {{ items.credit }}
                                   </td>
                                </tr>
                                <template :key="index2" v-for="(item1, index2) in items.groups" v-if="subMenuOpen11[index1]">
                                    <tr class="bg-gray-50 text-green-600"  @click="toggleSubSubmenu22(index, index1, index2,'Balance Sheet')">
                                        <td  class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center align-middle text-center">
                            <i @click="editgroup(item1.id)" class="fa-regular fa-pen-to-square text-green-500 cursor-pointer"></i>
                            <i @click="deletegroup(item1.id)" class="fa-solid fa-trash text-red-500 ml-4 cursor-pointer"></i>
                            </td>

                                        <td class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">
                                            {{ item1.code !=null ? item1.code :'--' }}
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">

                                <span >{{ item1.groupname }}</span>
                                   </td>
                                   <td class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">
                                            {{ item1.balance }}
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">
                                            {{ item1.debit }}
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">
                                            {{ item1.credit }}
                                        </td>
                                    </tr>
                                    <template :key="index3" v-for="(item2, index3) in item1.accounts" v-if="subMenuOpen22[index2]">
                                    <tr class="bg-white-50 text-blue-800">
                                        <td  class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center align-middle text-center">
                            <i @click="editaccount(item2.id)" class="fa-regular fa-pen-to-square text-green-500 cursor-pointer"></i>
                            <i @click="deleteaccount(item2.id)" class="fa-solid fa-trash text-red-500 ml-4 cursor-pointer"></i>
                            </td>
                                        <td class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">
                                            {{ item2.accountcode !=null ? item2.accountcode :'--' }}
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">

                                <span >{{ item2.accounttitle }}</span>
                                   </td>
                                   <td class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">
                                            {{ item2.balance }}
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">
                                            {{ item2.debit }}
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap sm:flex-row sm:items-center text-center">
                                            {{ item2.credit }}
                                        </td>
                                    </tr>
                                </template>
                                </template>

                            </template>
                </template>
                                <!-- <div class="row pl-3">
                         <ul :style="ul_height" class="col col-12 text-size">
                                        <li>
                                      <div class="bold">
                            <i :class="['arrow-icon', { 'open': one }]" @click="toggleSubMenu"></i>
                            <i class="fa fa-plus-circle mr-4" @click="Addaccountclassgroup('Balance Sheet')"></i><span @click="toggleSubMenu">Balance Sheet</span>
                            <ul class="context-menu" v-if="one">
                            <li :key="index"  v-for="(item, index) in chart">
                                <i  v-if="item.main_class == 'Balance Sheet'" :class="['arrow-icon', { 'open': subMenuOpen[index] }]" @click="right_click(index ,'Balance Sheet')"></i>
                                <i v-if="item.main_class == 'Balance Sheet'" class="fa fa-plus-circle mr-4" @click="Addaccountclass(item.id , item.class_type)"></i><span v-if="item.main_class == 'Balance Sheet'" @click="toggleSubSubmenu(index, 'Balance Sheet')">{{ item.text }}:<a class="ml-8" style="font-weight: lighter;">{{ item.balance }}</a></span>
                                <ul class="context-menu" v-if="subMenuOpen[index]">

                                <li :key="index1" v-for="(items, index1) in item.classes">
                                    <i v-if="item.main_class == 'Balance Sheet'" :class="['arrow-icon', { 'open': subMenuOpen1[index1] }]" @click="right_click1(index , index1 ,'Balance Sheet')"></i>
                                    <i  class="fa fa-plus-circle mr-4" @click="Addaccountgroup(items.id , items.classname)" ></i><span v-if="item.main_class == 'Balance Sheet' " @click="toggleSubSubmenu1(index, index1, 'Balance Sheet')">{{ items.classname }}:<a class="ml-8" style="font-weight: lighter;">{{ items.balance }}</a></span>

                                <ul class="context-menu" v-if="subMenuOpen1[index1]">
                                <li :key="index2" v-for="(item1, index2) in items.groups">
                                      <i v-if="item.main_class == 'Balance Sheet'" :class="['arrow-icon', { 'open': subMenuOpen2[index2] }]" @click="toggleSubSubmenu2(index , index1 ,index2,'Balance Sheet')"></i>
                                      <i  class="fa fa-plus-circle mr-4" @click="Addaccounts(item1.id , item1.groupname)"></i><span @click="toggleSubSubmenu2(index, index1, index2,'Balance Sheet')">{{ item1.groupname }}:<a class="ml-8" style="font-weight: lighter;">{{ item1.balance }}</a></span>

                                    <ul class="context-menu" v-if="subMenuOpen2[index2]">
                                <li :key="index3" v-for="(item2, index3) in item1.accounts">

                                    <span @mouseleave="onleave()" @mouseover="onchange(item2)">{{item2.accounttitle.length > 0 ? item2.accounttitle:'No Record' }}:<a class="ml-8" style="font-weight: lighter;">{{item2.accounttitle.length > 0 ? item2.balance:'0.00' }}</a></span>
                                </li>
                                </ul>

                                </li>
                                </ul>
                            </li>
                                </ul>

                            </li>
                            </ul>
                        </div>


                                </li>
                                <li>
                                    <div class="bold">
                            <i :class="['arrow-icon', { 'open': one1 }]" @click="toggleSubMenu2"></i>
                            <i class="fa fa-plus-circle mr-4" @click="Addaccountclassgroup('Income Statement')"></i><span @click="toggleSubMenu2">Income Statement</span>
                            <ul class="context-menu" v-if="one1">
                            <li :key="index"  v-for="(item, index) in chart">
                                <i v-if="item.main_class == 'Income Statement'" :class="['arrow-icon', { 'open': subMenuOpen[index] }]" @click="right_click(index ,'Income Statement')"></i>
                                <i v-if="item.main_class == 'Income Statement'" class="fa fa-plus-circle mr-4" @click="Addaccountclass(item.id , item.class_type)"></i><span v-if="item.main_class == 'Income Statement'" @click="toggleSubSubmenu(index, 'Income Statement')">{{ item.text }}:<a class="ml-8" style="font-weight: lighter;">{{ item.balance }}</a></span>
                                <ul class="context-menu" v-if="subMenuOpen[index]">
                                <li :key="index1" v-for="(items, index1) in item.classes">
                                    <i v-if="item.main_class == 'Income Statement'" :class="['arrow-icon', { 'open': subMenuOpen1[index1] }]" @click="right_click1(index , index1 ,'Balance Sheet')"></i>
                                    <i  class="fa fa-plus-circle mr-4" @click="Addaccountgroup(items.id , items.classname)" ></i><span v-if="item.main_class == 'Income Statement' " @click="right_click1(index, index1, 'Income Statement')">{{ items.classname }}:<a class="ml-8" style="font-weight: lighter;">{{ items.balance }}</a></span>

                                    <ul class="context-menu" v-if="subMenuOpen1[index1]">
                                <li :key="index2" v-for="(item1, index2) in items.groups">
                                    <i v-if="item.main_class == 'Income Statement'" :class="['arrow-icon', { 'open': subMenuOpen2[index2] }]" @click="toggleSubSubmenu2(index , index1 ,index2,'Income Statement')"></i>
                                    <i  class="fa fa-plus-circle mr-4" @click="Addaccounts(item1.id , item1.groupname)"></i><span @click="toggleSubSubmenu2(index, index1, index2,'Income Statement')">{{ item1.groupname }}:<a class="ml-8" style="font-weight: lighter;">{{ item1.balance }}</a></span>
                                    <ul class="context-menu" v-if="subMenuOpen2[index2]">
                                <li :key="index3" v-for="(item2, index3) in item1.accounts">

                                    <span >{{item2.accounttitle.length > 0 ? item2.accounttitle:'No Record' }}:<a class="ml-8" style="font-weight: lighter;">{{ item2.balance }}</a></span>
                                </li>
                                </ul>
                                </li>
                                </ul>
                                </li>
                                </ul>
                            </li>
                            </ul>
                        </div>

                            </li>
                            </ul>
                        </div> -->
                    </tbody>
                    </table>
                    </div>

                    <div class="flex-auto flex flex-col sm:flex-row sm:items-center mt-6">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">

                    <div class="alert alert-danger" v-if="total_balance != 0" style="color:red">
                                <strong class="hvr-buzz-out"><i class="fas fa-exclamation-triangle" style="font-size: 1.5em;"></i> &nbsp;
                                    Difference: {{ total_balance }}</strong>
                            </div>
                </div>
                <!-- <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">


                    </div> -->
                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">


                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">

                <div class="text-right font-bold">
                            <strong class="hvr-buzz-out text-right" style="color:green;"> &nbsp;
                                Total:</strong>
                        </div>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">

                    <div >
                                <strong class="hvr-buzz-out"> &nbsp;
                                     {{ total_debit }}</strong>
                            </div>
                    </div>

                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">

                <div >
                            <strong class="hvr-buzz-out"> &nbsp;
                                 {{ total_credit }}</strong>
                        </div>
                </div>


                        <!-- <div class="col col-5">
                            <div class="alert alert-danger" v-if="total_balance != 0">
                                <strong class="hvr-buzz-out"><i class="fas fa-exclamation-triangle"></i> &nbsp;
                                    Difference: {{ total_balance }}</strong>
                            </div>
                        </div>
                        <div class="col col-1 mt-3">
                            <h2>Total:</h2>
                        </div>
                        <div class="col col-2 align-right mt-3">
                            <h4>{{ total_debit }}</h4>
                        </div>
                        <div class="col col-2 align-right mt-3">
                            <h4>{{ total_credit }}</h4>
                        </div>
                        <div class="col col-2"></div> -->
                    </div>

                    </div>

<!--
                            <panel :columns="columns" :urlApi="urlApi" ref="TableData" >






                    </panel> -->

         <Modal :show="true"

                         height="900"

                         v-if="show_account_modal"
                         >
                         <div class="p-6" style="background-color:#273746 ; color:white">
                            <h1 class="text-lg font-bold mb-4 text-center">
                                    Add {{title1}}
                            </h1>
                         </div>

                         <div class="p-6">

            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Code </label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        type="number"
                        placeholder="Auto Generated"
                        disabled
                        v-model="form.code"
                    />
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Class Type</label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        type="text"
                        v-model="form.class_type"
                    />
                </div>
            </div>
            <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Main Class </label>
                    <input
                        class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                        type="text"
                        v-model="form.main_class"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.qty">{{ error.qty[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">

                                    <label
                        class="block font-medium text-sm text-gray-700 mb-2"
                    >Active </label>
                                    <select class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md" v-model="form.active">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>


                            </div>
            </div>
            <div class="flex justify-end mt-8 space-x-4">
                <button
                    @click="formSubmitted"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                    type="button">
                   Add
                </button>
                <button
                    @click="show_account_modal = false && form == []"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white"
                    type="button">
                    Cancel
                </button>
            </div>
        </div>



                        </Modal>


                        <Modal :show="true"

                height="900"

                v-if="show_account_modal1"
                >
                <div class="p-6" style="background-color:#273746 ; color:white">
                <h1 class="text-lg font-bold mb-4 text-center">
                        Add {{title2}}
                </h1>
                </div>

                <div class="p-6">

                <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label
                class="block font-medium text-sm text-gray-700 mb-2"
                >Code</label>
                <input
                class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                type="number"
                placeholder="Auto Generated"
                disabled
                v-model="form.code"
                />
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label
                class="block font-medium text-sm text-gray-700 mb-2"
                >Class </label>
                <input
                class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                type="text"
                v-model="form.classname"
                />
                </div>
                </div>
                <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                <label
                class="block font-medium text-sm text-gray-700 mb-2"
                >Class Type</label>
                <input
                class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                type="number"
                v-model="form.class_type_id"
                />
                <p class="text-red-600 text-xs italic" v-if="error.qty">{{ error.qty[0] }}</p>
                </div>
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">

                        <label
                class="block font-medium text-sm text-gray-700 mb-2"
                >Active </label>
                        <select class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md" v-model="form.active">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>


                </div>
                </div>
                <div class="flex justify-end mt-8 space-x-4">
                <button
                @click="formSubmittedClass"
                class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                type="button">
                Add
                </button>
                <button
                @click="show_account_modal1 = false && form == []"
                class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white"
                type="button">
                Cancel
                </button>
                </div>
                </div>



                </Modal>


                <Modal :show="true"

                    height="900"

                    v-if="show_account_modal2"
                    >
                    <div class="p-6" style="background-color:#273746 ; color:white">
                    <h1 class="text-lg font-bold mb-4 text-center">
                            Add {{title3}}
                    </h1>
                    </div>

                    <div class="p-6">

                    <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                    >Code</label>
                    <input
                    class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                    type="number"
                    placeholder="Auto Generated"
                    disabled
                    v-model="form.code"
                    />
                    </div>
                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                    >Group </label>
                    <input
                    class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                    type="text"
                    v-model="form.groupname"
                    />
                    </div>
                    </div>
                    <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                    <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                    >Class</label>
                    <input
                    class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                    type="number"
                    v-model="form.class_id"
                    />
                    <p class="text-red-600 text-xs italic" v-if="error.qty">{{ error.qty[0] }}</p>
                    </div>
                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">

                            <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                    >Active </label>
                            <select class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md" v-model="form.active">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>


                    </div>
                    </div>
                    <div class="flex justify-end mt-8 space-x-4">
                    <button
                    @click="formSubmittedGroup"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                    type="button">
                    Add
                    </button>
                    <button
                    @click="show_account_modal2 = false && form == []"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white"
                    type="button">
                    Cancel
                    </button>
                    </div>
                    </div>



                    </Modal>



                    <Modal :show="true"

                    height="900"

                    v-if="show_account_modal3"
                    >
                    <div class="p-6" style="background-color:#273746 ; color:white">
                    <h1 class="text-lg font-bold mb-4 text-center">
                            ADD {{title4}}
                    </h1>
                    </div>

                    <div class="p-6">

                    <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                    <div class="w-full sm:w-1/3 mb-4 sm:mb-0 p-2">
                    <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                    >Code</label>
                    <input
                    class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                    type="number"
                    placeholder="Auto Generated"
                    disabled
                    v-model="form.code"
                    />
                    </div>
                    <div class="w-full sm:w-2/3 mb-4 sm:mb-0 p-2">
                    <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                    >Account Title </label>
                    <input
                    class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                    type="text"
                    v-model="form.accounttitle"
                    />
                    </div>
                    </div>
                    <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                    <div class="w-full sm:w-1/3 mb-4 sm:mb-0 p-2">
                    <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                    >Account Group</label>
                    <input
                    class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                    type="number"
                    v-model="form.group_id"
                    />

                    </div>
                    <div class="w-full sm:w-1/3 mb-4 sm:mb-0 p-2">
                    <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                    >Op Debit</label>
                    <input
                    class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                    type="number"
                    v-model="form.op_debit"
                    />

                    </div>
                    <div class="w-full sm:w-1/3 mb-4 sm:mb-0 p-2">
                    <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                    >Op Credit</label>
                    <input
                    class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                    type="number"
                    v-model="form.op_credit"
                    />

                    </div>
                    <div class="w-full sm:w-1/3 mb-4 sm:mb-0 p-2">
                    <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                    >Op Date</label>
                    <input
                    class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                    type="date"
                    v-model="form.op_date"
                    />

                    </div>


                    </div>
                    <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                        <div class="w-full sm:w-2/3 mb-4 sm:mb-0 p-2">
                    <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                    >Descrpition</label>
                    <textarea   class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md" placeholder="Leave a comment here"  style="height: 100px" v-model="form.description"></textarea>
                    <!-- <input
                    class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
                    type="area"
                    v-model="form.description"
                    /> -->

                    </div>
                        <div class="w-full sm:w-1/4 mb-4 sm:mb-0 p-2">

                            <label
                    class="block font-medium text-sm text-gray-700 mb-2"
                    >Active </label>
                            <select class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md" v-model="form.active">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>


                    </div>

                    </div>
                    <div class="flex justify-end mt-8 space-x-4">
                    <button
                    @click="formSubmittedAccounts"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                    type="button">
                    Add
                    </button>
                    <button
                    @click="show_account_modal3 = false && form == []"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white"
                    type="button">
                    Cancel
                    </button>
                    </div>
                    </div>
                    </Modal>



    </div>

</template>




<script>
    import Panel from "@/components/panel/panel.vue";
    import {form} from "@/libs/mixins";
    import {byMethod} from "@/libs/api";
    import Modal from "@/Components/Modal.vue";
    import Typeahead from "@/Components/typeahead/typeahead.vue";
    // import contextMenu from "vue-context-menu";
    // import '@imengyu/vue3-context-menu/lib/vue3-context-menu.css'
    // import contextMenu from '@imengyu/vue3-context-menu'






    export default {
        mixins: [form],
        components: {
            Panel, Modal ,Typeahead
        },
        name: "Index",
        data() {
            return {
                one: false,
                one1: false,
                Balance_one:false,
                store:"/api/accounts_class_types",
                store_new:"/api/accounts_class_types",

                store1:"/api/accounts_class",
                store11:"/api/accounts_class",

                store2:"/api/accounts_group",
                store22:"/api/accounts_group",
                store3:"/api/accounts",
                store33:"/api/accounts",




                Supplier:'/api/supplier',
                pdf:'pdf-content',
                show_account_modal: false,
                show_account_modal1:false,
                show_account_modal2:false,
                show_account_modal3:false,
                show:false,
                open: false,
                order_id:[],
                modal_data:{},
                index_key:{},
                main_class :{},
                modal_data:[],
                subMenuOpen: [],
                subMenuOpen1:[],
                subMenuOpen2:[],
                subMenuOpen_new: [],
                subMenuOpen11:[],
                subMenuOpen22:[],
                title1:{},
                title2:{},
                title3:{},
                title4:{},



                bal_sheet_tog: false,
                inc_state_tog: false,
                account_columns: {
                    0: {
                        accountcode: "",
                        accounttitle: "",
                        head: {},
                        path: "",
                        debit: 0,
                        credit: 0,
                        balance: 0,
                        action: ""
                    }
                },
                contextMenuItem: [{
                    title: "Add Child"
                }],
                bal_sheet_data: [],
                inc_state_data: [],
                hoverdata:[],
                active:false,
                account_model: {},
                // form:{},


                chart:[],

                permissions: [],
                urlApi: "/api/accounts_class_types",
                urlApis: "/api/accounts_class_types",

                resource: "/accounts_class_types",
                small: "accounts_class_types",
                capital: "Chart Of Accounts",
                columns: [
                    {label: 'S.No', field: 'id', format: 'index'},
                    {label: 'Sku ', field: 'class_type'},
                    {label: 'barcode', field: 'balance',},
                    {label: 'Product', field: 'credit'},
                    {label: 'Qty Reqiured(in order)', field: 'debit',},


                    ]
            }
        },



        created() {
            this.permissions = window.apex.user.permission
                this.setitems();


        },
        computed:{
            ul_height() {
                if (this.bal_sheet_tog == true || this.inc_state_tog == true) {
                    return {
                        'overflow-y': 'scroll',
                        'height': '50vh'
                    }
                }
            },
            total_debit: function () {
                let debit = 0;
                for (let i = 0; i < this.chart.length; i++) {
                    debit += parseFloat(this.chart[i].debit);
                }
                return debit;
            },
            total_credit: function () {
                let credit = 0;
                for (let i = 0; i < this.chart.length; i++) {
                    credit += parseFloat(this.chart[i].credit);
                }
                return credit;
            },

            total_balance() {
                var bal = this.total_debit - this.total_credit;
                if (bal < 0) {
                    return "(" + -bal + ")";
                } else {
                    return bal;
                }
            }
        },



        methods: {

            editaccount(e){
                byMethod('get', `/api/accounts/${e}/edit`).then((res) => {
                    // console.log(res.data.form);
                    this.form = res.data.form;
                    this.title4 = res.data.form.accounttitle


                this.show= true;
                this.show_account_modal3 = true;


                })

            },

            editgroup(e){

                byMethod('get', `/api/accounts_group/${e}/edit`).then((res) => {

                    this.form = res.data.form;
                this.show_account_modal2 = true;

                })
            },

            editgroupclass(e){
                byMethod('get', `/api/accounts_class/${e}/edit`).then((res) => {
                    // console.log(res.data.form);
                    this.form = res.data.form;
                    this.title2 = res.data.form.classname
                    this.show= true;
                this.show_account_modal1 = true;

                })
            },

            editgroupclasstype(e){
                byMethod('get', `/api/accounts_class_types/${e}/edit`).then((res) => {
                    // console.log(res.data.form);
                    this.form = res.data.form;
                    this.title1 = res.data.form.class_type
                    this.show= true;
                this.show_account_modal = true;

                })
            },
            subMenuOpenall1 (){

                for (let i = 0; i < this.chart.length; i++){
                    this.subMenuOpen11[i] = false;
                    this.subMenuOpen_new[i] = false;
                    this.subMenuOpen22[i] = false

                }

            },
            subMenuOpenall (){
                // console.log('abcd')
                for (let i = 0; i < this.chart.length; i++){
                    this.subMenuOpen11[i] = false;
                    this.subMenuOpen_new[i] = true;

                }

            },
            subMenuOpenall2 (){
                // console.log('abcd')
                for (let i = 0; i < this.chart.length; i++){
                    this.subMenuOpen22[i] = false;
                    this.subMenuOpen_new[i] = true;
                    this.subMenuOpen11[i] = true;

                }

            },
            subMenuOpenall3 (){
                // console.log('abcd')
                for (let i = 0; i < this.chart.length; i++){
                    this.subMenuOpen_new[i] = true;
                    this.subMenuOpen11[i] = true;
                    this.subMenuOpen22[i] = true;

                }

            },
            onleave(){
                this.active = false
            },
            onchange(e){
                this.hoverdata = e
                this.active = true
            },
            formSubmittedAccounts(){
                if (this.form.id) {

                    this.store3 = `/api/accounts/${this.form.id}?_method=PUT`;

                }
                byMethod('post', this.store3 , this.form).then((res) => {
                    // console.log(res.data.saved)
                    if(res.data.saved = true){
                        this.show_account_modal3 = false;
                        this.$toast.open({
                        position: 'top-right',
                        message: 'Successfully Add Account',
                        type: 'success',
                        duration: 3000
                    });
                    this.form = {}
                    this.store3 = this.store33;
                    this.setitems();
                    }
                })
            },

            formSubmittedGroup(){
                if (this.form.id) {

                    this.store2 = `/api/accounts_group/${this.form.id}?_method=PUT`;

                }
                byMethod('post', this.store2 , this.form).then((res) => {
                    // console.log(res.data.saved)
                    if(res.data.saved = true){
                        this.show_account_modal2 = false;
                        this.$toast.open({
                        position: 'top-right',
                        message: 'Successfully Add Account Group ',
                        type: 'success',
                        duration: 3000
                    });
                    this.form = {}
                    this.setitems();
                    this.store2 = this.store22;
                    }
                })
            },

            formSubmittedClass(){
                // console.log(this.form);
                if (this.form.id){
                    // console.log(this.form.id)
                    this.store1 = `/api/accounts_class/${this.form.id}?_method=PUT`;

                }
                byMethod('post', this.store1 , this.form).then((res) => {
                    // console.log(res.data.saved)
                        this.show_account_modal1 = false;
                        message: 'Successfully Add Account Group Class',
                        type: 'success',
                        duration: 3000
                    });
                    this.form = {}
                    this.store1 = this.store11;
                    this.setitems();
                    }
                })
            },
            formSubmitted(){
                if (this.form.id) {

                    this.store = `/api/accounts_class_types/${this.form.id}?_method=PUT`;

                }
                // console.log(this.form);
                byMethod('post', this.store , this.form).then((res) => {
                    // console.log(res.data.saved)
                if (this.form.id) {   
                    this.store = `/api/accounts_class_types/${this.form.id}?_method=PUT`; 
                }
                byMethod('post', this.store , this.form).then((res) => {
                    if(res.data.saved = true){
                        this.show_account_modal = false;
                        this.$toast.open({
                        position: 'top-right',
                        message: 'Successfully Add Account Group Class Type',
                        type: 'success',
                        duration: 3000
                    });


                    this.setitems();
                    }
                })
                this.form = {};
                this.store = this.store_new;
            },

            Addaccounts(e , title){
                this.title4 = title;
                this.form.group_id = e;
                this.show= true;
                this.show_account_modal3 = true;
            },

            Addaccountgroup(e , title){
                this.title3 = title;
                this.form.class_id = e;
                this.show= true;
                this.show_account_modal2 = true;
            },
            Addaccountclassgroup(e){

                this.title1 = e;
                this.form.main_class = e;
                this.show= true;
                this.show_account_modal = true;
            },
            Addaccountclass(e , title){

                this.title2 = title;
                this.form.class_type_id = e;
                this.show= true;
                this.show_account_modal1 = true;
            },


            toggleSubSubmenu2(index, index1, index2) {
                this.subMenuOpen2[index2] = !this.subMenuOpen2[index2];
        // this.subMenuOpen2[index2] = !this.subMenuOpen2[index2]
        // this.subMenuOpen2[index][index1][index2] = !this.subMenuOpen2[index][index1][index2];
    },
            toggleSubSubmenu(index) {
                // console.log(index);
    //   this.$set(this.subMenuOpen, index, !this.subMenuOpen[index]);
             this.subMenuOpen[index] = !this.subMenuOpen[index];
    },
    toggleSubSubmenu1(index ,index1) {
        this.subMenuOpen1[index1] = !this.subMenuOpen1[index1];

             this.subMenuOpen1[index][index1] = !this.subMenuOpen1[index][index1];
    },

    toggleSubSubmenu22(index, index1, index2) {
                this.subMenuOpen22[index2] = !this.subMenuOpen22[index2];
        // this.subMenuOpen2[index2] = !this.subMenuOpen2[index2]
        // this.subMenuOpen2[index][index1][index2] = !this.subMenuOpen2[index][index1][index2];
    },
            toggleSubSubmenu_new(index) {
    //   this.$set(this.subMenuOpen, index, !this.subMenuOpen[index]);
             this.subMenuOpen_new[index] = !this.subMenuOpen_new[index];
    },
    toggleSubSubmenu11(index ,index1) {
        this.subMenuOpen11[index1] = !this.subMenuOpen11[index1];

             this.subMenuOpen11[index][index1] = !this.subMenuOpen11[index][index1];
    },

    right_click1(index, index1) {
        this.subMenuOpen1[index1] = !this.subMenuOpen1[index1]
    },
    right_click(index) {
        this.subMenuOpen[index] = !this.subMenuOpen[index]
    },
            // right_click(e){
            //     this.balance_one = !this.balance_one;
            //     // this.index_key = e
            // },

            toggleSubMenu() {

                this.one = !this.one;
            },
            toggleSubMenu2() {

                this.one1 = !this.one1;
            },
            toggleBal() {
                this.bal_sheet_tog = !this.bal_sheet_tog;
            },
            toggleInc() {
                this.inc_state_tog = !this.inc_state_tog;
            },
            clearsupp(){
                this.form.supplier = null
                this.form.supplier_id = null
                this.urlApi = this.urlApis
                setTimeout(() => {

                    this.$refs.TableData.reload();
                }, 100)

            },
            onSupplier(e) {
                const supplier = e.target.value
                this.form.supplier = supplier
                this.form.supplier_id = supplier.id
                this.filter(this.form.supplier_id)


            },




                        onProgress(e) {

                        },


                           close() {
                this.show = false,
                    this.show_image_modal = false
            },

            image_model(e) {


                console.log(e);
                this.modal_data = e,
                byMethod('get', '/api/product_details?id=' +e.product_id).then((res) => {
              
                        this.order_id = res.data.data,
                    this.show = true,
                        this.show_image_modal = true
                })
            },



            // isChecked(e) {
            //     return this.download = e;
            // },


    setitems() {
                byMethod("get", '/api/accounts_class_types').then(
                    res => {
                       this.chart = res.data.data.data;
                    }
                );
            },

            edit(id) {
                this.$router.push(`${this.resource}/${id}/edit`)
            },

            deleteRole(e) {
                byMethod('delete', `/api/inventory/${e}`)
                    .then((res) => {
                        if (res.data.deleted) {
                            this.$refs.TableData.reload();
                            this.$toast.error( this.capital + " Deleted successfully!");
                        }
                    })
            },


            deletegroupclasstype(e){
                byMethod('delete', `/api/accounts_class_types/${e}`)
                    .then((res) => {
        
                        if (res.data.deleted) {
                            this.setitems();
                            // this.$refs.TableData.reload();
                            this.$toast.error( this.capital + " Deleted successfully!");
                        }
                    })
            },

            deletegroupclass(e){
                byMethod('delete', `/api/accounts_class/${e}`)
                    .then((res) => {
        
                        if (res.data.deleted) {
                            this.setitems();
                            // this.$refs.TableData.reload();
                            this.$toast.error( this.capital + " Deleted successfully!");
                        }
                    })
            },

            deletegroup(e){

                byMethod('delete', `/api/accounts_group/${e}`)
                    .then((res) => {
        
                        if (res.data.deleted) {
                            this.setitems();
                            // this.$refs.TableData.reload();
                            this.$toast.error( this.capital + " Deleted successfully!");
                        }
                    })
            },


            deleteaccount(e){
                byMethod('delete', `/api/accounts/${e}`)
                    .then((res) => {
        
                        if (res.data.deleted) {
                            this.setitems();
                            // this.$refs.TableData.reload();
                            this.$toast.error( this.capital + " Deleted successfully!");
                        }
                    })

            },

            searchByDate() {

                byMethod('get',
                    `/api/accounts_class_types?to=${this.search_start_date}&from=${this.search_end_date}`
                ).then(res => {
                    this.chart =[];
                  this.chart = res.data.data.data;

                });
            },

            clearsearchdata(){
                this.search_end_date = null,
                this.search_start_date = null,
                this.setitems();
            }
        },
    }
</script>

<style>
    .bounce-enter-active {
        animation: bounce-in .5s;
    }

    .bounce-leave-active {
        animation: bounce-in .5s reverse;
    }

    @keyframes bounce-in {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }

    #showall {
        cursor: pointer;
        padding-left: 1em;
    }

    .item {
        font-size: 12px;
        cursor: pointer;
    }

    .bold {
        font-weight: bold;
    }

    ul {
        padding-left: 1em;
        line-height: 1.5em;
        list-style-type: dot;
    }

    /* .context-menu {
        font-weight: normal;
    } */

    .header {
        font-weight: bolder;
        margin-top: 17px;
        /*text-align: center !important;*/
        font-size: 24px;
    }

    .table_head {
        border: 1px solid black;
    }

    .border-3 {
        padding: 5px !important;
        border-left: 1px solid black;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        font-size: 16px;
        font-weight: bold;
    }

    .border-right {
        padding-right: 5px !important;
        font-size: 16px;
        font-weight: bold;
        border-right: 2px solid black;
    }

    .border-4 {
        padding: 5px !important;
        border: 1px solid black;
        font-size: 16px;
        font-weight: bold;
    }

    .account-table {
        border-collapse: collapse;
        margin: 50px auto;
    }

    .account-tbody > tr:nth-of-type(odd) {
        background: #eee;
    }

    .account-thead tr th {
        background: #3498db;
        color: white;
        font-weight: bold;
    }

    .account-tbody td, .account-thead th {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: left;
        font-size: 14px;
    }

    .text-size {
        font-size: 14px;
    }

    .v-text-field__details {
        display: none;
    }

    .v-input__slot {
        border-radius: 20px !important;
        border: 1px solid lightgrey;
    }
    .arrow-icon {
  /* Your arrow icon styles here */
  display: inline-block;
  width: 10px;
  height: 10px;
  border: solid black;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
  transition: transform 0.2s ease-in-out;
  cursor: pointer;
  margin-right: 10px;
}

.open {
  transform: rotate(-135deg);
  margin-right: 10px;
}

.context-menu {
  /* Your submenu styles here */
  position: relative;

  left: 5%;
  /* background-color: white;
  border: 1px solid #ccc; */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  /* z-index: 1000; */
}

</style>

