<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDescription;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Pass the products to the view
        return view('dashboard.product.index', compact('products'));
    }



    public function show(Product $product)
    {
        // Load the descriptions associated with the product
        $product->load('descriptions');

        // Pass the product and its descriptions to the view
        return view('dashboard.product.show', compact('product'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.product.create',compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the product fields
            $request->validate([
                'category_id' => 'required|exists:categories,id',
      //          'name' => 'required|string|regex:/^[A-Za-z0-9 -]+$/',
      //          'name_ar' => 'required|string|regex:/^[\p{Arabic}0-9\s-]+$/u',
                'sku' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
     //           'descriptions.*.description' => 'required|string|regex:/^[A-Za-z0-9 -]+$/',
     //           'descriptions.*.description_ar' => 'required|string|regex:/^[\p{Arabic}0-9\s-]+$/u',
                'descriptions.*.images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ], [
                'name.regex' => 'The name must be in English.',
                'name_ar.regex' => 'The name must be in Arabic.',
                'descriptions.*.description.regex' => 'The description must be in English.',
                'descriptions.*.description_ar.regex' => 'The description must be in Arabic.',
            ]);

            // Store the product image if available
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('product_images', 'public');
            }

            // Create the product
            $product = Product::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'name_ar' => $request->name_ar,
                'sku' => $request->sku,
                'image' => $imagePath,
            ]);

            // Store the descriptions
            foreach ($request->descriptions as $index => $descriptionData) {
                $descriptionImages = [];

                if (isset($descriptionData['images'])) {
                    foreach ($descriptionData['images'] as $image) {
                        $descriptionImages[] = $image->store('product_description_images', 'public');
                    }
                }

                $product->descriptions()->create([
                    'description' => $descriptionData['description'],
                    'description_ar' => $descriptionData['description_ar'],
                    'images' => $descriptionImages ? json_encode($descriptionImages) : null,
                ]);
            }

            return redirect()->route('admin.products.create')->with('success', 'Product and descriptions added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create product: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $product = Product::with('descriptions')->findOrFail($id);
        $categories = Category::all();

        return view('dashboard.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        try {
            // Validate the product fields
            $request->validate([
                'category_id' => 'required|exists:categories,id',
        //        'name' => 'required|string|regex:/^[A-Za-z0-9 -]+$/',
         //       'name_ar' => 'required|string|regex:/^[\p{Arabic}0-9\s-]+$/u',
                'sku' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
          //      'descriptions.*.description' => 'required|string|regex:/^[A-Za-z0-9 -]+$/',
         //       'descriptions.*.description_ar' => 'required|string|regex:/^[\p{Arabic}0-9\s-]+$/u',
                'descriptions.*.images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            // Handle the product image
            $imagePath = $product->image; // Existing image path
            if ($request->hasFile('image')) {
                if ($imagePath) {
                    Storage::delete('public/' . $imagePath);
                }
                $imagePath = $request->file('image')->store('product_images', 'public');
            }

            // Update the product data
            $product->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'name_ar' => $request->name_ar,
                'sku' => $request->sku,
                'image' => $imagePath,
            ]);

            // Handle descriptions (Add, Update, and Delete)
            $existingDescriptionsIds = $product->descriptions()->pluck('id')->toArray();
            $submittedDescriptionsIds = array_filter(array_column($request->descriptions, 'id'));

            // Delete removed descriptions
            $descriptionsToDelete = array_diff($existingDescriptionsIds, $submittedDescriptionsIds);
            ProductDescription::destroy($descriptionsToDelete);

            // Loop through descriptions to update or create new ones
            foreach ($request->descriptions as $index => $descriptionData) {
                $descriptionImages = [];

                // Check if new images are uploaded
                if (isset($descriptionData['images'])) {
                    foreach ($descriptionData['images'] as $image) {
                        $descriptionImages[] = $image->store('product_description_images', 'public');
                    }
                }

                // If no new images are uploaded, keep the old ones
                if (!empty($descriptionData['id'])) {
                    $existingDescription = ProductDescription::find($descriptionData['id']);
                    if ($descriptionImages) {
                        $existingDescription->images = json_encode($descriptionImages);
                    } else {
                        // Keep the old images if no new ones are uploaded
                        $descriptionImages = json_decode($existingDescription->images);
                    }
                    $existingDescription->update([
                        'description' => $descriptionData['description'],
                        'description_ar' => $descriptionData['description_ar'],
                        'images' => $descriptionImages ? json_encode($descriptionImages) : null,
                    ]);
                } else {
                    // Create a new description if id is not present
                    $product->descriptions()->create([
                        'description' => $descriptionData['description'],
                        'description_ar' => $descriptionData['description_ar'],
                        'images' => $descriptionImages ? json_encode($descriptionImages) : null,
                    ]);
                }
            }

            return redirect()->route('admin.products.edit', $product->id)->with('success', 'Product and descriptions updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update product: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Product $product)
    {
        try {
            // حذف صورة المنتج إذا وجدت
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }

            // جلب جميع الأوصاف المرتبطة بالمنتج
            $descriptions = $product->descriptions;

            // حذف صور الأوصاف المرتبطة
            foreach ($descriptions as $description) {
                if ($description->images) {
                    foreach (json_decode($description->images) as $image) {
                        Storage::delete('public/' . $image);
                    }
                }

                // حذف الوصف
                $description->delete();
            }

            // حذف المنتج بعد حذف جميع الأوصاف المرتبطة
            $product->delete();

            return redirect()->route('admin.products.index')->with('success', 'Product and related descriptions deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete product: ' . $e->getMessage()]);
        }
    }








}
