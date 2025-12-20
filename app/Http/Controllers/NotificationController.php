<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Get unread notification count for AJAX polling
     */
    public function unreadCount()
    {
        $count = auth()->user()->notifications()->where('is_read', false)->count();
        
        return response()->json(['count' => $count]);
    }

    /**
     * Get recent notifications for dropdown
     */
    public function recent()
    {
        $notifications = auth()->user()
            ->notifications()
            ->with('report')
            ->latest()
            ->take(10)
            ->get()
            ->map(function($notif) {
                return [
                    'id' => $notif->id,
                    'type' => $notif->type,
                    'title' => $notif->title,
                    'message' => $notif->message,
                    'is_read' => $notif->is_read,
                    'icon' => $notif->icon,
                    'color' => $notif->color,
                    'report_id' => $notif->report_id,
                    'created_at' => $notif->created_at->diffForHumans(),
                ];
            });

        return response()->json(['notifications' => $notifications]);
    }

    /**
     * Mark single notification as read
     */
    public function markAsRead($id)
    {
        $notification = Notification::where('user_id', auth()->id())->findOrFail($id);
        $notification->update(['is_read' => true]);

        // Redirect to report if exists
        if ($notification->report_id) {
            $user = auth()->user();
            if ($user->role === 'mahasiswa') {
                return redirect()->route('mahasiswa.reports.show', $notification->report_id);
            } elseif ($user->role === 'teknisi') {
                return redirect()->route('teknisi.tasks.show', $notification->report_id);
            } else {
                return redirect()->route('admin.reports.show', $notification->report_id);
            }
        }

        return redirect()->route('dashboard');
    }

    /**
     * Mark all notifications as read
     */
    public function markAllRead()
    {
        auth()->user()->notifications()->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai dibaca.');
    }
}
