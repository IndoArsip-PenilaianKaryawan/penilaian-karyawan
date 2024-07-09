<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>

    @include('component.sidebar2')
    <!-- component -->
    <div class="min-h-screen bg-[#F5F6F7]">
        <div class="p-4 xl:ml-80">
            <div class="flex flex-wrap mt-12 gap-6">
                <!-- card -->
                <div class="w-full max-w-md p-8 bg-[#9F2D2D] border border-gray-200 rounded-2xl shadow ">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-normal tracking-tight text-white opacity-60">Karyawan</h5>
                    </a>
                    <div class="flex justify-between items-start">
                        <p class="text-6xl mb-3 font-semibold text-white">1</p>
                        <svg width="57" height="56" viewBox="0 0 57 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.5" width="56" height="56" rx="28" fill="#202020" />
                            <path d="M28.5 18C25.8766 18 23.75 20.1266 23.75 22.75C23.75 25.3734 25.8766 27.5 28.5 27.5C31.1234 27.5 33.25 25.3734 33.25 22.75C33.25 20.1266 31.1234 18 28.5 18Z" fill="#FB5151" />
                            <path d="M25.5 29C22.8766 29 20.75 31.1266 20.75 33.75C20.75 36.3734 22.8766 38.5 25.5 38.5H31.5C34.1234 38.5 36.25 36.3734 36.25 33.75C36.25 31.1266 34.1234 29 31.5 29H25.5Z" fill="#FB5151" />
                        </svg>

                    </div>

                </div>
     </div>

        <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
