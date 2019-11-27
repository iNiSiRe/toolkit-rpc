<?php


namespace inisire\Toolkit\Rpc;


abstract class Manifest
{
    abstract public function getEndpoint(string $name): Endpoint;
}