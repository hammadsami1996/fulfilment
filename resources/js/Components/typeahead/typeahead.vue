<!--<template>-->
<!--    <div :class="[isOpen ? 'typeahead typeahead-open' : 'typeahead']" style="border: 1px solid #80808029;-->
<!--    padding: 17px;-->
<!--    border-radius: 5px;">-->
<!--        <div :style="'font-size:'+size+'px'" class="typeahead-inner">-->
<!--            <div :class="clearable ? 'row px-1':''">-->
<!--                <div :class="`${formSize} typeahead-selected`"-->
<!--                     :style="'overflow-x: clip; font-size:'+size+'px'"-->
<!--                     :tabindex="tabindex"-->
<!--                     @click="onToggle"-->
<!--                     @keydown="onKey"-->
<!--                     ref="toggle">-->
<!--                    <span>{{selectedText}}</span>-->
<!--                </div>-->
<!--                <div @click="removeValue()" style="cursor: pointer;-->
<!--    font-weight: bold;-->
<!--    color: rgb(231, 86, 80);-->
<!--    position: absolute;-->
<!--    right: 8px;-->
<!--    margin-top: 8px;-->
<!--    background: #fff;-->
<!--" v-if="clearable">X-->
<!--                </div>-->
<!--            </div>-->
<!--            <transition mode="out-in" name="fade">-->
<!--                <div class="typeahead-dropdown" v-if="isOpen">-->
<!--                    <div class="typeahead-input_wrap">-->
<!--                        <input @blur="onBlur" @input="onSearch" @keydown.down="onDownKey" @keydown.enter="onEnterKey"-->
<!--                               @keydown.esc="onEsc" @keydown.up="onUpKey"-->
<!--                               autocomplete="off"-->
<!--                               class="typeahead-input"-->
<!--                               placeholder="Search..."-->
<!--                               ref="search"-->
<!--                               type="text">-->
<!--                    </div>-->
<!--                    <ul class="typeahead-list" v-if="results.length">-->
<!--                        <li :key="result.id" class="typeahead-item" v-for="(result, index) in results">-->
<!--                            <a :class="['typeahead-link', selectIndex === index ? 'typeahead-active':'']"-->
<!--                               @mousedown.prevent="select(result)"-->
<!--                               @mouseover.prevent="onMouse(index)">-->
<!--                                {{result[display]}}-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    </ul>-->

<!--                </div>-->
<!--            </transition>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->
<template>
    <div :class="[isOpen ? 'typeahead typeahead-open' : 'typeahead']" class="border border-gray-200 rounded ">
        <div :style="'font-size:'+size+'px'" class="typeahead-inner">
            <div :class="clearable ? 'row px-1' : ''">
                <div :class="`${formSize} typeahead-selected overflow-x-clip font-semibold cursor-pointer py-2 px-4`"
                     style="flex-wrap: wrap;"
                     :style="'font-size:'+size+'px'"
                     :tabindex="tabindex"
                     @click="onToggle"
                     @keydown="onKey"
                     ref="toggle">
                    <div :key="selectedOption.id" class="selected-option-tag bg-gray-200 rounded-full px-2 py-1 m-1"
                         v-for="selectedOption in selectedOptions" v-if="multiSelect && selectedOptions.length">
                        {{ selectedOption[display] }}
                        <span @click="removeSelectedOption(selectedOption)"
                              class="cursor-pointer ml-1 text-red-500 font-bold">×</span>
                    </div>
                    <span v-else>{{selectedText}}</span>
                </div>
                <div @click="removeValue()"
                     class="cursor-pointer font-bold text-red-500 absolute right-8 top-2 bg-white" v-if="clearable">X
                </div>
            </div>
            <transition mode="out-in" name="fade">
                <div class="typeahead-dropdown z-10 relative" v-if="isOpen">
                    <div class="typeahead-input_wrap">
                        <input @blur="onBlur" @input="onSearch" @keydown.down="onDownKey" @keydown.enter="onEnterKey"
                               @keydown.esc="onEsc" @keydown.up="onUpKey"
                               autocomplete="off"
                               class="typeahead-input bg-gray-100 border border-gray-300 rounded px-2 py-1"
                               placeholder="Search..."
                               ref="search"
                               type="text">
                    </div>
                    <ul class="typeahead-list" v-if="results.length">
                        <li :key="result.id" class="typeahead-item" v-for="(result, index) in results">
                            <a :class="['typeahead-link', selectIndex === index ? 'typeahead-active' : '']"
                               @mousedown.prevent="select(result)"
                               @mouseover.prevent="onMouse(index)">
                                {{result[display]}}
                            </a>
                        </li>
                    </ul>
                </div>
            </transition>
        </div>
    </div>
