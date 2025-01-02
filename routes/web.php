<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SingleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaviconController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontViewController;
use App\Http\Controllers\CoverImageController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\PhotoGalleryController;
use App\Http\Controllers\VideoGalleryController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\TeamTypeController;
use App\Http\Controllers\SocialMediaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/lang/{lang}',function ($lang){
//     app()->setLocale($lang);
//     session()->put('locale',$lang);
//     return redirect()->route('fronted.index');
// });


Route::get('/lang/{lang}', function ($lang) {
    // Validate the provided locale
    $supportedLocales = config('app.available_locales');
    if (!in_array($lang, array_keys($supportedLocales))) {
        // Invalid locale provided, handle error (e.g., redirect to default locale)
        return redirect()->route('fronted.index'); // Redirect to homepage
    }

    // Set the application locale
    app()->setLocale($lang);

    // Store the locale in the session
    session()->put('locale', $lang);

    // Redirect to the homepage or landing page
    return redirect()->route('fronted.index');
});






// Frontend routes

Route::get('/', [FrontViewController::class, 'index'])->name('index');
Route::get('/singleposts/{slug}', [FrontViewController::class, 'singlePost'])->name('SinglePost');
Route::post('/contactpage', [ContactController::class, 'store'])->name('Contact.store');
// Route::get('/team', [FrontViewController::class, 'showTeam'])->name('Team');

//Routes for SingleController
Route::prefix('/')->group(function () {
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::get('/contactpage', [SingleController::class, 'render_contact'])->name('Contact');
    Route::get('/aboutus', [SingleController::class, 'render_about'])->name('About');
    Route::get('/testimonial', [SingleController::class, 'render_testimonial'])->name('Testimonial');
    Route::get('/blogpostcategories', [SingleController::class, 'render_blogpostcategory'])->name('Blogpostcategory');
    Route::get('/blogpostcategory/{slug}', [SingleController::class, 'render_singleBlogpostcategory'])->name('SingleBlogpostcategory');
    Route::get('/newsandevents', [SingleController::class, 'render_newsandevents'])->name('NewsandEvents');
    Route::get('/newsandevents/{slug}', [SingleController::class, 'render_singlenewsandevents'])->name('SingleNewsandEvents');
    Route::get('/team', [FrontViewController::class, 'showTeam'])->name('Team');
    
    Route::get('/awards', [SingleController::class, 'render_service'])->name('Service');
    Route::get('/awards/{slug}', [SingleController::class, 'render_singleService'])->name('SingleService');
    Route::get('/demands', [SingleController::class, 'render_demands'])->name('Demand');
    Route::get('/apply/{id}', [SingleController::class, 'showApplicationForm'])->name('apply');
    Route::post('/apply/{id}', [SingleController::class, 'submitApplication'])->name('submitApplication');


    Route::get('/singledemand/{id}', [SingleController::class, 'render_demand'])->name('SingleDemand');
    Route::get('/gallery', [SingleController::class, 'render_gallery'])->name('Gallery');
    Route::get('/video', [SingleController::class, 'render_videos'])->name('Video');
    Route::get('/countries', [SingleController::class, 'render_Countries'])->name('Countries');
    Route::get('/singlecountry/{slug}', [SingleController::class, 'render_singleCountry'])->name('singleCountry');
    Route::get('/singlecompany/{slug}', [SingleController::class, 'singleCompany'])->name('singleCompany');
    Route::get('/singleworkcategory/{slug}', [SingleController::class, 'render_singleworkCategory'])->name('singleworkCategory');
    Route::get('/singlecategory/{slug}', [SingleController::class, 'render_singleCategory'])->name('singleCategory');
    Route::get('/singlepost/{slug}', [SingleController::class, 'render_singlePost'])->name('singlePost');
    Route::get('/gallerys/{slug}', [SingleController::class, 'render_singleImage'])->name('singleImage');

    // Route::get('/ceo-message', [CeomessageController::class, 'showCeoMessage'])->name('ceo.message');

});

