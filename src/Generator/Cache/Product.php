<?php

namespace App\Generator\Cache;

use App\Generator\Cache\Interface\IProduct;
use App\Generator\Cache\DataGenerator;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class Product implements IProduct
{
    public function generateCache()
    {
        $cache = new FilesystemAdapter();
        $dataGenerator =  new DataGenerator();
        $data = $dataGenerator->prepareData();
        $pKey = constant('App\\Constant\\ProductConstant::C_PID_KEY');
        $productSkus = [];
        foreach ($data as $key => $value) {
            $id = $data[$key]->sku;
            $this->setCache($cache, $pKey . $id, $data[$key]);
            array_push($productSkus, $id);
        }
        $productSkus = array_unique($productSkus);
        $this->setCache($cache, $pKey, $productSkus);
    }

    private function setCache($cache, $key, $value)
    {
        $product = $cache->getItem($key);
        $product->set($value);
        $product->expiresAt(new \DateTime('tomorrow'));
        $cache->save($product);
    }
}
