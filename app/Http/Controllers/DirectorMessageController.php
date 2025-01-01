<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\DirectorMessage;
use App\Models\SummernoteContent;

class DirectorMessageController extends Controller
{
    public function index()
    {
        $directorMessages = DirectorMessage::paginate(10);
        $summernoteContent = new SummernoteContent();
        return view('backend.director_messages.index', ['directorMessages' => $directorMessages, 'summernoteContent' => $summernoteContent, 'page_title' => 'Director Messages']);
    }

    public function create()
    {
        return view('backend.director_messages.create', ['page_title' => 'Create Director Message']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'position' => 'required|string',
            'companyName' => 'required|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,avif,webp,avi|max:2048',
            'message' => 'nullable|string',
        ]);

        try {
            $newImageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/director_messages'), $newImageName);

            // Process Summernote message using the SummernoteContent model
            $summernoteContent = new SummernoteContent();
            $processedContent = $summernoteContent->processContent($request->input('message'));

            $message = new DirectorMessage();
            $message->name = $request->input('name');
            $message->position = $request->input('position');
            $message->companyName = $request->input('companyName');
            $message->image = $newImageName;
            $message->message = $processedContent;
            $message->save();

            return redirect()->route('admin.director_messages.index')->with('success', 'Director message created successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Error creating director message: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $message = DirectorMessage::findOrFail($id);
        return view('backend.director_messages.update', compact('message'))->with('page_title', 'Edit Director Message');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'position' => 'required|string',
            'companyName' => 'required|string',
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,avif,webp,avi|max:2048',
            'message' => 'nullable|string',
        ]);

        try {
            $message = DirectorMessage::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($message->image && file_exists(public_path('uploads/director_messages/' . $message->image))) {
                    unlink(public_path('uploads/director_messages/' . $message->image));
                }

                $newImageName = time() . '-' . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/director_messages'), $newImageName);
                $message->image = $newImageName;
            }
            $summernoteContent = new SummernoteContent();
            $processedContent = $summernoteContent->processContent($request->input('message'));

            $message->name = $request->input('name');
            $message->position = $request->input('position');
            $message->companyName = $request->input('companyName');
            $message->message = $processedContent;
            $message->save();

            return redirect()->route('admin.director_messages.index')->with('success', 'Director message updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Error updating director message: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $message = DirectorMessage::findOrFail($id);

        $message->delete();
        return redirect()->route('admin.director_messages.index')->with('success', 'Director message deleted successfully.');
    }
}

