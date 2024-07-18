<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@400,401,500,501,700,701&display=swap" rel="stylesheet">
    <style>
        .active {
            background-color: #9F2D2D;
            color: white;
        }

        .active svg {
            stroke: white;
        }
    </style>
</head>

<body>

    <!-- component -->
    <aside class="bg-white -translate-x-80 fixed inset-0 z-50 my-4 ml-4 h-[calc(100vh-32px)] w-72 rounded-xl transition-transform duration-300 xl:translate-x-0">
        <div class="relative border-b border-white/20">
            <a class="flex items-center gap-4 py-6 px-8" href="#/">
                <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-black">
                    IndoArsip Admin Dashboard </h6>
            </a>
        </div>
        <div class="m-4">
            <ul class="mb-4 flex flex-col gap-1">
                <li>
                    <a href="/admin">
                        <button id="dashboard-link" class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                            <span class="text-xs">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.15722 20.7714V17.7047C9.1572 16.9246 9.79312 16.2908 10.581 16.2856H13.4671C14.2587 16.2856 14.9005 16.9209 14.9005 17.7047V17.7047V20.7809C14.9003 21.4432 15.4343 21.9845 16.103 22H18.0271C19.9451 22 21.5 20.4607 21.5 18.5618V18.5618V9.83784C21.4898 9.09083 21.1355 8.38935 20.538 7.93303L13.9577 2.6853C12.8049 1.77157 11.1662 1.77157 10.0134 2.6853L3.46203 7.94256C2.86226 8.39702 2.50739 9.09967 2.5 9.84736V18.5618C2.5 20.4607 4.05488 22 5.97291 22H7.89696C8.58235 22 9.13797 21.4499 9.13797 20.7714V20.7714" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                            </span>
                            <p>Dashboard</p>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="/karyawan">
                        <button id="karyawan-link" class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                            <span class="text-xs">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.4832 18.4989L17.8596 18.0823L18.4832 18.4989ZM5.99987 6.01558L5.58319 5.39197L5.99987 6.01558ZM9.0164 4.72012L8.85109 3.98856L9.0164 4.72012ZM19.7787 15.4824L19.0471 15.3171L19.7787 15.4824ZM17.4442 2.18389L17.1571 2.8768L17.4442 2.18389ZM22.3149 7.05465L23.0078 6.76764L22.3149 7.05465ZM19.4657 10.4988L19.4657 11.2488L19.4657 11.2488L19.4657 10.4988ZM18.5 10.4988L18.5 9.7488H18.5L18.5 10.4988ZM14 5.9988L13.25 5.9988L13.25 5.9988L14 5.9988ZM14 5.03307L14.75 5.03307L14.75 5.03307L14 5.03307ZM19.0471 15.3171C18.8253 16.2989 18.4245 17.2368 17.8596 18.0823L19.1068 18.9156C19.7744 17.9165 20.2481 16.8079 20.5102 15.6477L19.0471 15.3171ZM17.8596 18.0823C16.9531 19.439 15.6646 20.4964 14.1571 21.1208L14.7312 22.5066C16.5127 21.7687 18.0355 20.519 19.1068 18.9156L17.8596 18.0823ZM14.1571 21.1208C12.6497 21.7452 10.9909 21.9086 9.39051 21.5903L9.09787 23.0615C10.9892 23.4377 12.9496 23.2446 14.7312 22.5066L14.1571 21.1208ZM9.39051 21.5903C7.79017 21.272 6.32016 20.4862 5.16637 19.3324L4.10571 20.3931C5.46927 21.7567 7.20656 22.6853 9.09787 23.0615L9.39051 21.5903ZM5.16637 19.3324C4.01259 18.1787 3.22685 16.7086 2.90853 15.1083L1.43735 15.4009C1.81355 17.2922 2.74215 19.0295 4.10571 20.3931L5.16637 19.3324ZM2.90853 15.1083C2.5902 13.508 2.75357 11.8492 3.378 10.3417L1.99218 9.76764C1.25422 11.5492 1.06114 13.5096 1.43735 15.4009L2.90853 15.1083ZM3.378 10.3417C4.00242 8.83417 5.05984 7.5457 6.41655 6.63918L5.58319 5.39197C3.97981 6.46332 2.73013 7.98606 1.99218 9.76764L3.378 10.3417ZM6.41655 6.63918C7.26198 6.07428 8.19996 5.67351 9.1817 5.45167L8.85109 3.98856C7.69088 4.25073 6.58234 4.72436 5.58319 5.39197L6.41655 6.63918ZM10.25 6.4988V8.4988H11.75V6.4988H10.25ZM16 14.2488H18V12.7488H16V14.2488ZM10.25 8.4988C10.25 11.6744 12.8244 14.2488 16 14.2488V12.7488C13.6528 12.7488 11.75 10.846 11.75 8.4988H10.25ZM9.1817 5.45167C9.67431 5.34036 10.25 5.74902 10.25 6.4988H11.75C11.75 5.03945 10.5133 3.61296 8.85109 3.98856L9.1817 5.45167ZM20.5102 15.6477C20.8858 13.9855 19.4594 12.7488 18 12.7488V14.2488C18.7498 14.2488 19.1584 14.8245 19.0471 15.3171L20.5102 15.6477ZM17.1571 2.8768C18.1581 3.2914 19.0676 3.89909 19.8336 4.66517L20.8943 3.60451C19.9889 2.69914 18.9141 1.98096 17.7312 1.49098L17.1571 2.8768ZM19.8336 4.66517C20.5997 5.43125 21.2074 6.34073 21.622 7.34166L23.0078 6.76764C22.5178 5.58471 21.7997 4.50988 20.8943 3.60451L19.8336 4.66517ZM19.4657 9.7488H18.5V11.2488H19.4657V9.7488ZM14.75 5.9988V5.03307H13.25V5.9988H14.75ZM21.622 7.34166C21.8737 7.94933 21.7342 8.51071 21.3404 8.95635C20.9297 9.42115 20.24 9.7488 19.4657 9.7488L19.4657 11.2488C20.6434 11.2488 21.7518 10.756 22.4644 9.94961C23.194 9.12401 23.5031 7.96331 23.0078 6.76764L21.622 7.34166ZM18.5 9.7488C16.4289 9.7488 14.75 8.06987 14.75 5.9988L13.25 5.9988C13.25 8.8983 15.6005 11.2488 18.5 11.2488L18.5 9.7488ZM17.7312 1.49098C16.5355 0.995713 15.3748 1.30483 14.5492 2.03438C13.7428 2.747 13.25 3.85542 13.25 5.03307L14.75 5.03307C14.75 4.2588 15.0777 3.56914 15.5425 3.15841C15.9881 2.76461 16.5495 2.62509 17.1571 2.8768L17.7312 1.49098Z" fill="#848382" />
                                </svg>  
                            </span>
                            <p>Karyawan</p>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="/periode">
                        <button id="periode-link" class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                            <span class="text-xs">ini icon</span>
                            <p>Periode</p>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="/kompetensi">
                        <button id="kompetensi-link" class="flex items-center gap-6 w-full p-4 rounded-2xl" type="button">
                            <span class="text-xs">ini icon</span>
                            <p>Kompetensi</p>
                        </button>
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
    </aside>

    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentPath = window.location.pathname;

            // List of all sidebar links with their IDs
            const links = {
                "/admin": "dashboard-link",
                "/karyawan": "karyawan-link",
                "/periode": "periode-link",
                "/kompetensi": "kompetensi-link",
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
            } else if (currentPath.includes('karyawan')) {
                document.getElementById('karyawan-link')?.classList.add("active");
            } else if (currentPath.includes('kompetensi')) {
                document.getElementById('kompetensi-link')?.classList.add("active");
            } else if (currentPath.includes('periode')) {
                document.getElementById('periode-link')?.classList.add("active");
            }
        });
    </script>
</body>

</html>
