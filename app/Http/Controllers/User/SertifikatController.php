<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vaksinasi;
use Carbon\Carbon;
use Auth;

class SertifikatController extends Controller
{
    public function pertama(){
    	$check = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
        ->where('vaksinasi.id_user', Auth::user()->id)
        ->where('vaksinasi.vaksinasi_ke', 1)
        ->first();

        if(empty($check)){
            return back();
        } else {
            $nama = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
            ->join('profil', 'profil.id_user', '=', 'vaksinasi.id_user')
            ->where('vaksinasi.id_user', Auth::user()->id)
            ->where('vaksinasi.vaksinasi_ke', 1)
            ->value('nama');

            $tanggal_lahir = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
            ->join('profil', 'profil.id_user', '=', 'vaksinasi.id_user')
            ->where('vaksinasi.id_user', Auth::user()->id)
            ->where('vaksinasi.vaksinasi_ke', 1)
            ->value('tanggal_lahir');

            $tglLahir= Carbon::parse($tanggal_lahir)->format('d-m-Y'); 

            $nik = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
            ->join('profil', 'profil.id_user', '=', 'vaksinasi.id_user')
            ->where('vaksinasi.id_user', Auth::user()->id)
            ->where('vaksinasi.vaksinasi_ke', 1)
            ->value('nik');

            $vaksinasi_ke = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
            ->join('profil', 'profil.id_user', '=', 'vaksinasi.id_user')
            ->where('vaksinasi.id_user', Auth::user()->id)
            ->where('vaksinasi.vaksinasi_ke', 1)
            ->value('vaksinasi_ke');

            $jenis = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
            ->join('profil', 'profil.id_user', '=', 'vaksinasi.id_user')
            ->join('jenis_vaksin', 'jenis_vaksin.id_jenis_vaksin', '=', 'vaksinasi.id_jenis_vaksin')
            ->where('vaksinasi.id_user', Auth::user()->id)
            ->where('vaksinasi.vaksinasi_ke', 1)
            ->value('nama_vaksin');

            $tanggal_vaksin = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
            ->join('profil', 'profil.id_user', '=', 'vaksinasi.id_user')
            ->join('jenis_vaksin', 'jenis_vaksin.id_jenis_vaksin', '=', 'vaksinasi.id_jenis_vaksin')
            ->where('vaksinasi.id_user', Auth::user()->id)
            ->where('vaksinasi.vaksinasi_ke', 1)
            ->value('tanggal_vaksin');

            $noSertif = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
            ->join('profil', 'profil.id_user', '=', 'vaksinasi.id_user')
            ->join('jenis_vaksin', 'jenis_vaksin.id_jenis_vaksin', '=', 'vaksinasi.id_jenis_vaksin')
            ->where('vaksinasi.id_user', Auth::user()->id)
            ->where('vaksinasi.vaksinasi_ke', 1)
            ->value('no_sertifikat');

            $tglVaksin= Carbon::parse($tanggal_vaksin)->format('d-m-Y'); 

            if (empty($check)) {
                $gambar = "./1.jpg";
            }
            else {
                $gambar = "./sertifikat/sertifikat-1.jpg";
            }

            $image = imagecreatefromjpeg($gambar);
            $white = imageColorAllocate($image, 255, 255, 255);
            $black = imageColorAllocate($image, 0, 0, 0);
            $font = "./sertifikat/arial.ttf";
            $sizeHeader = 36;
            $sizeBody = 30;

            $image_width = imagesx($image);  

            $text_boxDiberikan = imagettfbbox($sizeHeader,0,$font,"Diberikan Kepada");
            $text_widthDiberikan = $text_boxDiberikan[2]-$text_boxDiberikan[0]; 
            $text_heightDiberikan = $text_boxDiberikan[3]-$text_boxDiberikan[1];
            $xDiberikan = ($image_width/2) - ($text_widthDiberikan/2);

            $text_box_kepada = imagettfbbox($sizeHeader,0,$font,$nama);
            $text_width_kepada = $text_box_kepada[2]-$text_box_kepada[0]; 
            $text_height_kepada = $text_box_kepada[3]-$text_box_kepada[1];
            $x_kepada = ($image_width/2) - ($text_width_kepada/2);

            $text_box_status = imagettfbbox($sizeBody,0,$font,"Telah melakukan vaksinasi dosis ke-".$vaksinasi_ke." dengan jenis vaksin");
            $text_width_status = $text_box_status[2]-$text_box_status[0]; 
            $text_height_status = $text_box_status[3]-$text_box_status[1];
            $x_status = ($image_width/2) - ($text_width_status/2);

            $text_box_jenis = imagettfbbox($sizeBody,0,$font,$jenis);
            $text_width_jenis = $text_box_jenis[2]-$text_box_jenis[0]; 
            $text_height_jenis = $text_box_jenis[3]-$text_box_jenis[1];
            $x_jenis = ($image_width/2) - ($text_width_jenis/2);

            $text_box_sesuai = imagettfbbox($sizeBody,0,$font,"Sesuai dengan Peraturan yang berlaku");
            $text_width_sesuai = $text_box_sesuai[2]-$text_box_sesuai[0]; 
            $text_height_sesuai = $text_box_sesuai[3]-$text_box_sesuai[1];
            $x_sesuai = ($image_width/2) - ($text_width_sesuai/2);

            $text_box_pada = imagettfbbox($sizeBody,0,$font,"Pada ".$tglVaksin);
            $text_width_pada = $text_box_pada[2]-$text_box_pada[0]; 
            $text_height_pada = $text_box_pada[3]-$text_box_pada[1];
            $x_pada = ($image_width/2) - ($text_width_pada/2);

            $text_box_nosertif = imagettfbbox($sizeBody,0,$font,"Nomor: ".$noSertif);
            $text_width_nosertif = $text_box_nosertif[2]-$text_box_nosertif[0]; 
            $text_height_nosertif = $text_box_nosertif[3]-$text_box_nosertif[1];
            $x_nosertif = ($image_width/2) - ($text_width_nosertif/2);

            imagettftext($image, $sizeBody, 0, $x_nosertif, 350, $black, $font, "Nomor: ".$noSertif);
            imagettftext($image, $sizeHeader, 0, $xDiberikan, 420, $black, $font, "Diberikan Kepada");
            imagettftext($image, $sizeBody, 0, $x_kepada, 470, $black, $font, $nama);
            imagettftext($image, $sizeBody, 0, 300, 520, $black, $font, "NIK");
            imagettftext($image, $sizeBody, 0, 300, 570, $black, $font, $nik);
            imagettftext($image, $sizeBody, 0, 1000, 520, $black, $font, "Tanggal Lahir");
            imagettftext($image, $sizeBody, 0, 1000, 570, $black, $font, $tglLahir);
            imagettftext($image, $sizeBody, 0, $x_pada, 670, $black, $font, "Pada ".$tglVaksin);
            imagettftext($image, $sizeBody, 0, $x_status, 740, $black, $font, "Telah melakukan vaksinasi dosis ke-".$vaksinasi_ke." dengan jenis vaksin");
            imagettftext($image, $sizeBody, 0, $x_jenis, 780, $black, $font, $jenis);
            imagettftext($image, $sizeBody, 0, $x_sesuai, 850, $black, $font, "Sesuai dengan Peraturan yang berlaku");

            header("Content-type:  image/jpeg");
            imagejpeg($image);
            imagedestroy($image);
        }
    }

