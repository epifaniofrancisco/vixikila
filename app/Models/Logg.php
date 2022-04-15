<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Logg extends Model
{

    public function log($nivel,$actividade)
    {

        if(Auth::user())
        {
            $militante = LogUser::create([
                'id_user' => Auth::user()->id,
                'actividade' => $actividade,
                'endereco' => $_SERVER['REMOTE_ADDR'],
                'dispositivo' => $_SERVER['HTTP_USER_AGENT'],
            ]);
            $actividade = Auth::user()->vc_nome.'-'.$actividade;

        }
        else{
            $actividade = 'erro'.'-'.$actividade;
        }
    Log::channel('logUser')->$nivel($actividade);

    }
}
