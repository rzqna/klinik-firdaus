<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar karyawan dengan fitur pencarian.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // REVISI DI SINI: Hapus ->where('role', 'user') untuk menampilkan semua user
        $users = User::with(['jabatan', 'pekerjaan']);

        // Jika ada query pencarian, tambahkan kondisi WHERE
        if ($search) {
            $users->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%')
                      // Tambahkan pencarian berdasarkan relasi Jabatan
                      ->orWhereHas('jabatan', function($q) use ($search) {
                          $q->where('jabatan', 'like', '%' . $search . '%');
                      })
                      // Tambahkan pencarian berdasarkan relasi Pekerjaan
                      ->orWhereHas('pekerjaan', function($q) use ($search) {
                          $q->where('pekerjaan', 'like', '%' . $search . '%');
                      });
                // Anda bisa menambahkan kolom lain untuk pencarian, misal:
                // ->orWhereHas('jabatan', function($q) use ($search) {
                //     $q->where('jabatan', 'like', '%' . $search . '%');
                // })
                // ->orWhereHas('pekerjaan', function($q) use ($search) {
                //     $q->where('pekerjaan', 'like', '%' . $search . '%');
                // });
            });
        }

        $users = $users->latest()->get(); // Urutkan berdasarkan yang terbaru dan ambil datanya

        // Kirim data user dan query pencarian ke view
        return view('datakaryawan.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatans = Jabatan::all();
        $pekerjaans = Pekerjaan::all();
        return view('datakaryawan.create', compact('jabatans', 'pekerjaans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nik' => 'required|string|max:16|unique:users',
            'tgl_lahir' => 'nullable|date',
            'jabatan_id' => 'nullable|exists:jabatans,id',
            'pekerjaan_id' => 'nullable|exists:pekerjaans,id',
            'role' => ['required', Rule::in(['admin', 'user'])],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nik' => $request->nik,
            'tgl_lahir' => $request->tgl_lahir,
            'jabatan_id' => $request->jabatan_id,
            'pekerjaan_id' => $request->pekerjaan_id,
            'role' => $request->role,
        ]);

        return redirect()->route('datakaryawan.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $jabatans = Jabatan::all();
        $pekerjaans = Pekerjaan::all();
        return view('datakaryawan.edit', compact('user', 'jabatans', 'pekerjaans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8', // Password opsional saat update
            'nik' => ['required', 'string', 'max:16', Rule::unique('users')->ignore($user->id)],
            'tgl_lahir' => 'nullable|date',
            'jabatan_id' => 'nullable|exists:jabatans,id',
            'pekerjaan_id' => 'nullable|exists:pekerjaans,id',
            'role' => ['required', Rule::in(['admin', 'user'])],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $userData = $request->except('password'); // Ambil semua kecuali password
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password); // Hash password jika diisi
        }

        $user->update($userData);

        return redirect()->route('datakaryawan.index')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('datakaryawan.index')->with('success', 'User berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
}
