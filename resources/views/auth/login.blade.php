<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    @if ($errors->any())
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <div class="bg-white min-h-screen justify-center items-center flex min-w-full">
        <div class="py-12 px-8 rounded-2xl border border-[#A5A5A5] md:w-1/3">
            <h1 class="font-semibold text-3xl text-center pb-8">Login</h1>
            <form method="POST" action="{{ route('login') }}" class="gap-6 grid">
                @csrf
                <div class="gap-2 grid">
                    <div class="font-semibold">No Pegawai:</div>
                    <input type="text" id="username" name="username" required placeholder="Masukan No Pegawai" class="p-4 bg-[#E5E5E5] rounded-2xl text-sm w-full outline-0">
                </div>
                <div class="gap-2 grid">
                    <div class="font-semibold">Password:</div>
                    <input type="password" id="password" name="password" required placeholder="Masukan password" class="p-4 bg-[#E5E5E5] rounded-2xl text-sm w-full outline-0">
                </div>
                <button type="submit" class="p-4 bg-[#9F2D2D] rounded-2xl text-sm w-full outline-0 text-white font-semibold">Login</button>
            </form>
        </div>
    </div>

</body>

</html>
