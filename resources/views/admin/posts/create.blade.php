@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
          <label for="title">Title</label>
          <input class="form-control" type="text" name="title">
        </div>

        <div class="form-group">
          <label for="body">Body</label>
          <textarea class="form-control" name="body" id="body" cols="30" rows="10">

          </textarea>
        </div>
        
        <div class="form-group">
          <label for="tags">Tags</label>
          @foreach ($tags as $tag)
          <p>{{$tag->name}}</p>
          <input type="checkbox" name="tags[]" value="{{$tag->id}}"> <br>
          @endforeach
        </div>

        <div class="form-group">
          <select name="published" id="">
            <option value="" disabled selected>published</option>
            <option value="yes">yes</option>
            <option value="no">no</option>
          </select>
        </div>
        <div class="form-group">
          <input type="file" name="path_image" id="img" accept="image/*">
        </div>

        <button class="btn btn-success" type="submit">Salva</button>
      </form>
    </div>
  </div>
    
@endsection