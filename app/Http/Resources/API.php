<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class API extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
        return [
         //   'id' => $this->id,
            'nomeUsuario' => $this->name,
            'nif'=> $this->nif,
            'nome'=> $this->nome,
            'vc_endereco'=> $this->vc_endereco,
            'it_id_usuario' => $this->it_id_usuario,
            'id_destrito'=>$this->id_destrito,
            'it_id_categoria_estabelecimento' => $this->it_id_categoria_estabelecimento,
            'it_estado'=>$this->it_estado,
            //  'name' =>$this->name

        ];

    }

}
