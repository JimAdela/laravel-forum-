@extends('app')

@section('content')
<div class="jumbotron">
      <div class="container">
        <div class="media">   
           <div class="media-left">
             <a href="#">
               <img src="{{$discussion->user->avatar}}" alt="64×64 " class="img-object img-circle" style="width:64px;height:64px;">
             </a>
           </div>
           <div class="media-body">
             <h4 class="media-heading ">{{ $discussion->title}}
             
            </h4>
             {{$discussion->user->name}}
            </div>
            @if (Auth::check() && Auth::user()->id == $discussion->user_id)
                  <a class="btn btn-primary btn-lg  pull-right" href="/discussions/{{$discussion->id}}/edit" role="button">修改帖子</a>
             @endif
         </div>
         
      </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-9" role="main">
      {!! $html !!}
    </div>
  </div>
  <hr>
  @foreach ($discussion->comments()->paginate(10) as $comment)
      <div class="meedia">
        <div class="media-left">
          <a href="">
            <img src="{{$comment->user->avatar}}" class="media-object img-circle" style="width: 64px;heigth:64px">
          </a>
        </div>
        <div class="media-body">
          <h4 class="media-heading">
            {{$comment->user->name}}
          </h4>
          {{$comment->body}}
        </div>
      </div><br>
  @endforeach
   <div class="media" v-for="comment in comments">
        <div class="media-left">
          <a href="">
            <img v-bind:src="@{{comment.avatar}}" class="media-object img-circle" style="width: 64px;heigth:64px">
          </a>
        </div>
        <div class="media-body">
          {{-- <h4 class="media-heading" v-loak>
            @{{comment.name}}
          </h4>
          @{{comment.body}}
        </div> --}}
      </div><br>
  <hr>
  @if (Auth::check())
    {!!Form::open(['url'=>'/comment','v-on:click'=>'onSubmitForm'])!!}
          {!!Form::hidden('discussion_id', $discussion->id)!!}
          <div class="form-group">
              {!!Form::textarea('body', null, ['class'=>'form-control','v-model'=>'newComment.body'])!!}
          </div>
          <div>
              {!!Form::submit('发表评论',['class'=> 'btn btn-success  pull-right'])!!}
          </div>
    {!!Form::close()!!}
    @else
        <a href="/user/login" class="btn btn-block btn-success">登陆参与评论</a>
  @endif
</div>

<script>
  Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
  new Vue({
    el:'#post',
    data:{
      comments:[],
      newComment:{
        name:'{{Auth::user()->name}}',
        avatar:'{{Auth::user()->avatar}}',
        body:''
      },
      newPost:{
        discussion_id:'{{$discussion->id}}',
        user_id:'{{Auth::user()->ud}}',
        body:''
      }
    },
    methods:{
      onSubmitForm:function(e){
        e.preventDefault();
        var comment = this.newComment;
        var post = this.newPost;
        post.body = comment.body;
       this.$http.post('/comment',post).then(function(){
            this.comments.push( comment );
        } );
        this.newComment = {
            name:'{{Auth::user()->name}}',
            avatar:'{{Auth::user()->avatar}}',
            body:''
        }
      }
    }
  })

</script>
   
@stop