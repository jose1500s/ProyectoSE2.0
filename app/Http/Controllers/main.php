<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class main extends Controller
{
    public function perfil() {
        return Inertia::render('Profile/Show');
    }
}
