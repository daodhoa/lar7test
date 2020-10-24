<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function store(Request $request) {
        $request->validate([
           'name' => 'required|string|min:2'
        ]);
        $categories = $request->only(['name']);
        $response = $this->categoryService->insert($categories);
        return response()->json([
            'status' => true,
            'category' => $response
        ], 201);
    }

    public function getAll(Request $request) {
        $responses = $this->categoryService->getAll();
        return response()->json([
           'status' => true,
           'categories' => $responses
        ], 200);
    }

    public function storeMany(Request $request) {
        $request->validate([
           'names' => 'required|array'
        ]);
        $names = $request->get('names');
        $response = $this->categoryService->insertMany($names);
        return response()->json($response, 201);
    }
}
