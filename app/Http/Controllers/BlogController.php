<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Http\Traits\StoreBlogImages;
use App\Models\Blog;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;

class BlogController extends Controller
{
    use StoreBlogImages;
    public function index()
    {
        $blogs = Blog::select(['id', 'title' ,'body', 'image'])->paginate(77);
        return Inertia::render('Blog/Index', ['blogs'=>$blogs]);
    }

    public function create()
    {
        return Inertia::render('Blog/Create');
    }

    public function store(BlogRequest $request)
    {
        
        //save image
        
        if($request->hasFile('image')){
            $image = $this->moveImage($request->file('image'), 'images/blogs');
            // $image_extension = $request->image->getClientOriginalExtension();
            // $path = 'images/blogs';
            // $image = time().'.'.$image_extension;
            // $request->file('image')->move($path, $image);
            Blog::create([
                'image' => $image,
                'title' => $request->validated('title'),
                'body' => $request->validated('body'),
            ]);
        }else{
            Blog::create($request->except('image'));
        }
        // $image_extension = $request->image->getClientOriginalExtension();
        // $path = 'images/blogs';
        // $image = time().'.'.$image_extension;
        // $request->image->move($path, $image);

        return redirect()->route('blogs.index')->with(['message'=>'Blog created successfully']);
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        if(!$blog){
            return redirect()->route('blogs.index')->with(['message'=>'This Blog does\'t Not Exist']);
        }
        $blog = $blog->only(['id', 'title', 'body', 'image']);
        return Inertia::render('Blog/Show', ['blog'=>$blog, 'url'=>env('APP_URL', 'http://localhost:8000').'/images/blogs']);
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        if(!$blog){
            return redirect()->route('blogs.index')->with(['message'=>'This Blog does\'t Not Exist']);
        }

        $blog = $blog->only(['id', 'title', 'body', 'image']);
        return Inertia::render('Blog/update', ['blog'=>$blog]);
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $blog->update($request->validated());
        // sleep(1);
        return redirect()->route('blogs.index')->with(['message'=>'Blog updated successfully']);
    }

    public function destroy($id)
    {
        // return $blog;
        $blog = Blog::find($id);
        if(!$blog){
            return redirect()->route('blogs.index')->with(['message'=>'This Blog does\'t Not Exist']);
        }
        $blog->delete();
        // sleep(1);
        return redirect()->route('blogs.index')->with(['message'=>'Blog Deleted successfully']);
    }
}
