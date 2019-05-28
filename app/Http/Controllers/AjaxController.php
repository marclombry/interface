<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Box;

class AjaxController extends Controller
{
    public function index(Request $request)
    {
        $auth = Auth::user();
        $search =  $request->input('search');
        $boxs = DB::table('boxs')
        ->join('categories','boxs.category_id', '=', 'categories.id' )
        ->join('userboxs','boxs.box_id', '=', 'userboxs.box_id' )
        ->join('users','users.group_id','=','userboxs.group_id')
        ->join('permissions','users.group_id','=','permissions.id')
        ->select('boxs.id','boxs.title','boxs.bgcolor','boxs.href','boxs.type','read','write','execution','categories.title as category','categories.bgcolor as color')
        ->where('users.id','=',$auth->id)
        ->where('boxs.title','like',$search.'%')
        ->orderBy('categories.title')
        ->get();

            //$box = Box::where('title','like',$search.'%')->get();

            return json_encode($boxs);


    }
}
