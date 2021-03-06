<?php

namespace wiltechsteam\FoundationService;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerHandler
{

    /**
     * LoggerHandler constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * 自定义日志
     *
     * @param $logName
     * @param $message
     * @param $content
     */
    private function customerLog($logName, $message, $content)
    {
        $log = new Logger($logName);

        $fileName = $logName . '-' . date('Y-m-d') . '.log';

        $log->pushHandler(new StreamHandler('logs/' . $fileName, Logger::ERROR));

        $log->error($message, [$content]);
    }

    /**
     * 消息队列日志
     *
     * @param $message
     * @param $content
     */
    public function messageQueueLog($message, $content)
    {
        $this->customerLog('MessageQueue', $message, $content);
    }

    /**
     * foundation错误日志
     *
     * @param $message
     * @param $content
     */
    public function foundationErrorLog($message, $content)
    {
        $this->customerLog('Foundation', $message, $content);
    }

}