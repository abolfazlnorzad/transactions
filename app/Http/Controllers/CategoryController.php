<?php

namespace App\Http\Controllers;

use App\Http\Repo\CategoryRepo;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //get All Categories
    public function index(CategoryRepo $categoryRepo)
    {
        $categories = $categoryRepo->getAllCategories();
        return view('category.index', compact('categories'));
    }

    //show create new category form
    public function create()
    {
        return view('category.create');
    }

    //Store New Category
    public function store(CategoryRequest $request, CategoryRepo $categoryRepo)
    {
        $categoryRepo->store($request->all());
        return redirect()->route('category.index');
    }
}
