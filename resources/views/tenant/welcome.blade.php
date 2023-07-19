<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title>fulfilment_by_mimsoft</title>

  <!-- Favicons -->
  <link rel="icon" href="favicon.svg" sizes="any" type="image/svg+xml">
  <link rel="icon" href="favicon.png" type="image/png">

  <!-- Inter web font from Bunny.net (GDPR compliant) -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  @vite(['resources/css/tailkit.css', 'resources/js/app.js'])
</head>
<body>
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
{{--                <a href=" {{ URL::route('jobs')}}" class="text-sm font-semibold text-gray-900 hover:text-primary-600 dark:text-gray-100 dark:hover:text-primary-500">--}}
{{--                  <span>Jobs</span>--}}
{{--                </a>--}}

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
    </main>
    <!-- END Page Content -->
  </div>
  <!-- END Page Container -->
</body>

</html>
