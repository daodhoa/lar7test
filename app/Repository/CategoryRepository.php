<?php

namespace App\Repository;

class CategoryRepository extends EloquentRepository
{

    function getModel()
    {
        return \App\Model\Category::class;
    }

    public function getCategoriesOfUser($userId) {
        return $this->_model->where('user_id', $userId)->get();
    }

    public function insertManyCategories($categories = array()) {
        return $this->_model->insert($categories);
    }
}
