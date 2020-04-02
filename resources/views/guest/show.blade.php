@extends('layouts.app')
@section('content')
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>User Id</th>
          <th>Body</th>
          <th>Created At</th>
          <th>Updated At</th>
          @if ($post->path_image == null)
              
          @else
              <th>Image</th>
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
          @if ($post->path_image == null)
              
          @else
            <th><img src="{{asset('storage/' . $post->path_image)}}" alt=""></th>
          @endif
        </tr>        
      </tbody>
    </table>
    <div class="comments">
      @foreach ($comments as $comment)
        <h4>{{$comment->name}}</h4>
        <p>{{$comment->text}}</p>
      @endforeach
      <form action="{{route('comment.store')}}" method="post">
        @csrf
        @method('POST')
        <div class="form-group">
          <h2 style="margin-left:40%">Aggiungi un commento</h2>
          <label for="text">Text</label>
          <textarea class="form-control" name="text" id="text" cols="30" rows="10"></textarea>
          <input type="hidden" name="id" value="{{$post->id}}">
          <input type="hidden" name="slug" value="{{$post->slug}}">
        </div>
        
        <button class="btn btn-success" type="submit">Aggiungi commento</button>
      </form>
    </div>
@endsection