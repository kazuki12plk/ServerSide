@extends('layouts.app')

@section('content')
<div class="container">
  <div class="wrapper">
    <h2>投稿一覧</h2>
    <div class="search">
      <form method="get" class="search-form">
        {{ csrf_field() }}
        <input name="search" type="search" class="form-control" placeholder="投稿内容で検索">
        <button class="btn btn-search" type=" submit" name="submit">検索</button>
      </form>
    </div>
  </div>
  <table>
    @isset($search_result)
    <p>{{ $search_result}}</p>
    @endisset

    @foreach($list as $list)
    <tr>
      <td class="g-item name">name : {{$list->user_name}}</td>
      <td class="g-item date">date : {{$list->created_at}}</td>
      <td class="g-item post">{{$list->contents}}</td>
      <td class="g-item update"><a class="btn" href="/post/{{$list->id}}/update-form">更新</a></td>
      <td class="g-item delete"><a class="btn" href="/post/{{$list->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></td>
    </tr>
    @endforeach
  </table>
  <div class="new">
    <a class="btn btn-success" href="/create-form">投稿する</a>
  </div>
</div>

@endsection
