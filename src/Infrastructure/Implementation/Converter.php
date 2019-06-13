<?php
namespace App\Infrastructure\Implementation;

use App\Infrastructure\Interfaces\IConverter;
use App\Infrastructure\Interfaces\IHandler;
use App\Infrastructure\Interfaces\IReader;
use App\Infrastructure\Interfaces\OutputXmlData;

class Converter implements IConverter
{
    /**
     * @var IReader
     */
    private $reader;
    /**
     * @var Handler
     */
    private $handler;

    private $onConvert = null;

    public function __construct(IReader $reader, IHandler $handler)
    {
        $this->reader = $reader;
        $this->handler = $handler;
    }

    public function convert(string $pathToFile)
    {
        /** @var CSVResource $resource */
        $resource = $this->reader->open($pathToFile);
        $resource->setDelimiter(';');
        $generator = $resource->loopByLine();


        $this->handler->setFirstLine($generator->current());
        $generator->next();

        while ($field = $generator->current()) {
            $this->handler->handle($field);
            $generator->next();
        }
        return $this->handler->getResult();
    }

    public function onConvert(callable $fn)
    {
        $this->onConvert = $fn;
    }

    public function setReader(IReader $reader)
    {
        $this->reader = $reader;
    }

    public function getReader(): IReader
    {
        return $this->reader;
    }

    public function setHandler(IHandler $handler)
    {
        $this->handler = $handler;
    }

    public function getHandler(): IHandler
    {
        return $this->handler;
    }
}