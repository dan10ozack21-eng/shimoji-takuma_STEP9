<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public static function toggleLike(int $userId, int $productId): void
    {
        $like =self::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($like) {
            $like->delete();
        } else {
            self::create([
                'user_id' => $userId,
                'product_id' => $id,
            ]);
        }
    }
}
