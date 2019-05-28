<?php

namespace App\Http\Controllers;

use Resinence;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App;
use Auth;
use App\Box;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $check_favorite = [];
        if(Auth::check())
        {

            $auth = Auth::user();
            $permissions = DB::table('users')
                ->join('groups','users.group_id','=','groups.id')
                ->join('permissions','groups.permission_id','=','permissions.id')
                ->where('users.id','=',$auth->id)
                ->get();
            $boxs = DB::table('boxs')
            ->join('categories','boxs.category_id', '=', 'categories.id' )
            ->join('userboxs','boxs.box_id', '=', 'userboxs.box_id' )
            ->join('users','users.group_id','=','userboxs.group_id')
            ->join('permissions','users.group_id','=','permissions.id')
            ->select('boxs.id','boxs.title','boxs.bgcolor','boxs.href','boxs.type','read','write','execution','categories.title as category','categories.bgcolor as color')
            ->where('users.id','=',$auth->id)
            ->orderBy('categories.title')
            ->paginate(18);
            $cat= DB::table('categories')->select('title as category','bgcolor')->distinct()->get();

            $favorite_list = DB::table('boxs')
                ->join('favorites','boxs.box_id','=','favorites.box_id')
                ->select('*')
                ->where('favorites.user_id','=',Auth::user()->id)
                ->get();

            $check = DB::table('favorites')
                ->select('box_id')
                ->where('user_id','=',$auth->id)
                ->groupBy('box_id')
                ->get('box_id');

                foreach($check as $k=>$v){
                    array_push($check_favorite,$v->box_id);
                }


            return view('home')->with(compact('permissions','boxs','cat','favorite_list','check_favorite'));
        }else{
            return redirect('resinet');
        }

    }

    public function category($category)
    {
        $check_favorite = [];

        if(Auth::check())
        {

            $auth = Auth::user();
            $boxs = DB::table('boxs')
            ->join('categories','boxs.category_id', '=', 'categories.id' )
            ->join('userboxs','boxs.box_id', '=', 'userboxs.box_id' )
            ->join('users','users.group_id','=','userboxs.group_id')
            ->join('permissions','users.group_id','=','permissions.id')
            ->select('boxs.id','boxs.title','boxs.bgcolor','boxs.href','boxs.type','read','write','execution','categories.title as category','categories.bgcolor as color')
            ->where('users.id','=',$auth->id)
            ->where('categories.title','=',$category)
            ->paginate(18);
            $permissions = DB::table('users')
            ->join('groups','users.group_id','=','groups.id')
            ->join('permissions','groups.permission_id','=','permissions.id')
            ->where('users.id','=',$auth->id)
            ->get();
            $cat= DB::table('categories')->select('title as category','bgcolor')->distinct()->get();
            $favorite_list = DB::table('boxs')
            ->join('favorites','boxs.box_id','=','favorites.box_id')
            ->select('*')
            ->where('favorites.user_id','=',Auth::user()->id)
            ->get();
            $check = DB::table('favorites')
                ->select('box_id')
                ->where('user_id','=',Auth::user()->id)
                ->groupBy('box_id')
                ->get('box_id');

            foreach($check as $k=>$v){
                array_push($check_favorite,$v->box_id);
            }
            return view('home')->with(compact('permissions','boxs','cat','favorite_list','check_favorite'));
        }else{
            return redirect('resinet');
        }
    }
}
