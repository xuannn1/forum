<template>
    <div>
        <div v-if="signedIn">
            <div class="form-group">
                <wysiwyg name="body" v-model="body" placeholder="说点什么..." :shouldClear="completed"></wysiwyg>
                <!-- <textarea name="body"
                    id="body"
                    class="form-control"
                    placeholder="说点什么..."
                    rows="5"
                    required
                    v-model="body">
                </textarea> -->
            </div>

            <button type="submit"
                class="btn btn-default"
                @click="addReply">发布
            </button>
        </div>

        <p class="text-center" v-else>
            请<a href="/login">登录</a>
            后发表评论
        </p>
    </div>
</template>

<script>
    import 'jquery.caret';
    import 'at.js';

    export default {
        data() {
            return {
                body: '',
                completed: false
            }
        },

        mounted() {
            $('#body').atwho({
                at: "@",
                delay: 750,
                callbacks: {
                    remoteFilter: function(query, callback) {
                        $.getJSON("/api/users", {name: query}, function(usernames) {
                            callback(usernames)
                        });
                    }
                }
            });
        },

        methods: {
            addReply() {
                axios.post(location.pathname + '/replies', { body: this.body })
                    .catch(error => {
                        flash(error.response.data, 'danger');
                    })
                    .then(({data}) => {
                        this.body = '';
                        this.completed = true;

                        flash('你的回复已成功发表！');

                        this.$emit('created', data);
                    });
            }
        }
    }
</script>
