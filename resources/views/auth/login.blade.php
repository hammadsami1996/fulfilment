<x-guest-layout>
    <div id="loading-image" class="loading-image">
        <img src="/images/inventory_2.gif" alt="Loading Image">
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

<!-- Page Container -->

    <!-- Page Content -->
    <main id="page-content" class="flex flex-auto flex-col max-w-full">
      <div class="min-h-screen flex flex-col bg-cover bg-bottom" style="background-image: url('https://cdn.tailkit.com/media/placeholders/photo-wQLAGv4_OYs-1920x1200.jpg');">
        <!-- Sign In Section -->
        <div class="flex grow md:w-8/12 lg:w-5/12 xl:w-4/12 bg-white shadow-xl">
          <div class="flex flex-col p-8 lg:p-16 xl:p-20 w-full">
            <!-- Sign In Content -->
            <div class="grow flex items-center">
              <div class="w-full max-w-lg mx-auto space-y-10">
                <!-- Header -->
                <div>
                  <h1 class="text-4xl font-bold inline-flex items-center mb-1 space-x-3">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="text-primary-500 hi-solid hi-cube-transparent inline-block w-8 h-8"><path fill-rule="evenodd" d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z" clip-rule="evenodd"></path></svg>
                    <span>Fulfilment By Mimsoft</span>
                  </h1>
                  <p class="text-gray-500">
                    Welcome, please sign in to your userID and Password
                  </p>
                </div>
                <!-- END Header -->

                <!-- Sign In Form -->

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                  <div class="space-y-1">
                    <label for="email" class="font-medium">Email</label>
                    <input class="block border placeholder-gray-400 px-5 py-3 leading-6 w-full rounded border-gray-200 focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" type="email" id="email" name="email" placeholder="Enter your email">
                  </div>
                  <div class="space-y-1">
                    <label for="password" class="font-medium">Password</label>
                    <input class="block border placeholder-gray-400 px-5 py-3 leading-6 w-full rounded border-gray-200 focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" type="password" id="password" name="password" placeholder="Enter your password">
                  </div>
                  <div>
                    <button type="submit" class="bg-indigo inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-full px-4 py-3 leading-6 rounded border-primary-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-primary-700 active:border-primary-700">
                      Sign In
                    </button>
                    <div class="space-y-2 sm:flex sm:items-center sm:justify-between sm:space-x-2 sm:space-y-0 mt-4">
                      <label class="flex items-center">
                        <input type="checkbox" id="remember_me" name="remember_me" class="border border-gray-300 rounded h-4 w-4 text-primary-500 focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
                        <span class="ml-2">
                          Remember me
                        </span>
                      </label>
                      <a href="javascript:void(0)" class="font-medium inline-block text-primary-600 hover:text-primary-400">Forgot Password?</a>
                    </div>
                  </div>

                </form>
                <!-- END Sign In Form -->

{{--                <div class="text-sm text-gray-500">--}}
{{--                  Don’t have an account yet?--}}
{{--                  <a href="javascript:void(0)" class="font-medium text-primary-600 hover:text-primary-400">Join us today by Registering</a>--}}
{{--                </div>--}}
              </div>
            </div>
            <!-- END Sign In Content -->

            <!-- Footer -->
{{--            <div class="text-sm text-gray-500 text- pt-20">--}}
{{--              <a href="https://bawasoft.com" class="font-medium text-primary-600 hover:text-primary-400" target="_blank">MimHRMS</a> by--}}
{{--              <a href="https://bawasoft.com" class="font-medium text-primary-600 hover:text-primary-400" target="_blank">Bawasoft</a>--}}
{{--            </div>--}}
            <!-- END Footer -->
          </div>
        </div>
        <!-- END Sign In Section -->
      </div>
    </main>
    <!-- END Page Content -->

  <!-- END Page Container -->
</x-guest-layout>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const loadingImage = document.getElementById("loading-image");
        const fadeDelay = 4500; // 4 seconds

        setTimeout(function () {
            loadingImage.remove();
        }, fadeDelay);
    });
</script>
<style>

    .loading-image {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;



        height: 100vh;
        background-color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 1;
        transition: opacity 1s ease-in-out;
        z-index: 9999;
        animation: slideOut 4s linear forwards;
    }

    .loading-image img {
        max-width: 100%;
        max-height: 100%;
    }

    .loading-image.fade-out {
        opacity: 0;
    }

    /* @keyframes slideOut {
        0% {
            opacity: 1;
            transform: translateX(0);
        }
        100% {
            opacity: 0;
            transform: translateX(100%);
        }
      } */


</style>
