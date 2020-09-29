<?php
/**
 * Created by PhpStorm.
 * User: xiongyoulong
 * Date: 2020/9/29
 * Time: 5:07 PM
 */

namespace App\Listeners;

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Log\Events\MessageLogged;

class MessageLoggedListener
{
    /**
     * Handle the event.
     *
     * @param  MessageLogged $event
     * @return void
     */
    public function handle(MessageLogged $event)
    {
        $level   = $event->level;
        $message = $event->message;
        $context = $event->context;

        $this->report($level, $message, $context);
    }


    protected function report($level, $logContent, $context)
    {
        if ($level != 'error') {
            return false;
        }

        if (app()->environment() != 'production') {
            return false;
        }

        $logKey = $this->getLogKey($logContent);
        $context = array_wrap($context);
        foreach ($context as $k => $data) {
            if (is_object($data)) {
                if ($data instanceof \Throwable) {
                    $logContent .= PHP_EOL;
                    $logContent .= strval($data);
                    $logKey = $this->getLogKey($data->getMessage());
                    unset($context[$k]);
                    continue;
                } elseif (method_exists($data, 'toArray')) {
                    $context[$k] = $data->toArray();
                } else {
                    $context[$k] = (array) $data;
                }
            }

            if (!is_string($context[$k]) && !is_numeric($context[$k])) {
                $context[$k] = json_encode($context[$k]);
            }
        }

        // 加锁成功，才报告错误
        $shouldReport = Redis::set($logKey, '1', 'nx', 'ex', 10*60);
        if (! $shouldReport) {
            return false;
        }

        // 发送邮件
        $logEmail = Redis::get('LOG_EMAIL_STATUS');
        if($logEmail){
            try {
                $contents = ['env' => app()->environment(), 'level' => $level, 'content' => $logContent, 'context' => $context];

                Mail::send('email/log', $contents, function (Message $message) {
                    $message->subject(config('app.name'));
                    $message->from(config('mail.username'), 'Notice');
                    $message->to('server@xmail.tangbull.com');
                });
            } catch (\Throwable $throwable) {
                Log::warning(__METHOD__.' | An exception was thrown When send errorMail to all developer', [$throwable->getMessage(), $throwable->getTraceAsString()]);
            }
        }

        return true;
    }

    /**
     * @param string $key
     * @return string
     */
    protected function getLogKey(string $key)
    {
        return 'LOG_KEY_'.md5($key);
    }
}