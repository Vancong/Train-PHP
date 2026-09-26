<?php
function logMessage(string $level, string $message)
{
    $time = date("Y-m-d H:i:s");
    $log = "[$time] [$level] $message" . PHP_EOL;
    error_log($log, 3, __DIR__ . './log/app.log');
}
