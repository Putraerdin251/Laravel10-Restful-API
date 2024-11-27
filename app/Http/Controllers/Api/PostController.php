<?php
/**
 * File ini dibuat oleh:
 * Nama: Muhammad Putra Erlangga Syawaluddin
 * Kelas: XII RPL
 * Alamat: Kecamatan Karangploso, Kabupaten Malang
 */

namespace App\Http\Controllers\Api;

//import Model "Post" untuk interaksi dengan database
use App\Models\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import Resource "PostResource" untuk transformasi data
use App\Http\Resources\PostResource;

//import Facade "Storage" untuk manajemen file
use Illuminate\Support\Facades\Storage;

//import Facade "Validator" untuk validasi input
use Illuminate\Support\Facades\Validator;

/**
 * PostController menangani operasi CRUD untuk model Post
 * Fakta unik: Laravel menggunakan pattern Repository untuk akses database
 */
class PostController extends Controller
{
    /**
     * Menampilkan daftar post dengan pagination
     * Fakta unik: Laravel pagination terintegrasi dengan Bootstrap UI
     *
     * @return PostResource
     */
    public function index()
    {
        //mengambil semua post diurutkan terbaru, 5 item per halaman
        $posts = Post::latest()->paginate(5);

        //mengembalikan koleksi post dalam format resource
        return new PostResource(true, 'List Data Posts', $posts);
    }

    /**
     * Menyimpan post baru ke database
     * Fakta unik: Laravel memiliki fitur automatic file upload handling
     *
     * @param Request $request
     * @return PostResource|JsonResponse
     */
    public function store(Request $request)
    {
        //mendefinisikan aturan validasi input
        $validator = Validator::make($request->all(), [
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'     => 'required',
            'content'   => 'required',
        ]);

        //memeriksa jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload gambar ke storage
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        //membuat post baru di database
        $post = Post::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content,
        ]);

        //mengembalikan response sukses
        return new PostResource(true, 'Data Post Berhasil Ditambahkan!', $post);
    }

    /**
     * Menampilkan detail post tertentu
     * Fakta unik: Laravel menggunakan Route Model Binding untuk pencarian otomatis
     *
     * @param int $id
     * @return PostResource
     */
    public function show($id)
    {
        //mencari post berdasarkan ID
        $post = Post::find($id);

        //mengembalikan single post dalam format resource
        return new PostResource(true, 'Detail Data Post!', $post);
    }

    /**
     * Mengupdate post yang sudah ada
     * Fakta unik: Laravel menyediakan method untuk update partial (patch)
     *
     * @param Request $request
     * @param int $id
     * @return PostResource|JsonResponse
     */
    public function update(Request $request, $id)
    {
        //mendefinisikan aturan validasi untuk update
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ]);

        //memeriksa jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //mencari post berdasarkan ID
        $post = Post::find($id);

        //memeriksa apakah ada file gambar baru
        if ($request->hasFile('image')) {

            //upload gambar baru
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            //menghapus gambar lama
            Storage::delete('public/posts/'.$post->image);

            //update post dengan gambar baru
            $post->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content,
            ]);

        } else {

            //update post tanpa mengubah gambar
            $post->update([
                'title'     => $request->title,
                'content'   => $request->content,
            ]);
        }

        //mengembalikan response sukses
        return new PostResource(true, 'Data Post Berhasil Diubah!', $post);
    }

    /**
     * Menghapus post tertentu
     * Fakta unik: Laravel menggunakan Soft Deletes untuk penghapusan aman
     *
     * @param int $id
     * @return PostResource
     */
    public function destroy($id)
    {
        //mencari post berdasarkan ID
        $post = Post::find($id);

        //menghapus file gambar dari storage
        Storage::delete('public/posts/'.$post->image);

        //menghapus post dari database
        $post->delete();

        //mengembalikan response sukses
        return new PostResource(true, 'Data Post Berhasil Dihapus!', null);
    }
}
