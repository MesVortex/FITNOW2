<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'weight',
        'height',
        'waist_line',
        'bicep_thickness',
        'pec_width',
        'calve_thickness',
        'userID',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
   
}
