<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = 20;
        $users = User::get();
        $user_id = !empty($request->user_id)?$request->user_id:'';
        $created = !empty($request->created)?$request->created:'desc';

        $data = Blog::with('author');

        if(!empty($user_id)){
            $data = $data->where('user_id', $user_id);
        }
        
        $data = $data->orderBy('id', $created)->paginate($paginate);

        $data = $data->appends([
            'page' => $request->page,
            'user_id' => $user_id,
            'created' => $created
        ]);

        // dd($data);
        return view('blog.index', compact('data','users','user_id','created'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'title' => 'required|max:150',
            'description' => 'required'
        ]);

        $params = $request->except('_token');
        $params['user_id'] = Auth::user()->id;
        $params['created_at'] = date('Y-m-d H:i:s');

        Blog::insert($params);

        Session::flash('message', 'Blog created successfully');
        return redirect()->route('blogs.list');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Blog::findOrFail($id);
        return  view('blog.edit', compact('id','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'title' => 'required|max:150',
            'description' => 'required'
        ]);

        $params = $request->except('_token');
        $params['updated_at'] = date('Y-m-d H:i:s');

        Blog::where('id', $id)->update($params);

        Session::flash('message', 'Blog updated successfully');
        return redirect()->route('blogs.list');
    }

    public function list_comments($id, Request $request)
    {
        $blog = Blog::findOrFail($id);
        $comments = Comment::where('blog_id', $id)->orderBy('id', 'desc')->get();
        return view('comment.list', compact('id','blog','comments'));
    }

    public function add_comment($id, Request $request)
    {
        return view('comment.add', compact('id'));
    }

    public function save_comment(Request $request, $id)
    {
        $request->validate([
            'description' => 'required'
        ],[
            'description.required' => 'Please add some comments'
        ]);

        $params = $request->except('_token');

        $params['blog_id'] = $id;
        $params['user_id'] = Auth::user()->id;
        $params['created_at'] = date('Y-m-d H:i:s');

        Comment::insert($params);

        Session::flash('message', 'Comment created successfully');
        return redirect()->route('blogs.list-comments', $id);
    }
}
