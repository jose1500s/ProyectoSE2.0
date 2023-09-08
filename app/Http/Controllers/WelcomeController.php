<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\YourExport;

class WelcomeController extends Controller
{
    public function exportExcelBecas()
    {
        return Excel::download(new YourExport, 'prueba.xlsx');
    }
}