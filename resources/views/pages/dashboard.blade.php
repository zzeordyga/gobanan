<x-app-layout>
    <div>
        <!-- Hero card -->
        <div class="relative">
        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gray-50"></div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative shadow-xl sm:rounded-2xl sm:overflow-hidden">
            <div class="absolute inset-0">
                <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1575318634028-6a0cfcb60c59?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=686&q=80" alt="People working on laptops">
                <div class="absolute inset-0 bg-ocean-green" style="mix-blend-mode: multiply;"></div>
            </div>
            <div class="relative px-4 py-16 sm:px-6 sm:py-24 lg:py-32 lg:px-8">
                <h1 class="text-center text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
                <span class="block text-white">Find the perfect freelance</span>
                <span class="block text-white"> services for your business</span>
                </h1>
                <p class="mt-6 max-w-lg mx-auto text-center text-xl text-white sm:max-w-3xl">
                    Connect with vetted experts, execute every project, and expand your team capabilities
                </p>
                <div class="mt-10 max-w-sm mx-auto sm:max-w-none sm:flex sm:justify-center">
                <div class="flex space-y-4 justify-center">
                    <a href="#" class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-keppel bg-white hover:bg-emerald-50 sm:px-8">
                    Get started
                    </a>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- Logo cloud -->
        <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm font-semibold uppercase text-gray-500 tracking-wide">
            Trusted by over 5 businesses
            </p>
            <div class="mt-6 grid grid-cols-2 gap-8 md:grid-cols-6 lg:grid-cols-5">
            <div class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1">
                <img class="h-12" src="https://fiverr-res.cloudinary.com/npm-assets/@fiverr/logged_out_homepage_perseus/apps/facebook.31d5f92.png" alt="Facebook">
            </div>
            <div class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1">
                <img class="h-12" src="https://fiverr-res.cloudinary.com/npm-assets/@fiverr/logged_out_homepage_perseus/apps/google.517da09.png" alt="Google">
            </div>
            <div class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1">
                <img class="h-12" src="https://fiverr-res.cloudinary.com/npm-assets/@fiverr/logged_out_homepage_perseus/apps/netflix.e3ad953.png" alt="Netflix">
            </div>
            <div class="col-span-1 flex justify-center md:col-span-2 md:col-start-2 lg:col-span-1">
                <img class="h-12" src="https://fiverr-res.cloudinary.com/npm-assets/@fiverr/logged_out_homepage_perseus/apps/pandg.8b7310b.png" alt="P&G">
            </div>
            <div class="col-span-2 flex justify-center md:col-span-2 md:col-start-4 lg:col-span-1">
                <img class="h-12" src="https://fiverr-res.cloudinary.com/npm-assets/@fiverr/logged_out_homepage_perseus/apps/paypal.ec56157.png" alt="Paypal">
            </div>
            </div>
        </div>
        </div>
    </div>

    <div>
        <h1 class="text-4xl p-6 font-bold">Discover new freelance service here!</h1>
        <ul class="grid grid-cols-1 gap-8 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 my-6 px-16">
            <li class="col-span-1 flex flex-col bg-white rounded-lg shadow divide-y divide-gray-200">
                <div>
                    <img src="{{ asset('image/error/default.jpg') }}" alt="">
                </div>
                <div class="flex-1 flex flex-col p-4">
                    <div class="flex flex-row space-x-4 items-center">
                        <img class="w-12 h-12 flex-shrink-0 bg-black rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=nkXPoOrIl0&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                        <h3 class="text-gray-900 text-base font-medium">Jane Cooper</h3>
                    </div>
                    <h2 class="text-gray-900 text-xl font-medium mt-2">Service Title</h2>
                    <dl class="mt-1 flex-grow flex flex-col justify-between">
                    <dt class="sr-only">Title</dt>
                    <dd class="text-gray-500 text-sm">Paradigm Representative</dd>
                    </dl>
                </div>
                <div>
                    <div class="-mt-px flex">
                    <div class="ml-4 w-0 flex-1 flex">
                        <span href="mailto:janecooper@example.com" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-start py-4 text-lg text-gray-700 font-medium rounded-bl-lg">
                        <!-- Heroicon name: solid/mail -->
                        <i class="fa-solid fa-dollar-sign"></i>
                        <span class="ml-3">9999.99</span>
                        </span>
                    </div>
                    <div class="-ml-px w-0 flex-1 flex">
                        <a href="tel:+1-202-555-0170" class="relative w-0 flex-1 inline-flex items-center justify-end py-4 text-base text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-keppel mr-4">
                            <span>View</span>
                            <i class="fa-solid fa-angle-right ml-3"></i>
                        </a>
                    </div>
                    </div>
                </div>
            </li>
            <li class="col-span-1 flex flex-col bg-white rounded-lg shadow divide-y divide-gray-200">
                <div>
                    <img src="{{ asset('image/error/default.jpg') }}" alt="">
                </div>
                <div class="flex-1 flex flex-col p-4">
                    <div class="flex flex-row space-x-4 items-center">
                        <img class="w-12 h-12 flex-shrink-0 bg-black rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=nkXPoOrIl0&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                        <h3 class="text-gray-900 text-base font-medium">Jane Cooper</h3>
                    </div>
                    <h2 class="text-gray-900 text-xl font-medium mt-2">Service Title</h2>
                    <dl class="mt-1 flex-grow flex flex-col justify-between">
                    <dt class="sr-only">Title</dt>
                    <dd class="text-gray-500 text-sm">Paradigm Representative</dd>
                    </dl>
                </div>
                <div>
                    <div class="-mt-px flex">
                    <div class="ml-4 w-0 flex-1 flex">
                        <span href="mailto:janecooper@example.com" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-start py-4 text-lg text-gray-700 font-medium rounded-bl-lg">
                        <!-- Heroicon name: solid/mail -->
                        <i class="fa-solid fa-dollar-sign"></i>
                        <span class="ml-3">9999.99</span>
                        </span>
                    </div>
                    <div class="-ml-px w-0 flex-1 flex">
                        <a href="tel:+1-202-555-0170" class="relative w-0 flex-1 inline-flex items-center justify-end py-4 text-base text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-keppel mr-4">
                            <span>View</span>
                            <i class="fa-solid fa-angle-right ml-3"></i>
                        </a>
                    </div>
                    </div>
                </div>
            </li>
            <li class="col-span-1 flex flex-col bg-white rounded-lg shadow divide-y divide-gray-200">
                <div>
                    <img src="{{ asset('image/error/default.jpg') }}" alt="">
                </div>
                <div class="flex-1 flex flex-col p-4">
                    <div class="flex flex-row space-x-4 items-center">
                        <img class="w-12 h-12 flex-shrink-0 bg-black rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=nkXPoOrIl0&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                        <h3 class="text-gray-900 text-base font-medium">Jane Cooper</h3>
                    </div>
                    <h2 class="text-gray-900 text-xl font-medium mt-2">Service Title</h2>
                    <dl class="mt-1 flex-grow flex flex-col justify-between">
                    <dt class="sr-only">Title</dt>
                    <dd class="text-gray-500 text-sm">Paradigm Representative</dd>
                    </dl>
                </div>
                <div>
                    <div class="-mt-px flex">
                    <div class="ml-4 w-0 flex-1 flex">
                        <span href="mailto:janecooper@example.com" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-start py-4 text-lg text-gray-700 font-medium rounded-bl-lg">
                        <!-- Heroicon name: solid/mail -->
                        <i class="fa-solid fa-dollar-sign"></i>
                        <span class="ml-3">9999.99</span>
                        </span>
                    </div>
                    <div class="-ml-px w-0 flex-1 flex">
                        <a href="tel:+1-202-555-0170" class="relative w-0 flex-1 inline-flex items-center justify-end py-4 text-base text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-keppel mr-4">
                            <span>View</span>
                            <i class="fa-solid fa-angle-right ml-3"></i>
                        </a>
                    </div>
                    </div>
                </div>
            </li>
            <li class="col-span-1 flex flex-col bg-white rounded-lg shadow divide-y divide-gray-200">
                <div>
                    <img src="{{ asset('image/error/default.jpg') }}" alt="">
                </div>
                <div class="flex-1 flex flex-col p-4">
                    <div class="flex flex-row space-x-4 items-center">
                        <img class="w-12 h-12 flex-shrink-0 bg-black rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=nkXPoOrIl0&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                        <h3 class="text-gray-900 text-base font-medium">Jane Cooper</h3>
                    </div>
                    <h2 class="text-gray-900 text-xl font-medium mt-2">Service Title</h2>
                    <dl class="mt-1 flex-grow flex flex-col justify-between">
                    <dt class="sr-only">Title</dt>
                    <dd class="text-gray-500 text-sm">Paradigm Representative</dd>
                    </dl>
                </div>
                <div>
                    <div class="-mt-px flex">
                    <div class="ml-4 w-0 flex-1 flex">
                        <span href="mailto:janecooper@example.com" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-start py-4 text-lg text-gray-700 font-medium rounded-bl-lg">
                        <!-- Heroicon name: solid/mail -->
                        <i class="fa-solid fa-dollar-sign"></i>
                        <span class="ml-3">9999.99</span>
                        </span>
                    </div>
                    <div class="-ml-px w-0 flex-1 flex">
                        <a href="tel:+1-202-555-0170" class="relative w-0 flex-1 inline-flex items-center justify-end py-4 text-base text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-keppel mr-4">
                            <span>View</span>
                            <i class="fa-solid fa-angle-right ml-3"></i>
                        </a>
                    </div>
                    </div>
                </div>
            </li>
            <li class="col-span-1 flex flex-col bg-white rounded-lg shadow divide-y divide-gray-200">
                <div>
                    <img src="{{ asset('image/error/default.jpg') }}" alt="">
                </div>
                <div class="flex-1 flex flex-col p-4">
                    <div class="flex flex-row space-x-4 items-center">
                        <img class="w-12 h-12 flex-shrink-0 bg-black rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=nkXPoOrIl0&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                        <h3 class="text-gray-900 text-base font-medium">Jane Cooper</h3>
                    </div>
                    <h2 class="text-gray-900 text-xl font-medium mt-2">Service Title</h2>
                    <dl class="mt-1 flex-grow flex flex-col justify-between">
                    <dt class="sr-only">Title</dt>
                    <dd class="text-gray-500 text-sm">Paradigm Representative</dd>
                    </dl>
                </div>
                <div>
                    <div class="-mt-px flex">
                    <div class="ml-4 w-0 flex-1 flex">
                        <span href="mailto:janecooper@example.com" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-start py-4 text-lg text-gray-700 font-medium rounded-bl-lg">
                        <!-- Heroicon name: solid/mail -->
                        <i class="fa-solid fa-dollar-sign"></i>
                        <span class="ml-3">9999.99</span>
                        </span>
                    </div>
                    <div class="-ml-px w-0 flex-1 flex">
                        <a href="tel:+1-202-555-0170" class="relative w-0 flex-1 inline-flex items-center justify-end py-4 text-base text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-keppel mr-4">
                            <span>View</span>
                            <i class="fa-solid fa-angle-right ml-3"></i>
                        </a>
                    </div>
                    </div>
                </div>
            </li>
        </ul>       
    </div>
    
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                A whole world of freelance talent at your fingertips
            </p>
        </div>
    
        <div class="mt-10">
            <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
            <div class="relative">
                <dt>
                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-keppel text-white">
                    <!-- Heroicon name: outline/globe-alt -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">The best for every budget</p>
                </dt>
                <dd class="mt-2 ml-16 text-base text-gray-500">
                    Find high-quality services at every price point. No hourly rates, just project-based pricing.
                </dd>
            </div>
    
            <div class="relative">
                <dt>
                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-keppel text-white">
                    <!-- Heroicon name: outline/scale -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Quality work done quickly</p>
                </dt>
                <dd class="mt-2 ml-16 text-base text-gray-500">
                    Find the right freelancer to begin working on your project within minutes.
                </dd>
            </div>
    
            <div class="relative">
                <dt>
                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-keppel text-white">
                    <!-- Heroicon name: outline/lightning-bolt -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Protected payments, every time</p>
                </dt>
                <dd class="mt-2 ml-16 text-base text-gray-500">
                    Always know what you'll pay upfront. Your payment isn't released until you approve the work.
                </dd>
            </div>
    
            <div class="relative">
                <dt>
                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-keppel text-white">
                    <!-- Heroicon name: outline/annotation -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 3l-6 6m0 0V4m0 5h5M5 3a2 2 0 00-2 2v1c0 8.284 6.716 15 15 15h1a2 2 0 002-2v-3.28a1 1 0 00-.684-.948l-4.493-1.498a1 1 0 00-1.21.502l-1.13 2.257a11.042 11.042 0 01-5.516-5.517l2.257-1.128a1 1 0 00.502-1.21L9.228 3.683A1 1 0 008.279 3H5z" />
                    </svg>
                </div>
                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">24/7 support</p>
                </dt>
                <dd class="mt-2 ml-16 text-base text-gray-500">
                    Questions? Our round-the-clock support team is available to help anytime, anywhere.
                </dd>
            </div>
            </dl>
        </div>
        </div>
    </div>

</x-app-layout>
