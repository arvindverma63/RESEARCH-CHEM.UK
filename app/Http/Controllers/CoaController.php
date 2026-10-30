<?php

namespace App\Http\Controllers;

use App\Services\ContentService;
use Illuminate\Http\Request;

class CoaController extends Controller
{
    public function index()
    {
        $categories = ContentService::getCoaData();
        return view('coa', compact('categories'));
    }
}

