<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    protected $table = 'sales';

    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public static function executePurchase(int $productId, int $quantity, ?int $userId): void
    {
        DB::transaction(function () use ($productId, $quantity, $userId) {
            \App\Models\Product::where('id', $productId)->decrement('stock', $quantity);

            self::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        });
    }

    public static function getMyPurchaseHistory(int $userId)
    {
        return self::with('product')
        ->where('user_id', $userId)
        ->orderBy('created_at', 'asc')
        ->get();
    }
}
