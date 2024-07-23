<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>

    @if (session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white min-h-screen justify-center items-center flex min-w-full">
        <div class="py-12 px-8 rounded-2xl border border-[#A5A5A5] md:w-1/3">
            <h1 class="font-semibold text-3xl text-center pb-8">Login</h1>
            <form method="POST" action="{{ route('login') }}" class="gap-6 grid">
                @csrf
                @error('msg')
                <span role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="gap-2 grid">
                    <div class="font-semibold">No Pegawai:</div>
                    <input html type="text" id="username" name="username" required placeholder="Masukan No Pegawai" class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                </div>
                <div class="gap-2 grid">
                    <div class="font-semibold">Password:</div>
                    <input type="password" id="password" name="password" required placeholder="Masukan password" class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                </div>
                <button type="submit" class="p-4 bg-[#9F2D2D]  rounded-2xl  text-sm w-full outline-0 text-white font-semibold">Login</button>
            </form>
        </div>

    </div>

</body>

</html>
