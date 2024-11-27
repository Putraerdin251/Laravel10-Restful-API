<?php
/**
 * File ini dibuat oleh:
 * Nama: Muhammad Putra Erlangga Syawaluddin
 * Kelas: XII RPL
 * Alamat: Kecamatan Karangploso, Kabupaten Malang
 */

namespace App\Console;

// Import kelas Schedule untuk mengatur penjadwalan tugas
use Illuminate\Console\Scheduling\Schedule;
// Import kelas dasar ConsoleKernel yang akan di-extend
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Kelas Kernel merupakan pusat konfigurasi untuk Console Laravel
 * Fakta unik: Console Kernel Laravel terinspirasi dari Symfony Console Component
 */
class Kernel extends ConsoleKernel
{
    /**
     * Method ini digunakan untuk mendefinisikan jadwal perintah yang akan dijalankan
     * Contoh penggunaan: Backup database otomatis, pembersihan cache, dll
     * 
     * Fakta unik: Laravel scheduler menggunakan sistem Cron di balik layar
     */
    protected function schedule(Schedule $schedule): void
    {
        // Contoh penjadwalan perintah 'inspire' setiap jam
        // Uncomment baris di bawah untuk mengaktifkan
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Method ini mendaftarkan semua perintah console kustom aplikasi
     * Secara otomatis memuat perintah dari direktori Commands
     * 
     * Fakta unik: Laravel dapat membuat perintah artisan kustom dengan 'php artisan make:command'
     */
    protected function commands(): void
    {
        // Memuat semua perintah dari direktori Commands
        $this->load(__DIR__.'/Commands');

        // Memuat perintah yang didefinisikan di routes/console.php
        require base_path('routes/console.php');
    }
}
