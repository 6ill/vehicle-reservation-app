<?php

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

function log_activity(string $action, string $description) 
{
    ActivityLog::create([
        'user_id' => Auth::id(), 
        'action' => $action,
        'description' => $description,
    ]);
}