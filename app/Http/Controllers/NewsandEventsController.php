<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\NewandEvent;
use App\Models\SummernoteContent;
use Cviebrock\EloquentSluggable\Services\SlugService;

class NewsandEventsController extends Controller
{
    public function index()
    {
        $newsAndEvents = NewandEvent::latest()->paginate(10);
        return view('backend.news_and_events.index', [
            'newsAndEvents' => $newsAndEvents,
            'page_title' => 'News and Events'
        ]);
    }

    public function create()
    {
        $summernoteContent = new SummernoteContent();
        return view('backend.news_and_events.create', [
            'page_title' => 'Create News or Event',
            'summernoteContent' => $summernoteContent
        ]);
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required',
            'content' => 'required',
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
    
            // Create a new NewsAndEvents instance
            $newsAndEvent = new NewAndEvent();
            $newsAndEvent->title = $request->title;
            $newsAndEvent->slug = SlugService::createSlug(NewAndEvent::class, 'slug', $request->input('title'));
            $newsAndEvent->content = $processedContent;
            $newsAndEvent->image = $newImageName;
            $newsAndEvent->status = $request->status;
            // Save the model and redirect
            if ($newsAndEvent->save()) {
                return redirect()->route('admin.news-and-events.index')->with('success', 'News or Event created successfully.');
            } else {
                return redirect()->back()->with('error', 'Error! News or Event not created.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error! ' . $e->getMessage());
        }
    }
    

    public function edit($id)
    {
        $newsEvent = NewAndEvent::findOrFail($id);
        return view('backend.news_and_events.update', compact('newsEvent'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean'
        ]);

        try {
            $newsAndEvent = NewAndEvent::findOrFail($id);

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
            $newsAndEvent->slug = SlugService::createSlug(NewAndEvent::class, 'slug', $request->input('title'), ['unique' => false, 'source' => 'title', 'onUpdate' => true], $id);
            $newsAndEvent->status = $request->input('status');
            $newsAndEvent->save();

            return redirect()->route('admin.news-and-events.index')->with('success', 'News or Event updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Error updating news or event: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $newsAndEvent = NewAndEvent::findOrFail($id);

            if ($newsAndEvent->image && file_exists(public_path('uploads/newsandevents/' . $newsAndEvent->image))) {
                unlink(public_path('uploads/newsandevents/' . $newsAndEvent->image));
            }

            $newsAndEvent->delete();
            return redirect()->route('admin.news-and-events.index')->with('success', 'News or Event deleted successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Error deleting news or event: ' . $e->getMessage());
        }
    }
}
