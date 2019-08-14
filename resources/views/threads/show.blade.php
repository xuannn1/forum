@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="/css/vendor/jquery.atwho.css">
@endsection

@section('content')
<thread-view :thread="{{ $thread }}" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="level" >
                            @if ($thread->creator->avatar_path)
                                <img src="{{ $thread->creator->avatar_path }}" alt="{{ $thread->creator->name }}" width="25" height="25" class="mr-1">
                            @endif

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
                        <p>
                            该内容由
                            <a href="#">{{ $thread->creator->name }}</a>
                            发表于 {{ $thread->created_at->diffForHumans() }}
                            <br>
                            目前有
                            <span v-text="repliesCount"></span>
                            条回复
                        </p>
                        <p>
                            <subscribe-button :active="{{ json_encode($thread->isSubscribeTo) }}" v-if="signedIn"></subscribe-button>

                            <button class="btn btn-default"
                                v-if="authorize('isAdmin')"
                                @click="toggleLock"
                                v-text="locked ? '解除锁定' : '锁定'">
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</thread-view>
@endsection
