<x-app-layout>

    <div class="mx-auto px-16 divide-y-2">
        <div class="flex flex-row space-x-6 items-center mt-4 py-6">
            <img class="w-1/12 flex-shrink-0 bg-white rounded-full border" src="{{ Storage::url($user->picture) }}" alt="">
            <h3 class="text-gray-900 text-4xl font-medium">{{$user->name}}</h3>
        </div>
        <div class="flex flex-col">
            <h1 class="text-3xl p-6 font-bold">Discover what {{$user->name}} has to offer!</h1>
            <ul class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 my-6">
                @foreach ($services as $service)
                    <li class="col-span-1 flex flex-col bg-white rounded-lg shadow divide-y divide-gray-200">
                        <div>
                            <img src="{{ Storage::url($service->picture) }}" alt="Slide Image">
                        </div>
                        <div class="flex-1 flex flex-col p-4">
                            <div class="flex flex-row space-x-4 items-center">
                                <img class="w-8 h-8 flex-shrink-0 bg-white rounded-full border" src="{{ Storage::url($service->user()->picture) }}" alt="">
                                <h3 class="text-gray-900 text-base font-medium">{{$service->user()->name}}</h3>
                            </div>
                            <h2 class="text-gray-900 text-xl font-medium mt-2">{{$service->name}}</h2>
                            <dl class="mt-1 flex-grow flex flex-col justify-between">
                            <dt class="sr-only">Title</dt>
                            <dd class="text-gray-500 text-sm">{{$service->category()->name}}</dd>
                            </dl>
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
            <a class="text-lg p-6 font-bold self-end" href="{{route('user-services', $user->id)}}">
                View more..
            </a>
        </div>
    </div>
</x-app-layout>
