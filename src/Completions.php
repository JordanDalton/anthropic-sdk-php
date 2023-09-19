<?php

namespace JordanDalton\AnthropicSdkPhp;

class Completions
{
    public function __construct(public readonly AnthropicConnector $connector)
    {
        //
    }

    public function create(
        string $prompt = "\n\nHuman:Say Hi\n\nAssistant:",
        string $model = 'claude-2',
        int $max_tokens_to_sample = 256,
        int $temperature = 1,
        array $stop_sequences = [],
        float $top_p = 0.7,
        int $top_k = 5,
        array $metadata = [],
        bool $stream = false
    ) {
        return $this->connector->send(
            new Requests\CreateCompletionRequest(
                $prompt,
                $model,
                $max_tokens_to_sample,
                $temperature,
                $stop_sequences,
                $top_p,
                $top_k,
                $metadata,
                $stream
            )
        );
    }
}
