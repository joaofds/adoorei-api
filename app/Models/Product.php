<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'category',
        'image_url'
    ];

    /**
     * Busca produtos pelos parâmetros passados na url.
     *
     * @param object $request
     * @return Collection
     */
    public static function getProductsByQuery(object $request): Collection
    {
        $query = self::query();

        // busca por nome
        if ($request->has('name')) {
            $query->where('name', '=', $request->name);
        }

        // busca por categoria
        if ($request->has('category')) {
            $query->where('category', '=', $request->category);
        }

        // busca produtos com ou sem imagem
        if ($request->has('image_url')) {
            $query->whereNotNull('image_url')
            ->orWhere('image_url', '<>', '');
        }

        // busca produto pelo id
        if ($request->has('id')) {
            $query->where('id', '=', $request->id);
        }

        $products = $query->get();
        return $products;
    }
}
