@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="/css/vendor/jquery.atwho.css">
@endsection

@section('content')
<thread-view :thread="{{ $thread }}" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8" v-cloak>
                
                <thread-question :thread="{{ $thread }}"></thread-question>

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

                            <!-- <span class="glyphicon glyphicon-lock"></span> -->
                            <button
                                v-bind:class="locked ? 'btn btn-primary' : 'btn btn-default'"
                                v-if="authorize('isAdmin')"
                                @click="toggleLock"
                                v-text="locked ? '解除锁定' : '锁定该话题'">
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</thread-view>
@endsection
