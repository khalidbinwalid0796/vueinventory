<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use DB;

class CategoryController extends Controller
{

    public function index()
    {
        $category=Category::all();
       // $category=DB::table('categories')->get();
        return response()->json($category);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
         'category_name' => 'required|unique:categories|max:255',
        ]);

           $category = new Category;
           $category->category_name = $request->category_name;
           $category->save();

           //query builder
           // $data=array();
           // $data['category_name']=$request->category_name;
           // DB::table('categories')->insert($data);
    }

    public function show($id)
    {
        //query builder
        //$categoru=DB::table('categories')->where('id',$id)->first();
        $category=Category::findorfail($id);
         return response()->json($category);
    }

  
    public function update(Request $request, $id)
    {
        $data=array();
        $data['category_name']=$request->category_name;
        DB::table('categories')->where('id',$id)->update($data);
        // $category=Category::findorfail($id);
        // $category->save();
    }

    public function destroy($id)
    {
        DB::table('categories')->where('id',$id)->delete();
        // $category=Category::findorfail($id);
        // $category->delete();
    }
}
