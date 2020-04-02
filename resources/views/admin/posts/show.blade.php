@extends('layouts.app')
@section('content')
<a href="{{route('posts.index')}}">Torna a i post</a>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>User Id</th>
          <th>Body</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th>published</th>
          @if ($post->path_image == null)
              
          @else
              <th>image</th>
          @endif
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$post->id}}</td>
          <td>{{$post->title}}</td>
          <td>{{$post->user_id}}</td>
          <td>{{$post->body}}</td>
          <td>{{$post->created_at}}</td>
          <td>{{$post->updated_at}}</td>
          <td>{{$post->published}}</td>
          @if ($post->path_image == null)
              
          @else
              <td><img src="{{asset('storage/' . $post->path_image)}}" alt=""></td>
          @endif
        </tr>        
      </tbody>
    </table>
    <div class="comments">
      @foreach ($comments as $comment)
        <h4>{{$comment->name}}</h4>
        <p>{{$comment->text}}</p>
      @endforeach
    </div>
@endsection