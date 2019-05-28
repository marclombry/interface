<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BoxAddRequest;
use App\Http\Requests\CategoryAddRequest;
use App\Http\Requests\GroupAddRequest;
use App\User;
use App\Categorie;
use App\Box;
use App\Group;
use App\Permission;
use App\History;
class AdminController extends Controller
{
    public function index()
    {
        if(!Auth::check()){

           return  redirect('home');
        }
        //liste des utilisateur
        $users = User::all();
        // liste des tuiles
        $all_boxs = Box::all();

        // Liste des categories
        $categories = Categorie::all();

        // Liste des types
        $types = Box::all()->groupBy('type')->keys();
        // Liste des groupes
        $groups = Group::all();

        // Liste de l'historique
        $historic = History::all();

        // Liste des permissions

        $permissions = Permission::all();

        return view('pages.admin')->with(compact('all_boxs','categories','types','groups','permissions','users','historic'));
    }

    public function  addBox(BoxAddRequest $request)
    {

        $box = new Box;
        $box->title = $request->title;
        $box->bgcolor = 'red';
        $box->href = $request->link;
        $box->category_id = $request->cat;
        $box->type = $request->type;
        $box->box_id = $request->group;
        $box->save();
        $historique = new History;
        $historique->event = json_encode([
            'user_id'=>auth::user()->id,
            'email'=>auth::user()->email,
            'group_id'=>auth::user()->group_id,
            'action'=>'add_box',
            'title'=>$box->title,
            'bgcolor'=>$box->bgcolor,
            'href'=>$box->href,
            'category_id'=>$box->category_id,
            'type'=>$box->type,
            'box_id'=>$box->box_id
        ]);
        $historique->save();
        return redirect()->back();
    }

    public function  addCategory(CategoryAddRequest $request)
    {

        $cat = new Categorie;
        $cat->title = $request->title;
        $cat->bgcolor = $request->bgcolor;
        $cat->save();
        $historique = new History;
        $historique->event = json_encode([
            'user_id'=>auth::user()->id,
            'email'=>auth::user()->email,
            'group_id'=>auth::user()->group_id,
            'action'=>'add_categories',
            'title'=>$cat->title,
            'bgcolor'=>$cat->bgcolor
        ]);
        $historique->save();
        return redirect()->back();

    }

    public function  addGroup(GroupAddRequest $request)
    {
        $perm = new Group;
        $perm->title = $request->title;
        $perm->permission_id = $request->perm;
        $group_id = Group::all()->last()->group_id +1;
        $perm->group_id = $group_id;
        $perm->save();
        $historique = new History;
        $historique->event = json_encode([
            'user_id'=>auth::user()->id,
            'email'=>auth::user()->email,
            'group_id'=>auth::user()->group_id,
            'action'=>'add_group',
            'title'=>$perm->title,
            'permission_id'=>$perm->permission_id,
            'group_id'=>$perm->group_id
        ]);
        $historique->save();
        return redirect()->back();

    }

    public function deleteBox($id)
    {
        Box::where('id',$id)->delete();
        $historique = new History;
        $historique->event = json_encode([
            'user_id'=>auth::user()->id,
            'email'=>auth::user()->email,
            'group_id'=>auth::user()->group_id,
            'action'=>'del_box',
            'id_box'=>$id

        ]);
        $historique->save();
        return redirect()->back();
    }

    public function deleteHistoric($id)
    {
        History::where('id',$id)->delete();
        return redirect()->back();
    }

    public function deleteCategory($id)
    {
        Categorie::where('id',$id)->delete();
        $historique = new History;
        $historique->event = json_encode([
            'user_id'=>auth::user()->id,
            'email'=>auth::user()->email,
            'group_id'=>auth::user()->group_id,
            'action'=>'del_categories',
            'id_box'=>$id

        ]);
        $historique->save();
        return redirect()->back();
    }

    public function deleteGroup($id)
    {
        Group::where('id',$id)->delete();
        $historique = new History;
        $historique->event = json_encode([
            'user_id'=>auth::user()->id,
            'email'=>auth::user()->email,
            'group_id'=>auth::user()->group_id,
            'action'=>'del_group',
            'id_box'=>$id

        ]);
        $historique->save();
        return redirect()->back();
    }

    public function deleteUser($id)
    {
        if($id != auth::user()->id && auth::user()->group_id !=2){
            User::where('id',$id)->delete();
            $historique = new History;
            $historique->event = json_encode([
                'user_id'=>auth::user()->id,
                'email'=>auth::user()->email,
                'group_id'=>auth::user()->group_id,
                'action'=>'del_group',
                'id_box'=>$id

            ]);
            $historique->save();
        }

        return redirect()->back();
    }

    public function updateBox(BoxAddRequest $request)
    {

        $id = $request->id;
        Box::whereId($id)->update([
            'title'=>$request->title,
            'bgcolor'=>$request->bgcolor,
            'href'=>$request->link,
            'category_id'=>$request->cat,
            'type'=>$request->type,
            'box_id'=>$request->group
        ]);
        $historique = new History;
        $historique->event = json_encode([
            'user_id'=>auth::user()->id,
            'email'=>auth::user()->email,
            'group_id'=>auth::user()->group_id,
            'action'=>'up_box',
            'title'=>$request->title,
            'bgcolor'=>$request->bgcolor,
            'href'=>$request->link,
            'category_id'=>$request->cat,
            'type'=>$request->type,
            'box_id'=>$request->group
        ]);
        $historique->save();
        return redirect()->back();
    }

    public function updateCategories(CategoryAddRequest $request)
    {

        $id = $request->id;
        Categorie::whereId($id)->update([
            'title'=>$request->title,
            'bgcolor'=>$request->bgcolor
        ]);
        $historique = new History;
        $historique->event = json_encode([
            'user_id'=>auth::user()->id,
            'email'=>auth::user()->email,
            'group_id'=>auth::user()->group_id,
            'action'=>'up_categories',
            'title'=>$request->title,
            'bgcolor'=>$request->bgcolor
        ]);
        $historique->save();
        return redirect()->back();
    }

    public function updateGroup(GroupAddRequest $request)
    {

        $id = $request->id;
        $request->group = $request->group <=0? 1 :$request->group;
        Group::whereId($id)->update([
            'title'=>$request->title,
            'permission_id'=>$request->perm,
            'group_id' =>$request->group
        ]);
        $historique = new History;
        $historique->event = json_encode([
            'user_id'=>auth::user()->id,
            'email'=>auth::user()->email,
            'group_id'=>auth::user()->group_id,
            'action'=>'up_group',
            'title'=>$request->title,
            'permission_id'=>$request->perm,
            'group_id'=>$request->group
        ]);
        $historique->save();
        return redirect()->back();
    }

    public function updateUser(Request $request)
    {

        $id = $request->id;

        User::whereId($id)->update([
            'email'=>$request->email,
            'group_id' =>$request->group
        ]);
        $historique = new History;
        $historique->event = json_encode([
            'user_id'=>auth::user()->id,
            'email_auth'=>auth::user()->email,
            'group_id'=>auth::user()->group_id,
            'action'=>'up_users',
            'email'=>$request->email,
            'group_id'=>$request->group
        ]);
        $historique->save();
        return redirect()->back();
    }


}
