<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Api\Category\MainCategory;
use Illuminate\Support\Facades\Auth;


class MainCategoryController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:show_all_category')->only('index');
    //     $this->middleware('permission:create_category')->only(['create', 'store']);
    //     $this->middleware('permission:update_category')->only(['edit', 'update']);
    //     $this->middleware('permission:delete_category')->only('destroy');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = MainCategory::latest()->paginate(10);
        return view('admin.category.main_categories.index', compact('categories'));
    }

    public function create()
    {

        return view('admin.main_categories.create');
    }

    public function store(Request $request)
    {


        $this->authorize('create', MainCategory::class);


        MainCategory::create($request->only('main_category_name'));

        return redirect()->route('admin.main_categories.index')->with('success', 'Main category created!');
    }

    public function edit(MainCategory $mainCategory)
    {
        return view('admin.main_categories.edit', compact('mainCategory'));
    }

    public function update(Request $request, MainCategory $mainCategory)
    {



        $mainCategory->update($request->only('main_category_name'));

        return redirect()->route('admin.main_categories.index')->with('success', 'Updated successfully!');
    }

    public function destroy(MainCategory $mainCategory)
    {
        $this->authorize('delete', $mainCategory);

        $mainCategory->delete();

        return redirect()->route('admin.main_categories.index')->with('success', 'Deleted successfully!');
    }
}
