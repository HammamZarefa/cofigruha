<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{BannerController,
    CarnetController,
    CertificadoController,
    EntidadesFormadoreasController,
    ExamenController,
    OperadoresController,
    CategoryController,
    AsistentController,
    FaqController,
    FrontController,
    GeneralController,
    LinkController,
    HorarioController,
    PartnerController,
    PcategoryController,
    CursosController,
    PostController,
    FormadoresController,
    TagController,
    TestimonialController,
    TeamController,
    UserController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [FrontController::class, 'home'])->name('homepage');
Route::post('/', [FrontController::class, 'subscribe'])->name('subscribe');
Route::get('about-us', [FrontController::class, 'about'])->name('about');
Route::get('contact', [FrontController::class, 'contact'])->name('contact');
Route::get('entidades', [FrontController::class, 'entidades'])->name('entidades');
Route::get('testimonials', [FrontController::class, 'testi'])->name('testi');
Route::get('cursos', [FrontController::class, 'cursos'])->name('cursos');
Route::get('curso/{slug}', [FrontController::class, 'curso'])->name('curso');
Route::get('carnets', [FrontController::class, 'carnets'])->name('carnets');
Route::POST('searchcarnet', [FrontController::class, 'searchcarnet'])->name('searchcarnet');
Route::get('carnet/{slug}', [FrontController::class, 'carnet'])->name('carnet');
Route::get('partners', [FrontController::class, 'partners'])->name('partners');
Route::get('partner/{slug}', [FrontController::class, 'partner'])->name('partner');
Route::get('entidades_formadoras', [FrontController::class, 'entidades_formadoras'])->name('entidades_formadoras');
Route::get('entidade_formadora/{slug}', [FrontController::class, 'entidade_formadora'])->name('entidade_formadora');
Route::get('blog', [FrontController::class, 'blog'])->name('blog');
Route::get('blog/search',[FrontController::class, 'search'])->name('search');
Route::get('blog/{slug}', [FrontController::class, 'blogshow'])->name('blogshow');
Route::get('categories/{category:slug}',[FrontController::class, 'category'])->name('category');
Route::get('tags/{tag:slug}',[FrontController::class, 'tag'])->name('tag');
Route::get('pages/{slug}', [FrontController::class, 'page'])->name('page');
//Route::resource('entidades_formadoreas', 'Entidades_FormadoreasController');
//Route::resource('formadores', \App\Http\Controllers\FormadoresController::class);



Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['as'=>'admin.','prefix'=>'admin','middleware'=>'auth'],function () {
    Route::get('migrate', [FrontController::class, 'migrate'])->middleware('can:isAdmin')->name('migrate');
    Route::get('dashboard', [GeneralController::class, 'dashboard'])->name('dashboard');

    // General settings
    Route::get('general-settings', [GeneralController::class, 'general'])->middleware('can:isAdmin')->name('general');
    Route::post('general-settings', [GeneralController::class, 'generalUpdate'])->middleware('can:isAdmin')->name('general.update');

    // About
    Route::get('about', [GeneralController::class, 'about'])->middleware('can:isAdmin')->name('about');
    Route::post('about', [GeneralController::class, 'aboutUpdate'])->middleware('can:isAdmin')->name('about.update');

    // Manage Banner
    Route::get('banner', [BannerController::class, 'index'])->middleware('can:isAdmin')->name('banner');
    Route::get('banner/create', [BannerController::class, 'create'])->middleware('can:isAdmin')->name('banner.create');
    Route::post('banner/create', [BannerController::class, 'store'])->middleware('can:isAdmin')->name('banner.store');
    Route::get('banner/edit/{id}', [BannerController::class, 'edit'])->middleware('can:isAdmin')->name('banner.edit');
    Route::post('banner/edit/{id}', [BannerController::class, 'update'])->middleware('can:isAdmin')->name('banner.update');
    Route::delete('banner/destroy/{id}',[BannerController::class, 'destroy'])->middleware('can:isAdmin')->name('banner.destroy');

     // Manage Portfolio Categories
     Route::get('portfolio-categories', [PcategoryController::class, 'index'])->name('pcategory');
     Route::post('portfolio-categories', [PcategoryController::class, 'store'])->name('pcategory.store');
     Route::get('Portfolio-categories/edit/{id}', [PcategoryController::class, 'edit'])->name('pcategory.edit');
     Route::post('Portfolio-categories/edit/{id}', [PcategoryController::class, 'update'])->name('pcategory.update');
     Route::delete('Portfolio-categories/destroy/{id}',[PcategoryController::class, 'destroy'])->name('pcategory.destroy');

     // Manage asistent
    Route::get('asistent', [AsistentController::class, 'index'])->name('asistent');
    Route::get('asistent/create/{id}', [AsistentController::class, 'create'])->name('asistent.create');
    Route::post('asistent/create', [AsistentController::class, 'store'])->name('asistent.store');
    Route::get('asistent/edit/{id}', [AsistentController::class, 'edit'])->name('asistent.edit');
    Route::get('asistent/export',[AsistentController::class, 'export'])->name('asistent.export');
    Route::post('asistent/edit/{id}', [AsistentController::class, 'update'])->name('asistent.update');
    Route::delete('asistent/destroy/{id}',[AsistentController::class, 'destroy'])->name('asistent.destroy');

    // Manage Portfolio
//    Route::resource('cursos',CursosController::class);
    Route::get('cursos', [CursosController::class, 'index'])->name('cursos');
    Route::get('inactiveCursos', [CursosController::class, 'index2'])->name('inactiveCursos');
    Route::get('cursos/create', [CursosController::class, 'create'])->name('cursos.create');
    Route::post('cursos/create', [CursosController::class, 'store'])->name('cursos.store');
    Route::get('cursos/edit/{id}', [CursosController::class, 'edit'])->name('cursos.edit');
    Route::post('cursos/edit/{id}', [CursosController::class, 'update'])->name('cursos.update');
    Route::delete('cursos/destroy/{id}',[CursosController::class, 'destroy'])->name('cursos.destroy');
    Route::post('cursos/activo/{id}',[CursosController::class, 'activo'])->name('cursos.activo');
    Route::get('cursos/export',[CursosController::class, 'export'])->name('cursos.export');
    Route::get('cursos/print/{id}',[CursosController::class, 'print'])->name('cursos.print');
    Route::get('cursos/prnpriview',[CursosController::class, 'prnpriview'])->name('cursos.prnpriview');

    //print
//    Route::get('/cursos','PrintController@index');
//    Route::get('/prnpriview','PrintController@prnpriview');


    // Manage Categories
     Route::get('categories', [CategoryController::class, 'index'])->name('category');
     Route::get('categories/create', [CategoryController::class, 'create'])->name('category.create');
     Route::post('categories/create', [CategoryController::class, 'store'])->name('category.store');
     Route::get('categories/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
     Route::post('categories/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
     Route::delete('categories/destroy/{id}',[CategoryController::class, 'destroy'])->name('category.destroy');

     // Manage Tags
     Route::get('tags', [TagController::class, 'index'])->name('tag');
     Route::get('tags/create', [TagController::class, 'create'])->name('tag.create');
     Route::post('tags/create', [TagController::class, 'store'])->name('tag.store');
     Route::get('tags/edit/{id}', [TagController::class, 'edit'])->name('tag.edit');
     Route::post('tags/edit/{id}', [TagController::class, 'update'])->name('tag.update');
     Route::delete('tags/destroy/{id}',[TagController::class, 'destroy'])->name('tag.destroy');

     // Manage Blog
    Route::get('post',[PostController::class, 'index'])->middleware('can:isAdmin')->name('post');
    Route::get('post/create',[PostController::class, 'create'])->middleware('can:isAdmin')->name('post.create');
    Route::post('post/create',[PostController::class, 'store'])->middleware('can:isAdmin')->name('post.store');
    Route::get('post/edit/{id}',[PostController::class, 'edit'])->middleware('can:isAdmin')->name('post.edit');
    Route::post('post/edit/{id}',[PostController::class, 'update'])->middleware('can:isAdmin')->name('post.update');
    Route::get('post/trash',[PostController::class, 'trash'])->middleware('can:isAdmin')->name('post.trash');
    Route::post('post/{id}/restore',[PostController::class, 'restore'])->middleware('can:isAdmin')->name('post.restore');
    Route::delete('post/trash/{id}',[PostController::class, 'destroy'])->middleware('can:isAdmin')->name('post.destroy');
    Route::delete('post/destroy/{id}',[PostController::class, 'deletePermanent'])->middleware('can:isAdmin')->name('post.deletePermanent');

    // Manage Testimonials
    Route::get('testimonials', [TestimonialController::class, 'index'])->name('testi');
    Route::get('testimonials/create', [TestimonialController::class, 'create'])->name('testi.create');
    Route::post('testimonials/create', [TestimonialController::class, 'store'])->name('testi.store');
    Route::get('testimonials/edit/{id}', [TestimonialController::class, 'edit'])->name('testi.edit');
    Route::post('testimonials/edit/{id}', [TestimonialController::class, 'update'])->name('testi.update');
    Route::delete('testimonials/destroy/{id}',[TestimonialController::class, 'destroy'])->name('testi.destroy');

    // Manage Pages
    Route::get('horario', [HorarioController::class, 'index'])->name('horario');
    Route::get('horario/create/{id}', [HorarioController::class, 'create'])->name('horario.create');
    Route::post('horario/create', [HorarioController::class, 'store'])->name('horario.store');
    Route::get('horario/edit/{id}', [HorarioController::class, 'edit'])->name('horario.edit');
    Route::post('horario/edit/{id}', [HorarioController::class, 'update'])->name('horario.update');
    Route::delete('horario/destroy/{id}',[HorarioController::class, 'destroy'])->name('horario.destroy');

    // Manage about
    Route::get('abouts', [LinkController::class, 'index'])->name('link');
    Route::get('abouts/create', [LinkController::class, 'create'])->name('link.create');
    Route::post('abouts/create', [LinkController::class, 'store'])->name('link.store');
    Route::get('abouts/edit/{id}', [LinkController::class, 'edit'])->name('link.edit');
    Route::post('abouts/edit/{id}', [LinkController::class, 'update'])->name('link.update');
    Route::delete('abouts/destroy/{id}',[LinkController::class, 'destroy'])->name('link.destroy');

    // Manage FAQ
    Route::get('tipo', [FaqController::class, 'index'])->name('faq');
    Route::get('tipo/create', [FaqController::class, 'create'])->name('faq.create');
    Route::post('tipo/create', [FaqController::class, 'store'])->name('faq.store');
    Route::get('tipo/edit/{id}', [FaqController::class, 'edit'])->name('faq.edit');
    Route::post('tipo/edit/{id}', [FaqController::class, 'update'])->name('faq.update');
    Route::delete('tipo/destroy/{id}',[FaqController::class, 'destroy'])->name('faq.destroy');

    // Manage Partners
    Route::get('partners', [PartnerController::class, 'index'])->middleware('can:isAdmin')->name('partner');
    Route::get('partners/create', [PartnerController::class, 'create'])->middleware('can:isAdmin')->name('partner.create');
    Route::post('partners/create', [PartnerController::class, 'store'])->middleware('can:isAdmin')->name('partner.store');
    Route::get('partners/edit/{id}', [PartnerController::class, 'edit'])->middleware('can:isAdmin')->name('partner.edit');
    Route::post('partners/edit/{id}', [PartnerController::class, 'update'])->middleware('can:isAdmin')->name('partner.update');
    Route::delete('partners/destroy/{id}',[PartnerController::class, 'destroy'])->middleware('can:isAdmin')->name('partner.destroy');

    // Manage Services
    Route::get('formadores', [FormadoresController::class, 'index'])->name('formadores');
    Route::get('formadores/create', [FormadoresController::class, 'create'])->name('formadores.create');
    Route::post('formadores/create', [FormadoresController::class, 'store'])->name('formadores.store');
    Route::get('formadores/edit/{id}', [FormadoresController::class, 'edit'])->name('formadores.edit');
    Route::post('formadores/edit/{id}', [FormadoresController::class, 'update'])->name('formadores.update');
    Route::delete('formadores/destroy/{id}',[FormadoresController::class, 'destroy'])->name('formadores.destroy');
    Route::get('formadores/export',[FormadoresController::class, 'export'])->middleware('can:isAdmin')->name('formadores.export');

    // Manage Services
    Route::get('operadores', [OperadoresController::class, 'index'])->name('operadores');
    Route::get('operadores/certificado/{id}', [OperadoresController::class, 'certificado'])->name('operadores.certificado');
    Route::get('operadores/create', [OperadoresController::class, 'create'])->name('operadores.create');
    Route::post('operadores/create', [OperadoresController::class, 'store'])->name('operadores.store');
    Route::get('operadores/edit/{id}', [OperadoresController::class, 'edit'])->name('operadores.edit');
    Route::post('operadores/edit/{id}', [OperadoresController::class, 'update'])->name('operadores.update');
    Route::delete('operadores/destroy/{id}',[OperadoresController::class, 'destroy'])->name('operadores.destroy');
    Route::get('operadores/export',[OperadoresController::class, 'export'])->middleware('can:isAdmin')->name('operadores.export');
    Route::get('operadores/show/{id}', [OperadoresController::class, 'show'])->middleware('can:isAdminOrResponsable')->name('operadores.show');


    // Manage Team
    Route::get('entidades_formadores', [EntidadesFormadoreasController::class, 'index'])->middleware('can:isAdminOrResponsable')->name('entidades_formadoreas');
    Route::get('entidades_formadores/create', [EntidadesFormadoreasController::class, 'create'])->middleware('can:isAdminOrResponsable')->name('entidades_formadoreas.create');
    Route::post('entidades_formadores/create', [EntidadesFormadoreasController::class, 'store'])->middleware('can:isAdminOrResponsable')->name('entidades_formadoreas.store');
    Route::get('entidades_formadores/export',[EntidadesFormadoreasController::class, 'export'])->middleware('can:isAdmin')->name('entidades_formadoreas.export');
    Route::get('entidades_formadores/edit/{id}', [EntidadesFormadoreasController::class, 'edit'])->middleware('can:isAdminOrResponsable')->name('entidades_formadoreas.edit');
    Route::post('entidades_formadores/edit/{id}', [EntidadesFormadoreasController::class, 'update'])->middleware('can:isAdminOrResponsable')->name('entidades_formadoreas.update');
    Route::delete('entidades_formadores/destroy/{id}',[EntidadesFormadoreasController::class, 'destroy'])->middleware('can:isAdmin')->name('entidades_formadoreas.destroy'); Route::get('entidades_formadores/edit/{id}', [EntidadesFormadoreasController::class, 'edit'])->middleware('can:isAdminOrResponsable')->name('entidades_formadoreas.edit');
    Route::get('entidades_formadores/show/{id}', [EntidadesFormadoreasController::class, 'show'])->middleware('can:isAdminOrResponsable')->name('entidades_formadoreas.show');


    // Manage Examen
    Route::get('examen', [ExamenController::class, 'index'])->middleware('can:isAdminOrResponsable')->name('examen');
    Route::get('examen/create', [ExamenController::class, 'create'])->middleware('can:isAdminOrResponsable')->name('examen.create');
    Route::post('examen/create', [ExamenController::class, 'store'])->middleware('can:isAdminOrResponsable')->name('examen.store');
    Route::get('examen/edit/{id}', [ExamenController::class, 'edit'])->middleware('can:isAdminOrResponsable')->name('examen.edit');
    Route::post('examen/edit/{id}', [ExamenController::class, 'update'])->middleware('can:isAdminOrResponsable')->name('examen.update');
    Route::delete('examen/destroy/{id}',[ExamenController::class, 'destroy'])->middleware('can:isAdmin')->name('examen.destroy');

    // Manage Carnet

    Route::get('carnet/choseOperador', [CarnetController::class, 'choseOperador'])->middleware('can:isAdminOrResponsable')->name('carnet.choseOperador');
    Route::post('carnet/choseOperador', [CarnetController::class, 'choseOperadore'])->middleware('can:isAdminOrResponsable')->name('carnet.choseOperadore');
    Route::get('carnet', [CarnetController::class, 'index'])->name('carnet');
    Route::get('inactiveCarnet', [CarnetController::class, 'index2'])->name('inactiveCarnet');
    Route::get('carnet/create', [CarnetController::class, 'create'])->middleware('can:isAdminOrResponsable')->name('carnet.create');
    Route::get('carnet/add/[{operador},{curso}]', [CarnetController::class, 'add'])->middleware('can:isAdminOrResponsable')->name('carnet.add');
    Route::post('carnet/create', [CarnetController::class, 'store'])->middleware('can:isAdminOrResponsable')->name('carnet.store');
    Route::get('carnet/edit/{id}', [CarnetController::class, 'edit'])->middleware('can:isAdminOrResponsable')->name('carnet.edit');
    Route::post('carnet/edit/{id}', [CarnetController::class, 'update'])->middleware('can:isAdminOrResponsable')->name('carnet.update');
    Route::delete('carnet/destroy/{id}',[CarnetController::class, 'destroy'])->middleware('can:isAdmin')->name('carnet.destroy');


    // Manage Certificado
    Route::get('certificado', [CertificadoController::class, 'index'])->name('certificado');
    Route::get('inactiveCertificado', [CertificadoController::class, 'index2'])->name('inactiveCertificado');
    Route::get('certificado/create', [CertificadoController::class, 'create'])->middleware('can:isAdminOrResponsable')->name('certificado.create');
    Route::post('certificado/create', [CertificadoController::class, 'store'])->middleware('can:isAdminOrResponsable')->name('certificado.store');
    Route::get('certificado/edit/{id}', [CertificadoController::class, 'edit'])->middleware('can:isAdminOrResponsable')->name('certificado.edit');
    Route::post('certificado/edit/{id}', [CertificadoController::class, 'update'])->middleware('can:isAdminOrResponsable')->name('certificado.update');
    Route::delete('certificado/destroy/{id}',[CertificadoController::class, 'destroy'])->middleware('can:isAdmin')->name('certificado.destroy');
    Route::get('certificado/export/{activo}',[CertificadoController::class, 'export'])->middleware('can:isAdmin')->name('certificado.export');

    // Manage Admin
    Route::resource('users',UserController::class);
     Route::get('users', [UserController::class, 'index'])->middleware('can:isAdminOrResponsable')->name('users.index');
     Route::post('users/{id}', [UserController::class, 'changepassword'])->middleware('can:isAdminOrResponsable')->name('users.changepassword');
     Route::get('users/create', [UserController::class, 'create'])->middleware('can:isAdminOrResponsable')->name('users.create');
//     Route::post('users/store', [UserController::class, 'store'])->middleware('can:isAdminOrResponsable')->name('users.store');
     Route::get('users/edit/{id}', [UserController::class, 'edit'])->middleware('can:isAdminOrResponsable')->name('users.edit');
     Route::post('users/edit/{id}', [UserController::class, 'update'])->middleware('can:isAdminOrResponsable')->name('users.update');
     Route::delete('users/destroy/{id}',[UserController::class, 'destroy'])->middleware('can:isAdmin')->name('users.destroy');
});
