<script>
    import {form} from "@/libs/mixins";
    import {get} from "@/libs/api";

    export default {
        mixins: [form],
        data() {
            return {
                openDropdownIndex: null,
                tenant: false
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
    <aside
        :class="{
        '-translate-x-full': !mobileSidebarOpen,
        'translate-x-0': mobileSidebarOpen,
        'lg:-translate-x-full': !desktopSidebarOpen,
        'lg:translate-x-0': desktopSidebarOpen,
      }"
        aria-label="Main Sidebar Navigation"
        class="flex flex-col fixed top-0 left-0 bottom-0 w-full lg:w-72 pl-14 h-full lg:border-r bg-white z-50 transform transition-transform duration-500 ease-out"
        id="page-sidebar"
    >

        <!-- Sidebar Content -->
        <div class="h-screen overflow-y-auto">
            <!-- Sidebar Header -->
            <div class="h-16 shadow-sm flex-none flex items-center justify-between lg:justify-center px-4 w-full">
                <h2 class="grow font-semibold text-sm">Welcome Admin</h2>

                <!-- Close Sidebar on Mobile -->
                <div class="flex-none lg:hidden">
                    <button
                        @click="mobileSidebarOpen = false"
                        class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-transparent text-red-600 hover:text-red-400 focus:ring focus:ring-red-500 focus:ring-opacity-50 active:text-red-600"
                        type="button"
                    >
                        <svg class="hi-solid hi-x inline-block w-4 h-4 -mx-1" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  fill-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
                <!-- END Close Sidebar on Mobile -->
            </div>
            <!-- END Sidebar Header -->

            <!-- Sidebar Navigation -->
            <nav class="p-4 w-full">
                <nav class="space-y-1">
                    <template v-for="(item, index) in form">
                        <div
                            @click="toggleDropdown(index)"
                            class="px-3 pt-5 pb-2 text-xs font-semibold uppercase tracking-wider text-gray-500 cursor-pointer"
                        >
                            {{ item.title }}
                        </div>
                        <div v-show="item.isDropdownOpen">
                            <router-link
                                :key="index_child"
                                :to="item_child.url"
                                class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"
                                v-for="(item_child, index_child) in item.children"
                            >
                                <span class="flex-none flex items-center text-indigo-500">
            <svg
                aria-hidden="true"
                class="hi-outline hi-home inline-block w-5 h-5"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
            >
              <path
                  d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                  stroke-linecap="round"
                  stroke-linejoin="round"
              />
            </svg>
          </span>
                                <span class="py-2 grow">{{ item_child.title }}</span>
                            </router-link>
                        </div>
                    </template>
                </nav>
            </nav>
            <!-- END Sidebar Navigation -->
        </div>
        <!-- END Sidebar Content -->
    </aside>
</template>
