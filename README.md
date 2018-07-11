这是一个用于处理日志的库，目前支持的引擎有 file、console、smtp

首先创建对象

    $log = new Log\Logger();

然后设置引擎，这里我们用mail为例，第一个参数引擎名，第二个参数是配置

    $log->setLogger('AdapterMail', $config['smtp']);

然后我们就可以在我们的逻辑中开始任意的使用了：

    $log->warn("test".PHP_EOL);
    $log->error("test".PHP_EOL);
    $log->alert("test".PHP_EOL);
    $log->info("test".PHP_EOL);
    $log->critical("test".PHP_EOL);

引擎配置项，见config.php

    'file' => [
            // 根目录
            "logPath" => ROOT_DIR . "/logs",
            // 开启日期目录，默认不开启
            "dailyDirs" => true,
            // 单文件大小
            "fileMaxSize" => 10240,
            // 类型
            "logType" => 3,
            // 保留天
            "maxDay" => 7,
        ],
        'smtp'=>[
            "host"=>"服务器",
            "username"=>"用户",
            "passwd"=>"密码",
            "port"=>"端口",
            "subject"=>"主题",
            "fromaddr"=>"发送地址",
            "toaddr"=>"接受地址",
        ]


