<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\About;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $posts = Post::where('title', 'like', "%$searchTerm%")
            ->orWhere('description', 'like', "%$searchTerm%")
            ->get();

        $abouts = About::where('title', 'like', "%$searchTerm%")
            ->orWhere('description', 'like', "%$searchTerm%")
            ->get();

        $services = Service::where('title', 'like', "%$searchTerm%")
            ->orWhere('description', 'like', "%$searchTerm%")
            ->get();

        $categories = Category::where('title', 'like', "%$searchTerm%")
            ->get();

        $contacts = Contact::where('name', 'like', "%$searchTerm%")
            ->orWhere('email', 'like', "%$searchTerm%")
            ->orWhere('phone_no', 'like', "%$searchTerm%")
            ->orWhere('message', 'like', "%$searchTerm%")
            ->get();

       
        return view('frontend.search-results', compact('posts', 'abouts', 'services', 'categories', 'contacts'));
    }
}