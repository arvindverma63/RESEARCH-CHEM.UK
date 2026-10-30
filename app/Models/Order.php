<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref',
        'customer_name',
        'customer_email',
        'customer_phone',
        'address_line1',
        'address_line2',
        'city',
        'postcode',
        'country',
        'items',
        'subtotal_pence',
        'shipping_pence',
        'discount_pence',
        'total_pence',
        'payment_method',
        'status',
        'customer_notes',
        'admin_notes',
        'placed_at',
    ];

    protected $casts = [
        'items' => 'array',
        'subtotal_pence' => 'integer',
        'shipping_pence' => 'integer',
        'discount_pence' => 'integer',
        'total_pence' => 'integer',
        'placed_at' => 'datetime',
    ];

    public function getTotalFormattedAttribute(): string
    {
        return '£' . number_format($this->total_pence / 100, 2);
    }

    public function getSubtotalFormattedAttribute(): string
    {
        return '£' . number_format($this->subtotal_pence / 100, 2);
    }

    public function getShippingFormattedAttribute(): string
    {
        return $this->shipping_pence > 0 ? ('£' . number_format($this->shipping_pence / 100, 2)) : 'Free';
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'bg-amber-100 text-amber-800 border-amber-300',
            'processing' => 'bg-blue-100 text-blue-800 border-blue-300',
            'dispatched' => 'bg-purple-100 text-purple-800 border-purple-300',
            'completed' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            'cancelled' => 'bg-rose-100 text-rose-800 border-rose-300',
            default => 'bg-slate-100 text-slate-800 border-slate-300',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Payment Pending',
            'processing' => 'Processing',
            'dispatched' => 'Dispatched',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            default => ucfirst($this->status),
        };
    }
}

