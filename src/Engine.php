<?php


namespace inisire\Toolkit\Rpc;


use Symfony\Component\Validator\Validator\ValidatorInterface;

class Engine
{
    /**
     * @var Manifest
     */
    private $manifest;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @param Manifest $manifest
     * @param ValidatorInterface $validator
     */
    public function __construct(Manifest $manifest, ValidatorInterface $validator)
    {
        $this->manifest = $manifest;
        $this->validator = $validator;
    }

    /**
     * @param $rpc
     * @param $arguments
     *
     * @return Result
     */
    public function call(string $rpc, array $arguments = []): Result
    {
        $procedure = $this->manifest->getRemoteProcedure($rpc);

        if (is_null($procedure))
        {
            return new Result([], [
                [
                    'code' => 0,
                    'message' => sprintf('The RPC "%s" doesnt exists', $rpc)
                ]
            ]);
        }

        try
        {
            $arguments = $procedure->bindArguments($arguments);

            $violations = $this->validator->validate($arguments);

            if ($violations->count() > 0)
            {
                $errors = [];

                for ($i = 0; $i < $violations->count(); $i++)
                {
                    $violation = $violations->get($i);

                    $errors[] = [
                        'message' => $violation->getMessage(),
                        'path' => $violation->getPropertyPath(),
                        'code' => $violation->getCode()
                    ];
                }

                return new Result([], $errors);
            }

            return $procedure->call($arguments);
        }
        catch (\Exception $exception)
        {
            return new Result([], [
                [
                    'message' => 'Server error',
                    'debug' => [
                        'exception' => get_class($exception),
                        'message' => $exception->getMessage(),
                        'file' => $exception->getFile(),
                        'line' => $exception->getLine()
                    ]
                ]
            ]);
        }
    }
}