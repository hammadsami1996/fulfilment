<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title>Fulfilment By Mimsoft</title>

  <!-- Favicons -->
  <link rel="icon" href="favicon.svg" sizes="any" type="image/svg+xml">
  <link rel="icon" href="favicon.png" type="image/png">

  <!-- Inter web font from Bunny.net (GDPR compliant) -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  @vite(['resources/css/tailkit.css', 'resources/js/app.js'])
</head>

<body>
  <!--

  ADD YOUR CONTENT BELOW

  -->

<!-- Page Container -->
<div id="page-container" class="flex flex-col mx-auto w-full min-w-[320px] min-h-screen bg-gray-100 dark:text-gray-100 dark:bg-gray-900">
    <!-- Page Content -->
    <main id="page-content" class="flex flex-auto flex-col max-w-full">
      <!-- Hero -->
      <div class="bg-white dark:text-gray-100 dark:bg-gray-900">
        <!-- Header -->
        <header id="page-header" class="flex flex-none items-center py-10">
          <div class="flex flex-col text-center md:flex-row md:items-center md:justify-between space-y-6 md:space-y-0 container xl:max-w-7xl mx-auto px-4 lg:px-8">
            <div>
              <a href="javascript:void(0)" class="group inline-flex items-center space-x-2 font-bold text-lg tracking-wide text-gray-800 hover:text-primary-600 dark:text-gray-200 dark:hover:text-primary-500">
                <svg stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="hi-outline hi-cube-transparent inline-block w-6 h-6 text-primary-600 dark:text-primary-500"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                <span>Fulfilment By Mimsoft</span>
              </a>
            </div>
            <div class="flex flex-col text-center md:flex-row md:items-center md:justify-between space-y-6 md:space-y-0 md:space-x-10">
              <nav class="space-x-4 md:space-x-6">
                <a href=" {{ URL::route('plan')}}" class="text-sm font-semibold text-gray-900 hover:text-primary-600 dark:text-gray-100 dark:hover:text-primary-500">
                  <span>Plans</span>
                </a>
                <a href="{{ URL::route('register')}}" class="text-sm font-semibold text-gray-900 hover:text-primary-600 dark:text-gray-100 dark:hover:text-primary-500">
                    <span>Register</span>
                  </a>
              </nav>
              <div class="flex items-center justify-center space-x-2">
                <a  href="{{ URL::route('login')}}" class="inline-flex justify-center items-center space-x-1 border font-semibold focus:outline-none rounded px-3 py-2 leading-5 text-sm border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:border-gray-600 dark:focus:ring-gray-600/50 dark:active:border-gray-700">
                  <span>Sign In</span>
                  <svg class="opacity-50 hi-mini hi-arrow-right inline-block w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd"/></svg>
                </a>
              </div>
            </div>
          </div>
        </header>
        <!-- END Header -->
      </div>
      <!-- END Hero -->



      <!-- Section -->


      <!-- Footer -->
      <footer id="page-footer" class="bg-white dark:text-gray-100 dark:bg-gray-900">
        <div class="container xl:max-w-7xl mx-auto px-4 py-16 lg:px-8 lg:py-32">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="space-y-6">
              <h4 class="text-sm uppercase font-semibold tracking-wider text-gray-400 dark:text-gray-500">
                Products
              </h4>
              <nav class="flex flex-col space-y-3">
                <a href="javascript:void(0)" class="text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-500">
                  Solutions
                </a>
                <a href="javascript:void(0)" class="text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-500">
                  Features
                </a>
                <a href="javascript:void(0)" class="text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-500">
                  Pricing Plans
                </a>
                <a href="javascript:void(0)" class="text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-500">
                  Analytics
                </a>
                <a href="javascript:void(0)" class="text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-500">
                  Support Center
                </a>
              </nav>
            </div>
            <div class="space-y-6">
              <h4 class="text-sm uppercase font-semibold tracking-wider text-gray-400 dark:text-gray-500">
                Legal
              </h4>
              <nav class="flex flex-col space-y-3">
                <a href="javascript:void(0)" class="text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-500">
                  Team
                </a>
                <a href="javascript:void(0)" class="text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-500">
                  Terms of Service
                </a>
                <a href="javascript:void(0)" class="text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-500">
                  Privacy Policy
                </a>
                <a href="javascript:void(0)" class="text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-500">
                  Cookies
                </a>
                <a href="javascript:void(0)" class="text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-500">
                  Refunds
                </a>
              </nav>
            </div>
            <div class="space-y-6">
              <h4 class="text-sm uppercase font-semibold tracking-wider text-gray-400 dark:text-gray-500">
               Mimsoft
              </h4>
              <div class="text-sm leading-relaxed">
                  Shaheen Center, Suite# 302-303, 3rd Floor, Zone C Block 7 Clifton, Karachi, Karachi City, Sindh
              </div>
              <h4 class="text-sm uppercase font-semibold tracking-wider text-gray-400 dark:text-gray-500">
                Join Our Newsletter
              </h4>
              <form onsubmit="return false;" class="space-y-3 sm:space-y-0 sm:flex sm:items-center sm:space-x-2">
                <div class="sm:grow">
                  <label for="email" class="sr-only">Email</label>
                  <input class="block border placeholder-gray-400 py-2 leading-5 text-sm w-full rounded border-gray-200 focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-primary-500" type="email" id="email" name="email" placeholder="Email">
                </div>
                <button type="submit" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-primary-700 bg-primary-700 text-white hover:text-white hover:bg-primary-800 hover:border-primary-800 focus:ring focus:ring-primary-500 focus:ring-opacity-50 active:bg-primary-700 active:border-primary-700">
                  Subscribe
                </button>
              </form>
            </div>
          </div>
          <hr class="my-10 dark:border-gray-800">
          <div class="flex flex-col md:flex-row-reverse md:justify-between space-y-6 md:space-y-0 text-center md:text-left text-sm">
            <nav class="space-x-4">
              <a href="javascript:void(0)" class="text-gray-400 hover:text-[#1da1f2]">
                <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="icon-twitter inline-block w-5 h-5"><path d="M24 4.557a9.83 9.83 0 01-2.828.775 4.932 4.932 0 002.165-2.724 9.864 9.864 0 01-3.127 1.195 4.916 4.916 0 00-3.594-1.555c-3.179 0-5.515 2.966-4.797 6.045A13.978 13.978 0 011.671 3.149a4.93 4.93 0 001.523 6.574 4.903 4.903 0 01-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.935 4.935 0 01-2.224.084 4.928 4.928 0 004.6 3.419A9.9 9.9 0 010 19.54a13.94 13.94 0 007.548 2.212c9.142 0 14.307-7.721 13.995-14.646A10.025 10.025 0 0024 4.557z"></path></svg>
              </a>
              <a href="javascript:void(0)" class="text-gray-400 hover:text-[#1877f2]">
                <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="icon-facebook inline-block w-5 h-5"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.378 14.192 5 15.115 5H18V0h-3.808C10.596 0 9 1.583 9 4.615V8z"></path></svg>
              </a>
              <a href="javascript:void(0)" class="text-gray-400 hover:text-[#405de6]">
                <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="icon-instagram inline-block w-5 h-5"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"></path></svg>
              </a>
              <a href="javascript:void(0)" class="text-gray-400 hover:text-[#333]">
                <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="icon-github inline-block w-5 h-5"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"></path></svg>
              </a>
              <a href="javascript:void(0)" class="text-gray-400 hover:text-[#ea4c89]">
                <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="icon-github inline-block w-5 h-5"><path d="M12 0C5.372 0 0 5.373 0 12s5.372 12 12 12 12-5.373 12-12S18.628 0 12 0zm9.885 11.441c-2.575-.422-4.943-.445-7.103-.073a42.153 42.153 0 00-.767-1.68c2.31-1 4.165-2.358 5.548-4.082a9.863 9.863 0 012.322 5.835zm-3.842-7.282c-1.205 1.554-2.868 2.783-4.986 3.68a46.287 46.287 0 00-3.488-5.438A9.894 9.894 0 0112 2.087c2.275 0 4.368.779 6.043 2.072zM7.527 3.166a44.59 44.59 0 013.537 5.381c-2.43.715-5.331 1.082-8.684 1.105a9.931 9.931 0 015.147-6.486zM2.087 12l.013-.256c3.849-.005 7.169-.448 9.95-1.322.233.475.456.952.67 1.432-3.38 1.057-6.165 3.222-8.337 6.48A9.865 9.865 0 012.087 12zm3.829 7.81c1.969-3.088 4.482-5.098 7.598-6.027a39.137 39.137 0 012.043 7.46c-3.349 1.291-6.953.666-9.641-1.433zm11.586.43a41.098 41.098 0 00-1.92-6.897c1.876-.265 3.94-.196 6.199.196a9.923 9.923 0 01-4.279 6.701z"></path></svg>
              </a>
            </nav>
            <div class="text-gray-500">
              <span class="font-medium">Mimsoft</span> ©
            </div>
          </div>
        </div>
      </footer>
      <!-- END Footer -->
    </main>
    <!-- END Page Content -->
  </div>
  <!-- END Page Container -->
</body>

</html>
