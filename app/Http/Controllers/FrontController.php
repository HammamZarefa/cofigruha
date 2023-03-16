<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{About,
    Asistent,
    Banner,
    Carnet,
    Category,
    Cursos,
    EntidadesFormadoreas,
    Faq,
    General,
    Horario,
    Link,
    Operadores,
    Page,
    Partner,
    Pcategory,
    Portfolio,
    Post,
    Tag,
    Team,
    Testimonial,
    Service,
    Subscriber,
    Tipo_Maquina};
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function home()
    {
        $about = About::find(1);
        $banner = Banner::all();
        $faqs = Faq::all();
        $pages =Link::all();
        $general = General::find(1);
//        $link = Link::orderBy('name','asc')->get();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $partner = Partner::orderBy('name','asc')->limit(8)->get();
        $pcategories = Pcategory::all()->where('estado', 1);
        $portfolio = Portfolio::all()->where('estado', 1);
        $service = Service::orderBy('title','asc')->get();
        return view ('front.home',compact('about','pages','faqs','banner','general','lpost','partner','pcategories','portfolio','service'));
    }

    public function about()
    {
        $about = About::find(1);
        $faq = Faq::all();
        $general = General::find(1);
//        $link = Link::orderBy('name','asc')->get();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $partner = Partner::orderBy('name','asc')->get();
        $team = Team::orderBy('id','asc')->get();
        return view ('front.about',compact('about','faq','general','lpost','partner','team'));
    }

    public function contact()
    {
        $about = About::find(1);
        $faq = Faq::all();
        $general = General::find(1);
        $link = Link::all();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $partner = Partner::orderBy('name','asc')->get();
        $team = Team::orderBy('id','asc')->get();
        return view ('front.cotact',compact('about','faq','general','link','lpost','partner','team'));
    }

