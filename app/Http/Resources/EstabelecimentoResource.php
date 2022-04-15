<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EstabelecimentoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //dd();
        $request = $this[0];
        return [
            "nomeEstabelecimento" => $request->nome,
            'nif'=> $request->nif,
            'responsavel'=> $request->name,
            'vc_endereco'=> $request->vc_endereco,
            'it_id_usuario' => $request->it_id_usuario,
            'id_destrito'=>$request->id_destrito,
            'it_id_categoria_estabelecimento' => $request->it_id_categoria_estabelecimento,
            'it_estado'=>$request->it_estado,
            'it_estado_apr_subscricao'=>$request->it_estado_apr_subscricao,
            'vc_nomeDestrito'=>$request->vc_nomeDestrito,
            "id"=>$request->id,
            'status'=>'ok'
        ];
    }
}
