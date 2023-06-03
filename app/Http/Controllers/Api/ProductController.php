<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreUpdateRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Lista produtos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $products = Product::all();
        } catch (\Exception $e) {
            return response()->json(
                [
                    'data' => [],
                    'message' => $e->getMessage()
                ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return response()->json(
            [
                'data' => $products,
                'message' => 'success'
            ],
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Cria um novo produto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreUpdateRequest $request)
    {
        try {
            $product = Product::create(
                [
                    'name' => $request->name,
                    'price' => $request->price,
                    'description' => $request->description,
                    'category' => $request->category,
                    'image_url' => $request->image_url
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'data' => [],
                    'message' => $e->getMessage()
                ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return response()->json(
            [
                'data' => $product,
                'message' => 'success'
            ],
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Busca um produto específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::find($id);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'data' => [],
                    'message' => $e->getMessage()
                ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return response()->json(
            [
                'data' => $product,
                'message' => 'success'
            ],
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Atualiza um produto específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductStoreUpdateRequest $request, $id)
    {
        try {
            $product = Product::find($id)->update($request->all());
        } catch (\Exception $e) {
            return response()->json(
                [
                    'data' => [],
                    'message' => $e->getMessage()
                ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return response()->json(
            [
                'data' => $product,
                'message' => 'success'
            ],
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Remove um produto.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::destroy($id);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'data' => [],
                    'message' => $e->getMessage()
                ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return response()->json(
            [
                'data' => $product,
                'message' => 'success'
            ],
            JsonResponse::HTTP_OK
        );
    }
}
