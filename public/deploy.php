<?php
/**
 * Created by PhpStorm.
 * User: xiongyoulong
 * Date: 2020/9/23
 * Time: 11:08 AM
 */

$deployLogFile = '../storage/logs/deploy.log';
$date = date('Y-m-d H:i:s');
$content = "[$date] deploy start \n";
file_put_contents($deployLogFile, $content, FILE_APPEND);
$command = "sh ../deploy.sh";
exec($command);
$date = date('Y-m-d H:i:s');
$content = "[$date] deploy complete \n";
file_put_contents($deployLogFile, $content, FILE_APPEND);
exit();