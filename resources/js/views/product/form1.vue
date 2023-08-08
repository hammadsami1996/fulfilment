<template>
    <div class="flex mx-1">
        <div class="w-8/12 mx-2">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-xl font-bold mb-4 text-indigo-600">Add Product</h3>
                <div class="col-span-12">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input
                            class="w-full py-1 px-2 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required type="text" v-model="form.title">
                    </div>
                </div>
                <div class="col-span-12 mt-6">
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Description</label>
                        <div id="description">
                            <Editor editorStyle="height: 320px" v-model="form.description"/>
                        </div>
                    </div>
                </div>
<!--                <button @click='toggle = !toggle' class="font-semibold bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-3 rounded-md text-sm" type="button">-->
<!--                    Show More-->
<!--                </button>-->
<!--                <div id="hide" v-show='toggle'>-->
<!--                    <div class="col-span-12 mt-6">-->
<!--                        <h3 class="text-xl font-bold mb-4">Specification</h3>-->
<!--                        <div class="mb-4">-->
<!--                            <div id="specification">-->
<!--                                <Editor editorStyle="height: 320px" v-model="form.value"/>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-span-12 mt-6">-->
<!--                        <h3 class="text-xl font-bold mb-4">Description</h3>-->
<!--                        <div class="mb-4">-->
<!--                            <div id="app">-->
<!--                                <Editor editorStyle="height: 320px" v-model="form.value"/>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
            <!--            Image Gallery-->
            <div class="bg-white shadow rounded-lg mt-6">
                <div class="p-4">
                    <h3 class="text-xl font-semibold mb-2 text-indigo-600">Image Gallery</h3>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Image:</label>
                        <input class="block border border-gray-200 rounded w-full" id="profile_picture" name="profile_picture"
                               type="file" v-on:change="onImageChange">
                        <img :src="ImgUrl" v-if="ImgUrl">
                        <div class="w-full sm:w-1/2 mb-4 sm:ml-0 p-2 " v-else-if="form.img != null">
                            <img :src="`uploads/product/img/`+form.img">
                        </div>
                    </div>
                </div>
            </div>

            <!--         Inventory   -->
<!--            <div class="bg-white shadow rounded-lg mt-6">-->
<!--                <div class="p-4">-->
<!--                    <h3 class="text-2xl font-bold text-indigo-600 mb-4">Inventory</h3>-->
<!--                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 px-5">-->
<!--                        <div>-->
<!--                            <label class="block text-sm font-medium text-gray-700">Product Sku</label>-->
<!--                            <input-->
<!--                                class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"-->
<!--                                type="text" v-model="form.product_sku">-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="block text-sm font-medium text-gray-700">Model No</label>-->
<!--                            <input-->
<!--                                class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"-->
<!--                                placeholder="Model No" type="number" v-model="form.model_no">-->
<!--                        </div>-->
<!--&lt;!&ndash;                        <div>&ndash;&gt;-->
<!--&lt;!&ndash;                            <label class="block text-sm font-medium text-gray-700">Purchase Limit</label>&ndash;&gt;-->
<!--&lt;!&ndash;                            <input&ndash;&gt;-->
<!--&lt;!&ndash;                                class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"&ndash;&gt;-->
<!--&lt;!&ndash;                                type="number" v-model="form.purchase_limit">&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--                        <div>-->
<!--                            <label class="block text-sm font-medium text-gray-700">Barcode</label>-->
<!--                            <input-->
<!--                                class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"-->
<!--                                placeholder="Barcode" type="number" v-model="form.barcode">-->
<!--                        </div>-->
<!--                        <div class="mt-6">-->
<!--                            <label class="inline-flex items-center cursor-pointer">-->
<!--                                <input-->
<!--                                    @click="toggleShow"-->
<!--                                    false-value="0"-->
<!--                                    id="manage_inventory"-->
<!--                                    name="manage_inventory"-->
<!--                                    true-value="1"-->
<!--                                    type="checkbox"-->
<!--                                    v-model="form.manage_inventory"-->
<!--                                    class="h-5 w-5 text-indigo-500 focus:ring-indigo-300 border-gray-300 rounded"-->
<!--                                />-->
<!--                                <span class="ml-2 text-sm font-medium text-gray-700">Manage Inventory</span>-->
<!--                            </label>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <div class="ml-auto"  v-show="show">-->
<!--                                <label class="block text-sm font-medium text-gray-700" for="qty">Product Quantity</label>-->
<!--                                <input-->
<!--                                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"-->
<!--                                    type="number"-->
<!--                                    v-model="form.product_qty"-->
<!--                                />-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            <!--       Add Video     -->
<!--            <div class="bg-white shadow-md rounded-lg mt-6 p-4">-->
<!--                <h3 class="text-2xl font-semibold mb-4">Add Video</h3>-->
<!--                <table class="w-full">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th class="py-2" v-if="mode !== 'edit'">-->
<!--                            <strong class="block text-gray-800">Please Add Your YouTube Video ID</strong>-->
<!--                            <span class="block text-sm text-gray-600 mb-2">Example: YouTube Video ID</span>-->
<!--                            <textarea-->
<!--                                class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded focus:outline-none focus:ring focus:border-indigo-500"-->
<!--                                name="embed_video" title="embed_video" type="text" v-model="form.url"-->
<!--                                placeholder="Enter YouTube Video ID"-->
<!--                            ></textarea>-->
<!--                        </th>-->
<!--                        <th class="py-2" v-else>-->
<!--                            <strong class="block text-gray-800">Please Add Your YouTube Video ID</strong>-->
<!--                            <span class="block text-sm text-gray-600 mb-2">Example: YouTube Video ID</span>-->
<!--                        </th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                </table>-->
<!--            </div>-->

            <!--            SEO Setting-->
