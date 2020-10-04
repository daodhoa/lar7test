<?php

namespace App\Repository;

interface RepositoryInterface
{
    public function getAll();

    public function find($id);

    public function update($id, array $attributes);

    public function delete($id);

    public function create(array $attributes);
}
