<?php

namespace App\Domain\Payloads;

class ValidationFailedPayload extends BasePayload
{
    protected $status = 422;

    public function getData()
    {
        return [
            'errors' => $this->data,
        ];
    }
}
