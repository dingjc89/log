<?php
/**
 *
 * @author steve dingjc89@gmail.com
 * [2018-07-05]
 * @copyright shinsoft.net
 * @version v1.0
 */
define('ROOT_DIR', __DIR__);
define('DS','/');
return $config = [
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
];