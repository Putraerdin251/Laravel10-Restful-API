<?php
/**
 * File ini dibuat oleh:
 * Nama: Muhammad Putra Erlangga Syawaluddin
 * Kelas: XII RPL 
 * Alamat: Kecamatan Karangploso, Kabupaten Malang
 */

// Mendefinisikan namespace untuk resource
namespace App\Http\Resources;

// Import kelas JsonResource sebagai kelas dasar untuk transformasi data
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * PostResource bertanggung jawab untuk transformasi data Post ke format JSON
 * Fakta unik: API Resource di Laravel terinspirasi dari Fractal library
 */
class PostResource extends JsonResource
{
    // Properti untuk menyimpan status response
    public $status;
    // Properti untuk menyimpan pesan response
    public $message;
    // Properti untuk menyimpan data resource
    public $resource;
    
    /**
     * Constructor untuk inisialisasi resource
     * Fakta unik: Laravel menggunakan pattern Dependency Injection di constructor
     *
     * @param  mixed $status  Status response (true/false)
     * @param  mixed $message Pesan yang akan ditampilkan
     * @param  mixed $resource Data yang akan ditransformasi
     * @return void
     */
    public function __construct($status, $message, $resource)
    {
        // Memanggil constructor parent class
        parent::__construct($resource);
        // Menyimpan status ke properti
        $this->status  = $status;
        // Menyimpan message ke properti
        $this->message = $message;
    }

    /**
     * Mengubah resource menjadi array untuk response JSON
     * Fakta unik: Laravel secara otomatis menghandle konversi ke JSON
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array Array yang berisi data yang sudah ditransformasi
     */
    public function toArray($request)
    {
        return [
            'success'   => $this->status,   // Status response
            'message'   => $this->message,  // Pesan response
            'data'      => $this->resource  // Data utama
        ];
    }
}