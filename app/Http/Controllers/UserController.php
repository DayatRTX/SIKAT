<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Tampilkan daftar semua user.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter berdasarkan role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Search berdasarkan nama atau email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistik
        $stats = [
            'total' => User::count(),
            'admin' => User::where('role', 'admin')->count(),
            'teknisi' => User::where('role', 'teknisi')->count(),
            'mahasiswa' => User::where('role', 'mahasiswa')->count(),
        ];

        return view('admin.users.index', compact('users', 'stats'));
    }

    /**
     * Tampilkan form tambah user baru.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Simpan user baru.
     */
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

    /**
     * Tampilkan detail user.
     */
    public function show(User $user)
    {
        // Hitung statistik laporan user
        $reportStats = [
            'total' => $user->reports()->count(),
            'pending' => $user->reports()->where('status', 'pending')->count(),
            'process' => $user->reports()->where('status', 'process')->count(),
            'done' => $user->reports()->where('status', 'done')->count(),
        ];

        // Jika teknisi, hitung tugas yang ditangani
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

    /**
     * Tampilkan form edit user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update data user.
     */
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

        // Update password hanya jika diisi
        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui!');
    }

    /**
     * Hapus user.
     */
    public function destroy(User $user)
    {
        // Jangan izinkan admin menghapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        // Cek apakah user memiliki laporan
        if ($user->reports()->exists()) {
            return back()->with('error', 'User memiliki laporan aktif dan tidak dapat dihapus!');
        }

        // Cek apakah teknisi memiliki tugas
        if ($user->role === 'teknisi' && \App\Models\Report::where('technician_id', $user->id)->exists()) {
            return back()->with('error', 'Teknisi memiliki tugas dan tidak dapat dihapus!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }
}
