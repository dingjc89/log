<?php
/**
 *
 * @author steve dingjc89@gmail.com
 * [2018-07-10]
 * @copyright shinsoft.net
 * @version v1.0
 */

namespace Log;

class Console implements AdapterInterface
{
    public $colors = array(
        'LOG_EMERG'=>"1;37", // Emergency          white
        'LOG_ALERT'=>"1;36", // Alert              cyan
        'LOG_CRIT'=>"1;35", // Critical           magenta
        'LOG_ERR'=>"1;31", // Error              red
        'LOG_WARNING'=>"1;33", // Warning            yellow
        'LOG_NOTICE'=>"1;32", // Notice             green
        'LOG_INFO'=>"1;34", // Informational      blue
        'LOG_DEBUG'=>"1;44", // Debug              Background blue
    );

    public function save($msg,$level)
    {
        echo  $this->formatString($msg,$level)($this->colors);
    }

    private function formatString($msg,$level)
    {
        return function($colors) use($msg,$level){
            $pre = "\033[";
            $reset = "\033[0m";
            return $pre.$colors[$level]."m".$msg.$reset;
        };
    }

}