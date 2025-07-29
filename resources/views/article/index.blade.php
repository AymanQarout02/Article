<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>

    <div>
        <h1>All Articles</h1>
        <ul>
            @foreach($articles as $article)
                <h1>Article name : {{$article->name}}</h1>
                @foreach($article->categories as $category)
                    <h2>Category: {{ $category->name }}</h2>
                @endforeach
                <a href="{{ route('article.show', $article->id) }}">Read More</a>
            @endforeach
        </ul>

    </div>

</body>
</html>
