<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Team;
use App\Models\BlogPostsCategory;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contactRequestCount = Contact::count();

        // Pass counts to the view
        return view('backend.index', compact('contactRequestCount'));
    }
}
