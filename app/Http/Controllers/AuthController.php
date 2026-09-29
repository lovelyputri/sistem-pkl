<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ], [
            'username.required' => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (!Auth::attempt([
            'email' => $credentials['username'],
            'password' => $credentials['password'],
        ], $request->boolean('remember'))) {

            return back()
                ->withInput($request->only('username'))
                ->withErrors([
                    'username' => 'Email atau password salah.',
                ]);
        }

        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        if (Auth::user()->role === 'guru') {
            return redirect('/guru/dashboard');
        }

        return redirect('/siswa/dashboard');
    }

    /**
     * Logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Menampilkan halaman register tahap 1.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses register tahap 1.
     * Menyimpan data diri sementara ke session.
     */
    public function registerStep1(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'nisn' => ['required', 'string', 'max:30'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'nisn.required' => 'NISN wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'no_telepon.required' => 'Nomor telepon wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Mengecek apakah NISN sudah digunakan.
        if (Siswa::where('nisn', $data['nisn'])->exists()) {
            return back()
                ->withInput()
                ->withErrors([
                    'nisn' => 'NISN tersebut sudah terdaftar.',
                ]);
        }

        // Menyimpan data tahap 1 ke session.
        session([
            'register.step1' => $data,
        ]);

        return redirect()->route('register.step2');
    }

    /**
     * Menampilkan halaman register tahap 2.
     */
    public function showRegisterStep2()
    {
        if (!session()->has('register.step1')) {
            return redirect()->route('register');
        }

        return view('auth.register-step2');
    }

    /**
     * Proses register tahap 2.
     * Menyimpan data sekolah dan PKL sementara ke session.
     */
    public function registerStep2(Request $request)
    {
        $data = $request->validate([
            'asal_sekolah' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:50'],
            'jurusan' => ['required', 'string', 'max:255'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => [
                'required',
                'date',
                'after_or_equal:tanggal_mulai',
            ],
            'alamat_sekolah' => ['required', 'string', 'max:500'],
            'nama_pembimbing' => ['required', 'string', 'max:255'],
            'no_telepon_pembimbing' => ['required', 'string', 'max:20'],
        ], [
            'asal_sekolah.required' => 'Asal sekolah wajib dipilih.',
            'kelas.required' => 'Kelas wajib dipilih.',
            'jurusan.required' => 'Jurusan wajib dipilih.',
            'tanggal_mulai.required' => 'Tanggal mulai PKL wajib diisi.',
            'tanggal_selesai.required' => 'Tanggal selesai PKL wajib diisi.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai PKL tidak boleh sebelum tanggal mulai PKL.',
            'alamat_sekolah.required' => 'Alamat sekolah wajib diisi.',
            'nama_pembimbing.required' => 'Nama pembimbing wajib diisi.',
            'no_telepon_pembimbing.required' => 'Nomor telepon pembimbing wajib diisi.',
        ]);

        // Menyimpan data tahap 2 ke session.
        session([
            'register.step2' => $data,
        ]);

        return redirect()->route('register.step3');
    }

    /**
     * Menampilkan halaman register tahap 3.
     */
    public function showRegisterStep3()
    {
        if (
            !session()->has('register.step1') ||
            !session()->has('register.step2')
        ) {
            return redirect()->route('register');
        }

        return view('auth.register-step3');
    }

    /**
     * Menyelesaikan proses registrasi.
     */
    public function registerFinish()
    {
        $step1 = session('register.step1');
        $step2 = session('register.step2');

        // Jika session registrasi tidak lengkap,
        // kembali ke halaman register.
        if (!$step1 || !$step2) {
            return redirect()->route('register');
        }

        try {

            $user = DB::transaction(function () use ($step1, $step2) {

                /*
                 * Mencari sekolah berdasarkan nama yang
                 * dikirim dari view.
                 *
                 * Kalau belum ada, otomatis dibuat.
                 */
                $sekolah = Sekolah::firstOrCreate([
                    'nama_sekolah' => $step2['asal_sekolah'],
                ]);

                /*
                 * Mencari jurusan berdasarkan nama yang
                 * dikirim dari view.
                 *
                 * Kalau belum ada, otomatis dibuat.
                 */
                $jurusan = Jurusan::firstOrCreate([
                    'nama_jurusan' => $step2['jurusan'],
                ]);

                /*
                 * Mencari kelas berdasarkan nama yang
                 * dikirim dari view.
                 *
                 * Contohnya:
                 * Kelas 10
                 * Kelas 11
                 * Kelas 12
                 */
                $kelas = Kelas::firstOrCreate([
                    'nama_kelas' => $step2['kelas'],
                ]);

                /*
                 * Membuat akun user.
                 */
                $user = User::create([
                    'name' => $step1['nama_lengkap'],
                    'email' => $step1['email'],
                    'password' => Hash::make($step1['password']),
                    'role' => 'siswa',
                ]);

                /*
                 * Membuat data siswa.
                 */
                Siswa::create([
                    'user_id' => $user->id,

                    'sekolah_id' => $sekolah->id,
                    'jurusan_id' => $jurusan->id,
                    'kelas_id' => $kelas->id,

                    'nama_lengkap' => $step1['nama_lengkap'],
                    'nisn' => $step1['nisn'],
                    'tanggal_lahir' => $step1['tanggal_lahir'],
                    'jenis_kelamin' => $step1['jenis_kelamin'],
                    'no_telepon' => $step1['no_telepon'],

                    'tempat_pkl' => $step2['alamat_sekolah'],
                    'tanggal_mulai_pkl' => $step2['tanggal_mulai'],
                    'tanggal_selesai_pkl' => $step2['tanggal_selesai'],
                ]);

                return $user;
            });

            /*
             * Kalau semua proses berhasil,
             * hapus session registrasi.
             */
            session()->forget('register');

            /*
             * Login otomatis setelah registrasi.
             */
            Auth::login($user);

            return redirect('/siswa/dashboard')
                ->with('success', 'Pendaftaran berhasil!');

        } catch (\Throwable $e) {

            /*
             * Kalau terjadi error, data yang sudah dibuat
             * dalam transaction akan dibatalkan.
             */
            return redirect()
                ->route('register.step3')
                ->with('error', 'Pendaftaran gagal. Silakan periksa kembali data Anda.');
        }
    }

    /**
     * Menampilkan halaman lupa password.
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }
}
