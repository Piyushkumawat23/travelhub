<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // ... (getMenuTree aur buildTree functions same rahenge) ...

    // --- NEW HELPER FUNCTION START ---
    // Ye function tree ko flat list me convert karega table ke liye
    private function flattenMenuNode($menu, &$list)
    {
        $list[] = $menu; // Pehle parent ko list me daalo
        
        // Fir uske bacchon ko (Recursive)
        foreach ($menu->children as $child) {
            $this->flattenMenuNode($child, $list);
        }
    }
    // --- NEW HELPER FUNCTION END ---

    public function index()
    {
        // 1. Drag & Drop ke liye Tree (Nested Structure)
        $menuTree = Menu::whereNull('parent_id')
                        ->with('children.children') // 3 level tak load
                        ->orderBy('order')
                        ->get();

        // 2. Table View ke liye Sorted List (Hierarchy Wise)
        $menusArray = [];
        foreach ($menuTree as $menu) {
            $this->flattenMenuNode($menu, $menusArray);
        }
        
        // Array ko wapis Collection me convert karein taaki Blade me dikkat na aaye
        $menus = collect($menusArray);

        $pages = Page::where('status', 'active')->get();
        
        $existingSlugs = Menu::pluck('slug')->toArray();

        return view('admin.menus.index', compact('menus', 'menuTree','pages','existingSlugs'));
    }


    public function addPagesToMenu(Request $request)
    {
        $request->validate([
            'page_ids' => 'required|array',
            'page_ids.*' => 'exists:pages,id' // Check karega ki page ID exist karti hai ya nahi
        ]);

        $pageIds = $request->input('page_ids');
        
        // Last Order nikalo
        $maxOrder = Menu::max('order') ?? 0;

        foreach($pageIds as $pageId) {
            // Database se Page ki detail nikalo
            $page = Page::find($pageId);
            $maxOrder++;

            // Us Page ki detail use karke naya Menu Item banao
            Menu::create([
                'title'     => $page->title,  // Page ka title le liya
                'slug'      => $page->slug,   // Page ka slug le liya
                // URL bana rahe hain (Frontend route ke hisaab se)
                'url'       => '/page/' . $page->slug, 
                'parent_id' => null,
                'order'     => $maxOrder,
                'status'    => 1
            ]);
        }

        return redirect()->back()->with('success', 'Selected pages added to menu.');
    }

    // ... (Baaki saare functions: createMenu, store, edit, update, destroy, reorder SAME rahenge) ...
    
    public function createMenu()
    {
        $parentMenus = $this->getMenuTree();
        return view('admin.menus.createMenu', compact('parentMenus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'slug'      => 'required|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'status'    => 'boolean',
        ]);

        $maxOrder = Menu::max('order') ?? 0;
        $newOrder = $maxOrder + 1;

        Menu::create([
            'menu_category_id' => null,
            'title'     => $validated['title'],
            'slug'      => $validated['slug'],
            'url'       => null,
            'parent_id' => $validated['parent_id'] ?: null,
            'order'     => $newOrder,
            'status'    => $validated['status'] ?? 1,
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu added successfully.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $parentMenus = $this->getMenuTree($menu->id);
        return view('admin.menus.editMenu', compact('menu', 'parentMenus'));
    }
        
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'slug'      => 'required|string|max:255',
            'order'     => 'required|integer', 
            'status'    => 'required|boolean',
            'parent_id' => 'nullable|exists:menus,id',
        ]);
        
        if ($validated['parent_id'] == $menu->id) {
            return back()->with('error', 'A menu cannot be its own parent.');
        }

        $menu->update([
            'title'     => $validated['title'],
            'slug'      => $validated['slug'],
            'url'       => null, 
            'order'     => $validated['order'],
            'status'    => $validated['status'],
            'parent_id' => $validated['parent_id'] ?: null,
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        Menu::where('parent_id', $id)->delete();
        $menu->delete(); 
        return redirect()->route('admin.menus.index')->with('success', 'Menu deleted.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'menus' => 'required|array',
            'menus.*.id' => 'required|exists:menus,id',
            'menus.*.parent_id' => 'nullable|exists:menus,id',
            'menus.*.order' => 'required|integer',
        ]);
    
        $menus = $request->input('menus');
    
        foreach ($menus as $item) {
            Menu::where('id', $item['id'])->update([
                'parent_id' => $item['parent_id'],
                'order'     => $item['order']
            ]);
        }
    
        return response()->json(['success' => true]);
    }
    
    // ... (getMenuTree aur buildTree methods agar neeche hain to wo waise hi rahenge) ...
    private function getMenuTree($excludeId = null)
    {
        $allMenus = Menu::orderBy('order')->get();
        return $this->buildTree($allMenus, $excludeId);
    }

    private function buildTree($menus, $excludeId, $parentId = null, $prefix = '')
    {
        $list = [];
        foreach ($menus as $menu) {
            if ($excludeId && $menu->id == $excludeId) { continue; }
            if ($menu->parent_id == $parentId) {
                $list[] = [ 'id' => $menu->id, 'title' => $prefix . ' ' . $menu->title ];
                $children = $this->buildTree($menus, $excludeId, $menu->id, $prefix . '--');
                $list = array_merge($list, $children);
            }
        }
        return $list;
    }
}