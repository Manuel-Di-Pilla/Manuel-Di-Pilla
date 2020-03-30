@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
                <div>
                    <a href="{{route('posts.index')}}" style="text-decoration:none; margin-left:20px">Vedi i tuoi post</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection