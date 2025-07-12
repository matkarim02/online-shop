<?php

namespace Service\Logger;

use Model\ErrorLogs;

class LoggerDbService implements LoggerInterface
{


    public function createLogs(\Exception $exception): void
    {
        ErrorLogs::create($exception->getMessage(), $exception->getFile(), $exception->getLine());
    }
}