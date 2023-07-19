<!-- Page Sidebar -->
<aside
  id="page-sidebar"
  class="flex flex-col fixed top-0 left-0 bottom-0 w-full lg:w-72 pl-14 h-full lg:border-r bg-white z-50 transform transition-transform duration-500 ease-out"
  x-bind:class="{
    '-translate-x-full': !mobileSidebarOpen,
    'translate-x-0': mobileSidebarOpen,
    'lg:-translate-x-full': !desktopSidebarOpen,
    'lg:translate-x-0': desktopSidebarOpen,
  }"
  aria-label="Main Sidebar Navigation"
>
  <!-- Sidebar Mini -->
  @include('layouts.minibar')
  <!-- END Sidebar Mini -->

  <!-- Sidebar Content -->
  <div class="h-screen overflow-y-auto">
    <!-- Sidebar Header -->
    <div class="h-16 shadow-sm flex-none flex items-center justify-between lg:justify-center px-4 w-full">
      <h2 class="grow font-semibold text-sm">Welcome Admin</h2>

      <!-- Close Sidebar on Mobile -->
      <div class="flex-none lg:hidden">
        <button
          type="button"
          class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-transparent text-red-600 hover:text-red-400 focus:ring focus:ring-red-500 focus:ring-opacity-50 active:text-red-600"
          x-on:click="mobileSidebarOpen = false"
        >
          <svg class="hi-solid hi-x inline-block w-4 h-4 -mx-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
        </button>
      </div>
      <!-- END Close Sidebar on Mobile -->
    </div>
    <!-- END Sidebar Header -->

    <!-- Sidebar Navigation -->
    <nav class="p-4 w-full">
      <nav class="space-y-1">
        <a href="{{ URL::route('dashboard')}}"  class="flex items-center space-x-3 px-3 font-medium text-sm rounded text-gray-700 bg-gray-100">
          <span class="flex-none flex items-center opacity-50">
            <svg class="hi-outline hi-home inline-block w-5 h-5" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
          </span>
          <span class="py-2 grow">Dashboard</span>
          <span class="px-2 py-1 rounded-full text-xs font-medium leading-4 bg-opacity-10 text-gray-600 bg-gray-500">3</span>
        </a>
        <div class="px-3 pt-5 pb-2 text-xs font-semibold uppercase tracking-wider text-gray-400">Projects</div>
        <a href="{{ URL::route('manage')}}"  class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50">
          <span class="flex-none flex items-center opacity-50">
            <svg class="hi-outline hi-view-grid inline-block w-5 h-5" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
          </span>
          <span class="py-2 grow">Manage</span>
          <span class="px-2 py-1 rounded-full text-xs font-medium leading-4 bg-opacity-10 text-gray-600 bg-gray-500">99+</span>
        </a>
        <a href="{{ URL::route('task')}}"  class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50">
          <span class="flex-none flex items-center opacity-50">
            <svg class="hi-outline hi-clipboard-list inline-block w-5 h-5" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
          </span>
          <span class="py-2 grow">Tasks</span>
          <span class="px-2 py-1 rounded-full text-xs font-medium leading-4 bg-opacity-10 text-gray-600 bg-gray-500">9</span>
        </a>
        <a href="{{ URL::route('client')}}"  class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50">
          <span class="flex-none flex items-center opacity-50">
            <svg class="hi-outline hi-users inline-block w-5 h-5" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
          </span>
          <span class="py-2 grow">Clients</span>
          <span class="px-2 py-1 rounded-full text-xs font-medium leading-4 bg-opacity-10 text-gray-600 bg-gray-500">26</span>
        </a>
        <div class="px-3 pt-5 pb-2 text-xs font-semibold uppercase tracking-wider text-gray-400">Quick Actions</div>
        <a href="javascript:void(0)" class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50">
          <span class="flex-none flex items-center opacity-50">
            <svg class="hi-outline hi-plus-circle inline-block w-5 h-5" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </span>
          <span class="py-2 grow">New Project</span>
        </a>
        <a href="javascript:void(0)" class="flex items-center space-x-3 px-3 font-medium rounded text-gray-600 text-sm hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50">
          <span class="flex-none flex items-center opacity-50">
            <svg class="hi-outline hi-user-add inline-block w-5 h-5" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
          </span>
          <span class="py-2 grow">New Client</span>
        </a>
      </nav>
    </nav>
    <!-- END Sidebar Navigation -->
  </div>
  <!-- END Sidebar Content -->
</aside>
<!-- Page Sidebar -->
