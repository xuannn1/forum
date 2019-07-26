## 模型
#### Thread
- 一个thread有多个reply
- 一个thread属于一个user
- 一个thread属于一个channel

#### Reply
- 一个reply属于一个thread
- 多个reply属于一个user

#### User
- 一个user可以创建一个thread
- 一个user可以创建、修改、删除一个reply
- 一个user可以点赞、取消点赞（favorite）
- 一个user创建一个thread、reply、favorite时会创建一条activity

#### Channel
- 一个channel有多个thread

#### Activity

#### Favorite

## 用户行为


## 组件
- Flash：创建一个提示信息，并在三秒后消失
- Reply：用户可以编辑、删除自己发布的reply，在编辑状态下，可以提交修改或退出。引用了Favorite组件。
- Favorite：用户可以点赞、取消点赞。


# Replies.vue组件
Replies组件从服务器获取了所需的数据（fetch），laravel进行了eloquest查询并返回结果。
当fetch结束后，我们进行刷新（refresh）操作，保存dataSet。
然后的意思大概就是将dataSet的值传给Paginator组件。
Replies是Paginator的父组件
broadcast方法用来发出updated消息，来告诉Replies组件，它需要获取新的数据
- paginator的工作流：
当点击next按钮，触发click事件，page++。在
watch里面，监听到page发生改变，触发broadcast方法。broadcast向父组件（replies）发送updated以及当前页数this.page。在Repliles组件中，当监听到updated信息，触发fetch方法。在fetch方法中可以获取当前页的url，然后获得当前页的replies数据，最后调用refresh方法，将dataSet更新为新获取的数据。Relies组件是将dataSet传递给Paginator组件的，所以当dataSet发生改变时，Paginator组件在watch中监听到该事件，更新当前的page、preUrl、nextUrl数据。shouldPaginate属性通过计算，得知当前页面是否有前一页/后一页，从而控制是否显现按钮。



# 问题
* props: []
* data() {}
* computed: {}
* methods: {}
* @click在链接中，定义新的动作，要加 @click.prevent ?
* 看清楚位置

# window类
window.scrollTo(0, 0); //回到页面最上面
window.App.signedIn //获取用户是否登录信息

## 模型使用
- 在boot方法中监听事件
- 用increment给某个数据+1,decrement -1
