<!-- Editing the question. -->
<div class="panel panel-default" v-if="editing">
    <div class="panel-heading">
        <div class="level">
            <input type="text" class="form-control" v-model="form.title">


        </div>
    </div>

    <div class="panel-body">
        <div class="form-group">
            <textarea class="form-control" rows="10" v-model="form.body"></textarea>
        </div>
    </div>

    <div class="panel-footer">
        <div class="level">
            <button class="btn btn-xs level-item" @click="editing = true" v-show="! editing">编辑</button>
            <button class="btn btn-success btn-xs level-item" @click="update">更新</button>
            <button class="btn btn-xs level-item" @click="resetForm">取消</button>

            @can('update', $thread)
            <form action="{{ $thread->path() }}" method="POST" class="ml-a">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger">删除</button>
            </form>
            @endcan
        </div>
    </div>
</div>

<!-- Viewing the question. -->
<div class="panel panel-default" v-else>
    <div class="panel-heading">
        <div class="level" >
            @if ($thread->creator->avatar_path)
                <img src="{{ $thread->creator->avatar_path }}" alt="{{ $thread->creator->name }}" width="25" height="25" class="mr-1">
            @endif

            <span class="flex">
                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> 发表了：
                <span v-text="title"></span>
            </span>

        </div>
    </div>

    <div class="panel-body" v-text="body"></div>

    <div class="panel-footer" v-if="authorize('owns', thread)">
        <button class="btn btn-xs" @click="editing = true">编辑</button>
    </div>
</div>
