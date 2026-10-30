<?php

namespace App\Http\Controllers;

use App\Services\ContentService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $content = ContentService::getHome();
        return view('home', compact('content'));
    }
}

