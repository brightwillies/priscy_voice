<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontendController extends Controller
{

    public function home()
    {
        $title          = 'Home';
        $latestBlogs    = News::select('*')->where('status', 1)->orderBy('date', 'DESC')->take(3)->get();
        $findCategories = Category::all()->filter(function ($singleCategory) {
            $blogs = News::where('category_id', $singleCategory->id)->where('status', 1)->take(3)->get();
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

        $categoryText = '';
        $CategoryId   = 0;
   $categories = Category::all();
        switch ($category) {
            case 'public-relations':
                $CategoryId   = 1;
                $categoryText = "Public Relations (PR) was considered as media relations, eloquence or articulation; however, the narrative has now changed, PR has evolved into maintaining or developing an intentional relationship with stakeholders and having a good reputation before these stakeholders, which enhances brand image, credibility and visibility. PR no longer has to do with only institutions but individuals as well, thanks to PR, a brand is no longer about logo but rather the values, mission and vision of a corporation or an individual, in other words, what they stand for! In case of issues, crises, your brand which signifies your values will speak in defense of the corporation. Safeguard your brand!!";
                break;
            case 'story-telling':
                $CategoryId   = 2;
                $categoryText = "Every storyteller loves to talk, yes talking is a gift I must say. Growing up, my family and friends used to give disparaging remarks about my gift of talking, even in school my name was always part of talkative, I used to be ashamed of that then. However, I noticed my classmates and friends even had terrible qualities or attributes that landed them in trouble such as fighting, stealing, cheating etc. Having observed this, I told myself I would rather channel this gift of talking into something more appealing, promising and inspirational. I wanted to be a journalist then, hence,  I never missed 7 O’clock news that aired on GTV in the 90’s with the introduction song ‘I promise on my honour to be faithful and loyal to Ghana my motherland,  I promise to hold in high esteem, our heritage won for us through the blood of our forefathers………..’ with the black and white background displaying the Adomi bridge, independence square, showing some significant pictures of the boneshaker (wooden lorry ), trotro (public transport) and pedestrians, that was indeed the Gold Coast.  I always admired the news anchors back then, such as Earl Ankrah, Barbara Sam now Barbara Gaisie, Akushika Acquaye, always cladded in our Ghanaian traditional outfits on screen. Though I never understood the news stories, I loved watching the pictures, that was fulfilling.  Apart from watching the news, I love reading, my dad will always get me story books, I also love writing letters to my family and friends. In school, we used to write about how to prepare favorite dishes, your family, your best friend, your mum etc., I also wrote with so much passion. I always used to score 10/10 during dictation, I was also part of inter school spelling competition in class six (1998). I identified my strength in terms of academics at an early age, however, as the saying goes ‘life happened’, there were twists and turns to my journey, which I will share with you as and when. Cheers!!!";
                break;
            case 'globe-trotter':
                $CategoryId   = 3;
                $categoryText = "I never knew I would ever travel the world, especially Africa. I never knew I would work with an international organization. All I knew was that I was going to be a journalist one day.  At a point I wanted to be a French lecturer, yes, I wanted to inspire and impart through teaching. Here I am today working for Africa across and beyond the continent. I will take you through my work journey in various African countries. Currently I have explored more than 20 African countries within the 5 regions of the continent (West, East, North, Southern, and Central). Oh, and my 3 year stay in France, Strasbourg and few countries I visited in Europe before returning to Ghana my Motherland. Stay tuned with me and enjoy reading! A très bientôt!";

                break;
            case 'learn-a-language':
                $CategoryId   = 4;
                $categoryText = "How would you feel about being denied a juicy position just because you cannot express yourself in a foreign language? Did you know that language is a powerful tool? As a former linguistics student, I have learnt the advantages of speaking another language apart from one’s mother tongue. Did you know that if you are applying for a job with any international organization such as the UN, AU, EU etc., if you can speak English and French, you already have 3 points for free in your quiver? If you can speak a third additional language namely Portuguese, Spanish, Arabic, Swahili etc., wow that’s a sweet 5 points before the start of the interview (oral and written). Oh yeah! Do you now believe that language is a powerful tool, no wonder God Almighty had to distort the plans of the people who were building the tower of Babel by separating them with different languages. Learn a new language today !  Yes, it may take time but make a move, it is never too late. Allez!! C’est possible! Lol.";
                break;
            case 'trends-insight':
                $CategoryId   = 5;
                $categoryText = "I would like to share a few feedback on books, movies, programs, podcasts that I have read, listened, watched and attended. I would also like to periodically appreciate the few individuals in my journey of life on this page to uplift and encourage them in their endeavours.  Thoughts will be shared on trends in the field of public relations, language learning and trips.      Stay glued here!!";
                break;
            case 'voix-global-communications':
                $CategoryId   = 6;
                $categoryText = "This is an entrepreneurial initiative birthed with the quest to be a global public speaker in moderation and emceeing bilingual (English and French) events like my mentor Anita Erskine. I dream of being on those global platforms where Voix Global Communications will be a household name. I started emceeing (English and Ewe, my mother tongue) way back in my local church in Revival Assemblies God Church, Hohoe, where raw talents and gifts were honed and nurtured for future benefits both spiritually and academically. Additionally, I continued emceeing in church in Christ Reform Evangelical Church (CREC) in Strasbourg, France, this time around English to French and vice versa from 2017 to 2020.
              Before emceeing in church, I was a member of a short lived yet vibrant club called Bright Future Club (BBF) which was formed by two young men in 2001, Rex Obed Agbo and Edem Tamakloe. This club had a bright future for the youth of Hohoe, unfortunately, the founders left Hohoe township to Accra, hence the collapse of this beautiful project that started on a very good note. I started acting plays in this club, reciting poems, singing, expressing myself amongst ourselves during club meetings in English (English is not our mother tongue but rather language of instruction and administration). I was a bit shy, a lot of people will disagree with me on this, but I am. Thanks to this club, I became very expressive in public, mind you I am a talkative lol as a result, taking the emcee role in church was an easy feat though there will always be butterflies in the tummy. Voix Global communications will soon be heard by the world. Watch out!";
                break;

            case 'others':
                $CategoryId   = 7;
                $categoryText = "";
                break;

            default:
                # code...
                break;
        }
        $title = Str::upper($category);

        $blogs = News::where('category_id', $CategoryId)->where('status', 1)->get();

        return view('blog_category', compact('category', 'blogs', 'categoryText', 'title',  'categories'));
    }

    public function singleBlog($id)
    {

        $title      = 'Blog';
        $blog       = News::where('mask', $id)->first();
        $otherBlogs = News::where('mask', '<>', $id)->where('status', 1)->take(5)->get();

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

    public function storeComment(Request $request, $blog)
    {

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'name'    => 'required_if:user_id,null|string|max:255',
            'email'   => 'required_if:user_id,null|email|max:255',
        ]);
        $findBlog = News::where('mask', $blog)->first();

        $comment          = new Comment($validated);
        $comment->news_id = $findBlog->id;

        // if (auth()->check()) {
        //     $comment->user_id = auth()->id();
        // }

        $comment->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Comment posted successfully!',
                'comment' => $comment,
            ]);
        }

        return back()->with('success', 'Comment posted successfully!');

    }

    public function toggleLike(Request $request, $blogID)
    {
        $ip   = $request->ip();

        $blog = News::where('mask', $blogID)->first();

        $like = $blog->likes()
            ->where('ip_address', $ip)
            ->first();

        if ($like) {
            // Unlike if already liked
            $like->delete();
            return response()->json([
                'success' => true,
                'action'  => 'unliked',
                'count'   => $blog->likes()->count(),
            ]);
        } else {
            // Like if not already liked
            $blog->likes()->create(['ip_address' => $ip]);
            return response()->json([
                'success' => true,
                'action'  => 'liked',
                'count'   => $blog->likes()->count(),
            ]);
        }
    }

}
