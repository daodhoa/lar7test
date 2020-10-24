<?php

namespace App\Services;

interface CategoryServiceInterface
{
    public function insert($categories = array());

    public function insertMany($array = array());

    public function getAll();
}
