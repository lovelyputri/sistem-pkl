<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
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
                'Username wajib diisi.',

            'password.required' =>
                'Password wajib diisi.',

        ]);


        if (!Auth::attempt($credentials, $request->boolean('remember'))) {

            return back()
                ->withInput(
                    $request->only('username')
                )
                ->withErrors([
                    'username' =>
                        'Username atau password salah.',
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

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    public function showRegister()
    {
        return view('auth.register');
    }


    public function registerStep1(Request $request)
    {
        $data = $request->validate([

            'nama_lengkap' => [
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

            'username' => [
                'required',
                'string',
                'max:50',
                'unique:users,username',
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

        ]);


        session([
            'register.step1' => $data,
        ]);


        return redirect()->route('register.step2');
    }


    public function showRegisterStep2()
    {
        if (!session()->has('register.step1')) {

            return redirect()->route('register');

        }


        return view('auth.register-step2');
    }


    public function registerStep2(Request $request)
    {
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

        ]);


        session([
            'register.step2' => $data,
        ]);


        return redirect()->route('register.step3');
    }



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


    public function registerFinish()
    {
        $step1 = session('register.step1');

        $step2 = session('register.step2');


        if (!$step1 || !$step2) {

            return redirect()->route('register');

        }


        $user = User::create([

            'name' =>
                $step1['nama_lengkap'],

            'username' =>
                $step1['username'],

            'email' =>
                $step1['email'],

            'password' =>
                Hash::make($step1['password']),

            'role' =>
                'siswa',

        ]);


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


        session()->forget('register');


        Auth::login($user);


        return redirect('/siswa/dashboard')
            ->with(
                'success',
                'Pendaftaran berhasil!'
            );
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }
}
