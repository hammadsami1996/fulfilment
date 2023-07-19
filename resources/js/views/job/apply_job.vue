<template>
    <div>
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ capital }}</h3>
        </div>
        <div class="flex-col">
            <panel :columns="columns" :urlApi="urlApi" ref="TableData">
                <template v-slot:action="props">
                    <div class="text-sm font-medium flex">
                        <a @click="applyjob(props.item.id)"
                            class="ml-4 text-indigo-600 hover:text-indigo-900"
                            href="#"
                        >Apply job</a>
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

    export default {
        mixins: [form],
        components: {
            Panel,
        },
        name: "Index",
        data() {
            return {
                permissions: [],
                urlApi: "/api/job",
                resource: "/job",
                capital: "Apply Job",
                columns: [
                    {
                        label: 'S.No',
                        field: 'S.No',
                        format: 'index'
                    },
                    {
                        label: 'Name',
                        field: 'name',
                    },
                    {
                        label: 'Description',
                        field: 'description',
                    },
                    {
                        label: 'Action',
                        field: 'action',
                        action: true
                    }
                ]
            }
        },
        created() {
            // console.log(window.apex.user.permission)
            this.permissions = window.apex.user.permission
        },
        methods: {
            applyjob(e){
                let data = {
                    job_id: e
                };
                byMethod('POST','/api/apply_job',data).then(res=>{

                    this.$toast.open({
                        position: 'top-right',
                        message:  res.data.message,
                        type: 'success',
                        duration: 3000
                    });
                    // app.$toast.success('already Applied');

                })
            },
        },
    }
</script>

<style scoped>

</style>
