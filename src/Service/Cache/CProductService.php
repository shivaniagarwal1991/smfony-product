<?php

namespace App\Service\Cache;

use App\Generator\Cache\Interface\IProduct;
use App\Service\Cache\Interface\ICProductService;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class CProductService implements ICProductService
{

    private $cacheProduct;
    private $pKey;

    public function __construct(IProduct $cacheProduct)
    {
        $this->cacheProduct = $cacheProduct;
        $this->fileSyatemAdapterObj = new FilesystemAdapter();
        $this->pKey = constant('App\\Constant\\ProductConstant::C_PID_KEY');
    }

    /**
     * @param string $id
     * @return null|object
     */
    public function getProductById(string $id): ?object
    {
        $this->checkHit($this->pKey . $id);

        if ($this->fileSyatemAdapterObj->hasItem($this->pKey . $id)) {
            $demoString = $this->fileSyatemAdapterObj->getItem($this->pKey . $id);
            return $demoString->get();
        }
        return null;
    }

    /**
     * @return null|array
     */
    public function getAllProduct(): ?array
    {
        $this->checkHit($this->pKey);
        if ($this->fileSyatemAdapterObj->hasItem($this->pKey)) {
            $products = [];
            $product = $this->fileSyatemAdapterObj->getItem($this->pKey);
            foreach ($product->get() as $value) {
                if ($value) {
                    array_push($products, $this->getProductById($value));
                }
            }
            return $products;
        }
        return null;
    }

    private function checkHit($key)
    {
        $product = $this->fileSyatemAdapterObj->getItem($key);
        if (!$product->isHit()) {
            $this->cacheProduct->generateCache();
        }
    }
}
