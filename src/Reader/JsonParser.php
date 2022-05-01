<?php

namespace App\Reader;

class JsonParser
{
    /**
     * @param string $filename
     * @return null|array
     */
    public function prepareData($filename): ?array
    {
        $fileLoaderObj = new FileLoader();
        $content = $fileLoaderObj->loadFile($filename);
        if ($content) {
            return json_decode(file_get_contents($content));
        }
        return null;
    }
}
