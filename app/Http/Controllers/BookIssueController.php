<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookIssueController extends Controller
{
    public function index()
    {
        return view('bookissue.index');
    }
}
