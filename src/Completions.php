<?php

namespace JordanDalton\AnthropicSdkPhp;

class Completions
{
    public function __construct(public readonly AnthropicConnector $connector)
    {
        //
    }

    public function create()
    {
        return $this->connector->send(
            new Requests\CreateCompletionRequest()
        );
    }
}
