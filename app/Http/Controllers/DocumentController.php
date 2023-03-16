<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function documents($slug)
    {
        $category=Category::where('slug',$slug)->firstorfail();
        $documents=Post::where('category_id',$category->id)->where('public',0)->orderby('id','desc')->paginate(6);
        $category=$category->name;
        return view('admin.documents.documents',compact('documents','category'));
    }

    public function document($slug)
    {
        $post=Post::where('slug',$slug)->where('public','0')->first();
        return view('admin.documents.document',compact('post'));
    }

    public function documentsSearch(Request $request)
    {
        $category = request("query");
        $documents = Post::where("title","like","%$category%")->where('public',0)->latest()->paginate(9);
        return view('admin.documents.documents',compact('documents','category'));
    }
    public function uploadPdf(Request $request)
    {
        $file= $request->file('file');

        if($file){
            $file_path = $file->store('images/blog', 'public');
            return response(['status' => 1, 'path' => asset('storage/'.$file_path)], 200);
        }
        return response(['status' => 0, 'errors' => 'Unexpected error! '], 400);
    }
}
