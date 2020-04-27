<?php

namespace App\Domain\Payloads;

class UnauthorizedPayload extends BasePayload
{
    protected $status = 401;

    public function getData()
    {
        return [
            'errors' => $this->data,
        ];
    }
}
