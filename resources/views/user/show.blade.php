<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Article of ') . $user->name }}
        </h2>
    </x-slot>

    <main>
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


        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($articles as $article)
                        <div class="col">
                            <div class="card shadow-sm">
                                <Placeholder width="100%" height="225" background="#55595c" color="#eceeef" class="card-img-top" text="Thumbnail" />
                                <div class="card-body">
                                    <img src="{{ asset("storage/". $article->image->path) }}"  alt="">
                                    <h5 class="card-title">Article name : {{$article->name}}</h5>
                                    <h5 class="card-title">Created By : {{$article->creator->name}}</h5>
                                    <p class="card-text"></p>
                                    @foreach($article->categories as $category)
                                        <a href="{{route("category.show" , $category->id)}}" class="badge bg-primary text-decoration-none me-1"> {{ $category->name }}</a>
                                    @endforeach
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ route('article.show', $article->id) }}" class="btn btn-sm btn-outline-secondary">Read More</a>
                                            <form action="{{ route('article.destroy', $article->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Are you sure you want to delete this article?')">
                                                    Delete Article
                                                </button>
                                            </form>
                                            <a href="{{ route('article.edit', $article->id) }}" class="btn btn-sm btn-outline-primary">Edit Article</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            {{ $articles->links() }}
        </div>
    </main>

    <footer class="text-body-secondary py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Back to top</a>
            </p>
        </div>
    </footer>

</x-app-layout>
