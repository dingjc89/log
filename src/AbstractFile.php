<?php
/**
 *
 * @author steve dingjc89@gmail.com
 * [2018-07-06]
 * @copyright shinsoft.net
 * @version v1.0
 */

namespace Log;

class AbstractFile
{
    public $dailyDirs = false;
    public $fileMaxSize = 10240;
    public $maxDay = 7;

    public function __construct($config)
    {
        if (!isset($config['logPath'])) {
            throw new \Exception("没有配置日志存储目录");
        }
        $this->logPath = $config['logPath'];
        $this->dailyDirs = $config['dailyDirs'];
        $this->logType = $config['logType'];
        $this->fileMaxSize = $config['fileMaxSize'];
        $this->path = $this->realDir($this->getDay());
        $this->maxDay = $config['maxDay'];
        $this->deleteOldLog($this->logPath);
    }

    public function save($msg, $level)
    {
        $file = 'all.log';
        $file = $this->path . DS . $file;
        $this->write($file, $msg, $this->logType, $level);
    }

    public function write($file, $msg, $logType, $level)
    {
        switch ($logType) {
            case 3:
                if (!file_exists($file)) {
                    @touch($file);
                }
                //检测日志文件大小，超过配置大小则备份日志文件重新生成
                if (floor($this->fileMaxSize) <= filesize($file)) {
                    rename($file, dirname($file) . '/' . time() . basename($file));
                }
                @error_log($msg, 3, $file);
                break;
            case 2:
                @error_log($msg, 0);
                break;
            case 0:
            default:
                @syslog($level, $msg);
        }
    }

    protected function getDay()
    {
        return date('Ymd', time());
    }

    protected function realDir($day)
    {
        $path = $this->logPath;
        if ($this->dailyDirs) {
            if (!is_dir($path . DS . $day)) {
                @mkdir($path . DS . $day, 0755);
            }
            $path .= DS . $day;
        }
        return $path;
    }

    public function deleteOldLog($path)
    {
        // 过期日期临界点
        $day = date('Ymd', strtotime("-" . $this->maxDay . "day"));
        if ($handle = opendir($path)) {
            while ($r = readdir($handle)) {
                if ($r == "." || $r == "..") continue;
                $p = $path . '/' . $r;
                if (is_dir($p)) {
                    $this->deleteOldLog($p);
                } else {
                    $cfile = filemtime($p);
                    (date('Ymd', $cfile) < $day) && unlink($p);
                }
            }
            closedir($handle);
            $d = basename($path);
            ($d < $day) && rmdir($path);
        }

    }
}