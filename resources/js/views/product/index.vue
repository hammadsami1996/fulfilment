<template>
  <div>
    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
      <h1
        class="text-4xl leading-7 font-semibold text-semibold font-lg text-gray-900"
        style="
          font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto,
            'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji',
            'Segoe UI Emoji', 'Segoe UI Symbol';
          color: #343a40;
        "
      >
        {{ capital }}
      </h1>
      <div class="mt-3 pb-4 sm:mt-0 sm:ml-4 flex justify-end">
        <button
          @click="Product_excel('Excel')"
          class="inline-flex justify-center items-center space-x-2 border rounded-lg px-5 py-2 leading-5 text-sm border-gray-200 bg-gray-300 text-white hover:bg-gray-600 transition-colors duration-300"
          type="button"
        >
          Export Excel
        </button>
        <router-link
          :to="{ name: `create-${small}` }"
          class="inline-flex justify-center ml-3 items-center space-x-3 border rounded-lg px-5 py-2 leading-6 text-sm border-gray-200 bg-blue-400 text-white hover:bg-blue-600 transition-colors duration-300"
          type="button"
        >
          Add New
        </router-link>
        <!--                <button-->
        <!--                    @click="exportTableToExcel('print', 'products')"-->
        <!--                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"-->
        <!--                    type="button">-->
        <!--                    Excel-->
        <!--                </button>-->
      </div>
    </div>
    <div class="bg-slate-50">
      <div class="py-5 sm:px-6 flex flex-wrap">
        <div
          class="sm:w-full md:w-1/2 lg:w-1/3 xl:w-1/3 flex items-center mb-4 md:mb-0"
        >
          <div class="sm:mt-0 sm:ml-4 w-full">
            <label class="text-gray-600 mb-2 block">Title/Url</label>
            <input
              type="text"
              v-model="form.title"
              placeholder="Search Product by Title or Url"
              class="rounded-md py-2 pl-4 pr-8 w-full border-gray-300 focus:ring-primary focus:border-primary text-sm"
            />
          </div>
        </div>
        <div
          class="sm:w-full md:w-1/2 lg:w-1/3 xl:w-1/3 flex items-center mb-4 md:mb-0"
        >
          <div class="sm:mt-0 sm:ml-4 w-full">
            <label class="text-gray-600 mb-2 block">Sku / Barcode</label>
            <input
              type="text"
              v-model="form.sku"
              placeholder="Search Product by Sku, Barcode"
              class="rounded-md py-2 pl-4 pr-8 w-full border-gray-300 focus:ring-primary focus:border-primary text-sm"
              />
              <!-- v-model="form.sku" -->
          </div>
        </div>
        <div class="flex items-center mb-1 md:mb-0">
          <div class="sm:mt-0 sm:ml-4 w-full mt-5">
            <a
              href="#"    @click="onremove()"
              class="bg-blue-500 text-white p-3 rounded-md ml-0 mt-6 inline-flex items-center"
            >
              <i class="fa fa-refresh" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="flex items-center mb-1 md:mb-0">
          <div class="sm:mt-0 sm:ml-4 w-full mt-5">
            <a
              href="#"
              @click="onSearch()"
              class="bg-blue-500 text-white py-2 px-3 rounded-md ml-0 mt-6 inline-flex items-center"
            >
              Search
            </a>
          </div>
        </div>
        <div class="flex items-center mb-1 md:mb-0" style="margin-left: -16px">
          <div class="sm:mt-0 sm:ml-4 w-full mt-5">
            <a
              href="#"
              @click="toggleAdvanceSearch"
              class="text-blue-600 py-2 underline px-3 rounded-md ml-0 mt-6 inline-flex items-center"
            >
              Advance Search
            </a>
          </div>
        </div>
      </div>
      <div v-if="showAdvanceSearch">
        <div class="flex flex-wrap ml-10" style="margin-top: -28px">
          <div class="w-full py-4 border-b border-black mx-auto">
            <h4 class="text-black font-semibold text-xl py-2 mt-2 items-center">
              Search by Price & Inventory
            </h4>
          </div>
          <div
            class="sm:w-full md:w-1/2 lg:w-1/3 xl:w-1/3 flex items-center mb-4 md:mb-0 mt-3"
          >
            <div class="sm:mt-0 w-full flex items-center mb-4 md:mb-0 mt-3">
              <div class="relative">
                <label class="text-gray-600 mb-2 block">Price</label>

                <select v-model="form.searchOperator"
                  class="appearance-none rounded-md py-2 pl-2 pr-8 w-full border-gray-300 focus:ring-primary focus:border-primary text-sm"
                >
                  <option value="1">==</option>
                  <option value="2">= ></option>
                  <option value="3">&#60; =</option>
                </select>
              </div>
              <input
                type="text"
                v-model="form.cost_price"
                placeholder="Search by Price"
                class="rounded-md py-2 mt-7 ml-3 pl-4 pr-6 w-2/2 border-gray-300 focus:ring-primary focus:border-primary text-sm"
              />
            </div>
          </div>

          <div
            class="sm:w-full md:w-1/2 lg:w-1/3 xl:w-1/4 flex items-center mb-4 md:mb-0 mt-3"
          >
            <div class="sm:mt-0 w-full flex items-center mb-4 md:mb-0 mt-3">
              <div class="relative">
                <label class="text-gray-600 mb-2 block">Quantity</label>

                <select v-model="form.searchQuantity"
                  class="appearance-none rounded-md py-2 pl-2 pr-8 w-full border-gray-300 focus:ring-primary focus:border-primary text-sm"
                >
                  <option value="1">==</option>
                  <option value="2">= ></option>
                  <option value="3">&#60; =</option>
                  <!-- Add more options as needed -->
                </select>
              </div>
              <input
                type="text"
                v-model="form.quantity"
                placeholder="Search by Quantity"
                class="rounded-md py-2 mt-7 ml-3 pl-4 pr-6 w-2/2 border-gray-300 focus:ring-primary focus:border-primary text-sm"
              />
            </div>
          </div>
        </div>
        <div class="w-full flex flex-wrap ml-10">
          <div class="w-full py-4 border-b border-black mx-auto">
            <h4 class="text-black font-semibold text-xl py-2 mt-2 items-center">
              Search by Product Organization
            </h4>
          </div>

          <div class="w-1/4 mb-4 md:mb-0">
            <label class="text-gray-600 mb-1 mt-2 block">Category</label>
            <div class="mb-2 py-2 custom-typeahead">
              <typeahead display="name" :initialize="form.category" :url="pro_category" @input="onProCategory" />
            </div>
          </div>
          <div class="ml-5 w-1/4 mb-4 md:mb-0">
            <label class="text-gray-600 mb-1 mt-2 block">Brand</label>
            <div class="mb-2 py-2 custom-typeahead">
              <typeahead display="title" :initialize="form.brand" :url="brand" @input="onbrand" />
            </div>
          </div>
          <!-- <div class="ml-5 w-1/5 mb-4 md:mb-0 mr-2">
            <label class="text-gray-600 mb-1 mt-2 block">Attribute Set</label>
            <div class="mb-2 py-2 custom-typeahead">
              <typeahead display="title" />
            </div>
          </div> -->
          <div class="ml-5 w-1/4 mb-4 md:mb-0">
            <label class="text-gray-600 mb-1 mt-2 block">Supplier</label>
            <div class="mb-2 py-2 custom-typeahead">
              <typeahead display="name" :initialize="form.supplier" :url="supplier" @input="onsupplier" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex-col">
      <div class="flex mb-4 md:mb-0">
        <!-- First Div -->
        <div class="sm:mt-0 sm:ml-4 p-3 ">
          <label class="text-gray-600 mb-2 block text-bold">Bulk Actions</label>
          <a
            href="#"
            @click="AdvanceDelete"
            class="bg-red-500 text-white py-2 px-2 rounded-md ml-0 mt-6 block items-center"
          > <svg
                  class="h-5 w-5 mr-2"
                  fill="none"
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"

                >
                  <polyline points="3 6 5 6 21 6" />
                  <path
                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                  />
                </svg>
            Delete
          </a>
        </div>

        <!-- Second Div -->
        <div class="sm:mt-0 sm:ml-4 p-3 justify-around">
          <label class="text-gray-600 mb-2 block text-bold"
            >Update Bulk Price</label>
            <div class="space-x-2">
      <div class="inline-flex items-center space-x-3 mt-6">
        <input
          type="checkbox"
          id="switch2"
          name="switch2"
          class="h-7 w-12 rounded-full text-primary-500 transition-all duration-150 ease-out form-switch focus:ring focus:ring-primary-500 focus:ring-opacity-50 dark:bg-gray-700 dark:ring-offset-gray-900 dark:checked:bg-current"
          checked
          v-model="isUpdateVisible"
        />
      </div>
    </div>
  </div>
  <!-- Third Div (Show Price) -->
  <!-- <template> -->
    <div class="sm:mt-0 sm:ml-auto flex pr-6 items-center justify-end" >
      <label class="text-gray-600 mb-2 block text-bold"
      >Show Products:</label>
      <p class="pl-3 pb-2">{{ count }}</p>
    </div>
  </div>
  <div v-if="isUpdateVisible" class="w-full flex flex-wrap ml-8 mt-3">

          <div class="w-1/6 mb-4 md:mb-0">
            <select v-model="selectedUnit" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:border-blue-300"
                           >
                           <option value="percent">percent(%)</option>
                            <option value="rupees">Rupees</option>
                        </select>
          </div>
          <div class="ml-5 w-1/6 mb-4 md:mb-0">
            <select  v-model="selectedOperation" class="block w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring focus:border-blue-300">
                    <option value="increase">increase</option>
                    <option value="decrease">decrease</option>
                </select>
          </div>
          <div class="ml-5 w-1/6 mb-4 md:mb-0 mr-2">
            <input
            type="number"
            v-model="costPrice"
              class="w-full py-5 px-3 bg-white h-8 border border-gray-300 rounded-md" placeholder="cost price" />
          </div>
          <div class="ml-5 w-1/6 mb-4 md:mb-0 mr-2">
            <input
            type="number"
            v-model="sellingPrice"
              class="w-full py-5 px-3 bg-white h-8 border border-gray-300 rounded-md" placeholder="selling price"/>
          </div>
          <a
            href="#" @click="UpdatePrice"
            class=" text-white py-2 px-2 rounded-md ml-0  block items-center" style="background-color:  #00a4fe">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 text-white-500 text-bold">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
          Update
          </a>

        </div>
    <!-- </template> -->
      <panel :columns="columns" :urlApi="urlApi" ref="TableData" id="print" @selectAll="selectAll" :search-enable="false">
        <template v-slot:checkbox="props">
                    <div class="text-center">
                        <input :value="props.item.id" class="form-checkbox h-5 w-5 text-blue-500" type="checkbox"
                               v-model="selectedItems"/>
                    </div>
                </template>
                <template v-slot:titleese="props">
          <div>
            <p>{{ props.item.title ? props.item.title : "" }}</p>
            <p>{{ props.item.barcode ? props.item.barcode : "" }}</p>
          </div>
        </template>

        <template v-slot:skues="props">
          <div>
            <button class="text-white font-bold py-2 px-4 rounded"  style="background-color: #04a2b3;width: 150px; white-space: normal;overflow: hidden;text-overflow: ellipsis;"
          onmouseover="this.style.backgroundColor='#047d8f'"
          onmouseout="this.style.backgroundColor='#04a2b3'">
            {{ props.item.sku ? props.item.sku : "No SKU available" }}
          </button>
          </div>
        </template>
        <template v-slot:imgess="props">
          <div>
            <img
              :src="getImagePath(props)"
              alt=""
              class="shadow-xl h-10 w-10 rounded-md"
            />
          </div>
        </template>
        <template v-slot:namesupplier="props">
          <div>
            <p>{{ props.item.supplier ? props.item.supplier.name : "" }}</p>
          </div>
        </template>
        <template v-slot:cost_priceses="props">
          <div>
            <p class="p-4 pl-0 pb-1 pt-3">Cost Price</p>
                <div class="flex items-center border rounded" style="border-width: thin; width: fit-content">
                  <input
                    type="text"
                    class="rounded p-1 w-16 text-center text-sm"
                    pattern="[0-9]*"
                    :value="props.item.cost_price ? props.item.cost_price : 0"
                    @input="updateCostPrice($event.target.value)"
                  />
                  <button
                    class="text-blue-500 p-1 rounded w-8 h-8 flex items-center justify-center border"
                    style="background-color: #eff2f7"
                    @click="saveCostPrice(props.item.id, props.item.cost_price)"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      class="h-5 w-5 text-blue-500"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="4"
                        d="M5 13l4 4L19 7"
                      ></path>
                    </svg>
                  </button>
                </div>
            <p class="p-4 pl-0 pb-1 pt-3">Selling Price</p>
            <div
              class="flex items-center border rounded"
              style="border-width: thin; width: fit-content"
            >
              <input
                type="text"
                class="rounded p-1 w-16 text-center text-sm"
                :value="props.item.selling_price ? props.item.selling_price : 0"
                @input="updateSellingPrice($event.target.value)"
              />
              <button
                class="text-blue-500 p-1 rounded w-8 h-8 flex items-center justify-center border"
                style="background-color: #eff2f7"
                @click="savesellingPrice(props.item.id,props.item.selling_price )"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                  class="h-5 w-5 text-blue-500"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="4"
                    d="M5 13l4 4L19 7"
                  ></path>
                </svg>
              </button>
            </div>
          </div>
        </template>
        <template v-slot:stockes="props">
          <div>
            <p class="pl-0 pb-1">{{props.item.quantity ? props.item.quantity : 0}}</p>
            <!-- <div
              class="flex items-center border rounded"
              style="border-width: thin; width: fit-content"
            > -->
              <!-- <input
                type="text"
                class="rounded p-1 w-16 text-center text-sm"
                :value="props.item.quantity ? props.item.quantity : 0"
                @input="updateQuantityPrice($event.target.value)"

              />
              <button
                class="text-blue-500 p-1 rounded w-8 h-8 flex items-center justify-center border"
                style="background-color: #eff2f7"
                @click="saveQuantity(props.item.id,props.item.quantity )"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  class="h-5 w-5 text-blue-500"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="4"
                    d="M5 13l4 4L19 7"
                  ></path>
                </svg>
              </button>
            </div>  -->
            <p class="p-4 pl-0 pb-1">Manage Inventry</p>
            <!-- <p>{{ props.item.manage_inventory }}</p> -->
            <div class="space-x-2">
      <div class="inline-flex items-center space-x-3">
        <input
          type="checkbox"
          id="switch2"
          :checked="props.item.manage_inventory === 1"
          @change="updateManageInventory(props.item,props.item.id)"
          name="switch2"
          class="h-7 w-12 rounded-full text-primary-500 transition-all duration-150 ease-out form-switch focus:ring focus:ring-primary-500 focus:ring-opacity-50 dark:bg-gray-700 dark:ring-offset-gray-900 dark:checked:bg-current"

          />
  </div>
    </div>

          </div>
        </template>
        <template v-slot:action="props">
          <div class="text-sm font-medium flex p-2">
            <span
              v-if="permissions.includes(`edit-${small}`)"
              class="bg-blue-400 p-1 text-white border rounded border-blue-500 mr-2 hover:bg-blue-600 transition-colors duration-300"
            >
              <a @click.prevent="edit(props.item.id)" href="#">
                <svg
                  class="h-5 w-5"
                  fill="none"
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                >
                  <path d="M0 0h24v24H0z" stroke="none" />
                  <path
                    d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"
                  />
                  <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                  <line x1="16" x2="19" y1="5" y2="8" />
                </svg>
              </a>
            </span>
            <span
              v-if="permissions.includes(`delete-${small}`)"
              class="bg-red-500 p-1 border rounded border-red-500 text-white hover:bg-red-600 transition-colors duration-300"
            >
              <a @click.prevent="deleteRole(props.item.id)" href="#">
                <svg
                  class="h-5 w-5"
                  fill="none"
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                >
                  <polyline points="3 6 5 6 21 6" />
                  <path
                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                  />
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
import { form } from "@/libs/mixins";
// import axios from "@/libs/axios";
import axios from 'axios';
import * as Vue from 'vue';
import Typeahead from "@/Components/typeahead/typeahead.vue";
import { byMethod } from "@/libs/api";

