<?php

namespace UrlShortener\Component\Url;

use JMS\Serializer\SerializerInterface;

class UrlJsonDatabase
{
    private $dbPath;
    private $serializer;
    private $database;

    public function __construct(string $baseDir, SerializerInterface $serializer)
    {
        $this->dbPath = $baseDir.'/var/url_database.json';
        $this->serializer = $serializer;

        if (!is_file($this->dbPath)) {
            $this->persist([]);
        }

        if (!$database = file_get_contents($this->dbPath)) {
            throw new \RuntimeException('Cannot initialize db file');
        }

        $this->database = $this->serializer->deserialize($database, 'array', 'json');
    }

    public function read(): array
    {
        return $this->database;
    }

    public function write(array $incoming = [])
    {
        $data = array_merge(
            $this->database ?? [],
            $incoming
        );

        $this->persist($data);
    }

    private function persist(array $data)
    {
        file_put_contents($this->dbPath, $this->serializer->serialize($data, 'json'));

        $this->database = $data;
    }
}
