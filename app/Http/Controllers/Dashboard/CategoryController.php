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
        // Fetch all categories, ordered by newest first
        $categories = Category::orderBy('created_at', 'desc')->get();

        // Pass the categories to the view
        return view('dashboard.category.index', compact('categories'));
    }
    public function create()
    {
        // جلب جميع الفئات التي يمكن أن تكون فئات أساسية
        $categories = Category::whereNull('parent_id')->get(); // جلب فقط الفئات التي ليس لها فئات أساسية
        // عرض صفحة إنشاء الفئة مع تمرير الفئات إلى العرض
        return view('dashboard.category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|regex:/^[A-Za-z0-9\s\-_,\.;:()]+$/',
            'title_ar' => 'required|max:255|regex:/^[\p{Arabic}0-9\s\-_,\.;:()]+$/u',
            'image' => 'nullable|image',
            'status' => 'required|in:active,inactive',
            'parent_id' => 'nullable|exists:categories,id' // تحقق من وجود parent_id في جدول categories إذا لم يكن null
        ]);

        try {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imagePath = $request->image->store('category_images', 'public');
                $validated['image'] = $imagePath;
            }

            Category::create($validated);
            return redirect()->route('admin.categories.index')->with('success', 'تم إنشاء الفئة بنجاح');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create category: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(Category $category)
    {
        // جلب جميع الفئات باستثناء الفئة الحالية لمنع الفئة من أن تكون فئة أصل لنفسها
        $categories = Category::whereNull('parent_id')->where('id', '!=', $category->id)->get();

        // تمرير كل من 'category' و 'categories' إلى العرض
        return view('dashboard.category.edit', compact('category', 'categories'));
    }



    public function update(Request $request, Category $category)
    {
        // التحقق من البيانات الواردة باستخدام قواعد التحقق
        $validated = $request->validate([
            'title' => 'required|max:255|regex:/^[A-Za-z0-9\s\-_,\.;:()]+$/',
            'title_ar' => 'required|max:255|regex:/^[\p{Arabic}0-9\s\-_,\.;:()]+$/u',
            'image' => 'nullable|image',
            'status' => 'required|in:active,inactive',
            'parent_id' => 'nullable|exists:categories,id'
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
            return redirect()->route('admin.categories.index')->with('success', 'تم تحديث الفئة بنجاح');
        } catch (\Exception $e) {
            // العودة إلى الصفحة مع رسالة خطأ إذا حدث استثناء
            return back()->withErrors(['error' => 'Failed to update category: ' . $e->getMessage()])->withInput();
        }
    }


    public function destroy(Category $category)
    {
        try {
            // التحقق من وجود الصورة وحذفها إذا كانت موجودة
            if ($category->image) {
                Storage::delete('public/' . $category->image);
            }

            // حذف الفئات الفرعية تلقائيا
            $this->deleteSubcategories($category);

            // حذف الفئة الأساسية
            $category->delete();

            return redirect()->route('admin.categories.index')->with('success', 'تم حذف الفئة وفئاتها الفرعية بنجاح');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete category: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * حذف الفئات الفرعية بشكل متكرر
     */
    private function deleteSubcategories($category)
    {
        foreach ($category->subcategories as $subcategory) {
            if ($subcategory->image) {
                Storage::delete('public/' . $subcategory->image);
            }
            $this->deleteSubcategories($subcategory);  // حذف الفئات الفرعية للفئة الفرعية
            $subcategory->delete();
        }
    }
}
