<?php
/**
 *
 * @author steve dingjc89@gmail.com
 * [2018-07-10]
 * @copyright shinsoft.net
 * @version v1.0
 */

namespace Log;


class Smtp implements AdapterInterface
{
    public function __construct($config)
    {
        if (isset($config['host']) && !$config['host']) {
            throw new \Exception("stmp发送邮件必须配置服务器");
        }
        if (isset($config['port']) && !$config['port']) {
            throw new \Exception("stmp发送邮件必须配置端口");
        }
        if (isset($config['username']) && !$config['username']) {
            throw new \Exception("stmp发送邮件必须配置用户");
        }
        if (isset($config['passwd']) && !$config['passwd']) {
            throw new \Exception("stmp发送邮件必须配置密码");
        }
        $fromaddr = (isset($config['passwd']) && $config['fromaddr']) ? $config['fromaddr'] : $config['username'];

        if (isset($config['toaddr']) && !$config['toaddr']) {
            throw new \Exception("日志接受邮件地址没有配置");
        }
        $transport = (new \Swift_SmtpTransport($config['host'], $config['port']))->setUsername($config['username'])->setPassword($config['passwd']);
        $this->mail = new \Swift_Mailer($transport);
        $this->msg = (new \Swift_Message($config['subject']))
            ->setFrom($fromaddr)
            ->setTo($config['toaddr']);

    }

    public function save($msg, $level)
    {
        $message = $this->msg->setBody($msg);
        $this->mail->send($message);
    }
}