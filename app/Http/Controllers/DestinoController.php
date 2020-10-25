<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DestinoController extends Controller
{
    public function getData(Request $request) {

    	$query = DB::table("destinos as dest")
    				->leftJoin("localidades as loc","loc.id","dest.id_localidad")
    				->leftJoin("paises as pais","pais.id","loc.pais_id")
    				->leftJoin("estados as est","est.id","loc.estado_id")
    				->leftJoin("municipios as mun","mun.id","loc.municipio_id")
                    /*
                    ->leftJoin("municipios as mun", function($join) {

                        $join->on("mun.id_pais", "loc.id_pais");
                        $join->on("mun.id_estado", "loc.id_estado");
                        $join->on("mun.id_municipio", "loc.id_municipio");
                    })
                    ->leftJoin("estados as est", function($join) {

                        $join->on("est.id_pais", "loc.id_pais");
                        $join->on("est.id_estado", "loc.id_estado");
                    })
                    ->leftJoin("paises as pais", "pais.id_pais", "loc.id_pais")
                    */
                    ->select(
                        "dest.id","dest.id_localidad","loc.descripcion as localidad",
                        "loc.id_municipio","mun.descripcion as municipio",
                        "loc.id_estado","est.descripcion as estado","loc.id_pais","pais.descripcion as pais"
                    )
                    // ->where('jug.id_usuario', $request['id_usuario'])
                    ->orderBy("loc.descripcion");

        $query->limit(1000);
                    
        if($request['term']) {

            $query->addSelect(DB::raw("concat(loc.descripcion,',',est.descripcion_corta,',',pais.id_pais) as localidad_"));
            $query->where(DB::raw("loc.descripcion"),'like', '%'.$request['term'].'%');
            $query->limit(20);
        }

        if($request['mod_op'] == 'existe_registro') {

            $query->where("loc.id_agencia", $request['id_agencia']);
            $query->where("loc.id_contacto", $request['id_contacto']);
        }
        else $query->whereNull("loc.deleted_at");

        if($request['id']) $query->whereIn("loc.id", [$request['id']]);

        if($request['id_agencia']) $query->whereIn("loc.id_agencia", [$request['id_agencia']]);

        if($request['items_seleccionados']) {

            $query->whereNotIn("con.id", explode(';', $request['items_seleccionados']));
        }

        // dd($query->toSql());

        $data = $query->get();

        return $data;
    }
}
