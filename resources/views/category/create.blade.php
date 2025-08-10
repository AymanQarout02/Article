<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

<body>
<div class="container">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <main>
        <div class="row g-5">
            <div class="col-md-7 col-lg-8">
                <form action="{{route('category.store')}}" method = "POST" class="needs-validation">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Category Name">
                        </div>
                    </div>
                    <hr class="my-4">
                    <button class="w-100 btn btn-primary btn-lg" type="submit">Create Category</button>
                    <a href="{{url()->previous()}}" class="w-20 btn btn-primary btn-lg" type="submit">Back</a>

                </form>
            </div>
        </div>
    </main>
</div>

</x-app-layout>
