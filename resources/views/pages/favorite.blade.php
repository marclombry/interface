@extends('layouts.app')

@section('content')
<!--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__("Dashboard") }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{__("You are logged in!") }}
                </div>
            </div>
        </div>
    </div>   
</div>
-->
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">×</button>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        {{__("You are logged in!") }}
</div>
@endsection
@section('breadcrumb')
<div class="d-flex r-center"><p class="lead m-2 p-1 bg-amethyst" style="max-width:14rem;"> {{ __($uri) }}</p></div>
@endsection
@section('box')
<div class="" style="margin:0px;">
	<div class="m-2 r-wrap r-center">
		@if(isset($boxs))
			{{ $boxs->links() }}
		@endif 
	</div>
</div>
<div class="d-flex r-wrap r-center" style="margin:0px;margin-bottom:100px;">
  <div class="m-2" style="min-width:14rem;">  
        <div class="list-group">
            <div class="list-group-item list-group-item-action active">
                {{ __("Sort by:") }}
            </div>
            <a href="{{ url('/home') }}" class="list-group-item list-group-item-action">{{ __("All") }}</a>
            <a class="dropdown-item d-flex justify-content-space-between  list-group-item list-group-item-action" href="{{ route('favoris') }}">{{ __('Favorite') }} <i class="fa fa-star sun-flower" aria-hidden="true" ></i></a>  
            @foreach($cat as $key =>$list)
                <a href="{{route('category',$list->category)}}" class=" list-group-item list-group-item-action  break-word cloud font-bold" style="backgroundColor:{{$list->bgcolor}};">{{ucfirst( __($list->category))}}</a>
            @endforeach    
        </div>
    </div>
    <div style="margin-bottom:100px;"> 
        <div class="d-flex flex-wrap r-center ">
        @foreach($boxs as $box) 
      
            <div class=" m-2 " style="min-width: 14rem; max-width: 20rem;">
				@if($box->type =='Web')
					<div style="min-width: 14rem;backgroundColor:{{$box->color}};"><i class='p-1 fas fa-desktop text-center cloud' style='font-size:22px;'></i></div>
				@else 
					<div style="min-width: 14rem;backgroundColor:{{$box->color}};"><i class='p-1 fas fa-tools text-center cloud' style='font-size:22px;'></i></div>
				@endif
                    <div class="card-body bg-cloud filter-effect filter-effect-show anim-bigger">
                        <h4 class="card-title text-center break-word launcher-bigger"><a href="{{$box->href}}" class=" no-deco">{{ucfirst($box->title)}}</a></h4>
                        <div class="d-flex justify-content-between">
                            <p class="card-text">{{ucfirst( __($box->category))}}</p>
                            <div>
                                 
                                @if(in_array($box->id,$check_favorite))
                                <a  href="{{route('sup_favorite',$box->id)}}">  <i class="fa fa-star sun-flower" aria-hidden="true" ></i></a>
                                @else 
                                <a  href="{{route('add_favorite',$box->id)}}">  <i class="fa fa-star " aria-hidden="true" ></i></a>
                                @endif
                                
                            </div>
                        </div>
                    </div>
            </div>
        @endforeach
        </div>
    </div>
  
</div> 
@endsection