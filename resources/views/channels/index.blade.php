@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel panel-body">
                    <form action="/channels" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="name">频道名：</label>
                          <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                          <label for="slug">频道 slug：</label>
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
                </div>
            </div>

            @foreach(\App\Channel::all() as $channel)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $channel->id }}
                    </div>

                    <div class="panel-body">
                        <div class="level">
                            <span class="flex">
                                {{ $channel->name }}
                            </span>

                            <form action="{{ '/channels/' . $channel->slug }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-xs btn-danger">删除</button>
                            </form>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</div>


@endsection
