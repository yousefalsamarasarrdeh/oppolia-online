<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.category.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|regex:/^[A-Za-z0-9\s\-_,\.;:()]+$/',
            'title_ar' => 'required|max:255|regex:/^[\p{Arabic}0-9\s\-_,\.;:()]+$/u',
            'image' => 'nullable|image',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imagePath = $request->image->store('category_images', 'public');
                $validated['image'] = $imagePath;
            }

            Category::create($validated);
            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create category: ' . $e->getMessage()])->withInput();

        }
    }

    public function edit(Category $category)
    {

        return view('dashboard.category.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        // التحقق من البيانات الواردة باستخدام قواعد التحقق
        $validated = $request->validate([
            'title' => 'required|max:255|regex:/^[A-Za-z0-9\s\-_,\.;:()]+$/',
            'title_ar' => 'required|max:255|regex:/^[\p{Arabic}0-9\s\-_,\.;:()]+$/u',
            'image' => 'nullable|image',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            // تحديث الصورة إذا تم تحميل صورة جديدة
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // حذف الصورة القديمة إذا كانت موجودة
                if ($category->image) {
                    Storage::delete('public/' . $category->image);
                }
                $imagePath = $request->image->store('category_images', 'public');
                $validated['image'] = $imagePath; // تحديث مسار الصورة في المصفوفة المُحققة
            }

            // تحديث البيانات في قاعدة البيانات
            $category->update($validated);

            // إعادة توجيه إلى صفحة الفهرسة مع رسالة نجاح
            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            // العودة إلى الصفحة مع رسالة خطأ إذا حدث استثناء
            return back()->withErrors(['error' => 'Failed to update category: ' . $e->getMessage()])->withInput();
        }
    }


    public function destroy(Category $category)
    {
        try {
            if ($category->image) {
                Storage::delete('public/' . $category->image);
            }
            $category->delete();
            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create category: ' . $e->getMessage()])->withInput();
        }
    }
}
