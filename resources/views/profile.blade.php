<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
</head>

<body>
    <div>
        <h1>My Profile</h1>
        <p>Name: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        <a href="{{ route('post.index') }}"><button class="btn btn-primary">Back to Posts</button></a>
    </div>
</body>

</html>