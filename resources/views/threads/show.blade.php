@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="#">{{ $thread->creator->name }}</a> 发表了：
                    {{ $thread->title }}
                </div>

                <div class="panel-body">
                    {{ $thread->body }}

                </div>
            </div>
            @foreach($replies as $reply)
                @include('threads.reply')
            @endforeach
            {{ $replies->links() }}

            @if(auth()->check())
                <form action="{{ $thread->path().'/replies' }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control" placeholder="说点什么..." rows="5">
                        </textarea>
                    </div>

                    <button type="submit" class="btn btn-default">提交</button>
                </form>
            @else
                <p class="text-center">请
                    <a href="{{ route('login') }}">登录</a>
                    后发表评论
                </p>
            @endif
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    该内容由
                    <a href="#">{{ $thread->creator->name }}</a>
                    发表于 {{ $thread->created_at->diffForHumans() }}
                    <br>
                    目前有
                    {{ $thread->replies_count }}
                    条回复
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
