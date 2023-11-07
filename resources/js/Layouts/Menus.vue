<template>
    <div class="overflow-y-auto">
        <div class="p-4 w-full">
            <nav class="space-y-1">
        <span v-for="(menu,index) in menus">
          <router-link
              :key="index"
              :to="menu.url ? menu.url : '#'"
              @click="menu.showChildren = !menu.showChildren"
              class="flex items-center space-x-3 px-3 font-medium rounded text-gray-700 bg-gray-100"
          >
                <span class="flex-none flex items-center opacity-50">
                  <i class="fas fa-home inline-block w-5 h-5"></i>
                </span>
            <span class="py-2 grow">{{ menu.title }}</span>
            <span
                class="px-2 py-1 rounded-full text-xs font-medium leading-4 bg-opacity-10 text-gray-600 bg-gray-500"
                v-if="menu.children.length"
            >{{ menu.children.length }}</span>
          </router-link>
          <ul class="ml-4" v-if="menu.showChildren">
            <li :key="index" v-for="(child, index) in menu.children">
              <router-link :to="child.url"><i class="items-center opacity-50 fas fa-home inline-block w-5 h-5"></i> {{ child.title }}</router-link>
              <ul class="ml-4" v-if="child.children.length">
                <li :key="subindex" v-for="(subchild, subindex) in child.children">
                  <router-link :to="subchild.url"><i class="items-center opacity-50 fas fa-home inline-block w-5 h-5"></i> {{ subchild.title }}</router-link>
                </li>
              </ul>
            </li>
          </ul>
        </span>
            </nav>
        </div>
    </div>
</template>

<script>
    import {byMethod} from "@/i18n/api";

    export default {
        isExpanded: false,
        name: "Menus",
        data() {
            return {
                menus: {},
            };
        },
        created() {
            byMethod("GET", "/api/menus").then((res) => {
                this.menus = res.data.data;
            });
        },
        methods: {},
    };
</script>

<style scoped>
    /* Hide the default scrollbar */
    ::-webkit-scrollbar {
        width: 0.5rem;
        height: 0.5rem;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background-color: #F5F5F5;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background-color: #B4B4B4;
        border-radius: 0.25rem;
        border: 0.1rem solid #F5F5F5;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background-color: #A0A0A0;
    }
</style>
