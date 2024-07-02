<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        .active {
            background-color: #9F2D2D; /* Sesuaikan dengan warna yang diinginkan */
            color: white;
        }
    </style>
</head>

<body>

    <!-- component -->
        <aside class="bg-white -translate-x-80 fixed inset-0 z-50 my-4 ml-4 h-[calc(100vh-32px)] w-72 rounded-xl transition-transform duration-300 xl:translate-x-0">
            <div class="relative border-b border-white/20">
                <a class="flex items-center gap-4 py-6 px-8" href="#/">
                    <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-black">IndoArsip Admin Dashboard </h6>
                </a>
            </div>
            <div class="m-4">
                <ul class="mb-4 flex flex-col gap-1">
                    <li>
                        <a href="#">
                            <button class="flex items-center gap-6 w-full p-4 rounded-2xl"  type="button">
                                <span class="text-xs">ini icon</span>
                                <p>dashboard</p>
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href="/users/create">
                            <button id="user-link" class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                                <span class="text-xs">ini icon</span>
                                <p>User</p>
                            </button>
                        </a>
                    </li>
                    <li>
                        <a  href="/karyawan">
                            <button id="karyawan-link" class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                                <span class="text-xs">ini icon</span>
                                <p >Karyawan</p>
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <button class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                                <span class="text-xs">ini icon</span>
                                <p>notifactions</p>
                            </button>
                        </a>
                    </li>
                </ul>
                <ul class="mb-4 flex flex-col gap-1">
                    <li class="mx-3.5 mt-4 mb-2">
                        <p class="block antialiased font-sans text-sm leading-normal text-black font-black uppercase opacity-75">auth pages</p>
                    </li>
                    <li>
                        <a href="#">
                            <button class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-inherit">
                                    <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z" clip-rule="evenodd"></path>
                                </svg>
                                <p>sign in</p>
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <button class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-inherit">
                                    <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
                                </svg>
                                <p>sign up</p>
                            </button>
                        </a>
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
                "/": "dashboard-link",
                "/users/create": "user-link",
                "/karyawan": "karyawan-link",
                "/notifications": "notifications-link",
                "/signin": "signin-link",
                "/signup": "signup-link"
            };

            // Remove 'active' class from all links
            for (const linkId in links) {
                document.getElementById(links[linkId])?.classList.remove("active");
            }

            // Add 'active' class to the current link
            if (links[currentPath]) {
                document.getElementById(links[currentPath])?.classList.add("active");
                console.log('test');
            }else if (currentPath.includes('karyawan')) {
                document.getElementById('karyawan-link')?.classList.add("active");
            }
        });
    </script>
</body>

</html>
