<x-app-layout>
<!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg px-16">
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
            </div>
        </dl>
        </div>
    </div>
</x-app-layout>