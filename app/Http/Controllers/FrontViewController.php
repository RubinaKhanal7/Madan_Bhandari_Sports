<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\About;
use App\Models\Service;
use App\Models\Contact;
use App\Models\CoverImage;

use App\Models\PhotoGallery;
use App\Models\VideoGallery;
use App\Models\SiteSetting;
use App\Models\Category;
use App\Models\NewandEvent;
use Illuminate\Http\Request;

class FrontViewController extends Controller
{
    public function index()
    {
        $coverimages = CoverImage::latest()->get(5);

        return view('frontend.index', compact('coverimages'));
    }
    
    
    // public function singlePost($slug)
    // {
    //     $post = Post::where('slug', $slug)->firstOrFail();
    //     $relatedPosts = Post::where('id', '!=', $post->id)->get();

    //     return view('frontend.posts', compact('post', 'relatedPosts'));
    // }

    public function showTeam()
    {
        // Fetch all teams grouped by their roles
    $teams = Team::orderBy('order')->where('is_active', 1)->get()->groupBy('role');
   // Define the desired order of roles
   $roleOrder = [
    'Executive Team',
    'Advisory Team',
    'Others'
];

// Sort the groups according to the desired role order
$sortedTeams = collect();
foreach ($roleOrder as $role) {
    if ($teams->has($role)) {
        $sortedTeams->put($role, $teams->get($role));
    }
}






    // Prepare other necessary data
    $page_title = 'All Teams';
    $services = Service::latest()->take(6)->get();
    $sitesetting = SiteSetting::first();
    $categories = Category::latest()->take(10)->get();
    $about = About::first();

    // Return the view with the fetched data
    return view('frontend.team', compact(
        'teams',
        'sitesetting',
        'categories',
        'about',
        'page_title',
        'services',
        'sortedTeams'
    ));
    }

    private function convertTypeToRole($role)
    {
        switch ($role) {
            case 'executive':
                return 'Executive Team';
            case 'advisory':
                return 'Advisory Team';
            case 'others':
                return 'Others';
            default:
                return null;
        }
    }
}
