<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Models\Role;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('travelhub.pages.home');
})->name('home');

Route::get('/about', function () {
    return view('travelhub.pages.about');
})->name('about');

Route::get('/services', function () {
    return view('travelhub.pages.services');
})->name('services');

Route::get('/contact', function () {
    return view('travelhub.pages.contact');
})->name('contact');



Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Dynamic Role-Based Dashboard Routes
$roles = Role::pluck('name')->toArray(); // All roles from DB

foreach ($roles as $role) {
    Route::middleware(['auth', "role:$role"])->group(function () use ($role) {
        $controllerName = match ($role) {
            'admin' => AdminController::class,
            'subadmin' => \App\Http\Controllers\SubAdminController::class,
            'salesperson' => \App\Http\Controllers\SalesPersonController::class,
            'teamleader' => \App\Http\Controllers\TeamLeaderController::class,
            default => UserController::class
        };

        Route::get("/$role/dashboard", [$controllerName, 'dashboard'])->name("$role.dashboard");
    });
}



// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);

    Route::middleware(['auth'])->group(function () {

        Route::get('/update-code', function () {
            try {
                \Illuminate\Support\Facades\Artisan::call('config:clear');
                \Illuminate\Support\Facades\Artisan::call('cache:clear');
                \Illuminate\Support\Facades\Artisan::call('view:clear');
                \Illuminate\Support\Facades\Artisan::call('route:clear');
                \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        
                return redirect()->back()->with('success', 'System updated successfully!');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error updating code: ' . $e->getMessage());
            }
        })->name('admin.update-code');



        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
        // User management (Staffs) by admin
        Route::get('/staffs', [AdminController::class, 'StaffsIndex'])
            ->middleware('can:staffs.view') // Authorization Check
            ->name('staffs.index');
        Route::get('/staffs/create', [AdminController::class, 'StaffsCreate'])
            ->middleware('can:staffs.add') // Authorization Check
            ->name('staffs.create');
        Route::post('/staffs', [AdminController::class, 'StaffsStore'])
            ->middleware('can:staffs.add') // Authorization Check
            ->name('staffs.store');
        Route::get('/staffs/{id}/edit', [AdminController::class, 'StaffsEdit'])
            ->middleware('can:staffs.edit') // Authorization Check
            ->name('staffs.edit');
        Route::put('/staffs/{id}', [AdminController::class, 'StaffsUpdate'])
            ->middleware('can:staffs.edit') // Authorization Check
            ->name('staffs.update');
        

        
            

        // Roles Routes
        Route::get('roles', [RoleController::class, 'index'])
            ->middleware('can:roles.view') // Authorization Check
            ->name('roles.index');
        Route::get('roles/create', [RoleController::class, 'create'])
            ->middleware('can:roles.add') // Authorization Check
            ->name('roles.create');
        Route::post('roles', [RoleController::class, 'store'])
            ->middleware('can:roles.add') // Authorization Check
            ->name('roles.store');

        // Permissions Routes
        Route::get('permissions', [PermissionController::class, 'index'])
            ->middleware('can:permissions.view') // Authorization Check
            ->name('permissions.index');
        Route::get('permissions/create', [PermissionController::class, 'create'])
            ->middleware('can:permissions.add') // Authorization Check
            ->name('permissions.create');
        Route::post('permissions', [PermissionController::class, 'store'])
            ->middleware('can:permissions.add') // Authorization Check
            ->name('permissions.store');
        Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])
            ->middleware('can:permissions.edit') // Authorization Check
            ->name('permissions.edit');
        Route::post('permissions/{permission}/toggle-status', [PermissionController::class, 'toggleStatus'])
            ->middleware('can:permissions.edit') 
            ->name('permissions.toggle_status');
        Route::put('permissions/{permission}', [PermissionController::class, 'update'])
            ->middleware('can:permissions.edit') // Authorization Check
            ->name('permissions.update');
        Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])
            ->middleware('can:permissions.delete') // Authorization Check
            ->name('permissions.destroy');



        // Product Routes
        Route::get('products', [ProductController::class, 'index'])
        ->middleware('can:products.view') 
        ->name('admin.products.index');

        Route::get('products/create', [ProductController::class, 'create'])
        ->middleware('can:products.add') 
        ->name('admin.products.create');

        Route::post('products', [ProductController::class, 'store'])
        ->middleware('can:products.add') 
        ->name('admin.products.store');

        Route::get('products/{id}/edit', [ProductController::class, 'edit'])
        ->middleware('can:products.edit') 
        ->name('admin.products.edit');

        Route::put('products/{id}', [ProductController::class, 'update'])
        ->middleware('can:products.edit') 
        ->name('admin.products.update');

        Route::delete('products/{id}', [ProductController::class, 'destroy'])
        ->middleware('can:products.delete') 
        ->name('admin.products.destroy');



        Route::get('/generate/theme', [PageController::class, 'theme'])->name('generate.theme');
        Route::get('/widgets/small-box', [PageController::class, 'smallBox'])->name('widgets.small-box');
        Route::get('/widgets/info-box', [PageController::class, 'infoBox'])->name('widgets.info-box');
        Route::get('/widgets/cards', [PageController::class, 'cards'])->name('widgets.cards');

        Route::get('/layout/unfixed-sidebar', [PageController::class, 'unfixedSidebar'])->name('layout.unfixed-sidebar');
        Route::get('/layout/fixed-sidebar', [PageController::class, 'fixedSidebar'])->name('layout.fixed-sidebar');
        Route::get('/layout/custom-area', [PageController::class, 'customArea'])->name('layout.custom-area');
        Route::get('/layout/sidebar-mini', [PageController::class, 'sidebarMini'])->name('layout.sidebar-mini');
        Route::get('/layout/collapsed-sidebar', [PageController::class, 'collapsedSidebar'])->name('layout.collapsed-sidebar');
        Route::get('/layout/logo-switch', [PageController::class, 'logoSwitch'])->name('layout.logo-switch');
        Route::get('/layout/layout-rtl', [PageController::class, 'layoutRtl'])->name('layout.rtl');

        Route::get('/UI/general', [PageController::class, 'generalUI'])->name('ui.general');
        Route::get('/UI/icons', [PageController::class, 'icons'])->name('ui.icons');
        Route::get('/UI/timeline', [PageController::class, 'timeline'])->name('ui.timeline');

        Route::get('/forms/general', [PageController::class, 'generalForms'])->name('forms.general');
        Route::get('/tables/simple', [PageController::class, 'simpleTables'])->name('tables.simple');

        Route::get('/examples/login', [PageController::class, 'login'])->name('examples.login');
        Route::get('/examples/register', [PageController::class, 'register'])->name('examples.register');
        Route::get('/examples/login-v2', [PageController::class, 'loginV2'])->name('examples.login-v2');
        Route::get('/examples/register-v2', [PageController::class, 'registerV2'])->name('examples.register-v2');
        Route::get('/examples/lockscreen', [PageController::class, 'lockscreen'])->name('examples.lockscreen');

        Route::get('/docs/introduction', [PageController::class, 'docsIntroduction'])->name('docs.introduction');
        Route::get('/docs/color-mode', [PageController::class, 'docsColorMode'])->name('docs.color-mode');
        Route::get('/docs/components/main-header', [PageController::class, 'mainHeader'])->name('docs.main-header');
        Route::get('/docs/components/main-sidebar', [PageController::class, 'mainSidebar'])->name('docs.main-sidebar');
        Route::get('/docs/javascript/treeview', [PageController::class, 'treeView'])->name('docs.treeview');
        Route::get('/docs/browser-support', [PageController::class, 'browserSupport'])->name('docs.browser-support');
        Route::get('/docs/how-to-contribute', [PageController::class, 'howToContribute'])->name('docs.how-to-contribute');
        Route::get('/docs/faq', [PageController::class, 'faq'])->name('docs.faq');
        Route::get('/docs/license', [PageController::class, 'license'])->name('docs.license');



        Route::get('/admin/contact', [PageController::class, 'contact'])->name('admin.contact');
        // Assuming ContactController::class is defined elsewhere
        // Route::get('/admin/contacts', [ContactController::class, 'index'])->name('admin.contacts'); 

        // Assuming FAQController::class is defined elsewhere
        // Route::get('/admin/faq', [FAQController::class, 'index'])->name('admin.faq'); 



        Route::get('/smtp-settings', [EmailController::class, 'smtpSettings'])->middleware('can:email.view')->name('admin.smtp');
        Route::post('/smtp-update-settings', [EmailController::class, 'updateSmtpSettings'])->middleware('can:email.view')->name('admin.smtp.update');
        Route::post('/smtp/test', [EmailController::class, 'testSmtp'])->middleware('can:email.view')->name('admin.smtp.test');
   
        // Category
        Route::get('/categories', [CategoryController::class, 'index'])->middleware('can:categories.view')->name('admin.categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->middleware('can:categories.add')->name('admin.categories.create');
        Route::post('/categories/store', [CategoryController::class, 'store'])->middleware('can:categories.add')->name('admin.categories.store');
        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->middleware('can:categories.edit')->name('admin.categories.edit');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->middleware('can:categories.edit')->name('admin.categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->middleware('can:categories.delete')->name('admin.categories.destroy');


       
        // Post routes
        Route::get('posts', [PostController::class, 'index'])->middleware('can:posts.view')->name('admin.posts.index');
        Route::get('posts/create', [PostController::class, 'create'])->middleware('can:posts.add')->name('admin.posts.create');
        Route::post('posts/store', [PostController::class, 'store'])->middleware('can:posts.add')->name('admin.posts.store');
        Route::get('posts/{id}/edit', [PostController::class, 'edit'])->middleware('can:posts.edit')->name('admin.posts.edit');
        Route::put('posts/{id}', [PostController::class, 'update'])->middleware('can:posts.edit')->name('admin.posts.update');
        Route::delete('posts/{id}', [PostController::class, 'destroy'])->middleware('can:posts.delete')->name('admin.posts.destroy');


        // Blog routes
        Route::get('blogs', [BlogsController::class, 'index'])->middleware('can:blogs.view')->name('admin.blogs.index');
        Route::get('blogs/create', [BlogsController::class, 'create'])->middleware('can:blogs.add')->name('admin.blogs.create');
        Route::post('blogs', [BlogsController::class, 'store'])->middleware('can:blogs.add')->name('admin.blogs.store');
        Route::get('blogs/{id}/edit', [BlogsController::class, 'edit'])->middleware('can:blogs.edit')->name('admin.blogs.edit');
        Route::put('blogs/{id}', [BlogsController::class, 'update'])->middleware('can:blogs.edit')->name('admin.blogs.update');
        Route::delete('blogs/{id}', [BlogsController::class, 'destroy'])->middleware('can:blogs.delete')->name('admin.blogs.destroy');
        Route::post('blogs/{id}/status', [BlogsController::class, 'updateStatus'])->middleware('can:blogs.status')->name('admin.blogs.status');



        // newsletters

        Route::get('/newsletters', [NewsletterController::class, 'index'])->middleware('can:newsletter.view')->name('newsletter.index');
        Route::post('/newsletters/store', [NewsletterController::class, 'store'])->middleware('can:newsletter.view')->name('newsletter.store');
        Route::get('/newsletters/unsubscribe/{id}', [NewsletterController::class, 'unsubscribe'])->middleware('can:newsletter.view')->name('newsletter.unsubscribe');
        Route::get('/newsletter/{id}/edit', [NewsletterController::class, 'edit'])->middleware('can:newsletter.view')->name('newsletter.edit');
        Route::post('/newsletter/{id}/update', [NewsletterController::class, 'update'])->middleware('can:newsletter.view')->name('newsletter.update');

        Route::get('/newsletters/delete/{id}', [NewsletterController::class, 'destroy'])->middleware('can:newsletter.view')->name('newsletter.delete');
        Route::get('/newsletters-show', [NewsletterController::class, 'showindex'])->middleware('can:newsletter.view')->name('newsletter.show');
        Route::post('/send-newsletter', [NewsletterController::class, 'sendNewsletter'])->middleware('can:newsletter.view')->name('admin.send.newsletter');


        // pages

        Route::get('/pages', [PageController::class, 'index'])->middleware('can:pages.view')->name('pages.index');
        Route::get('/pages/create', [PageController::class, 'create'])->middleware('can:pages.add')->name('pages.create');
        Route::post('/pages', [PageController::class, 'store'])->middleware('can:pages.add')->name('pages.store');
        Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->middleware('can:pages.edit')->name('pages.edit');
        Route::put('/pages/{id}', [PageController::class, 'update'])->middleware('can:pages.edit')->name('pages.update');
        Route::delete('/pages/{id}', [PageController::class, 'destroy'])->middleware('can:pages.delete')->name('pages.destroy');



        Route::get('menus', [MenuController::class, 'index'])->middleware('can:menus.view')->name('admin.menus.index');
        Route::get('menus/create', [MenuController::class, 'createMenu'])->middleware('can:menus.add')->name('admin.menus.createMenu');
        Route::post('menus/store', [MenuController::class, 'store'])->middleware('can:menus.add')->name('admin.menus.store');
        Route::get('menus/{id}/edit', [MenuController::class, 'edit'])->middleware('can:menus.edit')->name('admin.menus.edit');
        Route::put('menus/{id}', [MenuController::class, 'update'])->middleware('can:menus.edit')->name('admin.menus.update'); 
        Route::delete('menus/{id}', [MenuController::class, 'destroy'])->middleware('can:menus.delete')->name('admin.menus.destroy');
        Route::post('menus/reorder', [MenuController::class, 'reorder'])->middleware('can:menus.add')->name('admin.menus.reorder');
        Route::post('menus/add-pages', [MenuController::class, 'addPagesToMenu'])->middleware('can:menus.add')->name('admin.menus.addPages');

    });
});

require __DIR__ . '/auth.php';
