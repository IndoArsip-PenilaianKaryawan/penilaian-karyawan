<!DOCTYPE html>
<html>

<head>
    <title>Create User</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>



<body>
    @include('component.sidebar')
    <div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
        <div class="p-8 bg-white">
            <h1 class="font-semibold text-xl text-center">Tambah Users</h1>
            <form action="{{ route('users.store') }}" method="POST" class="gap-6 grid">
                @csrf
                <div class="gap-2 grid">
                    <div class="font-semibold">Name:</div>
                    <input type="text" id="name" name="name" required placeholder="Masukan Nama" class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                </div>
                <div class="gap-2 grid">
                    <div class="font-semibold">Username:</div>
                    <input type="text" id="username" name="username" required placeholder="Masukan Username" class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                </div>
                <div class="gap-2 grid">
                    <div class="font-semibold">Password:</div>
                    <input type="password" id="password" name="password" required placeholder="Masukan Password" class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                </div>

                <button type="submit" class="p-4 bg-[#9F2D2D]  rounded-2xl  text-sm w-full outline-0 text-white font-semibold">Tambah</button>
            </form>
        </div>

        <script>
        </script>
    </div>
</body>

</html>
