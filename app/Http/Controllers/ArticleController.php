<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
class ArticleController extends Controller
{
    public function index()
    {
      // dd(Carbon::now()->toDateString()); // for current date 
      //dd(Carbon::now()->toTimeString());
      //dd(Carbon::now()->today()->format('d/m/Y'));
      //dd(Carbon::now()->today()->format('l'));
      $nextWeek = Carbon::now()->addWeek();
     // Carbon::setLocale('ar');
      //dd(Carbon::now()->subDays(3)->diffForHumans());//منذ 3 أيام
        // Logic to retrieve articles from the database
        // For now, we can return a simple message
        //return 'List of articles';
       // $articles = Article::onlyTrashed()->orderBy('published_at', 'desc')->paginate(4);
       // $articles = Article::withTrashed()->orderBy('published_at', 'desc')->paginate(4);
         $articles = Article::orderBy('published_at', 'desc')->paginate(4);
        //$article = Article::withTrashed()->find(6);
        //dd($article);
       // $article->forceDelete();
        //dd($articles); // Helper : This will dump the articles and stop execution it is caled for debugging
        
        return view('articles.index', compact('articles'));
    }
    public function show($id)
    {
        // Logic to retrieve a single article by ID
        $page = 'Article Details'; // Example variable to pass to the view
        $article = Article::findOrFail($id);
       // dd($article->category->name); // Helper : This will dump the category name of the article and stop execution it is called for debugging
         
        return view('articles.show', compact('article', 'page'));
    }
    public function create()
    {
        // Logic to show the article creation form
      
        return view('articles.create');
    }
    public function store(Request $request)
    {
        // Logic to store a new article in the database
        $article = new Article();
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->author = $request->input('author');
        $article->category_id = $request->input('category_id')?? 1;
        $article->published_at = $request->input('published_at');
        $article->user_id = Auth::id();
        // Handle image upload
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $file = $request->file('image');
            $fileName = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('uploads',$fileName,'public');
            $article->image = $path;
        }
        
        //$article->slug = \Str::slug($article->title); // Generate a slug from the title
        $article->save(); // Don't forget to save the article
        return redirect()->route('articles.index')->with('success', 'Article created successfully!') ;
    }
    public function edit($id)
    {
        // Logic to show the article edit form
        $article = Article::findOrFail($id);
        $categories = Category::all(); // Assuming you have a Category model to fetch categories
        return view('articles.edit', compact('article', 'categories'));
    }
    public function update(Request $request, $id)
    {
        // Validation for the update
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);
        // Logic to update an existing article in the database
        $article = Article::findOrFail($id);
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->author = $request->input('author');
        $article->user_id = auth()->id(); 
        $article->category_id = $request->input('category_id')?? 1;
        

        //upload image 
        if($request->hasFile('image') && $request->file('image')->isValid()){
            
            $file = $request->file('image');
            $fileName = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('uploads',$fileName,'public');
            $article->image = $path;
        }

        $article->published_at = $request->input('published_at');   
        $article->save();
        return redirect()->route('articles.index')->with('success', 'Article updated successfully!');
    
    }
    public function destroy($id)
    {
        // Logic to delete an article from the database
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully!');
    }

     
}