export default {
  mixins: [form],
  props: {
    urlApi1: {
      type: String,
      required: true,
    },
  },

  components: {
    Panel,
    Typeahead,
  },
  name: "Index",
  data() {
    return {
      isUpdateVisible: false,
      permissions: [],
      isChecked: false,
      selectedUnit: 'percent',
      selectedOperation: 'increase',
      count: 0,
      cost: 0,
      selling: 0,
      quantity: 0,
      costPrice: 0,
      sellingPrice: 0,
      selectedItems: [],
      showAdvanceSearch: false,
      urlApi: "/api/product",
      urlApi1: "/api/product",
      pro_category: "/api/product_category",
      brand: "/api/brand",
      supplier: "/api/supplier",
      resource: "/product",
      small: "product",
      capital: "Product",
      columns: [
        // {label: 'S.No', field: 'id', format: 'index'},
        {label: 'S.No', field: 'checkbox', slot: true},
        { label: "SKU", field: "skues",slot:true },
        { label: "Image", field: "imgess", slot: true },
        { label: "Name", field: "titleese", slot:true },
        { label: "Supplier", field: "namesupplier", slot: true },
        { label: "Price", field: "cost_priceses", slot: true },
        { label: "Quantity", field: "stockes", slot: true },
        { label: "Action", field: "action", action: true },
      ],
    };
  },
  created() {
    this.permissions = window.apex.user.permission;
  },
  mounted() {
    this.fetchProductCount();
  },
  methods: {
    Product_excel() {
      window.open("/docs/product_excel", "_blank");
    },
    UpdatePrice() {
      let data = {
                    selectedItems: this.selectedItems,
                    operation: this.selectedOperation,
                    unit: this.selectedUnit,
                    costPrice: this.costPrice,
                    sellingPrice: this.sellingPrice
                }
                byMethod('POST', '/api/bulk_price', data).then(res => {
                    this.$refs.TableData.reload();
                    this.$toast.open({
                        position: 'top-right',
                        message: "Price Update Successfully",
                        type: 'success',
                        duration: 3000
                    });
                })
      // Access the values of the input fields
      console.log('Selected Unit:', this.selectedUnit);
      console.log('Selected Operation:', this.selectedOperation);
      console.log('Cost Price:', this.costPrice);
      console.log('Selling Price:', this.sellingPrice);

      // Perform your update logic here
    },
    AdvanceDelete(){
      let data = {
                    selectedItems: this.selectedItems
                }
      // console.log(this.selectedItems);
        byMethod('POST', '/api/bulk_delete', data).then(res => {
                    this.$refs.TableData.reload();
                    this.fetchProductCount();
                    this.$toast.open({
                        position: 'top-right',
                        message: "Product Delete Successfully",
                        type: 'success',
                        duration: 3000
                    });
                })
    },
    updateManageInventory(item,id){

      let record = {
        data: item.manage_inventory === 1 ? 0 : 1,
        id: id
      }
      byMethod('POST', '/api/bulk_manage_inventry', record).then(res => {
                    this.$refs.TableData.reload();
                    this.$toast.open({
                        position: 'top-right',
                        message: "Manage Inventry Update Successfully",
                        type: 'success',
                        duration: 3000
                    });
                })
           },

    fetchProductCount() {
      axios.get(this.urlApi1)
        .then((response) => {
          this.count = response.data.count;
        })
        .catch((error) => {
          console.error('Error fetching product count:', error);
        });
    },
    onremove(){
      this.form.title = this.form.sku = this.form.cost_price =
      this.form.searchOperator = this.form.quantity  = this.form.searchQuantity = this.form.category =
      this.form.brand = this.form.supplier = null;
      this.urlApi = "/api/product";
      this.fetchProductCount();
      setTimeout(() => {
    this.$refs.TableData.reload();
  }, 100);
      // this.$refs.TableData.reload();
    },
    onSearch(){
      setTimeout(() => {
        this.urlApi = this.urlApi1
                }, 500)
                setTimeout(() => {
                  let param = "?q=";
                  // const combinedSearchValue = this.combinedSearch();

                  //   if (combinedSearchValue !== '') {
                  //     param += `&combined_search=${encodeURIComponent(combinedSearchValue)}`;
                  //   }
                    if (this.form.title != null) {
                        param += `&title=${this.form.title}`;
                    }
                    if (this.form.sku != null) {
                        param += `&sku=${this.form.sku}`;
                    }
                    if (this.form.cost_price != null) {
                        if (this.form.searchOperator == '1') {
                          // Search logic for ==
                          param += `&cost_price=${encodeURIComponent(this.form.cost_price)}`;
                        } else if (this.form.searchOperator === '2') {
                          // Search logic for = >
                          param += `&cost_price_greater_than=${encodeURIComponent(this.form.cost_price)}`;
                        }else if (this.form.searchOperator === '3') {
                          // Search logic for = >
                          param += `&cost_price_less_than=${encodeURIComponent(this.form.cost_price)}`;
                        }
                      }
                      if (this.form.quantity != null) {
                        if (this.form.searchQuantity === '1') {
                          // Search logic for ==
                         param += `&quantity=${encodeURIComponent(this.form.quantity)}`;
                        } else if (this.form.searchQuantity === '2') {
                          // Search logic for = >
                          param += `&quantity_greater_than=${encodeURIComponent(this.form.quantity)}`;
                        }else if (this.form.searchQuantity === '3') {
                          // Search logic for = >
                          param += `&quantity_greater_than=${encodeURIComponent(this.form.quantity)}`;
                        }
                      }
                    if (this.form.category != null) {
                        param += `&category_id=${this.form.category_id}`;
                    }
                    if (this.form.brand != null) {
                        param += `&brand_id=${this.form.brand_id}`;
                    }
                    if (this.form.supplier != null) {
                        param += `&supplier_id=${this.form.supplier_id}`;
                    }
                    this.urlApi += param
                }, 500)
                setTimeout(() => {
                    this.$refs.TableData.reload();

                }, 500)
    },


    updateCostPrice(costese) {
      this.cost = costese;
  },
  updateSellingPrice(selles){
    this.selling = selles

  },
  updateQuantityPrice(quantites){
    this.quantity = quantites;
  },
    saveCostPrice(itemId) {

  axios.put(`/api/product/cost/${itemId}`, { cost_price: this.cost })
    .then(response => {
      // console.log(response.data);
      this.$toast.open({
              position: 'top-right',
              message: response.data.message,
              type: 'success',
              duration: 3000
          });
    })
    .catch(error => {
      console.error('Error updating cost price:', error);
    });
      },
      savesellingPrice(itemId) {

      axios.put(`/api/product/selling/${itemId}`, { selling_price: this.selling })
        .then(response => {
          // console.log(response.data);
          this.$toast.open({
                  position: 'top-right',
                  message: response.data.message,
                  type: 'success',
                  duration: 3000
              });
        })
        .catch(error => {
          console.error('Error updating selling price:', error);
        });
      },
      saveQuantity(itemId){
        axios.put(`/api/product/quantity/${itemId}`, { quantity: this.quantity })
        .then(response => {
          // console.log(response.data);
          this.$toast.open({
                  position: 'top-right',
                  message: response.data.message,
                  type: 'success',
                  duration: 3000
              });
        })
        .catch(error => {
          console.error('Error updating Quantity:', error);
        });
      },

    onProCategory(e){
              const procategory = e.target.value
                this.form.category = procategory
                this.form.category_id = procategory.id
    },
    onbrand(e){
      const brands = e.target.value
                this.form.brand = brands
                this.form.brand_id = brands.id
    },
    onsupplier(e){
      const suppliers = e.target.value
      this.form.supplier = suppliers
      this.form.supplier_id = suppliers.id


    },
    toggleAdvanceSearch() {
      this.showAdvanceSearch = !this.showAdvanceSearch;
    },
    selectAll(e) {
                this.selectedItems = e
            },
    getImagePath(props) {
      if (
        Array.isArray(props.item.product_img) &&
        props.item.product_img.length > 0
      ) {
        return `/uploads/product/img/${props.item.product_img[0].img}`;
      } else {
        return "/uploads/product/img/noimage.jpg";
      }
    },
    edit(id) {
      this.$router.push(`${this.resource}/${id}/edit`);
    },
    deleteRole(e) {
      byMethod("delete", `/api/product/${e}`).then((res) => {
        if (res.data.deleted) {
          this.$refs.TableData.reload();
          this.$toast.error(this.capital + " Deleted successfully!");
        }
      });
    },
  },
};
</script>
<style >
.flex .items-center {
  display: flex;
  align-items: center;
}

.input,
.button {
  border: 1px solid var(--color-gray-300);
  height: 30px;
  padding: 5px;
}

</style>
