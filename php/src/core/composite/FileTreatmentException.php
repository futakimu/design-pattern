<?php


namespace DP\core\composite;

use RuntimeException;
use Throwable;

class FileTreatmentException extends RuntimeException
{
    /**
     * FileTreatmentException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}