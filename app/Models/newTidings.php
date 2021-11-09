<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class newTidings extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'manchete',
        'title_tiding',
        'description_tiding',
    ];
}
