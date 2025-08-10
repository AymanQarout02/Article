<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Categories') }}
        </h2>
    </x-slot>

    <main>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <div class="container py-5">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach($categories as $category)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column">

                                <h5 class="card-title d-flex justify-content-between align-items-center">
                                    <span class="text-primary">{{ $category->name }}</span>
                                    <span class="badge bg-secondary">{{ $category->articles->count() }}</span>
                                </h5>

                                @if($category->articles->isEmpty())
                                    <p class="text-muted">No articles in this category.</p>
                                @else
                                    <div class="list-group mb-3">
                                        @foreach($category->articles as $article)
                                            <a href="{{ route('article.show', $article->id) }}"
                                               class="list-group-item list-group-item-action">
                                                {{ $article->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-lg">Back</a>
        </div>
    </main>
</x-app-layout>
