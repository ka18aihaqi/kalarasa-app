<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // public function index()
    // {
    //     $users = User::all();
    //     $products = Product::all();
    //     $title = 'Product List';
    //     $id = request()->get('user') ?? null;
    //     $search = request()->get('search') ?? '';

    //     return view('products', compact('users', 'products', 'title', 'id', 'search'));
    // }

    public function index(Request $request)
    {
        $users = User::all();
        $id = $request->get('user') ?? null;
        $search = $request->get('search') ?? '';

        // Query produk berdasarkan filter
        $query = Product::query();

        if ($search) {
            $query->where('title', 'LIKE', "%{$search}%");
        }

        if ($id) {
            $query->where('barista_id', $id);
        }

        $products = $query->orderBy('product_id', 'DESC')->get();
        $title = 'Product List';

        return view('products', compact('users', 'products', 'title', 'id', 'search'));
    }

    public function addNewProduct(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            // 'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('products', 'public'); 
            // dd($photoPath); // Cek apakah path foto berhasil disimpan
        }

        try {
            Product::create([
                'slug' => Str::slug($request->title), // Membuat slug dari title
                'title' => $request->title,
                // 'barista_id' => Auth::id(), // Pastikan user yang login adalah barista
                'barista_id' => $request->barista_id,
                'description' => $request->description,
                'photo' => $photoPath,
            ]);
            return redirect()->route('indexForm')->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Hapus foto dari storage jika ada
        if ($product->photo && file_exists(storage_path('app/public/' . $product->photo))) {
            unlink(storage_path('app/public/' . $product->photo));
        }

        $product->delete(); // Hapus produk dari database

        return redirect()->route('indexForm')->with('success', 'Product deleted successfully');
    }

    public function edit($product_id)
    {
        $product = Product::where('product_id', $product_id)->firstOrFail();
        $users = User::all(); // Mengambil semua user/barista

        return view('productedit', compact('product', 'users'));
    }

    public function update(Request $request, $product_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'barista_id' => 'required|exists:users,id',
            // 'product_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = Product::where('product_id', $product_id)->firstOrFail();

                // Jika ada file foto baru yang diunggah
        if ($request->hasFile('product_photo')) {
            // Hapus foto lama jika ada
            if ($product->photo && file_exists(storage_path('app/public/' . $product->photo))) {
                unlink(storage_path('app/public/' . $product->photo));
            }

            // Simpan foto baru
            $photoPath = $request->file('product_photo')->store('products', 'public');

            // Update produk dengan foto baru
            $product->update([
                'title' => $request->title,
                'barista_id' => $request->barista_id,
                'description' => $request->description,
                'photo' => $photoPath, // Tambahkan photo ke dalam update
            ]);
        } else {
            // Update produk tanpa mengubah foto
            $product->update([
                'title' => $request->title,
                'barista_id' => $request->barista_id,
                'description' => $request->description,
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('indexForm')->with('success', 'Product updated successfully!');
            }


}
