<?php
/**
 *
 * @author steve dingjc89@gmail.com
 * [2018-07-05]
 * @copyright shinsoft.net
 * @version v1.0
 */

namespace Log;
abstract class AbstractLogger
{
    protected $adapter = null;

    public function formatString($msg, $level)
    {
        $time = date('Y-m-d H:i:s', time());
        $msg = sprintf("%s %s " . $msg, $time, $level);
        return $msg;
    }
}