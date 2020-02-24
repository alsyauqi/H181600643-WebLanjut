<?php

namespace App\Http\Controllers;
use App\KategoriBerita;
use App\Pengumuman;
use Illuminate\Http\Request;

class BabSatuController extends Controller
{
//Tampilkan kategori berita dengan id=40 dan dibuat oleh orang dengan email ntarihoran@siregar.org
    Public function a1(){
        $kategoriBeritas=KategoriBerita::where ('id',40)->whereHas('user',function($query){
            $query->where('email','ntarihoran@siregar.org');
        })->get();

        return $kategoriBeritas;
        
    }
//Tampilkan Kategori Berita dari berita yang ditulis oleh orang dengan email yang diakhiri @wulandari.in
    public function a2(){
        $kategoriBeritas=KategoriBerita::whereHas('beritas',function($query){
            $query->whereHas('user',function($query){
                $query->where('email','like','%@wulandari.in');
            });
        })->get();
        return $kategoriBeritas;
        }
//Tampilkan Pengumuman yang ditulis oleh orang yang membuat kategori artikel id = 5 atau membuat kategori artikel id = 20 , sertakan user pembuat pengumumannya
    public function a3(){
        $pengumumans=Pengumuman::whereHas('user',function($query){
            $query->whereHas('kategoriArtikels',function($query){
                $query->where('id',5)->orWhere('id',20);
            });
        })->with('user')->get();
        return $pengumumans;
        
    }

  
}
    


