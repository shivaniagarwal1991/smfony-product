<?php

namespace App\Reader;

class XmlParser
{
    /**
     * @param string $filename
     * @return array
     */
    public function prepareData(string $filename): array
    {
        $fileLoaderObj = new FileLoader();
        $content = $fileLoaderObj->loadFile($filename);
        $xml = simplexml_load_file($content, 'SimpleXMLElement', LIBXML_NOCDATA);
        $json = json_encode($xml);
        return json_decode($json, TRUE);
    }
}