<!--            <div class="bg-white shadow-md rounded-lg mt-6">-->
<!--                <div class="p-4">-->
<!--                    <h3 class="text-2xl font-semibold mb-4">SEO Settings</h3>-->
<!--                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">-->
<!--                        <div class="form-group">-->
<!--                            <label class="block text-sm font-medium text-gray-700">Meta Title:</label>-->
<!--                            <input-->
<!--                                class="w-full h-8 px-2 bg-gray-100 border border-gray-300 rounded focus:outline-none focus:ring focus:border-indigo-500"-->
<!--                                type="text"-->
<!--                                v-model="form.meta_title"-->
<!--                            />-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label class="block text-sm font-medium text-gray-700">Meta Keywords:</label>-->
<!--                            <div class="relative rounded-md shadow-sm">-->
<!--                                <input-->
<!--                                    type="text"-->
<!--                                    id="tags-basic"-->
<!--                                    v-model="form.meta"-->
<!--                                    class="block w-full h-8 px-3 py-2 bg-gray-100 border border-gray-300 rounded focus:ring focus:border-indigo-500 focus:outline-none sm:text-sm"-->
<!--                                />-->
<!--                                &lt;!&ndash; Add an icon (optional) &ndash;&gt;-->
<!--                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">-->
<!--                                    <svg-->
<!--                                        class="w-5 h-5 text-gray-400"-->
<!--                                        fill="none"-->
<!--                                        stroke="currentColor"-->
<!--                                        viewBox="0 0 24 24"-->
<!--                                        xmlns="http://www.w3.org/2000/svg"-->
<!--                                    >-->
<!--                                    </svg>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label class="block text-sm font-medium text-gray-700">Meta Image:</label>-->
<!--                            <div class="flex items-center mt-2">-->
<!--                                <input class="block border border-gray-200 rounded w-full" name="profile_picture"-->
<!--                                       type="file" v-on:change="onImageChange">-->
<!--                                <img :src="ImgUrl" v-if="ImgUrl">-->
<!--                                <div class="w-full sm:w-1/2 mb-4 sm:ml-0 p-2 " v-else-if="form.img != null">-->
<!--                                    <img :src="`uploads/basic_info/img/`+form.img">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label class="block text-sm font-medium text-gray-700">Meta Description:</label>-->
<!--                            <textarea-->
<!--                                class="w-full h-20 px-2 py-1 bg-gray-100 border border-gray-300 rounded focus:outline-none focus:ring focus:border-indigo-500"-->
<!--                                v-model="form.meta_description"-->
<!--                            ></textarea>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

            <!--            Product Type-->
            <div class="bg-white shadow rounded-lg mt-6">
                <div class="card-block">
                    <h3 class="text-2xl font-semibold mb-4 text-indigo-600">Variants</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-1 md:col-span-2">
                            <div class="bg-white shadow rounded-lg p-4">
                                <label class="block text-gray-700 font-medium mb-2">Product Type</label>
                                <typeahead :initial="form.product_type" :url="product_types" @input="onproducttypes" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            </div>
                        </div>
                        <div v-if="prod_type === 1 || ($route.meta.mode === 'edit' && form.attribute_sets != null)">
                            <div class="bg-white shadow rounded-lg p-4">
                                <typeahead :initial="form.attribute_sets" :url="attributeset" @input="onattribute" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            </div>
                        </div>
                    </div>
                    <div>


                    <!-- Rough Table -->
