<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RemoteWbClient
{
    private string $host;
    private string $key;
    private int $timeout;

    public function __construct()
    {
        $this->host = config('wb_sync.host');
        $this->key = config('wb_sync.key');
        $this->timeout = config('wb_sync.timeout');
    }

    public function fetch(string $endpoint, array $params = []): array
    {
        $params['key'] = $this->key;

        return Http::timeout($this->timeout)
            ->get("http://{$this->host}/api/{$endpoint}", $params)
            ->throw()
            ->json();
    }
}