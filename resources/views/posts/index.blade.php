@extends('layouts.app')

@section('content')
<div class="container">
  <h2>投稿一覧</h2>
  <table>
    <!-- <tr>
        <th class="g-item name">name</th>
        <th class="g-item date">date</th>
        <th class="g-item post">post</th>
      </tr> -->
    @foreach($list as $list)
    <tr>
      <td class="g-item name">name : {{$list->user_name}}</td>
      <td class="g-item date">date : {{$list->created_at}}</td>
      <td class="g-item post">{{$list->contents}}</td>
      <td class="g-item update"><a class="btn btn-primary" href="/post/{{$list->id}}/update-form">更新</a></td>
      <td class="g-item delete"><a class="btn btn-danger" href="/post/{{$list->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></td>
    </tr>
    @endforeach
  </table>
</div>

@endsection
