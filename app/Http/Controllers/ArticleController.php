<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
class ArticleController extends Controller
{
    public function index()
    {
        // Logic to retrieve articles from the database
        // For now, we can return a simple message
        //return 'List of articles';
        $articles = Article::orderBy('published_at', 'desc')->paginate(4);

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
        // Logic to update an existing article in the database
        $article = Article::findOrFail($id);
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->author = $request->input('author');
        $article->category_id = $request->input('category_id')?? 1;
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
