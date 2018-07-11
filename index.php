<?php
/**
 *
 * @author steve dingjc89@gmail.com
 * [2018-07-06]
 * @copyright shinsoft.net
 * @version v1.0
 */
require __DIR__.'/vendor/autoload.php';
$config = require __DIR__ . '/config.php';


$log = new Log\Logger();
$log->setLogger('AdapterMail', $config['smtp']);

$log->warn("test".PHP_EOL);
$log->error("test".PHP_EOL);
$log->alert("test".PHP_EOL);
$log->info("test".PHP_EOL);
$log->critical("test".PHP_EOL);
