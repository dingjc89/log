<?php
/**
 *
 * @author steve dingjc89@gmail.com
 * [2018-07-10]
 * @copyright shinsoft.net
 * @version v1.0
 */

namespace Log;


interface AdapterInterface
{
    public function save($msg,$level);
}