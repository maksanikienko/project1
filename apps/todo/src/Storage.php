<?php

namespace Manikienko\Todo;

class Storage {

    protected Filesystem $fs;
    protected string $storagePath;

    public function __construct(Filesystem $fs, string $storagePath)
    {
        $this->fs = $fs;
        $this->storagePath = $storagePath;
    }

    public function getItems()
    {
        // file_exist, file_get_contents, file_put_contents
        if (!$this->fs->exists($this->storagePath)) {
            // $arr и $string нам на самом едел тут не нужны, мы их можем убрать
            $this->fs->put($this->storagePath, json_encode([]));
        }

        return json_decode($this->fs->get($this->storagePath), true);
    }

    public function saveItems(array $data): void {
        $data = json_encode($data, JSON_PRETTY_PRINT);
        $this->fs->put($this->storagePath, $data);
    }
}
