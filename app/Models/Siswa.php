<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['nama','nis','kelas_id','user_id'];

    public function kelas(): BelongsTo { return $this->belongsTo(Kelas::class); }
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function absensis(): HasMany { return $this->hasMany(Absensi::class); }
}
