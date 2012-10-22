<?php

namespace Promise;

/**
 * A Promise in resolved state.
 */
class ResolvedPromise implements PromiseInterface
{
    /**
     * @var mixed
     */
    private $result;

    /**
     * Constructor
     *
     * @param mixed $result
     */
    public function __construct($result = null)
    {
        $this->result = $result;
    }

    /**
     * {@inheritDoc}
     */
    public function then($fulfilledHandler = null, $errorHandler = null, $progressHandler = null)
    {
        try {
            $result = $this->result;
            if ($fulfilledHandler) {
                $result = call_user_func($fulfilledHandler, $result);
            }

            return Util::resolve($result);
        } catch (\Exception $exception) {
            return new RejectedPromise($exception);
        }
    }
}
