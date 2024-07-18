<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function allCategory()
    {
        $category = Category::latest()->get();

        return view('backend.category.all_category', compact('category'));
    }
    public function categoryStore(Request $request)
    {
        $validateData = $request->validate([
            'category_name' => 'required|unique:categories',
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);

        $toastr = array(
            'success' => 'Customer Data Inserted.'
        );
        return redirect()->route('all.category')->with($toastr);
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);

        return view('backend.category.edit_category', compact('category'));
    }

    public function updateCategory(Request $request)
    {
        $category_id = $request->id;

        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
        ]);

        $toastr = array(
            'success' => 'Category Updated Successfully.'
        );
        return redirect()->route('all.category')->with($toastr);
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();

        $toastr = array(
            'success' => 'Category Deleted.'
        );
        return redirect()->route('all.category')->with($toastr);
    }
}
