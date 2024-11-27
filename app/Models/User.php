<?php

/**
 * File ini dibuat oleh:
 * Nama: Muhammad Putra Erlangga Syawaluddin
 * Kelas: XII RPL
 * Alamat: Kecamatan Karangploso, Kabupaten Malang
 */

namespace App\Models;

// Import kelas-kelas yang diperlukan dari Laravel untuk fitur autentikasi dan notifikasi
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Model User untuk mengelola data pengguna dalam database
 * Fakta unik: Laravel menggunakan Active Record Pattern yang diperkenalkan oleh Martin Fowler
 */
class User extends Authenticatable
{
    // Menggunakan trait untuk menambahkan kemampuan membuat token API dan notifikasi
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Daftar atribut yang dapat diisi secara massal (mass assignment)
     * Ini adalah fitur keamanan untuk mencegah pengisian data yang tidak diinginkan
     * 
     * Fakta unik: Mass assignment vulnerability pernah menjadi masalah serius di GitHub tahun 2012
     *
     * @var array
     */
    protected $fillable = [
        'name',     // Menyimpan nama pengguna
        'email',    // Menyimpan email pengguna
        'password', // Menyimpan password pengguna
    ];

    /**
     * Daftar atribut yang harus disembunyikan saat serialisasi
     * Atribut ini tidak akan ditampilkan saat data pengguna diambil
     * 
     * Fakta unik: Laravel menggunakan JSON Web Tokens untuk autentikasi API
     *
     * @var array
     */
    protected $hidden = [
        'password',       // Menyembunyikan password untuk keamanan
        'remember_token', // Menyembunyikan token ingat untuk keamanan
    ];

    /**
     * Daftar atribut yang harus diubah tipe datanya saat diambil
     * Dalam kasus ini, atribut email_verified_at diubah menjadi tipe datetime
     * 
     * Fakta unik: Laravel menggunakan Carbon untuk mengelola tanggal dan waktu
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // Mengubah tipe email_verified_at menjadi datetime
    ];
}
