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
        // return view('backend.index');
        $studentCount = Team::where('status', 1)->count();
        $contactRequestCount = Contact::count();

        // Pass counts to the view
        return view('backend.index', compact('studentCount', 'contactRequestCount'));
    }
}
