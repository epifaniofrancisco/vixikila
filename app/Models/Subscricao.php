<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscricao extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['id','id_usuario','id_estabelecimento','id_modalidade','it_id_tipoPublicidade','it_validacaoSubscricao','fl_precoSubscricao','it_estado','it_cancelamento', 'id_tipo_qr','id_superficie','vc_matricula', 'vc_alcool', 'fl_comprimento',
        'fl_largura','id_publicidade','it_croqui'];
    protected $dates = ['deleted_at'];
}
