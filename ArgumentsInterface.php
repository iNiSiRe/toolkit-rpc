<?php


namespace inisire\Toolkit\Rpc;


interface ArgumentsInterface
{
    public function bind(iterable $data);
}