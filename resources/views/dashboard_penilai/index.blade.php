@extends('component.sidebar2')
@section('content-penilai')
<div class="min-h-screen bg-[#F5F6F7]">
    <div class="p-4 xl:ml-80">

        <!-- Welcome User Login -->
        <div class="lg:mt-8 mt-2">
            <h1 class="text-3xl mb-6 font-semibold">Selamat datang kembali, {{$dataLogin->nama}}</h1>
        </div>
        <div class="flex flex-wrap gap-4">
            <!-- card -->
            <div class="w-full max-w-xs p-8 bg-[#9F2D2D] border  transition relative duration-300 cursor-pointer hover:translate-y-[3px] border-none outline-none hover:shadow-[0_-8px_0px_0px_rgb(0,0,50)] rounded-2xl shadow ">
                <a href="{{route('dashboard_penilai.periksa')}}">
                    <h5 class="mb-2 text-2xl font-normal tracking-tight text-white opacity-60">Karyawan</h5>
                </a>
                <div class="flex justify-between items-start">
                    <p class="text-6xl mb-3 font-semibold text-white">{{$total}}</p>
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="56" height="56" rx="28" fill="#202020" />
                        <path d="M24.6506 26.3681C23.7855 25.5078 23.25 24.3164 23.25 23C23.25 21.6836 23.7855 20.4922 24.6506 19.6319C24.1526 19.3873 23.5923 19.25 23 19.25C20.9289 19.25 19.25 20.9289 19.25 23C19.25 25.0711 20.9289 26.75 23 26.75C23.5923 26.75 24.1526 26.6127 24.6506 26.3681Z" fill="#FB5151" />
                        <path d="M24.25 23C24.25 20.9289 25.9289 19.25 28 19.25C30.0711 19.25 31.75 20.9289 31.75 23C31.75 25.0711 30.0711 26.75 28 26.75C25.9289 26.75 24.25 25.0711 24.25 23Z" fill="#FB5151" />
                        <path d="M31.3494 19.6319C32.2145 20.4922 32.75 21.6836 32.75 23C32.75 24.3164 32.2145 25.5078 31.3494 26.3681C31.8474 26.6127 32.4077 26.75 33 26.75C35.0711 26.75 36.75 25.0711 36.75 23C36.75 20.9289 35.0711 19.25 33 19.25C32.4077 19.25 31.8474 19.3873 31.3494 19.6319Z" fill="#FB5151" />
                        <path d="M21.25 32C21.25 29.9289 22.9289 28.25 25 28.25H31C33.0711 28.25 34.75 29.9289 34.75 32C34.75 34.0711 33.0711 35.75 31 35.75H25C22.9289 35.75 21.25 34.0711 21.25 32Z" fill="#FB5151" />
                        <path d="M16.25 31C16.25 28.9289 17.9289 27.25 20 27.25H25C22.3766 27.25 20.25 29.3766 20.25 32C20.25 33.0249 20.5746 33.9739 21.1266 34.75H20C17.9289 34.75 16.25 33.0711 16.25 31Z" fill="#FB5151" />
                        <path d="M35.75 32C35.75 33.0249 35.4254 33.9739 34.8734 34.75H36C38.0711 34.75 39.75 33.0711 39.75 31C39.75 28.9289 38.0711 27.25 36 27.25H31C33.6234 27.25 35.75 29.3766 35.75 32Z" fill="#FB5151" />
                    </svg>

                </div>

            </div>
            @if ($dataLogin->id_jabatan == 4)
            <div class="w-full max-w-xs p-8 bg-[#9F2D2D] border  transition relative duration-300 cursor-pointer hover:translate-y-[3px] border-none outline-none hover:shadow-[0_-8px_0px_0px_rgb(0,0,50)] rounded-2xl shadow  ">
                <a href="{{route('dashboard_penilai.periksa')}}">
                    <h5 class="mb-2 text-2xl font-normal tracking-tight text-white opacity-60">Inkompeten</h5>
                </a>
                <div class="flex justify-between items-start">
                    <p class="text-6xl mb-3 font-semibold text-white">{{$totalInkompeten}}</p>
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="56" height="56" rx="28" fill="#202020" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19 27C19 23.2503 19 21.3754 19.9549 20.0611C20.2633 19.6366 20.6366 19.2633 21.0611 18.9549C22.3754 18 24.2503 18 28 18C31.7497 18 33.6246 18 34.9389 18.9549C35.3634 19.2633 35.7367 19.6366 36.0451 20.0611C37 21.3754 37 23.2503 37 27V29C37 29.8389 37 30.584 36.9893 31.25L36.9192 31.25C36.0672 31.2499 35.5482 31.2499 35.1005 31.3208C32.6401 31.7105 30.7105 33.6401 30.3208 36.1005C30.2499 36.5482 30.2499 37.0672 30.25 37.9192L30.25 37.9893C29.584 38 28.8389 38 28 38C24.2503 38 22.3754 38 21.0611 37.0451C20.6366 36.7367 20.2633 36.3634 19.9549 35.9389C19 34.6246 19 32.7497 19 29V27ZM24 23.25C23.5858 23.25 23.25 23.5858 23.25 24C23.25 24.4142 23.5858 24.75 24 24.75H27C27.4142 24.75 27.75 24.4142 27.75 24C27.75 23.5858 27.4142 23.25 27 23.25H24ZM24 27.25C23.5858 27.25 23.25 27.5858 23.25 28C23.25 28.4142 23.5858 28.75 24 28.75H32C32.4142 28.75 32.75 28.4142 32.75 28C32.75 27.5858 32.4142 27.25 32 27.25H24ZM24 31.25C23.5858 31.25 23.25 31.5858 23.25 32C23.25 32.4142 23.5858 32.75 24 32.75H27C27.4142 32.75 27.75 32.4142 27.75 32C27.75 31.5858 27.4142 31.25 27 31.25H24Z" fill="#FB5151" />
                        <path d="M35.3352 32.8023C35.6435 32.7535 36.0243 32.7501 36.9347 32.75C36.8403 34.1896 36.6094 35.1622 36.0451 35.9389C35.7367 36.3634 35.3634 36.7367 34.9389 37.0451C34.1622 37.6094 33.1896 37.8403 31.75 37.9347C31.7501 37.0243 31.7535 36.6435 31.8023 36.3352C32.0904 34.5166 33.5166 33.0904 35.3352 32.8023Z" fill="#FB5151" />
                    </svg>

                </div>

            </div>
            <div class="w-full max-w-xs p-8 bg-[#9F2D2D] border  transition relative duration-300 cursor-pointer hover:translate-y-[3px] border-none outline-none hover:shadow-[0_-8px_0px_0px_rgb(0,0,50)] rounded-2xl shadow  ">
                <a href="{{route('dashboard_penilai.periksa')}}">
                    <h5 class="mb-2 text-2xl font-normal tracking-tight text-white opacity-60">Kompeten</h5>
                </a>
                <div class="flex justify-between items-start">
                    <p class="text-6xl mb-3 font-semibold text-white">{{$totalKompeten}}</p>
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="56" height="56" rx="28" fill="#202020" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19 27C19 23.2503 19 21.3754 19.9549 20.0611C20.2633 19.6366 20.6366 19.2633 21.0611 18.9549C22.3754 18 24.2503 18 28 18C31.7497 18 33.6246 18 34.9389 18.9549C35.3634 19.2633 35.7367 19.6366 36.0451 20.0611C37 21.3754 37 23.2503 37 27V29C37 29.8389 37 30.584 36.9893 31.25L36.9192 31.25C36.0672 31.2499 35.5482 31.2499 35.1005 31.3208C32.6401 31.7105 30.7105 33.6401 30.3208 36.1005C30.2499 36.5482 30.2499 37.0672 30.25 37.9192L30.25 37.9893C29.584 38 28.8389 38 28 38C24.2503 38 22.3754 38 21.0611 37.0451C20.6366 36.7367 20.2633 36.3634 19.9549 35.9389C19 34.6246 19 32.7497 19 29V27ZM24 23.25C23.5858 23.25 23.25 23.5858 23.25 24C23.25 24.4142 23.5858 24.75 24 24.75H27C27.4142 24.75 27.75 24.4142 27.75 24C27.75 23.5858 27.4142 23.25 27 23.25H24ZM24 27.25C23.5858 27.25 23.25 27.5858 23.25 28C23.25 28.4142 23.5858 28.75 24 28.75H32C32.4142 28.75 32.75 28.4142 32.75 28C32.75 27.5858 32.4142 27.25 32 27.25H24ZM24 31.25C23.5858 31.25 23.25 31.5858 23.25 32C23.25 32.4142 23.5858 32.75 24 32.75H27C27.4142 32.75 27.75 32.4142 27.75 32C27.75 31.5858 27.4142 31.25 27 31.25H24Z" fill="#FB5151" />
                        <path d="M35.3352 32.8023C35.6435 32.7535 36.0243 32.7501 36.9347 32.75C36.8403 34.1896 36.6094 35.1622 36.0451 35.9389C35.7367 36.3634 35.3634 36.7367 34.9389 37.0451C34.1622 37.6094 33.1896 37.8403 31.75 37.9347C31.7501 37.0243 31.7535 36.6435 31.8023 36.3352C32.0904 34.5166 33.5166 33.0904 35.3352 32.8023Z" fill="#FB5151" />
                    </svg>

                </div>

            </div>
            @elseif($dataLogin->id_jabatan == 3)
            <div class="w-full max-w-xs p-8 bg-[#9F2D2D] border  transition relative duration-300 cursor-pointer hover:translate-y-[3px] border-none outline-none hover:shadow-[0_-8px_0px_0px_rgb(0,0,50)] rounded-2xl shadow  ">
                <a href="{{route('dashboard_penilai.periksa')}}">
                    <h5 class="mb-2 text-2xl font-normal tracking-tight text-white opacity-60">Inkompeten</h5>
                </a>
                <div class="flex justify-between items-start">
                    <p class="text-6xl mb-3 font-semibold text-white">{{$totalInkompetenManager}}</p>
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="56" height="56" rx="28" fill="#202020" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19 27C19 23.2503 19 21.3754 19.9549 20.0611C20.2633 19.6366 20.6366 19.2633 21.0611 18.9549C22.3754 18 24.2503 18 28 18C31.7497 18 33.6246 18 34.9389 18.9549C35.3634 19.2633 35.7367 19.6366 36.0451 20.0611C37 21.3754 37 23.2503 37 27V29C37 29.8389 37 30.584 36.9893 31.25L36.9192 31.25C36.0672 31.2499 35.5482 31.2499 35.1005 31.3208C32.6401 31.7105 30.7105 33.6401 30.3208 36.1005C30.2499 36.5482 30.2499 37.0672 30.25 37.9192L30.25 37.9893C29.584 38 28.8389 38 28 38C24.2503 38 22.3754 38 21.0611 37.0451C20.6366 36.7367 20.2633 36.3634 19.9549 35.9389C19 34.6246 19 32.7497 19 29V27ZM24 23.25C23.5858 23.25 23.25 23.5858 23.25 24C23.25 24.4142 23.5858 24.75 24 24.75H27C27.4142 24.75 27.75 24.4142 27.75 24C27.75 23.5858 27.4142 23.25 27 23.25H24ZM24 27.25C23.5858 27.25 23.25 27.5858 23.25 28C23.25 28.4142 23.5858 28.75 24 28.75H32C32.4142 28.75 32.75 28.4142 32.75 28C32.75 27.5858 32.4142 27.25 32 27.25H24ZM24 31.25C23.5858 31.25 23.25 31.5858 23.25 32C23.25 32.4142 23.5858 32.75 24 32.75H27C27.4142 32.75 27.75 32.4142 27.75 32C27.75 31.5858 27.4142 31.25 27 31.25H24Z" fill="#FB5151" />
                        <path d="M35.3352 32.8023C35.6435 32.7535 36.0243 32.7501 36.9347 32.75C36.8403 34.1896 36.6094 35.1622 36.0451 35.9389C35.7367 36.3634 35.3634 36.7367 34.9389 37.0451C34.1622 37.6094 33.1896 37.8403 31.75 37.9347C31.7501 37.0243 31.7535 36.6435 31.8023 36.3352C32.0904 34.5166 33.5166 33.0904 35.3352 32.8023Z" fill="#FB5151" />
                    </svg>

                </div>

            </div>
            <div class="w-full max-w-xs p-8 bg-[#9F2D2D] border  transition relative duration-300 cursor-pointer hover:translate-y-[3px] border-none outline-none hover:shadow-[0_-8px_0px_0px_rgb(0,0,50)] rounded-2xl shadow  ">
                <a href="{{route('dashboard_penilai.periksa')}}">
                    <h5 class="mb-2 text-2xl font-normal tracking-tight text-white opacity-60">Kompeten</h5>
                </a>
                <div class="flex justify-between items-start">
                    <p class="text-6xl mb-3 font-semibold text-white">{{$totalKompetenManager}}</p>
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="56" height="56" rx="28" fill="#202020" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19 27C19 23.2503 19 21.3754 19.9549 20.0611C20.2633 19.6366 20.6366 19.2633 21.0611 18.9549C22.3754 18 24.2503 18 28 18C31.7497 18 33.6246 18 34.9389 18.9549C35.3634 19.2633 35.7367 19.6366 36.0451 20.0611C37 21.3754 37 23.2503 37 27V29C37 29.8389 37 30.584 36.9893 31.25L36.9192 31.25C36.0672 31.2499 35.5482 31.2499 35.1005 31.3208C32.6401 31.7105 30.7105 33.6401 30.3208 36.1005C30.2499 36.5482 30.2499 37.0672 30.25 37.9192L30.25 37.9893C29.584 38 28.8389 38 28 38C24.2503 38 22.3754 38 21.0611 37.0451C20.6366 36.7367 20.2633 36.3634 19.9549 35.9389C19 34.6246 19 32.7497 19 29V27ZM24 23.25C23.5858 23.25 23.25 23.5858 23.25 24C23.25 24.4142 23.5858 24.75 24 24.75H27C27.4142 24.75 27.75 24.4142 27.75 24C27.75 23.5858 27.4142 23.25 27 23.25H24ZM24 27.25C23.5858 27.25 23.25 27.5858 23.25 28C23.25 28.4142 23.5858 28.75 24 28.75H32C32.4142 28.75 32.75 28.4142 32.75 28C32.75 27.5858 32.4142 27.25 32 27.25H24ZM24 31.25C23.5858 31.25 23.25 31.5858 23.25 32C23.25 32.4142 23.5858 32.75 24 32.75H27C27.4142 32.75 27.75 32.4142 27.75 32C27.75 31.5858 27.4142 31.25 27 31.25H24Z" fill="#FB5151" />
                        <path d="M35.3352 32.8023C35.6435 32.7535 36.0243 32.7501 36.9347 32.75C36.8403 34.1896 36.6094 35.1622 36.0451 35.9389C35.7367 36.3634 35.3634 36.7367 34.9389 37.0451C34.1622 37.6094 33.1896 37.8403 31.75 37.9347C31.7501 37.0243 31.7535 36.6435 31.8023 36.3352C32.0904 34.5166 33.5166 33.0904 35.3352 32.8023Z" fill="#FB5151" />
                    </svg>

                </div>

            </div>
            @endif

            <!-- jika jabatan adalah kepala bagian -->
            @if ($dataLogin->id_jabatan == 4)
            <div class="w-full max-w-xs p-8 bg-[#9F2D2D] border  transition relative duration-300 cursor-pointer hover:translate-y-[3px] border-none outline-none hover:shadow-[0_-8px_0px_0px_rgb(0,0,50)] rounded-2xl shadow  ">
                <a href="{{route('dashboard_penilai.periksa')}}">
                    <h5 class="mb-2 text-xl font-normal tracking-tight text-white opacity-60">Rata-rata Bagian {{$rataNilaiBidang->nama_bidang}}</h5>
                </a>
                <div class="flex justify-between items-start">
                    <p class="text-6xl mb-3 font-semibold text-white">{{number_format($rataNilaiBidang->rata_nilai_bidang,2)}}</p>
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="56" height="56" rx="28" fill="#202020" />
                        <path d="M24.6506 26.3681C23.7855 25.5078 23.25 24.3164 23.25 23C23.25 21.6836 23.7855 20.4922 24.6506 19.6319C24.1526 19.3873 23.5923 19.25 23 19.25C20.9289 19.25 19.25 20.9289 19.25 23C19.25 25.0711 20.9289 26.75 23 26.75C23.5923 26.75 24.1526 26.6127 24.6506 26.3681Z" fill="#FB5151" />
                        <path d="M24.25 23C24.25 20.9289 25.9289 19.25 28 19.25C30.0711 19.25 31.75 20.9289 31.75 23C31.75 25.0711 30.0711 26.75 28 26.75C25.9289 26.75 24.25 25.0711 24.25 23Z" fill="#FB5151" />
                        <path d="M31.3494 19.6319C32.2145 20.4922 32.75 21.6836 32.75 23C32.75 24.3164 32.2145 25.5078 31.3494 26.3681C31.8474 26.6127 32.4077 26.75 33 26.75C35.0711 26.75 36.75 25.0711 36.75 23C36.75 20.9289 35.0711 19.25 33 19.25C32.4077 19.25 31.8474 19.3873 31.3494 19.6319Z" fill="#FB5151" />
                        <path d="M21.25 32C21.25 29.9289 22.9289 28.25 25 28.25H31C33.0711 28.25 34.75 29.9289 34.75 32C34.75 34.0711 33.0711 35.75 31 35.75H25C22.9289 35.75 21.25 34.0711 21.25 32Z" fill="#FB5151" />
                        <path d="M16.25 31C16.25 28.9289 17.9289 27.25 20 27.25H25C22.3766 27.25 20.25 29.3766 20.25 32C20.25 33.0249 20.5746 33.9739 21.1266 34.75H20C17.9289 34.75 16.25 33.0711 16.25 31Z" fill="#FB5151" />
                        <path d="M35.75 32C35.75 33.0249 35.4254 33.9739 34.8734 34.75H36C38.0711 34.75 39.75 33.0711 39.75 31C39.75 28.9289 38.0711 27.25 36 27.25H31C33.6234 27.25 35.75 29.3766 35.75 32Z" fill="#FB5151" />
                    </svg>

                </div>

            </div>


            <!-- jika jabatan adalah manager -->
            @elseif($dataLogin->id_jabatan == 3)
            <div class="w-full max-w-sm p-8 bg-[#9F2D2D] border transition relative duration-300 cursor-pointer hover:translate-y-[3px] border-none outline-none hover:shadow-[0_-8px_0px_0px_rgb(0,0,50)] rounded-2xl shadow ">
                <a href="{{route('dashboard_penilai.periksa')}}">
                    <h5 class="mb-2 text-xl font-normal tracking-tight text-white opacity-60">Rata-rata Dapartement {{$rataDapartemen->nama_departement}}</h5>
                </a>
                <div class="flex justify-between items-start">
                    <p class="text-6xl mb-3 font-semibold text-white">{{number_format($rataDapartemen->rata_nilai_departement,2)}}</p>
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="56" height="56" rx="28" fill="#202020" />
                        <path d="M24.6506 26.3681C23.7855 25.5078 23.25 24.3164 23.25 23C23.25 21.6836 23.7855 20.4922 24.6506 19.6319C24.1526 19.3873 23.5923 19.25 23 19.25C20.9289 19.25 19.25 20.9289 19.25 23C19.25 25.0711 20.9289 26.75 23 26.75C23.5923 26.75 24.1526 26.6127 24.6506 26.3681Z" fill="#FB5151" />
                        <path d="M24.25 23C24.25 20.9289 25.9289 19.25 28 19.25C30.0711 19.25 31.75 20.9289 31.75 23C31.75 25.0711 30.0711 26.75 28 26.75C25.9289 26.75 24.25 25.0711 24.25 23Z" fill="#FB5151" />
                        <path d="M31.3494 19.6319C32.2145 20.4922 32.75 21.6836 32.75 23C32.75 24.3164 32.2145 25.5078 31.3494 26.3681C31.8474 26.6127 32.4077 26.75 33 26.75C35.0711 26.75 36.75 25.0711 36.75 23C36.75 20.9289 35.0711 19.25 33 19.25C32.4077 19.25 31.8474 19.3873 31.3494 19.6319Z" fill="#FB5151" />
                        <path d="M21.25 32C21.25 29.9289 22.9289 28.25 25 28.25H31C33.0711 28.25 34.75 29.9289 34.75 32C34.75 34.0711 33.0711 35.75 31 35.75H25C22.9289 35.75 21.25 34.0711 21.25 32Z" fill="#FB5151" />
                        <path d="M16.25 31C16.25 28.9289 17.9289 27.25 20 27.25H25C22.3766 27.25 20.25 29.3766 20.25 32C20.25 33.0249 20.5746 33.9739 21.1266 34.75H20C17.9289 34.75 16.25 33.0711 16.25 31Z" fill="#FB5151" />
                        <path d="M35.75 32C35.75 33.0249 35.4254 33.9739 34.8734 34.75H36C38.0711 34.75 39.75 33.0711 39.75 31C39.75 28.9289 38.0711 27.25 36 27.25H31C33.6234 27.25 35.75 29.3766 35.75 32Z" fill="#FB5151" />
                    </svg>
                </div>

            </div>
            @endif
        </div>


        <!-- jika jabatan adalah kepala bagian -->
        @if ($dataLogin->id_jabatan == 4)
        <div class="container mx-auto mt-8">
            <div class="mx-auto p-6 pb-1 border bg-white rounded-md shadow-dashboard">
                <div class="flex flex-wrap items-center justify-between mb-1 -m-2">
                    <div class="w-auto p-2">
                        <h2 class="text-lg font-semibold text-coolGray-900">Rata-rata Karyawan</h2>
                    </div>
                </div>
                <div class="flex flex-wrap">
                    @foreach($kompetenKaryawanManager as $karyawanKompeten)
                    <div class="w-full border-b border-coolGray-100">
                        <div class="flex flex-wrap items-center justify-between py-4 -m-2">
                            <div class="w-auto p-2">
                                <div class="flex flex-wrap items-center -m-2">
                                    <div class="w-auto p-2">
                                        <div class="flex items-center justify-center w-12 h-12 rounded-md">
                                            <svg width="57" height="56" viewBox="0 0 57 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="0.5" width="56" height="56" rx="28" fill="#202020" />
                                                <path d="M28.5 18C25.8766 18 23.75 20.1266 23.75 22.75C23.75 25.3734 25.8766 27.5 28.5 27.5C31.1234 27.5 33.25 25.3734 33.25 22.75C33.25 20.1266 31.1234 18 28.5 18Z" fill="#FB5151" />
                                                <path d="M25.5 29C22.8766 29 20.75 31.1266 20.75 33.75C20.75 36.3734 22.8766 38.5 25.5 38.5H31.5C34.1234 38.5 36.25 36.3734 36.25 33.75C36.25 31.1266 34.1234 29 31.5 29H25.5Z" fill="#FB5151" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="w-auto p-2">
                                        <h2 class="text-lg font-medium text-coolGray-900"> {{$karyawanKompeten->nama}} </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="w-auto p-2">
                                <p class="text-lg font-medium">{{number_format($karyawanKompeten->average,2)}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <h5 class="font-semibold mt-4 pb-6">Karyawan Inkompeten</h5>
                    @foreach($inkompetenKaryawanManager as $inkompetenKaryawan)
                    <div class="w-full border-b border-coolGray-100">
                        <div class="flex flex-wrap items-center justify-between py-4 -m-2">
                            <div class="w-auto p-2">
                                <div class="flex flex-wrap items-center -m-2">
                                    <div class="w-auto p-2">
                                        <div class="flex items-center justify-center w-12 h-12 rounded-md">
                                            <svg width="57" height="56" viewBox="0 0 57 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="0.5" width="56" height="56" rx="28" fill="#202020" />
                                                <path d="M28.5 18C25.8766 18 23.75 20.1266 23.75 22.75C23.75 25.3734 25.8766 27.5 28.5 27.5C31.1234 27.5 33.25 25.3734 33.25 22.75C33.25 20.1266 31.1234 18 28.5 18Z" fill="#FB5151" />
                                                <path d="M25.5 29C22.8766 29 20.75 31.1266 20.75 33.75C20.75 36.3734 22.8766 38.5 25.5 38.5H31.5C34.1234 38.5 36.25 36.3734 36.25 33.75C36.25 31.1266 34.1234 29 31.5 29H25.5Z" fill="#FB5151" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="w-auto p-2">
                                        <h2 class="text-lg font-medium text-coolGray-900"> {{$inkompetenKaryawan->nama}} </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="w-auto p-2">
                                <p class="text-lg text-red-600 font-medium">{{number_format($inkompetenKaryawan->average,2)}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>

        @endif


        <!-- jika jabatan adalah manager -->
        @if ($dataLogin->id_jabatan == 3)

        <div class="flex lg:gap-8 gap-2 mt-8">

            <!-- rata-rata nilai karyawan  -->
            <div class="container mx-auto">
                <div class="mx-auto p-6 pb-1 border bg-white rounded-md shadow-dashboard">
                    <div class="flex flex-wrap items-center justify-between mb-1 -m-2">
                        <div class="w-auto p-2">
                            <h2 class="text-lg font-semibold text-coolGray-900">Rata-rata Karyawan</h2>
                        </div>
                        <div class="w-auto p-2">
                            <a href="{{route('dashboard_penilai.periksa')}}" class="text-sm text-red-700 hover:text-red-600 font-semibold">See all</a>
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        @foreach($kompetenKaryawanManager as $karyawanKompeten)
                        <div class="w-full border-b border-coolGray-100">
                            <div class="flex flex-wrap items-center justify-between py-4 -m-2">
                                <div class="w-auto p-2">
                                    <div class="flex flex-wrap items-center -m-2">
                                        <div class="w-auto p-2">
                                            <div class="flex items-center justify-center w-12 h-12 rounded-md">
                                                <svg width="57" height="56" viewBox="0 0 57 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.5" width="56" height="56" rx="28" fill="#202020" />
                                                    <path d="M28.5 18C25.8766 18 23.75 20.1266 23.75 22.75C23.75 25.3734 25.8766 27.5 28.5 27.5C31.1234 27.5 33.25 25.3734 33.25 22.75C33.25 20.1266 31.1234 18 28.5 18Z" fill="#FB5151" />
                                                    <path d="M25.5 29C22.8766 29 20.75 31.1266 20.75 33.75C20.75 36.3734 22.8766 38.5 25.5 38.5H31.5C34.1234 38.5 36.25 36.3734 36.25 33.75C36.25 31.1266 34.1234 29 31.5 29H25.5Z" fill="#FB5151" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="w-auto p-2">
                                            <h2 class="text-lg font-medium text-coolGray-900"> {{$karyawanKompeten->nama}} </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-auto p-2">
                                    <p class="text-lg font-medium">{{number_format($karyawanKompeten->average,2)}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <h5 class="font-semibold mt-4 pb-6">Karyawan Inkompeten</h5>
                        @foreach($inkompetenKaryawanManager as $inkompetenKaryawan)
                        <div class="w-full border-b border-coolGray-100">
                            <div class="flex flex-wrap items-center justify-between py-4 -m-2">
                                <div class="w-auto p-2">
                                    <div class="flex flex-wrap items-center -m-2">
                                        <div class="w-auto p-2">
                                            <div class="flex items-center justify-center w-12 h-12 rounded-md">
                                                <svg width="57" height="56" viewBox="0 0 57 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.5" width="56" height="56" rx="28" fill="#202020" />
                                                    <path d="M28.5 18C25.8766 18 23.75 20.1266 23.75 22.75C23.75 25.3734 25.8766 27.5 28.5 27.5C31.1234 27.5 33.25 25.3734 33.25 22.75C33.25 20.1266 31.1234 18 28.5 18Z" fill="#FB5151" />
                                                    <path d="M25.5 29C22.8766 29 20.75 31.1266 20.75 33.75C20.75 36.3734 22.8766 38.5 25.5 38.5H31.5C34.1234 38.5 36.25 36.3734 36.25 33.75C36.25 31.1266 34.1234 29 31.5 29H25.5Z" fill="#FB5151" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="w-auto p-2">
                                            <h2 class="text-lg font-medium text-coolGray-900"> {{$inkompetenKaryawan->nama}} </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-auto p-2">
                                    <p class="text-lg text-red-600 font-medium">{{number_format($inkompetenKaryawan->average,2)}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>

            <!-- rata-rata nilai bidang  -->
            <div class="container mx-auto">
                <div class="mx-auto p-6 pb-1 border bg-white rounded-md shadow-dashboard">
                    <div class="flex flex-wrap items-center justify-between mb-1 -m-2">
                        <div class="w-auto p-2">
                            <h2 class="text-lg font-semibold text-coolGray-900">Rata-rata Bagian</h2>
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        @foreach($rataAllBidang as $rataBidang)
                        <div class="w-full border-b border-coolGray-100">
                            <div class="flex flex-wrap items-center justify-between py-4 -m-2">
                                <div class="w-auto p-2">
                                    <div class="flex flex-wrap items-center -m-2">
                                        <div class="w-auto p-2">
                                            <div class="flex items-center justify-center w-12 h-12 rounded-md">
                                                <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="56" height="56" rx="28" fill="#202020" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M19 27C19 23.2503 19 21.3754 19.9549 20.0611C20.2633 19.6366 20.6366 19.2633 21.0611 18.9549C22.3754 18 24.2503 18 28 18C31.7497 18 33.6246 18 34.9389 18.9549C35.3634 19.2633 35.7367 19.6366 36.0451 20.0611C37 21.3754 37 23.2503 37 27V29C37 29.8389 37 30.584 36.9893 31.25L36.9192 31.25C36.0672 31.2499 35.5482 31.2499 35.1005 31.3208C32.6401 31.7105 30.7105 33.6401 30.3208 36.1005C30.2499 36.5482 30.2499 37.0672 30.25 37.9192L30.25 37.9893C29.584 38 28.8389 38 28 38C24.2503 38 22.3754 38 21.0611 37.0451C20.6366 36.7367 20.2633 36.3634 19.9549 35.9389C19 34.6246 19 32.7497 19 29V27ZM24 23.25C23.5858 23.25 23.25 23.5858 23.25 24C23.25 24.4142 23.5858 24.75 24 24.75H27C27.4142 24.75 27.75 24.4142 27.75 24C27.75 23.5858 27.4142 23.25 27 23.25H24ZM24 27.25C23.5858 27.25 23.25 27.5858 23.25 28C23.25 28.4142 23.5858 28.75 24 28.75H32C32.4142 28.75 32.75 28.4142 32.75 28C32.75 27.5858 32.4142 27.25 32 27.25H24ZM24 31.25C23.5858 31.25 23.25 31.5858 23.25 32C23.25 32.4142 23.5858 32.75 24 32.75H27C27.4142 32.75 27.75 32.4142 27.75 32C27.75 31.5858 27.4142 31.25 27 31.25H24Z" fill="#FB5151" />
                                                    <path d="M35.3352 32.8023C35.6435 32.7535 36.0243 32.7501 36.9347 32.75C36.8403 34.1896 36.6094 35.1622 36.0451 35.9389C35.7367 36.3634 35.3634 36.7367 34.9389 37.0451C34.1622 37.6094 33.1896 37.8403 31.75 37.9347C31.7501 37.0243 31.7535 36.6435 31.8023 36.3352C32.0904 34.5166 33.5166 33.0904 35.3352 32.8023Z" fill="#FB5151" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="w-auto p-2">
                                            <h2 class="lg:text-xl text-base font-medium text-coolGray-900"> {{$rataBidang->nama_bidang}} </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-auto p-2">
                                    <p class="text-lg text-coolGray-500 font-medium">{{number_format($rataBidang->rata_nilai_bidang,2)}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        @endif



        <script src="{{ mix('js/app.js') }}"></script>
    </div>
</div>
@endsection
