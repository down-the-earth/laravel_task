<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <h1>Post</h1>Welcome, {{ session('user')->name }}!
        <p>This is the post page. Only authenticated users can see this page.</p>
        <a href="{{route('add_post')}}"><button type="submit" class="btn btn-primary">Add Post</button></a>
        <a href="{{route('mypost')}}"><button type="submit" class="btn btn-success">My Post</button></a>
        <a href="{{route('logout')}}"><button class="btn btn-danger">Logout</button></a>
        <hr>

        @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <div class="card-header">Author: <strong>{{ $post->user->name }}</strong></div>
                <div class="card mt-2">
                    <div>

                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Posted on {{ $post->created_at->format('F j, Y, g:i a') }}</small>
                            <form action="{{ route('comment.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="hidden" name="user_id" value="{{ session('user')->id }}">
                                <textarea name="content" id="cmt-{{ $post->id }}" class="form-control mt-2" placeholder="Add a comment..." rows="2"></textarea>


                                <button type="submit" class="btn btn-primary mt-2">Add Comment</button>
                            </form>
                            <div class="mt-3">
                                <h6>Comments:</h6>
                                @foreach($post->comments as $comment)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <p class="card-text">{{ $comment->content }}</p>
                                        <small class="text-muted">Commented by {{ $comment->user->name }} on {{ $comment->created_at->format('F j, Y, g:i a') }}</small>
                                    </div>
                                </div>
                                @endforeach

                            </div>

                        </div>

                    </div>


                </div>
            </div>
            @endforeach


        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>