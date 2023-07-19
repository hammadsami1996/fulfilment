<script>
    import {form} from "@/libs/mixins";
    import {get} from "@/libs/api";

    export default {
        mixins: [form],
        data() {
            return {
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
        }
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
        <!-- Sidebar Mini -->
        <div
            class="absolute top-0 left-0 bottom-0 z-10 flex w-14 flex-col bg-gray-800 text-gray-200"
        >
            <!-- Brand -->
            <div class="flex-none">
                <router-link
                    class="w-full h-16 flex items-center justify-center font-bold text-lg tracking-wide text-primary-300 hover:text-primary-100 hover:bg-gray-900 active:bg-opacity-50"
                    to="/dashboard">
                    <svg class="hi-solid hi-cube-transparent inline-block w-5 h-5" fill="currentColor"
                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd"
                              d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z"
                              fill-rule="evenodd"/>
                    </svg>
                </router-link>
            </div>
            <!-- END Brand -->

            <!-- Main Navigation -->
            <nav class="grow px-2 py-4 space-y-2">
                <a class="w-full h-10 flex items-center justify-center rounded text-gray-300 hover:text-gray-100 hover:bg-gray-700 active:bg-opacity-50"
                   href="#">
                    <svg class="hi-solid hi-briefcase inline-block w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd"
                              d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                              fill-rule="evenodd"/>
                        <path
                            d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                    </svg>
                </a>
                <a class="w-full h-10 flex items-center justify-center rounded text-gray-300 hover:text-gray-100 hover:bg-gray-700 active:bg-opacity-50"
                   href="#">
                    <svg class="hi-solid hi-presentation-chart-line inline-block w-5 h-5" fill="currentColor"
                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd"
                              d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                              fill-rule="evenodd"/>
                    </svg>
                </a>
                <a class="w-full h-10 flex items-center justify-center rounded text-gray-300 hover:text-gray-100 hover:bg-gray-700 active:bg-opacity-50"
                   href="#">
                    <svg class="hi-solid hi-document-text inline-block w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd"
                              d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                              fill-rule="evenodd"/>
                    </svg>
                </a>
            </nav>
            <!-- END Main Navigation -->

            <!-- User Navigation -->
            <nav class="flex-none px-2 py-4 space-y-2">
                <a class="w-full h-10 flex items-center justify-center rounded text-gray-300 hover:text-gray-100 hover:bg-gray-700 active:bg-opacity-50"
                   href="#">
                    <svg class="hi-solid hi-cog inline-block w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd"
                              d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                              fill-rule="evenodd"/>
                    </svg>
                </a>
                <a class="w-full h-10 flex items-center justify-center rounded text-gray-300 hover:text-gray-100 hover:bg-gray-700 active:bg-opacity-50"
                   href="#">
                    <svg class="hi-solid hi-logout inline-block w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd"
                              d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                              fill-rule="evenodd"/>
                    </svg>
                </a>
            </nav>
            <!-- END User Navigation -->
        </div>
        <!-- END Sidebar Mini -->

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
                <!--                <nav class="space-y-1" v-if="tenant">-->
                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium text-sm rounded text-gray-700 bg-gray-100"-->
                <!--                        to="/dashboard">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-home inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">Dashboard</span>-->
                <!--                        <span-->
                <!--                            class="px-2 py-1 rounded-full text-xs font-medium leading-4 bg-opacity-10 text-gray-600 bg-gray-500">3</span>-->
                <!--                    </router-link>-->

                <!--                    <div class="px-3 pt-5 pb-2 text-xs font-semibold uppercase tracking-wider text-gray-400">Quick-->
                <!--                        Actions-->
                <!--                    </div>-->

                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/user">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">Users</span>-->
                <!--                    </router-link>-->
                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/update_profile">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">Update Profile</span>-->
                <!--                    </router-link>-->
                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/role">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">Role</span>-->
                <!--                    </router-link>-->

                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/user_plan">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">User Subscription</span>-->
                <!--                    </router-link>-->
                <!--                    &lt;!&ndash;                    <router-link class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"&ndash;&gt;-->
                <!--                    &lt;!&ndash;                                 to="/basic_info">&ndash;&gt;-->
                <!--                    &lt;!&ndash;              <span class="flex-none flex items-center opacity-50">&ndash;&gt;-->
                <!--                    &lt;!&ndash;                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"&ndash;&gt;-->
                <!--                    &lt;!&ndash;                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path&ndash;&gt;-->
                <!--                    &lt;!&ndash;                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"&ndash;&gt;-->
                <!--                    &lt;!&ndash;                    stroke-linecap="round"&ndash;&gt;-->
                <!--                    &lt;!&ndash;                    stroke-linejoin="round"&ndash;&gt;-->
                <!--                    &lt;!&ndash;                    stroke-width="2"/></svg>&ndash;&gt;-->
                <!--                    &lt;!&ndash;              </span>&ndash;&gt;-->
                <!--                    &lt;!&ndash;                        <span class="py-2 grow">Basic info</span>&ndash;&gt;-->
                <!--                    &lt;!&ndash;                    </router-link>&ndash;&gt;-->
                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/job">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">Jobs</span>-->
                <!--                    </router-link>-->
                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/apply_job">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow"> Apply Jobs</span>-->
                <!--                    </router-link>-->
                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/job_user">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">  Job User</span>-->
                <!--                    </router-link>-->
                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/location">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">  Location</span>-->
                <!--                    </router-link>-->
                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/job_type">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">  Job Type</span>-->
                <!--                    </router-link>-->
                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/job_role">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">  Job Role</span>-->
                <!--                    </router-link>-->
                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/job_skill">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">  Job Skill</span>-->
                <!--                    </router-link>-->
                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/job_speciality">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">  Job Speciality</span>-->
                <!--                    </router-link>-->
                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/permission">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">  Permission</span>-->
                <!--                    </router-link>-->
                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/user_dashboard">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">  User Dashboard</span>-->
                <!--                    </router-link>-->
                <!--                </nav>-->
                <!--                <nav class="space-y-1" v-else>-->
                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium text-sm rounded text-gray-700 bg-gray-100"-->
                <!--                        to="#">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-home inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">Dashboard</span>-->
                <!--                        <span-->
                <!--                            class="px-2 py-1 rounded-full text-xs font-medium leading-4 bg-opacity-10 text-gray-600 bg-gray-500">3</span>-->
                <!--                    </router-link>-->
                <!--                    <div class="px-3 pt-5 pb-2 text-xs font-semibold uppercase tracking-wider text-gray-400">Quick-->
                <!--                        Actions-->
                <!--                    </div>-->

                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/user">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">Users</span>-->
                <!--                    </router-link>-->
                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/roles">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow">Roles</span>-->
                <!--                    </router-link>-->
                <!--                    <router-link-->
                <!--                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"-->
                <!--                        to="/plan">-->
                <!--              <span class="flex-none flex items-center opacity-50">-->
                <!--                <svg class="hi-outline hi-user-add inline-block w-5 h-5" fill="none" stroke="currentColor"-->
                <!--                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path-->
                <!--                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"-->
                <!--                    stroke-linecap="round"-->
                <!--                    stroke-linejoin="round"-->
                <!--                    stroke-width="2"/></svg>-->
                <!--              </span>-->
                <!--                        <span class="py-2 grow"> Plans</span>-->
                <!--                    </router-link>-->

                <!--                </nav>-->
                <nav class="space-y-1">
                    <template v-for="(item,index) in form">
                        <div class="px-3 pt-5 pb-2 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            {{item.title}}
                        </div>
                        <router-link
                            :to="item_child.url"
                            class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50"
                            v-for="(item_child,index_child) in item.children">
                <span class="flex-none flex items-center text-indigo-500">
                  <svg aria-hidden="true" class="hi-outline hi-home inline-block w-5 h-5" fill="none"
                       stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path
                      d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                      stroke-linecap="round"
                      stroke-linejoin="round"/></svg>
                </span>
                            <span class="py-2 grow">{{item_child.title}}</span>
                            <!--                            <span class="font-semibold inline-flex px-1.5 py-0.5 leading-4 text-xs rounded-full border border-indigo-200 text-indigo-700 bg-indigo-100 dark:text-indigo-50 dark:bg-indigo-800 dark:border-indigo-700">3</span>-->
                        </router-link>
                    </template>
                </nav>
            </nav>
            <!-- END Sidebar Navigation -->
        </div>
        <!-- END Sidebar Content -->
    </aside>
</template>
