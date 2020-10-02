<?php

namespace App\Repository;

class UserRepository extends EloquentRepository
{

    function getModel()
    {
        return \App\Model\User::class;
    }

    public function findByEmail(string $email) {
        return $this->_model->where('email', $email)->first();
    }
}