//    public function entidades()
//    {
//        $about = About::find(1);
//        $faq = Faq::all();
//        $general = General::find(1);
//        $link = Link::all();
//        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
//        $partner = Partner::orderBy('name','asc')->get();
//        $team = Team::orderBy('id','asc')->get();
//        return view ('front.entidades_formadoreas',compact('about','faq','general','link','lpost','partner','team'));
//    }

    public function testi()
    {
        $general = General::find(1);
        $link = Link::all();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $testi = Testimonial::orderBy('name','asc')->paginate(6);
        return view ('front.testi',compact('general','link','lpost','testi'));
    }
    public function cursos()
    {
        $general = General::find(1);
        $cursos = Cursos::orderBy('id','desc')->where('publico_privado',1)->where('estado',1)->get();
        $entidades = EntidadesFormadoreas::orderBy('id','desc')->where('estado',1)->get();
        return view ('front.cursos',compact('general','cursos','entidades'));
    }

    public function curso($cursoo)
    {
        $general = General::find(1);
        $link = Link::all();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
//        $service = Service::where('slug', $slug)->firstOrFail();
        $curso = Cursos::where('curso',$cursoo)->firstOrFail();
        $entidad = EntidadesFormadoreas::where('id',$curso->entidad)->firstOrFail();
        $tipo = Tipo_Maquina::orderBy('id','desc')->get();
        $horario = Horario::orderBy('id','desc')->where('curso',$curso->id)->get();
        $asistent = Asistent::orderBy('id','desc')->where('curso',$curso->id)->get();

        $operador = Operadores::orderBy('id','desc')->get();

        return view ('front.curso',compact('general','operador','asistent','horario','tipo','entidad','link','lpost','curso'));
    }

    public function carnets()
    {
        $general = General::find(1);
        $cursos = Cursos::orderBy('id','desc')->where('publico_privado',1)->where('estado',1)->get();
        $carnets = Carnet::orderBy('id','desc')->get();
        $operadores = Operadores::orderBy('id','desc')->get();
        $test = "";
        return view ('front.carnets',compact('general','operadores','carnets','test'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchcarnet(Request $request)
    {
//        dd($request);
        $general = General::find(1);
//        dd($general);
        $now = now().date('');
        $carnet = Carnet::where('numero',$request->numero)->whereDate('fecha_de_emision' , '>' ,$now )->first();
        $carnet2 = Carnet::where('numero',$request->numero)->whereDate('fecha_de_emision' , '<=' ,$now )->first();
//dd($carnet2);
        if ($carnet2 != null && $carnet == null){
            $test = "Esta Carné ya expiró.";
            return view('front.carnets', compact('general','test'));
        }
        if($carnet != null){
            $operador = Operadores::where('id',$carnet->operador)->firstOrFail();

            $curso = Cursos::where('id',$carnet->curso)->firstOrFail();
//            dd($curso);
            return view ('front.carnet',compact('general','operador','carnet','curso'));
            } else {
            $test = "Ningún Carné coincide con el código buscado.";
            return view('front.carnets', compact('general','test'));
        }

    }

    public function migrate(){
        try {
            \Artisan::call("migrate");
            return \Artisan::call("migrate");
        }catch (\Exception $ex){
            return $ex->getMessage();
        }

    }

    public function carnet($id)
    {
        $general = General::find(1);
        $carnet = Carnet::where('id',$id)->firstOrFail();

        $operador = Operadores::where('id',$carnet->operador)->firstOrFail();
        $curso = Cursos::where('id',$carnet->curso)->firstOrFail();

        return view ('front.carnet',compact('general','operador','carnet','curso'));
    }

    public function partners()
    {
        $general = General::find(1);

        $partners = Partner::orderBy('id','desc')->get();
        return view ('front.partners',compact('general','partners'));
    }

    public function partner($id)
    {
        $general = General::find(1);
        $partner = Partner::where('id',$id)->firstOrFail();

        return view ('front.partner',compact('general','partner'));
    }

    public function entidades_formadoras()
    {
        $service = Service::orderBy('title','asc')->get();
        $general = General::find(1);
        $link = Link::all();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $pcategories = Pcategory::all();
        $portfolio = Portfolio::all();
        $entidadesFormadores = EntidadesFormadoreas::orderBy('id','desc')->where('estado',1)->get();
        return view ('front.entidades_formadoras',compact('general','entidadesFormadores','service','link','lpost','pcategories','portfolio'));
    }

    public function entidade_formadora($slug)
    {
        $general = General::find(1);
        $link = Link::all();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $entidadesFormadore = EntidadesFormadoreas::where('id', $slug)->firstOrFail();
        return view ('front.entidade_formadora',compact('general','link','lpost','entidadesFormadore'));
    }

    public function blog()
    {
        $user = Auth::user();
        $categories = Category::all();
        $general = General::find(1);
        $link = Link::all();
        if ($user != null){
            $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
            $posts = Post::where('status','=','PUBLISH')->orderBy('id','desc')->paginate(3);
        }else{
            $lpost = Post::where('status','=','PUBLISH')->where('public',1)->orderBy('id','desc')->limit(5)->get();
            $posts = Post::where('status','=','PUBLISH')->where('public',1)->orderBy('id','desc')->paginate(3);
        }

        $recent = Post::orderBy('id','desc')->limit(5)->get();
        $tags = Tag::all();

        return view ('front.blog',compact('categories','general','link','lpost','posts','recent','tags'));
    }

    public function blogshow($slug)
    {
        $user = Auth::user();
        $categories = Category::all();
        $general = General::find(1);
        $link = Link::all();
        if ($user != null){
            $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
            $post = Post::where('slug', $slug)->firstOrFail();
        }else{
            $lpost = Post::where('status','=','PUBLISH')->where('public',1)->orderBy('id','desc')->limit(5)->get();
            $post = Post::where('slug', $slug)->where('public',1)->firstOrFail();
        }

        $old = $post->views;
        $new = $old + 1;
        $post->views = $new;
        $post->update();
        $recent = Post::orderBy('id','desc')->limit(5)->get();
        $tags = Tag::get();

        return view ('front.blogshow',compact('categories','general','link','lpost','post','recent','tags'));
    }

    public function category(Category $category)
    {
        $user = Auth::user();
        $categories = Category::where('id',$category->id)->firstOrFail();
        $general = General::find(1);
        $link = Link::all();
        if ($user != null){
            $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
            $posts = $category->posts()->where('public',1)->latest()->paginate(6);
        }else{
            $lpost = Post::where('status','=','PUBLISH')->where('public',1)->orderBy('id','desc')->limit(5)->get();
            $posts = $category->posts()->where('public',1)->latest()->paginate(6);
        }

        $recent = Post::orderBy('id','desc')->limit(5)->get();
        $tags = Tag::all();
        return view ('front.category',compact('categories','general','link','lpost','posts','recent','tags'));
    }

    public function privadoCategory(Category $category)
    {
        $user = Auth::user();
        $categories = Category::where('id',$category->id)->firstOrFail();
        $general = General::find(1);
        $link = Link::all();
        if ($user != null){
//            dd('1');
            $lpost = Post::where('status','=','PUBLISH')->where('public',0)->orderBy('id','desc')->limit(5)->get();
            $posts = $category->posts()->where('public',0)->latest()->paginate(6);
        }else{
//            dd('2');
            $lpost = null;
            $posts = null;
        }
//        dd($posts);

        $recent = Post::orderBy('id','desc')->limit(5)->get();
        $tags = Tag::all();
        return view ('front.category',compact('categories','general','link','lpost','posts','recent','tags'));
    }

    public function tag(Tag $tag)
    {
        $user = Auth::user();
        $categories = Category::all();
        $general = General::find(1);
        $link = Link::all();
        if ($user != null){
            $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
            $posts = $tag->posts()->latest()->paginate(12);
            $recent = Post::orderBy('id','desc')->limit(5)->get();
        }else{
            $lpost = Post::where('status','=','PUBLISH')->where('public',1)->orderBy('id','desc')->limit(5)->get();
            $posts = $tag->posts()->where('public',1)->latest()->paginate(12);
            $recent = Post::orderBy('id','desc')->where('public',1)->limit(5)->get();
        }


        $tags = Tag::all();
        return view ('front.blog',compact('categories','general','link','lpost','posts','recent','tags'));
    }

    public function search()
    {

        $query = request("query");

        $categories = Category::all();
        $general = General::find(1);
        $link = Link::all();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $posts = Post::where("title","like","%$query%")->latest()->paginate(9);
        $recent = Post::orderBy('id','desc')->limit(5)->get();
        $tags = Tag::all();

        return view('front.blog',compact('categories','general','link','lpost','posts','query','recent','tags'));
    }

    public function page($slug)
    {
        $general = General::find(1);
        $link = Link::all();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('front.page',compact('general','link','lpost','page'));
    }

    public function subscribe(Request $request)
    {
        \Validator::make($request->all(), [
            "email" => "required|unique:subscribers,email",
        ])->validate();

        $subs = new Subscriber();
        $subs->email = $request->email;
        if ( $subs->save()) {

            return redirect()->route('homepage')->with('success', 'You have successfully subscribed');

           } else {

            return redirect()->back();

           }
    }

}
