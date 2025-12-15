<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
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
            $message = 'Laporan berhasil ditolak.';
        } else {
            $report->update([
                'status' => 'pending', 
                'completed_at' => null,
            ]);
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

        return back()->with('success', 'Laporan berhasil ditolak.');
    }
}
