<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
   public function CategoryAll(){
       $categories = Category::latest()->get();
       return view('backend.category.category_all', compact('categories'));
   }

   public function CategoryAdd(){
       return view('backend.category.category_add');
   }

   public function CategoryStore(Request $request){
       Category::insert([
           'name' => $request->name,
           'created_by' => Auth::user()->id,
           'created_at' => Carbon::now(),
       ]);
       $notifications = array(
           'message' => 'Category Inserted Successfully',
           'alert-type' => 'success',
       );
       return redirect()->route('category.all')->with($notifications);
   }
   public function CategoryEdit($id){
       $category_id = Category::findOrfail($id);
       return view('backend.category.category_edit', compact('category_id'));
   }
   public function CategoryUpdate(Request $request){
       $category_id = $request->id;
       Category::findOrfail($category_id)->update([
           'name' => $request->name,
           'updated_by' => Auth::user()->id,
           'updated_at' => Carbon::now(),
       ]);
       $notifications = array(
           'message' => 'Category Update Successfully',
           'alert-type' => 'success',
       );
       return redirect()->route('category.all')->with($notifications);
   }
    public function UnitDelete($id){
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
