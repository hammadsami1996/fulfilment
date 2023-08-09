<script setup>
    import { ref } from "vue";
    import Sidebar from "./sidebar.vue";
    import Footer from "./footer.vue";

    // Headless UI, for more info and examples you can check out https://github.com/tailwindlabs/headlessui
    import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
    const userData = window.apex.user
    const mobileSidebarOpen = ref(false);
    const desktopSidebarOpen = ref(true);
</script>

<template>
    <!-- Page Container -->
    <div
        id="page-container"
        class="flex flex-col mx-auto w-full min-h-screen min-w-[320px] bg-gray-100 dark:text-gray-100 dark:bg-gray-900"
        :class="{
      'lg:pl-64': desktopSidebarOpen
    }"
    >
        <!-- Page Sidebar -->
        <Sidebar :mobileSidebarOpen="mobileSidebarOpen" :desktopSidebarOpen="desktopSidebarOpen" />
        <!-- Page Sidebar -->

        <!-- Page Header -->
        <header
            id="page-header"
            class="flex flex-none items-center h-16 bg-white shadow-sm fixed top-0 right-0 left-0 z-30"
            :class="{
        'lg:pl-72': desktopSidebarOpen
      }"
        >
            <div class="flex justify-between max-w-10xl mx-auto px-4 lg:px-8 w-full">
                <!-- Left Section -->
                <div class="flex items-center space-x-2">
                    <!-- Toggle Sidebar on Desktop -->
                    <div class="hidden lg:block">
                        <button
                            type="button"
                            class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none"
                            @click="desktopSidebarOpen = !desktopSidebarOpen"
                        >
                            <svg class="hi-solid hi-menu-alt-1 inline-block w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/></svg>
                        </button>
                    </div>
                    <!-- END Toggle Sidebar on Desktop -->

                    <!-- Toggle Sidebar on Mobile -->
                    <div class="lg:hidden">
                        <button
                            type="button"
                            class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none"
                            @click="mobileSidebarOpen = true"
                        >
                            <svg class="hi-solid hi-menu-alt-1 inline-block w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/></svg>
                        </button>
                    </div>
                    <!-- END Toggle Sidebar on Mobile -->

                    <!-- Search -->
                    <div class="hidden sm:block">
                        <form>
                            <input type="text" class="w-full block border border-gray-200 rounded px-3 py-2 leading-5 text-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" id="search" name="search" placeholder="Search..">
                        </form>
                    </div>
                    <div class="sm:hidden">
                        <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                            <svg class="hi-solid hi-search inline-block w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
                        </button>
                    </div>
                    <!-- END Search -->
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="flex items-center space-x-2">
                    <!-- Notifications -->
                    <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                        <svg class="hi-outline hi-bell inline-block w-5 h-5" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <span class="text-primary-500">•</span>
                    </button>
                    <!-- END Notifications -->

                    <!-- User Dropdown -->
                    <Menu as="div" class="relative inline-block">
    <MenuButton  @click="showDropdown = !showDropdown"
                            class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none"
                        >
                            <span>{{userData.name}}</span>
                            <svg class="hi-solid hi-chevron-down inline-block w-5 h-5 opacity-50" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </MenuButton>
    <div v-if="showDropdown" @click="showDropdown = false"  >
      <ul class=" absolute right-0 origin-top-right mt-2 w-48 shadow-xl rounded z-1 focus:outline-none">
        <div class="bg-white ring-1 ring-black ring-opacity-5 rounded divide-y divide-gray-100" style="color: gray;">
            <div class="p-2 space-y-1 "  >
                                        <MenuItem v-slot="{ active }"  >
                                            <a
                                                href="/profile"
                                                class="flex items-center space-x-2 rounded py-2 px-3 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-700"
                                                :class="{
                          'text-gray-700 bg-gray-100': active,
                          'text-gray-600 hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700': !active,
                        }"
                                            >
                                                <svg class="hi-solid hi-user-circle inline-block w-5 h-5 opacity-50" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/></svg>
                                                <span>Profile</span>
                                            </a>
                                        </MenuItem>

                                        </div>
                                        <div class="p-2 space-y-1" >
                                        <MenuItem v-slot="{ active }">
                                            <a
                                                href="/change_password"
                                                class="flex items-center space-x-2 rounded py-2 px-3 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-700"
                                                :class="{
                          'text-gray-700 bg-gray-100': active,
                          'text-gray-600 hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700': !active,
                        }"
                                            >
                                                <svg class="hi-solid hi-inbox inline-block w-5 h-5 opacity-50" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v7h-2l-1 2H8l-1-2H5V5z" clip-rule="evenodd"/></svg>
                                                <span>Change Password</span>
                                            </a>
                                        </MenuItem>
                                    </div>
                                    <div class="p-2 space-y-1">
                                        <MenuItem v-slot="{ active }" >
                                            <a
                                                href="/setting"
                                                class="flex items-center space-x-2 rounded py-2 px-3 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-700"
                                                :class="{
                          'text-gray-700 bg-gray-100': active,
                          'text-gray-600 hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700': !active,
                        }"
                                            >
                                                <svg class="hi-solid hi-cog inline-block w-5 h-5 opacity-50" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/></svg>
                                                <span>Settings</span>
                                            </a>
                                        </MenuItem>
                                    </div>
        <div class="p-2 space-y-1">
                                        <MenuItem v-slot="{ active }"  >
                                            <a
                                                href="/logout"
                                                class="flex items-center space-x-2 rounded py-2 px-3 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-700"
                                                :class="{
                          'text-gray-700 bg-gray-100': active,
                          'text-gray-600 hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700': !active,
                        }"
                                            >
                                                <svg class="hi-solid hi-lock-closed inline-block w-5 h-5 opacity-50" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                                                <span>Sign out</span>
                                            </a>
                                        </MenuItem>
                                    </div>
      
        </div>
      </ul>
    </div>
    </Menu>

                    <div>
    <!-- <button @click="showDropdown = !showDropdown">
      Toggle Dropdown
    </button> -->
    
  </div>
                    <!-- END User Dropdown -->
                </div>
                <!-- END Right Section -->
            </div>
        </header>
        <!-- END Page Header -->

        <!-- Page Content -->
        <main id="page-content" class="flex flex-auto flex-col max-w-full pt-16">
            <!-- Page Section -->
            <div class="max-w-10xl mx-auto p-4 lg:p-8 w-full">
                <!-- ADD YOUR MAIN CONTENT BELOW -->

                <!-- Placeholder -->
<!--                <div class="flex items-center justify-center rounded-xl bg-gray-50 border-2 border-dashed border-gray-200 text-gray-400 py-64">-->
                    <div class="bg-white shadow overflow-hidden rounded-lg p-2">
                    <!-- Striped Table -->
                            <router-view/>
                        <!-- END Striped Table -->
                    </div>
<!--                </div>-->

                <!--ADD YOUR MAIN CONTENT ABOVE-->
            </div>
            <!-- END Page Section -->
        </main>
        <!-- END Page Content -->

        <!-- Page Footer -->
        <Footer/>
        <!-- END Page Footer -->
    </div>
    <!-- END Page Container -->
</template>

<script>
export default {
  data() {
    return {
      showDropdown: false,
     

    };
  }
};
</script>





