<?php

namespace App\Events;

use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PengaduanUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pengaduanCount;
    public $actionType;

    public function __construct($pengaduanCount, $actionType = 'add') // Default ke 'add'
    {
        $this->pengaduanCount = $pengaduanCount;
        $this->actionType = $actionType;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('pengaduan');
    }

    public function broadcastWith()
    {
        return [
            'pengaduanCount' => $this->pengaduanCount,
            'actionType' => $this->actionType,
        ];
    }
}
