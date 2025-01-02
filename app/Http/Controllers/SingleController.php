<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Team;
use App\Models\About;
use App\Models\Service;
use App\Models\Category;
use App\Models\SiteSetting;
use App\Models\PhotoGallery;
use App\Models\VideoGallery;
use Illuminate\Http\Request;


use Illuminate\Support\Str;

class SingleController extends Controller
{


    public function render_about()
    {
        // $page_title = "About Us";
   
        $about = About::first();
        // $teams = Team::all();
        
        $services = Service::where('status', 1)->latest()->get();

        $posts = Post::with('category')->latest()->get()->take(3);
     
        $listservices = Service::latest()->get()->take(5);
      
  
        

        return view('frontend.aboutus', compact('about', 'posts','listservices', 'message', 'services'));

    }



//     public function render_team($type)
// {

//     $type = strtolower($type);


//     $validRoles = ['executive', 'advisory', 'others'];
//     if (!in_array($type, $validRoles)) {
//         abort(404); // Type not valid, show a 404 page
//     }


//     $capitalizedType = ucfirst($type);

//     $teams = Team::where('role', $capitalizedType)->latest()->get();


//     $page_title = $capitalizedType . ' Team';
//     $services = Service::latest()->get()->take(6);
//     $sitesetting = SiteSetting::first();
//     $categories = Category::latest()->get()->take(10);
//     $about = About::first();
//     $posts = Post::with('category')->latest()->get()->take(3);


//     return view('frontend.team', compact('teams', 'sitesetting', 'categories', 'about', 'page_title', 'services', 'posts'));
// }
//     public function render_team()
// {


//        $executiveTeam = Team::where('role', 'Executive Team')->orderBy('order')->get();
//        $advisoryTeam = Team::where('role', 'Advisory Team')->orderBy('order')->get();
//        $otherTeam = Team::where('role', 'Others')->orderBy('order')->get();


   
//     $services = Service::latest()->get()->take(6);
//     $sitesetting = SiteSetting::first();
//     $categories = Category::latest()->get()->take(10);
//     $about = About::first();
//     $posts = Post::with('category')->latest()->get()->take(3);


//     return view('frontend.team', compact('executiveTeam', 'advisoryTeam', 'otherTeam', 'sitesetting', 'categories', 'about', 'page_title', 'services', 'posts'));
// }




    public function render_service()
    {
        $images = PhotoGallery::where('status', 1)->latest()->get();
        $categories = Category::all();
        $services = Service::where('status', 1)->latest()->get();
        $sitesetting = SiteSetting::first();
        $about = About::first();
        $serviceHead = Service::latest()->get()->take(1);

        return view('frontend.services', compact('images', 'services', 'categories', 'sitesetting', 'about', 'serviceHead'));
    }


    public function render_singleService($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $images = PhotoGallery::latest()->get();
        $categories = Category::all();
        $services = Service::latest()->get();
        $sitesetting = SiteSetting::first();
        $about = About::first();
        $listservices = Service::where('slug', '!=', $slug)->get();

        return view('frontend.service', compact('service', 'images', 'services', 'categories', 'sitesetting', 'about', 'listservices'));
    }


    public function render_singleCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $relatedCategories = Category::where('id', '!=', $category->id)->get();
        $posts = $category->posts()->paginate(10);
        return view('frontend.category', compact('category', 'relatedCategories', 'posts'));
    }

    public function render_singlePost($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        // Get the category associated with the post
        $category = $post->category;

        // Get all posts related to the same category
        $relatedPosts = $category->posts()->where('id', '!=', $post->id)->get();
        return view('frontend.post', compact('post', 'relatedPosts'));
    }


    public function render_gallery()
    {
        $images = PhotoGallery::where('status', 1)->latest()->get();
        $categories = Category::all();
        $services = Service::where('status', '1')->latest()->get();
        $sitesetting = SiteSetting::first();
        $about = About::first();

        return view('frontend.galleries', compact('images', 'services', 'categories', 'sitesetting', 'about'));
    }

    public function render_singleImage($slug)
    {
        $image = PhotoGallery::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $services = Service::where('status', 1)->latest()->get();
        $sitesetting = SiteSetting::first();
        $about = About::first();

        return view('frontend.singleImage', compact('image', 'services', 'categories', 'sitesetting', 'about'));

    }


    public function render_videos()
    {
        $videos = VideoGallery::where('status', 1)->latest()->get();
        $categories = Category::all();
        $services = Service::where('status', 1)->latest()->get();
        $sitesetting = SiteSetting::first();
        $about = About::first();

        return view('frontend.video', compact('videos', 'services', 'categories', 'sitesetting', 'about'));
    }

    public function teams()
    {
        $teams = Team::latest()->get();
        $categories = Category::all();
        $services = Service::where('status', 1)->latest()->get();
        $sitesetting = SiteSetting::first();
        $about = About::first();

        return view('portal.team', compact('teams', 'services', 'categories', 'sitesetting', 'about'));
    }

    public function render_contact()
    {
        $page_title = 'Contact Us';
        $googleMapsLink = SiteSetting::first()->google_maps_link;
        return view('frontend.contactpage', compact('page_title', 'googleMapsLink'));
    }

    
}