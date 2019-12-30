<template>
  <div>
    <!-- 编辑问题 -->
    <div class="panel panel-default" v-if="editing">
      <div class="panel-heading">
        <div class="level">
          <input type="text" class="form-control" v-model="form.title" />
        </div>
      </div>

      <div class="panel-body">
        <div class="form-group">
          <!-- <textarea class="form-control" rows="10" v-model="form.body"></textarea> -->
          <wysiwyg v-model="form.body" :value="form.body"></wysiwyg>
        </div>
      </div>

      <div class="panel-footer">
        <div class="level">
          <button
            class="btn btn-xs level-item"
            @click="editing = true"
            v-show="!editing"
          >
            编辑
          </button>
          <button class="btn btn-success btn-xs level-item" @click="update">
            发布
          </button>
          <button class="btn btn-xs level-item" @click="resetForm">取消</button>

          <button type="submit" class="btn btn-danger" @click="deleteThread">
            删除
          </button>
        </div>
      </div>
    </div>
    <!-- 显示问题 -->
    <div class="panel panel-default" v-else>
      <div class="panel-heading">
        <div class="level">
          <img :src="threadAvatar" alt="" class="avatar mr-1" />

          <span class="flex">
            <a href=""></a>
            <span>{{ threadCreatorName }}</span>
            发表了：
            <span v-text="thread.title"></span>
          </span>
        </div>
      </div>

      <div class="panel-body" v-html="thread.body"></div>

      <div class="panel-footer" v-if="authorize('owns', thread)">
        <button class="btn btn-xs" @click="editing = true">编辑</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["thread"],

  data() {
    return {
      title: this.thread.title,
      body: this.thread.body,
      threadAvatar: this.thread.creator.avatar_path,
      threadCreatorName: this.thread.creator.name,
      form: {},
      editing: false
    };
  },

  created() {
    this.resetForm();
  },

  methods: {
    update() {
      let uri = `/threads/${this.thread.channel.slug}/${this.thread.slug}`;

      axios.patch(uri, this.form).then(() => {
        this.editing = false;
        this.title = this.form.title;
        this.body = this.form.body;

        flash("你的话题内容已经更新成功！");
      });
    },

    resetForm() {
      this.form = {
        title: this.thread.title,
        body: this.thread.body
      };

      this.editing = false;
    },

    deleteThread() {
      let uri = `/threads/${this.thread.channel.slug}/${this.thread.slug}`;
      window.confirm("你确定要删除本话题？");
      axios.delete(uri);
    }
  }
};
</script>

<style scoped>
.avatar {
  display: inline-block;
  width: 25px;
  height: 25px;
  border-radius: 100%;
}
</style>
