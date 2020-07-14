<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\News;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $posts = News::all()->sortByDesc('updated_at');
        
        if (count($posts) > 0) {
            $headline = $posts->shift();
            
        } else {
            $headline = null;
        
        }
        
        return view('profile.index', ['headline' => $headline, 'post' => $posts]);
    }
}
