<?php

namespace JordanDalton\AnthropicSdkPhp\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateCompletionRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $prompt  The model that will complete your prompt.
     * @param  string  $model  The prompt that you want Claude to complete.
     * @param  int  $max_tokens_to_sample  The maximum number of tokens to generate before stopping.
     * @param  array<string>  $stop_sequences  Sequences that will cause the model to stop generating completion text.
     * @param  int  $temperature  Amount of randomness injected into the response.
     * @param  float  $top_p  Use nucleus sampling.
     * @param  int  $top_k  Only sample from the top K options for each subsequent token.
     * @param  array  $metadata  An object describing metadata about the request.
     * @param  bool  $stream  Whether to incrementally stream the response using server-sent events.
     */
    public function __construct(
        public readonly string $prompt = "\n\nHuman:Say Hi\n\nAssistant:",
        public readonly string $model = 'claude-2',
        public readonly int $max_tokens_to_sample = 256,
        public readonly int $temperature = 1,
        public readonly array $stop_sequences = [],
        public readonly float $top_p = 0.7,
        public readonly int $top_k = 5,
        public readonly array $metadata = [],
        public readonly bool $stream = false
    ) {
        //
    }

    public function resolveEndpoint(): string
    {
        return 'complete';
    }

    public function defaultBody(): array
    {
        if (! isset($metadata['user_id'])) {
            $metadata['user_id'] = uniqid();
        }

        return [
            'model' => 'claude-2',
            'prompt' => $this->prompt,
            'max_tokens_to_sample' => $this->max_tokens_to_sample,
            'temperature' => $this->temperature,
            'top_p' => $this->top_p,
            'top_k' => $this->top_k,
            'stop_sequences' => $this->stop_sequences,
            'metadata' => $this->metadata,
            'stream' => $this->stream,
        ];
    }
}
