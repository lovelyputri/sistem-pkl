<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([

            'username' => [
                'required',
            ],

            'password' => [
                'required',
            ],

        ], [

            'username.required' =>
                'Email wajib diisi.',

            'password.required' =>
                'Password wajib diisi.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | LOGIN MENGGUNAKAN EMAIL
        |--------------------------------------------------------------------------
        |
        | Input pada form masih bernama "username",
        | tetapi nilainya digunakan sebagai email.
        |
        */

        if (!Auth::attempt([
            'email' => $credentials['username'],
            'password' => $credentials['password'],
        ], $request->boolean('remember'))) {

            return back()
                ->withInput(
                    $request->only('username')
                )
                ->withErrors([
                    'username' =>
                        'Email atau password salah.',
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


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER TAHAP 1
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('auth.register');
    }


    public function registerStep1(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI DATA DIRI
        |--------------------------------------------------------------------------
        */

        $data = $request->validate([

            'nama_lengkap' => [
                'required',
                'string',
                'max:255',
            ],

            'tempat_lahir' => [
                'required',
                'string',
                'max:255',
            ],

            'nisn' => [
                'required',
                'string',
                'max:30',
            ],

            'tanggal_lahir' => [
                'required',
                'date',
            ],

            'jenis_kelamin' => [
                'required',
                'in:Laki-laki,Perempuan',
            ],

            'no_telepon' => [
                'required',
                'string',
                'max:20',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],

        ], [

            'nama_lengkap.required' =>
                'Nama lengkap wajib diisi.',

            'tempat_lahir.required' =>
                'Tempat lahir wajib diisi.',

            'nisn.required' =>
                'NISN wajib diisi.',

            'tanggal_lahir.required' =>
                'Tanggal lahir wajib diisi.',

            'jenis_kelamin.required' =>
                'Jenis kelamin wajib dipilih.',

            'no_telepon.required' =>
                'Nomor telepon wajib diisi.',

            'email.required' =>
                'Email wajib diisi.',

            'email.email' =>
                'Format email tidak valid.',

            'email.unique' =>
                'Email sudah terdaftar.',

            'password.required' =>
                'Password wajib diisi.',

            'password.min' =>
                'Password minimal 8 karakter.',

            'password.confirmed' =>
                'Konfirmasi password tidak cocok.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | CEK NISN
        |--------------------------------------------------------------------------
        */

        if (Siswa::where('nisn', $data['nisn'])->exists()) {

            return back()
                ->withInput()
                ->withErrors([
                    'nisn' =>
                        'NISN tersebut sudah terdaftar.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA TAHAP 1
        |--------------------------------------------------------------------------
        */

        session([
            'register.step1' => $data,
        ]);


        /*
        |--------------------------------------------------------------------------
        | PINDAH KE TAHAP 2
        |--------------------------------------------------------------------------
        */

        return redirect()->route('register.step2');
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER TAHAP 2
    |--------------------------------------------------------------------------
    */

    public function showRegisterStep2()
    {
        if (!session()->has('register.step1')) {

            return redirect()->route('register');
        }


        return view('auth.register-step2');
    }


    public function registerStep2(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI DATA SEKOLAH
        |--------------------------------------------------------------------------
        */

        $data = $request->validate([

            'nama_sekolah' => [
                'required',
                'string',
                'max:255',
            ],

            'jurusan' => [
                'required',
                'string',
                'max:255',
            ],

            'kelas' => [
                'required',
                'string',
                'max:50',
            ],

            'tempat_pkl' => [
                'required',
                'string',
                'max:255',
            ],

            'tanggal_mulai_pkl' => [
                'required',
                'date',
            ],

            'tanggal_selesai_pkl' => [
                'required',
                'date',
                'after_or_equal:tanggal_mulai_pkl',
            ],

        ], [

            'nama_sekolah.required' =>
                'Nama sekolah wajib diisi.',

            'jurusan.required' =>
                'Jurusan wajib diisi.',

            'kelas.required' =>
                'Kelas wajib diisi.',

            'tempat_pkl.required' =>
                'Tempat PKL wajib diisi.',

            'tanggal_mulai_pkl.required' =>
                'Tanggal mulai PKL wajib diisi.',

            'tanggal_selesai_pkl.required' =>
                'Tanggal selesai PKL wajib diisi.',

            'tanggal_selesai_pkl.after_or_equal' =>
                'Tanggal selesai PKL tidak boleh sebelum tanggal mulai PKL.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA TAHAP 2
        |--------------------------------------------------------------------------
        */

        session([
            'register.step2' => $data,
        ]);


        /*
        |--------------------------------------------------------------------------
        | PINDAH KE TAHAP 3
        |--------------------------------------------------------------------------
        */

        return redirect()->route('register.step3');
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER TAHAP 3
    |--------------------------------------------------------------------------
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


    /*
    |--------------------------------------------------------------------------
    | SELESAIKAN REGISTER
    |--------------------------------------------------------------------------
    */

    public function registerFinish()
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA SESSION
        |--------------------------------------------------------------------------
        */

        $step1 = session('register.step1');

        $step2 = session('register.step2');


        /*
        |--------------------------------------------------------------------------
        | CEK SESSION
        |--------------------------------------------------------------------------
        */

        if (!$step1 || !$step2) {

            return redirect()->route('register');
        }


        /*
        |--------------------------------------------------------------------------
        | BUAT USER
        |--------------------------------------------------------------------------
        */

        $user = User::create([

            'name' =>
                $step1['nama_lengkap'],

            'email' =>
                $step1['email'],

            'password' =>
                Hash::make($step1['password']),

            'role' =>
                'siswa',

        ]);


        /*
        |--------------------------------------------------------------------------
        | BUAT DATA SISWA
        |--------------------------------------------------------------------------
        */

        Siswa::create([

            'user_id' =>
                $user->id,

            'nama_lengkap' =>
                $step1['nama_lengkap'],

            'nisn' =>
                $step1['nisn'],

            'tanggal_lahir' =>
                $step1['tanggal_lahir'],

            'jenis_kelamin' =>
                $step1['jenis_kelamin'],

            'no_telepon' =>
                $step1['no_telepon'],

            'nama_sekolah' =>
                $step2['nama_sekolah'],

            'jurusan' =>
                $step2['jurusan'],

            'kelas' =>
                $step2['kelas'],

            'tempat_pkl' =>
                $step2['tempat_pkl'],

            'tanggal_mulai_pkl' =>
                $step2['tanggal_mulai_pkl'],

            'tanggal_selesai_pkl' =>
                $step2['tanggal_selesai_pkl'],

        ]);


        /*
        |--------------------------------------------------------------------------
        | HAPUS SESSION REGISTER
        |--------------------------------------------------------------------------
        */

        session()->forget('register');


        /*
        |--------------------------------------------------------------------------
        | LOGIN OTOMATIS
        |--------------------------------------------------------------------------
        */

        Auth::login($user);


        /*
        |--------------------------------------------------------------------------
        | MASUK DASHBOARD SISWA
        |--------------------------------------------------------------------------
        */

        return redirect('/siswa/dashboard')
            ->with(
                'success',
                'Pendaftaran berhasil!'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | LUPA PASSWORD
    |--------------------------------------------------------------------------
    */

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }
}