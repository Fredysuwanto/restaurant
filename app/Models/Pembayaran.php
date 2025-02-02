<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable=[
        'reservasi_id','kasir_id','metode','menu_id','jumlah'];

        public function reservasi()
        {
            return $this->belongsTo(Reservasi::class, 'reservasi_id');
            //return $this->belongsTo(Nama_Model::class,'fakultas_id');
            //1 prodi 1 fakultas belongsTo()
            //1 fakultas > 1 prodi hasMany()
        }
        public function kasir()
        {
            return $this->belongsTo(Kasir::class, 'kasir_id');
            //return $this->belongsTo(Nama_Model::class,'fakultas_id');
            //1 prodi 1 fakultas belongsTo()
            //1 fakultas > 1 prodi hasMany()
        }
        public function menu()
        {
            return $this->belongsTo(Menu::class, 'menu_id');
            //return $this->belongsTo(Nama_Model::class,'fakultas_id');
            //1 prodi 1 fakultas belongsTo()
            //1 fakultas > 1 prodi hasMany()
        }
}
