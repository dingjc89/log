<?php
/**
 *
 * @author steve dingjc89@gmail.com
 * [2018-07-05]
 * @copyright shinsoft.net
 * @version v1.0
 */

namespace Log;

class Logger extends AbstractLogger
{
    public $levels = array(
        'LOG_EMERG',
        'LOG_ALERT',
        'LOG_CRIT',
        'LOG_ERR',
        'LOG_WARNING',
        'LOG_NOTICE',
        'LOG_INFO',
        'LOG_DEBUG',
    );

    public $adapters = array(
        'AdapterConsole' => 'Log\Console',
        'AdapterFile' => 'Log\File',
        'AdapterMail' => 'Log\Smtp',
        'AdapterMultiFile' => 'Log\MultiFile',
    );

    public function setLogger($adapterName, $config= array())
    {
        if (!isset($this->adapters[$adapterName])) {
            throw new \Exception("日志系统不支持驱动 " . $adapterName);
        }
        $adapter = $this->adapters[$adapterName];
        $className = ucfirst($adapter);
        $this->adapter = new $className($config);
    }

    public function writeLog($msg, $level)
    {
        $this->adapter->save($msg,$this->levels[$level]);
    }

    public function emergency($msg)
    {
        $this->writeLog($msg, 0);
    }

    public function alert($msg)
    {
        $msg = $this->formatString($msg,'alert');
        $this->writeLog($msg, 1);
    }


    public function critical($msg)
    {
        $msg = $this->formatString($msg,'critical');
        $this->writeLog($msg, 2);
    }

    public function error($msg)
    {
        $msg = $this->formatString($msg,'error');
        $this->writeLog($msg, 3);
    }

    public function warn($msg)
    {
        $msg = $this->formatString($msg,'warn');
        $this->writeLog($msg, 4);
    }

    public function notice($msg)
    {
        $msg = $this->formatString($msg,'notice');
        $this->writeLog($msg, 5);
    }

    public function info($msg)
    {
        $msg = $this->formatString($msg,'info');
        $this->writeLog($msg, 6);
    }

    public function debug($msg)
    {
        $msg = $this->formatString($msg,'debug');
        $this->writeLog($msg, 7);
    }
}