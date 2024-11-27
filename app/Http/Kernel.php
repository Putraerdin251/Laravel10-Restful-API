<?php
/**
 * File ini dibuat oleh:
 * Nama: Muhammad Putra Erlangga Syawaluddin
 * Kelas: XII RPL
 * Alamat: Kecamatan Karangploso, Kabupaten Malang
 */

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

/**
 * Kelas Kernel adalah pusat konfigurasi HTTP middleware dalam Laravel
 * Fakta unik: Konsep middleware terinspirasi dari "pipeline pattern" di dunia software engineering
 */
class Kernel extends HttpKernel
{
    /**
     * Middleware global yang akan dijalankan pada setiap request
     * Urutan middleware penting karena dieksekusi secara berurutan
     * 
     * Fakta unik: TrustProxies middleware penting untuk aplikasi di belakang load balancer
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,        // Menangani header proxy untuk keamanan
        \Illuminate\Http\Middleware\HandleCors::class,    // Menangani Cross-Origin Resource Sharing
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,  // Mode maintenance
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class, // Validasi ukuran POST
        \App\Http\Middleware\TrimStrings::class,         // Membersihkan whitespace
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class, // Konversi string kosong
    ];

    /**
     * Grup middleware untuk berbagai jenis request
     * Web untuk request browser, API untuk request aplikasi
     * 
     * Fakta unik: Laravel Sanctum menggunakan token berbasis cookie untuk SPA authentication
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,   // Enkripsi cookie
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,  // Menambah cookie ke response
            \Illuminate\Session\Middleware\StartSession::class,  // Memulai session
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,  // Share error ke view
            \App\Http\Middleware\VerifyCsrfToken::class,  // Proteksi CSRF
            \Illuminate\Routing\Middleware\SubstituteBindings::class,  // Route model binding
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',  // Rate limiting
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Alias middleware untuk kemudahan penggunaan di routes
     * Contoh: Route::middleware('auth') lebih mudah dibaca
     * 
     * Fakta unik: Laravel menggunakan pattern Facade untuk middleware aliases
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,  // Autentikasi user
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,  // HTTP Basic Auth
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,  // Autentikasi session
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,  // HTTP cache headers
        'can' => \Illuminate\Auth\Middleware\Authorize::class,  // Authorization gates
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,  // Redirect user terautentikasi
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,  // Konfirmasi password
        'signed' => \App\Http\Middleware\ValidateSignature::class,  // Validasi signed URL
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,  // Rate limiting
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,  // Verifikasi email
    ];
}
