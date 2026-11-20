
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Peserta Magang</title>
</head>
<body>

    <h2>Login Peserta Magang</h2>

    @if ($errors->any())
        <div style="color: red;">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('intern.login.process') }}" method="POST">
        @csrf

        <div>
            <label>Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Password</label>
            <input
                type="password"
                name="password"
                required
            >
        </div>

        <br>

        <button type="submit">Login</button>
    </form>

</body>
</html>
