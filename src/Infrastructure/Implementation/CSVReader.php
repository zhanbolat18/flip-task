<?php


namespace App\Infrastructure\Implementation;


use App\Infrastructure\Interfaces\IReader;
use App\Infrastructure\Interfaces\IResource;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class CSVReader implements IReader
{
    public function open(string $pathToFile): IResource
    {
        if (!file_exists($pathToFile) || !is_file($pathToFile) ) {
            throw new InvalidArgumentException('File not found');
        }

        return new CSVResource(fopen($pathToFile,'r'));
    }

    public function close(IResource $resource)
    {
        fclose($resource->getOpenedResource());
    }
}