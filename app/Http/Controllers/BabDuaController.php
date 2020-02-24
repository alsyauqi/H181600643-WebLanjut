<?php

namespace App\Http\Controllers;
use App\Berita;
use App\Artikel;
use App\Pengumuman;
use App\KategoriArtikel;

use Illuminate\Http\Request;

class BabDuaController extends Controller
{
 //Tampilkan berita yang dibuat oleh user yang membuat pengumuman, artikel, galeri dan kategori_artikel
    public function a4(){
       $beritas=Berita::whereHas('user',function($query){
           $query->whereHas('pengumumans')->whereHas('artikels')->whereHas('galeris')->whereHas('kategoriArtikels');
       })->get();
       return $beritas; 
    }
    public function a5(){
//Tampilkan artikel yang dibuat oleh user yang membuat galeri dengan nama kategori galeri yang di akhiri dengan et.

        $artikels=Artikel::whereHas('user',function($query){
            $query->whereHas('galeris',function($query){
                $query->whereHas('kategoriGaleri',function($query){
                    $query->where('nama','like','%et.');
                });
            });
        })->with('user.galeris.kategoriGaleri')->get();
        return $artikels;
    }
}
