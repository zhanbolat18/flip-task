<?php

namespace App\Infrastructure\Interfaces;


interface IConverter
{

    public function convert(string $pathToFile);

    public function setReader(IReader $reader);
    public function getReader(): IReader;

    public function setHandler(IHandler $handler);
    public function getHandler(): IHandler;
}