@forelse($threads as $thread)
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="level">
                <div class="flex">
                    <h4>
                        <a href="{{ $thread->path() }}">
                            @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                            <strong>
                                {{ $thread->title }}
                            </strong>
                            @else
                            {{ $thread->title }}
                            @endif
                        </a>
                    </h4>

                    <h5>
                        由
                        <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>
                        发表
                    </h5>
                </div>

                <a href="{{ $thread->path() }}">
                    {{ $thread->replies_count }} 条回复
                </a>
            </div>
        </div>

        <div class="panel-body">
            <div class="body">
                {{ $thread->body }}
            </div>
        </div>

        <div class="panel-footer">
            {{ $thread->visits()->count() }} 访问数
        </div>
    </div>
@empty
    <p>没有相关内容</p>
@endforelse
