<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Media library controller. Supports uploading images/files, listing
 * available media and deleting unused media. Actual file processing is
 * handled by a dedicated service class in later phases.
 */
class MediaController extends Controller
{
    public function index(): View
    {
        // List all media files uploaded
        $media = Media::latest()->paginate(30);
        return view('admin.media.index', compact('media'));
    }

    public function create(): View
    {
        // Show upload form
        return view('admin.media.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Handle file upload
        $data = $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,svg,webp,pdf,doc,docx,xls,xlsx,zip',
        ]);
        $file = $request->file('file');
        $path = $file->store('media', 'public');
        $media = new Media();
        $media->user_id = Auth::id() ?? null;
        $media->file_name = $file->getClientOriginalName();
        $media->file_path = $path;
        $media->file_type = $file->getClientMimeType();
        $media->file_size = $file->getSize();
        $media->save();
        return redirect()->route('admin.media.index')->with('success', 'Media uploaded successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $media = Media::findOrFail($id);
        // Remove file from storage
        if ($media->file_path) {
            Storage::disk('public')->delete($media->file_path);
        }
        $media->delete();
        return redirect()->route('admin.media.index')->with('success', 'Media deleted successfully.');
    }
}