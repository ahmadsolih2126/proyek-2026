<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail - <?php echo e($alat->nama_alat); ?></title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // SCRIPT SINKRONISASI REAL-TIME
        function syncTheme() {
            const isDark = localStorage.getItem('darkMode');
            if (isDark === 'true') {
                document.documentElement.classList.add('dark');
            } else if (isDark === 'false') {
                document.documentElement.classList.remove('dark');
            } else {
                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }
        }
        syncTheme();
        window.addEventListener('storage', (e) => { if (e.key === 'darkMode') syncTheme(); });
        setInterval(syncTheme, 200);
    </script>
    <!-- Google Fonts: Plus Jakarta Sans & Archivo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@700;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-display { font-family: 'Archivo', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #334155; }
        
        /* Efek Animasi Glow Pulse untuk Badge Baru */
        @keyframes tech-pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.92); }
        }
        .animate-tech-pulse { animation: tech-pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-[#090d16] text-slate-900 dark:text-slate-100 antialiased min-h-screen pb-20 transition-colors duration-300">

    <!-- Header Navigation -->
    <header class="bg-white/80 dark:bg-[#0f172a]/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800/60 sticky top-0 z-40 shadow-sm transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            
            <!-- Logo Header disamain dengan branding utama biar kece -->
            <a href="<?php echo e(url('/')); ?>" class="font-display font-black text-lg text-slate-900 dark:text-white flex items-center gap-2.5 tracking-tight">
                <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800/80 flex items-center justify-center border border-slate-200 dark:border-slate-700/60 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                        <path d="M18 5 H8 L5 8 V11 L8 14 H16 L19 17 V20 L16 23 H6" />
                    </svg>
                </div>
                <span>SPORTS<span class="text-blue-600 dark:text-blue-400">.STOK</span></span>
            </a>
            
            <!-- Back Button -->
            <a href="<?php echo e(url('/')); ?>" class="font-display inline-flex items-center gap-2 px-4 py-2.5 border border-slate-200 dark:border-slate-800 rounded-xl text-xs font-bold text-slate-600 dark:text-slate-400 bg-white dark:bg-[#131c31] hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition-all duration-200 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                KEMBALI KE DASHBOARD
            </a>
        </div>
    </header>

    <!-- Main Content Grid -->
    <main class="max-w-7xl mx-auto px-6 mt-12 space-y-8">
        
        <!-- CARD ATAS: Informasi Inti Alat Olahraga -->
        <div class="bg-white dark:bg-[#0f172a] border border-slate-200/80 dark:border-slate-800/70 rounded-3xl p-6 md:p-8 shadow-md grid grid-cols-1 md:grid-cols-12 gap-8 items-center relative overflow-hidden transition-colors duration-300">
            
            <!-- BACKGROUND ACCENT (Glow effect untuk dark mode) -->
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none hidden dark:block"></div>
            
            <!-- SISI KIRI: Logo Simpel "S" Impian Lo Bray -->
            <div class="md:col-span-5 bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 rounded-2xl relative overflow-hidden flex flex-col items-center justify-center p-8 text-center min-h-[280px] border border-slate-800 dark:border-slate-900 shadow-xl">
                <!-- Tech Grid Overlay -->
                <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff02_1px,transparent_1px),linear-gradient(to_bottom,#ffffff03_1px,transparent_1px)] bg-[size:16px_16px]"></div>
                
                <!-- Kotak Logo Huruf S Minimalis Sesuai Gambar -->
                <div class="relative z-10 w-24 h-24 rounded-2xl bg-white/[0.03] dark:bg-slate-800/40 backdrop-blur-xl border border-white/[0.08] dark:border-slate-700/50 shadow-2xl flex items-center justify-center mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" class="w-11 h-11 filter drop-shadow-[0_0_8px_rgba(59,130,246,0.6)]">
                        <path d="M18 5 H8 L5 8 V11 L8 14 H16 L19 17 V20 L16 23 H6" />
                    </svg>
                </div>
                
                <!-- Penyelarasan Nama Teks Sesuai Gambar Request -->
                <h3 class="relative z-10 font-display text-2xl font-black text-white tracking-wide uppercase">
                    SPORTS<span class="text-blue-500">.STOK</span>
                </h3>
                <div class="relative z-10 flex items-center gap-1.5 mt-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.12em]">
                        INVENTORY MANAGEMENT SYSTEM
                    </span>
                </div>
            </div>
            
            <!-- SISI KANAN: Detail Konten & Spesifikasi -->
            <div class="md:col-span-7 space-y-6">
                <div>
                    <!-- Modern Blinking Tech Badge -->
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 dark:bg-blue-950/40 border border-blue-100 dark:border-blue-900/40 mb-3 transition-colors">
                        <span class="w-2 h-2 rounded-full bg-blue-600 dark:bg-blue-400 animate-tech-pulse shadow-[0_0_8px_#3b82f6]"></span>
                        <span class="font-display text-[10px] font-extrabold text-blue-700 dark:text-blue-400 uppercase tracking-widest">
                            KATEGORI: <?php echo e($alat->kategori ?? 'Umum'); ?>

                        </span>
                    </div>

                    <h1 class="font-display text-3xl md:text-4xl font-black text-slate-900 dark:text-white uppercase tracking-tight">
                        <?php echo e($alat->nama_alat); ?>

                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed italic mt-3 border-l-4 border-blue-500 dark:border-blue-600 pl-4 bg-slate-50 dark:bg-slate-900/40 py-2 rounded-r-xl">
                        "<?php echo e($alat->deskripsi ?? 'Tidak ada catatan deskripsi khusus untuk item ini.'); ?>"
                    </p>
                </div>
                
                <!-- Bento Layout Grid Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Stat 1: Stock -->
                    <div class="p-4 rounded-2xl border border-blue-100 dark:border-blue-900/30 bg-blue-50/30 dark:bg-blue-950/10 hover:shadow-md transition-all">
                        <span class="text-[10px] font-bold text-blue-600 dark:text-blue-400 uppercase tracking-wider block">Stok Tersedia</span>
                        <span class="font-display text-2xl font-black text-blue-700 dark:text-blue-400 block mt-1">
                            <?php echo e($alat->jumlah); ?> <span class="text-xs font-bold text-slate-400 dark:text-slate-500">PCS</span>
                        </span>
                    </div>
                    <!-- Stat 2: Price -->
                    <div class="p-4 rounded-2xl border border-slate-200/60 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/40 hover:shadow-md transition-all">
                        <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider block">Harga Satuan</span>
                        <span class="font-display text-2xl font-black text-slate-800 dark:text-slate-200 block mt-1">
                            Rp<?php echo e(number_format($alat->harga ?? 0, 0, ',', '.')); ?>

                        </span>
                    </div>
                    <!-- Stat 3: Asset Value -->
                    <div class="p-4 rounded-2xl border border-slate-200/60 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/40 hover:shadow-md transition-all">
                        <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider block">Total Aset</span>
                        <span class="font-display text-2xl font-black text-slate-900 dark:text-white block mt-1">
                            Rp<?php echo e(number_format(($alat->harga ?? 0) * ($alat->jumlah ?? 1), 0, ',', '.')); ?>

                        </span>
                    </div>
                </div>

                <!-- Bagian Grid Varian / Ukuran -->
                <?php if(isset($varian) && !$varian->isEmpty()): ?>
                    <div class="border-t border-slate-100 dark:border-slate-800 pt-4">
                        <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest block mb-2.5">
                            📦 RINCIAN DIMENSI / VARIAN STOCK
                        </span>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                            <?php $__currentLoopData = $varian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 p-2.5 rounded-xl flex justify-between items-center hover:border-blue-400 dark:hover:border-blue-500/50 transition-all">
                                    <span class="font-display font-bold text-xs text-slate-700 dark:text-slate-300 truncate"><?php echo e($v->nama_varian); ?></span>
                                    <span class="bg-slate-900 dark:bg-slate-800 text-white dark:text-blue-400 font-display font-black text-[10px] px-2 py-0.5 rounded-md shadow-sm border border-transparent dark:border-slate-700"><?php echo e($v->stok); ?> Pcs</span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- CARD BAWAH: Audit Ledger Log Activity -->
        <div class="bg-white dark:bg-[#0f172a] border border-slate-200/80 dark:border-slate-800/70 rounded-3xl shadow-md overflow-hidden transition-colors duration-300">
            <!-- Header Table Component -->
            <div class="p-6 border-b border-slate-100 dark:border-slate-800 bg-white dark:bg-[#0f172a]/80 flex items-center justify-between">
                <div>
                    <h2 class="font-display text-sm font-black text-slate-900 dark:text-white uppercase tracking-wider flex items-center gap-2">
                        <span class="w-1 h-4 bg-blue-600 rounded-full"></span>
                        RIWAYAT AKTIVITAS MUTASI BARANG
                    </h2>
                    <p class="text-[11px] text-slate-400 dark:text-slate-500 font-medium mt-0.5">Log data arus masuk dan keluar barang inventaris sekolah</p>
                </div>
            </div>

            <!-- Table Container Grid -->
            <div class="overflow-x-auto custom-scrollbar">
                <?php if($riwayat->isEmpty()): ?>
                    <div class="py-16 text-center">
                        <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest italic">Belum mendeteksi riwayat mutasi pada alat ini.</p>
                    </div>
                <?php else: ?>
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-[#0a0f1d] text-[10px] font-black tracking-widest text-slate-400 dark:text-slate-500 uppercase border-b border-slate-200/60 dark:border-slate-800/80">
                                <th class="py-4.5 px-6">Waktu / Tanggal</th>
                                <th class="py-4.5 px-6 text-center">Status Transaksi</th>
                                <th class="py-4.5 px-6">Volume</th>
                                <th class="py-4.5 px-6">Asal / Tujuan Alokasi</th>
                                <th class="py-4.5 px-6">Keterangan Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/40 text-xs font-semibold text-slate-600 dark:text-slate-300">
                            <?php $__currentLoopData = $riwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-900/30 transition-all duration-150">
                                    <!-- Tanggal -->
                                    <td class="py-4 px-6 text-slate-400 dark:text-slate-500 font-medium">
                                        <?php echo e($log->created_at ? \Carbon\Carbon::parse($log->created_at)->format('d M Y - H:i') : '-'); ?> WIB
                                    </td>
                                    
                                    <!-- Badge Classifier -->
                                    <td class="py-4 px-6 text-center">
                                        <?php if(strtolower($log->jenis_transaksi) === 'masuk'): ?>
                                            <span class="px-3 py-1 rounded-full text-[10px] font-black bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-400 border border-emerald-200/40 dark:border-emerald-900/30 uppercase tracking-wider">
                                                IN / MASUK
                                            </span>
                                        <?php else: ?>
                                            <span class="px-3 py-1 rounded-full text-[10px] font-black bg-rose-50 dark:bg-rose-950/20 text-rose-600 dark:text-rose-400 border border-rose-200/40 dark:border-rose-900/30 uppercase tracking-wider">
                                                OUT / KELUAR
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    
                                    <!-- Jumlah -->
                                    <td class="py-4 px-6 font-display font-bold text-slate-900 dark:text-slate-100">
                                        <?php echo e($log->jumlah); ?> Pcs
                                    </td>
                                    
                                    <!-- Asal / Tujuan -->
                                    <td class="py-4 px-6 font-bold text-blue-600 dark:text-blue-400 tracking-tight max-w-[180px] truncate" title="<?php echo e($log->asal_atau_tujuan); ?>">
                                        <?php echo e($log->asal_atau_tujuan ?? '-'); ?>

                                    </td>
                                    
                                    <!-- Keterangan -->
                                    <td class="py-4 px-6 text-slate-400 dark:text-slate-400 font-normal max-w-[240px] truncate" title="<?php echo e($log->keterangan); ?>">
                                        <?php echo e($log->keterangan ?? '-'); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>

    </main>

</body>
</html><?php /**PATH /var/www/html/resources/views/detail.blade.php ENDPATH**/ ?>