<!--                    <div class="card-block mt-2" v-if="$route.meta.mode === 'edit'">-->
<!--                        <table class="table" v-if="attr.length > 0">-->
<!--                            &lt;!&ndash; Table Header &ndash;&gt;-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th scope="col">Group</th>-->
<!--                                <th scope="col">Value</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                        </table>-->

<!--                        &lt;!&ndash; Table Body &ndash;&gt;-->
<!--                        <table class="table" v-if="detail.length > 0">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th scope="col">Active</th>-->
<!--                                <th scope="col">Color Size</th>-->
<!--                                <th scope="col">Price</th>-->
<!--                                <th scope="col">Discounted</th>-->
<!--                                <th scope="col">Product Qty</th>-->
<!--                                <th scope="col">Product Sku</th>-->
<!--                                <th scope="col">Model No</th>-->
<!--                                <th scope="col">Image</th>-->
<!--                                <th scope="col">Action</th>-->
<!--                                <th scope="col"></th>-->
<!--                                <th scope="col"></th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            &lt;!&ndash; Query work &ndash;&gt;-->
<!--                            <tr :key="index" v-for="(item, index) in detail">-->
<!--                                &lt;!&ndash; Table Data &ndash;&gt;-->
<!--                                <td>-->
<!--                                    <input :checked="item.status === 1" false-value="0" true-value="1" type="checkbox" v-model="item.status" />-->
<!--                                </td>-->
<!--                                <td>{{ item.value_title }}</td>-->
<!--                                <td>-->
<!--                                    <input class="form-control form-control-sm" placeholder="Model No" type="number" v-model="item.price" />-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    <input class="form-control form-control-sm" type="number" v-model="item.discounted" />-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    <input class="form-control form-control-sm" type="number" v-model="item.product_qty" />-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    <input class="form-control form-control-sm" type="text" v-model="item.sku" />-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    <input class="form-control form-control-sm" type="text" v-model="item.model_no" />-->
<!--                                </td>-->
<!--                                &lt;!&ndash; Multi image &ndash;&gt;-->
<!--                                <td>-->
<!--                                    <div class="form-group">-->
<!--                                        <input @change="onFileChange($event, item)" accept="image/jpeg" multiple style="width: 96px" type="file" />-->
<!--                                        <small class="error-control" v-if="errors.images">{{ errors.images[0] }}</small>-->
<!--                                        <div v-for="(qw, index) in item.imgs">-->
<!--                                            <i @click="DeleteRowImg(qw.id)" class="fa fa-trash" style="color: red"></i>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    <i @click="SaveRowData(item.id, item.price, item.discounted, item.product_qty, item.sku, item.model_no, item.active, item.status)" class="fa fa-save text-green-600 cursor-pointer"></i>-->
<!--                                    <i @click="DeleteRowData(item.id)" class="fa fa-trash text-red-600 cursor-pointer"></i>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->

<!--                    &lt;!&ndash; Table for mode !== 'edit' &ndash;&gt;-->
<!--                    <div class="card-block mt-2" v-if="mode !== 'edit'">-->
<!--                        <table class="table">-->
<!--                            &lt;!&ndash; Table Header &ndash;&gt;-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>Sets</th>-->
<!--                                <th>Group</th>-->
<!--                                <th>Value</th>-->
<!--                                <th>Use for Variation</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            <tr v-for="(item, index) in ghi">-->
<!--                                &lt;!&ndash; Table Data &ndash;&gt;-->
<!--                                <td>{{ form.set_title }}</td>-->
<!--                                <td>{{ item.group_title }}</td>-->
<!--                                <td>-->
<!--                                    <multiselect :multiple="true" :options="item.productattribute_value" :taggable="true" @onchange="on_variation(i)" label="text" tag-placeholder="Add this as a new tag" tag-position="bottom" track-by="id" v-model="form.test[index]" />-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    <select class="form-control fa fa-angle-down" id="types" name="product_types" v-model="form.variation[index]">-->
<!--                                        <option value="1">YES</option>-->
<!--                                        <option value="0">No</option>-->
<!--                                    </select>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
                    </div>
                </div>
            </div>
        </div>
        <!--          Second div -->
        <div class="w-4/12  mx-4">
            <div class="col-span-12">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-bold mb-4 text-indigo-600">Price & Stock</h3>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Cost Price</label>
                            <input
                                class="w-full py-1 px-2 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                type="number" v-model="form.cost_price">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Selling Price</label>
                            <input
                                class="w-full py-1 px-2 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                type="number" v-model="form.selling_price">
                        </div>
