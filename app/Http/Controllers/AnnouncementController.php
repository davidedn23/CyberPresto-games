<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category, $categoryName = null)
    {
        // Build the query
        $query = $category->announcements()->where('is_accepted', true)
            ->orderBy('created_at', 'desc')->paginate(9);

        $categoryName = $category->name;
        // Return the view with the paginated announcements
        return view('announcements.index', ['announcements' => $query,'categoryName' => $categoryName, 'category' => $category]);
    }

    public function indexAll()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->where('is_accepted', true)->paginate(9);

        return view('announcements.indexAll', compact('announcements'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        //
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $announcements = Announcement::search($query)
            ->where('is_accepted', true)
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        return view('announcements.indexSearch', ['announcements' => $announcements, 'query' => $query]);
    }

}