    public function kedua(){
        $check = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
        ->where('vaksinasi.id_user', Auth::user()->id)
        ->where('vaksinasi.vaksinasi_ke', 2)
        ->first();

        if(empty($check)){
            return back();
        } else {
            $nama = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
            ->join('profil', 'profil.id_user', '=', 'vaksinasi.id_user')
            ->where('vaksinasi.id_user', Auth::user()->id)
            ->where('vaksinasi.vaksinasi_ke', 2)
            ->value('nama');

            $tanggal_lahir = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
            ->join('profil', 'profil.id_user', '=', 'vaksinasi.id_user')
            ->where('vaksinasi.id_user', Auth::user()->id)
            ->where('vaksinasi.vaksinasi_ke', 2)
            ->value('tanggal_lahir');

            $tglLahir= Carbon::parse($tanggal_lahir)->format('d-m-Y'); 

            $nik = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
            ->join('profil', 'profil.id_user', '=', 'vaksinasi.id_user')
            ->where('vaksinasi.id_user', Auth::user()->id)
            ->where('vaksinasi.vaksinasi_ke', 2)
            ->value('nik');

            $vaksinasi_ke = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
            ->join('profil', 'profil.id_user', '=', 'vaksinasi.id_user')
            ->where('vaksinasi.id_user', Auth::user()->id)
            ->where('vaksinasi.vaksinasi_ke', 2)
            ->value('vaksinasi_ke');

            $jenis = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
            ->join('profil', 'profil.id_user', '=', 'vaksinasi.id_user')
            ->join('jenis_vaksin', 'jenis_vaksin.id_jenis_vaksin', '=', 'vaksinasi.id_jenis_vaksin')
            ->where('vaksinasi.id_user', Auth::user()->id)
            ->where('vaksinasi.vaksinasi_ke', 2)
            ->value('nama_vaksin');

            $tanggal_vaksin = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
            ->join('profil', 'profil.id_user', '=', 'vaksinasi.id_user')
            ->join('jenis_vaksin', 'jenis_vaksin.id_jenis_vaksin', '=', 'vaksinasi.id_jenis_vaksin')
            ->where('vaksinasi.id_user', Auth::user()->id)
            ->where('vaksinasi.vaksinasi_ke', 2)
            ->value('tanggal_vaksin');

            $noSertif = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
            ->join('profil', 'profil.id_user', '=', 'vaksinasi.id_user')
            ->join('jenis_vaksin', 'jenis_vaksin.id_jenis_vaksin', '=', 'vaksinasi.id_jenis_vaksin')
            ->where('vaksinasi.id_user', Auth::user()->id)
            ->where('vaksinasi.vaksinasi_ke', 2)
            ->value('no_sertifikat');

            $tglVaksin= Carbon::parse($tanggal_vaksin)->format('d-m-Y'); 

            if (empty($check)) {
                $gambar = "./1.jpg";
            }
            else {
                $gambar = "./sertifikat/sertifikat-1.jpg";
            }

            $image = imagecreatefromjpeg($gambar);
            $white = imageColorAllocate($image, 255, 255, 255);
            $black = imageColorAllocate($image, 0, 0, 0);
            $font = "./sertifikat/arial.ttf";
            $sizeHeader = 36;
            $sizeBody = 30;

            $image_width = imagesx($image);  

            $text_boxDiberikan = imagettfbbox($sizeHeader,0,$font,"Diberikan Kepada");
            $text_widthDiberikan = $text_boxDiberikan[2]-$text_boxDiberikan[0]; 
            $text_heightDiberikan = $text_boxDiberikan[3]-$text_boxDiberikan[1];
            $xDiberikan = ($image_width/2) - ($text_widthDiberikan/2);

            $text_box_kepada = imagettfbbox($sizeHeader,0,$font,$nama);
            $text_width_kepada = $text_box_kepada[2]-$text_box_kepada[0]; 
            $text_height_kepada = $text_box_kepada[3]-$text_box_kepada[1];
            $x_kepada = ($image_width/2) - ($text_width_kepada/2);

            $text_box_status = imagettfbbox($sizeBody,0,$font,"Telah melakukan vaksinasi dosis ke-".$vaksinasi_ke." dengan jenis vaksin");
            $text_width_status = $text_box_status[2]-$text_box_status[0]; 
            $text_height_status = $text_box_status[3]-$text_box_status[1];
            $x_status = ($image_width/2) - ($text_width_status/2);

            $text_box_jenis = imagettfbbox($sizeBody,0,$font,$jenis);
            $text_width_jenis = $text_box_jenis[2]-$text_box_jenis[0]; 
            $text_height_jenis = $text_box_jenis[3]-$text_box_jenis[1];
            $x_jenis = ($image_width/2) - ($text_width_jenis/2);

            $text_box_sesuai = imagettfbbox($sizeBody,0,$font,"Sesuai dengan Peraturan yang berlaku");
            $text_width_sesuai = $text_box_sesuai[2]-$text_box_sesuai[0]; 
            $text_height_sesuai = $text_box_sesuai[3]-$text_box_sesuai[1];
            $x_sesuai = ($image_width/2) - ($text_width_sesuai/2);

            $text_box_pada = imagettfbbox($sizeBody,0,$font,"Pada ".$tglVaksin);
            $text_width_pada = $text_box_pada[2]-$text_box_pada[0]; 
            $text_height_pada = $text_box_pada[3]-$text_box_pada[1];
            $x_pada = ($image_width/2) - ($text_width_pada/2);

            $text_box_nosertif = imagettfbbox($sizeBody,0,$font,"Nomor: ".$noSertif);
            $text_width_nosertif = $text_box_nosertif[2]-$text_box_nosertif[0]; 
            $text_height_nosertif = $text_box_nosertif[3]-$text_box_nosertif[1];
            $x_nosertif = ($image_width/2) - ($text_width_nosertif/2);

            imagettftext($image, $sizeBody, 0, $x_nosertif, 350, $black, $font, "Nomor: ".$noSertif);
            imagettftext($image, $sizeHeader, 0, $xDiberikan, 420, $black, $font, "Diberikan Kepada");
            imagettftext($image, $sizeBody, 0, $x_kepada, 470, $black, $font, $nama);
            imagettftext($image, $sizeBody, 0, 300, 520, $black, $font, "NIK");
            imagettftext($image, $sizeBody, 0, 300, 570, $black, $font, $nik);
            imagettftext($image, $sizeBody, 0, 1000, 520, $black, $font, "Tanggal Lahir");
            imagettftext($image, $sizeBody, 0, 1000, 570, $black, $font, $tglLahir);
            imagettftext($image, $sizeBody, 0, $x_pada, 670, $black, $font, "Pada ".$tglVaksin);
            imagettftext($image, $sizeBody, 0, $x_status, 740, $black, $font, "Telah melakukan vaksinasi dosis ke-".$vaksinasi_ke." dengan jenis vaksin");
            imagettftext($image, $sizeBody, 0, $x_jenis, 780, $black, $font, $jenis);
            imagettftext($image, $sizeBody, 0, $x_sesuai, 850, $black, $font, "Sesuai dengan Peraturan yang berlaku");

            header("Content-type:  image/jpeg");
            imagejpeg($image);
            imagedestroy($image);        
        }        
    }
}
