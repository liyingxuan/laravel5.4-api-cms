<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{    
    public function index()
    {
        $page_title = "首页";
        $data = [
//            [
//                'name' => 'test1',
//                'progress' => TestModel::where('id', '>', '5')->count(),
//                'color' => 'success'
//            ],
//            [
//                'name' => 'test2',
//                'progress' => TestModel::count(),
//                'color' => 'success'
//            ]
        ];
        
        return view('index.index',compact( 'page_title', 'data'));
    }
}
