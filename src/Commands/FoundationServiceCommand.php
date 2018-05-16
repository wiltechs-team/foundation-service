<?php

namespace wiltechsteam\FoundationService\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use wiltechsteam\FoundationService\LoggerHandler;

class FoundationServiceCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'foundation:work';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Foundation Queue Work';

    protected $loggerHandler;

    /**
     * FoundationServiceCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->loggerHandler = new LoggerHandler();
    }

    /**
     * Handle
     *
     */
    public function handle()
    {
        ini_set("memory_limit","1024M");

        $queue = config('foundation.rabbitmq_queue');

        $consumerTag = 'consumer-' . getmypid();

        $connection = new AMQPStreamConnection(
            config('foundation.rabbitmq_host'),
            config('foundation.rabbitmq_port'),
            config('foundation.rabbitmq_login'),
            config('foundation.rabbitmq_password')
        );

        $channel = $connection->channel();

        $channel->queue_declare($queue, true, false, true, false);

        $channel->basic_qos(0, 1, false);

        $channel->basic_consume($queue, $consumerTag, false, false, false, false, function($e){
            $this->callback($e);
        });

        while (count($channel->callbacks))
        {
            $channel->wait();
        }

        $channel->close();

        $connection->close();
    }

    /**
     * 消息处理
     *
     * @param $callback
     */
    private function callback($callback)
    {
//        try {

            $body = $callback->body;

            $bodyData = json_decode($body,true);

            $fromExchange = $callback->delivery_info['exchange'];

            $this->loggerHandler->messageQueueLog($fromExchange, $bodyData);

            $this->info(date('Y-m-d H:i:s') . ' ' . $fromExchange . ' - ' . 'succeed');

            $this->bindEvent($fromExchange, $bodyData);

            // RabbitMQ ack 回复
            $callback->delivery_info['channel']->basic_ack($callback->delivery_info['delivery_tag']);

//        } catch (\Exception $e) {
//
//            $this->error(date('Y-m-d H:i:s') . ' ' . $callback->delivery_info['exchange'] . ' - ' . 'error');
//
//            $this->loggerHandler->foundationErrorLog($callback->delivery_info['exchange'], $e->getMessage(). ' ' . $e->getFile() . ' ' . $e->getLine());
//
//        }
    }

    /**
     * 绑定事件
     *
     * @param $exchangeName 'HR.Message.Contract.Event:StaffUSAddedEvent'
     * @param $bodyData
     * @return array|null
     * @throws \Exception
     */
    private function bindEvent($exchangeName, $bodyData)
    {
        if (strpos($exchangeName, ':') === false)
        {
            throw new \Exception('Exchange name is illegality.');
        }

        $exchangeNames = explode(':', $exchangeName);

        $eventClass = "wiltechsteam\FoundationService\Events\\" . $exchangeNames[1];

        if (!class_exists($eventClass))
        {
            throw new \Exception("Event '$eventClass' is not found.");
        }

        return event(new $eventClass($bodyData));
    }

}