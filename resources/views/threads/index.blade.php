
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @include('threads._list')

            {{ $threads->render() }}
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    搜素
                </div>
                <div class="panel-body">
                    <form action="/threads/search" method="GET">
                        <div class="form-group">
                            <input type="text" placeholder="请输入你要查找的内容..." name="q" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default">搜索</button>
                        </div>
                    </form>
                </div>
            </div>

            
        </div>
    </div>
</div>
@endsection
