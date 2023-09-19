<?php

namespace JordanDalton\AnthropicSdkPhp;

use Saloon\Http\Connector;

class AnthropicConnector extends Connector
{
    public function __construct(public readonly string $api_key)
    {
        //
    }

    public function resolveBaseUrl(): string
    {
        return 'https://api.anthropic.com/v1/';
    }

    public function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'ANTHROPIC-VERSION' => '2023-06-01',
            'X-API-KEY' => $this->api_key,
        ];
    }

    public function completions(): Completions
    {
        return new Completions($this);
    }
}
