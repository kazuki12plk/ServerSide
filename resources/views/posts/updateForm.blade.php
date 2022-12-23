@extends('layouts.app')

@section('content')
<div class="container">
  <h2>投稿内容の編集・更新</h2>
  {!! Form::open(['url'=>'/post/update']) !!}
  <div class="form-group">
    {!! Form::hidden('id',$post->id) !!}
    {!! Form::input('text','user_name',$post->user_name,['required','class'=>'form-control']) !!}
    {!! Form::textarea('contents',$post->contents,['required','class'=>'form-control textarea']) !!}
  </div>

  @if ($errors->any())
  <div class="errormessagebox">
    @foreach ($errors->all() as $error)
    <p><strong>{{ $error }}</strong></p>
    @endforeach
  </div>
  @endif

  <button type="submit" class="btn btn-primary">更新</button>
  {!! Form::close() !!}
</div>
@endsection
