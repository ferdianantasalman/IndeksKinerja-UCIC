<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotNilai extends Model
{
    use HasFactory;

    protected $table = "bobot_nilais";

    protected $guarded = [];

    // protected $guarded = [];

    public function jenjang_pendidikan()
    {
        return $this->hasMany(JenjangPendidikan::class);
    }

    public function jenjang_fungsional()
    {
        return $this->hasMany(JenjangFungsional::class);
    }
}
