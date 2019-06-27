<?php
namespace App\Services;

use Crypt;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PurChecker
{
    protected $endpoint = 'https://sales.gitbench.com/verify';

    public function exec()
    {
        if (urlAccessible($this->endpoint) && !isDemo()) {
            return $this->queryPur();
        }
    }

    private function queryPur()
    {
        $client   = new Client();
        $response = $client->get($this->endpoint . '?code=' . request('code'));
        $response = collect(json_decode($response->getBody()->getContents()));
        if ($response->has('error')) {
            $this->invalidate();
            return false;
        }
        if ($response->has('item_id')) {
            return $this->activateApp($response);
        }
        return false;
    }
    private function activateApp(Collection $response)
    {
        return \Storage::put('verified.json', Crypt::encryptString($response->toJson()));
    }

    private function invalidate()
    {
        if (\Storage::exists('verified.json')) {
            \Storage::delete('verified.json');
        }
    }
}
