<template>
    <div>
        <div class="grid grid-rows-12 grid-flow-col gap-2 pt-2 mx-1 px-2 ">
            <h1 class="row-span-6 font-bold uppercase">{{ capital }}</h1>
        </div>
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex">
                <a :class="{'border-blue-500': personal, 'border-transparent': !personal}"
                   @click="showRecords()"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-blue-500 focus:text-gray-700 focus:border-blue-300">
                    All
                </a>
                <a :class="{'border-purple-500': eligibility, 'border-transparent': !eligibility}"
                   @click="showRecords(0)"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-purple-500 focus:text-gray-700 focus:border-purple-300">
                    New Candidate
                </a>
                <a :class="{'border-green-500': references, 'border-transparent': !references}"
                   @click="showRecords(1)"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-green-500 focus:text-gray-700 focus:border-green-300">
                    Profile Complete
                </a>
                <a :class="{'border-rose-500': emergency, 'border-transparent': !emergency}"
                   @click="showRecords(4)"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-rose-500 focus:text-gray-700 focus:border-rose-300">
                    Telephone Interview
                </a>
                <a :class="{'border-yellow-500': bank_account, 'border-transparent': !bank_account}"
                   @click="showRecords(2)"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-yellow-500 focus:text-gray-700 focus:border-yellow-300">
                    Accept
                </a>
                <a :class="{'border-lime-500': medical, 'border-transparent': !medical}"
                   @click="showRecords(3)"
                   class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-lime-500 focus:text-gray-700 focus:border-lime-300">
                    Reject
                </a>

            </nav>
        </div>

        <div class="flex-col mt-6">
            <panel :columns="columns" :searchEnable=false :urlApi="urlApi" ref="TableData">
                <template v-slot:action="props">
                    <div class="text-sm font-medium flex">
                          <span v-if="permissions.includes(`edit-${small}`)">
                            <a @click.prevent="edit(props.item.id)" class="inline-block" href="#">
                              <svg class="h-5 w-5 mr-2 text-green-900 hover:text-green-900 underline border-b"
                                   fill="none" stroke="currentColor"
                                   stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" stroke="none"/>
                                <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"/>
                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"/>
                                <line x1="16" x2="19" y1="5" y2="8"/>
                              </svg>
                            </a>
                          </span>
                        <span v-if="permissions.includes(`delete-${small}`)">
                            <a @click.prevent="deleteCandidate(props.item.id)" class="inline-block" href="#">
                              <svg class="h-5 w-5 mr-2 text-gray-500 hover:text-red-500 underline border-b" fill="none"
                                   stroke="currentColor"
                                   stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                <polyline points="3 6 5 6 21 6"/>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                              </svg>
                          </a>
                         </span>
                        <a @click="preview(props.item)" class="inline-block" href="#">
                            <svg aria-hidden="true"
                                 class="hi-solid hi-eye inline-block w-5 h-5 text-red-500 hover:text-red-700 underline mr-2 border-b"
                                 fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path clip-rule="evenodd"
                                      d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                      fill-rule="evenodd"/>
                            </svg>
                        </a>
                        <a @click="accept(props.item.id)" class="inline-block" href="#">
                            <svg
                                aria-hidden="true"
                                class="hi-solid hi-check inline-block w-5 h-5 text-green-500 hover:text-green-700 underline mr-2 border-b"
                                fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd"
                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                      fill-rule="evenodd"/>
                            </svg>
                        </a>
                        <a @click="profile(prop.item)" class="inline-block" href="#">
                            <svg
                                aria-hidden="true"
                                class="hi-solid hi-user inline-block w-5 h-5 text-blue-500 hover:text-blue-700 underline mr-2 border-b "
                                fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                      fill-rule="evenodd"/>
                            </svg>
                        </a>
                        <a @click="reject(props.item.id)" class="inline-block" href="#">
                            <svg
                                aria-hidden="true"
                                class="hi-mini hi-x-mark inline-block w-5 h-5 text-gray-500 hover:text-gray-700 underline mr-2 border-b"
                                fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
                            </svg>
                        </a>
                        <a @click="tag(props.item)" class="inline-block" href="#">
                            <svg
                                aria-hidden="true"
                                class="hi-mini hi-tag inline-block w-5 h-5 text-purple-500 hover:text-purple-700 underline mr-2 border-b"
                                fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd"
                                      d="M5.5 3A2.5 2.5 0 003 5.5v2.879a2.5 2.5 0 00.732 1.767l6.5 6.5a2.5 2.5 0 003.536 0l2.878-2.878a2.5 2.5 0 000-3.536l-6.5-6.5A2.5 2.5 0 008.38 3H5.5zM6 7a1 1 0 100-2 1 1 0 000 2z"
                                      fill-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </template>
            </panel>
        </div>
        <!-- Modal Container -->
        <TransitionRoot :show="isOpen" appear as="template">
            <Dialog @close="isOpen = false" as="div" class="relative z-90">
                <!-- Modal Backdrop -->
                <TransitionChild
                    as="template"
                    enter="ease-out duration-200"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-100"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-gray-800 bg-opacity-75"/>
                </TransitionChild>
                <!-- END Modal Backdrop -->

                <!-- Modal Dialog -->
                <div class="fixed inset-0 overflow-y-auto p-4 lg:p-8" style="top: 10%">
                    <TransitionChild
                        as="template"
                        enter="ease-out duration-200"
                        enter-from="opacity-0 scale-125"
                        enter-to="opacity-100 scale-100"
                        leave="ease-in duration-100"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-125"
                    >
                        <DialogPanel
                            class="  mx-auto flex flex-col  shadow-sm bg-white overflow-hidden dark:text-gray-100 dark:bg-gray-800"
                            style="width: 60%; min-height: 90% "
                        >
                            <div class="flex justify-between items-center py-4 px-5 bg-gray-100 dark:bg-gray-900">
                                <DialogTitle
                                    as="h3"
                                    class="font-medium"
                                >
                                    Candidate Profile
                                </DialogTitle>
                                <div class="-my-4">
                                    <button
                                        @click="isOpen = false"
                                        class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-transparent text-gray-600 hover:text-gray-400 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:text-gray-600"
                                        type="button"
                                    >
                                        <svg class="hi-solid hi-x inline-block w-4 h-4 -mx-1" fill="currentColor"
                                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path clip-rule="evenodd"
                                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                  fill-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ml-8">
                                <div>
                                    <label class="font-medium">First Name:</label>
                                    <small class="block text-gray-700">{{user_data.firstname}}</small>
                                </div>
                                <div>
                                    <label class="font-medium">Last Name:</label>
                                    <small class="block text-gray-700">{{user_data.lastname}}</small>
                                </div>
                                <div>
                                    <label class="font-medium">Gender:</label>
                                    <small class="block text-gray-700">{{user_data.gender}}</small>
                                </div>
                                <div>
                                    <label class="font-medium">Email:</label>
                                    <small class="block text-gray-700">{{user_data.email}}</small>
                                </div>
                                <div>
                                    <label class="font-medium">Date Of Birth:</label>
                                    <small class="block text-gray-700">{{user_data.dob}}</small>
                                </div>
                                <div>
                                    <label class="font-medium">Mobile No:</label>
                                    <small class="block text-gray-700">{{user_data.mobile_no}}</small>
                                </div>
                                <div>
                                    <label class="font-medium">Postal Code:</label>
                                    <small class="block text-gray-700">{{user_data.postal_code}}</small>
                                </div>
                                <div>
                                    <label class="font-medium">Address:</label>
                                    <small class="block text-gray-700">{{user_data.address}}</small>
                                </div>
                            </div>

                            <div class="flex justify-end mt-8 space-x-4">
                                <button @click="accept(user_data.id)" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white" type="button">
                                   Accept
                                </button>
                                <button @click="reject(user_data.id)" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white" type="button">
                                    Reject
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
                <!-- END Modal Dialog -->
            </Dialog>
        </TransitionRoot>
        <!-- END Modal Container -->
    </div>
