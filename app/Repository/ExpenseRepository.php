<?php

namespace App\Repository;

class ExpenseRepository extends EloquentRepository
{

    function getModel()
    {
        return \App\Model\Category::class;
    }

}
