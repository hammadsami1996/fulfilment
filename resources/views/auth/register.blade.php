<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>
    <!-- Page Container -->
    <div id="page-container" class="flex flex-col mx-auto w-full min-h-screen bg-gray-100">
        <!-- Page Content -->
        <main id="page-content" class="flex flex-auto flex-col max-w-full">
            <div class="min-h-screen flex flex-col bg-cover bg-bottom"
                 style="background-image: url('https://cdn.tailkit.com/media/placeholders/photo-9XngoIpxcEo-1920x1200.jpg');">
                <!-- Sign Up Section -->
                <div class="flex grow md:w-8/12 lg:w-5/12 xl:w-4/12 bg-white shadow-xl">
                    <div class="flex flex-col p-8 lg:p-16 xl:p-20 w-full">
                        <!-- Sign Up Content -->
                        <div class="grow flex items-center">
                            <div class="w-full max-w-lg mx-auto space-y-10">
                                <!-- Header -->
                                <div>
                                    <h1 class="text-4xl font-bold inline-flex items-center mb-1 space-x-3">
                                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                             class="text-primary-500 hi-solid hi-cube-transparent inline-block w-8 h-8">
                                            <path fill-rule="evenodd"
                                                  d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Fulfilment By Mimsoft</span>
                                    </h1>
                                    <p class="text-gray-500">
                                        Create your own account in one single step
                                    </p>
                                </div>
                                <!-- END Header -->
                                <!-- Sign Up Form -->
                                <form id="SubmitForm" action="{{ route('register') }}" method="POST" class="space-y-6">
                                    @csrf
                                    <div class="space-y-1">
                                        {{--                                        @if(count(explode('.',request()->getHost())) > 2)--}}
                                        {{--                                            <label for="name" class="font-medium">User Name</label>--}}
                                        {{--                                        @else--}}
                                        <label for="name" class="font-medium">Business Name</label>
                                        {{--                                        @endif--}}
                                        <x-text-input
                                            class="block border placeholder-gray-400 px-5 py-3 leading-6 w-full rounded border-gray-200 focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                                            type="text" id="name" name="name" placeholder="Enter your first name"
                                            :value="old('name')" required autofocus autocomplete="name"
                                            data-error="name"/>

                                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                                    </div>
                                    <div class="space-y-1">
                                        <label for="email" class="font-medium">Email</label>
                                        <x-text-input
                                            class="block border placeholder-gray-400 px-5 py-3 leading-6 w-full rounded border-gray-200 focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                                            type="email" id="email" name="email" placeholder="Enter your email"
                                            :value="old('email')" required autofocus autocomplete="username"
                                            data-error="email"/>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                                    </div>
                                    <div class="space-y-1">
                                        <label for="password_confirm" class="font-medium">Mobile No</label>
                                        <x-text-input
                                            class="block border placeholder-gray-400 px-5 py-3 leading-6 w-full rounded border-gray-200 focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                                            type="number" id="mobile_no" name="mobile_no"
                                            placeholder="Enter your mobile no"
                                            :value="old('mobile_no')" required autocomplete="mobile_no"
                                            data-error="mobile_no"/>
                                        <x-input-error :messages="$errors->get('mobile_no')" class="mt-2"/>


                                    </div>
                                    <div class="space-y-1">
                                        <label for="password" class="font-medium">Password</label>
                                        <x-text-input
                                            class="block border placeholder-gray-400 px-5 py-3 leading-6 w-full rounded border-gray-200 focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                                            type="password" id="password" name="password"
                                            placeholder="Choose a strong password" required
                                            autocomplete="new-password"/>


                                    </div>
                                    <div class="space-y-1">
                                        <label for="password_confirm" class="font-medium">Confirm Password</label>
                                        <x-text-input
                                            class="block border placeholder-gray-400 px-5 py-3 leading-6 w-full rounded border-gray-200 focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                                            type="password" id="password_confirmation" name="password_confirmation"
                                            required autocomplete="new-password"
                                            data-error="password_confirmation"/>
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                                    </div>
                                    <div class="flex items-center">
                                        <x-text-input type="checkbox" id="remember_me" name="remember_me"
                                                      class="border border-gray-300 rounded h-4 w-4 text-primary-500 focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"/>
                                        <span class="ml-2"> I accept <a href="javascript:void(0)"
                                                                        class="font-medium underline text-gray-600 hover:text-gray-500">terms &amp; conditions</a></span>
                                    </div>
                                    <x-primary-button id="register-button" type="submit"
                                                      class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-full px-4 py-3 leading-6 rounded border-primary-700 bg-primary-700 text-white hover:text-white hover:bg-primary-800 hover:border-primary-800 focus:ring focus:ring-primary-500 focus:ring-opacity-50 active:bg-primary-700 active:border-primary-700">
                                        {{ __('Register') }}
                                    </x-primary-button>
                                </form>
                                <!-- END Sign Up Form -->
                                <div class="text-sm text-gray-500">
                                    <a href="{{ route('login') }}"
                                       class="font-medium text-primary-600 hover:text-primary-400">Return to Sign In</a>
                                </div>
                            </div>
                        </div>
                        <!-- END Sign Up Content -->

                        <!-- Footer -->
                    {{--                        <div class="text-sm text-gray-500 text- pt-20">--}}
                    {{--                            <a href="https://bawasoft.com" class="font-medium text-primary-600 hover:text-primary-400"--}}
                    {{--                               target="_blank">MimHRMS</a> by--}}
                    {{--                            <a href="https://bawasoft.com" class="font-medium text-primary-600 hover:text-primary-400"--}}
                    {{--                               target="_blank">Bawasoft</a>--}}
                    {{--                        </div>--}}
                    <!-- END Footer -->
                    </div>
                </div>
                <!-- END Sign Up Section -->
            </div>
        </main>
        <!-- END Page Content -->
    </div>
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-primary-500"></div>
    </div>
</x-guest-layout>
<style>
    /* Loading Overlay Styles */
    #loading-overlay {
        display: none;
        background-color: rgba(0, 0, 0, 0.5);
    }
</style>
<script>
    document.getElementById('SubmitForm').addEventListener('submit', function () {
        // Show the loading overlay when the form is submitted
        // document.getElementById('loading-overlay').classList.remove('hidden');
        document.getElementById('loading-overlay').style.display = 'flex';
    });

    // You can also hide the loading overlay when the page is fully loaded
    window.addEventListener('load', function () {
        document.getElementById('loading-overlay').classList.add('hidden');
    });
</script>
