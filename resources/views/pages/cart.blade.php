<x-app-layout>
    @if(count($carts) > 0)
        <div class="bg-white shadow overflow-hidden sm:rounded-lg px-16">
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 lg:grid-cols-3">
                <div class="col-span-1 sm:col-span-2">
                    <h1 class="font-semibold text-3xl py-4">Shopping Cart</h1>
                    <div class="bg-white shadow overflow-hidden sm:rounded-md">
                        <ul class="divide-y divide-gray-200">
                            @foreach ($carts as $cart)
                                <li>
                                    <div class="block">
                                        <div class="flex items-center px-4 py-4 sm:px-6">
                                            <div class="min-w-0 flex-1 flex">
                                            <div class="flex-shrink-0">
                                                <img class="h-24 w-24" src="{{ Storage::url($cart->service()->picture) }}" alt="">
                                            </div>
                                            <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                <div>
                                                <a href="{{route('service', $cart->service()->id)}}" class="text-lg font-bold text-keppel hover:text-metallic-blue truncate">{{$cart->service()->name}}</a>
                                                @if (isset($cart->notes))
                                                    <p class="mt-2 flex items-center text-sm text-gray-500">
                                                        <div>Notes :</div>
                                                        <span class="truncate text-sm">{{$cart->notes}}</span>
                                                    </p>
                                                @endif
                                                </div>
                                                <div class="hidden md:block">
                                                <div>
                                                    <p class="text-lg text-gray-900">
                                                        Provided by
                                                        <a class="font-bold text-keppel hover:text-metallic-blue" href="{{route('user', $cart->service()->user()->id)}}"> {{$cart->service()->user()->name}} </a>
                                                    </p>
                                                    <p class="mt-2 flex items-center text-sm text-gray-500">
                                                    <!-- Heroicon name: solid/check-circle -->
                                                        <i class="fa-solid fa-dollar-sign"></i>
                                                        <span class="ml-2">{{$cart->service()->price}}</span>
                                                    </p>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <form action="{{route('deleteCart')}}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" name="id" value="{{$cart->id}}">
                                                <button type="submit"><svg class="h-5 w-5 text-rose-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z"/></svg></button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-span-1">
                    <h1 class="font-semibold text-3xl py-4">Order Summary</h1>
                    <div class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8 border border-gray-200 rounded-lg">
                        <!-- We've used 3xl here, but feel free to try other max-widths based on your needs -->
                        <div class="max-w-3xl mx-auto divide-y-2">
                        <form action="{{route('checkout')}}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div class="flex justify-between">
                                    <h1 class="text-2xl font-bold">Subtotal</h1>
                                    <h2 class="text-xl font-medium">$ {{number_format($total, '2', '.', '')}}</h2>
                                </div>
                                <div class="flex justify-between">
                                    <h1 class="text-2xl font-bold">Shipping</h1>
                                    <h2 class="text-xl font-medium">TBD</h2>
                                </div>
                                <div class="flex justify-between">
                                    <h1 class="text-2xl font-bold">Estimated Tax</h1>
                                    <h2 class="text-xl font-medium">$ {{number_format($total/10, '2', '.', '')}}</h2>
                                </div>
                                <hr>
                                <div class="flex justify-between">
                                    <h1 class="text-2xl font-bold">Total</h1>
                                    <h2 class="text-xl font-medium">$ {{number_format($total + $total/10, '2', '.', '')}}</h2>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="text-2xl font-bold">Payment Type</h1>
                                    <select name="payment_type" id="payment_type" class="mt-4 block appearance-none w-full border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                        <option>Debit</option>
                                        <option>Credit</option>
                                    </select>
                                </div>
                                <div class="flex flex-col">
                                    <button class="text-xl font-bold mt-4 text-center w-full border bg-keppel p-4 rounded-lg" type="submit">Checkout</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </dl>
            </div>
        </div>
    @else
        <h1 class="text-center mb-16 text-2xl font-bold">
            <img class="w-1/4 m-auto" src="{{asset('image/error/no-data.png')}}" alt="">
            <p>No item in your cart..</p>
            <span class="font-medium text-lg text-gray-600">Try exploring more jobs!</span>
            <a href="{{route('explore')}}" class="font-medium text-base text-gray-600 hover:text-ocean-green block underline">Explore More</a>
        </h1>
    @endif
</x-app-layout>
