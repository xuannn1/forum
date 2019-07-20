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
                          <label for="title">标题：</label>
                          <input type="text" class="form-control" name="title" id="title">
                        </div>

                        <div class="form-group">
                          <label for="body">内容：</label>
                          <textarea name="body" id="body" class="form-control" rows="8"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">发表</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
