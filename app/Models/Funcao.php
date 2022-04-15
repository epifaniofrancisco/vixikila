<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'vc_nomeFuncao','id','it_estado'
    ];
}
