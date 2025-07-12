<?php

namespace Service\Logger;

class LoggerFileService implements LoggerInterface
{

    public function createLogs(\Exception $exception): void
    {
        $logFile = './../Storage/Log/errors.txt';

        $message = "[" . date('Y-m-d H:i:s') . "] " .
            "Exception: " . $exception->getMessage() . PHP_EOL .
            "File: " . $exception->getFile() . " (Line " . $exception->getLine() . ")" . PHP_EOL .
            "Trace: " . $exception->getTraceAsString() . PHP_EOL .
            str_repeat("-", 80) . PHP_EOL;

        file_put_contents($logFile, $message, FILE_APPEND);
    }

}