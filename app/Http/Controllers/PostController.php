<?php

namespace App\Http\Controllers;

use App\Models\post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class PostController extends Controller
{
    //
    public function create()
    {

        $posts = Post::when(request('searchKey'), function ($query) {
            $key = request('searchKey');
            $query->where('title', 'like', '%' . $key . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        return view('create', compact('posts'));
    }
    public function postCreate(Request $request)
    {
        $this->checkValidation($request);
        $data = $this->getPostData($request);
        if ($request->hasFile('postImage')) {
            $fileName = uniqid() . $request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        Post::create($data);
        return back()->with(['insertSuccess' => 'Post Created Successfully']);
    }
    //Delete Function
    public function postDelete($id)
    {
        //first Way
        Post::where('id', $id)->delete();
        return back();
    }
    //Update Function
    public function postUpdate($id)
    {
        $post = Post::where('id', $id)->first()->toArray();


        return view('update', compact('post'));
    }
    // Edit Function
    public function postEdit($id)

    {

        $post = Post::where('id', $id)->first()->toArray();
        return view('edit', compact('post'));
    }
    public function updatePage(Request $request)
    {
        $this->checkValidation($request);
        $updateData = $this->getPostData($request);
        $id = $request->postId;
        Post::where('id', $id)->update($updateData);
        return redirect()->route('post#home')->with(['insertSuccess' => 'Post Updated Successfully']);
    }
    //Private Function
    private function getPostData($request)
    {
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'image' => $request->postImage
        ];
    }
    //Validation Function
    private function checkValidation($request)
    {

        $validator =  [
            'postTitle' => 'required|min:5|unique:posts,title,' . $request->postId,
            'postDescription' => 'required|min:5'
        ];
        $message = [
            'postTitle.required' => 'Fill This Field!',
            'postTitle.min' => 'Fill AtLeast 5 Char!',
            'postTitle.unique' => 'This Name have been token!Fill Again',
            'postDescription.required' => 'Fill This Field'
        ];
        Validator::make($request->all(), $validator, $message)->validate();
    }
}
