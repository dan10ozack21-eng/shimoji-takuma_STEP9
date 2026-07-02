<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'description',
        'img_path'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function scopeExcludeMine(Builder $query): Builder
    {
        if (Auth::check()) {
            return $query->where('user_id', '!=', Auth::id());
        }
        return $query;
    }

    public function scopeGetAvailableList(Builder $query): Builder
    {
        return $query->with('company')->excludeMine()->orderBy('id', 'asc');
    }

    public function scopeSearchFilter(Builder $query, array $filters): Builder
    {
        $query->with('company')->excludeMine();

        if (!empty($filters['product_name'])) {
            $query->where('product_name', 'like', '%' . $filters['product_name'] . '%');
        }

        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        return $query->orderBy('id', 'asc');
    }

    public static function findWithRelations(int $id, array $relations = ['company']): self
    {
        return self::with($relations)->findOrFail($id);
    }

    public function scopeGetMyproducts(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId)->orderBy('id', 'asc');
    }

    public static function createProduct(array $data, ?string $imagePath, int $userId): self
    {
        return self::create([
            'user_id' => $userId,
            'company_id' => 1, 
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'description' => $data['description'] ?? null,
            'img_path' => $imagePath,
        ]);
    }

    public static function updateProductInfo(int $id, array $data, ?string $imagePath): void
    {
        $product = self::findOrFail($id);

        $updateData = [
            'product_name' => $data['product_name'],
            'price'        => $data['price'],
            'description'  => $data['description'],
            'stock'        => $data['stock'],
        ];

        if ($imagePath) {
            $updateData['img_path'] = $imagePath;
        }

        $product->update($updateData);
    }

    public static function deleteProduct(int $id): void
    {
        $product = self::findOrFail($id);
        $product->delete();
    }
}
