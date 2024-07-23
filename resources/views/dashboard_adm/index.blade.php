@extends('component.sidebar')
@section('content-admin')
<div class="min-h-screen bg-[#F5F6F7]">
    <div class="p-4 xl:ml-80">
        <div class="grid grid-cols-2 md:flex md:flex-wrap mt-12 gap-3">
            <!-- card -->
            <div
                class="w-full max-w-xs p-8 bg-[#9F2D2D] border  transition relative duration-300 cursor-pointer hover:translate-y-[3px] border-none outline-none hover:shadow-[0_-8px_0px_0px_rgb(0,0,50)] rounded-2xl shadow ">
                <a href="{{ route('karyawan.index') }}">
                    <h5 class="mb-2 text-2xl font-normal tracking-tight text-white opacity-60">Penilai</h5>
                    <div class="flex justify-between items-start">
                        <p class="text-6xl mb-3 font-semibold text-white">{{ $userCount }}</p>
                        <svg width="57" height="56" viewBox="0 0 57 56" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.5" width="56" height="56" rx="28" fill="#202020" />
                            <path
                                d="M28.5 18C25.8766 18 23.75 20.1266 23.75 22.75C23.75 25.3734 25.8766 27.5 28.5 27.5C31.1234 27.5 33.25 25.3734 33.25 22.75C33.25 20.1266 31.1234 18 28.5 18Z"
                                fill="#FB5151" />
                            <path
                                d="M25.5 29C22.8766 29 20.75 31.1266 20.75 33.75C20.75 36.3734 22.8766 38.5 25.5 38.5H31.5C34.1234 38.5 36.25 36.3734 36.25 33.75C36.25 31.1266 34.1234 29 31.5 29H25.5Z"
                                fill="#FB5151" />
                        </svg>

                    </div>
                </a>

            </div>
            <div
                class="w-full max-w-xs p-8 bg-[#9F2D2D] border  transition relative duration-300 cursor-pointer hover:translate-y-[3px] border-none outline-none hover:shadow-[0_-8px_0px_0px_rgb(0,0,50)] rounded-2xl shadow ">
                <a href=" {{ route('karyawan.index') }} ">
                    <h5 class="mb-2 text-2xl font-normal tracking-tight text-white opacity-60">Karyawan</h5>
                    <div class="flex justify-between items-start">
                        <p class="text-6xl mb-3 font-semibold text-white">{{ $karyawanCount }}</p>
                        <svg width="57" height="56" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 57 56"
                            fill="#FB5151">
                            <rect x="0.5" width="56" height="56" rx="28" fill="#202020" />
                            <g transform="translate(16 15)">
                                <path fill-rule="evenodd"
                                    d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                            </g>
                        </svg>
                    </div>
                </a>

            </div>
            <div
                class=" w-full max-w-xs p-8 bg-[#9F2D2D] border  transition relative duration-300 cursor-pointer hover:translate-y-[3px] border-none outline-none hover:shadow-[0_-8px_0px_0px_rgb(0,0,50)] rounded-2xl shadow ">
                <a href="{{ route('periode.index') }} ">
                    <h5 class="mb-2 text-2xl font-normal tracking-tight text-white opacity-60">Periode</h5>
                    <div class="flex justify-between items-start">
                        <p class="text-6xl mb-3 font-semibold text-white">{{ $periodeCount }}</p>
                        <svg width="57" height="56" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 57 56"
                            fill="#FB5151">
                            <rect x="0.5" width="56" height="56" rx="28" fill="#202020" />
                            <g transform="translate(16 15)">
                                <path
                                    d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                                <path fill-rule="evenodd"
                                    d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
                                    clip-rule="evenodd" />
                            </g>
                        </svg>
                    </div>
                </a>

            </div>


            <div
                class="w-full max-w-xs p-8 bg-[#9F2D2D] border  transition relative duration-300 cursor-pointer hover:translate-y-[3px] border-none outline-none hover:shadow-[0_-8px_0px_0px_rgb(0,0,50)] rounded-2xl shadow ">
                <a href="{{ route('kompetensi.index') }} ">
                    <h5 class="mb-2 text-2xl font-normal tracking-tight text-white opacity-60">Kriteria</h5>
                    <div class="flex justify-between items-start">
                        <p class="text-6xl mb-3 font-semibold text-white">{{ $kompetensiCount }}</p>
                        <svg width="57" height="56" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 57 56"
                            fill="#FB5151">
                            <rect x="0.5" width="56" height="56" rx="28" fill="#202020" />
                            <g transform="translate(16 15)">
                                <path fill-rule="evenodd"
                                    d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z"
                                    clip-rule="evenodd" />
                                <path fill-rule="evenodd"
                                    d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375ZM6 12a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V12Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 15a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V15Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V18Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75Z"
                                    clip-rule="evenodd" />
                            </g>
                        </svg>
                    </div>
                </a>

            </div>
        </div>

        <!-- rata rata bidang dan departement -->
        <div class="flex lg:gap-8 gap-2 mt-8">

            <!-- rata-rata nilai departement  -->
            <div class="container mx-auto">
                <div class="mx-auto p-6 pb-1 border bg-white rounded-md shadow-dashboard">
                    <div class="flex flex-wrap items-center justify-between mb-1 -m-2">
                        <div class="w-auto p-2">
                            <h2 class="text-base md:text-lg font-semibold text-coolGray-900">Rata-rata Departemen</h2>
                        </div>

                    </div>
                    <div class="flex flex-wrap">
                        @foreach ($rataAllDepartement as $rataDepartement)
                            <div class="w-full border-b border-coolGray-100">
                                <div class="flex flex-wrap items-center justify-between py-4 -m-2">
                                    <div class="w-auto p-2">
                                        <div class="flex flex-wrap items-center -m-2">
                                            <div class="w-auto p-2">
                                                <div class="flex items-center justify-center w-12 h-12 rounded-md">
                                                    <svg width="56" height="56" viewBox="0 0 56 56"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="56" height="56" rx="28"
                                                            fill="#202020" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M19 27C19 23.2503 19 21.3754 19.9549 20.0611C20.2633 19.6366 20.6366 19.2633 21.0611 18.9549C22.3754 18 24.2503 18 28 18C31.7497 18 33.6246 18 34.9389 18.9549C35.3634 19.2633 35.7367 19.6366 36.0451 20.0611C37 21.3754 37 23.2503 37 27V29C37 29.8389 37 30.584 36.9893 31.25L36.9192 31.25C36.0672 31.2499 35.5482 31.2499 35.1005 31.3208C32.6401 31.7105 30.7105 33.6401 30.3208 36.1005C30.2499 36.5482 30.2499 37.0672 30.25 37.9192L30.25 37.9893C29.584 38 28.8389 38 28 38C24.2503 38 22.3754 38 21.0611 37.0451C20.6366 36.7367 20.2633 36.3634 19.9549 35.9389C19 34.6246 19 32.7497 19 29V27ZM24 23.25C23.5858 23.25 23.25 23.5858 23.25 24C23.25 24.4142 23.5858 24.75 24 24.75H27C27.4142 24.75 27.75 24.4142 27.75 24C27.75 23.5858 27.4142 23.25 27 23.25H24ZM24 27.25C23.5858 27.25 23.25 27.5858 23.25 28C23.25 28.4142 23.5858 28.75 24 28.75H32C32.4142 28.75 32.75 28.4142 32.75 28C32.75 27.5858 32.4142 27.25 32 27.25H24ZM24 31.25C23.5858 31.25 23.25 31.5858 23.25 32C23.25 32.4142 23.5858 32.75 24 32.75H27C27.4142 32.75 27.75 32.4142 27.75 32C27.75 31.5858 27.4142 31.25 27 31.25H24Z"
                                                            fill="#FB5151" />
                                                        <path
                                                            d="M35.3352 32.8023C35.6435 32.7535 36.0243 32.7501 36.9347 32.75C36.8403 34.1896 36.6094 35.1622 36.0451 35.9389C35.7367 36.3634 35.3634 36.7367 34.9389 37.0451C34.1622 37.6094 33.1896 37.8403 31.75 37.9347C31.7501 37.0243 31.7535 36.6435 31.8023 36.3352C32.0904 34.5166 33.5166 33.0904 35.3352 32.8023Z"
                                                            fill="#FB5151" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="w-auto p-2">
                                                <h2 class="text-base font-medium text-coolGray-900">
                                                    {{ $rataDepartement->nama_departement }} </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-auto p-2">
                                        <p class="text-base md:text-lg text-coolGray-500 font-medium">
                                            {{ number_format($rataDepartement->rata_nilai_departement, 2) }}</p>
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
                            <h2 class="text-base md:text-lg font-semibold text-coolGray-900">Rata-rata Bidang</h2>
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        @foreach ($rataAllBidang as $rataBidang)
                            <div class="w-full border-b border-coolGray-100">
                                <div class="flex flex-wrap items-center justify-between py-4 -m-2">
                                    <div class="w-auto p-2">
                                        <div class="flex flex-wrap items-center -m-2">
                                            <div class="w-auto p-2">
                                                <div class="flex items-center justify-center w-12 h-12 rounded-md">
                                                    <svg width="56" height="56" viewBox="0 0 56 56"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="56" height="56" rx="28"
                                                            fill="#202020" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M19 27C19 23.2503 19 21.3754 19.9549 20.0611C20.2633 19.6366 20.6366 19.2633 21.0611 18.9549C22.3754 18 24.2503 18 28 18C31.7497 18 33.6246 18 34.9389 18.9549C35.3634 19.2633 35.7367 19.6366 36.0451 20.0611C37 21.3754 37 23.2503 37 27V29C37 29.8389 37 30.584 36.9893 31.25L36.9192 31.25C36.0672 31.2499 35.5482 31.2499 35.1005 31.3208C32.6401 31.7105 30.7105 33.6401 30.3208 36.1005C30.2499 36.5482 30.2499 37.0672 30.25 37.9192L30.25 37.9893C29.584 38 28.8389 38 28 38C24.2503 38 22.3754 38 21.0611 37.0451C20.6366 36.7367 20.2633 36.3634 19.9549 35.9389C19 34.6246 19 32.7497 19 29V27ZM24 23.25C23.5858 23.25 23.25 23.5858 23.25 24C23.25 24.4142 23.5858 24.75 24 24.75H27C27.4142 24.75 27.75 24.4142 27.75 24C27.75 23.5858 27.4142 23.25 27 23.25H24ZM24 27.25C23.5858 27.25 23.25 27.5858 23.25 28C23.25 28.4142 23.5858 28.75 24 28.75H32C32.4142 28.75 32.75 28.4142 32.75 28C32.75 27.5858 32.4142 27.25 32 27.25H24ZM24 31.25C23.5858 31.25 23.25 31.5858 23.25 32C23.25 32.4142 23.5858 32.75 24 32.75H27C27.4142 32.75 27.75 32.4142 27.75 32C27.75 31.5858 27.4142 31.25 27 31.25H24Z"
                                                            fill="#FB5151" />
                                                        <path
                                                            d="M35.3352 32.8023C35.6435 32.7535 36.0243 32.7501 36.9347 32.75C36.8403 34.1896 36.6094 35.1622 36.0451 35.9389C35.7367 36.3634 35.3634 36.7367 34.9389 37.0451C34.1622 37.6094 33.1896 37.8403 31.75 37.9347C31.7501 37.0243 31.7535 36.6435 31.8023 36.3352C32.0904 34.5166 33.5166 33.0904 35.3352 32.8023Z"
                                                            fill="#FB5151" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="w-auto p-2">
                                                <h2 class="text-xl font-medium text-coolGray-900">
                                                    {{ $rataBidang->nama_bidang }} </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-auto p-2">
                                        <p class="text-base md:text-lg text-coolGray-500 font-medium">
                                            {{ number_format($rataBidang->rata_nilai_bidang, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>

    </div>


</div>
@endsection
