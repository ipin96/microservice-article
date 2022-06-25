<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        return 'Microservice Article';   
    }

    public function get($status)
    {
        $posts = Post::where('status', $status)->orderBy('created_at', 'DESC')->get();
        if($posts->isEmpty()){
            return response()->json([
                'code'      => 200,
                'message'   => 'Data kosong',
                'response'  => $posts
            ], 200);
        }else{
            return response()->json([
                'code'      => 200,
                'message'   => 'Data ditemukan',
                'response'  => $posts
            ], 200);
        }
    }

    public function show($limit, $offset)
    {
        $posts = Post::orderBy('created_at', 'DESC')->limit($limit)->offset($offset)->get();
        if($posts->isEmpty()){
            return response()->json([
                'code'      => 200,
                'message'   => 'Data kosong',
                'response'  => $posts
            ], 200);
        }else{
            return response()->json([
                'code'      => 200,
                'message'   => 'Data ditemukan',
                'response'  => $posts
            ], 200);
        }
    }

    public function edit($id)
    {
        $posts = Post::orderBy('created_at', 'DESC')->find($id);
        if(empty($posts)){
            return response()->json([
                'code'      => 200,
                'message'   => 'Data kosong',
                'response'  => $posts
            ], 200);
        }else{
            return response()->json([
                'code'      => 200,
                'message'   => 'Data ditemukan',
                'response'  => $posts
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, $this->rules(), $this->message());

        if ($validated == NULL) {
            return response()->json([
                'code'      => 412,
                'message'   => 'Inputan tidak sesuai',
                'response'  => $validated
            ], 412);
        }
        Post::create([
            'title'     => $request->title,
            'content'   => $request->content,
            'category'  => $request->category,
            'status'    => $request->status,
            'created_at'=> \Carbon\Carbon::now(),
            'updated_at'=> \Carbon\Carbon::now()
        ]);

        return response()->json([
            'code'      => 200,
            'message'   => 'Berhasil',
            'response'  => 'Data article berhasil disimpan'
        ], 200);
    }

    public function update($id, Request $request)
    {
        $validated = $this->validate($request, $this->rules(), $this->message());

        if ($validated == NULL) {
            return response()->json([
                'code'      => 412,
                'message'   => 'Inputan tidak sesuai',
                'response'  => $validated
            ], 412);
        }
        Post::where('id', $id)->update([
            'title'     => $request->title,
            'content'   => $request->content,
            'category'  => $request->category,
            'status'    => $request->status,
            'created_at'=> \Carbon\Carbon::now(),
            'updated_at'=> \Carbon\Carbon::now()
        ]);

        return response()->json([
            'code'      => 200,
            'message'   => 'Berhasil',
            'response'  => 'Data article berhasil diubah'
        ], 200);
    }

    public function destroy($id)
    {
        $posts = Post::find($id);
        if(empty($posts)){
            return response()->json([
                'code'      => 401,
                'message'   => 'Data tidak ditemukan',
                'response'  => $posts
            ], 401);
        }

        $posts->destroy($id);
        return response()->json([
            'code'      => 200,
            'message'   => 'Berhasil',
            'response'  => 'Data article berhasil dihapus'
        ], 200);

    }

    public function rules()
    {
        $rules = [
            'title'     => 'required|min:20',
            'content'   => 'required|min:200',
            'category'  => 'required|min:3',
            'status'    => 'required|in:Publish,Draft,Thrash'
        ];
        return $rules;
    }

    public function message()
    {
        $message = [
            'title.required'    => 'Title tidak boleh kosong',
            'title.min'         => 'Title minimal 20 karakter',
            'content.required'  => 'Content tidak boleh kosong',
            'content.min'       => 'Content minimal 200 karakter',
            'category.required' => 'Category tidak boleh kosong',
            'category.min'      => 'Category minimal 3 karakter',
            'status.required'   => 'Status tidak boleh kosong',
            'status.in'         => 'Status hanya boleh di isi (publish/draft/thrash)',
        ];
        return $message;
    }
}
