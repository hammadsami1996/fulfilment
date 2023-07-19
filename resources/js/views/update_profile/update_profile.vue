<template>
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex">
            <a :class="{'border-blue-500': personal, 'border-transparent': !personal}"
               @click="show_personal"
               class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-blue-500 focus:text-gray-700 focus:border-blue-300">
                Personal Information
            </a>
            <a :class="{'border-purple-500': eligibility, 'border-transparent': !eligibility}"
               @click="show_eligibility"
               class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-purple-500 focus:text-gray-700 focus:border-purple-300">
                Eligibility to work
            </a>
            <a :class="{'border-green-500': references, 'border-transparent': !references}"
               @click="show_references"
               class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-green-500 focus:text-gray-700 focus:border-green-300">
                References
            </a>
            <a :class="{'border-rose-500': emergency, 'border-transparent': !emergency}"
               @click="show_emergency"
               class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-rose-500 focus:text-gray-700 focus:border-rose-300">
                Emergency Contact
            </a>
            <a :class="{'border-yellow-500': bank_account, 'border-transparent': !bank_account}"
               @click="show_bank_account"
               class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-yellow-500 focus:text-gray-700 focus:border-yellow-300">
                Bank Account Details
            </a>
            <a :class="{'border-lime-500': medical, 'border-transparent': !medical}"
               @click="show_medical"
               class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-lime-500 focus:text-gray-700 focus:border-lime-300">
                Medical information
            </a>
            <a :class="{'border-cyan-500': submit_information, 'border-transparent': !submit_information}"
               @click="show_submit_information"
               class="w-1/4 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:border-cyan-500 focus:text-gray-700 focus:border-cyan-300">
                Submit information
            </a>
        </nav>
        <personal :id="user_id" @tab-change="handleTabChange" class="mt-4" v-if="personal"></personal>
        <eligibility-to-work :id="user_id" @tab-change="handleTabChange" class="mt-4" v-if="eligibility"></eligibility-to-work>
        <references :id="user_id" @tab-change="handleTabChange" class="mt-4" v-if="references"></references>
        <emergency :id="user_id" @tab-change="handleTabChange" class="mt-4" v-if="emergency"></emergency>
        <bank-account :id="user_id" @tab-change="handleTabChange" class="mt-4" v-if="bank_account"></bank-account>
        <medical :id="user_id" @tab-change="handleTabChange" class="mt-4" v-if="medical"></medical>
        <submit-information :id="user_id" @tab-change="handleTabChange" class="mt-4" v-if="submit_information"></submit-information>
    </div>
</template>

<script>
    import Personal from "@/Components/user/personal.vue";
    import Medical from "@/Components/user/medical.vue";
    import {form} from "@/libs/mixins";
    import EligibilityToWork from "@/Components/user/eligibility_to_work.vue";
    import References from "@/Components/user/references.vue";
    import Emergency from "@/Components/user/emergency.vue";
    import BankAccount from "@/Components/user/bank_account.vue";
    import SubmitInformation from "@/Components/user/submit_information.vue";

    export default {
        name: "update_profile",
        components: {
            SubmitInformation,
            BankAccount,
            Emergency,
            References,
            EligibilityToWork,
            Medical,
            Personal,
        },
        mixins: [form],
        data() {
            return {
                user_id: null,
                personal: true,
                eligibility: false,
                references: false,
                emergency: false,
                bank_account: false,
                medical: false,
                submit_information: false,
            };
        },
        created() {
            if (this.$route.query && this.$route.query.id) {
                this.user_id = this.$route.query.id
            } else {
                this.user_id = window.apex.user.id
            }
        },
        methods: {
            handleTabChange(componentName) {
                this.personal = componentName === 'personal';
                this.eligibility = componentName === 'eligibility';
                this.references = componentName === 'references';
                this.emergency = componentName === 'emergency';
                this.bank_account = componentName === 'bankAccount';
                this.medical = componentName === 'medical';
                this.submit_information = componentName === 'submitInformation';
            },
            show_personal() {
                this.handleTabChange('personal');
            },
            show_eligibility() {
                this.handleTabChange('eligibility');
            },
            show_references() {
                this.handleTabChange('references');
            },
            show_emergency() {
                this.handleTabChange('emergency');
            },
            show_bank_account() {
                this.handleTabChange('bankAccount');
            },
            show_medical() {
                this.handleTabChange('medical');
            },
            show_submit_information() {
                this.handleTabChange('submitInformation');
            },
        },
    };
</script>

<style scoped>

</style>
