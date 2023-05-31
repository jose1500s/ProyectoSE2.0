<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class BecasController extends Controller
{
    public function becas(){
        return Inertia::render('menusComponentes/Becas');
     }
}
