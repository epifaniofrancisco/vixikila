<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kixikila extends Model
{
    use HasFactory;
    protected $fillable = ['id','id_user','montante','n_pessoas','dt_validade'];
}