</template>
<script>
    import './typeahead.scss'
    import {byMethod} from '@/libs/api'

    export default {
        name: 'typeahead',
        props: {
            multiSelect: {
                default: false,
                required: false
            },
            indexBD: {
                Type: String,
                required: false
            },
            initialize: {
                default: false,
                required: false
            },
            formSize: {
                default: 'form-control'
            },
            url: {
                required: true
            },
            tabindex: {
                default: 0
            },
            display: {
                Type: String,
                required: true
            },
            clearable: {
                Type: Boolean,
                default: false
            },
            placehold: {
                Type: String,
                default: "Type or click to select"
            },
            size: {},
        },
        data() {
            return {
                selectIndex: -1,
                isOpen: false,
                search: '',
                results: [],
                selectedOptions: []
            }
        },
        computed: {
            selectedText() {
                if (this.multiSelect) {
                    this.selectedOptions = Array.isArray(this.initialize) ? this.initialize : [];
                } else {
                    return this.initialize && this.initialize[this.display]
                        ? this.initialize[this.display]
                        : this.placehold
                }
            }
        },
        methods: {
            onToggle() {
                if (this.isOpen) {
                    this.isOpen = false
                } else {
                    this.open()
                }
            }
            ,
            onKey(e) {
                const KeyCode = e.KeyCode || e.which
                if (!e.shiftKey && KeyCode !== 9 && !this.isOpen) {
                    this.open()
                }
            }
            ,
            open() {
                this.fetchData('')
                this.isOpen = true
                this.$nextTick(() => {
                    this.$refs.search.focus()
                })
            },
            filteredResults(q) {
                var resData = [];
                var resData1 = [];
                var queryStr = this.url.split("?")[1].split("&")
                window.api.data[this.indexBD].then(res => {
                    for (var i = 0; i < queryStr.length; i++) {
                        if (queryStr[i].split('=')[0] !== 'per_page' && i == 0) {
                            console.log('1');
                            for (var j = 0; j < res.length; j++) {
                                if (res[j][this.display].toLowerCase().includes(q.toLowerCase()) && res[j][queryStr[i].split('=')[0]] == queryStr[i].split('=')[1]) {
                                    resData.push(res[j])
                                }
                            }
                        } else if (queryStr[i].split('=')[0] !== 'per_page' && i > 0) {
                            console.log('2');
                            for (var j = 0; j < resData.length; j++) {
                                if (resData[j][queryStr[i].split('=')[0]] == queryStr[i].split('=')[1]) {
                                    resData1.push(resData[j])
                                }
                            }
                            resData = resData1
                        } else if (queryStr[i].split('=')[0] == 'per_page' && i == 0) {
                            console.log('3');
                            for (var i = 0; i < res.length; i++) {
                                if (res[i][this.display].toLowerCase().includes(q.toLowerCase())) {
                                    resData.push(res[i])
                                }
                            }
                        }
                    }
                    this.results = resData
                    return resData
                })
            },
            fetchData(q) {
                if (this.indexBD) {
                    if (this.url.includes("?")) {
                        this.filteredResults(q)
                    } else {
                        window.api.data[this.indexBD].then(res => {
                            var resData = []
                            for (var i = 0; i < res.length; i++) {
                                if (res[i][this.display].toLowerCase().includes(q.toLowerCase())) {
                                    resData.push(res[i])
                                }
                            }
                            this.results = resData
                        })
                    }
                } else {
                    byMethod('GET', this.url, {}, {q: q})
                        .then((res) => {
                            this.results = res.data.data?.data
                        })
                }
            }
            ,
            onBlur() {
                this.close()
            }
            ,
            onEsc() {
                this.close()
            }
            ,
            close() {
                this.results = []
                this.isOpen = false
                this.search = ''
                this.selectIndex = -1
            }
            ,
            onSearch(e) {
                const q = e.target.value
                this.selectIndex = 0
                this.fetchData(q)
            }
            ,
            onUpKey(e) {
                if (this.selectIndex > 0) {
                    this.selectIndex--
                }
            }
            ,
            onDownKey(e) {
                if (this.results.length - 1 > this.selectIndex) {
                    this.selectIndex++
                }
            }
            ,
            onEnterKey() {
                const found = this.results[this.selectIndex]
                if (found) {
                    this.select(found)
                }
            },
            async select(result) {
                if (this.multiSelect) {
                    const isAlreadySelected = this.selectedOptions.some(option => option.id === result.id);
                    if (!isAlreadySelected) {
                        this.selectedOptions.push(result);
                        this.results = this.results.filter(option => option.id !== result.id);
                        this.results.removeValue();
                    } else {
                        this.$toast.open({
                            position: 'top-right',
                            message: 'Already exists',
                            type: 'error',
                            duration: 3000
                        });
                    }
                }
                await this.$emit('input', {
                    target: {
                        value: this.multiSelect ? this.selectedOptions : result
                    }
                })
                this.close();
            },
            removeValue() {
                if (this.multiSelect) {
                    // Remove the last selected option
                    this.selectedOptions.pop()
                    // Emit the updated selected options
                    this.$emit('remove', this.selectedOptions)
                } else {
                    this.$emit('remove')
                }
            },
            onMouse(index) {
                this.selectIndex = index
            },
            removeSelectedOption(option) {
                // Remove the selected option from the selectedOptions array
                const index = this.selectedOptions.indexOf(option)
                if (index !== -1) {
                    this.selectedOptions.splice(index, 1)
                    // Emit the updated selected options
                    this.$emit('input', this.selectedOptions)
                }
            }
        }
    }
</script>
