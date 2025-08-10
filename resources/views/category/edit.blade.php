<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category ') . $category->name }}
        </h2>
    </x-slot>
<div class="container">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <main>
        <div class="row g-5">
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Create Category</h4>
                <form action="{{route('category.update' , $category->id)}}" method = "POST" class="needs-validation">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" value ="{{$category->name}}" class="form-control" name="name">
                        </div>
                    </div>
                    <hr class="my-4">
                    <button class="w-100 btn btn-primary btn-lg" type="submit">Update Article</button>
                </form>
            </div>
        </div>
    </main>
</div>
</x-app-layout>
