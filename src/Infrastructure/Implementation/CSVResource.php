<?php
namespace App\Infrastructure\Implementation;

use App\Infrastructure\Interfaces\IResource;

class CSVResource implements IResource
{
    /**
     * @var resource
     */
    private $resource;
    /**
     * @var int
     */
    private $length = 0;
    /**
     * @var string
     */
    private $delimiter = ',';
    /**
     * @var string
     */
    private $enclosure = '"';
    /**
     * @var string
     */
    private $escape = '\\';

    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    /**
     * @param int $length
     */
    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    /**
     * @param string $escape
     */
    public function setEscape(string $escape): void
    {
        $this->escape = $escape;
    }

    /**
     * @param string $enclosure
     */
    public function setEnclosure(string $enclosure): void
    {
        $this->enclosure = $enclosure;
    }

    /**
     * @param string $delimiter
     */
    public function setDelimiter(string $delimiter): void
    {
        $this->delimiter = $delimiter;
    }

    public function setOpenedResource($resource)
    {
        $this->resource = $resource;
    }

    public function getOpenedResource()
    {
        return $this->resource;
    }

    public function loopByLine() : \Generator
    {
        while(false !== (
                $line = fgetcsv(
                    $this->resource,
                    $this->length,
                    $this->delimiter,
                    $this->enclosure,
                    $this->escape
                )
            )
        ){
            yield $line;
        }
    }

    public function getFirstLine()
    {

    }
}