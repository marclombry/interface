@extends('layouts.app')

@if(auth::user()->group_id ==2)
@section('admin')
<h1 class="text-center">{{ __("Administration") }}</h1>
<div class=" d-flex">
    <div class="bg-dupain p-2">
        <ul class="list-group">
            <li class="list-group-item active"><i class="fas fa-history"></i> {{ __("Historic") }}</li>
            <li class="list-group-item"><a href="?see=historic"  class="no-deco"  ><i class="fas fa-eye"></i> {{ __('See a Historic') }}</a></li>
            <li class="list-group-item active"><i class="fas fa-dice-d6"></i> {{ __("Box") }}</li>
            <li class="list-group-item"><a href="" class="no-deco" data-toggle="modal" data-target="#tuilesModal" data-whatever="@getbootstrap"><i class="fas fa-plus emerald"></i> {{ __("Add a Box") }}</a></li>
            <li class="list-group-item"><a href="?update=box" class="no-deco"><i class="fas fa-cogs dracula-orchid"></i> {{ __("Update a Box") }}</a></li>
            <li class="list-group-item"><a href="?delete=box" class="no-deco"><i class="fas fa-times pomegranate"></i> {{ __("Delete a Box") }}</a></li>
            <li class="list-group-item active"><i class="fas fa-tags"></i> {{ __("Catégory") }}</li>
            <li class="list-group-item"><a href="" class="no-deco" data-toggle="modal" data-target="#categoriesModal" data-whatever="@getbootstrap"><i class="fas fa-plus emerald"></i> {{ __("Add a Catégory") }}</a></li>
            <li class="list-group-item"><a href="?update=category" class="no-deco"><i class="fas fa-cogs dracula-orchid"></i> {{ __("Update a Catégory") }}</a></li>
            <li class="list-group-item"><a href="?delete=category" class="no-deco"><i class="fas fa-times pomegranate"></i> {{ __("Delete a Catégory") }}</a></li>
            <li class="list-group-item active"><i class="fas fa-city"></i> {{ __("Group") }}</li>
            <li class="list-group-item"><a href="" class="no-deco" data-toggle="modal" data-target="#groupModal" data-whatever="@getbootstrap"><i class="fas fa-plus emerald"></i> {{ __("Add a Group") }}</a></li>
            <li class="list-group-item"><a href="?update=group" class="no-deco"><i class="fas fa-cogs dracula-orchid"></i> {{ __("Update a Group") }}</a></li>
            <li class="list-group-item"><a href="?delete=group" class="no-deco"><i class="fas fa-times pomegranate"></i> {{ __("Delete a Group") }}</a></li>
            <li class="list-group-item active"><i class="fas fa-users"></i> {{ __("Users") }}</li>
            <li class="list-group-item"><a class="" href="{{ route('register') }}"><i class="fas fa-user-plus emerald"></i> {{ __('Add a Users') }}</a></li>
            <li class="list-group-item"><a href="?update=users" class="no-deco"><i class="fas fa-cogs dracula-orchid"></i> {{ __("Update a Users") }}</a></li>
            <li class="list-group-item"><a href="?delete=users"  class="no-deco"  ><i class="fas fa-times pomegranate"></i> {{ __('Delete a Users') }}</a></li>

        </ul>
    </div>
    <!-- formulaire des tuiles !-->
    <div class="modal fade" id="tuilesModal" tabindex="-1" role="dialog" aria-labelledby="tuilesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="tuilesModalLabel">{{ __("Add a Box")}} </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('add_box')}}">
                      @csrf
                        <div class="form-group">
                        <label for="tuiles-title" class="col-form-label"><i class="fas fa-pen-square"></i> {{ __("Title")}} :</label>
                        <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="tuiles-title" name="title">
                        <input type="hidden" name="bgcolor" value="red">
                        @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                        </div>
                        <div class="form-group">
                            <label for="tuiles-link" class="col-form-label"><i class="fas fa-link"></i> {{ __("Link")}} (href) :</label>
                            <input type="text" class="form-control {{ $errors->has('link') ? ' is-invalid' : '' }}" id="tuiles-link" name="link">
                            @if ($errors->has('link'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('link') }}</strong>
                            </span>
                            @endif
                        </div>
                        <!-- ici la selection des categories !-->
                        <div class="form-group">
                          <label for="sel1"><i class="fas fa-tag"></i> {{ __("Catégory")}} :</label>
                          <select class="form-control" id="sel1" name="cat">
                              @foreach($categories as $categorie)
                          <option value="{{$categorie->id}}" name="{{$categorie->title}}" id="{{$categorie->title}}">{{ __($categorie->title)}} </option>
                              @endforeach
                          </select>
                        </div>
                        <!-- ici la selection des types !-->
                        <div class="form-group">
                          <label for="sel2"><i class="fas fa-toolbox"></i> {{ __("Type")}} :</label>
                          <select class="form-control" id="sel2" name="type">
                              @foreach($types as $type)
                                <option value="{{$type}}" id="{{$type}}" name="{{$type}}" >{{ __($type)}}</option>
                              @endforeach
                          </select>
                        </div>
                        <!-- ici la selection des groups (box_id) !-->
                        <div class="form-group">
                          <label for="sel3"><i class="fas fa-users"></i> {{ __("Groups")}} :</label>
                          <select class="form-control" id="sel3" name="group">
                              @foreach($groups as $group)
                                <option value="{{$group->id}}" name="{{$group->id}}">{{ __($group->title)}} </option>
                              @endforeach
                          </select>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close")}}</button>
                            <button type="submit" class="btn btn-success">{{ __("Add")}}</button>
                        </div>
                    </form>
                </div>
              </div>
        </div>
    </div>
    <!-- formulaire des categories !-->
    <div class="modal fade" id="categoriesModal" tabindex="-1" role="dialog" aria-labelledby="categoriesModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="categoriesModalLabel">{{ __("Add a Catégory")}} </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{route('add_categories')}}">
                  @csrf
                  <div class="form-group">
                    <label for="categories-title" class="col-form-label"><i class="fas fa-pen-square"></i> {{ __("Title")}} :</label>
                    <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="categories-title" name="title">
                    @if ($errors->has('title'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('title') }}</strong>
                      </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="categories-color" class="col-form-label"><i class="fas fa-palette"></i> {{ __("Color") }} :</label>
                      <input type="color" class="form-control {{ $errors->has('bgcolor') ? ' is-invalid' : '' }}" id="categories-color" name="bgcolor">
                      @if ($errors->has('bgcolor'))
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('bgcolor') }}</strong>
                        </span>
                      @endif
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
                    <button type="submit" class="btn btn-success">{{ __("Add") }}</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>

     <!-- formulaire des groupes !-->
     <div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-labelledby="groupModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="groupModalLabel">{{ __( "Add a Group") }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{route('add_groupes')}}">
                  @csrf
                  <div class="form-group">
                    <label for="groupes-title" class="col-form-label"><i class="fas fa-pen-square"></i> {{ __("Title")}} :</label>
                    <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="type-title" name="title">
                    @if ($errors->has('title'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('title') }}</strong>
                      </span>
                    @endif
                  </div>
                  <!-- ici la selection des permission !-->
                  <div class="form-group">
                    <label for="sel1"><i class="fas fa-tag"></i> {{ __("Permission") }} :</label>
                    <select class="form-control" id="sel1" name="perm">
                        @foreach($permissions as $permission)
                          <option value="{{$permission->id}}" name="{{$permission->id}}" id="{{$permission->id}}">
                            Read : {{ $permission->read}}
                            Write : {{ $permission->write}}
                            Execution : {{ $permission->execution}}
                          </option>
                        @endforeach
                    </select>
                  </div>
                  <input type="hidden" name="group" value="">
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close")}}</button>
                    <button type="submit" class="btn btn-success">{{ __("Add")}}</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap">
      @if(Request::query('delete') =="box")
        @foreach($all_boxs as $boxs)
          <div class="m-2"><p class="bg-dracula-orchid p-2"><a class="no-deco cloud" href="{{route('sup_box',$boxs->id)}}"><i class="fas fa-times pomegranate"></i> {{ __($boxs->title)}} </a></p></div>
        @endforeach
      @endif

      @if(Request::query('delete') =="category")
        @foreach($categories as $category)
          <div class="m-2"><p class="bg-dracula-orchid p-2"><a class="no-deco cloud" href="{{route('sup_cat',$category->id)}}"><i class="fas fa-times pomegranate"></i> {{ __($category->title)}} </a></p></div>
        @endforeach
      @endif

      @if(Request::query('delete') =="group")
        @foreach($groups as $group)
          <div class="m-2"><p class="bg-dracula-orchid p-2"><a class="no-deco cloud" href="{{route('sup_group',$group->id)}}"><i class="fas fa-times pomegranate"></i> {{ __($group->title)}} </a></p></div>
        @endforeach
      @endif

      @if(Request::query('delete') =="users")
        @foreach($users as $user)
          <div class="m-2"><p class="bg-dracula-orchid p-2"><a class="no-deco cloud" href="{{route('sup_user',$user->id)}}"><i class="fas fa-times pomegranate"></i> {{ __($user->email)}} </a></p></div>
        @endforeach
      @endif


    @if(Request::query('update') =="box")
      @foreach($all_boxs as $boxs)
        <div class="m-2 bg-dracula-orchid p-4 cloud">
            <form method="POST" action="{{route('up_box')}}">
                @csrf
                  <div class="form-group">
                  <input type="hidden" name="id" value="{{$boxs->id}}">
                  <label for="tuiles-title" class="col-form-label"><i class="fas fa-pen-square"></i> {{ __("Title")}} :</label>
                  <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="tuiles-title" name="title" value="{{$boxs->title}}">
                  <input type="hidden" name="bgcolor" value="red">
                  @if ($errors->has('title'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('title') }}</strong>
                  </span>
                  @endif
                  </div>
                  <div class="form-group">
                      <label for="tuiles-link" class="col-form-label"><i class="fas fa-link"></i> {{ __("Link")}} (href) :</label>
                      <input type="text" class="form-control {{ $errors->has('link') ? ' is-invalid' : '' }}" id="tuiles-link" name="link" value="{{$boxs->href}}">
                      @if ($errors->has('link'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('link') }}</strong>
                      </span>
                      @endif
                  </div>
                  <!-- ici la selection des categories !-->
                  <div class="form-group">
                    <label for="sel1"><i class="fas fa-tag"></i> {{ __("Catégory")}} :</label>
                    <select class="form-control" id="sel1" name="cat">
                        @foreach($categories as $categorie)
                          <option value="{{$categorie->id}}" name="{{$categorie->title}}" id="{{$categorie->title}}">{{ __($categorie->title)}} </option>
                        @endforeach
                    </select>
                  </div>
                  <!-- ici la selection des types !-->
                  <div class="form-group">
                    <label for="sel2"><i class="fas fa-toolbox"></i> {{ __("Type")}} :</label>
                    <select class="form-control" id="sel2" name="type">
                        @foreach($types as $type)
                          <option value="{{$type}}" id="{{$type}}" name="{{$type}}" >{{ __($type)}}</option>
                        @endforeach
                    </select>
                  </div>
                  <!-- ici la selection des groups (box_id) !-->
                  <div class="form-group">
                    <label for="sel3"><i class="fas fa-users"></i> {{ __("Groups")}} :</label>
                    <select class="form-control" id="sel3" name="group">
                        @foreach($groups as $group)
                          <option value="{{$group->id}}" name="{{$group->id}}">{{ __($group->title)}} </option>
                        @endforeach
                    </select>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close")}}</button>
                      <button type="submit" class="btn btn-success">{{ __("Update")}}</button>
                  </div>
              </form>
        </div>
      @endforeach
    @endif

    @if(Request::query('update') =="category")
      @foreach($categories as $category)
      <div class="m-2 bg-dracula-orchid p-4 cloud">
        <form method="POST" action="{{route('up_categories')}}">
          @csrf
          <div class="form-group">
            <input type="hidden" name="id" value="{{$category->id}}">
            <label for="categories-title" class="col-form-label"><i class="fas fa-pen-square"></i> {{ __("Title")}} :</label>
            <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="categories-title" name="title" value="{{$category->title}}">
            @if ($errors->has('title'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('title') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <label for="categories-color" class="col-form-label"><i class="fas fa-palette"></i> {{ __("Color") }} :</label>
              <input type="color" class="form-control {{ $errors->has('bgcolor') ? ' is-invalid' : '' }}" id="categories-color" name="bgcolor" value="{{$category->bgcolor}}">
              @if ($errors->has('bgcolor'))
                <span class="invalid-feedback" role="alert">
                   <strong>{{ $errors->first('bgcolor') }}</strong>
                </span>
              @endif
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
            <button type="submit" class="btn btn-success">{{ __("Update") }}</button>
          </div>
        </form>
      </div>
      @endforeach
    @endif

    @if(Request::query('update') =="group")
      @foreach($groups as $group)
      <div class="m-2 bg-dracula-orchid p-4 cloud">
          <form method="POST" action="{{route('up_groupes')}}">
            @csrf
            <div class="form-group">
              <input type="hidden" name="id" value="{{$group->id}}">
              <label for="groupes-title" class="col-form-label"><i class="fas fa-pen-square"></i> {{ __("Title")}} :</label>
              <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="type-title" name="title" value="{{$group->title}}">
              @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
              @endif
            </div>
            <!-- ici la selection des permission !-->
            <div class="form-group">
              <label for="sel1"><i class="fas fa-tag"></i> {{ __("Permission") }} :</label>
              <select class="form-control" id="sel1" name="perm">
                  @foreach($permissions as $permission)
                    <option value="{{$permission->id}}" name="{{$permission->id}}" id="{{$permission->id}}">
                      Read : {{ $permission->read}}
                      Write : {{ $permission->write}}
                      Execution : {{ $permission->execution}}
                    </option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="groupes-id" class="col-form-label"><i class="fas fa-users"></i> {{ __("Group_id")}} :</label>
              <input type="number" name="group" value="{{$group->group_id}}">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close")}}</button>
              <button type="submit" class="btn btn-success">{{ __("Update")}}</button>
            </div>
          </form>
        </div>
      @endforeach
    @endif

    @if(Request::query('update') =="users")
    @foreach($users as $user)
    <div class="m-2 bg-dracula-orchid p-4 cloud">
        <form method="POST" action="{{route('up_users')}}">
          @csrf
          <div class="form-group">
            <input type="hidden" name="id" value="{{$user->id}}">
            <label for="groupes-title" class="col-form-label"><i class="fas fa-pen-square"></i> {{ __("Email")}} :</label>
            <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="type-email" name="email" value="{{$user->email}}">
            @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>

          <div class="form-group">
            <label for="groupes-id" class="col-form-label"><i class="fas fa-users"></i> {{ __("Group_id")}} :</label>
            <input type="number" name="group" value="{{$user->group_id}}">
          </div>

          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close")}}</button>
            <button type="submit" class="btn btn-success">{{ __("Update")}}</button>
          </div>
        </form>
      </div>
    @endforeach
  @endif

  @if(Request::query('see') =="historic")
  <table class="table table-sm table-dark responsive p-2  m-2">
    <thead>
      <tr>
        <th>EMAIL</th>
        <th>USER iD</th>
        <th>GROUP IDL</th>
        <th>ACTION</th>
        <th>SUPPRIMER</th>
      </tr>
    </thead>
    @foreach($historic as $history)
      <tr>
        <td>{{json_decode($history->event,true)["email"]}}</td>
        <td>{{json_decode($history->event,true)["user_id"]}}</td>
        <td>{{json_decode($history->event,true)["group_id"]}}</td>
        <td>{{json_decode($history->event,true)["action"]}}</td>
        <td><a href="{{route('sup_historic',json_decode($history->id,true))}}"><i class="fas fa-times pomegranate"></i></a></td>
      </tr>
    @endforeach
  </table>
  @endif
    </div>
</div>
@endsection
@endif
