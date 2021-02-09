<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($slug){
        $tag = Tag::query()->where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->with('category')->orderBy('id','desc')->paginate(5);
        return view('tags.show', compact('tag', 'posts'));
    }

}
