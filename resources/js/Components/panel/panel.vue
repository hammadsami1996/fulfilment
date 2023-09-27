<!--<template>-->
<!--    &lt;!&ndash;    <div class="grid-cols-12">&ndash;&gt;-->
<!--    <div v-if="show && model.data.length > 0">-->
<!--        <div class="flex justify-end" v-if="searchEnable">-->
<!--            <div class="flex items-right">-->
<!--                <label class="mr-2 mx-1">Search</label>-->
<!--                <input-->
<!--                    @keyup="search(searchTerm)"-->
<!--                    class="rounded-md"-->
<!--                    placeholder="Search"-->
<!--                    type="text"-->
<!--                    v-model="searchTerm"-->
<!--                />-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="py-3">-->
<!--            &lt;!&ndash; Responsive Table Container &ndash;&gt;-->
<!--            <div class="border border-gray-200 rounded overflow-x-auto min-w-full bg-white">-->
<!--                &lt;!&ndash; Alternate Responsive Table &ndash;&gt;-->
<!--                <table class="min-w-full text-sm align-middle">-->
<!--                    &lt;!&ndash; Table Header &ndash;&gt;-->
<!--                    <thead>-->
<!--                    <tr class="bg-gray-50">-->
<!--                        <th :key="index"-->
<!--                            class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left"-->
<!--                            v-for="(column, index) in columns">-->
<!--                            {{column.label ? column.label : ''}}-->
<!--                        </th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    &lt;!&ndash; END Table Header &ndash;&gt;-->

<!--                    &lt;!&ndash; Table Body &ndash;&gt;-->
<!--                    <tbody>-->
<!--                    <tr :class="rowIndex % 2 ? 'bg-gray-50': ''" :key="rowIndex" @click="onRowClick(row)"-->
<!--                        v-for="(row, rowIndex) in model.data">-->
<!--                        <td :key="columnIndex" class="p-3" v-for="(column, columnIndex) in columns">-->
<!--                            <template v-if="column.action">-->
<!--                                <slot :item="row" name="action"></slot>-->
<!--                            </template>-->
<!--                            <template v-if="column.extra">-->
<!--                                <slot :item="row" name="extra"></slot>-->
<!--                            </template>-->
<!--                            <template v-if="column.slot">-->
<!--                                <slot :item="row" :name="column.field"></slot>-->
<!--                            </template>-->
<!--                            <template v-if="column.image">-->
<!--                                <img alt="User Avatar"-->
<!--                                     class="inline-block w-10 h-10 rounded-full"-->
<!--                                     src="https://cdn.tailkit.com/media/placeholders/avatar-mEZ3PoFGs_k-160x160.jpg">-->
<!--                            </template>-->
<!--                            <template v-else-if="column.displayText">-->
<!--                                <template v-if="column.multiple">-->
<!--                                    <template v-if="row[column.displayText].length > 0">-->
<!--                                        <a :href="item[column.field]"-->
<!--                                           :key="index" rel="Image"-->
<!--                                           style="display: flex;flex-direction:column;" target="_blank"-->
<!--                                           type="media_type"-->
<!--                                           v-for="(item,index) in row[column.displayText]"-->
<!--                                           v-if="column.link">{{index+1}} .Scan Doc</a>-->
<!--                                        <span :key="displayTextIndex"-->
<!--                                              class="inline-block mr-1 px-2.5 py-0.5 rounded-full text-sm font-medium bg-primary text-white"-->
<!--                                              v-else v-for="(item,displayTextIndex) in row[column.displayText]">-->
<!--                                                     {{ item[column.field] }}-->
<!--                                            </span>-->
<!--                                    </template>-->
<!--                                    <template v-else>-->
<!--                                        {{column.placeholder ? column.placeholder : 'No '+column.displayText }}-->
<!--                                    </template>-->
<!--                                </template>-->
<!--                                <template v-else>-->
<!--                                <span>-->
<!--                                    {{ row[column.displayText] ? row[column.displayText][column.field] : '-'}}-->
<!--                                </span>-->
<!--                                </template>-->
<!--                            </template>-->
<!--                            <template v-else-if="column.format">-->
<!--                            <span v-if="column.format == 'index'">-->
<!--                                {{ rowIndex + (model.from ? model.from : 1 )}}-->
<!--                            </span>-->
<!--                                <span v-if="column.format == 'formatDate'">-->
<!--                                {{ row[column.field] | formatDate }}-->
<!--                            </span>-->
<!--                                <span v-if="column.format == 'formatDateTime'">-->
<!--                                {{ row[column.field] | formatDateTime }}-->
<!--                            </span>-->
<!--                                <div style="text-align: end" v-if="column.format == 'formatMoney'">-->
<!--                                    {{ row[column.field] | formatMoney }}-->
<!--                                </div>-->
<!--                                <div style="text-align: end" v-if="column.format == 'formatMoneyNOD'">-->
<!--                                    {{ row[column.field] | formatMoneyNOD }}-->
<!--                                </div>-->
<!--                            </template>-->
<!--                            <template v-else-if="column.index">-->
<!--                                <span>{{column.originalIndex}}</span>-->
<!--                            </template>-->
<!--                            <template v-else>-->
<!--                            <span>-->
<!--                                {{ row[column.field] ? row[column.field] : ' '}}-->
<!--                            </span>-->
<!--                            </template>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    </tbody>-->
<!--                    &lt;!&ndash; END Table Body &ndash;&gt;-->

