<?php

use JordanDalton\AnthropicSdkPhp\AnthropicConnector;
use Saloon\Http\Faking\MockResponse;

it('can successfully call anthropic completion api', function () {

    $mock_client = new \Saloon\Http\Faking\MockClient([
        MockResponse::make([
            'completion' => ' Hello!',
            'stop_reason' => 'stop_sequence',
            'model' => 'claude-2.0',
            'stop' => "\n\nHuman:",
            'log_id' => '1A2B3C4D5E6F7G8H9I0J',
        ], 200),
    ]);

    $connector = AnthropicConnector::make('TEST-KEY')
        ->withMockClient($mock_client)
        ->completions()
        ->create();

    $output = $connector->json();

    expect($output)->toHaveKey('completion');
    expect($output)->toHaveKey('stop_reason');
    expect($output)->toHaveKey('model');
    expect($output)->toHaveKey('stop');
    expect($output)->toHaveKey('log_id');

    expect($output['completion'])->toBeString();
    expect($output['stop_reason'])->toBeString();
    expect($output['model'])->toBeString();
    expect($output['stop'])->toBeString();
    expect($output['log_id'])->toBeString();
});
