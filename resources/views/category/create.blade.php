<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>

<form action="{{route('category.store')}}" method = "POST">
    @csrf
    <input type="text" name="name" placeholder="Category Name">
    <button type="submit">Create Category</button>
</form>

</body>
</html>
