<x-app-layout>
    <h1 class="text-center mb-16 text-2xl font-bold">
        <img class="w-1/4 m-auto" src="{{asset('image/error/no-data.png')}}" alt="">
        <p>No data available!</p>
        <span class="font-medium text-lg text-gray-600">Try going back to home.</span>
        <a href="{{route('dashboard')}}" class="font-medium text-base text-gray-600 hover:text-ocean-green block underline">Back home.</a>
    </h1>
</x-app-layout>
