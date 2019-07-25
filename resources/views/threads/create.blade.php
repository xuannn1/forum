@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a new Thread</div>

                <div class="panel-body">
                    <form action="/threads" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                          <label for="channel_id">频道：</label>
                          <select class="form-control" name="channel_id" id="channel_id" required>
                              <option value="">请选择一个~</option>
                              @foreach($channels as $channel)
                                  <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected':'' }}>
                                      {{ $channel->name }}
                                  </option>
                              @endforeach
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="title">标题：</label>
                          <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
                        </div>

                        <div class="form-group">
                          <label for="body">内容：</label>
                          <textarea name="body" id="body" class="form-control" rows="8" required>{{ old('body') }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">发表</button>
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
        </div>
    </div>
</div>
@endsection
