<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // all categories
    public function index()
    {
        $data['categories'] = Category::all();
        return view('admin.categories', $data);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->get();

        $output = '';
        if ($categories->isNotEmpty()) {
            foreach ($categories as $category) {
                $output .= '
            <tr>
                <td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="1" />
                    </div>
                </td>
                <td class="d-flex align-items-center">
                   
                    <div class="d-flex flex-column">
                        <a href="' . route('edit.category', $category->id) . '" class="text-gray-800 text-hover-primary mb-1">' . $category->name . '</a>
                    </div>
                </td>
                <td class="text-end">
                    <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        Actions
                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="' . route('edit.category', $category->id) . '" class="menu-link px-3">Edit</a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="' . route('delete.category', $category->id) . '" class="menu-link px-3">Delete</a>
                        </div>
                    </div>
                </td>
            </tr>';
            }
        } else {
            $output .= '<tr><td colspan="4" class="text-center">No categories found</td></tr>';
        }

        return response()->json($output);
    }


    public function add()
    {
        return view('admin.add_category');
    }

    // store category
    public function store(Request $request)
    {

        $validate =  $request->validate([
            'name' => 'required|string|max:255',
            // 'description' => 'required|string',
            // 'icon' => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);
        // @dd($request->all());
        // if ($request->hasFile('icon')) {

        //     $file = $request->file('icon');
        //     $filename = 'category-image' . time() . rand(99, 199) . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/categoryImages', $filename);
        // }

        Category::create([
            'name' => $request->name,
        ]);
        return redirect()->route('categories')->with('success', 'Category Created Successfully.');
    }
    // edit category
    public function edit(Category $category)
    {
        $data['category'] = $category;
        return view('admin.edit_category', $data);
    }
    // update category
    public function update(Request $request, Category $category)
    {
        $validate =  $request->validate([
            'name' => 'required|string|max:255',
            // 'description' => 'required|string',
            // 'icon' => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);
        // if ($request->hasFile('icon')) {
        //     if ($category->icon) {
        //         Storage::delete($category->icon);
        //     }
        //     $file = $request->file('icon');
        //     $filename = 'category-image' . time() . rand(99, 199) . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/categoryImages', $filename);
        //     $category->update([
        //         'name' => $request->name,
        //         'description' => $request->description,
        //         'icon' => $filename,
        //     ]);
        // }

        $category->update([
            'name' => $request->name,
            // 'description' => $request->description,

        ]);
        return redirect()->route('categories')->with('success', 'Category Updated Successfully.');
    }
    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted Successfully.');
    }


    // all subCategories
    public function allSubcategory()
    {
        $data['categories'] = SubCategory::all();
        return view('admin.subCategories', $data);
    }
    public function searchSubcategory(Request $request)
    {
        $search = $request->input('search');
        $categories = SubCategory::where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->get();

        $output = '';
        if ($categories->isNotEmpty()) {
            foreach ($categories as $category) {
                $output .= '
            <tr>
                <td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="1" />
                    </div>
                </td>
                <td class="d-flex align-items-center">
                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="' . route('edit.subCategory', $category->id) . '">
                            <div class="symbol-label">
                                <img src="' . asset('storage/subCategoryImages/' . $category->icon) . '" alt="User image" class="w-100" />
                            </div>
                        </a>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="' . route('edit.subCategory', $category->id) . '" class="text-gray-800 text-hover-primary mb-1">' . $category->name . '</a>
                    </div>
                </td>
                <td>' . $category->description . '</td>
                <td>
                                                    <div class="badge badge-light-success">' . $category->category->name . '</div>
                                                </td>
                <td class="text-end">
                    <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        Actions
                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="' . route('edit.subCategory', $category->id) . '" class="menu-link px-3">Edit</a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="' . route('delete.subCategory', $category->id) . '" class="menu-link px-3">Delete</a>
                        </div>
                    </div>
                </td>
            </tr>';
            }
        } else {
            $output .= '<tr><td colspan="4" class="text-center">No categories found</td></tr>';
        }

        return response()->json($output);
    }
    public function addSubCategory()
    {
        $data['categories'] = Category::all();

        return view('admin.add_sub_category', $data);
    }
    public function editSubCategory(SubCategory $subCategory)
    {
        $data['categories'] = Category::all();
        $data['subCategory'] = $subCategory;

        return view('admin.edit_sub_category', $data);
    }

    // store subCategories
    public function storeSubcategory(Request $request)
    {

        $validate =  $request->validate([
            'name' => 'required|string|max:255',
            // 'description' => 'required|string',
            // 'category_id' => 'required',
            // 'icon' => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);
        // if ($request->hasFile('icon')) {

        //     $file = $request->file('icon');
        //     $filename = 'subCategory-image' . time() . rand(99, 199) . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/subCategoryImages', $filename);
        // }
        SubCategory::create([
            'name' => $request->name,
            // 'description' => $request->description,
            // 'icon' => $filename,
            // 'category_id' => $request->category_id,
        ]);

        return redirect()->route('subCategories')->with('success', 'SubCategory Created Successfully.');
    }

    // update subCategories
    public function updateSubcategory(Request $request, SubCategory $subCategory)
    {
        $validate =  $request->validate([
            'name' => 'required|string|max:255',
            // 'description' => 'required|string',
            // 'icon' => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);
        // if ($request->hasFile('icon')) {
        //     if ($subCategory->icon) {
        //         Storage::delete($subCategory->icon);
        //     }
        //     $file = $request->file('icon');
        //     $filename = 'subCategory-image' . time() . rand(99, 199) . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/subCategoryImages', $filename);
        //     $subCategory->update([
        //         'name' => $request->name,
        //         'description' => $request->description,
        //         'icon' => $filename,
        //         'category_id' => $request->category_id,
        //     ]);
        // }

        $subCategory->update([
            'name' => $request->name,
            // 'description' => $request->description,
            // 'category_id' => $request->category_id,
        ]);
        return redirect()->route('subCategories')->with('success', 'SubCategory Updated Successfully.');
    }
    public function deleteSubCategory(SubCategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->back()->with('success', 'SubCategory deleted Successfully.');
    }
}
