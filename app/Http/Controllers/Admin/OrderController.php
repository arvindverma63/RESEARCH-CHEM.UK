<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query()->orderBy('created_at', 'desc');

        $status = $request->get('status', 'all');
        if ($status !== 'all' && in_array($status, ['pending', 'processing', 'dispatched', 'completed', 'cancelled'])) {
            $query->where('status', $status);
        }

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('ref', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('postcode', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(15)->withQueryString();

        // Statistics
        $counts = [
            'all' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'dispatched' => Order::where('status', 'dispatched')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        $totalRevenuePence = Order::whereIn('status', ['processing', 'dispatched', 'completed'])->sum('total_pence');

        return view('admin.orders.index', compact('orders', 'counts', 'status', 'totalRevenuePence'));
    }

    public function show(int $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, int $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,dispatched,completed,cancelled',
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        $order->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $order->admin_notes,
        ]);

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', "Order #{$order->ref} updated to status '{$order->status_label}'.");
    }

    public function destroy(int $id)
    {
        $order = Order::findOrFail($id);
        $ref = $order->ref;
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', "Order #{$ref} was permanently deleted.");
    }
}

