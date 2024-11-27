<?php
/**
 * File ini dibuat oleh:
 * Nama: Muhammad Putra Erlangga Syawaluddin  
 * Kelas: XII RPL
 * Alamat: Kecamatan Karangploso, Kabupaten Malang
 */

// Mendefinisikan namespace untuk controller
namespace App\Http\Controllers;

// Import trait AuthorizesRequests untuk fitur otorisasi
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// Import trait ValidatesRequests untuk validasi request
use Illuminate\Foundation\Validation\ValidatesRequests;
// Import BaseController sebagai kelas dasar
use Illuminate\Routing\Controller as BaseController;

/**
 * Controller adalah kelas dasar yang diwarisi oleh semua controller
 * Menyediakan fungsionalitas dasar untuk otorisasi dan validasi
 * 
 * Fakta unik: Laravel menggunakan pola MVC (Model-View-Controller)
 * yang pertama kali diperkenalkan tahun 1979 oleh Trygve Reenskaug
 */
class Controller extends BaseController
{
    // Menggunakan trait untuk menambahkan kemampuan otorisasi dan validasi
    // Fakta unik: Trait adalah cara PHP untuk menerapkan multiple inheritance
    use AuthorizesRequests, ValidatesRequests;
}
