<?php

namespace App\Http\Controllers;

use App\Services\ContentService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $content = ContentService::getJson('cart');
        return view('cart', compact('content'));
    }

    public function orderConfirmation()
    {
        $content = ContentService::getJson('order_confirmation');
        return view('order-confirmation', compact('content'));
    }

    public function success()
    {
        return view('checkout.success');
    }

    public function cancel()
    {
        return view('checkout.cancel');
    }
}

