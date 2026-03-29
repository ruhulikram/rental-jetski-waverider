<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jetski_package_id',
        'booking_date',
        'booking_time',
        'total_price',
        'status',
        'payment_status',
        'payment_method',
        'transaction_id',
        'snap_token',
        'snap_token_created_at',
        'paid_at',
        'booking_code',
        'notes',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'booking_time' => 'datetime:H:i',
        'total_price' => 'float',
        'snap_token_created_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jetskiPackage()
    {
        return $this->belongsTo(JetskiPackage::class);
    }

    public function getFormattedTotalPriceAttribute()
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }
}