<!--                        <div>-->
<!--                            <label class="block text-sm font-medium text-gray-700">Size Chart</label>-->
<!--                            <input-->
<!--                                class="w-full py-1 px-2 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"-->
<!--                                v-model="form.discounted">-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="block text-sm font-medium text-gray-700">Cost</label>-->
<!--                            <input-->
<!--                                class="w-full py-1 px-2 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"-->
<!--                                v-model="form.cost">-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="block text-sm font-medium text-gray-700">Delivery Charges</label>-->
<!--                            <input-->
<!--                                class="w-full py-1 px-2 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"-->
<!--                                v-model="form.shipment_charges">-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="checkbox-inline ml-2">-->
<!--                                <input @click="toggleShow1" name="expired" true-value="1" type="checkbox">-->
<!--                                <span class="ml-1">Show Timer</span>-->
<!--                            </label>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="checkbox-inline ml-2">-->
<!--                                <input name="free_shipping" true-value="1" type="checkbox" v-model="form.free_shipping">-->
<!--                                <span class="ml-1 ">Free Shipping</span>-->
<!--                            </label>-->
<!--                        </div>-->
<!--                        <div class="col-span-2" v-show="show1">-->
<!--                            <label class="block font-medium text-gray-700">Start Date</label>-->
<!--                            <input-->
<!--                                class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"-->
<!--                                type="date" v-model="form.start_date">-->
<!--                        </div>-->
<!--                        <div class="col-span-2" v-show="show1">-->
<!--                            <label class="block font-medium text-gray-700">End Date</label>-->
<!--                            <input-->
<!--                                class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"-->
<!--                                type="date" v-model="form.end_date">-->
<!--                        </div>-->
                </div>
            </div>
            <!--            Product Organization-->
            <div class="w-full">
                <div class="card-block mt-4 p-4 rounded-lg shadow-lg bg-white">
                    <h3 class="mb-4 text-xl font-semibold text-indigo-600">Product Organization</h3>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <multiselect
                            :multiple="true"
                            :options="options"
                            :taggable="true"
                            @tag="addTag"
                            class="mt-1 form-input block w-full"
                            label="text"
                            multiple
                            name="Title"
                            tag-placeholder="Add this as new tag"
                            tag-position="bottom"
                            taggable
                            track-by="id"
                            v-model="form.categoryies"
                        ></multiselect>
                    </div>

<!--                    <div class="mb-4">-->
<!--                        <label class="block text-sm font-medium text-gray-700">Product Behave</label>-->
<!--                        <typeahead :initialize="form.category" :url="categorys" @input="onCategory"-->
<!--                                   display="customer_category"/>-->
<!--                    </div>-->
<!--                    <div class="mb-4">-->
<!--                        <label class="block text-sm font-medium text-gray-700">Product Behave</label>-->
<!--                        <div class="relative">-->
<!--                            <typeahead-->
<!--                                :initialize="form.behave"-->
<!--                                :url="categorys"-->
<!--                                @input="onCategory"-->
<!--                                class="w-full py-1 px-1 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"-->
<!--                                display="customer_category"-->
<!--                            />-->
<!--                        </div>-->
<!--                    </div>-->

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Product Brand</label>
                        <div class="relative">
                            <typeahead
                                :initialize="form.brand"
                                :url="categorys"
                                @input="onCategory"
                                class="w-full py-1 px-1 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                display="customer_category"
                            />
                        </div>
                    </div>
                </div>
            </div>


            <div class="w-full">
                <div class="card-block mt-4 p-4 rounded-lg shadow-lg bg-white">
                    <h3 class="text-2xl font-bold text-indigo-600 mb-4">Inventory</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4 px-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Product Sku</label>
                            <input
                                class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                type="text" v-model="form.product_sku">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Model No</label>
                            <input
                                class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                placeholder="Model No" type="number" v-model="form.model_no">
                        </div>
                        <!--                        <div>-->
                        <!--                            <label class="block text-sm font-medium text-gray-700">Purchase Limit</label>-->
                        <!--                            <input-->
                        <!--                                class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"-->
                        <!--                                type="number" v-model="form.purchase_limit">-->
                        <!--                        </div>-->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Barcode</label>
                            <input
                                class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                placeholder="Barcode" type="number" v-model="form.barcode">
                        </div>
                        <div class="mt-6">
                            <label class="inline-flex items-center cursor-pointer">
                                <input
                                    @click="toggleShow"
                                    false-value="0"
                                    id="manage_inventory"
                                    name="manage_inventory"
                                    true-value="1"
                                    type="checkbox"
                                    v-model="form.manage_inventory"
                                    class="h-5 w-5 text-indigo-500 focus:ring-indigo-300 border-gray-300 rounded"
                                />
                                <span class="ml-2 text-sm font-medium text-gray-700">Manage Inventory</span>
                            </label>
                        </div>
                        <div>
                            <div class="ml-auto"  v-show="show">
                                <label class="block text-sm font-medium text-gray-700" for="qty">Product Quantity</label>
                                <input
                                    class="w-full py-1 px-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    type="number"
                                    v-model="form.product_qty"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--             Service & Delivery-->
