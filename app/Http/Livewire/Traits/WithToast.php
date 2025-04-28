<?php

namespace App\Http\Livewire\Traits;

trait WithToast
{
    public function notify($message, $type = 'success', $duration = 3000)
    {
        $this->dispatch('notify', [
            'message' => $message,
            'type' => $type,
            'duration' => $duration
        ]);
    }

    public function success($message, $duration = 3000)
    {
        $this->notify($message, 'success', $duration);
    }

    public function error($message, $duration = 3000)
    {
        $this->notify($message, 'error', $duration);
    }

    public function warning($message, $duration = 3000)
    {
        $this->notify($message, 'warning', $duration);
    }

    public function info($message, $duration = 3000)
    {
        $this->notify($message, 'info', $duration);
    }
}
