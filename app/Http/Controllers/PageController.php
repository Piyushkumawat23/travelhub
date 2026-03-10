<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\File;


use App\Models\Contact;

class PageController extends Controller
{
    public function theme() { return view('admin.pages.generate.theme'); }
    public function smallBox() { return view('admin.pages.widgets.small-box'); }
    public function infoBox() { return view('admin.pages.widgets.info-box'); }
    public function cards() { return view('admin.pages.widgets.cards'); }

    public function unfixedSidebar() { return view('admin.pages.layout.unfixed-sidebar'); }
    public function fixedSidebar() { return view('admin.pages.layout.fixed-sidebar'); }
    public function customArea() { return view('admin.pages.layout.custom-area'); }
    public function sidebarMini() { return view('admin.pages.layout.sidebar-mini'); }
    public function collapsedSidebar() { return view('admin.pages.layout.collapsed-sidebar'); }
    public function logoSwitch() { return view('admin.pages.layout.logo-switch'); }
    public function layoutRtl() { return view('admin.pages.layout.layout-rtl'); }

    public function generalUI() { return view('admin.pages.UI.general'); }
    public function icons() { return view('admin.pages.UI.icons'); }
    public function timeline() { return view('admin.pages.UI.timeline'); }

    public function generalForms() { return view('admin.pages.forms.general'); }
    public function simpleTables() { return view('admin.pages.tables.simple'); }

    public function login() { return view('admin.pages.examples.login'); }
    public function register() { return view('admin.pages.examples.register'); }
    public function loginV2() { return view('admin.pages.examples.login-v2'); }
    public function registerV2() { return view('admin.pages.examples.register-v2'); }
    public function lockscreen() { return view('admin.pages.examples.lockscreen'); }

    public function docsIntroduction() { return view('admin.pages.docs.introduction'); }
    public function docsColorMode() { return view('admin.pages.docs.color-mode'); }
    public function mainHeader() { return view('admin.pages.docs.components.main-header'); }
    public function mainSidebar() { return view('admin.pages.docs.components.main-sidebar'); }
    public function treeView() { return view('admin.pages.docs.javascript.treeview'); }
    public function browserSupport() { return view('admin.pages.docs.browser-support'); }
    public function howToContribute() { return view('admin.pages.docs.how-to-contribute'); }
    public function faq() { return view('admin.pages.docs.faq'); }
    public function license() { return view('admin.pages.docs.license'); }



    public function contact() { 
        $contacts = Contact::paginate(10); // Fetches 10 contacts per page
        return view('admin.contacts.index', compact('contacts'));
    }
  
    










    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }


public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:pages,slug',
        'status' => 'required|in:active,inactive',
        'content' => 'required|string',
    ]);

    // Create the page record in the database
    $page = Page::create([
        'title' => $request->title,
        'slug' => $request->slug,
        'status' => $request->status,
        'content' => $request->content,
    ]);

    // Check if the 'create_file' checkbox is checked
    if ($request->has('create_file') && $request->create_file == 1) {
        // Create a Blade file for this page in resources/views/user/
        $viewContent = "<h1>{$request->title}</h1><p>{$request->content}</p>";

        // Define the file path for the new view
        $viewFilePath = resource_path("views/user/{$page->slug}.blade.php");

        // Write content to the view file
        File::put($viewFilePath, $viewContent);
    }

    return redirect()->route('pages.index')->with('success', 'Page created successfully.');
}

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'status' => 'required|in:active,inactive',
            'content' => 'required|string',
        ]);

        $page->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'status' => $request->status,
            'content' => $request->content,
        ]);

        // Redirect back to the edit page with a success message
        return redirect()->route('pages.edit', $page->id)->with('success', 'Page updated successfully.');
    }
    
   

    public function destroy(Request $request, $id)
    {
        $page = Page::findOrFail($id);
    
        // Check if the delete_file checkbox is checked
        if ($request->has('delete_file') && $request->delete_file == 1) {
            // Delete the corresponding Blade file from resources/views/user/
            $viewFilePath = resource_path("views/user/{$page->title}.blade.php");
    
            if (File::exists($viewFilePath)) {
                File::delete($viewFilePath); // Delete the file
            }
        }
    
        // Delete the page record from the database
        $page->delete();
    
        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }
}