<!--                    &lt;!&ndash; Start Table Footer &ndash;&gt;-->
<!--                    <tfoot v-if="pagination">-->
<!--                    <tr class="p-2" v-if="pageLength">-->
<!--                        &lt;!&ndash;                            <div class="flex justify-between flex-wrap">&ndash;&gt;-->
<!--                        <td class="flex items-center mb-0 mt-1">-->
<!--                            <span class="text-nowrap">Show Records</span>-->
<!--                            <select-->
<!--                                @change="page(1)"-->
<!--                                @input="(value) => perPageUpdate(value)"-->
<!--                                class="mx-1"-->
<!--                                v-model="pageLength"-->
<!--                            >-->
<!--                                <option value="10">10</option>-->
<!--                                <option value="25">25</option>-->
<!--                                <option value="50">50</option>-->
<!--                            </select>-->
<!--                            <span class="text-nowrap">-->
<!--                                            From {{ model.from }} To {{ model.to }} of {{ model.total }} entries-->
<!--                                         </span>-->
<!--                        </td>-->
<!--                        <td class="items-end mb-0 mt-1" colspan="2">-->
<!--                            &lt;!&ndash; Card Footer: Pagination &ndash;&gt;-->
<!--                            <div class="py-4 px-5 lg:px-6 w-full border-t border-gray-200">-->
<!--                                &lt;!&ndash; Visible in desktop &ndash;&gt;-->
<!--                                <div class="hidden" style="display: flex;justify-content: end">-->
<!--                                    <div class="pt-1">Page <span class="font-semibold">{{model.current_page}}</span>-->
<!--                                        of-->
<!--                                        <span class="font-semibold">{{model.last_page}}</span></div>-->
<!--                                    <nav class="inline-flex pl-3">-->
<!--                                        <button-->
<!--                                            :disable="model.prev_page_url == null"-->
<!--                                            @click="prevPage"-->
<!--                                            class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded-l active:z-1 focus:z-1 -mr-px border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">-->
<!--                                            <svg class="hi-solid hi-chevron-left inline-block w-5 h-5"-->
<!--                                                 fill="currentColor" viewBox="0 0 20 20"-->
<!--                                                 xmlns="http://www.w3.org/2000/svg">-->
<!--                                                <path clip-rule="evenodd"-->
<!--                                                      d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"-->
<!--                                                      fill-rule="evenodd"/>-->
<!--                                            </svg>-->
<!--                                        </button>-->
<!--                                        <input @input="(value)=>page(value.data)" style="width: 20%" type="number">-->
<!--                                        <button-->
<!--                                            :disable="model.next_page_url == null"-->
<!--                                            @click="nextPage"-->
<!--                                            class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded-r active:z-1 focus:z-1 border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">-->
<!--                                            <svg class="hi-solid hi-chevron-right inline-block w-5 h-5"-->
<!--                                                 fill="currentColor" viewBox="0 0 20 20"-->
<!--                                                 xmlns="http://www.w3.org/2000/svg">-->
<!--                                                <path clip-rule="evenodd"-->
<!--                                                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"-->
<!--                                                      fill-rule="evenodd"/>-->
<!--                                            </svg>-->
<!--                                        </button>-->
<!--                                    </nav>-->
<!--                                </div>-->
<!--                                &lt;!&ndash; END Visible in desktop &ndash;&gt;-->
<!--                            </div>-->
<!--                            &lt;!&ndash; END Card Footer: Pagination &ndash;&gt;-->
<!--                        </td>-->
<!--                        &lt;!&ndash;                            </div>&ndash;&gt;-->
<!--                    </tr>-->
<!--                    </tfoot>-->
<!--                    &lt;!&ndash; END Table Footer &ndash;&gt;-->
<!--                </table>-->
<!--                &lt;!&ndash; END Alternate Responsive Table &ndash;&gt;-->
<!--            </div>-->
<!--            &lt;!&ndash; END Responsive Table Container &ndash;&gt;-->
<!--        </div>-->
<!--    </div>-->
<!--    <div v-else>-->
<!--        No Record Found-->
<!--    </div>-->
<!--    &lt;!&ndash;    </div>&ndash;&gt;-->
<!--</template>-->

