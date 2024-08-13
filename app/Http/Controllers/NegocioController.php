<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Business;
use App\Models\Queja;
use App\Models\Product;

class NegocioController extends Controller
{
    public function index(Request $request)
    {
        // Verificar si hay una categoría y asignarla a la variable, si no, dejarla como null
        $categ = $request->categ ?? null;
    
        // Construir la consulta
        $productos = Product::select('products.*', 'products.updated_at')
            ->where('prd_status', '01') // Simplificado el operador '='
            ->when($categ, function ($query) use ($categ) {
                return $query->where('prd_type', 'like', "%$categ%");
            })
            ->orderByDesc('products.updated_at') // Utilizado orderByDesc para mayor claridad
            ->get();
    
        return $productos;

    }

    public function getproducto($id)
    {
        $productos = Product::where('prd_business','=', $id)
        ->where('prd_status','=', '01')
        ->get();
        return $productos;
    }

    public function getAllProducto(Request $request)
    {
        // Verificar si hay una categoría y asignarla a la variable, si no, dejarla como null
        $categ = $request->categ ?? null;
    
        // Construir la consulta
        $productos = Product::select('products.*', 'products.updated_at')
            ->where('prd_status', '01') // Simplificado el operador '='
            ->when($categ, function ($query) use ($categ) {
                return $query->where('prd_type', 'like', "%$categ%");
            })
            ->orderByDesc('products.updated_at') // Utilizado orderByDesc para mayor claridad
            ->get();
    
        return $productos;
    }
    
    

    public function getquejas($id)
    {
        $quejas = Queja::where('qjs_business','=', $id)
        ->where('qjs_status','=', '1')
        ->get();
        return $quejas;
    }
}

