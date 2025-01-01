<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SummernoteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(5);
        $summernoteContent = new SummernoteContent();
        return view('backend.services.index', [
            'services' => $services,
            'summernoteContent' => $summernoteContent,
            'page_title' => 'Services'
        ]);
    }

    public function create()
    {
        return view('backend.services.create', ['page_title' => 'Add Services']);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required|string',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'description' => 'required|string',
                'status' => 'required|boolean',
            ]);

            $newImageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/service'), $newImageName);

            // Process the Summernote content
            $summernoteContent = new SummernoteContent();
            $processedDescription = $summernoteContent->processContent($request->description);

            $service = new Service;
            $service->title = $request->title;
            $service->slug = SlugService::createSlug(Service::class, 'slug', $request->title);
            $service->image = $newImageName;
            $service->description = $processedDescription;
            $service->status = $request->status;

            if ($service->save()) {
                return redirect()->route('admin.services.index')->with('success', 'Success! Service created.');
            } else {
                return redirect()->back()->with('error', 'Error! Service not created.');
            }
        } catch (\Exception $e) {
            Log::error('Error storing service: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error! Something went wrong.');
        }
    }

    public function edit($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return redirect()->route('admin.services.index')->with('error', 'Service not found.');
        }

        return view('backend.services.update', [
            'service' => $service,
            'page_title' => 'Update Services'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'required|string',
            'status' => 'required|boolean',
        ]);

        try {
            $service = Service::find($id);

            if (!$service) {
                return redirect()->route('admin.services.index')->with('error', 'Service not found.');
            }

            if ($request->hasFile('image')) {
                if ($service->image && file_exists(public_path('uploads/service/' . $service->image))) {
                    unlink(public_path('uploads/service/' . $service->image));
                }

                // Upload the new image
                $newImageName = time() . '-' . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/service'), $newImageName);
                $service->image = $newImageName;
            }

            $service->title = $request->title;
            $service->description = $request->description;
            $service->slug = SlugService::createSlug(Service::class, 'slug', $request->title);
            $service->status = $request->status;

            $service->save();

            return redirect()->route('admin.services.index')->with('success', 'Success! Service updated.');
        } catch (\Exception $e) {
            Log::error('Error updating service: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Error! Something went wrong.');
        }
    }

    public function destroy($id)
    {
        $service = Service::find($id);

        if ($service) {
            if ($service->image && file_exists(public_path('uploads/service/' . $service->image))) {
                unlink(public_path('uploads/service/' . $service->image));
            }

            $service->delete();
            return redirect()->route('admin.services.index')->with('success', 'Success! Service deleted.');
        } else {
            return redirect()->route('admin.services.index')->with('error', 'Service not found.');
        }
    }
}
