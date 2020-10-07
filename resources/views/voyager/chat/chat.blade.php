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
        $(document).ready(function(){
            $.ajax({
                url:"{{route('ajax.u_l')}}",
                success:function(result){
                    if (result.status_code === 200) {
                        var html = '';
                        result.data.forEach(function(e){
                            html+='<div class="chat-user" id="uid_'+(e.id)+'">' +
                                '<span class="pull-right label label-primary">在线</span>' +
                                '<img class="chat-avatar" src="'+e.avatar+'" alt="">' +
                                '<div class="chat-user-name">' +
                                '<a href="#">'+e.name+'</a>' +
                                '</div>' +
                                '</div>';
                        });
                        $(".users-list").html(html);
                    }
                }});
        });

        $(function(){
//在预定义函数中增加对 textarea的监听
            addListtenr();
        });

        /*增加监听*/
        function addListtenr(){
            $("textarea").each(function(index) {
                $("textarea")[index].addEventListener('keydown',function(e){
                    if(e.keyCode!=13){
                        return;
                    }else{//当按键输入为回车时，执行下列操作
                        if(checkWS()){
                            event.preventDefault();//为了兼容IE8
                            e.returnValue = false;
                            content = $(this).val()+'\n';//手动增加换行符

                            console.log(content);
                            send_message_before(content);
                            // $(this).html('');
                            // $(this).val(e).focus();//定义焦点还是在这个控件上
                        }else{
                            alert('服务器未连接');
                        }
                    }
                });
            });
        }

        var My_uid = '{{$user_info->id}}';
        var My_name = '{{$user_info->name}}';
        var to_uid = '{{$user_info->id == 1 ? 4 : 1}}';
        var to_name = '{{$user_info->name == '刀刀' ? 'Admin' : '刀刀'}}';

        try {
            // 假设服务端ip为127.0.0.1
            ws = new WebSocket('ws://{{env('WORKER_MAN_CONNECT')}}');
        }catch (e) {
            console.log(e)
        }

        function send_message_before(content) {
            var info = {};
            info['type']=1;
            info['i']=My_uid;
            info['to_uid']=to_uid;
            info['message']=content;
            console.log(info);
            ws_send(info);
        }
        //开启心跳
        var Timer_work = setInterval(function () {
            if(checkWS()){
                var info = {};
                info['type']=0;
                info['i']=My_uid;

                // console.log(JSON.stringify( info ));
                ws_send(info);
            }
        }, 55000);

        ws.onopen = function() {
            alert("连接成功");
            var info = {};
            info['type']=0;
            info['i']=My_uid;

            ws_send(info);
        };
        ws.onmessage = function(e) {
            console.log(e.data);
            alert("收到服务端的消息：" + e.data);
        };

        //随机用户id //后续token验权
        function random(min, max) {
            return Math.floor(Math.random() * (max - min)) + min;
        }

        function checkWS() {
            if (ws.readyState === WebSocket.OPEN) {
                return true;
            }
            return false;
        }

        function ws_send(message) {
            if(checkWS()){
                message = JSON.stringify( message );
                ws.send(message);
            }else{
                alert("socket 未连接");
                return false;
            }
        }

        function myFunction2() {
            close_work();
        }

        function close_work() {
            clearInterval(Timer_work);
            ws.close()
        }
    </script>

@stop
