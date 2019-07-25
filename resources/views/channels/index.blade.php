@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form action="/channels" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                  <label for="name">channel_name：</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                  <label for="slug">channel_slug：</label>
                  <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">create</button>
                </div>

                @if(count($errors))
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

            </form>


            @foreach($channels as $channel)
                <div class="page-header">
                    <div class="level">
                        <span class="flex">
                            {{ $channel->name }}
                        </span>
                        <span>
                            {{ $channel->id }}
                        </span>
                    </div>
                </div>
            @endforeach
            
        </div>

    </div>
</div>


@endsection
