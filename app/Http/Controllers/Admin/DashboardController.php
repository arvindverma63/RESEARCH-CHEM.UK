<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'peptides_count' => Product::where('category', 'peptides')->count(),
            'sarms_count' => Product::where('category', 'sarms')->count(),
            'pen_kits_count' => Product::where('category', 'pen-kits')->count(),
            'in_stock_count' => Product::where('in_stock', true)->count(),
            'out_of_stock_count' => Product::where('in_stock', false)->count(),

            // Order & Lead stats
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'processing_orders' => Order::where('status', 'processing')->count(),
            'dispatched_orders' => Order::where('status', 'dispatched')->count(),
            'total_revenue_pence' => Order::whereIn('status', ['processing', 'dispatched', 'completed'])->sum('total_pence'),
            'total_leads' => ContactMessage::count(),
            'new_leads' => ContactMessage::where('status', 'new')->count(),
        ];

        $recentOrders = Order::orderBy('created_at', 'desc')->take(5)->get();
        $recentLeads = ContactMessage::orderBy('created_at', 'desc')->take(5)->get();
        $recentProducts = Product::orderBy('updated_at', 'desc')->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'recentLeads', 'recentProducts'));
    }
}


