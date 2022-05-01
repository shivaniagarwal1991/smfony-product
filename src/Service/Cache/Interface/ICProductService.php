<?php

namespace App\Service\Cache\Interface;

interface ICProductService
{
    /**
     * @param string $id
     * @return null|object
     */
    public function getProductById(string $id): ?object;

    /**
     * @return null|array
     */
    public function getAllProduct(): ?array;
}