// Authentication routes
Auth::routes();
Route::post('/change-password', [ResetPasswordController::class, 'updatePassword'])->name('changePassword')->middleware('auth');

// Backend routes with prefix and middleware
Route::prefix('/admin')->name('admin.')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    
    Route::get('site-settings', [SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::get('site-settings/edit/{id}', [SiteSettingController::class, 'edit'])->name('site-settings.edit');
    Route::put('site-settings/update/{id}', [SiteSettingController::class, 'update'])->name('site-settings.update');
    
    Route::get('socialmedia', [SocialMediaController::class, 'index'])->name('socialmedia.index');
    Route::get('socialmedia/edit/{id}', [SocialMediaController::class, 'edit'])->name('socialmedia.edit');
    Route::put('socialmedia/update/{id}', [SocialMediaController::class, 'update'])->name('socialmedia.update');
    
    Route::resource('cover-images', CoverImageController::class);

    // About us
    Route::resource('about-us', AboutController::class);

    //Role and permission
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
    

    // Services
    Route::resource('services', ServiceController::class);

    // Categories
    Route::resource('categories', CategoryController::class);

    // Posts
    Route::resource('posts', PostController::class);

    // Photo galleries
    Route::resource('photo-galleries', PhotoGalleryController::class);

    // Video galleries
    Route::resource('video-galleries', VideoGalleryController::class);
        
    // Teams

    Route::get('/teams', [TeamController::class, 'index'])->middleware('auth');
    Route::get('/teams/index', [TeamController::class, 'index'])->middleware('auth')->name('teams.index');
    Route::get('/teams/create', [TeamController::class, 'create'])->middleware('auth')->name('teams.create');
    Route::post('/teams/store', [TeamController::class, 'store'])->name('teams.store');
    Route::get('/teams/edit/{id}', [TeamController::class, 'edit'])->middleware('auth')->name('teams.edit');
    Route::put('/teams/update/{id}', [TeamController::class, 'update'])->name('teams.update');
    Route::delete('/teams/delete/{id}', [TeamController::class, 'destroy'])->middleware('auth')->name('teams.destroy');

    //member types
    Route::get('/member_types', [MemberTypeController::class, 'index'])->name('member_types.index');
    Route::post('/member_types', [MemberTypeController::class, 'store'])->name('member_types.store');
    Route::put('/member_types/{id}', [MemberTypeController::class, 'update'])->name('member_types.update');
    Route::delete('/member_types/{id}', [MemberTypeController::class, 'destroy'])->name('member_types.destroy');


    // Contact
    Route::resource('contacts', ContactController::class);

    // Favicon controller
    Route::resource('favicons', FaviconController::class);


    // Teams types

        Route::get('team-types/', [TeamTypeController::class, 'index'])->name('team-types.index');
        Route::post('team-types/store', [TeamTypeController::class, 'store'])->name('team-types.store');
        Route::put('team-types/update/{teamType}', [TeamTypeController::class, 'update'])->name('team-types.update');
        Route::delete('team-types/destroy/{teamType}', [TeamTypeController::class, 'destroy'])->name('team-types.destroy');



});

Route::get('/blogs', [FrontViewController::class, 'blogs'])->name('blogs.index');

Route::get('/news', [FrontViewController::class, 'news'])->name('news.index');

Route::get('/courses/{slug}', 'FrontViewController@viewCourse');

// Route::post('/apply/{id}', [ApplicationController::class, 'store'])->name('apply.store');
// Route::get('/admin/applications', [ApplicationController::class, 'adminIndex'])->name('admin.applications.index');
// Route::post('/applications/{id}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
// Route::post('/applications/{id}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');


Route::post('/contact-submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/verify-email/{token}', [ContactController::class, 'verifyEmail'])->name('verify.email');

