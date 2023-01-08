<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::with(['subCategories' =>function($q){
            $q->withCount('posts');
        }])->withCount('posts')->where('status', 1)->whereNull('parent_id')->orderBy('id', 'desc')->select('id', 'slug', 'name', 'status', 'image')->paginate(20);
        $trashCategories = Category::onlyTrashed()->orderBy('id', 'desc')->select('id', 'slug', 'name', 'status', 'image')->paginate(20);
        return view('backend.category.index', compact('categories','trashCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        




        $request->validate([
            "name"=> 'required',
            "parent"=> 'nullable|integer',
            "description"=> 'nullable|max:300',
            "image"=> 'nullable|mimes:jpg,png,jpeg|max:300',
        ]);

        $image_name = NULL;
        if($request->file('image')){
            $image_name = Str::uuid(). '.' . $request->file('image')->extension();
            Storage::putFileAs('category', $request->file('image'), $image_name);
            // Image::make($request->file('image'))->crop(200,200)->save(public_path('storage/category/'.$image_name));
        }


        Category::create([
            "name"=> $request->name,
            "slug"=> Str::slug($request->name),
            "parent_id"=> $request->parent,
            "description"=> $request->description,
            "image"=> $image_name,
        ]);

        return back()->with("success", "Category Create Successful!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category->with('posts');
        return view('backend.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', "Category Delete Succesfull!");
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $data = Category::onlyTrashed()->findOrFail($id);
        $data->restore();
        return back()->with('success', "Category Restore Succesfull!");
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function permanentDelete($id)
    {
        $data = Category::onlyTrashed()->findOrFail($id);
        if($data->image){
            Storage::delete("category".$data->image);
        }
        $data->forceDelete();
        return back()->with('success', "Category Permanently Deleted!");
    }
}

