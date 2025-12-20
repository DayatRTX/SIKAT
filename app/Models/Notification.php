<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'report_id',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    /**
     * Create a notification for a user
     */
    public static function send($userId, $type, $title, $message, $reportId = null)
    {
        return self::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'report_id' => $reportId,
        ]);
    }

    /**
     * Send notification to multiple users
     */
    public static function sendToMany($userIds, $type, $title, $message, $reportId = null)
    {
        foreach ($userIds as $userId) {
            self::send($userId, $type, $title, $message, $reportId);
        }
    }

    /**
     * Get icon class based on notification type
     */
    public function getIconAttribute()
    {
        return match($this->type) {
            'new_report' => 'fa-file-alt',
            'report_rejected' => 'fa-times-circle',
            'report_process' => 'fa-cog',
            'report_completed' => 'fa-check-circle',
            'task_assigned' => 'fa-wrench',
            default => 'fa-bell',
        };
    }

    /**
     * Get color class based on notification type
     */
    public function getColorAttribute()
    {
        return match($this->type) {
            'new_report' => 'blue',
            'report_rejected' => 'red',
            'report_process' => 'cyan',
            'report_completed' => 'emerald',
            'task_assigned' => 'orange',
            default => 'slate',
        };
    }
}
