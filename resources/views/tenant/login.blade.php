<x-guest-layout>
  <div id="loading-image" class="loading-image">
      <img src="/images/inventory_2.gif" alt="Loading Image">
  </div>
<!-- Page Container -->
<div id="page-container" class="flex flex-col mx-auto w-full min-h-screen bg-gray-100">
    <!-- Page Content -->
    <main id="page-content" class="flex flex-auto flex-col max-w-full">
        <div class="min-h-screen flex items-center justify-center relative overflow-hidden max-w-10xl mx-auto p-4 lg:p-8 w-full">
            <!-- Patterns Background -->
            <div class="pattern-dots-md text-gray-300 absolute top-0 right-0 w-32 h-32 lg:w-48 lg:h-48 transform translate-x-16 translate-y-16"></div>
            <div class="pattern-dots-md text-gray-300 absolute bottom-0 left-0 w-32 h-32 lg:w-48 lg:h-48 transform -translate-x-16 -translate-y-16"></div>
            <!-- END Patterns Background -->

            <!-- Sign In Section -->
            <div class="py-6 lg:py-0 w-full md:w-8/12 lg:w-6/12 xl:w-4/12 relative">
                <!-- Header -->
                <div class="mb-5 text-center" >
                    <h1 class="text-4xl font-bold inline-flex items-center mb-1 space-x-3">
{{--                        <svg class="hi-solid hi-cube-transparent inline-block w-8 h-8 text-primary-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z" clip-rule="evenodd"/></svg>--}}
                        <span class="uppercase"> {{$data}}</span>
                    </h1>
                    <p class="text-gray-500">
                        Welcome, please sign in to your dashboard
                    </p>
                </div>
                <!-- END Header -->

                <!-- Sign In Form -->
                <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
                    <div class="p-5 lg:p-6 grow w-full">
                        <div class="sm:p-5 lg:px-10 lg:py-8">
                            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                                @csrf
                                <div class="space-y-1">
                                    <label for="email" class="font-medium">Email</label>
                                    <input class="block border border-gray-200 rounded px-5 py-3 h-10 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" type="email" id="email" name="email" placeholder="Enter your email">
                                </div>
                                <div class="space-y-1">
                                    <label for="password" class="font-medium">Password</label>
                                    <input class="block border border-gray-200 rounded px-5 py-3 h-10 leading-6 w-full focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" type="password" id="password" name="password" placeholder="Enter your password">
                                </div>
                                <div>
                                    <button  type="submit" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-full px-4 py-3 leading-6 rounded border-gray-200 bg-gray-800 text-white hover:text-white hover:bg-gray-900 hover:border-gray-300 focus:ring focus:ring-primary-500 focus:ring-opacity-50 active:bg-gray-900 active:border-white">
                                        Sign In
                                    </button>
                                    <div class="space-y-2 sm:flex sm:items-center sm:justify-between sm:space-x-2 sm:space-y-0 mt-4">
                                        <label class="flex items-center">
                                            <input type="checkbox" id="remember_me" name="remember_me" class="border border-gray-200 rounded h-4 w-4 text-primary-500 focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
                                            <span class="ml-2">
                        Remember me
                      </span>
                                        </label>
                                        <a href="javascript:void(0)" class="inline-block text-primary-600 hover:text-primary-400">Forgot Password?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="py-4 px-5 lg:px-6 w-full text-sm text-center bg-gray-50">
                        Don’t have an account yet?
                        <a class="font-medium text-primary-600 hover:text-primary-400" href="{{ URL::route('register')}}">Register</a>
                    </div>
                </div>
                <!-- END Sign In Form -->

                <!-- Footer -->
{{--                <div class="text-sm text-gray-500 text-center mt-6">--}}
{{--                    <a class="font-medium text-primary-600 hover:text-primary-400" href="https://tailkit.com" target="_blank">Mimsoft</a> by <a class="font-medium text-primary-600 hover:text-primary-400" href="https://pixelcave.com" target="_blank">pixelcave</a>--}}
{{--                </div>--}}
                <!-- END Footer -->
            </div>
            <!-- END Sign In Section -->
        </div>
    </main>
    <!-- END Page Content -->
</div>
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

