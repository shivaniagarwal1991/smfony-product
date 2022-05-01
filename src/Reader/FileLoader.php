<?php

namespace App\Reader;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class FileLoader
{
    /**
     * @param string $filename
     * @return null|string
     */
    public function loadFile(string $filename): ?string
    {

        try {
            $fileDirectories = [constant('App\\Constant\\ProductConstant::PRODUCT_DIRECTORY')];
            $fileLocator = new FileLocator($fileDirectories);
            $resource = $fileLocator->locate($filename, null, false);

            if ($resource && is_array($resource)) {
                return $resource[0];
            }
        } catch (FileNotFoundException $e) {
            echo "File Not Found Exception Occur -- " . $e->getMessage() . "<br/>";
        }
        return null;
    }
}
