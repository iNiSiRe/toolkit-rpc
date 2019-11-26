<?php


namespace inisire\Toolkit\Rpc;


class Result
{
    /**
     * @var iterable
     */
    private $data;

    /**
     * @var iterable
     */
    private $errors;

    public function __construct(iterable $data, iterable $errors = [])
    {
        $this->data = $data;
        $this->errors = $errors;
    }

    /**
     * @return iterable
     */
    public function getData(): iterable
    {
        return $this->data;
    }

    /**
     * @return iterable
     */
    public function getErrors(): iterable
    {
        return $this->errors;
    }
}