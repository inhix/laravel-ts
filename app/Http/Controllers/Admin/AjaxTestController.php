<?php


namespace App\Http\Controllers\Admin;


use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxTestController extends Controller
{
    public function getData(Request $request)
    {

        try {
            Category::create($request->all());
            return response()->json(true);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => 'Creation failed'],
                500);
        }
    }
}
