<?php

namespace App\Infrastructure\Interfaces;


interface IHandler
{
    public function handle($data);

    public function getResult();
}