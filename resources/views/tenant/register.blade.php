<x-guest-layout>

    <!-- Page Container -->
    <div id="page-container" class="flex flex-col mx-auto w-full min-h-screen bg-gray-100">
        <!-- Page Content -->
        <main id="page-content" class="flex flex-auto flex-col max-w-full">
            <div class="min-h-screen flex items-center justify-center relative overflow-hidden max-w-10xl mx-auto p-4 lg:p-8 w-full">
                <!-- Patterns Background -->
                <div class="pattern-dots-md text-gray-300 absolute top-0 right-0 w-32 h-32 lg:w-48 lg:h-48 transform translate-x-16 translate-y-16"></div>
                <div class="pattern-dots-md text-gray-300 absolute bottom-0 left-0 w-32 h-32 lg:w-48 lg:h-48 transform -translate-x-16 -translate-y-16"></div>
                <!-- END Patterns Background -->

                <!-- Sign Up Section -->
                <div class="py-6 lg:py-0 w-full md:w-8/12 lg:w-6/12 xl:w-4/12 relative">
                    <!-- Header -->
                    <div class="mb-8 text-center">
                        <h1 class="text-4xl font-bold inline-flex items-center mb-1 space-x-3">
                            <svg class="hi-solid hi-cube-transparent inline-block w-8 h-8 text-primary-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z" clip-rule="evenodd"/></svg>
                            <span>Company</span>
                        </h1>
                        <p class="text-gray-500">
                            Create your own account in one single step
                        </p>
                    </div>
                    <!-- END Header -->

                    <!-- Sign Up Form -->
                    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
                        <div class="p-5 lg:p-6 grow w-full">
                            <div class="sm:p-5 lg:px-10 lg:py-8">
                                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                                    @csrf
                                    <div class="space-y-1">
                                        <label for="name" class="font-medium">Name</label>
                                        <input required class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" type="text" id="name" name="name" placeholder="Enter your first name">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>

                                    </div>
                                    <div class="space-y-1">
                                        <label for="email" class="font-medium">Email</label>
                                        <input required class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" type="email" id="email" name="email" placeholder="Enter your email">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>

                                    </div>
                                    <div class="space-y-1">
                                        <label for="password" class="font-medium">Password</label>
                                        <input required class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" type="password" id="password" name="password" placeholder="Choose a strong password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2"/>

                                    </div>
                                    <div class="space-y-1">
                                        <label for="password_confirm" class="font-medium">Confirm Password</label>
                                        <input required class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" type="password" id="password_confirm" name="password_confirm" placeholder="Confirm your chosen password">
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                                    </div>
                                    <div class="space-y-1">
                                        <label for="mobile_no" class="font-medium">Mobile Number</label>
                                        <input class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" type="number" id="mobile_no" name="mobile_no" placeholder="Enter your Mobile Number">
                                        <x-input-error :messages="$errors->get('mobile_no')" class="mt-2"/>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="remember_me" name="remember_me" class="border border-gray-200 rounded h-4 w-4 text-primary-500 focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
                                        <span class="ml-2"> I accept <a href="javascript:void(0)" class="underline text-gray-600 hover:text-gray-500">terms &amp; conditions</a></span>
                                    </div>
                                    <button type="submit" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-full px-4 py-3 leading-6 rounded border-gray-200 bg-gray-800 text-white hover:text-white hover:bg-gray-900 hover:border-gray-300 focus:ring focus:ring-primary-500 focus:ring-opacity-50 active:bg-gray-900 active:border-white">
                                        Create Account
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="py-4 px-5 lg:px-6 w-full text-sm text-center bg-gray-50">
                            <a class="font-medium text-primary-600 hover:text-primary-400" href="{{ URL::route('login')}}">Return to Sign In</a>
                            {{--                        <a class="font-medium text-primary-600 hover:text-primary-400" href="javascript:void(0)">Return to Sign In</a>--}}
                        </div>
                    </div>
                    <!-- END Sign Up Form -->

                    <!-- Footer -->
                {{--                <div class="text-sm text-gray-500 text-center mt-6">--}}
                {{--                    <a class="font-medium text-primary-600 hover:text-primary-400" href="https://tailkit.com" target="_blank">Mimsoft</a> by <a class="font-medium text-primary-600 hover:text-primary-400" href="https://pixelcave.com" target="_blank">pixelcave</a>--}}
                {{--                </div>--}}
                <!-- END Footer -->
                </div>
                <!-- END Sign Up Section -->
            </div>
        </main>
        <!-- END Page Content -->
    </div>
    <!-- END Page Container -->
</x-guest-layout>
