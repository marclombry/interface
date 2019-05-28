<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class FavoriteController extends Controller
{
    public function store($id)
    {
        if(Auth::check()){
        // Retrieve the logged-in user ID and insert the identifier of the box in the favorites table
            $user_id = Auth::user()->id;

            DB::table('favorites')->insert(
                ['box_id' => $id, 'order'=>1, 'user_id'=>$user_id]
            );
        }else{
            if(!Auth::check()){

                return  redirect('home');
             }
        }

        //redirect to the home
        return redirect()->back();
    }

    public function delete($id)
    {
        if(Auth::check()){
        // Retrieve the logged-in user ID and delete identifier of the box added in favorites table
            $user_id = Auth::user()->id;
            DB::table('favorites')
                ->where('box_id', $id)
                ->where('user_id',$user_id)
                ->delete();
        }else{
            if(!Auth::check()){

                return  redirect('home');
             }
        }
        //redirect to the home
        return redirect()->back();
    }

    public function show()
    {
        if(Auth::check())
        {
            $check_favorite = [];
            $auth = Auth::user();
            $boxs = DB::table('boxs')
            ->join('categories','boxs.category_id', '=', 'categories.id' )
            ->join('favorites','boxs.id','=','favorites.box_id')
            ->join('userboxs','boxs.box_id', '=', 'userboxs.box_id' )
            ->join('users','users.group_id','=','userboxs.group_id')
            ->join('permissions','users.group_id','=','permissions.id')
            ->select('boxs.id','boxs.title','boxs.bgcolor','boxs.href','boxs.type','read','write','execution','categories.title as category','categories.bgcolor as color')
            ->where('users.id','=',$auth->id)
            ->where('favorites.user_id','=',$auth->id)
            ->orderBy('categories.title')
            ->paginate(18);

            $cat= DB::table('categories')->select('title as category','bgcolor')->distinct()->get();

            $favorite_list = DB::table('boxs')
                ->join('favorites','boxs.box_id','=','favorites.box_id')
                ->select('*')
                ->where('favorites.user_id','=',Auth::user()->id)
                ->get();
            $permissions = DB::table('users')
                ->join('groups','users.group_id','=','groups.id')
                ->join('permissions','groups.permission_id','=','permissions.id')
                ->where('users.id','=',$auth->id)
                ->get();
            $check = DB::table('favorites')
                ->select('box_id')
                ->where('user_id','=',Auth::user()->id)
                ->groupBy('box_id')
                ->get('box_id');
            foreach($check as $k=>$v){
                array_push($check_favorite,$v->box_id);
            }
        }else{
            if(!Auth::check()){

                return  redirect('home');
             }
        }
        return view('pages.favorite')->with(compact('permissions','boxs','cat','favorite_list','check_favorite'));
    }
}
