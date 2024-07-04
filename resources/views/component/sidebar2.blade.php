<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        .active {
            background-color: #9F2D2D;
            /* Sesuaikan dengan warna yang diinginkan */
            color: white;
        }
    </style>
</head>

<body>

    <!-- component -->
    <aside class="bg-white -translate-x-80 fixed inset-0 z-50 my-4 ml-4 h-[calc(100vh-32px)] w-72 rounded-xl transition-transform duration-300 xl:translate-x-0">
        <div class="relative border-b border-white/20">
            <a class="flex items-center gap-4 py-6 px-8" href="#/">
                <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-black">IndoArsip Penilai Dashboard </h6>
            </a>
        </div>
        <div class="m-4">
            <ul class="mb-4 flex flex-col gap-1">
                <li>
                    <a href="/penilai">
                        <button id="dashboard-link" class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                            <span class="text-xs">ini icon</span>
                            <p>Dashboard</p>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="/penilai/nilai">
                        <button id="user-link" class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                            <span class="text-xs">ini icon</span>
                            <p>Penilaian Karyawan</p>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="/penilai/periksa">
                        <button id="pengecekan-link" class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                            <span class="text-xs">ini icon</span>
                            <p>Pengecekan Nilai</p>
                        </button>
                    </a>
                </li>
            </ul>
            <ul class="mb-4 flex flex-col gap-1">
                <li class="mx-3.5 mt-4 mb-2">
                    <p class="block antialiased font-sans text-sm leading-normal text-black font-black uppercase opacity-75">auth pages</p>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="flex items-center gap-6 w-full p-4 rounded-2xl" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true" class="w-5 h-5 text-inherit">
                                <path fill-rule="evenodd"
                                    d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p>Sign Out</p>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentPath = window.location.pathname;

            // List of all sidebar links with their IDs
            const links = {
                "/penilai": "dashboard-link",
                "/penilai/nilai": "penilai-link",
                "/penilai/periksa": "pengecekan-link",
            };

            // Remove 'active' class from all links
            for (const linkId in links) {
                document.getElementById(links[linkId])?.classList.remove("active");
            }

            // Add 'active' class to the current link
            if (links[currentPath]) {
                document.getElementById(links[currentPath])?.classList.add("active");
                console.log('test');
            } else if (currentPath.includes('karyawan')) {
                document.getElementById('karyawan-link')?.classList.add("active");
            }
        });
    </script>
</body>

</html>
