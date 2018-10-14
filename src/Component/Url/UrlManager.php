<?php

namespace UrlShortener\Component\Url;

interface UrlManager
{
    public function getLong(string $shortened): ?string;

    public function getShort(string $full): ?string;

    public function add(array $incoming);
}
