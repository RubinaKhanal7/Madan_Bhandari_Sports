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
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\MemberTypeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\MetadataController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\LocalGovernmentController;
use App\Http\Controllers\MouController;
use App\Http\Controllers\LanguageController;

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
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::post('/users/{user}/approve', [UserManagementController::class, 'approve'])->name('users.approve');
});
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Auth::routes(['verify' => true]);

// Route to handle the verification when the user clicks the link in the email
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

// Route to resend the verification email
Route::post('/email/resend', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

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

//Language Switcher Route

Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

// Backend routes with prefix and middleware
Route::prefix('/admin')->name('admin.')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::get('site-settings', [SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::get('site-settings/edit/{id}', [SiteSettingController::class, 'edit'])->name('site-settings.edit');
    Route::put('site-settings/update/{id}', [SiteSettingController::class, 'update'])->name('site-settings.update');
    Route::patch('/site-settings/{id}/toggle-status', [SiteSettingController::class, 'toggleStatus'])->name('site-settings.toggle-status');
    
    
    Route::get('socialmedia', [SocialMediaController::class, 'index'])->name('socialmedia.index');
    Route::get('socialmedia/edit/{id}', [SocialMediaController::class, 'edit'])->name('socialmedia.edit');
    Route::put('socialmedia/update/{id}', [SocialMediaController::class, 'update'])->name('socialmedia.update');
    
    Route::resource('cover-images', CoverImageController::class);
    Route::patch('cover-images/{coverImage}/toggle-status', [CoverImageController::class, 'toggleStatus'])
    ->name('cover-images.toggle-status');

    // About us
    Route::resource('about-us', AboutController::class);

    //Role and permission
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
    
    // Services
    Route::resource('services', ServiceController::class);

    // Categories
    Route::resource('categories', CategoryController::class);
    Route::post('categories/{category}/metadata', [CategoryController::class, 'storeMetadata'])->name('categories.metadata.store');
    Route::put('categories/{category}/metadata', [CategoryController::class, 'updateMetadata'])->name('categories.metadata.update');
    Route::put('/categories/{category}/update-status', [CategoryController::class, 'updateStatus'])->name('categories.updateStatus');

    // Posts
    Route::resource('posts', PostController::class);
    Route::post('posts/{post}/metadata', [PostController::class, 'storeMetadata'])->name('posts.metadata.store');
    Route::put('posts/{post}/metadata', [PostController::class, 'updateMetadata'])->name('posts.metadata.update');
    Route::patch('/posts/{post}/toggle-featured', [PostController::class, 'toggleFeatured'])->name('posts.toggle-featured');
    Route::patch('/posts/{post}/toggle-status', [PostController::class, 'toggleStatus'])->name('posts.toggle-status');
    Route::post('/posts/{post}/add-images', [PostController::class, 'addImages'])->name('posts.add-images');
    Route::delete('/posts/{post}/delete-image/{index}', [PostController::class, 'deleteImage'])->name('posts.delete-image');

    // Photo galleries
    Route::resource('photo-galleries', PhotoGalleryController::class);
    Route::post('photo-gallery/{id}/update-status', [PhotoGalleryController::class, 'updateStatus'])->name('photo-gallery.update-status');
    Route::post('photo-gallery/{id}/update-featured', [PhotoGalleryController::class, 'updateFeatured'])->name('photo-gallery.update-featured');
    Route::post('photo-galleries/{id}/metadata', [PhotoGalleryController::class, 'storeMetadata'])->name('photo-galleries.metadata.store');


    // Video galleries
    Route::resource('video-galleries', VideoGalleryController::class);
    Route::patch('/video-galleries/{videoGallery}/toggle-featured', [VideoGalleryController::class, 'toggleFeatured'])
    ->name('video-galleries.toggle-featured');
    Route::patch('/video-galleries/{videoGallery}/toggle-status', [VideoGalleryController::class, 'toggleStatus'])
    ->name('video-galleries.toggle-status');
    Route::post('video-galleries/{id}/metadata', [VideoGalleryController::class, 'storeMetadata'])->name('video-galleries.metadata.store');

    //Users
    Route::resource('users', UserManagementController::class);
    Route::post('users/{user}/approve', [UserManagementController::class, 'approve'])->name('users.approve');

    //Metadata
    Route::resource('meta-data', MetaDataController::class);

    //FAQ
    Route::resource('faqs', FaqController::class);

    //Province
    Route::resource('provinces', ProvinceController::class);
    Route::put('provinces/{province}/update-status', [ProvinceController::class, 'updateStatus'])->name('provinces.updateStatus');

    //District
    Route::resource('districts', DistrictController::class);
    Route::put('districts/{district}/update-status', [DistrictController::class, 'updateStatus'])->name('districts.updateStatus');

    //LocalGovernment
    Route::resource('local-governments', LocalGovernmentController::class);
    Route::put('local-governments/{localGovernment}/update-status', [LocalGovernmentController::class, 'updateStatus'])->name('local-governments.updateStatus');

    //MOU
    Route::resource('mous', MouController::class);
    Route::patch('/mous/{mou}/toggle-featured', [MouController::class, 'toggleFeatured'])->name('mous.toggle-featured');
    Route::patch('/mous/{mou}/toggle-status', [MouController::class, 'toggleStatus'])->name('mous.toggle-status');
    Route::post('/mous/{mou}/add-images', [MouController::class, 'addImages'])->name('mous.add-images');
    Route::get('/mous/get-districts', [MouController::class, 'getDistricts'])->name('mous.get-districts');
    Route::get('/mous/get-locals', [MouController::class, 'getLocals'])->name('mous.get-locals');
        
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
    Route::patch('/{memberType}/toggle-status', [MemberTypeController::class, 'toggleStatus'])->name('member_types.toggle-status');

    // Contact
    Route::resource('contacts', ContactController::class);

    // Favicon controller
    Route::resource('favicons', FaviconController::class);
    Route::patch('favicons/{favicon}/toggle-status', [FaviconController::class, 'toggleStatus'])
        ->name('favicons.toggle-status');


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

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

