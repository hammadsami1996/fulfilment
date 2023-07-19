<x-guest-layout>
    <!-- Pricing Section: With Features -->
    <div class="bg-white">
        <div class="space-y-10 container xl:max-w-7xl mx-auto px-4 py-16 lg:px-8 lg:py-32">
            <!-- Heading -->
            <div class="text-center">
                <div class="text-sm uppercase font-bold tracking-wider mb-1 text-primary-700">
                    Affordable plans
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">
                    Get the best value
                </h2>
                <h3 class="text-lg md:text-xl md:leading-relaxed font-medium text-gray-600 lg:w-2/3 mx-auto">
                    Get to know our premium solutions and get your start up off the ground in no time. Inspiring results
                    from the first days.
                </h3>
            </div>
            <!-- END Heading -->

            <!-- Payment Preference -->
{{--            <div class="text-center">--}}
{{--                <div class="inline-flex space-x-2 items-center">--}}
{{--                    <button type="button"--}}
{{--                            class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-transparent text-gray-600 hover:text-gray-400 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:text-gray-600">--}}
{{--                        Monthly--}}
{{--                    </button>--}}
{{--                    <span class="inline-block w-14 h-10 bg-gray-100  rounded-full relative"><span class="w-5 bg-blue-400 absolute top-0 bottom-0  rounded-full right-0"></span></span>--}}

{{--                    <button type="button"--}}
{{--                            class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-transparent text-primary-600 hover:text-primary-400 focus:ring focus:ring-primary-500 focus:ring-opacity-50 active:text-primary-600">--}}
{{--                        Yearly--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- END Payment Preference -->

            <!-- Pricing Plans -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-8">
                <!-- Solo Plan -->
                @foreach($data as $item)
                    <div
                        class="rounded-lg shadow-sm bg-gray-100 flex flex-col border-2 border-gray-200 hover:border-gray-300">
                        <div class="p-5 lg:p-6 text-center bg-white rounded-t-lg">
          <span
              class="inline-block text-sm uppercase tracking-wider font-semibold px-3 py-1 bg-primary-200 bg-opacity-50 text-primary-600 rounded-full mb-4">
            {{$item->name}}
          </span>
                            <div class="mb-1">
                                <span class="text-3xl lg:text-4xl font-extrabold">${{$item->price}}</span> <span
                                    class="text-gray-700 font-semibold">/year</span>
                            </div>
                            <p class="text-gray-600 text-sm font-medium">
                                For solo developers
                            </p>
                        </div>
{{--                        <div class="p-5 lg:p-6 space-y-5 lg:space-y-6 text-gray-700 grow">--}}
{{--                            <ul class="space-y-4 text-sm lg:text-base">--}}
{{--                                <li class="flex items-center space-x-2">--}}
{{--                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                         class="text-emerald-500 hi-solid hi-check inline-block w-5 h-5">--}}
{{--                                        <path fill-rule="evenodd"--}}
{{--                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"--}}
{{--                                              clip-rule="evenodd"></path>--}}
{{--                                    </svg>--}}
{{--                                    <span><strong>100</strong> Custom Projects</span>--}}
{{--                                </li>--}}
{{--                                <li class="flex items-center space-x-2">--}}
{{--                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                         class="text-emerald-500 hi-solid hi-check inline-block w-5 h-5">--}}
{{--                                        <path fill-rule="evenodd"--}}
{{--                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"--}}
{{--                                              clip-rule="evenodd"></path>--}}
{{--                                    </svg>--}}
{{--                                    <span><strong>50</strong> Paying Clients</span>--}}
{{--                                </li>--}}
{{--                                <li class="flex items-center space-x-2">--}}
{{--                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                         class="text-emerald-500 hi-solid hi-check inline-block w-5 h-5">--}}
{{--                                        <path fill-rule="evenodd"--}}
{{--                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"--}}
{{--                                              clip-rule="evenodd"></path>--}}
{{--                                    </svg>--}}
{{--                                    <span><strong>10GB</strong> SSD Storage</span>--}}
{{--                                </li>--}}
{{--                                <li class="flex items-center space-x-2">--}}
{{--                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                         class="text-emerald-500 hi-solid hi-check inline-block w-5 h-5">--}}
{{--                                        <path fill-rule="evenodd"--}}
{{--                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"--}}
{{--                                              clip-rule="evenodd"></path>--}}
{{--                                    </svg>--}}
{{--                                    <span><strong>1TB</strong> Bandwidth</span>--}}
{{--                                </li>--}}
{{--                                <li class="flex items-center space-x-2">--}}
{{--                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                         class="text-emerald-500 hi-solid hi-check inline-block w-5 h-5">--}}
{{--                                        <path fill-rule="evenodd"--}}
{{--                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"--}}
{{--                                              clip-rule="evenodd"></path>--}}
{{--                                    </svg>--}}
{{--                                    <span><strong>24/7</strong> Email Support</span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                        <div class="px-5 pb-5 lg:px-6 lg:pb-6">
                            <a href="{{ URL::route('register')}}"
                               class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-full px-4 py-3 leading-6 rounded border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-gray-700 active:border-gray-700">
                                Get Start
                            </a>
                        </div>
                    </div>
            @endforeach
            <!-- END Solo Plan -->
            </div>
            <!-- END Pricing Plans -->
        </div>
    </div>
    <!-- END Pricing Section: With Features -->
</x-guest-layout>
