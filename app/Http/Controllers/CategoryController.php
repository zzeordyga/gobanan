<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Admin/Categories/Create');
    }

    public function edit(int $id): Response
    {
        $category = Category::query()->whereKey($id)->firstOrFail()->only(['id', 'name', 'description']);

        return Inertia::render('Admin/Categories/Edit', ['category' => $category]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:categories,name'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        Category::create($data);

        return to_route('admin.categories.index')->with('status', 'Category created.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $category = Category::query()->whereKey($id)->firstOrFail();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:categories,name,'.$id],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $category->update($data);

        return to_route('admin.categories.index')->with('status', 'Category updated.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $category = Category::query()->whereKey($id)->firstOrFail();
        $category->delete();

        return to_route('admin.categories.index')->with('status', 'Category deleted.');
    }
}
