<x-app-layout>
    <div class="border-t-2 px-16">
        @if (count($services) > 0)
            <div class="p-6 w-2/3 pb-0">
                <h1 class="text-4xl font-bold">Results for "{{$keyword}}"</h1>
                <p class="text-base text-gray-400 mt-2 font-bold">{{count($services)}} services available</p>
            </div>
            {{-- <div class="p-6 pt-2">
                <h1 class="text-xl font-bold mb-4">Select job category</h1>
                <div class="flex justify-start">
                    @foreach ($categories as $category)
                        <div>
                            <a href="{{ route('category', $category->id) }}" class="font-bold px-4 py-1 mx-2 border text-slate-500 hover:text-slate-600 border-gray-200 bg-gray-50 hover:bg-gray-200 rounded-xl">{{$category->name}}</a>
                        </div>
                    @endforeach
                </div>
            </div> --}}
            <ul class="grid grid-cols-1 gap-12 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 my-4">
                @foreach ($services as $service)
                    <li class="col-span-1 flex flex-col bg-white rounded-lg shadow divide-y divide-gray-200">
                        <div>
                            <img src="{{ Storage::url($service->picture) }}" alt="Slide Image">
                        </div>
                        <div class="flex-1 flex flex-col p-4">
                            <div class="flex flex-row space-x-4 items-center">
                                <img class="w-8 h-8 flex-shrink-0 bg-white rounded-full border" src="{{ Storage::url($service->user()->picture) }}" alt="">
                                <a href="{{route('user', $service->user()->id)}}" class="text-gray-900 hover:text-keppel text-base font-medium">{{$service->user()->name}}</a>
                            </div>
                            <h2 class="text-gray-900 text-xl font-medium mt-2">{{$service->name}}</h2>
                            <dl class="mt-1 flex-grow flex flex-col justify-between relative bottom-0">
                                <dt class="sr-only">Title</dt>
                                <dd class="text-gray-500 text-sm">{{$service->category()->name}}</dd>
                            </dl>
                            <div class="self-end mt-4 text-base">
                                <i class="fa-solid fa-star text-amber-400"></i>
                                <span class="mt-4 font-semibold">
                                    @if ($service->reviewCount() > 0)
                                        {{number_format($service->reviewRating(), 2, '.', '')}} ({{$service->reviewCount()}} reviews)
                                    @else
                                        No reviews yet.
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="-mt-px flex">
                            <div class="ml-4 w-0 flex-1 flex">
                                <span class="relative -mr-px w-0 flex-1 inline-flex items-center justify-start py-4 text-lg text-gray-700 font-medium rounded-bl-lg">
                                <!-- Heroicon name: solid/mail -->
                                <i class="fa-solid fa-dollar-sign"></i>
                                <span class="ml-3">{{number_format($service->price, 2, '.', '')}}</span>
                                </span>
                            </div>
                            <div class="-ml-px w-0 flex-1 flex">
                                <a href="{{route('service', $service->id)}}" class="relative w-0 flex-1 inline-flex items-center justify-end py-4 text-base text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-keppel mr-4">
                                    <span>View</span>
                                    <i class="fa-solid fa-angle-right ml-3"></i>
                                </a>
                            </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="py-6">
                {{ $services->links() }}
            </div>
        @else
            <h1 class="text-center mb-16 text-2xl font-bold">
                <img class="w-1/4 m-auto" src="{{asset('image/error/no-data.png')}}" alt="">
                <p>No results found with the keyword "{{$keyword}}"!</p>
                <span class="font-medium text-lg text-gray-600">Please try again with another keyword.</span>
            </h1>
        @endif
    </div>
</x-app-layout>
