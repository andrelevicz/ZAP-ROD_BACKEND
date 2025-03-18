<?php

namespace App\Exceptions;

use Exception;

class EvolutionApiException extends Exception
{
    protected $code = 500;
    
    public function __construct(
        string $message = 'Evolution API Error',
        int $code = 0,
        private array $details = []
    ) {
        parent::__construct($message, $code);
    }

    public function render()
    {
        return response()->json([
            'error' => $this->getMessage(),
            'code' => $this->code,
            'details' => $this->details
        ], $this->code);
    }
}