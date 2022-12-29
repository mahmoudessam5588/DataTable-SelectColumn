<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ColumnSearchingController extends Controller
{
    function index(Request $request)
    {
     if(request()->ajax())
     {
      if($request->category)
      {
       $data = DB::table('product')
         ->join('category', 'category.category_id', '=', 'product.category')
         ->select('product.id', 'product.name', 'category.category_name', 'product.price')
         ->where('product.category', $request->category)->get();
      }
      else
      {
       $data = DB::table('product')
         ->join('category', 'category.category_id', '=', 'product.category')
         ->select('product.id', 'product.name', 'category.category_name', 'product.price')
         ->get();
      }

      return datatables()->of($data)->make(true);
     }

     $category = DB::table('category')
        ->select("*")
        ->get();

     return view('column_searching', compact('category'));
    }
}

?>