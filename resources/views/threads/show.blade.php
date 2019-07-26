@extends('layouts.app')

@section('content')
<thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="level" >
                            <span class="flex">
                                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> 发表了：
                                {{ $thread->title }}
                            </span>

                            @can('update', $thread)
                                <form action="{{ $thread->path() }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">删除</button>
                                </form>
                            @endcan
                        </div>
                    </div>

                    <div class="panel-body">
                        {{ $thread->body }}

                    </div>
                </div>

                <replies @added="repliesCount++" @removed="repliesCount--">
                </replies>

            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        该内容由
                        <a href="#">{{ $thread->creator->name }}</a>
                        发表于 {{ $thread->created_at->diffForHumans() }}
                        <br>
                        目前有
                        <span v-text="repliesCount"></span>
                        条回复
                    </div>
                </div>
            </div>
        </div>
    </div>
</thread-view>
@endsection
