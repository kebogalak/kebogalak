<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkm';

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'phone',
        'email',
        'description',
        'logo',
        'status',
    ];

    /**
     * Get the user that owns the UMKM.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the products for the UMKM.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Check if UMKM is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }
}
