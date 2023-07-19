<x-guest-layout>
        <div v-if="show">
            <div class="p-6">
                <h1 class="text-lg font-bold mb-4">
                 Personal Information
                </h1>
                <div class="flex-auto flex flex-col sm:flex-row sm:items-center ">
                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                        <label for="title" class="font-medium">Title</label>
                        <input required class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" type="text" id="title" name="title" placeholder="Enter your title">

                    </div>
                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                        <label for="name" class="font-medium"> First Name</label>
                        <input required class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" type="text" id="name" name="name" placeholder="Enter your first name">

                    </div>
                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                        <label for="lname" class="font-medium"> Last Name</label>
                        <input required class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" type="text" id="lname" name="lname" placeholder="Enter your last name">

                    </div>
                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                        <label for="gender" class="font-medium"> Gender</label>
                        <input required class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" type="text" id="gender" name="gender" placeholder="Enter your gender">

                    </div>
                </div>
                <div class="flex-auto flex flex-col sm:flex-row sm:items-center ">
                    <div class="w-full sm:w-1/2 mb-4 sm:ml-0 p-2 ">
                        <label for="email" class="font-medium">Email</label>
                        <input required class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" type="email" id="email" name="email" placeholder="Enter your email">
                    </div>
                </div>
            </div>
        </div>

    <!-- END Page Container -->
</x-guest-layout>
