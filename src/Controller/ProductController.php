<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Service\Interface\IProductService;

class ProductController extends AbstractController
{
    private $productService;

    public function __construct(IProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @Route("/products/{id}", name="getById", methods="GET")
     * */
    public function getById($id): JsonResponse
    {
        return new JsonResponse($this->productService->getProductById($id));
    }

    /**
     * @Route("/products", name="getAll", methods="GET")
     * */
    public function getAll(): JsonResponse
    {
        $result = $this->productService->getAllProducts();
        return new JsonResponse(['total_products' => count($result), 'products' => $result]);
    }
}
