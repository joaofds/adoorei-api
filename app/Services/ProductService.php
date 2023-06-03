<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Product;

class ProductService
{
    /**
     * Base API url.
     *
     * @var string
     */
    private string $apiUrl = 'https://fakestoreapi.com';

    /**
     * Cliente HTTP Guzzle.
     *
     * @var Client
     */
    private Client $http;

    public function __construct(Client $client)
    {
        $this->http = $client;
    }

    /**
     * Busca produtos na api externa e retorna.
     *
     * @param integer|null $id
     * @return mixed
     */
    public function getProductsFromApi(int $id = null): void
    {
        $response = $this->http->get($this->apiUrl . "/products/{$id}");

        $result = $response->getBody();
        $products = json_decode($result);

        Product::importProductsFromApi($products, $id ? false : true);
    }
}
