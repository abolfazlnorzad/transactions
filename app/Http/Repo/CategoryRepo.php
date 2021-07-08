<?php


namespace App\Http\Repo;


use App\Models\Category;

class CategoryRepo
{

    public $category;
    public function __construct()
    {
        $this->category = Category::query();
    }

    //fetch all category
    public function getAllCategories()
    {
       return Category::all();
    }


    //store category
    public function store($data)
    {
       return $this->category->create([
            'user_id' => auth()->id(),
            "name" => $data['name'],
            "description" => $data['description']
        ]);
    }

}
