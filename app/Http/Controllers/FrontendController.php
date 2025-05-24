<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\News;

class FrontendController extends Controller
{

    public function home()
    {
        $title          = 'Home';
        $latestBlogs    = News::select('*')->orderBy('date', 'DESC')->take(3)->get();
        $findCategories = Category::all()->filter(function ($singleCategory) {
            $blogs = News::where('category_id', $singleCategory->id)->take(3)->get();
            if ($blogs->isNotEmpty()) {
                $singleCategory->blogs = $blogs;
                return true; // Keep this category
            }
            return false; // Remove this category
        })->values(); // Reset keys (optional but recommended for views)

        // return $findCategories;
        return view('index', compact('title', 'latestBlogs', 'findCategories'));
    }

    public function blogCategory($category)
    {

        $CategoryId = 0;

        switch ($category) {
            case 'public-relations':
                $CategoryId = 1;
                break;
            case 'story-telling':
                $CategoryId = 2;
                break;
            case 'globe-trotter':
                $CategoryId = 3;
                break;
            case 'learn-a-language':
                $CategoryId = 4;
                break;
            case 'trends-insight':
                $CategoryId = 5;
                break;
            case 'voix-global-communications':
                $CategoryId = 6;
                break;

            case 'others':
                $CategoryId = 7;
                break;

            default:
                # code...
                break;
        }
          $title          = $category;

        $blogs = News::where('category_id', $CategoryId)->get();

        return view('blog_category', compact('category', 'blogs'));
    }

    public function singleBlog($id)
    {

        $title      = 'Blog';
        $blog       = News::where('mask', $id)->first();
        $otherBlogs = News::where('mask', '<>', $id)->take(5)->get();

        $categories = Category::all();
        return view('blog', compact('title', 'blog', 'otherBlogs', 'categories'));
    }



    public function about()
    {$title = 'About Us';
        return view('about', compact('title'));}

    public function contact()
    {
        $title = 'Contact Us';
        return view('contact', compact('title'));
    }
    public function programs()
    {
        $title = 'Contact Us';
        return view('program', compact('title'));
    }

}
