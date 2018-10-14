<?php

namespace UrlShortener\Component\Url;

class UrlJsonManager implements UrlManager
{
    private $db;

    public function __construct(UrlJsonDatabase $db)
    {
        $this->db = $db;
    }

    public function getLong(string $shortened): ?string
    {
        $long = array_search($shortened, $this->db->read());

        if (!$long) {
            return null;
        }

        return $long;
    }

    public function getShort(string $full): ?string
    {
        $data = $this->db->read();

        if (!array_key_exists($full, $data)) {
            return null;
        }

        return $data[$full];
    }

    public function add(array $incoming)
    {
        $this->db->write($incoming);
    }
}
