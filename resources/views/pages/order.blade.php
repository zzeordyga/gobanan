<x-app-layout>
    @if(count($orders) > 0 && count($purchases) > 0)
        @if(count($orders) > 0)
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="font-semibold text-3xl py-4">Pending Orders</h1>
                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                    <ul class="divide-y divide-gray-200">
                        @foreach ($orders as $order)
                            <li>
                                <div class="block">
                                    <div class="flex items-center px-4 py-4 sm:px-6">
                                        <div class="min-w-0 flex-1 flex">
                                        <div class="flex-shrink-0">
                                            <img class="h-24 w-24" src="{{ Storage::url($order->picture) }}" alt="">
                                        </div>
                                        <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                            <div>
                                            <a href="{{route('service', $order->id)}}" class="text-lg font-bold text-keppel hover:text-metallic-blue truncate">{{$order->name}}</a>
                                            @if (isset($order->notes))
                                                <p class="mt-2 flex items-center text-sm text-gray-500">
                                                    <div>Notes :</div>
                                                    <span class="truncate text-sm">{{$order->notes}}</span>
                                                </p>
                                            @endif
                                            </div>
                                            <div class="hidden md:block">
                                            <div>
                                                <p class="text-lg text-gray-900">
                                                    Ordered by
                                                    <a class="font-bold text-keppel hover:text-metallic-blue" href="{{route('user', $order->customer_id)}}"> {{$order->customer_name}} </a>
                                                </p>
                                                <p class="mt-2 flex items-center text-sm text-gray-500">
                                                    Contact Email : {{$order->customer_email}}
                                                </p>
                                                <p class="mt-2 flex items-center text-sm text-gray-500">
                                                    <i class="fa-solid fa-dollar-sign"></i>
                                                    <span class="ml-2">{{$order->price}}</span>
                                                </p>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <form action="{{route('finishOrder')}}" method="POST">
                                            @method('put')
                                            @csrf
                                            <input type="hidden" name="id" value="{{$order->td_id}}">
                                            <x-jet-button class="w-full flex justify-center bg-keppel">
                                                {{ __('Finish Order') }}
                                            </x-jet-button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @else
            <h1 class="text-center m-8  text-2xl font-bold">
                {{-- <img class="w-1/4 m-auto" src="{{asset('image/error/no-data.png')}}" alt=""> --}}
                <p>No orders yet!</p>
                <span class="font-medium text-lg text-gray-600">Try promoting your service more!</span>
            </h1>
        @endif

        @if(count($purchases) > 0)
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="font-semibold text-3xl py-4">Your Purchases</h1>
                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                    <ul class="divide-y divide-gray-200">
                        @foreach ($purchases as $purchase)
                            <li>
                                <div class="block">
                                    <div class="flex items-center px-4 py-4 sm:px-6">
                                        <div class="min-w-0 flex-1 flex">
                                        <div class="flex-shrink-0">
                                            <img class="h-24 w-24" src="{{ Storage::url($purchase->picture) }}" alt="">
                                        </div>
                                        <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                            <div>
                                            <a href="{{route('service', $purchase->id)}}" class="text-lg font-bold text-keppel hover:text-metallic-blue truncate">{{$purchase->name}}</a>
                                            @if (isset($purchase->notes))
                                                <p class="mt-2 flex items-center text-sm text-gray-500">
                                                    <div>Notes :</div>
                                                    <span class="truncate text-sm">{{$purchase->notes}}</span>
                                                </p>
                                            @endif
                                            </div>
                                            <div class="hidden md:block">
                                            <div>
                                                <p class="text-lg text-gray-900">
                                                    Provided by
                                                    <a class="font-bold text-keppel hover:text-metallic-blue" href="{{route('user', $purchase->user_id)}}"> {{$purchase->user_name}} </a>
                                                </p>
                                                <p class="mt-2 flex items-center text-sm text-gray-500">
                                                    Contact Email : {{$purchase->user_email}}
                                                </p>
                                                <p class="mt-2 flex items-center text-sm text-gray-500">
                                                    <i class="fa-solid fa-dollar-sign"></i>
                                                    <span class="ml-2">{{$purchase->price}}</span>
                                                </p>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <form action="{{route('finishOrder')}}" method="POST">
                                            @method('put')
                                            @csrf
                                            <input type="hidden" name="id">
                                            <x-jet-button class="invisible w-full flex justify-center bg-keppel">
                                                {{ __('Finish Order') }}
                                            </x-jet-button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @else
            <h1 class="text-center m-8 text-2xl font-bold">
                {{-- <img class="w-1/4 m-auto" src="{{asset('image/error/no-data.png')}}" alt=""> --}}
                <p>No purchases yet!</p>
                <span class="font-medium text-lg text-gray-600">Try commiting to the service you found interesting!</span>
            </h1>
        @endif
    @else
        <h1 class="text-center m-8 text-2xl font-bold">
            {{-- <img class="w-1/4 m-auto" src="{{asset('image/error/no-data.png')}}" alt=""> --}}
            <p>No orders or purchases yet!</p>
            <span class="font-medium text-lg text-gray-600">Maybe try exploring and a little bit of promoting?</span>
        </h1>
    @endif
</x-app-layout>
