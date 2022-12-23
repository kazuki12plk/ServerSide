<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //ログインしていないときはloginページへ強制リダイレクト
    }

    public function index(Request $request)
    {
        //検索機能1
        $search = $request->input('search');

        if (empty($search)) {
            //投稿内容の表示
            $list = DB::table('posts')->get();
            return view('posts.index', ['list' => $list]);
        } else {
            // 検索機能2
            $list = DB::table('posts')
                ->where('user_name', 'like', "%{$search}%")
                ->orwhere('contents', 'like', "%{$search}%")
                ->get();
            // $list2 = DB::table('posts')
            //     ->where('user_name', $search)
            //     ->get();
            if (count($list) != 0) {
                // 検索結果を表示
                return view('posts.index', ['list' => $list]);
            } elseif (mb_ereg_match("^(\s|　)+$", $search)) {
                // スペースのみで検索した場合、全件表示
                $list = DB::table('posts')->get();
                return view('posts.index', ['list' => $list]);
            } else {
                // 検索結果がない場合
                $search_result = '検索結果はありません。';
                return view('posts.index', [
                    'list' => $list,
                    'search_result' => $search_result,
                ]);
            }
        }
    }

    public function createForm()
    {
        return view('posts.createForm');
    }

    public function create(Request $request)
    {
        $post = $request->input([
            'user_name', 'contents'
        ]);
        // $_post = str_replace(array(" ", "　"), "", $post);
        // //全角スペースと半角スペースを削除
        // $_post = str_replace('　', ' ', $_post);
        // //全角スペースを半角に変換
        // $_post = preg_replace('/\s(?=\s)/', '', $_post);
        // //連続する半角スペースは削除
        // $_post = trim($_post);
        // //文字列の先頭と末尾にあるホワイトスペースを削除

        $post = $request->validate([
            'user_name' => 'required|space',
            'contents' => 'required|max:100|space',
        ], [
            'user_name.space' => ':attributeは空白以外の文字もご記入下さい。',
            'contents.space' => ':attributeは空白以外の文字もご記入下さい。'
        ]);

        DB::table('posts')->insert([
            'post' => $post
        ]); //DB登録

        return redirect('/index');

        // $post = str_replace('　', ' ', $post);
        //全角スペースを半角に変換
        // $post = preg_replace('/\s(?=\s)/', '', $post);
        //連続する半角スペースは削除
        // $post = trim($post);
        //文字列の先頭と末尾にあるホワイトスペースを削除
        // $post = str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $post);
        //円マーク、パーセント、アンダーバーはエスケープ処理
        // $keywords = array_unique(explode(' ', $post));
        //キーワードを半角スペースで配列に変換し、重複する値を削除


        // ----------------------------------------

        // $post = $request->validate([
        //     'user_name' => 'required',
        //     'contents' => 'required|max:100|',
        // ]);

        // DB::table('posts')->insert([
        //     'post' => $post
        // ]); //DB登録

        // return redirect('/index');
    }

    public function updateForm($id)
    {
        $post = DB::table('posts')
            ->where('id', $id)
            ->first();
        return view('posts.updateForm', ['post' => $post]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $name_up_post = $request->input('user_name');
        $cont_up_post = $request->input('contents');
        $rule = $request->validate([
            'user_name' => 'required',
            'contents' => 'required|max:100',
        ]);

        // $this->validate($request, $rule);

        DB::table('posts')
            ->where('id', $id)
            ->update([
                'user_name' => $name_up_post,
                'contents' => $cont_up_post
            ]);
        return redirect('/index');
    }

    public function delete($id)
    {
        DB::table('posts')
            ->where('id', $id)
            ->delete();
        return redirect('/index');
    }

    // public function index(Request $request)
    // {
    //     $search = $request->input('search') ?? '';

    //     $key = '%' . preg_replace('/([\\[_%])/', '[$1]', $search) . '%';

    //     $rows = Item::where('name', 'LIKE', $key)->get();

    //     // DB::table('posts')
    //     //     ->where('contents', $contents)
    //     //     ->select(
    //     //         '%' . 'search' . '%'
    //     //     );

    //     return response()->json($rows);
    // }
}
