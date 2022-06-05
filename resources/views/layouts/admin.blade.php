<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Gobanan') }}</title>


        {{--  Icon  --}}
        <link rel="icon" href="{{ url('image/logo/go.png') }}">

        {{-- Tailwind CSS --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        {{-- Font Awesome --}}
        <link rel="stylesheet" href=" {{mix ('css/style.css')}}">

        {{-- Self-made Styling --}}
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ asset('js/index.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    </head>
    <body class="font-sans antialiased" onload="load()">
        <div class="h-screen flex overflow-hidden bg-gray-100">
            <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
            <div class="fixed inset-0 flex z-40 md:hidden" role="dialog" aria-modal="true">
              <!--
                Off-canvas menu overlay, show/hide based on off-canvas menu state.

                Entering: "transition-opacity ease-linear duration-300"
                  From: "opacity-0"
                  To: "opacity-100"
                Leaving: "transition-opacity ease-linear duration-300"
                  From: "opacity-100"
                  To: "opacity-0"
              -->
              <div id="overlay" class="fixed inset-0 bg-gray-600 bg-opacity-75 transition-opacity ease-linear duration-300" aria-hidden="true"></div>

              <!--
                Off-canvas menu, show/hide based on off-canvas menu state.

                Entering: "transition ease-in-out duration-300 transform"
                  From: "-translate-x-full"
                  To: "translate-x-0"
                Leaving: "transition ease-in-out duration-300 transform"
                  From: "translate-x-0"
                  To: "-translate-x-full"
              -->
              <div id="side-menu" class="transition ease-in-out duration-300 transform relative flex-1 flex flex-col max-w-xs w-full bg-ocean-green">
                <!--
                  Close button, show/hide based on off-canvas menu state.

                  Entering: "ease-in-out duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                  Leaving: "ease-in-out duration-300"
                    From: "opacity-100"
                    To: "opacity-0"
                -->
                <div class="ease-in-out duration-300 absolute top-0 right-0 -mr-12 pt-2">
                  <button id="close-btn" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                    <span class="sr-only">Close sidebar</span>
                    <!-- Heroicon name: outline/x -->
                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </div>

                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                  <div class="flex-shrink-0 flex items-center px-4">
                    <img class="h-8 w-auto" src="{{ url('image/logo/go.png') }}" alt="Workflow">
                    <span class="ml-4 font-bold text-xl text-white">Gobanan</span>
                  </div>
                  <nav class="mt-5 px-2 space-y-1">
                    <!-- Current: "bg-ocean-green text-white", Default: "text-white hover:bg-keppel hover:bg-opacity-75" -->
                    <a href="{{route('admin-dashboard')}}" class="bg-ocean-green hover:bg-keppel hover:bg-opacity-75 text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/home -->
                        <svg class="mr-3 h-6 w-6 text-white invert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6H511.8L512.5 447.7C512.5 450.5 512.3 453.1 512 455.8V472C512 494.1 494.1 512 472 512H456C454.9 512 453.8 511.1 452.7 511.9C451.3 511.1 449.9 512 448.5 512H392C369.9 512 352 494.1 352 472V384C352 366.3 337.7 352 320 352H256C238.3 352 224 366.3 224 384V472C224 494.1 206.1 512 184 512H128.1C126.6 512 125.1 511.9 123.6 511.8C122.4 511.9 121.2 512 120 512H104C81.91 512 64 494.1 64 472V360C64 359.1 64.03 358.1 64.09 357.2V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5L575.8 255.5z"/></svg>
                        Dashboard
                      </a>

                      <a href="{{route('admin-category')}}" class="text-white hover:bg-keppel hover:bg-opacity-75 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/users -->
                        {{-- <svg class="mr-3 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg> --}}
                        <svg class="mr-3 h-6 w-6 text-white invert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M128 184C128 206.1 110.1 224 88 224H40C17.91 224 0 206.1 0 184V136C0 113.9 17.91 96 40 96H88C110.1 96 128 113.9 128 136V184zM128 376C128 398.1 110.1 416 88 416H40C17.91 416 0 398.1 0 376V328C0 305.9 17.91 288 40 288H88C110.1 288 128 305.9 128 328V376zM160 136C160 113.9 177.9 96 200 96H248C270.1 96 288 113.9 288 136V184C288 206.1 270.1 224 248 224H200C177.9 224 160 206.1 160 184V136zM288 376C288 398.1 270.1 416 248 416H200C177.9 416 160 398.1 160 376V328C160 305.9 177.9 288 200 288H248C270.1 288 288 305.9 288 328V376zM320 136C320 113.9 337.9 96 360 96H408C430.1 96 448 113.9 448 136V184C448 206.1 430.1 224 408 224H360C337.9 224 320 206.1 320 184V136zM448 376C448 398.1 430.1 416 408 416H360C337.9 416 320 398.1 320 376V328C320 305.9 337.9 288 360 288H408C430.1 288 448 305.9 448 328V376z"/></svg>
                        Category
                      </a>

                      <a href="{{route('admin-review')}}" class="text-white hover:bg-keppel hover:bg-opacity-75 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/folder -->
                        <svg class="mr-3 h-6 w-6 text-white invert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M128 447.1V223.1c0-17.67-14.33-31.1-32-31.1H32c-17.67 0-32 14.33-32 31.1v223.1c0 17.67 14.33 31.1 32 31.1h64C113.7 479.1 128 465.6 128 447.1zM512 224.1c0-26.5-21.48-47.98-48-47.98h-146.5c22.77-37.91 34.52-80.88 34.52-96.02C352 56.52 333.5 32 302.5 32c-63.13 0-26.36 76.15-108.2 141.6L178 186.6C166.2 196.1 160.2 210 160.1 224c-.0234 .0234 0 0 0 0L160 384c0 15.1 7.113 29.33 19.2 38.39l34.14 25.59C241 468.8 274.7 480 309.3 480H368c26.52 0 48-21.47 48-47.98c0-3.635-.4805-7.143-1.246-10.55C434 415.2 448 397.4 448 376c0-9.148-2.697-17.61-7.139-24.88C463.1 347 480 327.5 480 304.1c0-12.5-4.893-23.78-12.72-32.32C492.2 270.1 512 249.5 512 224.1z"/></svg>
                        Review
                      </a>

                      <a href="{{route('admin-service')}}" class="text-white hover:bg-keppel hover:bg-opacity-75 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/calendar -->
                        <svg class="mr-3 h-6 w-6 text-white invert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M352 128C352 198.7 294.7 256 224 256C153.3 256 96 198.7 96 128C96 57.31 153.3 0 224 0C294.7 0 352 57.31 352 128zM209.1 359.2L176 304H272L238.9 359.2L272.2 483.1L311.7 321.9C388.9 333.9 448 400.7 448 481.3C448 498.2 434.2 512 417.3 512H30.72C13.75 512 0 498.2 0 481.3C0 400.7 59.09 333.9 136.3 321.9L175.8 483.1L209.1 359.2z"/></svg>
                        Service
                      </a>

                      <a href="{{route('admin-transaction')}}" class="text-white hover:bg-keppel hover:bg-opacity-75 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/chart-bar -->
                        <svg class="mr-3 h-6 w-6 text-white invert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M13.97 2.196C22.49-1.72 32.5-.3214 39.62 5.778L80 40.39L120.4 5.778C129.4-1.926 142.6-1.926 151.6 5.778L192 40.39L232.4 5.778C241.4-1.926 254.6-1.926 263.6 5.778L304 40.39L344.4 5.778C351.5-.3214 361.5-1.72 370 2.196C378.5 6.113 384 14.63 384 24V488C384 497.4 378.5 505.9 370 509.8C361.5 513.7 351.5 512.3 344.4 506.2L304 471.6L263.6 506.2C254.6 513.9 241.4 513.9 232.4 506.2L192 471.6L151.6 506.2C142.6 513.9 129.4 513.9 120.4 506.2L80 471.6L39.62 506.2C32.5 512.3 22.49 513.7 13.97 509.8C5.456 505.9 0 497.4 0 488V24C0 14.63 5.456 6.112 13.97 2.196V2.196zM96 144C87.16 144 80 151.2 80 160C80 168.8 87.16 176 96 176H288C296.8 176 304 168.8 304 160C304 151.2 296.8 144 288 144H96zM96 368H288C296.8 368 304 360.8 304 352C304 343.2 296.8 336 288 336H96C87.16 336 80 343.2 80 352C80 360.8 87.16 368 96 368zM96 240C87.16 240 80 247.2 80 256C80 264.8 87.16 272 96 272H288C296.8 272 304 264.8 304 256C304 247.2 296.8 240 288 240H96z"/></svg>
                        Transaction
                      </a>

                      <a href="{{route('admin-user')}}" class="text-white hover:bg-keppel hover:bg-opacity-75 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/inbox -->
                        <svg class="mr-3 h-6 w-6 text-white invert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"/></svg>
                        User
                      </a>

                      <a href="{{route('dashboard')}}" class="text-white hover:bg-keppel hover:bg-opacity-75 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/chart-bar -->
                        <svg class="mr-3 h-6 w-6 text-white invert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M160 416H96c-17.67 0-32-14.33-32-32V128c0-17.67 14.33-32 32-32h64c17.67 0 32-14.33 32-32S177.7 32 160 32H96C42.98 32 0 74.98 0 128v256c0 53.02 42.98 96 96 96h64c17.67 0 32-14.33 32-32S177.7 416 160 416zM502.6 233.4l-128-128c-12.51-12.51-32.76-12.49-45.25 0c-12.5 12.5-12.5 32.75 0 45.25L402.8 224H192C174.3 224 160 238.3 160 256s14.31 32 32 32h210.8l-73.38 73.38c-12.5 12.5-12.5 32.75 0 45.25s32.75 12.5 45.25 0l128-128C515.1 266.1 515.1 245.9 502.6 233.4z"/></svg>
                        Exit
                      </a>
                  </nav>
                </div>
                <div class="flex-shrink-0 flex border-t border-keppel p-4">
                  <a href="{{route('profile.show')}}" class="flex-shrink-0 group block">
                    <div class="flex items-center">
                      <div class="bg-white rounded-full">
                        <img class="inline-block h-10 w-10 rounded-full" src="{{Storage::url(Auth::user()->picture)}}" alt="">
                      </div>
                      <div class="ml-3">
                        <p class="text-base font-medium text-white">
                          {{Auth::user()->name}}
                        </p>
                        <p class="text-sm font-medium text-white">
                          View profile
                        </p>
                      </div>
                    </div>
                  </a>
                </div>
              </div>

              <div class="flex-shrink-0 w-14" aria-hidden="true">
                <!-- Force sidebar to shrink to fit close icon -->
              </div>
            </div>

            <!-- Static sidebar for desktop -->
            <div class="hidden bg-ocean-green md:flex md:flex-shrink-0">
              <div class="flex flex-col w-64">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div class="flex flex-col h-0 flex-1">
                  <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                      <img class="h-8 w-auto" src="{{ url('image/logo/go.png') }}" alt="Workflow">
                      <span class="ml-4 font-bold text-xl text-white">Gobanan</span>
                    </div>
                    <nav class="mt-5 flex-1 px-2 space-y-1">
                      <!-- Current: "bg-ocean-green text-white", Default: "text-white hover:bg-keppel hover:bg-opacity-75" -->
                      <a href="{{route('admin-dashboard')}}" class="bg-ocean-green hover:bg-keppel hover:bg-opacity-75 text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/home -->
                        <svg class="mr-3 h-6 w-6 text-white invert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6H511.8L512.5 447.7C512.5 450.5 512.3 453.1 512 455.8V472C512 494.1 494.1 512 472 512H456C454.9 512 453.8 511.1 452.7 511.9C451.3 511.1 449.9 512 448.5 512H392C369.9 512 352 494.1 352 472V384C352 366.3 337.7 352 320 352H256C238.3 352 224 366.3 224 384V472C224 494.1 206.1 512 184 512H128.1C126.6 512 125.1 511.9 123.6 511.8C122.4 511.9 121.2 512 120 512H104C81.91 512 64 494.1 64 472V360C64 359.1 64.03 358.1 64.09 357.2V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5L575.8 255.5z"/></svg>
                        Dashboard
                      </a>

                      <a href="{{route('admin-category')}}" class="text-white hover:bg-keppel hover:bg-opacity-75 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/users -->
                        {{-- <svg class="mr-3 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg> --}}
                        <svg class="mr-3 h-6 w-6 text-white invert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M128 184C128 206.1 110.1 224 88 224H40C17.91 224 0 206.1 0 184V136C0 113.9 17.91 96 40 96H88C110.1 96 128 113.9 128 136V184zM128 376C128 398.1 110.1 416 88 416H40C17.91 416 0 398.1 0 376V328C0 305.9 17.91 288 40 288H88C110.1 288 128 305.9 128 328V376zM160 136C160 113.9 177.9 96 200 96H248C270.1 96 288 113.9 288 136V184C288 206.1 270.1 224 248 224H200C177.9 224 160 206.1 160 184V136zM288 376C288 398.1 270.1 416 248 416H200C177.9 416 160 398.1 160 376V328C160 305.9 177.9 288 200 288H248C270.1 288 288 305.9 288 328V376zM320 136C320 113.9 337.9 96 360 96H408C430.1 96 448 113.9 448 136V184C448 206.1 430.1 224 408 224H360C337.9 224 320 206.1 320 184V136zM448 376C448 398.1 430.1 416 408 416H360C337.9 416 320 398.1 320 376V328C320 305.9 337.9 288 360 288H408C430.1 288 448 305.9 448 328V376z"/></svg>
                        Category
                      </a>

                      <a href="{{route('admin-review')}}" class="text-white hover:bg-keppel hover:bg-opacity-75 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/folder -->
                        <svg class="mr-3 h-6 w-6 text-white invert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M128 447.1V223.1c0-17.67-14.33-31.1-32-31.1H32c-17.67 0-32 14.33-32 31.1v223.1c0 17.67 14.33 31.1 32 31.1h64C113.7 479.1 128 465.6 128 447.1zM512 224.1c0-26.5-21.48-47.98-48-47.98h-146.5c22.77-37.91 34.52-80.88 34.52-96.02C352 56.52 333.5 32 302.5 32c-63.13 0-26.36 76.15-108.2 141.6L178 186.6C166.2 196.1 160.2 210 160.1 224c-.0234 .0234 0 0 0 0L160 384c0 15.1 7.113 29.33 19.2 38.39l34.14 25.59C241 468.8 274.7 480 309.3 480H368c26.52 0 48-21.47 48-47.98c0-3.635-.4805-7.143-1.246-10.55C434 415.2 448 397.4 448 376c0-9.148-2.697-17.61-7.139-24.88C463.1 347 480 327.5 480 304.1c0-12.5-4.893-23.78-12.72-32.32C492.2 270.1 512 249.5 512 224.1z"/></svg>
                        Review
                      </a>

                      <a href="{{route('admin-service')}}" class="text-white hover:bg-keppel hover:bg-opacity-75 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/calendar -->
                        <svg class="mr-3 h-6 w-6 text-white invert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M352 128C352 198.7 294.7 256 224 256C153.3 256 96 198.7 96 128C96 57.31 153.3 0 224 0C294.7 0 352 57.31 352 128zM209.1 359.2L176 304H272L238.9 359.2L272.2 483.1L311.7 321.9C388.9 333.9 448 400.7 448 481.3C448 498.2 434.2 512 417.3 512H30.72C13.75 512 0 498.2 0 481.3C0 400.7 59.09 333.9 136.3 321.9L175.8 483.1L209.1 359.2z"/></svg>
                        Service
                      </a>

                      <a href="{{route('admin-transaction')}}" class="text-white hover:bg-keppel hover:bg-opacity-75 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/chart-bar -->
                        <svg class="mr-3 h-6 w-6 text-white invert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M13.97 2.196C22.49-1.72 32.5-.3214 39.62 5.778L80 40.39L120.4 5.778C129.4-1.926 142.6-1.926 151.6 5.778L192 40.39L232.4 5.778C241.4-1.926 254.6-1.926 263.6 5.778L304 40.39L344.4 5.778C351.5-.3214 361.5-1.72 370 2.196C378.5 6.113 384 14.63 384 24V488C384 497.4 378.5 505.9 370 509.8C361.5 513.7 351.5 512.3 344.4 506.2L304 471.6L263.6 506.2C254.6 513.9 241.4 513.9 232.4 506.2L192 471.6L151.6 506.2C142.6 513.9 129.4 513.9 120.4 506.2L80 471.6L39.62 506.2C32.5 512.3 22.49 513.7 13.97 509.8C5.456 505.9 0 497.4 0 488V24C0 14.63 5.456 6.112 13.97 2.196V2.196zM96 144C87.16 144 80 151.2 80 160C80 168.8 87.16 176 96 176H288C296.8 176 304 168.8 304 160C304 151.2 296.8 144 288 144H96zM96 368H288C296.8 368 304 360.8 304 352C304 343.2 296.8 336 288 336H96C87.16 336 80 343.2 80 352C80 360.8 87.16 368 96 368zM96 240C87.16 240 80 247.2 80 256C80 264.8 87.16 272 96 272H288C296.8 272 304 264.8 304 256C304 247.2 296.8 240 288 240H96z"/></svg>
                        Transaction
                      </a>

                      <a href="{{route('admin-user')}}" class="text-white hover:bg-keppel hover:bg-opacity-75 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/inbox -->
                        <svg class="mr-3 h-6 w-6 text-white invert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"/></svg>
                        User
                      </a>

                      <a href="{{route('dashboard')}}" class="text-white hover:bg-keppel hover:bg-opacity-75 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/chart-bar -->
                        <svg class="mr-3 h-6 w-6 text-white invert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M160 416H96c-17.67 0-32-14.33-32-32V128c0-17.67 14.33-32 32-32h64c17.67 0 32-14.33 32-32S177.7 32 160 32H96C42.98 32 0 74.98 0 128v256c0 53.02 42.98 96 96 96h64c17.67 0 32-14.33 32-32S177.7 416 160 416zM502.6 233.4l-128-128c-12.51-12.51-32.76-12.49-45.25 0c-12.5 12.5-12.5 32.75 0 45.25L402.8 224H192C174.3 224 160 238.3 160 256s14.31 32 32 32h210.8l-73.38 73.38c-12.5 12.5-12.5 32.75 0 45.25s32.75 12.5 45.25 0l128-128C515.1 266.1 515.1 245.9 502.6 233.4z"/></svg>
                        Exit
                      </a>
                    </nav>
                  </div>
                  <div class="flex-shrink-0 flex border-t border-keppel p-4">
                    <a href="{{route('profile.show')}}" class="flex-shrink-0 w-full group block">
                      <div class="flex items-center">
                        <div class="bg-white rounded-full">
                          <img class="inline-block h-9 w-9 rounded-full" src="{{Storage::url(Auth::user()->picture)}}" alt="">
                        </div>
                        <div class="ml-3">
                          <p class="text-sm font-medium text-white">
                            {{Auth::user()->name}}
                          </p>
                          <p class="text-xs font-medium text-white">
                            View profile
                          </p>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
              <div id="hamburger-btn" class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
                <button class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-keppel">
                  <span class="sr-only">Open sidebar</span>
                  <!-- Heroicon name: outline/menu -->
                  <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                  </svg>
                </button>
              </div>

              <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none">
                <div class="py-6">
                  <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <h1 class="text-2xl font-semibold text-gray-900">@yield('title')</h1>
                  </div>
                  <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <!-- Replace with your content -->
                    <div class="py-4">
                        @yield('content')
                    </div>
                    <!-- /End replace -->
                  </div>
                </div>
              </main>
            </div>
          </div>
    </body>
</html>