<template>
    <div>
        <div v-if="show">
            <div class="flex justify-end" v-if="searchEnable">
                <div class="flex items-center px-4 py-2">
                    <label class="text-gray-600 mr-2">Search:</label>
                    <div class="relative">
                        <input
                            @keyup="search(searchTerm)"
                            class="rounded-md py-1 pl-4 pr-8 w-64 border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Search"
                            type="text"
                            v-model="searchTerm"
                        />
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <svg class="text-gray-400 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 15l4 4m0 0l-4-4m4 4H4" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4">
                <!-- Responsive Table Container -->
                <div class="overflow-x-auto scrollbar-color">
                    <table class="min-w-full">
                        <!-- Table Header -->
                        <thead class="bg-gray-200">
                            <tr>
                                <th
                                    :key="index"
                                    class="px-3 py-2 text-xs uppercase text-left"
                                    v-for="(column, index) in columns"
                                >
                                    {{ column.label ? column.label : '' }}
                                </th>
                            </tr>
                        </thead>
                        <!-- END Table Header -->

                        <!-- Table Body -->
                        <tbody class="bg-white">
                            <tr
                                :class="rowIndex % 2 ? 'bg-gray-100' : ''"
                                :key="rowIndex"
                                @click="onRowClick(row)"
                                v-for="(row, rowIndex) in model.data" v-if="model.data.length > 0"
                            >
                                <td
                                    :key="columnIndex"
                                    class="px-3 py-2 text-sm"
                                    v-for="(column, columnIndex) in columns"
                                >
                                    <template v-if="column.action">
                                        <slot :item="row" name="action"></slot>
                                    </template>
                                    <template v-else-if="column.slot">
                                        <slot :item="row" :name="column.field"></slot>
                                    </template>
                                    <template v-else-if="column.image">
                                        <img
                                            :src="row[column.field] ? (column.path ? column.path + row[column.field] : row[column.field]) : 'https://cdn.tailkit.com/media/placeholders/avatar-mEZ3PoFGs_k-160x160.jpg'"
                                            alt="User Avarta"
                                            class="inline-block w-10 h-10 rounded-full"
                                        />
                                    </template>
                                    <template v-if="column.displayText">
                                        <template v-if="column.multiple">
                                            <template v-if="row[column.displayText].length > 0">
                                                <a
                                                    :href="item[column.field]"
                                                    :key="index"
                                                    :style="index === 0 ? 'display: flex; flex-direction: column;' : ''"
                                                    class="text-primary"
                                                    rel="Image"
                                                    target="_blank"
                                                    v-for="(item, index) in row[column.displayText]"
                                                    v-if="column.link"
                                                >
                                                    {{ index + 1 }}. Scan Doc
                                                </a>
                                                <span
                                                    :key="displayTextIndex"
                                                    class="inline-block mr-1 px-2.5 py-0.5 rounded-full text-sm font-medium bg-primary text-white"
                                                    v-else
                                                    v-for="(item, displayTextIndex) in row[column.displayText]"
                                                >
                                                    {{ item[column.field] }}
                                                </span>
                                            </template>
                                            <template v-else>
                                                {{ column.placeholder ? column.placeholder : 'No ' + column.displayText }}
                                            </template>
                                        </template>
                                        <template v-else>
                                            {{ row[column.displayText] ? row[column.displayText][column.field] : '-'}}
                                        </template>
                                    </template>

                                    <template v-else-if="column.format">
                                        <span v-if="column.format === 'index'">
                                        {{ rowIndex + (model.from ? model.from : 1) }}
                                        </span>
                                        <span v-else-if="column.format === 'formatDate'">
                                            {{ row[column.field] | formatDate }}
                                        </span>
                                        <span v-else-if="column.format === 'formatDateTime'">
                                            {{ row[column.field] | formatDateTime }}
                                        </span>
                                        <div style="text-align: end" v-else-if="column.format === 'formatMoney'">
                                            {{ row[column.field] | formatMoney }}
                                        </div>
                                        <div style="text-align: end" v-else-if="column.format === 'formatMoneyNOD'">
                                            {{ row[column.field] | formatMoneyNOD }}
                                        </div>
                                    </template>
                                    <template v-else-if="column.index">
                                        <span>{{ column.originalIndex }}</span>
                                    </template>
                                    <template v-else>
                                        <span>{{ row[column.field] ? row[column.field] : ' ' }}</span>
                                    </template>
                                </td>
                            </tr>
                            <tr v-else>
                                <td :colspan="columns.length"
                                    class="flex items-center justify-center px-3 py-2 whitespace-nowrap text-gray-500">
                                    No Record Found
                                </td>
                            </tr>
                        </tbody>
                        <!-- END Table Body -->

                        <!-- Start Table Footer -->
                        
                        <!-- END Table Footer -->
                    </table>
                </div>
                    <div v-if="pagination">
                            <div class="bg-gray-200 grid grid-cols-2 gap-4 lg:gap-8">
                                <div class="px-3 py-2 text-xs font-medium text-gray-700 uppercase">
                                    Show Records
                                    <select @change="page(1)" @input="(value) => perPageUpdate(value)"
                                            class="text-center border border-gray-300 rounded pt-0.5 pb-0.5" v-model="pageLength">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                    </select>
                                    From {{ model.from }} To {{ model.to }} of {{ model.total }} entries -
                                    Page {{ model.current_page }} of {{ model.last_page }}
                                </div>
                                <div>
                                    <div class="flex items-center justify-end space-x-2 pt-2 pr-2">
                                        <button :disabled="model.prev_page_url == null" @click="prevPage"
                                                class="inline-flex justify-center items-center w-8 h-8 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-full hover:bg-gray-100">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"></path>
                                            </svg>
                                        </button>
                                        <input @input="(value) => page(value.data)"
                                            class="text-sm text-center border border-gray-300 rounded pt-0.5 pb-0.5"
                                            style="width: 60px" type="number"/>
                                        <button :disabled="model.next_page_url == null" @click="nextPage"
                                                class="inline-flex justify-center items-center w-8 h-8 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-full hover:bg-gray-100">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- END Alternate Responsive Table -->
                <!-- END Responsive Table Container -->
            </div>

        </div>
        <div class="flex items-center justify-center h-32 text-gray-500" v-else>
            No Record Found
        </div>
    </div>
