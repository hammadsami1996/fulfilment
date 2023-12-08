<script>
    import {form} from "@/libs/mixins";
    import {get} from "@/libs/api";

    export default {
        mixins: [form],
        data() {
            return {
                openDropdownIndex: null,
                tenant: false,
                showDropdown: false,
            }
        },
        props: {
            mobileSidebarOpen: {
                type: Boolean,
                required: true
            },
            desktopSidebarOpen: {
                type: Boolean,
                required: true
            },
        },
        created() {
            this.tenant = window.apex.user.tenant == "1" ? true : false
            get('/api/menus').then(res => {
                this.form = res.data.data
            })
        },
        methods: {
            toggleDropdown(index) {
                for (let i = 0; i < this.form.length; i++) {
                    if (i !== index) {
                        this.form[i].isDropdownOpen = false;
                    }
                }
                this.form[index].isDropdownOpen = !this.form[index].isDropdownOpen;
            },
        },
    }
</script>
<template>
    <nav
        :class="{
      '-translate-x-full': !mobileSidebarOpen,
      'translate-x-0': mobileSidebarOpen,
      'lg:-translate-x-full': !desktopSidebarOpen,
      'lg:translate-x-0': desktopSidebarOpen,
    }"
        aria-label="Main Sidebar Navigation"
        class="flex flex-col fixed top-0 left-0 bottom-0 w-full lg:w-56 h-full bg-white border-r border-gray-200 z-50 transition-transform duration-500 ease-out dark:bg-gray-800 dark:text-gray-200 dark:border-gray-800"
        id="page-sidebar"
    >
        <!-- Sidebar Header -->
        <div
            class="h-16 flex-none flex items-center justify-between lg:justify-center px-4 w-full dark:bg-gray-600 dark:bg-opacity-25">
            <!-- Brand -->
            <a class="group inline-flex items-center space-x-2 font-bold text-lg tracking-wide text-gray-900 hover:text-gray-600 dark:text-gray-100 dark:hover:text-gray-300"
               href="#">
                <svg
                    aria-hidden="true"
                    class="hi-mini hi-cube-transparent inline-block w-5 h-5 text-indigo-600 transition group-hover:scale-110 dark:text-indigo-400"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd"
                          d="M9.638 1.093a.75.75 0 01.724 0l2 1.104a.75.75 0 11-.724 1.313L10 2.607l-1.638.903a.75.75 0 11-.724-1.313l2-1.104zM5.403 4.287a.75.75 0 01-.295 1.019l-.805.444.805.444a.75.75 0 01-.724 1.314L3.5 7.02v.73a.75.75 0 01-1.5 0v-2a.75.75 0 01.388-.657l1.996-1.1a.75.75 0 011.019.294zm9.194 0a.75.75 0 011.02-.295l1.995 1.101A.75.75 0 0118 5.75v2a.75.75 0 01-1.5 0v-.73l-.884.488a.75.75 0 11-.724-1.314l.806-.444-.806-.444a.75.75 0 01-.295-1.02zM7.343 8.284a.75.75 0 011.02-.294L10 8.893l1.638-.903a.75.75 0 11.724 1.313l-1.612.89v1.557a.75.75 0 01-1.5 0v-1.557l-1.612-.89a.75.75 0 01-.295-1.019zM2.75 11.5a.75.75 0 01.75.75v1.557l1.608.887a.75.75 0 01-.724 1.314l-1.996-1.101A.75.75 0 012 14.25v-2a.75.75 0 01.75-.75zm14.5 0a.75.75 0 01.75.75v2a.75.75 0 01-.388.657l-1.996 1.1a.75.75 0 11-.724-1.313l1.608-.887V12.25a.75.75 0 01.75-.75zm-7.25 4a.75.75 0 01.75.75v.73l.888-.49a.75.75 0 01.724 1.313l-2 1.104a.75.75 0 01-.724 0l-2-1.104a.75.75 0 11.724-1.313l.888.49v-.73a.75.75 0 01.75-.75z"
                          fill-rule="evenodd"/>
                </svg>
                <span>Company</span>
            </a>
            <!-- END Brand -->

            <!-- Close Sidebar on Mobile -->
            <div class="lg:hidden">
                <button
                    @click="mobileSidebarOpen = false"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-white text-gray-800 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:ring focus:ring-gray-300 focus:ring-opacity-25 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600 dark:focus:ring-opacity-40 dark:active:border-gray-700"
                    type="button"
                >
                    <svg aria-hidden="true" class="hi-mini hi-x-mark inline-block w-5 h-5 -mx-0.5"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
                    </svg>
                </button>
            </div>
            <!-- END Close Sidebar on Mobile -->
        </div>
        <!-- END Sidebar Header -->

        <!-- Sidebar Navigation -->
        <div class="overflow-y-auto">
            <div class="p-4 w-full">
                <nav class="space-y-1 ">
                    <template v-for="(item, index) in form">
                        <div
                            @click="toggleDropdown(index)"
                            class="px-2  pt-4 pb-2 text-xs font-semibold uppercase tracking-wider text-black-500 cursor-pointer"
                        >
                            <svg  v-if="form[index].isDropdownOpen" class="hi-solid hi-chevron-down inline-block w-5 h-5 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                            <!-- <svg  v-else class="hi-solid hi-chevron-up inline-block w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"/></svg> -->
                            <svg v-else class="hi-mini hi-chevron-right inline-block w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd"/></svg>
                            {{ item.title }}
                        </div>
                        <div v-show="item.isDropdownOpen">
                            <router-link
                                :key="index_child"
                                :to="item_child.url"
                                class="group flex items-center space-x-2 px-2.5 text-sm font-medium rounded-lg text-gray-800 border border-transparent hover:text-gray-900 hover:bg-indigo-50 active:border-indigo-100 dark:text-gray-200 dark:hover:text-white dark:hover:bg-gray-700/75 dark:active:border-gray-600"
                                v-for="(item_child, index_child) in item.children"
                            >
                <span
                    class="flex-none flex items-center text-gray-400 group-hover:text-indigo-500 dark:text-gray-500 dark:group-hover:text-gray-300">
                  <!-- <svg aria-hidden="true" class="hi-outline hi-home inline-block w-5 h-5" fill="none"
                       stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                        stroke-linecap="round" stroke-linejoin="round"/>
                  </svg> -->
                </span>
                                <span class="py-2 grow">{{ item_child.title }}</span>
                            </router-link>
                        </div>
                    </template>
                </nav>
            </div>
        </div>
        <!-- END Sidebar Navigation -->
    </nav>
</template>
