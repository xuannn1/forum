<template>
    <div>
        <div v-if="signedIn">
            <div class="form-group">
                <textarea name="body"
                    id="body"
                    class="form-control"
                    placeholder="说点什么..."
                    rows="5"
                    required
                    v-model="body">
                </textarea>
            </div>

            <button type="submit"
                class="btn btn-default"
                @click="addReply">提交
            </button>
        </div>

        <p class="text-center" v-else>
            请<a href="/login">登录</a>
            后发表评论
        </p>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                body: '',
            }
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            }
        },

        methods: {
            addReply() {
                axios.post(location.pathname + '/replies', { body: this.body })
                    .catch(error => {
                        flash(error.response.data, 'danger');
                    })
                    .then(({data}) => {
                        this.body = '';

                        flash('你的回复已成功发表！');

                        this.$emit('created', data);
                    });
            }
        }
    }
</script>
