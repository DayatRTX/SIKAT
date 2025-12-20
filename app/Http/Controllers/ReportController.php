<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    


    public function create()
    {
        return view('mahasiswa.reports.create');
    }

    


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'category' => 'required|string',
            'image_before' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'title.required' => 'Judul laporan wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'location.required' => 'Lokasi wajib diisi.',
            'category.required' => 'Kategori wajib dipilih.',
            'image_before.required' => 'Foto bukti wajib diunggah.',
            'image_before.image' => 'File harus berupa gambar.',
            'image_before.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        
        $imagePath = null;
        if ($request->hasFile('image_before')) {
            $imagePath = $request->file('image_before')->store('reports', 'public');
        }

        Report::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'category' => $validated['category'],
            'image_before' => $imagePath,
            'status' => 'pending',
        ]);

        // Get the created report
        $report = Report::where('user_id', auth()->id())->latest()->first();

        \App\Models\ActivityLog::log('report_created', 'Membuat laporan: ' . $report->title, $report);

        // Notify all admins about new report
        $admins = User::where('role', 'admin')->pluck('id');
        Notification::sendToMany(
            $admins,
            'new_report',
            'Laporan Baru Masuk! 📝',
            'Laporan baru dari ' . auth()->user()->name . ': ' . $report->title,
            $report->id
        );

        return redirect()->route('mahasiswa.reports.index')
            ->with('success', 'Laporan berhasil dikirim dan menunggu validasi admin.');
    }

    


    public function myReports()
    {
        $reports = Report::where('user_id', auth()->id())
            ->with('technician')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('mahasiswa.reports.index', compact('reports'));
    }

    


    public function show(Report $report)
    {
        
        if ($report->user_id !== auth()->id()) {
            abort(403);
        }

        return view('mahasiswa.reports.show', compact('report'));
    }

    


    public function adminIndex(Request $request)
    {
        $query = Report::with(['user', 'technician']);

        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reports = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.reports.index', compact('reports'));
    }

    


    public function adminShow(Report $report)
    {
        $technicians = User::where('role', 'teknisi')->get();
        return view('admin.reports.show', compact('report', 'technicians'));
    }

    


    public function validate(Request $request, Report $report)
    {
        $validated = $request->validate([
            'action' => 'required|in:accept,reject',
            'reject_reason' => 'required_if:action,reject',
        ], [
            'action.required' => 'Aksi wajib dipilih.',
            'reject_reason.required_if' => 'Alasan penolakan wajib diisi.',
        ]);

        if ($validated['action'] === 'reject') {
            $report->update([
                'status' => 'rejected',
                'reject_reason' => $validated['reject_reason'],
                'completed_at' => null,
            ]);
            \App\Models\ActivityLog::log('report_rejected', 'Menolak laporan: ' . $report->title, $report);

            // Notify mahasiswa about rejection
            Notification::send(
                $report->user_id,
                'report_rejected',
                'Laporan Ditolak ❌',
                'Laporan "' . $report->title . '" ditolak. Alasan: ' . $validated['reject_reason'],
                $report->id
            );

            $message = 'Laporan berhasil ditolak.';
        } else {
            $report->update([
                'status' => 'pending', 
                'completed_at' => null,
            ]);
            \App\Models\ActivityLog::log('report_validated', 'Memvalidasi laporan: ' . $report->title, $report);
            $message = 'Laporan berhasil divalidasi.';
        }

        return back()->with('success', $message);
    }

    


    public function assign(Request $request, Report $report)
    {
        $validated = $request->validate([
            'technician_id' => 'required|exists:users,id',
        ], [
            'technician_id.required' => 'Teknisi wajib dipilih.',
            'technician_id.exists' => 'Teknisi tidak valid.',
        ]);

        $report->update([
            'technician_id' => $validated['technician_id'],
            'status' => 'process',
            'completed_at' => null,
        ]);

        \App\Models\ActivityLog::log('report_assigned', 'Menugaskan teknisi untuk laporan: ' . $report->title, $report);

        // Notify technician about new task
        Notification::send(
            $validated['technician_id'],
            'task_assigned',
            'Tugas Baru! 🔧',
            'Anda ditugaskan untuk laporan: ' . $report->title,
            $report->id
        );

        // Notify mahasiswa that report is being processed
        Notification::send(
            $report->user_id,
            'report_process',
            'Laporan Diproses ⚙️',
            'Laporan "' . $report->title . '" sedang dalam proses perbaikan.',
            $report->id
        );

        return back()->with('success', 'Teknisi berhasil ditugaskan.');
    }

    


    public function teknisiIndex()
    {
        $tasks = Report::where('technician_id', auth()->id())
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('teknisi.tasks.index', compact('tasks'));
    }

    


    public function teknisiShow(Report $report)
    {
        
        if ($report->technician_id !== auth()->id()) {
            abort(403);
        }

        return view('teknisi.tasks.show', compact('report'));
    }

    


    public function complete(Request $request, Report $report)
    {
        
        if ($report->technician_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'image_after' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'image_after.required' => 'Foto hasil perbaikan wajib diunggah.',
            'image_after.image' => 'File harus berupa gambar.',
            'image_after.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        
        $imagePath = null;
        if ($request->hasFile('image_after')) {
            $imagePath = $request->file('image_after')->store('reports', 'public');
        }
        $report->update([
            'image_after' => $imagePath,
            'status' => 'done',
            'completed_at' => now(),
        ]);

        \App\Models\ActivityLog::log('report_completed', 'Menyelesaikan perbaikan laporan: ' . $report->title, $report);

        // Notify mahasiswa that report is completed
        Notification::send(
            $report->user_id,
            'report_completed',
            'Perbaikan Selesai! ✅',
            'Laporan "' . $report->title . '" telah selesai diperbaiki.',
            $report->id
        );

        // Notify all admins about completion
        $admins = User::where('role', 'admin')->pluck('id');
        Notification::sendToMany(
            $admins,
            'report_completed',
            'Laporan Selesai ✅',
            'Teknisi telah menyelesaikan laporan: ' . $report->title,
            $report->id
        );

        return back()->with('success', 'Perbaikan berhasil diselesaikan!');
    }

    


    public function reject(Request $request, Report $report)
    {
        $validated = $request->validate([
            'reject_reason' => 'required|string|max:500',
        ], [
            'reject_reason.required' => 'Alasan penolakan wajib diisi.',
        ]);

        $report->update([
            'status' => 'rejected',
            'reject_reason' => $validated['reject_reason'],
            'completed_at' => null,
        ]);

        \App\Models\ActivityLog::log('report_rejected', 'Menolak laporan: ' . $report->title, $report);

        // Notify mahasiswa about rejection
        Notification::send(
            $report->user_id,
            'report_rejected',
            'Laporan Ditolak ❌',
            'Laporan "' . $report->title . '" ditolak. Alasan: ' . $validated['reject_reason'],
            $report->id
        );

        return back()->with('success', 'Laporan berhasil ditolak.');
    }
}
