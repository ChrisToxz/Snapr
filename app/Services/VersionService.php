<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class VersionService
{
    protected const CACHE_KEY = 'app_version';

    public function getVersionData(bool $fresh = false): array
    {
        if ($fresh || ! Cache::has(self::CACHE_KEY)) {
            return $this->cacheVersionData();
        }

        return Cache::get(self::CACHE_KEY);
    }

    public function refresh(): array
    {
        Cache::forget(self::CACHE_KEY);

        return $this->getVersionData(true);
    }

    public function cacheVersionData(): array
    {
        $data = $this->fetchGitData();
        Cache::forever(self::CACHE_KEY, $data);

        return $data;
    }

    public function fetchGitData(): array
    {
        $tag = trim(exec('git describe --tags --abbrev=0 2>/dev/null')) ?: '0.0.0';
        $commitHash = trim(exec('git log --pretty="%h" -n1 HEAD 2>/dev/null')) ?: '00000000';
        $dateString = trim(exec('git log --pretty="%ci" -n1 HEAD 2>/dev/null')) ?: '0000-00-00 00:00:00';
        $commitDate = Carbon::parse($dateString);

        [$major, $minor, $patch] = $this->parseSemver($tag);

        return [
            'major' => $major,
            'minor' => $minor,
            'patch' => $patch,
            'short' => "v$major.$minor.$patch",
            'long' => "v$major.$minor.$patch ($commitHash)",
            'hash' => $commitHash,
            'date' => $commitDate,
        ];
    }

    private function parseSemver(string $tag): array
    {
        $cleanTag = Str::replace('v', '', $tag);

        return explode('.', $cleanTag);
    }

    public function short(): string
    {
        return $this->getVersionData()['short'];
    }

    public function long(): string
    {
        return $this->getVersionData()['long'];
    }
}
