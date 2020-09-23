@extends('voyager.master')
@section('content')

{{--    <link rel="shortcut icon" href="favicon.ico">--}}
    <link href="{{asset('static/css/chat/bootstrap.min14ed.css')}}?v=3.3.6" rel="stylesheet">
    <link href="{{asset('static/css/chat/font-awesome.min93e3.css')}}?v=4.4.0" rel="stylesheet">
    <link href="{{asset('static/css/chat/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/chat/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/chat/style.min862f.css')}}?v=4.1.0" rel="stylesheet">
    <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">

    <!-- Mirrored from www.zi-han.net/theme/hplus/chat_view.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:48 GMT -->
    {{--<head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <title>H+ 后台主题UI框架 - 聊天窗口</title>

        <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
        <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">



    </head>--}}

{{--    <body class="gray-bg">--}}
<?php
$user_info = Auth::user();
?>
<style>
    /*.chat-discussion .chat-message{*/
    /*    width: 61.8%*/
    /*}*/

    .chat-discussion .chat-other .message-avatar {
        float: left;
        margin-right: 10px
    }

    .chat-discussion .chat-my .message-avatar {
        float: right;
        margin-left: 10px
    }
    .chat-discussion .chat-other .message-date {
        float: right
    }

    .chat-discussion .chat-my .message-date {
        float: left
    }

    .chat-discussion .chat-other .message {
        text-align: left;
        margin-left: 55px
    }

    .chat-discussion .chat-my .message {
        text-align: right;
        margin-right: 55px
    }
    .chat-item {
        margin : 10px
    }
    /*.chat-item-item {*/
    /*    width: 61.8%;*/
    /*}*/
</style>

    <div class="wrapper wrapper-content  animated fadeInRight">

        <div class="row">
            <div class="col-sm-12">

                <div class="ibox chat-view">

                    <div class="ibox-title">
                        <small class="pull-right text-muted">最新消息：2015-02-02 18:39:23</small> 聊天窗口
                    </div>


                    <div class="ibox-content">

                        <div class="row">

                            <div class="col-md-9 ">
                                <div class="chat-discussion">

                                    <div class="chat-item chat-my">
                                        <img class="message-avatar" src="{{ asset('static/imgs').'/'.$user_info->avatar  }}" alt="">
                                        <div class="message chat-item-item">
                                            <a class="message-author" href="#"> 颜文字君</a>
                                            <span class="message-date"> 2015-02-02 18:39:23 </span>
                                            <span class="message-content">
                                                H+ 是个好框架
                                                </span>
                                        </div>
                                    </div>
                                    <div class="chat-item chat-other">
                                        <img class="message-avatar" src="{{ asset('static/imgs').'/'.$user_info->avatar  }}" alt="">
                                        <div class="message chat-item-item">
                                            <a class="message-author" href="#"> 林依晨Ariel </a>
                                            <span class="message-date">  2015-02-02 11:12:36 </span>
                                            <span class="message-content">
                                                jQuery表单验证插件 - 让表单验证变得更容易
                                                jQuery表单验证插件 - 让表单验证变得更容易
                                                jQuery表单验证插件 - 让表单验证变得更容易
                                                jQuery表单验证插件 - 让表单验证变得更容易
                                                jQuery表单验证插件 - 让表单验证变得更容易
                                                jQuery表单验证插件 - 让表单验证变得更容易
                                                jQuery表单验证插件 - 让表单验证变得更容易
                                                jQuery表单验证插件 - 让表单验证变得更容易
                                                jQuery表单验证插件 - 让表单验证变得更容易
                                                jQuery表单验证插件 - 让表单验证变得更容易
                                                </span>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="chat-users">


                                    <div class="users-list">
                                        <div class="chat-user">
                                            <img class="chat-avatar" src="{{ asset('static/imgs').'/'.$user_info->avatar  }}" alt="">
                                            <div class="chat-user-name">
                                                <a href="#">伤城Simple</a>
                                            </div>
                                        </div>
                                        <div class="chat-user">
                                            <img class="chat-avatar" src="{{ asset('static/imgs').'/'.$user_info->avatar  }}" alt="">
                                            <div class="chat-user-name">
                                                <a href="#">从未出现过的风景__</a>
                                            </div>
                                        </div>
                                        <div class="chat-user">
                                            <span class="pull-right label label-primary">在线</span>
                                            <img class="chat-avatar" src="{{ asset('static/imgs').'/'.$user_info->avatar  }}" alt="">
                                            <div class="chat-user-name">
                                                <a href="#">冬伴花暖</a>
                                            </div>
                                        </div>
                                        <div class="chat-user">
                                            <span class="pull-right label label-primary">在线</span>
                                            <img class="chat-avatar" src="{{ asset('static/imgs').'/'.$user_info->avatar  }}" alt="">
                                            <div class="chat-user-name">
                                                <a href="#">ZM敏姑娘	</a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="chat-message-form">

                                    <div class="form-group">

                                        <textarea class="form-control message-input" name="message" placeholder="输入消息内容，按回车键发送"></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('static/js/chat/jquery.min.js')}}?v=2.1.4"></script>
    <script src="{{asset('static/js/chat/bootstrap.min.js')}}?v=3.3.6"></script>
    <script src="{{asset('static/js/chat/content.min.js')}}?v=1.0.0"></script>
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
{{--    </body>--}}


@stop

@section('javascript')
    <script>

    </script>

@stop
