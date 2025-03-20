<?php

namespace App\Observers;

class TaskObserver
{
    public function updating($model)
    {
        if ($model->status === 'completed') {
            $model->completed_at = now();
        }
    }
}
