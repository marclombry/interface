<?php

namespace App\Providers;

use Resinence;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        /*
        if(Auth::check()){
            $favorite_list = DB::table('box')
            ->join('favorites','boxs.box_id','=','favorites.box_id')
            ->select('*')
            ->where('favorites.user_id','=',Auth::user()->id)
            ->get();
            //récupérer les box lier au favorie ou l user_id de la box = id user connecté    
        }else{
            $favorite_list ="";
        }
        View::share('favorite_list',$favorite_list);
        */
        $slide = Resinence::slide();
        $citation = Resinence::citation();
        $uri = Request::path();
        View::share(compact('slide','citation','uri'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
