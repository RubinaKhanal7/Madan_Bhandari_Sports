<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SiteSettingController extends Controller
{
    public function index()
    {
        try {
            $sitesettings = SiteSetting::all();
            return view('backend.sitesetting.index', [
                'sitesettings' => $sitesettings,
                'page_title' => 'Site Settings',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in SiteSettings index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to load site settings. Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $sitesetting = SiteSetting::findOrFail($id);
            $socialmedias = SocialMedia::all();
            return view('backend.sitesetting.update', [
                'sitesetting' => $sitesetting,
                'socialmedias' => $socialmedias,
                'page_title' => 'Edit Site Setting',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in SiteSettings edit: ' . $e->getMessage());
            return redirect()->route('admin.site-settings.index')
                ->with('error', 'Unable to find the requested site setting.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title_ne' => 'required|string|max:255',
                'title_en' => 'required|string|max:255',
                'slogan_ne' => 'nullable|string|max:255',
                'slogan_en' => 'nullable|string|max:255',
                'description_ne' => 'nullable|string',
                'description_en' => 'nullable|string',
                'established_year' => 'nullable|string|max:4',
                'google_map' => 'nullable|string|max:1000',
                'phone_no' => 'required|array',
                'phone_no.*' => 'required|string',
                'email' => 'required|array',
                'email.*' => 'required|email',
                'main_logo_cropped' => 'nullable|string',
                'alt_logo_cropped' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->route('admin.site-settings.index')
                    ->with('form_id', $id)
                    ->withErrors($validator)
                    ->withInput();
            }

            $sitesetting = SiteSetting::findOrFail($id);

            // Process logos
            $sitesetting->main_logo = $this->processLogo($request, $sitesetting->main_logo, 'main_logo_cropped', 'main_logo');
            $sitesetting->alt_logo = $this->processLogo($request, $sitesetting->alt_logo, 'alt_logo_cropped', 'alt_logo');

            // Prepare update data
            $updateData = $request->except([
                'main_logo',
                'alt_logo',
                'main_logo_cropped',
                'alt_logo_cropped',
            ]);

            $updateData['phone_no'] = json_encode(array_filter($updateData['phone_no']));
            $updateData['email'] = json_encode(array_filter($updateData['email']));

            $sitesetting->update($updateData);

            return redirect()->route('admin.site-settings.index')
                ->with('success', 'Site settings updated successfully');
        } catch (\Exception $e) {
            Log::error('Error in SiteSettings update: ' . $e->getMessage());
            return redirect()->route('admin.site-settings.index')
                ->with('error', 'An error occurred while updating site settings. Please try again.')
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $sitesetting = SiteSetting::findOrFail($id);

            // Delete logos
            $this->deleteLogo($sitesetting->main_logo, 'main_logo');
            $this->deleteLogo($sitesetting->alt_logo, 'alt_logo');

            $sitesetting->delete();

            return redirect()->route('admin.site-settings.index')
                ->with('success', 'Site settings deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error in SiteSettings destroy: ' . $e->getMessage());
            return redirect()->route('admin.site-settings.index')
                ->with('error', 'Unable to delete site settings. Please try again.');
        }
    }

    public function toggleStatus($id)
{
    try {
        $siteSetting = SiteSetting::findOrFail($id);
        $siteSetting->is_active = !$siteSetting->is_active;
        $siteSetting->save();
        
        return redirect()->back()->with('success', 'Status updated successfully');
    } catch (\Exception $e) {
        Log::error('Error in SiteSettings toggleStatus: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Unable to update status. Please try again.');
    }
}
    private function processLogo($request, $currentLogo, $logoInput, $logoType)
    {
        if ($request->has($logoInput) && $request->$logoInput != '') {
            try {
                // Delete old logo if exists
                if ($currentLogo && Storage::disk('public')->exists('uploads/sitesetting/' . $currentLogo)) {
                    Storage::disk('public')->delete('uploads/sitesetting/' . $currentLogo);
                }

                // Process and save new logo
                $image_parts = explode(";base64,", $request->$logoInput);
                $image_base64 = base64_decode($image_parts[1]);
                $filename = $logoType . '_' . time() . '.png';

                if (!Storage::disk('public')->put('uploads/sitesetting/' . $filename, $image_base64)) {
                    throw new \Exception('Failed to save ' . $logoType);
                }

                return $filename;
            } catch (\Exception $e) {
                Log::error('Error processing ' . $logoType . ': ' . $e->getMessage());
                throw $e;
            }
        }
        return $currentLogo;
    }

    private function deleteLogo($logo, $logoType)
    {
        if ($logo) {
            $logoPath = public_path('uploads/sitesetting/' . $logo);
            if (File::exists($logoPath)) {
                File::delete($logoPath);
            }
        }
    }
}
