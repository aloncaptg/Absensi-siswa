<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuruAbsensi extends Model
{
    protected $table = 'guru_absensi';
    protected $fillable = ['guru_id','tanggal','status','keterangan'];
    protected $casts = ['tanggal' => 'date'];

    public function guru(): BelongsTo 
    { 
        return $this->belongsTo(Guru::class); 
    }
}
