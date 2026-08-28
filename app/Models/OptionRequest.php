<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionRequest extends Model
{
    protected $fillable = [
        'product_id',
        'product_name',
        'first_name',
        'last_name',
        'company',
        'email',
        'phone',
        'country',
        'state',
        'city',
        'postal_code',
        'message',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /** Convenience: "First Last" for lists and detail views. */
    public function getFullNameAttribute(): string
    {
        return trim($this->first_name.' '.$this->last_name);
    }
}
