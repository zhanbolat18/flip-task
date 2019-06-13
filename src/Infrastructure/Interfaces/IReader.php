<?php


namespace App\Infrastructure\Interfaces;


interface IReader
{
    public function open(string $pathToFile) : IResource;
    public function close(IResource $resource);
}