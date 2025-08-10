<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Article Details') }}
        </h2>
    </x-slot>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="card shadow-sm mb-4">
                        @if($article->image)
                            <img src="{{ asset("storage/". $article->image->path) }}"  alt="">
                        @endif
                        <div class="card-body">
                            <h1 class="card-title h3 mb-3">{{ $article->name }}</h1>

                            @if($article->categories->count())
                                <div class="mb-3">
                                    @foreach($article->categories as $category)
                                        <a href="{{ route('category.show', $category->id) }}" class="badge bg-primary text-decoration-none me-1">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            <article class="card-text mb-4" style="line-height: 1.7; font-size: 1.1rem;">
                                {!! nl2br(e($article->body)) !!}
                            </article>

                            <div class="d-flex justify-content-between">
                                <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Back</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <footer class="text-muted py-4">
        <div class="container text-end">
            <a href="#">Back to top</a>
        </div>
    </footer>
</x-app-layout>
