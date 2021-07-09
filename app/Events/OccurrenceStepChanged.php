<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Step;
use App\Models\Occurrence;

class OccurrenceStepChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $occurrence;

    public $oldStep;

    public $newStep;

    public function __construct(Occurrence $occurrence, Step $oldStep, Step $newStep)
    {
        $this->occurrence = $occurrence;
        $this->oldStep    = $oldStep;
        $this->newStep    = $newStep;
    }

    public function broadcastOn()
    {
        return new Channel('occurrence');
    }

    public function broadcastWith()
    {
        return [
            'occurrenceId' => $this->occurrence->id,
            'oldStepId'    => $this->oldStep->id,
            'newStepId'    => $this->newStep->id,
        ];
    }

    public function broadcastAs()
    {
        return 'occurrence.stepchanged';
    }
}
