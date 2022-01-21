<?php

namespace App\Traits;

trait DbModel
{
    public function scopeIdentic($query, $campo, $valor){
        if(isset($valor) and trim($valor)!='' and $valor!='null'){
            return $query->where($campo, '=', $valor);
        }
        else{
            return $query;
        }
    }

    public function scopeOrIdentic($query, $campo, $valor){
        if(isset($valor) and !empty($valor)){
            return $query->orWhere($campo, '=', $valor);
        }
        else{
            return $query;
        }
    }

    public function scopeLike($query, $campo, $valor){
        if(isset($valor) and !empty($valor)){
            $valor = str_replace(" ", "%", $valor);
            return $query->where($campo, 'LIKE', "%{$valor}%");
        }
        else{
            return $query;
        }
    }

	public function scopeOrLike($query, $campo, $valor){
        if(isset($valor) and !empty($valor)){
            $valor = str_replace(" ", "%", $valor);
            return $query->orWhere($campo, 'LIKE', "%{$valor}%");
        }
        else{
            return $query;
        }
    }
}