<?php

namespace App\Models;

use Carbon\Carbon;
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

    public static function importProductsFromApi(mixed $products, $massive = true): void
    {
        if ($massive) {
            foreach ($products as $product) {
                self::create(
                    [
                        'name' => $product->title,
                        'price' => $product->price,
                        'description' => $product->description,
                        'category' => $product->category,
                        'image_url' => $product->image,
                        'created_at' => Carbon::now()
                    ]
                );
            }
        } else {
            self::create(
                [
                    'name' => $products->title,
                    'price' => $products->price,
                    'description' => $products->description,
                    'category' => $products->category,
                    'image_url' => $products->image,
                    'created_at' => Carbon::now()
                ]
            );
        }
    }
}
