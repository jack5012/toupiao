<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Account as AccountModel;


class WechatSubscribe
{
    use Dispatchable, SerializesModels;

    public $message;
    /**
     * ForgetCacheEvent constructor.
     * @param $model
     * @param $allowed_add
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [];
    }
}
