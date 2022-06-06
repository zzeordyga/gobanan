<x-app-layout>
    <div class="max-w-7xl py-6 mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{route('store')}}" class="space-y-8 divide-gray-200" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <div class="space-y-8 divide-y divide-gray-200">
              <div>
                <div>
                  <h3 class="text-4xl leading-6 font-medium text-gray-900">
                    Create a Service
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
                      <input required type="text" name="name" id="name" autocomplete="name" class="flex-1 focus:ring-keppel focus:border-keppel block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                    </div>
                  </div>
          
                  <div class="sm:col-span-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">
                      Description
                    </label>
                    <div class="mt-1">
                      <textarea required id="description" name="description" rows="3" class="shadow-sm focus:ring-keppel focus:border-keppel block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Write a description to what this service can provide to you.</p>
                  </div>
          
                  <div class="sm:col-span-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">
                      Category
                    </label>
                    <div class="mt-1">
                      <select required id="category" name="category" autocomplete="category" class="shadow-sm focus:ring-keppel focus:border-keppel block w-full sm:text-sm border-gray-300 rounded-md">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
        
                  <div class="sm:col-span-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">
                      Price
                    </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                      <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                        <i class="fa-solid fa-dollar-sign"></i>
                      </span>
                      <input required type="number" name="price" min="1" step="any" id="price" autocomplete="price" class="flex-1 focus:ring-keppel focus:border-keppel block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                    </div>
                  </div>
        
                  <div class="sm:col-span-6">
                    <label for="cover_photo" class="block text-sm font-medium text-gray-700">
                      Cover Photo
                    </label>
                    <div class="mt-1 flex">
                        <input required class="block w-full text-sm text-gray-900 cursor-pointer dark:text-gray-400 focus:outline-none" aria-describedby="file_input required_help" id="picture" name="picture" type="file">
                    </div>
                  </div>
                </div>
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
</x-app-layout>