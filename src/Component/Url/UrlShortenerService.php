<?php

namespace UrlShortener\Component\Url;

use UrlShortener\Exception\ValidationFailed;

class UrlShortenerService
{
    public $manager;

    public function __construct(UrlManager $manager)
    {
        $this->manager = $manager;
    }

    public function shorten(string $long): string
    {
        if (!filter_var($long, FILTER_VALIDATE_URL)) {
            throw new ValidationFailed(sprintf('%s is not a valid url', $long));
        }

        $short = base64_encode(random_bytes(5));

        if ($this->manager->getLong($short)) {
            return $this->shorten($long);
        }

        $this->manager->add([$long => $short]);

        return $short;
    }
}
