<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@400,401,500,501,700,701&display=swap" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <style>
        .active {
            background-color: #9F2D2D;
            color: white;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 2px solid white;
            box-shadow: #E1E1E1 0px 2px 2px;
        }

        td {
            padding: 8px;
            text-align: center;
            background: white;
            font-size: 16px;
        }

        th {
            padding: 8px;
            text-align: center;
            background: #9F2D2D;
            color: white;
            font-size: 16px;
            font-weight: 500;
        }

        thead {
            background-color: #9F2D2D;
            color: white;
        }

        .table-container {
            width: 100%;
            height: fit-content;
            overflow-y: auto;
            overflow-x: auto;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height:100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
                            <p>Dashboard Home</p>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="/penilai/nilai">
                        <button id="penilai-link" class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                            <p>Master Penilaian Karyawan</p>
                        </button>
                    </a>
                </li>
                <li class="relative">
                    <a href="/penilai/periksa">
                        <button id="pengecekan-link" class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                            <p>Master Approval Nilai</p>
                        </button>
                        <div class="absolute inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full -top-2 -end-2">{{$notifCount}}</div>
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
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-inherit">
                                <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z" clip-rule="evenodd"></path>
                            </svg>
                            <p>Sign Out</p>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Sidebar mobile -->
    <div class="md:hidden absolute bg-white w-72 max-h-full h-full inset-0 z-50 overflow-y-auto transition-transform transform -translate-x-full ease-in-out duration-300" id="sidebar">
        <a class="flex items-center gap-4 py-6 px-8" href="#/">
            <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-black">
                IndoArsip Asessment Dashboard </h6>
        </a>
        <div class="m-4">
            <ul class="mb-4 flex flex-col gap-1">
                <li>
                    <a href="/penilai">
                        <button id="dashboard-link" class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                            <p>Dashboard Home</p>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="/penilai/nilai">
                        <button id="penilai-link" class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                            <p>Master Penilaian Karyawan</p>
                        </button>
                    </a>
                </li>
                <li class="relative">
                    <a href="/penilai/periksa">
                        <button id="pengecekan-link" class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                            <p>Master Approval Nilai</p>
                        </button>
                        <div class="absolute inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full -top-2 -end-2">{{$notifCount}}</div>
                    </a>
                </li>
            </ul>
            <ul class="mb-4 flex flex-col gap-1">
                <li class="mx-3.5 mt-4 mb-2">
                    <p class="block antialiased font-sans text-sm leading-normal text-bold font-black uppercase opacity-75">
                        auth pages</p>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="flex items-center gap-6 w-full p-4 rounded-2xl" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-inherit">
                                <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z" clip-rule="evenodd"></path>
                            </svg>
                            <p>Sign Out</p>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Navbar mobile -->
    <div class="bg-white shadow md:hidden">
        <div class="container mx-auto">
            <div class="flex justify-end items-center py-4 px-2">
                <button class="text-gray-500 hover:text-gray-600" id="open-sidebar">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const openSidebarButton = document.getElementById('open-sidebar');

        openSidebarButton.addEventListener('click', (e) => {
            e.stopPropagation();
            sidebar.classList.toggle('-translate-x-full');
        });

        // Close the sidebar when clicking outside of it
        document.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target) && !openSidebarButton.contains(e.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
    @yield('content-penilai')

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
            } else if (currentPath.includes('/penilai/nilai')) {
                document.getElementById('penilai-link')?.classList.add("active");
            } else if (currentPath.includes('/penilai/periksa')) {
                document.getElementById('pengecekan-link')?.classList.add("active");
            }
        });

        var modal = document.getElementById("myModal");
        var btn = document.getElementById("updateButton");
        var span = document.getElementsByClassName("close")[0];
        var confirmBtn = document.getElementById("confirmUpdate");
        var cancelBtn = document.getElementById("cancelUpdate");
        btn.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        cancelBtn.onclick = function() {
            modal.style.display = "none";
        }
        confirmBtn.onclick = function() {
            document.getElementById("updateForm").submit();
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>
