<?php

namespace App\Http\Controllers;


class WebController extends Controller
{
    public function index($page)
    {
        if($page=='home')
        {
            return view('index',[ 'pages' => $page]);
        }
        else if($page=='about')
        {
            return view('about',[ 'pages' => $page]);
        }
        else if($page=='services')
        {
            return view('services',[ 'pages' => $page]);
        }
        else if($page=='contact')
        {
            return view('contact',[ 'pages' => $page]);
        }
        else
        {
            return view('index',[ 'pages' => $page]);
        }
    }
}
