<?php
/**
 * File ini dibuat oleh:
 * Nama: Muhammad Putra Erlangga Syawaluddin
 * Kelas: XII RPL
 * Alamat: Kecamatan Karangploso, Kabupaten Malang
 */

// Mendefinisikan namespace untuk model
namespace App\Models;

// Import kelas-kelas yang diperlukan dari Laravel
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model Post untuk mengelola data posting dalam database
 * Fakta unik: Laravel menggunakan Active Record Pattern yang diperkenalkan oleh Martin Fowler
 */
class Post extends Model
{
    // Menggunakan trait HasFactory untuk membuat data palsu saat testing
    // Fakta unik: Factory Pattern memudahkan pembuatan data testing yang konsisten
    use HasFactory;

    /**
     * Daftar kolom yang dapat diisi secara massal (mass assignment)
     * Ini adalah fitur keamanan untuk mencegah pengisian data yang tidak diinginkan
     * 
     * Fakta unik: Mass assignment vulnerability pernah menjadi masalah serius di GitHub tahun 2012
     *
     * @var array
     */
    protected $fillable = [
        'image',     // Menyimpan nama file gambar
        'title',     // Menyimpan judul posting
        'content',   // Menyimpan konten posting
    ];

    /**
     * Accessor untuk mengubah cara pengambilan data gambar
     * Mengubah nama file menjadi URL lengkap ke file gambar
     * 
     * Fakta unik: Laravel Accessor/Mutator terinspirasi dari konsep getter/setter di OOP
     *
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            // Menggunakan arrow function untuk mengubah path gambar menjadi URL lengkap
            get: fn ($image) => asset('/storage/posts/' . $image),
        );
    }
}