<!--            <div class="w-full">-->
<!--                <div class="card-block mt-4 p-4 rounded-lg shadow-lg bg-white">-->
<!--                    <h3 class="mb-4 text-xl font-semibold text-indigo-600">Service & Delivery</h3>-->
<!--&lt;!&ndash;                    <div class="mb-4">&ndash;&gt;-->
<!--&lt;!&ndash;                        <label class="block text-sm font-medium text-gray-700">Warranty</label>&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="relative">&ndash;&gt;-->
<!--&lt;!&ndash;                            <typeahead&ndash;&gt;-->
<!--&lt;!&ndash;                                :initialize="form.warranty"&ndash;&gt;-->
<!--&lt;!&ndash;                                :url="categorys"&ndash;&gt;-->
<!--&lt;!&ndash;                                @input="onCategory"&ndash;&gt;-->
<!--&lt;!&ndash;                                class="w-full py-1 px-1 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"&ndash;&gt;-->
<!--&lt;!&ndash;                                display="customer_category"&ndash;&gt;-->
<!--&lt;!&ndash;                            />&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    <div class="mb-4">&ndash;&gt;-->
<!--&lt;!&ndash;                        <label class="block text-sm font-medium text-gray-700">Delivery Time</label>&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="relative">&ndash;&gt;-->
<!--&lt;!&ndash;                            <typeahead&ndash;&gt;-->
<!--&lt;!&ndash;                                :initialize="form.delivery_time"&ndash;&gt;-->
<!--&lt;!&ndash;                                :url="categorys"&ndash;&gt;-->
<!--&lt;!&ndash;                                @input="onCategory"&ndash;&gt;-->
<!--&lt;!&ndash;                                class="w-full py-1 px-1 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"&ndash;&gt;-->
<!--&lt;!&ndash;                                display="customer_category"&ndash;&gt;-->
<!--&lt;!&ndash;                            />&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    <div class="mb-4">&ndash;&gt;-->
<!--&lt;!&ndash;                        <label class="block text-sm font-medium text-gray-700">Return Note</label>&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="relative">&ndash;&gt;-->
<!--&lt;!&ndash;                            <typeahead&ndash;&gt;-->
<!--&lt;!&ndash;                                :initialize="form.return_note"&ndash;&gt;-->
<!--&lt;!&ndash;                                :url="categorys"&ndash;&gt;-->
<!--&lt;!&ndash;                                @input="onCategory"&ndash;&gt;-->
<!--&lt;!&ndash;                                class="w-full py-1 px-1 text-sm bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"&ndash;&gt;-->
<!--&lt;!&ndash;                                display="customer_category"&ndash;&gt;-->
<!--&lt;!&ndash;                            />&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    <div class="mb-4">&ndash;&gt;-->
<!--&lt;!&ndash;                        <label class="block text-sm font-medium text-gray-700">Merchant(s)</label>&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="relative">&ndash;&gt;-->
<!--&lt;!&ndash;                            <select&ndash;&gt;-->
<!--&lt;!&ndash;                                class="form-select mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-300 focus:outline-none text-gray-700"&ndash;&gt;-->
<!--&lt;!&ndash;                            >&ndash;&gt;-->
<!--&lt;!&ndash;                                <option value="select">&#45;&#45;select&#45;&#45;</option>&ndash;&gt;-->
<!--&lt;!&ndash;                                <option value="mimsoft">mimsoft</option>&ndash;&gt;-->
<!--&lt;!&ndash;                                <option value="mimsoft">bawasoft</option>&ndash;&gt;-->
<!--&lt;!&ndash;                            </select>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--                    <div class="col-span-2 mb-4">-->
<!--                        <label class="block text-sm font-medium text-gray-700">Seller Note</label>-->
<!--                        <input-->
<!--                            class="w-full border rounded-md px-2 py-1 text-sm focus:outline-none focus:ring focus:border-blue-300"-->
<!--                            name="seller"-->
<!--                            placeholder="Seller Note"-->
<!--                            type="text"-->
<!--                            v-model="form.seller_note"-->
<!--                        />-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

            <!--            Link Product-->
            <div class="col-12">
