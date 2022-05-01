<?php

namespace App\Generator\Cache;

use App\Reader\JsonParser;
use App\Reader\XmlParser;

class DataGenerator
{
    private $jsonFileContent;
    private $preparedData = [];

    public function prepareData()
    {
        $jsonParser = new JsonParser();
        $this->jsonFileContent = $jsonParser->prepareData(constant('App\\Constant\\ProductConstant::FILE_PRICES_JSON'));

        $xmlParser = new XmlParser();
        $xmlFileContent = $xmlParser->prepareData(constant('App\\Constant\\ProductConstant::FILE_PRODUCTS_XML'));
        $this->fetchXmlData($xmlFileContent);

        return $this->preparedData;
    }

    private function fetchXmlData($xmlFileContent)
    {
        foreach ($xmlFileContent['Product'] as $productValue) {
            $products = new \stdClass;
            $products->id = $productValue['@attributes']['id'];
            $products->Name = $productValue['Name'];
            $products->sku = $productValue['sku'];
            $products->priceDetail = $this->fetchJsonDataWithId($productValue['sku']);
            $products->Description = $productValue['Description'];
            array_push($this->preparedData, $products);
        }
    }

    private function fetchJsonDataWithId($id)
    {
        $priceDetail = [];
        foreach ($this->jsonFileContent as $jsonValue) {
            if ($jsonValue->id == $id) {
                $priceDetailObject = new \stdClass;
                $priceDetailObject->price = $jsonValue->price;
                $priceDetailObject->unit = $jsonValue->unit;
                array_push($priceDetail, $priceDetailObject);
            }
        }
        return $priceDetail;
    }
}
