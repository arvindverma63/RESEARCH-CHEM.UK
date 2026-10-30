<?php

namespace App\Http\Controllers;

use App\Services\ContentService;
use Illuminate\Http\Request;

class ComplianceController extends Controller
{
    public function index()
    {
        $content = ContentService::getCompliance();
        return view('compliance', compact('content'));
    }
}