<!--                <div class="bg-white border rounded-lg shadow-lg p-4 mt-4">-->
<!--                    <h3 class="text-xl font-semibold mb-2 text-indigo-600">Link Products</h3>-->
<!--                    <div>-->
<!--                        <label class="block font-medium mb-1 text-sm">Order Bump</label>-->
<!--                        <input-->
<!--                            :placeholder="bump_sale"-->
<!--                            :value="form.order_bump"-->
<!--                            @input="onbumpsell"-->
<!--                            class="w-full border rounded-md px-2 py-1 text-sm focus:outline-none focus:ring focus:border-blue-300"-->
<!--                            type="text"-->
<!--                        />-->
<!--                    </div>-->
<!--                    <div class="mt-4">-->
<!--                        <label class="block font-medium mb-1 text-sm">Up Selling</label>-->
<!--                        <input-->
<!--                            :placeholder="upselling"-->
<!--                            :value="form.up_selling"-->
<!--                            @input="onupselling"-->
<!--                            class="w-full border rounded-md px-2 py-1 text-sm focus:outline-none focus:ring focus:border-blue-300"-->
<!--                            type="text"-->
<!--                        />-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>
    </div>
    <div class="flex justify-end mt-8 space-x-4">
        <button
            @click="formSubmitted"
            class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
            type="button">
            {{ $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Submit" }}
        </button>
        <button
            @click="successfull()"
            class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white"
            type="button">
            Cancel
        </button>
    </div>
</template>


<script>
    import {byMethod, get} from '@/libs/api'
    import {form} from '@/libs/mixins'
    import Typeahead from "@/Components/typeahead/typeahead.vue";
    import Editor from 'primevue/editor';

    function initialize(to) {
        let urls = {
            add: `/api/product/create`,
            edit: `/api/product/${to.params.id}/edit`,
        }
        return urls[to.meta.mode] || urls.add
    }

    export default {
        mixins: [form],
        components: {
            Typeahead, Editor,
        },
        data() {
            return {
                ImgUrl: null,
                error: {},
                show: false,
                resource: '/product',
                store: '/api/product',
                method: 'POST',
                small: 'product',
                capital: 'Product',
                title: 'Add',
                message: 'New product Added',
                permissions: {},
                toggle: false,
                show1: false,

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
        methods: {
            onImageChange(e) {
                // console.log('test')
                // console.log(e.target.files);
                this.ImgUrl = URL.createObjectURL(e.target.files[0]);
                this.form.img = e.target.files;
            },
            toggleShow() {
                this.show = !this.show;
            },
            toggleShow1() {
                this.show1 = !this.show1;
            },
            setData(res) {
                // console.log(res);
                this.form = res.data.form;
                if (this.$route.meta.mode === 'edit') {
                    this.store = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
                    this.title = 'Edit';
                    this.message = `${this.capital} has been updated`;
                }
                this.show = true
            },

            formSubmitted() {
                this.form.selectedPermissions = this.selectedPermissions
                byMethod(this.method, this.store, this.form).then(res => {
                    this.successfull(res)
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                        type: 'success',
                        duration: 3000
                    });
                }).catch(err => {
                    this.error = err.response.data.errors;
                    this.$toast.open({
                        position: 'top-right',
                        message: 'Error',
                        type: 'error',
                        duration: 3000
                    });
                    // console.log(err);
                })
            },
            successfull(res) {
                this.$router.push({path: `${this.resource}`})
            }
        },
    }
</script>

<style scoped>

</style>
