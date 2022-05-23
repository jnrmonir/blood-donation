<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Str;

class AllCategory extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];


    public $per_page;
    public $search;
    public $categoryName;
    public $editCategoryName;
    public $editSlug;
    public $slug;
    public $category_id;
    public $editcategory;
    public $deleteCategory;
    public $status = false;

    // Category Add

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'categoryName' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug|alpha_dash',
        ]);
    }


    public function updatedCategoryName()
    {
        $this->slug = Str::slug($this->categoryName);
    }



    public function submit(){

        $this->validate([
            'categoryName' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug|alpha_dash',
        ]);

        $category = new Category();
        $category->name = $this->categoryName;
        $category->slug =Str::slug($this->slug);

        if($category->save()){
            session()->flash('status','Add Catergory Successfully');
            $this->reset();
        }
        else{
            session()->flash('error','!oops Something is wrong');
        }
    }

    // Category Edit, Update, Delete
    public function updatedeEditCategoryName()
    {
        $this->editSlug = Str::slug($this->editCategoryName);
    }

    public function edit($id){
        $this->editcategory = Category::find($id);
        $this->status = true;
        $this->category_id = $id;
        $this->editCategoryName = $this->editcategory->name;
        $this->editSlug= $this->editcategory->slug;
    }

    public function update(){
        $this->validate([
            'editCategoryName' => 'required|unique:categories,name',
            'editSlug' => 'required|unique:categories,slug|alpha_dash',
        ]);

        if($this->category_id){
            $updatecategory=Category::find($this->category_id);
            $updatecategory->name = $this->editCategoryName;
            $updatecategory->slug =Str::slug($this->editSlug);

            if($updatecategory->update()){
                $this->status = false;
                session()->flash('status','Add Catergory Successfully');
                $this->reset();
            }
            else{
                session()->flash('error','!oops Something is wrong');
            }
        }
        else{
            return "id not found";
        }
    }

    public function delete($id){
        $this->deleteCategory= Category::find($id);
        $this->deleteCategory->delete();
    }

    public function render()
    {
        $categories = Category::where('name','like','%'.$this->search.'%')->paginate($this->per_page);
        return view('livewire.admin.all-category',['categories' => $categories])->extends('layouts.base');
    }
}
