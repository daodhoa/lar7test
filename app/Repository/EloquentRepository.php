<?php

namespace App\Repository;

abstract class EloquentRepository implements RepositoryInterface
{
    protected $_model;

    public function __construct()
    {
        $this->setModel();
    }

    public function setModel() {
        $this->_model = app()->make($this->getModel());
    }

    abstract function getModel();

    /**
     * Override
    */
    public function getAll()
    {
        return $this->_model->all();
    }

    public function find($id)
    {
        return $this->_model->find($id);
    }

    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        return $this->_model->where('id', $id)->update($attributes);
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            return $result->delete();
        }
        return false;
    }

}
