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
use App\Models\BlogPostsCategory;
use App\Models\Category;
use App\Models\News;
use App\Models\NewandEvent;
use Illuminate\Http\Request;

class FrontViewController extends Controller
{
    public function index()
    {
        $sitesetting = SiteSetting::first();
        $about = About::first();
        $services = Service::where('status', 1)->latest()->take(5)->get();
        $contacts = Contact::latest()->get();
        $blogs = BlogPostsCategory::where('status', 1)->latest()->take(6)->get();
        $coverImages = CoverImage::where('status', 1)->latest()->take(5)->get();
     
        $images = PhotoGallery::where('status', 1)->latest()->take(6)->get(); // Fetch the photos
        $videos = VideoGallery::where('status', 1)->latest()->take(6)->get(); // Fetch the videos
        $newsEvents = News::where('status', 1)->latest()->take(6)->get();
            // Fetch all news
        $types = [ 'Honour', 'Award', 'Judge', 'Album Launch', 'Social Work & Activities', 'Other Events', 'Research & Articles'];
        $allNews = News::where('status', 1)->get();

        // Fetch news by type
        $awardShows = News::where('type', 'Award Shows')->where('status', 1)->get();
        $competitions = News::where('type', 'Competitions')->where('status', 1)->get();
        $events = News::where('type', 'Events')->where('status', 1)->get();
        $videoLaunches = News::where('type', 'Video Launch')->where('status', 1)->get();

            
        // Update the roles to match the values in the database
        $executiveTeam = Team::where('role', 'Executive Team')->where('status', 1)->orderBy('order')->get();
        $advisoryTeam = Team::where('role', 'Advisory Team')->where('status', 1)->orderBy('order')->get();
        $otherTeam = Team::where('role', 'Others')->where('status', 1)->orderBy('order')->get();
    
        $firstCategory = Category::first();
        $posts = $firstCategory ? $firstCategory->posts()->latest()->take(6)->get() : collect();
    
        return view('frontend.index', compact(
            'services', 
            'contacts', 
            'blogs', 
            'sitesetting', 
            'coverImages', 
           
            'about', 
            'posts', 
            'firstCategory', 
            'images', 
            'videos',  
            'executiveTeam',
            'advisoryTeam',
            'otherTeam',
            'newsEvents',
            'types', 
            'allNews',
            'awardShows',
            'competitions',
            'events',
            'videoLaunches'
        ));
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
    $teams = Team::orderBy('order')->where('status', 1)->get()->groupBy('role');
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
