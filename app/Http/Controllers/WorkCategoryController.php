<?php

namespace App\Http\Controllers;

use App\Models\WorkCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\SummernoteContent;

class WorkCategoryController extends Controller
{
    public function index()
    {
        $work_categories = WorkCategory::latest()->paginate(5);
        $summernoteContent = new SummernoteContent();
        return view('backend.work_category.index', ['work_categories' => $work_categories,'summernoteContent' => $summernoteContent, 'page_title' => 'Work Category']);


    }
    public function create()
    {
        return view('backend.work_category.create', ['page_title' => 'Work Category']);

        
    }
    public function store(Request $request)
    {
        
        try {
            $this->validate($request, [
                'title' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
                'description' => 'required|string',

            ]);
            // Process Summernote content using the SummernoteContent model
            $summernoteContent = new SummernoteContent();
            $processedDescription = $summernoteContent->processContent($request->description);


            $newImageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/workcategory'), $newImageName);

            $about = new WorkCategory;
            $about->title = $request->title;
            $about->description = $processedDescription;
            $about->slug = SlugService::createSlug(WorkCategory::class, 'slug', $request->title);
            $about->image = $newImageName;

            if ($about->save()) {
                return redirect()->route('admin.work_categories.index')->with('success', 'Success! Work Category created.');
            } else {
                return redirect()->back()->with('error', 'Error! Work Category  not created.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error! Something went wrong.');
        }
    }
    public function edit($id)
    {
        $work_categories = WorkCategory::find($id);
        return view('backend.work_category.update', ['work_categories' => $work_categories, 'page_title' => 'Update Work Category']);

    }
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'title' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
                'description' => 'required|string',
            ]);

            $work_category = WorkCategory::find($id);
            if (!$work_category) {
                return redirect()->back()->with('error', 'Error! Work Category not found.');
            }

            if ($request->hasFile('image')) {
                $newImageName = time() . '-' . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/workcategory'), $newImageName);
                $work_category->image = $newImageName;
            }

            // Process Summernote content using the SummernoteContent model
            $summernoteContent = new SummernoteContent();
            $processedDescription = $summernoteContent->processContent($request->description);
            $work_category->description = $processedDescription; 

            $work_category->title = $request->title;
            $work_category->description = $request->description;

            if ($work_category->save()) {
                return redirect()->route('admin.work_categories.index')->with('success', 'Success! Work Category updated.');
            } else {
                return redirect()->back()->with('error', 'Error! Work Category not updated.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error! Something went wrong: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        $work_categories = WorkCategory::find($id);

        if ($work_categories) {
            $work_categories->delete();
            return redirect()->route('admin.work_categories.index')->with('success', 'Success !! Work Category Deleted');
        } else {
            return redirect()->route('admin.work_categories.index')->with('error', 'Work Category  not found.');
        }
    }
}