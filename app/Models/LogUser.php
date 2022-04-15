<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LogUser extends Model
{
    use HasFactory;
    protected $table = 'logs';
    protected $fillable=[
        'id_user',
        'actividade',
        'endereco',
        'dispositivo',
    ];
    public  function LogsForSearch($datatime, $utilizador)
    {
    //$datatime=null;
    //$utilizador=null;
        $response['logs'] =DB::table('logs')
        ->join('users', 'logs.id_user', '=', 'users.id')
        ->select('logs.*','users.name');
        if($datatime !="null")
            $response['logs']->whereYear('logs.created_at', '=', $datatime);
        
        if($utilizador !="null")
            $response['logs']->where([['users.name', '=', $utilizador]]);
        
        
          return  $response['logs']->get();
        }

}
