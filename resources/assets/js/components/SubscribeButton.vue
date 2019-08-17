<template>
    <button :class="classes" @click="subscribe">
        <span class="glyphicon glyphicon-star-empty"></span>
        订阅
    </button>
</template>

<script>
    export default {
        props: ['active'],

        computed: {
            classes() {
                return ['btn', this.active ? 'btn-primary' : 'btn-default'];
            }
        },

        methods: {
            subscribe() {
                axios[
                    (this.active ? 'delete' : 'post')
                ](location.pathname + '/subscriptions');

                this.active = ! this.active;
            }
        }
    }
</script>
