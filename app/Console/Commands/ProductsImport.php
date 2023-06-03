<?php

namespace App\Console\Commands;

use App\Services\ProductService;
use Illuminate\Console\Command;

class ProductsImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import 
                            {--id= : Importa um produto específico}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importar produtos da api externa.';

    /**
     * Provedor de Serviço para Produtos.
     *
     * @var ProductService
     */
    private ProductService $productService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->productService
        ->getProductsFromApi($this->option('id'));
    }
}
