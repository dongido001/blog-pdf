<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zoopla;

class HomeController extends Controller
{
    // TODO, change this Controllers to be only for Zoopla

    public function index(Request $request) 
    {
        
        if ($request->isMethod('post')) {
            $url = $request->input('url');

            $html = file_get_contents($url);
    
            preg_match('/<div class="col-md-9 main_board"> <div class="row">.*<h5 style="color: #000;">Share this Story<\/h5><div id="share"><\/div>/s', $html, $matches);
        
            $post = $matches[0];
        
            preg_match('/<img.*\/>/s', $post, $image);
        
            $image = $image[0];
            $patterns = array();
            $patterns[0] = '/style=".*"/';
            $replacements = array();
            $replacements[0] = 'width="90" height="120"';
            
            $image = preg_replace($patterns, $replacements, $image);
        
            $post = preg_replace('/<img.*\/>/s', $image , $post);
        
            file_put_contents(public_path().'filename.html', $post);
        
            return \PDF::loadFile(public_path().'filename.html')->save('myfiles.pdf')->stream('download.pdf');
        }

        return view('welcome');
    }
}
