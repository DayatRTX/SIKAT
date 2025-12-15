<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    


    public function index(Request $request)
    {
        $query = User::query();

        
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        
        $stats = [
            'total' => User::count(),
            'admin' => User::where('role', 'admin')->count(),
            'teknisi' => User::where('role', 'teknisi')->count(),
            'mahasiswa' => User::where('role', 'mahasiswa')->count(),
        ];

        return view('admin.users.index', compact('users', 'stats'));
    }

    


    public function create()
    {
        return view('admin.users.create');
    }

    


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,teknisi,mahasiswa',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Role wajib dipilih.',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    


    public function show(User $user)
    {
        
        $reportStats = [
            'total' => $user->reports()->count(),
            'pending' => $user->reports()->where('status', 'pending')->count(),
            'process' => $user->reports()->where('status', 'process')->count(),
            'done' => $user->reports()->where('status', 'done')->count(),
        ];

        
        $taskStats = null;
        if ($user->role === 'teknisi') {
            $taskStats = [
                'total' => \App\Models\Report::where('technician_id', $user->id)->count(),
                'process' => \App\Models\Report::where('technician_id', $user->id)->where('status', 'process')->count(),
                'done' => \App\Models\Report::where('technician_id', $user->id)->where('status', 'done')->count(),
            ];
        }

        return view('admin.users.show', compact('user', 'reportStats', 'taskStats'));
    }

    


    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    


    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,teknisi,mahasiswa',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Role wajib dipilih.',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ];

        
        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui!');
    }

    


    public function destroy(User $user)
    {
        
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        
        if ($user->reports()->exists()) {
            return back()->with('error', 'User memiliki laporan aktif dan tidak dapat dihapus!');
        }

        
        if ($user->role === 'teknisi' && \App\Models\Report::where('technician_id', $user->id)->exists()) {
            return back()->with('error', 'Teknisi memiliki tugas dan tidak dapat dihapus!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }

    public function profile()
    {
        $user = auth()->user();
        $activityLogs = \App\Models\ActivityLog::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();
        
        $stats = [];
        if ($user->role === 'mahasiswa') {
            $stats = [
                'total_reports' => $user->reports()->count(),
                'pending' => $user->reports()->where('status', 'pending')->count(),
                'process' => $user->reports()->where('status', 'process')->count(),
                'done' => $user->reports()->where('status', 'done')->count(),
            ];
        } elseif ($user->role === 'teknisi') {
            $stats = [
                'total_tasks' => \App\Models\Report::where('technician_id', $user->id)->count(),
                'in_progress' => \App\Models\Report::where('technician_id', $user->id)->where('status', 'process')->count(),
                'completed' => \App\Models\Report::where('technician_id', $user->id)->where('status', 'done')->count(),
            ];
        } elseif ($user->role === 'admin') {
            $stats = [
                'total_users' => User::count(),
                'total_reports' => \App\Models\Report::count(),
                'pending_reports' => \App\Models\Report::where('status', 'pending')->count(),
            ];
        }

        return view('profile', compact('user', 'activityLogs', 'stats'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        \App\Models\ActivityLog::log('profile_updated', 'Memperbarui informasi profil', $user);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('photo')) {
            if ($user->photo && \Storage::exists('public/' . $user->photo)) {
                \Storage::delete('public/' . $user->photo);
            }

            $path = $request->file('photo')->store('photos', 'public');
            $user->update(['photo' => $path]);

            \App\Models\ActivityLog::log('photo_updated', 'Memperbarui foto profil', $user);

            return back()->with('success', 'Foto profil berhasil diperbarui!');
        }

        return back()->with('error', 'Gagal mengupload foto!');
    }
}
