<?php


namespace inisire\Toolkit\Rpc;


class Engine
{
    /**
     * @var Manifest
     */
    private $manifest;

    public function __construct(Manifest $manifest)
    {
        $this->manifest = $manifest;
    }

    public function call($rpc, $arguments): Result
    {
        $endpoint = $this->manifest->getEndpoint($rpc);

        $arguments = $endpoint->bindArguments($arguments);

        return $endpoint->call($arguments);
    }
}