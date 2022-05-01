<?php

namespace App\Service\Interface;

interface IProductService
{
    /**
     * @param string $id
     * @return object
     */
    public function getProductById(string $id): object;

    /**
     * @return array
     */
    public function getAllProducts(): array;
}
