<?php
/**
 * File ini dibuat oleh:
 * Nama: Muhammad Putra Erlangga Syawaluddin
 * Kelas: XII RPL
 * Alamat: Kecamatan Karangploso, Kabupaten Malang
 */

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

/**
 * Kelas Handler adalah pusat penanganan exception dalam aplikasi Laravel
 * Fakta unik: Laravel menggunakan Monolog library untuk logging yang sangat powerful
 */
class Handler extends ExceptionHandler
{
    /**
     * Daftar tipe exception dengan level log kustomnya.
     * Level log membantu mengkategorikan seberapa serius suatu error
     * Contoh level: emergency, alert, critical, error, warning, notice, info, debug
     * 
     * Fakta unik: Laravel mendukung multiple logging channels secara bersamaan
     * 
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * Daftar tipe exception yang tidak perlu dilaporkan.
     * Berguna untuk mengabaikan error yang tidak terlalu penting
     * 
     * Fakta unik: Laravel dapat mengirim notifikasi error ke Slack, Email, dll
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * Daftar input yang tidak akan di-flash ke session saat terjadi validation exception.
     * Ini penting untuk keamanan, terutama untuk data sensitif seperti password
     * 
     * Fakta unik: Laravel memiliki fitur automatic password hashing untuk keamanan
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Mendaftarkan callback untuk penanganan exception dalam aplikasi.
     * Method ini memungkinkan kita mendefinisikan logika khusus untuk exception tertentu
     * 
     * Fakta unik: Laravel dapat mengintegrasikan layanan error tracking seperti Sentry
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
