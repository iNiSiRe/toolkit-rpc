<?php


namespace inisire\Toolkit\Rpc;


abstract class Manifest
{
    abstract public function getRemoteProcedure(string $name): ?RemoteProcedure;
}