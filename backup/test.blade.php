<form action="{{ route('login.action') }}" method="POST">
    @csrf

    <div class="form-outline form-dark mb-4">
        <input class="form-control form-control-lg" type="username" name="username" value="{{ old('username') }}" required />
        <label class="form-label" for="username">Username</label>
    </div>

    <div class="form-outline form-dark mb-4">
        <input class="form-control form-control-lg" type="password" name="password" required />
        <label class="form-label" for="password">Password</label>
    </div>

    <div class="mb-3">
        <button class="btn btn-primary form-control mb-2 mt-2">Login</button>
        <a class="btn bg-dark text-white form-control" href="{{ route('home') }}">Kembali</a>
    </div>

    <div class="mt-4">
        <p class="small">
            <a class="text-dark">Belum Punya Akun?</a>
            <a class="small"><br></a>
            <a class="text-dark-50" href="{{ route('registrasi-customer') }}">Registrasi Customer</a>
            <br>
            <a class="text-dark-50" href="{{ route('registrasi-driver') }}">Registrasi Driver</a>
        </p>
    </div>
</form>