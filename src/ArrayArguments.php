<?php


namespace inisire\Toolkit\Rpc;


class ArrayArguments implements ArgumentsInterface
{
    /**
     * @var iterable
     */
    private $data;

    public function bind(iterable $data)
    {
        $this->data = $data;
    }

    /**
     * @return iterable
     */
    public function getData(): iterable
    {
        return $this->data;
    }
}