@component('profiles.activities.activity')
    @slot('heading')
        {{ $profileUser->name }} 发表了新帖
        <a href="{{ $activity->subject->path() }}">
            {{ $activity->subject->title }}
        </a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent
