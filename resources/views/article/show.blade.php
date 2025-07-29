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
            <h1>Article name : {{$article->name}}</h1>
            <p>{{$article->body}}</p>
            @foreach($article->categories as $category)
                <h2>Categories: {{ $category->name }}</h2>
            @endforeach

            <a href="{{ route('article.index') }}">Back</a>
    </ul>

</div>

</body>
</html>
