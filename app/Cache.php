<?php
namespace PostsApi;
use Carbon\Carbon;

class Cache
{
    public static function save(string $key, string $data, int $ttl = 120): void
    {
        $cacheFile = '../cache/' . $key;
        file_put_contents($cacheFile, json_encode([
            'expires_at' => Carbon::now()->addSecond($ttl),
            'content' => $data
        ]));
    }

    public static function delete(string $key): void
    {
        unlink('../cache/' . $key);
    }

    public static function ifHas(string $key): bool
    {
        if (!file_exists('../cache/' . $key)) {
            return false;
        }
        $content = json_decode(file_get_contents('../cache/' . $key));
        return Carbon::now() < $content->expires_at;
    }

    public static function get(string $key): string
    {
        $content = json_decode(file_get_contents('../cache/' . $key));
        return $content->content;
    }
}