<?php

namespace Manikienko\Todo;

class Filesystem
{
    public function exists(string $path): bool
    {
        return file_exists($path);
    }

    public function put(string $path, string $data): void
    {
        file_put_contents($path, $data);
    }

    public function get(string $path): ?string
    {
        return file_get_contents($path);
    }
}
