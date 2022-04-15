<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;
    protected $fillable = ['id','vc_bi','vc_genero','vc_primeiroNome','vc_ultimoNome','it_estado','dt_nascimento','vc_email','id_funcao','vc_foto'];
}
 