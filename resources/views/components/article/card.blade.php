<div class="album py-5 bg-body-tertiary">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <div class="col">
                <div class="card shadow-sm">
                    <Placeholder width="100%" height="225" background="#55595c" color="#eceeef" class="card-img-top" text="Thumbnail" />
                    <div class="card-body">
                        <img src="..." class="card-img-top" alt="...">
                        <h5 class="card-title">Article name : {{$article->name}}</h5>
                        <p class="card-text"></p>
                        @foreach($article->categories as $category)
                            <a href="#" class="tag"> {{ $category->name }}</a>
                        @endforeach
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('article.show', $article->id) }}" class="btn btn-sm btn-outline-secondary">Read More</a>
                                <a href="{{ route('article.edit', $article->id) }}" class="btn btn-sm btn-outline-secondary">Edit Article</a>
                            </div>
                            <small class="text-body-secondary">9 mins</small>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