</template>

<script>
    import Panel from "@/components/panel/panel.vue";
    import typeahead from "@/components/typeahead/typeahead.vue";
    import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue';
    import {byMethod, get, post} from "@/libs/api";
    import {form} from "@/libs/mixins";
    export default {
        props: {
            id: {
                required: false
            },
        },
        mixins: [form],
        components: {
            TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle,
            Panel,
            typeahead
        },
        name: "Index",
        data() {
            return {
                user_data: {},
                isOpen: false,
                permissions: [],
                urlApi: "/api/candidate",
                urlApi1: "/api/candidate",
                resource: "/candidate",
                small: "candidate",
                capital: "Candidate",
                columns: [
                    {
                        label: 'S.NO',
                        field: 'S.No',
                        format: 'index'
                    },
                    {
                        label: 'Name',
                        field: 'name',
                    },
                    {
                        label: 'Phase ',
                        field: 'phase',
                    },
                    {
                        label: 'User Type',
                        field: 'user_type',
                        displayText: 'usertype'
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
            this.permissions = window.apex.user.permission
            get('api/basic_info').then(res => {
                // console.log(res.data.form);
                this.form = res.data.form;
                // console.log(res)
            })
        },
        methods: {
            accept(id) {
                get('api/accept/' + id).then(res => {
                    this.$toast.open({
                        position: 'top-right',
                        message: 'Accepted',
                        type: 'success',
                        duration: 3000
                    });
                })
            },
            reject(id) {
                get('api/reject/' + id).then(res => {
                    this.$toast.open({
                        position: 'top-right',
                        message: 'Rejected',
                        type: 'error',
                        duration: 3000
                    });
                })
            },
            resetModal() {
                this.user_data = {}
                this.isOpen = false
            },
            preview(data) {
                this.user_data = data
                this.isOpen = true
            },
            showRecords(e = null) {
                setTimeout(() => {
                    this.urlApi = this.urlApi1
                }, 500)
                setTimeout(() => {
                    if (e == 0) {
                        this.urlApi += '?phase=0'
                    } else if (e == 1) {
                        this.urlApi += '?phase=1'
                    } else if (e == 2) {
                        this.urlApi += '?phase=2'
                    } else if (e == 2) {
                        this.urlApi += '?phase=2'
                    } else if (e == 3) {
                        this.urlApi += '?phase=3'
                    } else if (e == 4) {
                        this.urlApi += '?phase=4'
                    }
                }, 500)
                setTimeout(() => {
                    this.$refs.TableData.reload();
                }, 500)

            },
            edit(id) {
                // this.$router.push(`${this.resource}/${id}/edit`)
                this.$router.push({
                    path: '/update_profile',
                    query: {
                        id: id,
                        back: '/candidate'
                    }
                });
            },
            deleteCandidate(e) {
                byMethod('delete', `/api/candidate/${e}`)
                    .then((res) => {
                        if (res.data.deleted) {
                            this.$refs.TableData.reload();
                            this.$toast.error(this.capital + " Deleted successfully!");
                        }
                    })
            },
        },
    }
</script>

<style scoped>

</style>
