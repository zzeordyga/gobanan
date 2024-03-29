<x-app-layout>
    <div class="border-t-2 px-16 h-full">
        <div class="p-6 pb-0 flex justify-between items-center">
            <h1 class="text-4xl w-2/3 font-bold">All
                @if (isset($curr_category))
                    {{$curr_category->name}}
                @endif
                Jobs Available in Gobanan
                
                <p class="font-medium text-lg text-slate-800 mt-2">
                    @if (isset($curr_category))
                        {{$curr_category->description}}
                    @else
                        Find the person that could fulfill your needs here!
                    @endif
                </p>
            </h1>
            
            <div class="flex justify-center space-x-4">
                @auth
                    <form action="{{route('create')}}">
                        <x-jet-button>Create a Service</x-jet-button>
                    </form>    
                @endauth
            </div>
        </div>
        <div class="pt-2">
            <h1 class="text-xl font-bold mb-4 px-6">Select job category</h1>
            <div class="flex justify-start">
                @foreach ($categories as $category)
                    @if (!isset($curr_category) || $category->id != $curr_category->id)
                        <div>
                            <a href="{{ route('category', $category->id) }}" class="text-sm font-bold px-3 py-1 mx-2 border text-slate-500 hover:text-slate-600 border-gray-200 bg-gray-50 hover:bg-gray-200 rounded-xl">{{$category->name}}</a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <ul class="grid grid-cols-1 gap-12 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 my-4">
            @foreach ($services as $service)
                <li class="col-span-1 flex flex-col bg-white rounded-lg shadow divide-y divide-gray-200">
                    <div>
                        <img src="{{ Storage::url($service->picture) }}" alt="Slide Image">
                    </div>
                    <div class="flex-1 flex flex-col p-4 justify-between">
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
    </div>
</x-app-layout>
