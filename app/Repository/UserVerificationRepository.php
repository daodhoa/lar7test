<?php

namespace App\Repository;

class UserVerificationRepository extends EloquentRepository
{
    function getModel()
    {
        return \App\Model\UserVerification::class;
    }

    public function getLastUserVerifications($userId) {
        return $this->_model->where('user_id', $userId)->get()->last();
    }
}
