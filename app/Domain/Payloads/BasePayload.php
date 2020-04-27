<?php

namespace App\Domain\Payloads;

abstract class BasePayload
{
    protected $data;
    protected $status = 200;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
