<?php

namespace App\Service;

use App\Service\Interface\IProductService;
use App\Service\Cache\Interface\ICProductService;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductService implements IProductService
{

    private $cacheProductService;

    public function __construct(ICProductService $cacheProductService)
    {
        $this->cacheProductService = $cacheProductService;
    }

    /**
     * @param string $id
     * @return object
     */
    public function getProductById(string $id): object
    {
        if (empty($id)) {
            throw new BadRequestException("Product Id is missing.");
        }

        $product = $this->cacheProductService->getProductById($id);

        if ($product) {
            return $product;
        }
        throw new NotFoundHttpException("There is no Product of id :" . $id);
    }

    public function getAllProducts(): array
    {
        $products = $this->cacheProductService->getAllProduct();

        if (!empty($products)) {
            return $products;
        }
        throw new NotFoundHttpException("There is no Products");
    }
}
