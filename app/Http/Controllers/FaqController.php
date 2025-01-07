<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return view('backend.faq.index', compact('faqs'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'answer' => 'required|string',
        'is_active' => 'required|boolean',
    ], [
        'title.required' => 'The title field is required.',
        'answer.required' => 'The answer field is required.',
        'is_active.required' => 'The status field is required.',
    ]);

    Faq::create($request->all());

    return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully!');
}


    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'title' => 'required|string',
            'answer' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $faq->update($request->all());

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }
}
