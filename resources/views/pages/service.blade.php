<x-app-layout>
<!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg px-16">
        <div class="flex justify-between items-center">
            <div class="p-4">
                <h3 class="text-4xl font-medium text-gray-900">
                    {{$service->name}}
                </h3>
                <div class="flex divide-x divide-gray-200 mt-4 items-center space-x-5">
                    <div class="flex flex-row space-x-4 items-center">
                        <img class="w-8 h-8 flex-shrink-0 bg-white rounded-full border" src="{{ Storage::url($service->user()->picture) }}" alt="">
                        <a href="{{route('user', $service->user()->id)}}" class="text-gray-900 hover:text-keppel text-base font-medium">{{$service->user()->name}}</a>
                    </div>
                    <div class="text-base px-4">
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
            </div>
            <div class="flex justify-center space-x-4">
                @auth
                    @if ($service->user_id == Auth::user()->id)
                        <form action="{{route('edit', $service->id)}}">
                            <x-jet-button>Update</x-jet-button>
                        </form>
                        <form action="{{route('deleteService', $service->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <x-jet-button class="bg-rose-600 hover:bg-rose-800">Delete</x-jet-button>
                        </form>
                    @endif   
                @endauth
            </div>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 lg:grid-cols-2">
            <div class="col-span-1 sm:col-span-1 text-center">
                <img class="w-5/6" src="{{ Storage::url($service->picture) }}" alt="Slide Image">
            </div>
            <div class="sm:col-span-1">
                <div class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8 border rounded-lg">
                    <!-- We've used 3xl here, but feel free to try other max-widths based on your needs -->
                    <div class="max-w-3xl mx-auto divide-y-2">
                      <h1 class="font-semibold text-3xl py-4">Purchase</h1>
                      <form action="{{route('addToCart')}}" method="POST">
                        @csrf
                        <div class="py-8 space-y-4">
                            <div class="flex justify-between">
                                <h1 class="text-2xl font-bold">Price</h1>
                                <h2 class="text-xl font-medium">$ {{number_format($service->price, '2', '.', '')}}</h2>
                            </div>
                            <p class="text-base w-2/3 font-medium">
                                Be sure to always add a note if you need an addition for this job.
                                You can always try to contact the person offering this job before
                                purchasing this service.
                            </p>
                            <div class="flex flex-col">
                                <h1 class="text-xl font-medium">Contact Me</h1>
                                <ul class="list-disc font-medium px-4 sm:px-6 lg:px-8">
                                    <li><a href="tel:{{$service->user()->phone}}">{{$service->user()->phone}}</a></li>
                                    <li>
                                        <a href="mailto:{{$service->user()->email}}?subject={{$service->name}}&body={{$service->name}}">
                                            {{$service->user()->email}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="flex flex-col">
                                <h1 class="text-xl font-medium">Notes</h1>
                                <input type="hidden" name="service_id" value="{{$service->id}}">
                                <input class="mt-4 rounded border w-full" type="text" name="notes" id="notes" placeholder="Add some additional requests here..">
                                <button class="text-xl font-bold mt-4 text-center w-full border bg-keppel p-4 rounded-lg" type="submit">Add To Cart</button>
                            </div>
                        </div>
                      </form>
                    </div>
                  </div>
            </div>
            <div class="col-span-1 sm:col-span-2 text-xl">
                <dt class="font-medium text-gray-500">
                    About This Job
                </dt>
                <dd class="mt-1 text-gray-900">
                    {{$service->description}}
                </dd>
            </div>
            <div class="sm:col-span-2 py-8">
            <dt class="font-medium text-gray-500">
                <h1 class="text-xl">Reviews</h1>
                <div class="text-base py-2">
                    <i class="fa-solid fa-star text-amber-400"></i>
                    <span class="mt-4 font-semibold">
                        @if ($service->reviewCount() > 0)
                            {{number_format($service->reviewRating(), 2, '.', '')}} from {{$service->reviewCount()}} reviews
                        @else
                            No reviews yet
                        @endif
                    </span>
                </div>
            </dt>
            <hr>
            <dd class="mt-1 text-sm text-gray-900">
                <ul class="divide-y divide-gray-200">
                    @if ($service->reviewCount() > 0)
                        @foreach ($service->reviews()->get() as $review)
                            <li class="pl-3 pr-4 py-3 flex flex-col text-sm space-y-4">
                                <div class="flex flex-row space-x-4 items-center">
                                    <img class="w-8 h-8 flex-shrink-0 bg-white rounded-full border"
                                    src="{{ Storage::url($review->user()->picture) }}"
                                    alt="">
                                    <a href="{{route('user', $service->user()->id)}}" class="text-gray-900 hover:text-keppel text-base font-medium">{{$review->user()->name}}</a>
                                    <div class="text-base px-2">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <i class="fa-solid fa-star text-amber-400"></i>
                                        @endfor
                                        <span class="mx-2 font-semibold">{{$review->rating}}</span>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    {{$review->description}}
                                </div>
                                <div>Posted at {{$review->created_at}}</div>
                            </li>
                        @endforeach
                    @else
                        <h1 class="text-center py-8 text-2xl">
                            <img class="w-1/6 m-auto" src="{{asset('image/error/no-data.png')}}" alt="">
                            There's no review for this job!
                        </h1>
                    @endif
                </ul>
            </dd>
            <dt class="font-medium text-gray-500">
                <h1 class="text-xl">Create Review</h1>
            </dt>
            <hr>

            <dd class="mt-1 text-sm text-gray-900">
                <div class="max-w-7xl mx-auto">
                    <form action="{{route('store-review', $service->id)}}" class="space-y-8 divide-gray-200" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="space-y-8 divide-y divide-gray-200">
                        <div>
                            <div>
                            @if($errors->any())
                                <ul class="list-disc font-medium mt-4 px-4 sm:px-6 lg:px-8">
                                    @foreach ($errors->all() as $message)
                                    <li class="text-rose-600">
                                        <strong>{{$message}}</strong>
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                            </div>
                    
                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                            
                                <div class="sm:col-span-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Rating
                                </label>
                                
                                <div class="rating mt-2">
                                    <input type="radio" name="rating-2" value="1" class="star-radio mask mask-star-2 bg-orange-400" />
                                    <input type="radio" name="rating-2" value="2" class="star-radio mask mask-star-2 bg-orange-400" checked />
                                    <input type="radio" name="rating-2" value="3" class="star-radio mask mask-star-2 bg-orange-400" />
                                    <input type="radio" name="rating-2" value="4" class="star-radio mask mask-star-2 bg-orange-400" />
                                    <input type="radio" name="rating-2" value="5" class="star-radio mask mask-star-2 bg-orange-400" />
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Title
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                <input required type="text" name="title" id="title" autocomplete="title" class="flex-1 focus:ring-keppel focus:border-keppel block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                            </div>
                    
                            <div class="sm:col-span-6">
                                <label for="description" class="block text-sm font-medium text-gray-700">
                                    Description
                                </label>
                                <div class="mt-1">
                                <textarea required id="description" name="description" rows="3" class="shadow-sm focus:ring-keppel focus:border-keppel block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Write a paragraph to explain this category.</p>
                            </div>
                    
                        </div>
                    
                        <div class="pt-5">
                        <div class="flex justify-end">
                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-keppel hover:bg-metallic-blue focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-keppel">
                            Save
                            </button>
                        </div>
                        </div>
                    </form>              
                </div>
            </dd>
            </div>
        </dl>
        </div>
    </div>
</x-app-layout>
