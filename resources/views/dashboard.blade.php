<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Dashboard Siswa - GUSPELOR.NET
    </title>

</head>

<body>

    <h1>
        Dashboard Siswa
    </h1>

    <p>
        Selamat datang,
        {{ auth()->user()->name }}
    </p>


    <form
        action="{{ route('logout') }}"
        method="POST"
    >

        @csrf

        <button type="submit">
            Logout
        </button>

    </form>

</body>

</html>
