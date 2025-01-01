<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Team;
use App\Models\About;
use App\Models\WorkCategory;
use App\Models\Country;
use App\Models\Service;
use App\Models\Category;
use App\Models\CoverImage;
use App\Models\Company;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\PhotoGallery;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use App\Models\DirectorMessage;
use App\Models\BlogPostsCategory;
use App\Models\Demand;
use App\Models\NewandEvent;
use App\Models\News;

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
        $message = DirectorMessage::first();
  
        

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

    public function render_testimonial()
    {
        $testimonials = Testimonial::where('status',1)->latest()->take(12)->get();

        return view('frontend.testimonials', compact('testimonials'));
    }



    public function render_blogpostcategory()
    {
        $blogpostcategories = BlogPostsCategory::where('status',1)->latest()->get()->take(18);

        return view('frontend.blogpostcategories', compact('blogpostcategories'));
    }

    public function render_singleBlogpostcategory($slug)
    {
        
        $blogpostcategory = BlogPostsCategory::where('slug', $slug)->firstOrFail();
        $listblogs = BlogPostsCategory::where('slug', '!=', $slug)->latest()->get()->take(5);

        return view('frontend.blogpostcategory', compact('blogpostcategory', 'listblogs'));
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

   
    public function render_singleworkCategory($slug)
    {
        $work_category = WorkCategory::where('slug', $slug)->firstOrFail();
        $listwork_category = WorkCategory::latest()->get()->take(4);
        return view('frontend.work_category', compact('work_category', 'listwork_category'));
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

    public function render_demand($id)
    {
        $demand = Demand::where('id', $id)->firstOrFail();
        $listdemands = Demand::where('id', '!=', $id)->get();
        return view('frontend.demand', compact('demand','listdemands'));
    }

    public function render_demands()
    {
        $demands = Demand::all();
        return view('frontend.demands', compact('demands'));
    }

    public function render_newsandevents()
    {
        // Fetch all news and events
        $newsEvents = News::where('status', 1)->latest()->get();

        return view('frontend.newsandevents', compact('newsEvents'));
    }

    public function render_singlenewsandevents($slug)
    {
        // Fetch the single news or event by slug
        $newsEvent = News::where('slug', $slug)->firstOrFail();

           // Use this to dynamically add data for sharing
    $shareData = [
        'title' => $newsEvent->title,
        'url' => route('SingleNewsandEvents', ['slug' => $newsEvent->slug]),
        'image' => asset('uploads/newsandevents/' . $newsEvent->image),
        'description' => Str::limit(strip_tags($newsEvent->content), 150)
    ];
        // Fetch related news/events
        $relatedNewsEvents = News::where('slug', '!=', $slug)->latest()->take(5)->get();

        return view('frontend.newsandevent', compact('newsEvent', 'relatedNewsEvents', 'shareData'));
    }
    
}