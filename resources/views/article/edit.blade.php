<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Article') }}
        </h2>
    </x-slot>

<div class="container">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <main>

        <div class="row g-5">
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Edit {{$article->name}} Article</h4>
                <form action="{{route('article.update',$article->id)}}" method = "POST" class="needs-validation" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="name" class="form-label">Article Name</label>
                            <input type="text" class="form-control" name="name" value="{{$article->name}}">
                        </div>
                        <div class="col-12">
                            <label for="body" class="form-label">Body</label>
                            <textarea class="form-control" name="body" rows="10">{{  $article->body}}</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="col-md-5">
                            <label for="country" class="form-label">Categories</label>
                            <select class="js-example-basic-multiple" name="categories[]" multiple="multiple">
                                @foreach($categories as $category)
                                    <option  {{ in_array($category->id,$selectedCategory) ? 'selected' : '' }}
                                            value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <hr class="my-4">
                    <button class="w-30 btn btn-primary btn-lg" type="submit">Edit Article</button>
                    <a href="{{url()->previous()}}" class="w-20 btn btn-danger btn-lg" type="submit">Back</a>
                </form>


            </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
</div>
</x-app-layout>
