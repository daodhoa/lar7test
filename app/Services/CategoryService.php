<?php

namespace App\Services;

use App\Enums\Category;
use App\Repository\CategoryRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CategoryService implements CategoryServiceInterface
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function insert($categories = array())
    {
        $userId = Auth::id();
        $categories['user_id'] = $userId;
        $categories['flag'] = Category::ACTIVE;
        return $this->categoryRepository->create($categories);
    }

    public function getAll()
    {
        $userId = Auth::id();
        return $this->categoryRepository->getCategoriesOfUser($userId);
    }

    public function insertMany($array = array())
    {
        $userId = Auth::id();
        $data = array();
        foreach ($array as $name) {
            $category = [
                'user_id' => $userId,
                'flag' => Category::ACTIVE,
                'name' => $name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            $data[] = $category;
        }
        return $this->categoryRepository->insertManyCategories($data);
    }
}
