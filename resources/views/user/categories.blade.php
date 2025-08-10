<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{  "All -" .  $user->name . "- Categories" }}
        </h2>
    </x-slot>

    <main>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($categories as $category)
                        <div class="col">
                            <div class="card shadow-sm">
                                <Placeholder width="100%" height="225" background="#55595c" color="#eceeef" class="card-img-top" text="Thumbnail" />
                                <div class="card-body">
                                    <h5 class="card-title">Category Name : {{$category->name}}</h5>
                                    <p class="card-text"></p>
                                    @foreach($category->articles as $article)
                                        <a href="{{ route('article.show', $article->id) }}" class="btn btn-sm btn-outline-secondary"> {{ $article->name }}</a>
                                    @endforeach
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-secondary">Edit Category</a>
                                        </div>
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure you want to delete this article?')">
                                                Delete Category
                                            </button>
                                        </form>
                                        <a href="{{url()->previous()}}" class="btn btn-primary btn-sm" type="submit">Back</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    <div>
        {{ $categories->links() }}
    </div>
    <footer class="text-body-secondary py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Back to top</a>
            </p>
        </div>
    </footer>

</x-app-layout>
