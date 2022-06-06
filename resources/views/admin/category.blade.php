@extends('layouts.admin')

@section('title', "Category")

@section('content')
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
    <a href="{{route('create-category')}}" class="text-white bg-keppel hover:bg-metallic-blue rounded w-fit py-1 px-4 mb-2 font-bold">Add Category</a>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    ID
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Description
                </th>
                <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
                <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Delete</span>
                </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{$category->id}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{$category->name}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{$category->description}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{route('edit-category', $category->id)}}" class="text-keppel hover:text-metallic-blue">Edit</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{route('delete-category', $category->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="font-semibold text-rose-600 hover:text-rose-900">Delete</button>
                            </form>    
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
            <div class="mt-2">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
    </div>  
@endsection
