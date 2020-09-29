<?php
/**
 * Created by PhpStorm.
 * User: xiongyoulong
 * Date: 2020/9/29
 * Time: 5:08 PM
 */

namespace App\Listeners;


use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;

class QueryExecutedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QueryExecuted $event
     * @return void
     */
    public function handle(QueryExecuted $event)
    {
        $bindings = $event->bindings;
        $sql = $event->sql;
        $time = $event->time;
        Log::debug('illuminate.query', compact('sql','bindings', 'time'));
    }
}