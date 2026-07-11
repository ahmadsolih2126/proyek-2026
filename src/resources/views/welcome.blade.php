<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Alat Olahraga Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }

        /* Custom Scrollbar Tipis & Smooth Nyatu Sama Tema */
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cbd5e1; /* Warna slate-300 di light mode */
            border-radius: 20px;
        }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #334155; /* Warna slate-700 di dark mode */
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #94a3b8;
        }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #475569;
        }

        /* FIX DARK MODE UNTUK INPUT FORM */
        .dark input, .dark select, .dark textarea {
            background-color: #1e293b !important; /* Slate-800 / Navy Gelap */
            color: #f8fafc !important;            /* Slate-50 / Putih Terang */
            border-color: #334155 !important;      /* Slate-700 */
        }
        .dark input::placeholder, .dark textarea::placeholder {
            color: #64748b !important;            /* Slate-500 / Abu-abu Kalem */
        }
        /* Mengatur warna isi dropdown option di dark mode */
        .dark select option {
            background-color: #1e293b !important;
            color: #f8fafc !important;
        }
    </style>
</head>
<body x-data="{ searchKeyword: '' }" class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 antialiased min-h-screen transition-colors duration-300">

    <div class="fixed top-6 right-6 z-50 space-y-3 max-w-sm w-full pointer-events-none">
        
        @if(session('success'))
        <div x-data="{ show: true, progress: 100 }" 
             x-show="show" 
             x-init="
                let interval = setInterval(() => { 
                    progress -= 2.5; 
                    if(progress <= 0) { 
                        clearInterval(interval); 
                        show = false; 
                    } 
                }, 100);
             "
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-[-20px] sm:translate-y-0 sm:translate-x-4"
             x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-4"
             class="pointer-events-auto bg-white dark:bg-slate-900 border border-emerald-100 dark:border-emerald-900/60 rounded-2xl shadow-xl shadow-slate-950/10 overflow-hidden relative p-4 flex items-start gap-3.5">
            
            <div class="flex items-center justify-center w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-900/30 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-[10px] font-black tracking-widest text-emerald-600 dark:text-emerald-400 uppercase">BERHASIL</p>
                <p class="text-xs font-bold text-slate-700 dark:text-slate-300 mt-0.5 leading-relaxed">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 font-bold text-xs p-1">✕</button>
            
            <div class="absolute bottom-0 left-0 h-1 bg-emerald-500 transition-all duration-100 ease-linear" :style="`width: ${progress}%`"></div>
        </div>
        @endif

        @if(session('transaksi_error'))
        <div x-data="{ show: true, progress: 100 }" 
             x-show="show" 
             x-init="
                let interval = setInterval(() => { 
                    progress -= 2.5; 
                    if(progress <= 0) { 
                        clearInterval(interval); 
                        show = false; 
                    } 
                }, 100);
             "
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-[-20px] sm:translate-y-0 sm:translate-x-4"
             x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-4"
             class="pointer-events-auto bg-white dark:bg-slate-900 border border-rose-100 dark:border-rose-900/60 rounded-2xl shadow-xl shadow-slate-950/10 overflow-hidden relative p-4 flex items-start gap-3.5">
            
            <div class="flex items-center justify-center w-8 h-8 rounded-xl bg-rose-50 dark:bg-rose-950/50 text-rose-600 dark:text-rose-400 border border-rose-100 dark:border-rose-900/30 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-[10px] font-black tracking-widest text-rose-600 dark:text-rose-400 uppercase">TRANSAKSI GAGAL</p>
                <p class="text-xs font-bold text-slate-700 dark:text-slate-300 mt-0.5 leading-relaxed">{{ session('transaksi_error') }}</p>
            </div>
            <button @click="show = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 font-bold text-xs p-1">✕</button>
            
            <div class="absolute bottom-0 left-0 h-1 bg-rose-500 transition-all duration-100 ease-linear" :style="`width: ${progress}%`"></div>
        </div>
        @endif

    </div>

    <nav class="bg-white/75 dark:bg-slate-900/75 backdrop-blur-md border-b border-slate-100 dark:border-slate-800 sticky top-0 z-40 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                
                <div class="flex items-center gap-3.5 group">
                    <div class="flex items-center justify-center w-11 h-11 rounded-2xl bg-gradient-to-br from-slate-900 to-slate-800 dark:from-slate-800 dark:to-slate-700 shadow-lg shadow-slate-900/10 border border-slate-700/55 transform group-hover:scale-105 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2.5" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 5 H8 L5 8 V11 L8 14 H16 L19 17 V20 L16 23 H6" />
                        </svg>
                    </div>
                    <div class="space-y-0.5">
                        <h1 class="text-lg font-black tracking-tight bg-gradient-to-r from-slate-900 via-blue-950 to-slate-900 dark:from-white dark:via-blue-400 dark:to-white bg-clip-text text-transparent uppercase">
                            SPORTS<span class="text-blue-600">.</span>STOK
                        </h1>
                        <p class="text-[10px] text-slate-400 dark:text-slate-500 font-bold tracking-widest uppercase flex items-center gap-1.5">
                            <span class="w-1 h-1 rounded-full bg-blue-500"></span> Inventory Management System
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button onclick="toggleDarkMode()" class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 border border-slate-200/60 dark:border-slate-700 transition-all duration-200 hover:scale-105" title="Ubah Tema">
                        <span id="dark-icon" class="hidden text-sm">☀️</span>
                        <span id="light-icon" class="text-sm">🌙</span>
                    </button>

                    @if($is_logged_in)
                        <div class="hidden sm:inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-[11px] font-bold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-400 border border-emerald-100/80 dark:border-emerald-900/60 shadow-sm shadow-emerald-500/5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 relative flex">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span> 
                            Mode Admin
                        </div>
                        <form action="/logout-proses" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2.5 text-xs font-bold text-slate-500 dark:text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/30 rounded-xl transition-all duration-200 border border-transparent hover:border-rose-100 dark:hover:border-rose-900/50 hover:scale-[1.02]">
                                Keluar Akun
                            </button>
                        </form>
                    @else
                        <button onclick="openModal('modalLogin')" class="px-5 py-2.5 text-xs font-bold text-white bg-gradient-to-r from-slate-900 to-blue-950 hover:from-blue-950 hover:to-slate-900 dark:from-slate-800 dark:to-slate-900 dark:hover:from-slate-700 dark:hover:to-slate-800 rounded-xl transition-all duration-300 shadow-md shadow-slate-950/10 hover:shadow-lg border border-slate-800 dark:border-slate-700 transform hover:-translate-y-0.5">
                            Masuk Admin
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="w-full bg-[#111632] dark:bg-[#0b0e22] rounded-[32px] p-8 md:p-10 shadow-xl shadow-slate-950/10 mb-10 relative overflow-hidden border border-slate-800 transition-all duration-300">
            <div class="absolute right-0 top-0 w-80 h-full bg-gradient-to-l from-blue-600/10 via-transparent to-transparent pointer-events-none z-0"></div>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center relative z-10">
                <div class="md:col-span-8 flex flex-col justify-between min-h-[160px]">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight leading-tight uppercase">
                            Sistem Manajemen Terpadu & Mutasi Alat Olahraga Sekolah
                        </h2>
                        <p class="text-xs md:text-sm text-slate-400 font-medium mt-3 leading-relaxed">
                            Sistem pencatatan otomatis untuk monitoring sirkulasi alat olahraga, pembaruan stok berkala, dan otomatisasi cetak berkas laporan fisik sekolah.
                        </p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3 mt-6 pt-2">
                        @if($is_logged_in)
                            <button onclick="openTransaksiModal('masuk')" class="inline-flex items-center gap-2 px-5 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-bold text-xs transition duration-300 transform hover:-translate-y-0.5 hover:shadow-lg hover:shadow-emerald-500/20">
                                <span class="text-xs font-extrabold uppercase">+ Tambah Judul Alat Baru</span>
                            </button>
                        @endif
                        
                        <button onclick="openModal('modalDonasiAlumni')" class="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white rounded-xl font-bold text-xs transition duration-300 transform hover:-translate-y-0.5 hover:shadow-lg shadow-orange-500/10">
                            <span class="text-xs font-extrabold uppercase">Donasi Alat (Alumni)</span>
                        </button>

                        <a href="/cetak-laporan" target="_blank" class="inline-flex items-center gap-2 px-5 py-3 bg-slate-800/60 hover:bg-slate-800 border border-slate-700/80 text-white rounded-xl font-bold text-xs transition duration-300 transform hover:-translate-y-0.5 hover:shadow-lg">
                            Cetak Laporan PDF
                        </a>
                    </div>
                </div>
                <div class="md:col-span-4 flex justify-center md:justify-end items-center mt-6 md:mt-0 opacity-25 dark:opacity-20 hover:opacity-40 transition-opacity duration-500 select-none pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" class="w-48 h-48 stroke-blue-400 fill-none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="60" cy="60" r="22" /><path d="M44 60h32 M60 44v32 M48 48l24 24 M48 72l24-24" />
                        <circle cx="140" cy="60" r="14" /><path d="M140 74v35 M135 109h10" /><path d="M130 52l20 16 M130 68l20-16" /><path d="M158 46l10-10 M165 43l5 5" />
                        <rect x="35" y="125" width="50" height="35" rx="4" /><path d="M35 135h50 M35 145h50 M47 125v35 M60 125v35 M72 125v35" />
                        <path d="M130 130h30 M145 130v25 M135 155h20" /><path d="M132 115c-8 0-12-4-12-10s4-10 12-10h26c8 0 12 4 12 10s-4 10-12 10h-26z" /><path d="M120 100c-4 0-6 2-6 5s2 5 6 5 M168 100c4 0 6 2 6 5s-2 5-6 5" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-4 transition-all duration-300 hover:shadow-md">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-950/50 flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold border border-blue-100 dark:border-blue-900/50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Total Judul Alat</p>
                    <h4 class="text-xl font-black text-slate-900 dark:text-slate-100 mt-0.5">{{ $semua_alat->count() }} <span class="text-xs text-slate-400 font-semibold uppercase">Jenis</span></h4>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-4 transition-all duration-300 hover:shadow-md">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 flex items-center justify-center text-emerald-600 dark:text-emerald-400 font-bold border border-emerald-100 dark:border-emerald-900/50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Akumulasi Total Stok Fisik</p>
                    <h4 class="text-xl font-black text-slate-900 dark:text-slate-100 mt-0.5">{{ $semua_alat->sum('jumlah') }} <span class="text-xs text-slate-400 font-semibold uppercase">Unit Pcs</span></h4>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-4 transition-all duration-300 hover:shadow-md">
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold border border-indigo-100 dark:border-indigo-900/50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Peminjaman Aktif</p>
                    <h4 class="text-xl font-black text-indigo-600 dark:text-indigo-400 mt-0.5">{{ $semua_pinjam->count() }} <span class="text-xs text-slate-400 font-semibold uppercase">Siswa</span></h4>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 shadow-md rounded-[28px] p-5 mb-8 flex flex-col md:flex-row gap-4 items-center justify-between transition-colors">
            <div class="relative w-full md:flex-1 flex items-center">
                <span class="absolute left-4 text-slate-400 dark:text-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.604 10.604z" />
                    </svg>
                </span>
                <input x-model="searchKeyword" 
                       type="text" 
                       placeholder="Cari nama alat olahraga secara instan disini..." 
                       class="w-full pl-11 pr-4 py-3 bg-slate-50 dark:bg-slate-950/50 border border-slate-200/80 dark:border-slate-800 rounded-2xl text-xs font-semibold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                <button x-show="searchKeyword.length > 0" @click="searchKeyword = ''" class="absolute right-4 text-slate-400 hover:text-slate-600 text-xs font-bold" x-cloak>✕</button>
            </div>

            <div class="flex items-center gap-2 w-full md:w-auto justify-start md:justify-end flex-shrink-0">
                <span class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider">Status:</span>
                
                <div x-show="searchKeyword === ''" class="px-4 py-2 rounded-xl text-[11px] font-bold bg-blue-600 text-white border border-blue-600 shadow-sm flex items-center gap-1.5 transition-all">
                    Semua Alat
                </div>

                <button x-show="searchKeyword !== ''" @click="searchKeyword = ''" class="px-4 py-2 rounded-xl text-[11px] font-bold bg-amber-500 hover:bg-amber-600 text-white shadow-sm flex items-center gap-1.5 transition-all" x-cloak>
                    Terfilter (Klik Reset)
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <div class="lg:col-span-2 space-y-4">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-xs font-extrabold text-slate-900 dark:text-slate-200 uppercase tracking-widest flex items-center gap-1.5">DAFTAR ALAT OLAHRAGA SEKOLAH</h3>
                    <span class="text-[10px] bg-slate-100 dark:bg-slate-800 px-2.5 py-1 rounded-full font-bold text-slate-500 dark:text-slate-400 uppercase">{{ $semua_alat->count() }} Terdaftar</span>
                </div>

                @if($semua_alat->isEmpty())
                    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 p-12 text-center shadow-sm">
                        <p class="text-xs font-bold text-slate-400 uppercase">Belum ada alat olahraga yang terdaftar.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($semua_alat as $alat)
                            
                            <div x-show="'{{ Str::lower($alat->nama_alat) }}'.includes(searchKeyword.toLowerCase())"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-200"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="bg-white dark:bg-slate-900 rounded-[24px] border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-lg transition-all duration-300 ease-in-out flex flex-col justify-between group relative overflow-hidden transform hover:-translate-y-0.5">
                                
                                <div class="px-5 py-4 flex justify-between items-center bg-slate-50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-800">
                                    <div class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                                        <span class="text-[10px] font-extrabold tracking-wider text-slate-400 dark:text-slate-500 uppercase">KATALOG ALAT</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        @if($is_logged_in)
                                            <button onclick="openEditModal(this)" data-id="{{ $alat->id }}" data-nama="{{ $alat->nama_alat }}" data-kategori="{{ $alat->kategori }}" data-harga="{{ $alat->harga }}" class="p-1.5 text-xs text-slate-400 dark:text-slate-500 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-white dark:hover:bg-slate-800 rounded-lg shadow-sm transition-all hover:scale-110" title="Edit">Ubah</button>
                                            <form action="/alat-hapus/{{ $alat->id }}" method="POST" onsubmit="return confirm('Hapus data ini bray?')" class="inline">
                                                @csrf
                                                <button type="submit" class="p-1.5 text-xs text-slate-400 dark:text-slate-500 hover:text-red-600 dark:hover:text-rose-400 hover:bg-white dark:hover:bg-slate-800 rounded-lg shadow-sm transition-all hover:scale-110" title="Hapus">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>

                                <div class="p-5 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3 class="text-base font-black text-blue-900 dark:text-blue-400 group-hover:text-blue-600 dark:group-hover:text-blue-300 transition-colors uppercase tracking-tight leading-snug">
                                            {{ $alat->nama_alat }}
                                        </h3>
                                        
                                        <div class="mt-4 grid grid-cols-2 gap-3">
                                            <div class="p-3 rounded-xl border flex flex-col justify-between transition-all duration-300
                                                @if($alat->jumlah == 0) 
                                                    bg-rose-50/80 dark:bg-rose-950/20 border-rose-100 dark:border-rose-900/40 animate-pulse
                                                @elseif($alat->jumlah <= 5) 
                                                    bg-amber-50/80 dark:bg-amber-950/20 border-amber-100 dark:border-amber-900/40
                                                @else 
                                                    bg-emerald-50/80 dark:bg-emerald-950/20 border-emerald-100 dark:border-emerald-900/40
                                                @endif">
                                                <p class="text-[9px] font-bold uppercase tracking-wider
                                                    @if($alat->jumlah == 0) text-rose-500 dark:text-rose-400
                                                    @elseif($alat->jumlah <= 5) text-amber-600 dark:text-amber-400
                                                    @else text-emerald-600 dark:text-emerald-400 @endif">
                                                    Status Stok
                                                </p>
                                                <p class="text-base font-black mt-0.5 
                                                    @if($alat->jumlah == 0) text-rose-700 dark:text-rose-300
                                                    @elseif($alat->jumlah <= 5) text-amber-700 dark:text-amber-300
                                                    @else text-emerald-700 dark:text-emerald-300 @endif">
                                                    {{ $alat->jumlah }} 
                                                    <span class="text-[10px] font-bold uppercase">
                                                        @if($alat->jumlah == 0) HABIS @elseif($alat->jumlah <= 5) KRITIS @else Pcs @endif
                                                    </span>
                                                </p>
                                            </div>

                                            <div class="bg-slate-50/70 dark:bg-slate-900/40 p-3 rounded-xl border border-slate-100/50 dark:border-slate-800/60">
                                                <p class="text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Harga Satuan</p>
                                                <p class="text-sm font-extrabold text-slate-700 dark:text-slate-300 mt-1">Rp {{ number_format($alat->harga, 0, ',', '.') }}</p>
                                            </div>
                                        </div>

                                        <div class="mt-4 pt-1 flex items-center gap-1.5 flex-wrap">
                                            <p class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-wider">Kategori:</p>
                                            @if($alat->kategori)
                                                @if(Str::contains(Str::lower($alat->kategori), ['bola', 'futsal', 'sepak']))
                                                    <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 border border-blue-100 dark:border-blue-900/30 uppercase tracking-wide">{{ $alat->kategori }}</span>
                                                @elseif(Str::contains(Str::lower($alat->kategori), ['atletik', 'lari', 'lompat']))
                                                    <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-amber-50 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400 border border-amber-100 dark:border-amber-900/30 uppercase tracking-wide">{{ $alat->kategori }}</span>
                                                @elseif(Str::contains(Str::lower($alat->kategori), ['senam', 'fitness', 'gym']))
                                                    <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-purple-50 dark:bg-purple-950/50 text-purple-600 dark:text-purple-400 border border-purple-100 dark:border-purple-900/30 uppercase tracking-wide">{{ $alat->kategori }}</span>
                                                @else
                                                    <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-700/60 uppercase tracking-wide">{{ $alat->kategori }}</span>
                                                @endif
                                            @else
                                                <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 border border-transparent uppercase tracking-wide">TANPA MEREK</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-5">
                                        @if($is_logged_in)
                                            <div class="grid grid-cols-3 gap-1.5 border-t border-slate-100 dark:border-slate-800 pt-4">
                                                <button onclick="openTransaksiModal('masuk', {{ $alat->id }}, '{{ $alat->nama_alat }}')" class="py-2 bg-emerald-50 dark:bg-emerald-950/20 hover:bg-emerald-600 dark:hover:bg-emerald-600 text-emerald-700 dark:text-emerald-400 hover:text-white rounded-xl font-bold text-[10px] uppercase transition-all tracking-wider text-center border border-emerald-100 dark:border-emerald-900/40 shadow-sm transform hover:-translate-y-0.5 hover:shadow">Masuk</button>
                                                <button onclick="openTransaksiModal('keluar', {{ $alat->id }}, '{{ $alat->nama_alat }}')" class="py-2 bg-rose-50 dark:bg-rose-950/20 hover:bg-rose-600 dark:hover:bg-rose-600 text-rose-700 dark:text-rose-400 hover:text-white rounded-xl font-bold text-[10px] uppercase transition-all tracking-wider text-center border border-rose-100 dark:border-rose-900/40 shadow-sm transform hover:-translate-y-0.5 hover:shadow">Keluar</button>
                                                <button onclick="openTransaksiModal('pinjam', {{ $alat->id }}, '{{ $alat->nama_alat }}')" class="py-2 bg-indigo-50 dark:bg-indigo-950/20 hover:bg-indigo-600 dark:hover:bg-indigo-600 text-indigo-700 dark:text-indigo-400 hover:text-white rounded-xl font-bold text-[10px] uppercase transition-all tracking-wider text-center border border-indigo-100 dark:border-indigo-900/40 shadow-sm transform hover:-translate-y-0.5 hover:shadow">Pinjam</button>
                                            </div>
                                        @endif
                                        <div class="mt-3.5 text-center">
                                            <a href="/alat-detail/{{ $alat->id }}" class="text-[10px] font-bold text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors hover:underline flex items-center justify-center gap-1">
                                                LIHAT DATA DETAIL & RIWAYAT LOG
                                            </a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        @endforeach

                        <div x-show="searchKeyword !== '' && !Array.from($el.parentNode.querySelectorAll('[x-show*=\'includes\']')).some(el => el.style.display !== 'none')" 
                             class="bg-white dark:bg-slate-900 rounded-3xl border border-dashed border-slate-200 dark:border-slate-800 p-12 text-center shadow-sm w-full col-span-full" x-cloak>
                            <p class="text-xs font-bold text-slate-400 uppercase mt-2">Alat olahraga "<span x-text="searchKeyword" class="text-blue-500"></span>" tidak ditemukan bray.</p>
                            <button @click="searchKeyword = ''" class="mt-3 px-3 py-1.5 bg-slate-100 dark:bg-slate-800 hover:bg-blue-600 hover:text-white rounded-xl text-[10px] font-bold uppercase transition-all">
                                Reset Pencarian
                            </button>
                        </div>

                    </div>
                @endif
            </div>

            <div class="space-y-6">
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-xs font-extrabold text-slate-900 dark:text-slate-200 uppercase tracking-widest flex items-center gap-1.5">Peminjaman Aktif</h3>
                        <span class="text-[10px] bg-indigo-50 dark:bg-indigo-950/40 px-2.5 py-1 rounded-full font-bold text-indigo-600 dark:text-indigo-400 uppercase">{{ $semua_pinjam->count() }} Siswa</span>
                    </div>

                    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 p-4 shadow-sm space-y-3 max-h-[380px] overflow-y-auto custom-scrollbar">
                        @if($semua_pinjam->isEmpty())
                            <p class="text-xs font-bold text-slate-400 p-4 text-center uppercase">Belum Ada Peminjaman.</p>
                        @else
                            @foreach($semua_pinjam as $pinjam)
                                <div class="p-3 bg-slate-50 dark:bg-slate-950/40 border border-slate-100 dark:border-slate-800 rounded-2xl flex flex-col justify-between gap-2 transition-all hover:shadow-sm">
                                    <div>
                                        <div class="flex justify-between items-start">
                                            <h4 class="text-xs font-black text-slate-900 dark:text-slate-200 uppercase tracking-tight">{{ $pinjam->nama_alat }}</h4>
                                            <span class="px-2 py-0.5 bg-indigo-100 dark:bg-indigo-950 text-indigo-800 dark:text-indigo-300 rounded font-black text-[9px]">{{ $pinjam->jumlah }} PCS</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 dark:text-slate-400 font-bold mt-1">Peminjam: <span class="text-blue-600 dark:text-blue-400 uppercase font-black">{{ $pinjam->nama_peminjam }}</span></p>
                                        <p class="text-[9px] text-slate-400 dark:text-slate-500 font-semibold mt-0.5">{{ \Carbon\Carbon::parse($pinjam->created_at)->diffForHumans() }}</p>
                                    </div>
                                    @if($is_logged_in)
                                        <form action="/peminjaman-kembali/{{ $pinjam->id }}" method="POST" class="w-full">
                                            @csrf
                                            <button type="submit" class="w-full py-1.5 bg-white dark:bg-slate-800 hover:bg-slate-900 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 hover:text-white rounded-xl text-[10px] font-bold uppercase transition-all border border-slate-200/20 dark:border-slate-700 shadow-sm transform hover:scale-[1.01]">
                                                Kembalikan Alat
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-xs font-extrabold text-slate-900 dark:text-slate-200 uppercase tracking-widest flex items-center gap-1.5">Live Log Aktivitas</h3>
                    </div>
                    
                    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 p-4 shadow-sm space-y-3 max-h-[400px] overflow-y-auto custom-scrollbar">
                        @if($semua_log->isEmpty())
                            <p class="text-xs font-bold text-slate-400 p-4 text-center uppercase">Belum ada aktivitas log.</p>
                        @else
                            @foreach($semua_log as $log)
                                <div class="p-3 border-b border-slate-50 dark:border-slate-800 last:border-0 flex gap-3 items-start transition-all hover:bg-slate-50/50 dark:hover:bg-slate-800/30 rounded-xl">
                                    <div class="text-xs font-bold text-slate-400">
                                        @if($log->jenis_transaksi === 'masuk') In @else Out @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex justify-between items-start">
                                            <p class="text-xs font-black text-slate-900 dark:text-slate-200 truncate uppercase tracking-tight">{{ $log->nama_alat ?? 'Alat Terhapus' }}</p>
                                            <span class="text-[10px] font-black {{ $log->jenis_transaksi === 'masuk' ? 'text-emerald-600' : 'text-rose-600' }} uppercase ml-2">
                                                {{ $log->jenis_transaksi === 'masuk' ? '+' : '-' }}{{ $log->jumlah }}
                                            </span>
                                        </div>
                                        <p class="text-[10px] text-slate-400 dark:text-slate-500 font-medium mt-0.5 uppercase tracking-wide">📍 {{ $log->asal_atau_tujuan ?? '-' }}</p>
                                        <p class="text-[10px] text-slate-400 dark:text-slate-400 font-semibold bg-slate-50 dark:bg-slate-950/40 p-1.5 rounded-lg border border-slate-100 dark:border-slate-800 mt-1 italic">"{{ $log->keterangan ?? '-' }}"</p>
                                        
                                        <p class="text-[8px] text-slate-400 dark:text-slate-500 font-semibold mt-1 flex items-center gap-1">
                                            <span>Waktu:</span> {{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 max-w-3xl mx-auto bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 shadow-sm rounded-[24px] p-6">
            <h3 class="text-xs font-extrabold text-slate-900 dark:text-slate-200 uppercase tracking-widest flex items-center gap-2 mb-1">
                LAPORAN KENDALA ALAT
            </h3>
            <p class="text-[11px] text-slate-400 dark:text-slate-500 font-medium mb-4">Laporkan Masalah Tentang Alat Disini !</p>
            
            <form action="/laporkan-kendala" method="POST" class="space-y-3.5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Nama Anda</label>
                        <input type="text" name="nama_pelapor" required placeholder="Masukkan nama" class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-semibold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Judul Masalah</label>
                        <input type="text" name="judul_kendala" required placeholder="Contoh: Kekurangan Alat ( Sepak bola )" class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-semibold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">No. WhatsApp Tujuan</label>
                        <input type="tel" name="nomor_whatsapp" required placeholder="Contoh: 081234567xxx" class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-semibold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Jelaskan detailnya disni ...</label>
                    <textarea name="deskripsi_kendala" required rows="3" placeholder="Jelaskan disni ..." class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-semibold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                
                <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold uppercase tracking-wider shadow-md shadow-emerald-600/10 transition-all flex items-center justify-center gap-2 transform hover:-translate-y-0.5">
                    KIRIM LAPORAN VIA WHATSAPP
                </button>
            </form>
        </div>

    </main>

    <div id="modalLogin" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm p-4 flex items-center justify-center">
        <div class="bg-white dark:bg-slate-900 rounded-3xl w-full max-w-sm p-6 shadow-2xl border border-slate-100 dark:border-slate-800">
            <div class="text-center mb-5">
                <h3 class="text-sm font-extrabold text-slate-900 dark:text-slate-200 uppercase tracking-widest mt-2">Akses Kunci Admin</h3>
                <p class="text-[10px] text-slate-400 font-medium mt-1">Silakan masukkan akun admin Anda bray</p>
            </div>
            
            <form action="/login-proses" method="POST" class="space-y-4" x-data="{ showPass: false }">
                @csrf
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Akses Email</label>
                    <input type="email" name="email" required autofocus placeholder="admin@sports.stok" class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-semibold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Password</label>
                    <div class="relative flex items-center">
                        <input :type="showPass ? 'text' : 'password'" 
                               name="password" 
                               required 
                               placeholder="••••••••" 
                               class="w-full p-3 pr-10 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-semibold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        
                        <button type="button" @click="showPass = !showPass" class="absolute right-3 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors focus:outline-none p-1">
                            <svg x-show="!showPass" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <circle cx="12" cy="12" r="3" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <svg x-show="showPass" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4" x-cloak>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 1-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="pt-2 space-y-2">
                    <button type="submit" class="w-full py-3 bg-slate-900 dark:bg-slate-800 hover:bg-slate-800 dark:hover:bg-slate-700 text-white rounded-xl font-bold text-xs shadow-md uppercase tracking-wider transition-all transform hover:-translate-y-0.5">
                        Masuk Sistem
                    </button>
                    <button type="button" onclick="closeModal('modalLogin')" class="w-full text-center text-[10px] font-bold text-slate-400 uppercase tracking-wider py-1 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalDonasiAlumni" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/60 backdrop-blur-sm p-4 items-center justify-center">
        <div class="bg-white dark:bg-slate-900 rounded-3xl w-full max-w-md p-6 shadow-2xl relative border border-slate-100 dark:border-slate-800 max-h-[90vh] overflow-y-auto custom-scrollbar">
            <button type="button" onclick="closeModal('modalDonasiAlumni')" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 font-bold text-sm p-1">✕</button>
            <div class="text-center mb-5 border-b border-slate-100 dark:border-slate-800 pb-3">
                <h3 class="text-base font-extrabold text-slate-900 dark:text-slate-200 uppercase tracking-widest mt-2">Formulir Donasi/Inventaris Alumni</h3>
                <p class="text-[10px] text-slate-400 font-medium mt-1">Sumbangkan alat olahraga demi mendukung kegiatan fisik adik kelas ...</p>
            </div>
            
            <form action="/donasi-proses" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Nama Lengkap</label>
                        <input type="text" name="nama_alumni" required placeholder="Nama anda" class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-semibold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Angkatan Tahun</label>
                        <input type="number" name="angkatan" required placeholder="Contoh: 2024" class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-bold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Nomor WhatsApp / Kontak</label>
                    <input type="tel" name="kontak_alumni" required placeholder="Contoh: 0812xxxxxxxx" class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-semibold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <div class="border-t border-dashed border-slate-200 dark:border-slate-800 pt-3">
                    <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Nama Alat Yang Disumbangkan</label>
                    <input type="text" name="nama_alat" required placeholder="Contoh: Bola Basket Spalding Original" class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-bold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 uppercase">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Jumlah Qty (Unit)</label>
                        <input type="number" name="jumlah" required min="1" placeholder="Jumlah Pcs" class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-bold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Kondisi Fisik Alat</label>
                        <input type="text" name="conditions" required placeholder="Contoh: Baru / Layak Pakai" class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-bold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Pesan / Catatan Tambahan (Opsional)</label>
                    <textarea name="keterangan_alumni" rows="2" placeholder="Tuliskan pesan..." class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-semibold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500"></textarea>
                </div>

                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white rounded-xl font-bold text-xs tracking-wide shadow-md uppercase transition transform hover:-translate-y-0.5">
                    Kirim Pengajuan Donasi
                </button>
            </form>
        </div>
    </div>

    <div id="modalTransaksi" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/60 backdrop-blur-sm p-4 items-center justify-center">
        <div class="bg-white dark:bg-slate-900 rounded-3xl w-full max-w-md p-6 shadow-2xl relative border border-slate-100 dark:border-slate-800">
            <button type="button" onclick="closeModal('modalTransaksi')" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 font-bold text-sm p-1">✕</button>
            <h3 id="modalTransaksiTitle" class="text-base font-extrabold text-slate-900 dark:text-slate-200 flex items-center gap-2 border-b border-slate-100 dark:border-slate-800 pb-3 mb-4 uppercase"></h3>
            
            <form action="/transaksi-proses" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="jenis_transaksi" id="input_jenis_transaksi">

                <div id="wrapper_pilihan_alat">
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Pilih Opsi Input Data</label>
                    <select name="pilihan_alat" id="pilihan_alat" onchange="toggleFormAlatBaru()" class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl font-bold text-xs text-slate-700 dark:text-slate-300 uppercase focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="lama" selected>-- Gunakan Alat yang Sudah Terdaftar --</option>
                        <option value="baru" id="opsi_alat_baru">+ Input Bikin Judul Alat Baru</option>
                    </select>
                </div>

                <div id="form_alat_lama">
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Daftar Judul Alat</label>
                    <select name="alat_olahraga_id" id="select_alat_olahraga_id" class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl font-bold text-xs text-slate-700 dark:text-slate-300 uppercase focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($semua_alat as $a)
                            <option value="{{ $a->id }}">{{ $a->nama_alat }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="form_alat_baru" class="hidden space-y-3 bg-slate-50 dark:bg-slate-950/40 p-4 rounded-2xl border border-slate-100 dark:border-slate-800">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Nama Alat Baru</label>
                        <input type="text" name="nama_alat" placeholder="Contoh: Baju Jersey Specs" class="w-full p-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-semibold text-slate-800 dark:text-slate-200">
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Kategori / Merek</label>
                            <input type="text" name="kategori" placeholder="Contoh: Nike & Mils" class="w-full p-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-semibold text-slate-800 dark:text-slate-200">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Estimasi Harga Unit</label>
                            <input type="text" name="harga" placeholder="Contoh: 120000" class="w-full p-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-semibold text-slate-800 dark:text-slate-200">
                        </div>
                    </div>
                </div>

                <div id="wrapper_varian_transaksi" class="mb-4">
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Merek / Spesifikasi Varian Yang Dipilih</label>
                    <input type="text" name="varian_nama_manual" id="varian_nama_manual" placeholder="Tulis merek / spesifikasi varian disini ..." class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-bold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 uppercase">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Jumlah Unit Qty</label>
                        <input type="number" name="jumlah" id="input_jumlah_qty" required min="1" placeholder="Jumlah" class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-bold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label id="label_asal_tujuan" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Asal / Tujuan Alokasi</label>
                        <input type="text" name="asal_atau_tujuan" id="input_asal_tujuan" class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-semibold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Keterangan Tambahan Instansi (Opsional)</label>
                    <textarea name="keterangan" id="input_keterangan" rows="2" placeholder="Tulis catatan disini..." class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-semibold text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <button type="submit" class="w-full py-3.5 bg-blue-600 text-white rounded-xl font-bold text-xs tracking-wide shadow-md hover:bg-blue-700 transition uppercase transform hover:-translate-y-0.5">Simpan</button>
            </form>
        </div>
    </div>

    <div id="modalEdit" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm p-4 flex items-center justify-center">
        <div class="bg-white dark:bg-slate-900 rounded-3xl w-full max-w-sm p-6 shadow-2xl border border-slate-100 dark:border-slate-800">
            <h3 class="text-xs font-extrabold text-slate-900 dark:text-slate-200 uppercase tracking-widest mb-4">Perbarui Data Katalog</h3>
            <form id="formEditAlat" action="" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Nama Judul Alat</label>
                    <input type="text" name="nama_alat" id="edit_nama_alat" required class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-bold text-slate-800 dark:text-slate-200 focus:outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Merek / Kategori</label>
                    <input type="text" name="kategori" id="edit_kategori" class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-300 focus:outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Estimasi Harga Unit</label>
                    <input type="number" name="harga" id="edit_harga" required class="w-full p-3 bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-bold text-slate-800 dark:text-slate-200 focus:outline-none">
                </div>
                <div class="pt-2 flex gap-2">
                    <button type="button" onclick="closeModal('modalEdit')" class="flex-1 py-2.5 bg-slate-100 dark:bg-slate-800 font-bold text-slate-500 dark:text-slate-400 rounded-xl text-xs uppercase tracking-wider">Batal</button>
                    <button type="submit" class="flex-1 py-2.5 bg-slate-900 dark:bg-slate-750 text-white font-bold rounded-xl text-xs uppercase tracking-wider shadow-sm transform hover:-translate-y-0.5">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            document.getElementById('dark-icon').classList.remove('hidden');
            document.getElementById('light-icon').classList.add('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            document.getElementById('dark-icon').classList.add('hidden');
            document.getElementById('light-icon').classList.remove('hidden');
        }

        function toggleDarkMode() {
            const html = document.documentElement;
            const darkIcon = document.getElementById('dark-icon');
            const lightIcon = document.getElementById('light-icon');

            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                darkIcon.classList.add('hidden');
                lightIcon.classList.remove('hidden');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                darkIcon.classList.remove('hidden');
                lightIcon.classList.add('hidden');
            }
        }

        function openModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function openTransaksiModal(jenis, alatId = null, namaAlat = '') {
            document.getElementById('input_jenis_transaksi').value = jenis;
            
            const title = document.getElementById('modalTransaksiTitle');
            if(jenis === 'masuk') title.innerText = 'Catat Stok Masuk';
            if(jenis === 'keluar') title.innerText = 'Catat Keluar (Rusak/Hilang)';
            if(jenis === 'pinjam') title.innerText = 'Form Pinjam Alat';

            if (alatId) {
                document.getElementById('wrapper_pilihan_alat').classList.add('hidden');
                document.getElementById('form_alat_baru').classList.add('hidden');
                document.getElementById('form_alat_lama').classList.remove('hidden');
                
                document.getElementById('pilihan_alat').value = 'lama';
                document.getElementById('select_alat_olahraga_id').value = alatId;
            } else {
                document.getElementById('wrapper_pilihan_alat').classList.remove('hidden');
                document.getElementById('pilihan_alat').value = 'lama';
                toggleFormAlatBaru();
            }

            document.getElementById('varian_nama_manual').value = '';

            const input = document.getElementById('input_asal_tujuan');
            const label = document.getElementById('label_asal_tujuan');
            
            if(jenis === 'masuk') {
                label.innerText = "Asal Perolehan";
                input.placeholder = "Asal alat masuk";
            } else if(jenis === 'keluar') {
                label.innerText = "Tujuan / Alasan Alokasi";
                input.placeholder = "Contoh: Dibuang karena pecah";
            } else if(jenis === 'pinjam') {
                label.innerText = "Nama Peminjam Instansi";
                input.placeholder = "Contoh: Angga (Kelas XI-C)";
            }
            
            openModal('modalTransaksi');
        }

        function toggleFormAlatBaru() {
            const pilihan = document.getElementById('pilihan_alat').value;
            if (pilihan === 'baru') {
                document.getElementById('form_alat_lama').classList.add('hidden');
                document.getElementById('form_alat_baru').classList.remove('hidden');
            } else {
                document.getElementById('form_alat_lama').classList.remove('hidden');
                document.getElementById('form_alat_baru').classList.add('hidden');
            }
        }

        function openEditModal(element) {
            const id = element.getAttribute('data-id');
            const nama = element.getAttribute('data-nama');
            const kategori = element.getAttribute('data-kategori');
            const harga = element.getAttribute('data-harga');

            document.getElementById('formEditAlat').action = '/alat-edit/' + id;
            document.getElementById('edit_nama_alat').value = nama;
            document.getElementById('edit_kategori').value = kategori || '';
            document.getElementById('edit_harga').value = harga;
            
            openModal('modalEdit');
        }
    </script>
</body>
</html>