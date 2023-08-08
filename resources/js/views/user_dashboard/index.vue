<template>
    <div>
        <h1>User Dashboard</h1>
        <Editor editorStyle="height: 320px" v-model="form.value"/>
    </div>
</template>

<script>
    import {form} from '@/libs/mixins'; // Make sure to use the correct path
    import Editor from 'primevue/editor';
    export default {
        mixins: [form],
        components: {
            Editor,
        },
        data() {
            return {}
        },
        created() {
        },
        methods: {}
    };
</script>


<!--    <div class="bg-gray-800">-->
<!--        <div class="p-5 flex items-center hover:border-gray-300">-->
<!--            <div class="w-full">-->
<!--                <div class="mt-1 text-lg text-center text-white border-b">-->
<!--                    <strong class="text-red-600">Alert:</strong> You have been approved for a face-to-face interview.-->
<!--                    Kindly fill up the remaining information before your interview.-->
<!--                </div>-->
<!--                <div class="flex items-center mt-3 justify-center">-->
<!--                    <router-link class="text-white hover:text-white-800 font-semibold underline" to="/update_profile">-->
<!--                        Click here to complete your profile-->
<!--                    </router-link>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">-->
<!--            <div class="bg-gray-300 col-span-1 rounded-lg">-->
<!--                <img :src="`uploads/basic_info/img/` + form.img" alt="Profile Image"-->
<!--                     class="w-full h-full object-cover rounded-lg">-->
<!--            </div>-->

<!--            <div class="bg-gray-100 col-span-2 rounded-lg">-->
<!--                <div class="p-6">-->
<!--                    <h1 class="text-center text-2xl font-bold uppercase mb-6">Basic Information</h1>-->

<!--                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">-->
<!--                        <div>-->
<!--                            <label class="font-medium">First Name:</label>-->
<!--                            <small class="block text-gray-700">{{form.firstname}}</small>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="font-medium">Last Name:</label>-->
<!--                            <small class="block text-gray-700">{{form.lastname}}</small>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="font-medium">Gender:</label>-->
<!--                            <small class="block text-gray-700">{{form.gender}}</small>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="font-medium">Email:</label>-->
<!--                            <small class="block text-gray-700">{{form.email}}</small>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="font-medium">Date Of Birth:</label>-->
<!--                            <small class="block text-gray-700">{{form.dob}}</small>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="font-medium">Mobile No:</label>-->
<!--                            <small class="block text-gray-700">{{form.mobile_no}}</small>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="font-medium">Postal Code:</label>-->
<!--                            <small class="block text-gray-700">{{form.postal_code}}</small>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="font-medium">Address:</label>-->
<!--                            <small class="block text-gray-700">{{form.address}}</small>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
