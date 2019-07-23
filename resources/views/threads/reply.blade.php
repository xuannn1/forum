<div id="reply-{{ $reply->id }}" class="panel panel-default">
    <div class="panel-heading">
        <div class="level">
            <h5 class="flex">
                <a href="{{ route('profile', $reply->owner) }}">{{ $reply->owner->name }}</a>
                回复于
                {{ $reply->created_at->diffForHumans() }}
            </h5>

            <div class="">
                <form class="" action="/replies/{{ $reply->id }}/favorites" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-default" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }}喜欢
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="panel-body">
        {{ $reply->body }}

    </div>
</div>
