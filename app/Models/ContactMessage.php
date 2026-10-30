<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'ip_address',
        'status',
        'source',
        'admin_notes',
    ];

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'new' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            'in_progress' => 'bg-amber-100 text-amber-800 border-amber-300',
            'replied' => 'bg-blue-100 text-blue-800 border-blue-300',
            'archived' => 'bg-slate-100 text-slate-800 border-slate-300',
            default => 'bg-slate-100 text-slate-800 border-slate-300',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'new' => 'New Lead',
            'in_progress' => 'In Progress',
            'replied' => 'Replied',
            'archived' => 'Archived',
            default => ucfirst($this->status),
        };
    }
}

