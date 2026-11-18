
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Peserta</title>
</head>
<body>

    <h1>Selamat Datang, {{ $intern->name }}!</h1>

    <p>Email: {{ $intern->email }}</p>

    <form action="{{ route('intern.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>
</html>
