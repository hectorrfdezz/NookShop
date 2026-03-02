<?php

namespace App\\Http\\Controllers;

use App\\Models\\Item;
use Illuminate\\Http\\Request;
use Illuminate\\Support\\Facades\\Auth;

class ItemController extends Controller
{
    public function index()
    {
        $items = Auth::user()->items()->paginate(10);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Auth::user()->items()->create($validated);

        return redirect()->route('items.index')->with('success', 'Elemento creado correctamente.');
    }

    public function show(Item $item)
    {
        $this->authorizeItem($item);
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $this->authorizeItem($item);
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $this->authorizeItem($item);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $item->update($validated);
        return redirect()->route('items.index')->with('success', 'Elemento actualizado correctamente.');
    }

    public function destroy(Item $item)
    {
        $this->authorizeItem($item);
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Elemento eliminado correctamente.');
    }

    protected function authorizeItem(Item $item)
    {
        if ($item->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
