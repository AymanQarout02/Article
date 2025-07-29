<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>

<form action="{{route('article.store')}}" method = "POST">
    @csrf
    <input type="text" name="name" placeholder="Article Name">
    <input type="text" name="body" placeholder="Article Body">
    <select name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <button type="submit">Create Article</button>

</form>

</body>
</html>
