<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Occurrence;

class OccurrenceResponsibleChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $occurrence;

    public $oldResponsible;

    public $newResponsible;

    public function __construct(Occurrence $occurrence, ?User $oldResponsible, ?User $newResponsible)
    {
        $this->occurrence     = $occurrence;
        $this->oldResponsible = $oldResponsible;
        $this->newResponsible = $newResponsible;
    }

    public function broadcastOn()
    {
        return new Channel('occurrence');
    }

    public function broadcastWith()
    {
        return [
            'occurrenceId'     => $this->occurrence->id,
            'oldResponsibleId' => optional($this->oldResponsible)->id,
            'newResponsibleId' => optional($this->newResponsible)->id,
        ];
    }

    public function broadcastAs()
    {
        return 'occurrence.responsiblechanged';
    }
}
