<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'category',
        'dose',
        'price',
        'price_pence',
        'purity',
        'subtitle',
        'formula',
        'cas_no',
        'description',
        'contents',
        'tiers',
        'details',
        'image',
        'in_stock',
        'is_active',
        'featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price_pence' => 'integer',
            'contents' => 'array',
            'tiers' => 'array',
            'details' => 'array',
            'in_stock' => 'boolean',
            'is_active' => 'boolean',
            'featured' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'peptides' => 'Peptide Vials',
            'sarms' => 'SARMs Liquid Solutions',
            'pen-kits' => 'Peptide Pen Kits',
            default => ucfirst($this->category),
        };
    }

    public function getCategoryUrlAttribute(): string
    {
        return match ($this->category) {
            'peptides' => route('peptides'),
            'sarms' => route('sarms'),
            'pen-kits' => route('pen-kits'),
            default => route('home'),
        };
    }
}

