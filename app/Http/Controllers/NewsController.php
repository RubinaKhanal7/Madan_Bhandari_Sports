<?php

namespace App\Http\Controllers;

use App\Models\News;
use Exception;
use Illuminate\Http\Request;
use App\Models\SummernoteContent;
use Cviebrock\EloquentSluggable\Services\SlugService;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsAndEvents = News::latest()->paginate(10);
        return view('backend.news_and_events.index', [
            'newsAndEvents' => $newsAndEvents,
            'page_title' => 'News and Events'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $summernoteContent = new SummernoteContent();
        $types = [
            'Honour', 'Award', 'Judge', 'Album Launch', 'Social Work & Activities', 'Other Events', 'Research & Articles'
        ];
        return view('backend.news_and_events.create', [
            'page_title' => 'Create News or Event',
            'summernoteContent' => $summernoteContent,
            'types' => $types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'type' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean'
        ]);
    
        try {
            // Handle the image upload
            $newImageName = null;
            if ($request->hasFile('image')) {
                $newImageName = time() . '-' . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/newsandevents'), $newImageName);
            }
    
            // Process the content with SummernoteContent
            $summernoteContent = new SummernoteContent();
            $processedContent = $summernoteContent->processContent($request->input('content'));
    
            // Create a new News instance
            $newsAndEvent = new News();
            $newsAndEvent->title = $request->title;
            $newsAndEvent->slug = SlugService::createSlug(News::class, 'slug', $request->input('title'));
            
            // Correctly assign the type instead of overwriting the object
            $newsAndEvent->type = $request->type;
            $newsAndEvent->content = $processedContent;
            $newsAndEvent->image = $newImageName;
            $newsAndEvent->status = $request->status;
    
            // Save the model and redirect
            if ($newsAndEvent->save()) {
                return redirect()->route('admin.news.index')->with('success', 'News or Event created successfully.');
            } else {
                return redirect()->back()->with('error', 'Error! News or Event not created.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error! ' . $e->getMessage());
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newsEvent = News::findOrFail($id);
        $types = [
            'Honour', 'Award', 'Judge', 'Album Launch', 'Social Work & Activities', 'Other Events', 'Research & Articles'
        ];
        return view('backend.news_and_events.update', compact('newsEvent', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'type' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $newsAndEvent = News::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($newsAndEvent->image && file_exists(public_path('uploads/newsandevents/' . $newsAndEvent->image))) {
                    unlink(public_path('uploads/newsandevents/' . $newsAndEvent->image));
                }

                $newImageName = time() . '-' . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/newsandevents'), $newImageName);
                $newsAndEvent->image = $newImageName;
            }

            // Process the content with SummernoteContent
            $summernoteContent = new SummernoteContent();
            $processedContent = $summernoteContent->processContent($request->input('content'));

            $newsAndEvent->title = $request->input('title');
            $newsAndEvent->content = $processedContent;
            $newsAndEvent->type = $request->input('type'); 
            // $newsAndEvent->slug = SlugService::createSlug(News::class, 'slug', $request->input('title'));
            $newsAndEvent->slug = SlugService::createSlug(News::class, 'slug', $request->input('title'), ['unique' => false, 'source' => 'title', 'onUpdate' => true], $id);
            $newsAndEvent->status = $request->input('status');
            $newsAndEvent->save();

            return redirect()->route('admin.news.index')->with('success', 'News or Event updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Error updating news or event: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $newsAndEvent = News::findOrFail($id);

            if ($newsAndEvent->image && file_exists(public_path('uploads/newsandevents/' . $newsAndEvent->image))) {
                unlink(public_path('uploads/newsandevents/' . $newsAndEvent->image));
            }

            $newsAndEvent->delete();
            return redirect()->route('admin.news.index')->with('success', 'News or Event deleted successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Error deleting news or event: ' . $e->getMessage());
        }
    }
}
