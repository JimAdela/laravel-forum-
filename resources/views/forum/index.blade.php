@extends('app')

@section('content')
<div class="jumbotron">
      <div class="container">
        <h2>Hello, Laravel!   
            <a class="btn btn-primary btn-lg pull-right" href="#" role="button">发布新帖子 »</a>
            </h2>
      </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-9" role="main">
     @foreach ($discussions as $discussion)
         <div class="media">   
           <div class="media-left">
             <a href="#">
               <img src="{{$discussion->user->avatar}}" alt="64×64 " class="img-object img-circle" style="width:64px;height:64px;">
             </a>
           </div>
           <div class="media-body">
             <h4 class="media-heading">{{ $discussion->title}}</h4>
             {{$discussion->user->name}}
           </div>
         </div>
     @endforeach
    </div>
  </div>
</div>
   
@stop