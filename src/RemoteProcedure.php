<?php


namespace inisire\Toolkit\Rpc;


abstract class RemoteProcedure
{
    protected function createArgumentsContainer(): ArgumentsInterface
    {
        return new ArrayArguments();
    }

    public function bindArguments(iterable $arguments): ArgumentsInterface
    {
        $object = $this->createArgumentsContainer();

        $object->bind($arguments);

        return $object;
    }

    abstract public function call(ArgumentsInterface $arguments): Result;

    abstract public function getName(): string;
}