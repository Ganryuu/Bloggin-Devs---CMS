<?php

namespace App\Http\Controllers;

use App\Mail\VisitorContact;
use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    protected $setting;

    public function __construct()
    {
        $setting = Setting::all()->first();
        $this->setting = $setting;
    }
    public function index()
    {
        $setting = $this->setting;
        $categories = Category::orderBy('name', 'ASC')->where('is_published', '1')->get();
        $posts = Post::orderBy('id', 'DESC')->where('post_type', 'post')->where('is_published', '1')->paginate(5);
        $sliders = Slider::where('active', 1)->get();
        return view('website.index', compact('posts', 'categories', 'sliders', 'setting'));
    }

    public function post($slug)
    {
        $setting = $this->setting;

        $post = Post::where('slug', $slug)->where('post_type', 'post')->where('is_published', '1')->first();
        if ($post) {
            return view('website.post', compact('post', 'setting'));
        } else {
            return \Response::view('website.errors.404', array(), 404);
        }
    }

    public function category($slug)
    {
        $setting = $this->setting;

        $categories = Category::where('slug', $slug)->where('is_published', '1')->first();
        if ($categories) {
            $posts = $categories->posts()->orderBy('posts.id', 'DESC')->where('is_published', '1')->paginate(5);
            return view('website.category', compact('categories', 'posts', 'setting'));
        } else {
            return \Response::view('website.errors.404', array(), 404);
        }
    }

    public function page($slug)
    {
        $setting = $this->setting;

        $page = Post::where('slug', $slug)->where('post_type', 'page')->where('is_published', '1')->first();
        if ($page) {
            return view('website.page', compact('page', 'setting'));
        } else {
            return \Response::view('website.errors.404', array(), 404);
        }
    }

    public function showContactForm()
    {
        $setting = $this->setting;

        return view('website.contact', compact('setting'));
    }

    public function submitContactForm(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->tel,
            'messaged' => $request->messaged
        ];

        // visitorcontact() is like middleware from controller to mail template
        Mail::to('yourmail@address.com')->send(new VisitorContact($data));

        session()->flash('message', 'Thank You for your email');
        return redirect()->route('contact.show');
    }
}
