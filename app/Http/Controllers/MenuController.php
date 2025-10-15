<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Platillo;

class MenuController extends Controller
{
    public function menu()
    {
        $comidas = Categoria::where('slug', 'comidas')->firstOrFail();
        $bebidas = Categoria::where('slug', 'bebidas')->firstOrFail();

        $foods  = Platillo::where('categoria_id', $comidas->id)->take(9)->get();
        $drinks = Platillo::where('categoria_id', $bebidas->id)->take(6)->get();

        return view('menu', compact('foods', 'drinks'));
    }
}
