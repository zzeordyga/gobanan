@extends('layouts.admin')

@section('title', "Category")

@section('content')
    <div class="max-w-7xl py-6 mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{route('update-category', $category->id)}}" class="space-y-8 divide-gray-200" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <div class="space-y-8 divide-y divide-gray-200">
            <div>
                <div>
                <h3 class="text-4xl leading-6 font-medium text-gray-900">
                    Create a Category
                </h3>
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
                        Name
                    </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                    <input value="{{$category->name}}" required type="text" name="name" id="name" autocomplete="name" class="flex-1 focus:ring-keppel focus:border-keppel block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                    </div>
                </div>
        
                <div class="sm:col-span-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">
                        Description
                    </label>
                    <div class="mt-1">
                    <textarea  required id="description" name="description" rows="3" class="shadow-sm focus:ring-keppel focus:border-keppel block w-full sm:text-sm border-gray-300 rounded-md">{{$category->description}}</textarea>
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
@endsection
