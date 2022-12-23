@extends('layouts.app')

@section('content')
<div class="container">
  <h2>新規投稿</h2>

  {!! Form::open(['url' => 'post/create']) !!}
  <div class="form-group">
    {!! Form::input('text','user_name',old('user_name'),['required','class'=>'form-control','placeholder'=>'名前']) !!}

    {!! Form::textarea('contents',old('contents'),['required','class'=>'form-control textarea','placeholder'=>'投稿内容(上限100文字)']) !!}

    @if ($errors->any())
    <div class="errormessagebox">
      @foreach ($errors->all() as $error)
      <p><strong>{{ $error }}</strong></p>
      @endforeach
    </div>
    @endif

  </div>
  <button type=" submit" class="btn btn-success pull-right">追加</button>
  {!! Form::close() !!}
</div>
@endsection
