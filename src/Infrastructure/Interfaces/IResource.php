<?php

namespace App\Infrastructure\Interfaces;


interface IResource
{

    public function setOpenedResource($resource);
    public function getOpenedResource();

    public function getFirstLine();
    public function loopByLine(): \Generator;
}