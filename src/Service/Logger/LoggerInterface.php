<?php

namespace Service\Logger;

interface LoggerInterface
{

    public function createLogs(\Exception $exception): void;

}