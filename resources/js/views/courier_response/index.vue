<template>
    <div>
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ capital }}</h3>
        </div>
        <div class="flex-col">
            <panel :columns="columns" :urlApi="urlApi" ref="TableData">

                <template v-slot:couriersss="props">
                    <div class="custom-typeahead w-1/0">
                        <typeahead :initialize="props.item.courier_responses"
                                   :url="courier" @input="onShippeds($event ,props.item)" display="title"
                                   multi-select="true"/>
                    </div>
                </template>

                <template v-slot:action="props">
                    <div class="text-sm font-medium flex">
            <span>
              <a @click.prevent="edit(props.item)" href="#">
                <i class="fa-solid fa-check-double text-2xl text-blue-400"></i>
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
    import {form} from "@/libs/mixins";
    import {byMethod} from "@/libs/api";
    import Typeahead from "@/Components/typeahead/typeahead.vue";

    export default {
        mixins: [form],
        components: {
            Panel,
            Typeahead,
        },
        name: "Index",
        data() {
            return {
                // selectedOptions: [],
                selectedItems: [],
                permissions: [],
                courier: "/api/courier_serach",
                urlApi: "/api/courier_response",
                resource: "/courier_response",
                small: "courier_response",
                capital: "Courier_response",
                columns: [
                    {label: "S.No", field: "id", format: "index"},
                    {label: "status", field: "name"},
                    {label: "courier_response", field: "couriersss", slot: true},
                    {label: "Action", field: "action", action: true},
                ],
            };
        },
        created() {
            this.permissions = window.apex.user.permission;
        },
        methods: {
            formSubmitted() {
                byMethod("post", "/api/courier_response", this.form).then((res) => {
                });
            },
            onShippeds(e, f) {
                const courier = e.target.value;
                f.courier_responses = courier;
            },


            edit(e) {
                byMethod("post", `/api/courier_response/${e.id}?_method=PUT`,e.courier_responses).then((res) => {
                    if (res.data.saved) {
                        this.$toast.open({
                            position: "top-right",
                            message: "Successful",
                            type: "success",
                            duration: 3000,
                        });
                    }
                });
            },
            deleteRole(e) {
                byMethod("delete", `/api/courier_response/${e}`).then((res) => {
                    if (res.data.deleted) {
                        this.$refs.TableData.reload();
                        this.$toast.error(this.capital + " Deleted successfully!");
                    }
                });
            },
        },
    };
</script>