</template>

<script>
    import {byMethod, get} from "@/libs/api"

    export default {
        name: "Panel",
        components: {},
        props: {
            urlApi: {
                type: String,
                required: true
            },
            columns: {
                type: Array,
                required: true,
            },
            initialGet: {
                type: Boolean,
                default: true
            },
            resource: {
                type: String
            },
            pagination: {
                type: Boolean,
                default: true
            },
            searchEnable: {
                type: Boolean,
                default: true
            }

        },
        data() {
            return {
                show: false,
                pageLength: 5,
                searchTerm: '',
                dir: false,
                model: {}
            }
        },
        created() {
            if (this.initialGet) {
                this.reload()
            }
        },
        methods: {
            reload() {
                if (this.pagination) {
                    get(this.urlApi).then(res => {
                        this.model = res.data.data;
                        this.pageLength = res.data.data.per_page
                        this.show = true
                    });
                } else {
                    get(this.urlApi).then(res => {
                        this.model = res.data
                        this.show = true
                    });
                }
            },
            onRowClick(params) {
                this.$emit('rowClick', params.row);
            },
            search(query) {
                let url = "";
                if (this.urlApi.includes('?')) {
                    url = `${this.urlApi}&q=${query}`;
                } else {
                    url = `${this.urlApi}?q=${query}`;
                }
                byMethod('GET', url).then(res => {
                    this.model = res.data.data;
                    this.pageLength = res.data.data.per_page
                });
            },
            makeQuery() {
                const query = Object.keys(this.search || {})
                    .map((field, index) => {
                        let _field = field;
                        let _m = this.columns.find(col => col.field == field)?.displayText;
                        if (_m) {
                            field = `${_m}.${field}`;
                        }
                        if (this.search[_field]?.length) {
                            return `filters[${index}][column]=${field}&filters[${index}][operator]=like&filters[${index}][query_1]=${this.search[_field]}`;
                        }
                    })
                    .join("&");
                return query;
            },
            makePageQuery(url, page, query) {
                let search = new URLSearchParams(new URL(url).search);
                if (search.has("page")) {
                    search.set("page", page);
                }
                let _url = String(url).split("?");
                if (_url.length) {
                    return `${_url[0]}?${search.toString()}&${query}`;
                }
                return `${search.toString()}&${query}`;
            },
            page(e) {
                const query = this.makeQuery();
                let url = "";
                if (this.urlApi.includes('?')) {
                    url = `${this.urlApi}&page=${e}&per_page=${this.pageLength}&${query}`;
                } else {
                    url = `${this.urlApi}?page=${e}&per_page=${this.pageLength}&${query}`;
                }
                if (this.pageWithQueryString) {
                    url = this.makePageQuery(this.model?.first_page_url, e, query);
                }
                byMethod('GET', url).then(res => {
                    this.model = res.data.data;
                    this.pageLength = res.data.data.per_page
                });
            },
            nextPage() {
                if (this.model.next_page_url != null) {
                    get(this.model.next_page_url + `&per_page=${this.pageLength}`).then((res) => {
                        this.model = res.data.data;
                        this.pageLength = res.data.data.per_page
                    })
                }
            },
            prevPage() {
                if (this.model.prev_page_url != null) {
                    get(this.model.prev_page_url + `&per_page=${this.pageLength}`).then((res) => {
                        this.model = res.data.data;
                        this.pageLength = res.data.data.per_page
                    })
                }
            },
            perPageUpdate() {
                get(`${this.urlApi}?per_page=${this.pageLength}`).then(res => {
                    this.model = res.data.data;
                    this.pageLength = res.data.data.per_page
                });
            }
        },
    }
</script>
<style>
.scrollbar-color{
    cursor: pointer;
}
.scrollbar-color::-webkit-scrollbar {
  height: 9px;
  width: 9px;
}

.scrollbar-color::-webkit-scrollbar-track {
    background: rgb(230, 224, 224);
}

.scrollbar-color::-webkit-scrollbar-thumb {
    background: #60A5FA;
}
/* .nowrap{
    white-space: nowrap;
} */
</style>
