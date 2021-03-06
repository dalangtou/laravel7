<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Workerman\Lib\Timer;
use Workerman\Worker;

class Workerman extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:workerman {action} {--daemonize}';

    //心跳间距  超过服务器主动断开连接
    const HEARTBEAT_TIME = 60;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command workerman-description';

    /**
     * @var Worker
     */
    protected $worker;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // header("Access-Control-Allow-Origin: *"); // 允许任意域名发起的跨域请求
        // header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        // header('Access-Control-Allow-Methods: GET, POST, PUT,OPTIONS');

        global $argv;//定义全局变量
        $arg = $this->argument('action');
        $argv[1] = $arg;
        $argv[2] = $this->option('daemonize') ? '-d' : '';//该参数是以daemon（守护进程）方式启动

        // 创建一个Worker监听xx端口，使用http协议通讯
        // $this->worker = new Worker('websocket://127.0.0.1:10101');
        $this->worker = new Worker(env('SERVICE_WORKER_MAN_CONNECT'));

        // 启动4个进程对外提供服务
        $this->worker->count = 4;

        $this->worker->sphygmus = [];

        $this->worker->onWorkerStart = function($worker)
        {
            //心跳检测定时器
            Timer::add(10,function($worker){
                foreach ($worker->sphygmus as $uid => $time){
                    if (time() - $time > self::HEARTBEAT_TIME) {
                        $worker->uidConnections[$uid]->close();
                        unset($worker->sphygmus[$uid],$worker->uidConnections[$uid]);
                    }
                }
            },array($worker));

            // 开启一个内部端口，方便内部系统推送数据，Text协议格式 文本+换行符
            $inner_text_worker = new Worker('text://0.0.0.0:5678');
            $inner_text_worker->onMessage = function($connection, $buffer) use($worker)
            {
                // $data数组格式，里面有uid，表示向那个uid的页面推送数据
                $buffer = json_decode($buffer, true);

                Log::info('send1',$buffer);
                if (isset($buffer['uid'])) {
                    $uid = $buffer['uid'];
                    // 通过workerman，向uid的页面推送数据
                    $ret = sendMessageByUid($worker,$uid, $buffer);
                    // 返回推送结果
                    $connection->send($ret ? 'ok' : 'fail');
                }else {
                    $ret = broadcast($worker,$buffer);
                    // 返回推送结果
                    $connection->send($ret ? 'ok' : 'fail');
                }

            };
            // ## 执行监听 ##
            $inner_text_worker->listen();
        };

        /*
         * var Array $this->worker->uidConnections
         * 新增加一个属性，用来保存uid到connection的映射
         * */
        $this->worker->uidConnections = array();

        // 当有客户端发来消息时执行的回调函数
        $this->worker->onMessage = function($connection, $data)
        {
            $data = json_decode($data,true);

            switch ($data['type']){
                case 0://连接//心跳
                    $uid = $data['i'];
//            global $worker;
                    // 判断当前客户端是否已经验证,既是否设置了uid
                    if(!isset($this->worker->uidConnections[$uid]))
                    {
                        // 没验证的话把第一个包当做uid（这里为了方便演示，没做真正的验证）
//                    $connection->uid = $data;
                        /* 保存uid到connection的映射，这样可以方便的通过uid查找connection，
                         * 实现针对特定uid推送数据
                         */
                        $this->worker->uidConnections[$uid] = $connection;

//                return;
                    }
                    $this->worker->sphygmus[$uid] = time(); // 脚本每隔55s 请求一次  60s无响应自动断开

                    Log::info('work',$this->worker->uidConnections);
                    break;
                case 1://用户之间聊天
                    if (isset($data['to_uid'])){

                        if (isset($this->worker->uidConnections[$data['to_uid']])) {
                            $connection = $this->worker->uidConnections[$data['to_uid']];
                            // 向客户端发送hello $data
                            $connection->send("来自 {$data['i']}: {$data['message']} ");
                        }else{
                            $connection->send('系统提示:该用户不在线!');
                        }
                    }
                    break;
                case 2://用户与后台沟通
                    //
                    break;
                default:
                    //
                    break;
            }

        };

        // 当有客户端连接断开时
        $this->worker->onClose = function($connection)
        {
//            global $worker;
            if(isset($connection->uid))
            {
                // 连接断开时删除映射
                unset($this->worker->uidConnections[$connection->uid]);

                Log::info('work',$this->worker->uidConnections);
            }
        };

        // 向所有验证的用户推送数据
        function broadcast($worker,$message)
        {
            Log::info('send',[$message]);
//            global $worker;
            foreach($worker->uidConnections as $connection)
            {
                $connection->send(json_encode($message));
            }
        }

        // 针对uid推送数据
        function sendMessageByUid($worker,$uid, $message)
        {
            Log::info('send2',[$message]);
//            global $worker;
            if(isset($worker->uidConnections[$uid]))
            {
                $connection = $worker->uidConnections[$uid];
                $connection->send(json_encode($message));
                return true;
            }
            return false;
        }

        // 运行worker
        Worker::runAll();
    }
}
