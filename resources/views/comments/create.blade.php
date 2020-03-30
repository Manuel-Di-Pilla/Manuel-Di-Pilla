@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <form action="{{route('comment.store')}}" method="post">
        @csrf
        @method('POST')
        <div class="form-group">
          <label for="text">Text</label>
          <textarea class="form-control" name="text" id="text" cols="30" rows="10">

          </textarea>
        </div>
        
        <button class="btn btn-success" type="submit">Aggiungi commento</button>
      </form>
    </div>
  </div>
    
@endsection