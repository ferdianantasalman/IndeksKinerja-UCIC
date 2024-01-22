<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenjangFungsional extends Model
{
    use HasFactory;

    protected $table = "jenjang_fungsionals";

    protected $guarded = [];

    public function bobot_nilai()
    {
        return $this->belongsTo(BobotNilai::class);
    }
}
