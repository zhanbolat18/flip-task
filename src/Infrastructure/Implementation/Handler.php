<?php
namespace App\Infrastructure\Implementation;

use App\Infrastructure\Interfaces\IHandler;
use App\Infrastructure\Interfaces\InputCsvData;
use App\Infrastructure\Interfaces\OutputXmlData;
use DOMDocument;

class Handler implements IHandler
{
    CONST COURSE = 5.9;

    private $document;
    private $items;

    private $headers = [];
    private $handlers = [
        'код' => 'codeHandler',
        'цена' => 'priceHandler'
    ];

    public function __construct()
    {
        $this->document = new DOMDocument('1.0');
        $this->items = $this->document->createElement('items');
    }

    public function handle($data)
    {
        $item = $this->document->createElement('item');
        foreach ($data as $key => $value ) {
            $method = $this->handlers[ $this->headers[$key] ];
            $item->appendChild($this->$method($value));
        }
        $this->items->appendChild($item);
    }

    /**
     * @return DOMDocument
     */
    public function getResult()
    {
        $this->document->appendChild($this->items);
        return $this->document;
    }

    /**
     * @param array $lineHeaders
     */
    public function setFirstLine( array $lineHeaders)
    {
        $lineHeaders = array_map('mb_strtolower',
            array_map('trim', $lineHeaders)
        );
        $this->headers = $lineHeaders;
    }

    private function codeHandler($code)
    {
        if (0 !== preg_match('/([0-9]+)-([a-zA-Z]+)/', $code, $matches)) {
            $code = $matches[2] . '-' . $matches[1];
        }
        return $this->document->createElement('code',$code);
    }

    private function priceHandler($price)
    {
        $price = intval($price) * self::COURSE;
        return $this->document->createElement('price', $price);
    }

}