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
     *
     * Input pada form tetap bernama "username",
     * tetapi isinya adalah email.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'username.required' => 'Email wajib diisi.',
            'username.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        /*
         * Mengecek email dan password.
         */
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

        /*
         * Regenerasi session setelah login berhasil.
         */
        $request->session()->regenerate();

        $user = Auth::user();

        /*
         * Siswa yang masih menunggu persetujuan admin
         * tidak boleh masuk dashboard.
         */
        if ($user->role === 'siswa' && $user->status === 'pending') {

            Auth::logout();

            return back()
                ->withInput($request->only('username'))
                ->withErrors([
                    'username' => 'Akun kamu masih menunggu persetujuan admin.',
                ]);
        }

        /*
         * Siswa yang ditolak admin tidak boleh login.
         */
        if ($user->role === 'siswa' && $user->status === 'rejected') {

            Auth::logout();

            return back()
                ->withInput($request->only('username'))
                ->withErrors([
                    'username' => 'Pendaftaran akun kamu ditolak oleh admin.',
                ]);
        }

        /*
         * Admin.
         */
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        /*
         * Guru.
         */
        if ($user->role === 'guru') {
            return redirect('/guru/dashboard');
        }

        /*
         * Siswa yang sudah approved.
         */
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
     *
     * Data siswa disimpan sementara ke session.
     */
    public function registerStep1(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'nisn' => ['required', 'string', 'max:30'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nisn.required' => 'NISN wajib diisi.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
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

        /*
         * Mengecek apakah NISN sudah digunakan.
         */
        if (Siswa::where('nisn', $data['nisn'])->exists()) {
            return back()
                ->withInput()
                ->withErrors([
                    'nisn' => 'NISN tersebut sudah terdaftar.',
                ]);
        }

        /*
         * Menyimpan data tahap 1 ke session.
         */
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

        $sekolahs = Sekolah::orderBy('nama_sekolah')->get();
        $kelas = Kelas::orderBy('nama_kelas')->get();
        $jurusans = Jurusan::orderBy('nama_jurusan')->get();

        /*
         * Data sekolah untuk custom dropdown.
         */
        $sekolahData = $sekolahs
            ->pluck('nama_sekolah')
            ->values()
            ->toArray();

        /*
         * Data kelas untuk custom dropdown.
         *
         * Contoh:
         * 10 -> Kelas X (10)
         * 11 -> Kelas XI (11)
         * 12 -> Kelas XII (12)
         */
        $kelasData = [];
        $kelasValues = [];

        foreach ($kelas as $item) {

            $label = match ($item->nama_kelas) {
                '10' => 'Kelas X (10)',
                '11' => 'Kelas XI (11)',
                '12' => 'Kelas XII (12)',
                default => 'Kelas ' . $item->nama_kelas,
            };

            $kelasData[] = $label;
            $kelasValues[$label] = $item->nama_kelas;
        }

        /*
         * Data jurusan untuk custom dropdown.
         */
        $jurusanData = [];
        $jurusanValues = [];

        foreach ($jurusans as $item) {

            $label = match ($item->nama_jurusan) {

                'Teknik Komputer dan Jaringan'
                    => 'Teknik Komputer dan Jaringan (TKJ)',

                'Rekayasa Perangkat Lunak'
                    => 'Rekayasa Perangkat Lunak (RPL)',

                'Multimedia'
                    => 'Multimedia (MM)',

                'Akuntansi'
                    => 'Akuntansi (AKL)',

                'Bisnis Digital'
                    => 'Bisnis Digital (BD)',

                default => $item->nama_jurusan,
            };

            $jurusanData[] = $label;
            $jurusanValues[$label] = $item->nama_jurusan;
        }

        return view('auth.register-step2', compact(
            'sekolahs',
            'kelas',
            'jurusans',
            'sekolahData',
            'kelasData',
            'kelasValues',
            'jurusanData',
            'jurusanValues'
        ));
    }

    /**
     * Proses register tahap 2.
     *
     * Data sekolah dan PKL disimpan sementara ke session.
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
        ], [
            'asal_sekolah.required' => 'Asal sekolah wajib dipilih.',
            'kelas.required' => 'Kelas wajib dipilih.',
            'jurusan.required' => 'Jurusan wajib dipilih.',
            'tanggal_mulai.required' => 'Tanggal mulai PKL wajib diisi.',
            'tanggal_selesai.required' => 'Tanggal selesai PKL wajib diisi.',
            'tanggal_selesai.after_or_equal'
                => 'Tanggal selesai PKL tidak boleh sebelum tanggal mulai PKL.',
            'alamat_sekolah.required' => 'Alamat sekolah wajib diisi.',
        ]);

        /*
         * Menyimpan data tahap 2 ke session.
         */
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
     *
     * Akun siswa dibuat dengan status "pending".
     * Siswa belum boleh login sebelum admin menyetujui.
     */
    public function registerFinish()
    {
        $step1 = session('register.step1');
        $step2 = session('register.step2');

        /*
         * Jika session registrasi tidak lengkap,
         * kembali ke halaman register.
         */
        if (!$step1 || !$step2) {
            return redirect()->route('register');
        }

        try {

            $user = DB::transaction(function () use ($step1, $step2) {

                /*
                 * Mencari atau membuat sekolah.
                 */
                $sekolah = Sekolah::firstOrCreate(
                    [
                        'nama_sekolah' => $step2['asal_sekolah'],
                    ],
                    [
                        'alamat' => $step2['alamat_sekolah'],
                    ]
                );

                /*
                 * Jika sekolah sudah ada tetapi alamatnya kosong,
                 * isi alamat sekolah tersebut.
                 */
                if (
                    empty($sekolah->alamat) &&
                    !empty($step2['alamat_sekolah'])
                ) {
                    $sekolah->update([
                        'alamat' => $step2['alamat_sekolah'],
                    ]);
                }

                /*
                 * Mencari atau membuat jurusan.
                 */
                $jurusan = Jurusan::firstOrCreate([
                    'nama_jurusan' => $step2['jurusan'],
                ]);

                /*
                 * Mencari atau membuat kelas.
                 */
                $kelas = Kelas::firstOrCreate([
                    'nama_kelas' => $step2['kelas'],
                ]);

                /*
                 * Membuat akun siswa.
                 *
                 * Status awal = pending.
                 *
                 * Artinya siswa masih menunggu
                 * persetujuan dari admin.
                 */
                $user = User::create([
                    'email' => $step1['email'],
                    'password' => Hash::make($step1['password']),
                    'role' => 'siswa',
                    'status' => 'pending',
                ]);

                /*
                 * Membuat data siswa.
                 */
                Siswa::create([
                    'user_id' => $user->id,

                    /*
                     * Guru pembimbing belum ditentukan
                     * pada saat siswa melakukan registrasi.
                     */
                    'guru_id' => null,

                    'sekolah_id' => $sekolah->id,
                    'jurusan_id' => $jurusan->id,
                    'kelas_id' => $kelas->id,

                    'nama_lengkap' => $step1['nama_lengkap'],
                    'nisn' => $step1['nisn'],
                    'tempat_lahir' => $step1['tempat_lahir'],
                    'tanggal_lahir' => $step1['tanggal_lahir'],
                    'jenis_kelamin' => $step1['jenis_kelamin'],
                    'no_telepon' => $step1['no_telepon'],

                    'tanggal_mulai_pkl' => $step2['tanggal_mulai'],
                    'tanggal_selesai_pkl' => $step2['tanggal_selesai'],
                ]);

                return $user;
            });

            /*
             * Registrasi berhasil.
             * Hapus data sementara dari session.
             */
            session()->forget('register');

            /*
             * Jangan login otomatis.
             *
             * Siswa harus menunggu Admin melakukan approve.
             */
            return redirect()
                ->route('login')
                ->with(
                    'success',
                    'Pendaftaran berhasil. Silakan tunggu persetujuan admin sebelum login.'
                );

        } catch (\Throwable $e) {

            /*
             * Jika terjadi error, data session tetap ada
             * sehingga siswa bisa mencoba kembali.
             */
            return redirect()
                ->route('register.step3')
                ->with(
                    'error',
                    'Pendaftaran gagal. Silakan periksa kembali data Anda.'
                );
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
