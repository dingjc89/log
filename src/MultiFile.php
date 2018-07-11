<?php
/**
 *
 * @author steve dingjc89@gmail.com
 * [2018-07-10]
 * @copyright shinsoft.net
 * @version v1.0
 */

namespace Log;


class MultiFile extends AbstractFile implements AdapterInterface
{

    public function save($msg, $level)
    {
        $logArr = explode('_',$level);
        $file = $this->path.'/'.$logArr[1].".log";// 根据level组合日志文件名
        $this->write($file,$msg,$this->logType,$level);
    }
}