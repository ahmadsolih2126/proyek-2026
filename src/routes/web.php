<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

// ====================================================================
// CONFIG: Set true jika ingin langsung masuk dashboard tanpa login web depan.
// ====================================================================
define('BYPASS_LOGIN', false); 

// ==========================================
// 1. HALAMAN UTAMA & AUTO-SYNC ENGINE
// ==========================================
Route::get('/', function () {
    try {
        if (!Schema::hasTable('alat_olahragas')) {
            Schema::create('alat_olahragas', function ($table) {
                $table->id();
                $table->string('nama_alat');
                $table->string('kategori')->nullable();
                $table->integer('harga')->default(0);
                $table->integer('jumlah')->default(0);
                $table->text('deskripsi')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('log_alat_olahragas')) {
            Schema::create('log_alat_olahragas', function ($table) {
                $table->id();
                $table->unsignedBigInteger('alat_olahraga_id');
                $table->string('jenis_transaksi');
                $table->integer('jumlah');
                $table->string('asal_atau_tujuan')->nullable();
                $table->text('keterangan')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('peminjamans')) {
            Schema::create('peminjamans', function ($table) {
                $table->id();
                $table->unsignedBigInteger('alat_olahraga_id');
                $table->string('nama_peminjam');
                $table->integer('jumlah');
                $table->string('status')->default('dipinjam'); 
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('varian_alats')) {
            Schema::create('varian_alats', function ($table) {
                $table->id();
                $table->unsignedBigInteger('alat_olahraga_id');
                $table->string('nama_varian');
                $table->integer('stok')->default(0);
                $table->timestamps();
            });
        }

        // 🧹 OPAA CLEANUP ENGINE
        DB::table('log_alat_olahragas')
            ->whereNotIn('alat_olahraga_id', DB::table('alat_olahragas')->pluck('id'))
            ->delete();

        // 🔥 GENIUS AUTO-SYNC ENGINE
        $semua_alat_raw = DB::table('alat_olahragas')->get();
        foreach ($semua_alat_raw as $alat) {
            $total_masuk = DB::table('log_alat_olahragas')->where('alat_olahraga_id', $alat->id)->where('jenis_transaksi', 'masuk')->sum('jumlah');
            $total_keluar = DB::table('log_alat_olahragas')->where('alat_olahraga_id', $alat->id)->where('jenis_transaksi', 'keluar')->sum('jumlah');
            
            $stok_berdasarkan_log = $total_masuk - $total_keluar;
            $selisih_stok = $alat->jumlah - $stok_berdasarkan_log;

            if ($selisih_stok > 0) {
                DB::table('log_alat_olahragas')->insert([
                    'alat_olahraga_id' => $alat->id,
                    'jenis_transaksi'  => 'masuk',
                    'jumlah'           => $selisih_stok,
                    'asal_atau_tujuan' => 'ADMIN PANEL',
                    'keterangan'       => 'Stok diinput/disesuaikan via Admin Admin',
                    'created_at'       => $alat->created_at ?? now(),
                    'updated_at'       => $alat->updated_at ?? now(),
                ]);
            } elseif ($selisih_stok < 0) {
                DB::table('log_alat_olahragas')->insert([
                    'alat_olahraga_id' => $alat->id,
                    'jenis_transaksi'  => 'keluar',
                    'jumlah'           => abs($selisih_stok),
                    'asal_atau_tujuan' => 'ADMIN PANEL',
                    'keterangan'       => 'Stok dikurangi via Admin Admin',
                    'created_at'       => $alat->updated_at ?? now(),
                    'updated_at'       => $alat->updated_at ?? now(),
                ]);
            }
        }

        $semua_alat = DB::table('alat_olahragas')->get();
        $semua_log = DB::table('log_alat_olahragas')
            ->leftJoin('alat_olahragas', 'log_alat_olahragas.alat_olahraga_id', '=', 'alat_olahragas.id')
            ->select('log_alat_olahragas.*', 'alat_olahragas.nama_alat', 'alat_olahragas.kategori')
            ->orderBy('log_alat_olahragas.created_at', 'desc')
            ->get();

        $semua_pinjam = DB::table('peminjamans')
            ->leftJoin('alat_olahragas', 'peminjamans.alat_olahraga_id', '=', 'alat_olahragas.id')
            ->where('peminjamans.status', 'dipinjam')
            ->select('peminjamans.*', 'alat_olahragas.nama_alat', 'alat_olahragas.kategori')
            ->orderBy('peminjamans.created_at', 'desc')
            ->get();

        $semua_varian = DB::table('varian_alats')->get();
        $is_logged_in = BYPASS_LOGIN || session('is_admin_logged_in', false);

        return view('welcome', [
            'semua_alat' => $semua_alat,
            'semua_log'  => $semua_log,
            'semua_pinjam' => $semua_pinjam,
            'is_logged_in' => $is_logged_in,
            'semua_varian' => $semua_varian
        ]);

    } catch (\Exception $e) {
        return "Sistem terhambat masalah database: " . $e->getMessage();
    }
});

// =========================================================
// 2. PROSES INPUT TRANSAKSI (SUPPORT FULL ENGINE VARIAN)
// =========================================================
Route::post('/transaksi-proses', function (Request $request) {
    try {
        $jumlahInput = (int) $request->jumlah;
        if ($jumlahInput <= 0) {
            return redirect()->back()->with('transaksi_error', 'Gagal! Jumlah input harus lebih dari 0.');
        }

        $teksVarian = "";

        // --- AKSES 1: STOK MASUK ---
        if ($request->jenis_transaksi === 'masuk') {
            if ($request->pilihan_alat === 'baru') {
                $hargaRaw = $request->harga ?? '0';
                $hargaBersih = (int) str_replace('.', '', $hargaRaw);
                $namaAlatNotif = $request->nama_alat ?? 'Alat Tanpa Nama';
                $kategoriNotif = $request->kategori ?? 'Umum';

                $alatId = DB::table('alat_olahragas')->insertGetId([
                    'nama_alat' => $namaAlatNotif,
                    'kategori'  => $kategoriNotif,
                    'harga'     => $hargaBersih,
                    'jumlah'    => $jumlahInput,
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ]);

                if ($request->filled('nama_varian_alat_baru')) {
                    $namaVarianFix = strtoupper($request->nama_varian_alat_baru);
                    DB::table('varian_alats')->insert([
                        'alat_olahraga_id' => $alatId,
                        'nama_varian'      => $namaVarianFix,
                        'stok'             => $jumlahInput,
                        'created_at'       => now(),
                        'updated_at'       => now(),
                    ]);
                    $teksVarian = " [Varian: {$namaVarianFix}]";
                }
            } else {
                $alatId = $request->alat_olahraga_id;
                DB::table('alat_olahragas')->where('id', $alatId)->increment('jumlah', $jumlahInput);
                
                if ($request->filled('varian_baru')) {
                    $namaVarianBaru = strtoupper($request->varian_baru);
                    
                    $cekVarianEksis = DB::table('varian_alats')
                        ->where('alat_olahraga_id', $alatId)
                        ->where('nama_varian', $namaVarianBaru)
                        ->first();

                    if ($cekVarianEksis) {
                        DB::table('varian_alats')->where('id', $cekVarianEksis->id)->increment('stok', $jumlahInput);
                    } else {
                        DB::table('varian_alats')->insert([
                            'alat_olahraga_id' => $alatId,
                            'nama_varian'      => $namaVarianBaru,
                            'stok'             => $jumlahInput,
                            'created_at'       => now(),
                            'updated_at'       => now(),
                        ]);
                    }
                    $teksVarian = " [Varian: {$namaVarianBaru}]";
                }
            }

            DB::table('log_alat_olahragas')->insert([
                'alat_olahraga_id' => $alatId,
                'jenis_transaksi'  => 'masuk',
                'jumlah'           => $jumlahInput,
                'asal_atau_tujuan' => $request->asal_atau_tujuan ?? 'Dana BOS',
                'keterangan'       => ($request->keterangan ?? '-') . $teksVarian,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        // --- AKSES 2: KELUAR PERMANEN (RUSAK / HILANG) ---
        if ($request->jenis_transaksi === 'keluar') {
            $alatId = $request->alat_olahraga_id;
            $varianId = $request->varian_id;

            if ($varianId && $varianId !== 'global' && $varianId !== 'buat_baru') {
                $infoVarian = DB::table('varian_alats')->where('id', $varianId)->first();
                if ($infoVarian && $infoVarian->stok < $jumlahInput) {
                    return redirect()->back()->with('transaksi_error', "Gagal! Stok untuk varian {$infoVarian->nama_varian} tidak mencukupi.");
                }
            }

            $cekAlat = DB::table('alat_olahragas')->where('id', $alatId)->first();
            if (!$cekAlat || $cekAlat->jumlah < $jumlahInput) {
                return redirect()->back()->with('transaksi_error', 'Gagal! Stok utama tidak mencukupi untuk dikeluarkan.');
            }

            DB::table('alat_olahragas')->where('id', $alatId)->decrement('jumlah', $jumlahInput);
            
            if (isset($infoVarian) && $infoVarian) {
                DB::table('varian_alats')->where('id', $varianId)->decrement('stok', $jumlahInput);
                $teksVarian = " [Varian: {$infoVarian->nama_varian}]";
            }
            
            DB::table('log_alat_olahragas')->insert([
                'alat_olahraga_id' => $alatId,
                'jenis_transaksi'  => 'keluar',
                'jumlah'           => $jumlahInput,
                'asal_atau_tujuan' => $request->asal_atau_tujuan ?? 'Afkir/Gudang Rusak',
                'keterangan'       => '[Permanen/Rusak] ' . ($request->keterangan ?? '-') . $teksVarian,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        // --- AKSES 3: FITUR PINJAM ---
        if ($request->jenis_transaksi === 'pinjam') {
            $alatId = $request->alat_olahraga_id;
            $varianId = $request->varian_id;

            if ($varianId && $varianId !== 'global' && $varianId !== 'buat_baru') {
                $infoVarian = DB::table('varian_alats')->where('id', $varianId)->first();
                if ($infoVarian && $infoVarian->stok < $jumlahInput) {
                    return redirect()->back()->with('transaksi_error', "Gagal! Stok untuk varian {$infoVarian->nama_varian} tidak mencukupi.");
                }
            }

            $cekAlat = DB::table('alat_olahragas')->where('id', $alatId)->first();
            if (!$cekAlat || $cekAlat->jumlah < $jumlahInput) {
                return redirect()->back()->with('transaksi_error', 'Gagal! Stok utama tidak mencukupi untuk dipinjam.');
            }

            DB::table('alat_olahragas')->where('id', $alatId)->decrement('jumlah', $jumlahInput);
            
            if (isset($infoVarian) && $infoVarian) {
                DB::table('varian_alats')->where('id', $varianId)->decrement('stok', $jumlahInput);
                $teksVarian = " [Varian: {$infoVarian->nama_varian}]";
            }
            
            DB::table('peminjamans')->insert([
                'alat_olahraga_id' => $alatId,
                'nama_peminjam'    => ($request->asal_atau_tujuan ?? 'Siswa/Guru') . $teksVarian,
                'jumlah'           => $jumlahInput,
                'status'           => 'dipinjam',
                'created_at'       => now(),
                'updated_at'       => now()
            ]);

            DB::table('log_alat_olahragas')->insert([
                'alat_olahraga_id' => $alatId,
                'jenis_transaksi'  => 'keluar',
                'jumlah'           => $jumlahInput,
                'asal_atau_tujuan' => 'Dipinjam: ' . ($request->asal_atau_tujuan ?? 'Siswa') . $teksVarian,
                'keterangan'       => '[Peminjaman Aktif] ' . ($request->keterangan ?? '-') . $teksVarian,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Transaksi Berhasil Diinput bray!');

    } catch (\Exception $e) {
        return redirect()->back()->with('transaksi_error', 'Gagal memproses data: ' . $e->getMessage());
    }
});

// ==========================================
// 3. PENGEMBALIAN ALAT
// ==========================================
Route::post('/peminjaman-kembali/{id}', function ($id) {
    try {
        $pinjam = DB::table('peminjamans')->where('id', $id)->first();
        if (!$pinjam || $pinjam->status !== 'dipinjam') {
            return redirect()->back()->with('transaksi_error', 'Data peminjaman tidak valid.');
        }

        DB::table('alat_olahragas')->where('id', $pinjam->alat_olahraga_id)->increment('jumlah', $pinjam->jumlah);

        if (preg_match('/\[Varian:\s*([^\]]+)\]/', $pinjam->nama_peminjam, $matches)) {
            $namaVarianLog = trim($matches[1]);
            DB::table('varian_alats')
                ->where('alat_olahraga_id', $pinjam->alat_olahraga_id)
                ->where('nama_varian', $namaVarianLog)
                ->increment('stok', $pinjam->jumlah);
        }

        DB::table('log_alat_olahragas')->insert([
            'alat_olahraga_id' => $pinjam->alat_olahraga_id,
            'jenis_transaksi'  => 'masuk',
            'jumlah'           => $pinjam->jumlah,
            'asal_atau_tujuan' => 'Gudang (Kembali)',
            'keterangan'       => 'Pengembalian dari: ' . $pinjam->nama_peminjam,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        DB::table('peminjamans')->where('id', $id)->update([
            'status' => 'dikembalikan',
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Alat olahraga berhasil dikembalikan.');
    } catch (\Exception $e) {
        return redirect()->back()->with('transaksi_error', 'Gagal memproses pengembalian: ' . $e->getMessage());
    }
});

Route::post('/alat-hapus/{id}', function ($id) {
    DB::table('log_alat_olahragas')->where('alat_olahraga_id', $id)->delete();
    DB::table('peminjamans')->where('alat_olahraga_id', $id)->delete(); 
    DB::table('varian_alats')->where('alat_olahraga_id', $id)->delete();
    DB::table('alat_olahragas')->where('id', $id)->delete();
    return redirect()->back()->with('success', 'Data berhasil dihapus bersih!');
});

Route::post('/alat-edit/{id}', function (Request $request, $id) {
    DB::table('alat_olahragas')->where('id', $id)->update([
        'nama_alat'  => $request->nama_alat,
        'kategori'   => $request->kategori,
        'harga'      => (int) $request->harga,
        'updated_at' => now(),
    ]);
    return redirect()->back()->with('success', 'Data alat berhasil diperbarui!');
});

Route::get('/alat-detail/{id}', function ($id) {
    $alat = DB::table('alat_olahragas')->where('id', $id)->first();
    $varian = DB::table('varian_alats')->where('alat_olahraga_id', $id)->get();
    $riwayat = DB::table('log_alat_olahragas')->where('alat_olahraga_id', $id)->orderBy('created_at', 'desc')->get();
    return view('detail', ['alat' => $alat, 'riwayat' => $riwayat, 'varian' => $varian]);
});

Route::post('/login-proses', function (Request $request) {
    session(['is_admin_logged_in' => true]); return redirect('/');
});

Route::post('/logout-proses', function () {
    session()->forget('is_admin_logged_in'); return redirect('/');
});

Route::get('/cetak-laporan', function () {
    $semua_log = DB::table('log_alat_olahragas')->leftJoin('alat_olahragas', 'log_alat_olahragas.alat_olahraga_id', '=', 'alat_olahragas.id')->select('log_alat_olahragas.*', 'alat_olahragas.nama_alat', 'alat_olahragas.kategori')->orderBy('log_alat_olahragas.created_at', 'desc')->get();
    $html = '<!DOCTYPE html><html><head><title>Laporan</title><style>body{font-family:Arial;padding:20px;}table{width:100%;border-collapse:collapse;}th,td{border:1px solid #ddd;padding:8px;}th{background:#f4f4f4;}</style></head><body><h2>LAPORAN MUTASI ALAT</h2><table><thead><tr><th>No</th><th>Tanggal</th><th>Nama Alat</th><th>Jenis</th><th>Qty</th><th>Keterangan</th></tr></thead><tbody>';
    $no=1; foreach($semua_log as $l){ $html.='<tr><td>'.$no++.'</td><td>'.$l->created_at.'</td><td>'.$l->nama_alat.'</td><td>'.$l->jenis_transaksi.'</td><td>'.$l->jumlah.'</td><td>'.$l->asal_atau_tujuan.'</td></tr>'; }
    $html.='</tbody></table><script>window.print();</script></body></html>';
    return response($html);
});

// ===================================================================================
// UPDATE ULTRA ELEGANT: Laporan Kendala WhatsApp Pure Text Premium Tanpa Link Link bray
// ===================================================================================
Route::post('/laporkan-kendala', function (Request $request) {
    // 1. Ambil nomor whatsapp target dari form
    $nomorTujuan = $request->nomor_whatsapp;

    // 2. Bersihkan karakter spasi, strip atau tanda tambah (+) jika ada bray
    $nomorTujuan = preg_replace('/[^0-9]/', '', $nomorTujuan);

    // 3. Konversi otomatis jika user ngetik "08..." diubah jadi "62..."
    if (str_starts_with($nomorTujuan, '0')) {
        $nomorTujuan = '62' . substr($nomorTujuan, 1);
    }

    // 4. Susun format teks WA murni super rapi ala nota aduan resmi
    $textWa = "━━━━━━━━━━━━━━━━━━━━━━━━\n" .
              "🚨 *NOTIFIKASI PENGADUAN KENDALA ALAT* \n" .
              "━━━━━━━━━━━━━━━━━━━━━━━━\n\n" .
              "📌 *INFO PELAPORAN :*\n" .
              "• *Nama Pelapor :* " . strtoupper($request->nama_pelapor) . "\n" .
              "• *Judul Masalah :* " . $request->judul_kendala . "\n" .
              "• *Waktu Log     :* " . now()->format('d-M-Y / H:i') . " WIB\n\n" .
              "📝 *KRONOLOGI / DETAIL :*\n" .
              "_\"" . $request->deskripsi_kendala . "\"_\n\n" .
              "────────────────────────\n" .
              "*SPORTS.STOK - Inventory Management System*";

    // 5. Redirect browser langsung membawa format teks murni super elegan bray
    return redirect("https://api.whatsapp.com/send?phone=" . $nomorTujuan . "&text=" . urlencode($textWa));
});