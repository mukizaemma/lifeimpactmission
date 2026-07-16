<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresOptimizedImages;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\News;
use App\Models\Blogimages;
use InvalidArgumentException;

class NewsController extends Controller
{
    use StoresOptimizedImages;

    public function index()
    {

        $blogs = News::latest()->paginate(10);
        return view('admin.news', [
            'blogs' => $blogs
        ]);
    }

    // public function showAll()
    // {
    //     $blogs = News::latest()->paginate(10);
    //     return view('pages.blogs.home', [
    //         'blogs' => $blogs
    //     ]);
    // }

    // public function showSingle($slug)
    // {
    //     $blog = Blog::where('slug', $slug)->first();
    //     return view('pages.blogs.blog', compact('blog'));
    // }

    // public function show($id)
    // {
    //     $blog = News::find($id);
    //     return view('pages.blogs.blog', compact('blog'));
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'image' => app(ImageUploadService::class)->validationRules(true, false),
            'gallery.*' => app(ImageUploadService::class)->validationRules(true, false),
        ]);

        $fileName = '';
        try {
            if ($request->hasFile('image')) {
                $fileName = $this->storeOptimizedImage($request->file('image'), 'images/news');
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        // Generate the slug
        $slug = Str::of($request->input('title'))->slug();

        // Check if a blog post with the same slug already exists
        $blog = News::firstOrCreate(
            ['slug' => $slug],
            [
                'title' => $request->input('title'),
                'author' => $request->input('author'),
                'body' => $request->input('body'),
                'image' => $fileName,
                'slug' => $slug
            ]
        );

        try {
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $gallery) {
                    $galleryName = $this->storeOptimizedImage($gallery, 'images/galleries');
                    $blog->Blogimages()->create(['gallery' => $galleryName]);
                }
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        return redirect('blogs')->with('success', 'Blog post created successfully');

    }


    public function edit($id)
    {
        $blog = News::find($id);
        return view('admin.newsUpdate', compact('blog'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => app(ImageUploadService::class)->validationRules(true, false),
            'gallery.*' => app(ImageUploadService::class)->validationRules(true, false),
        ]);

        $blog = News::find($id);

        try {
            if ($request->hasFile('image')) {
                $blog->image = $this->storeOptimizedImage(
                    $request->file('image'),
                    'images/news',
                    true,
                    $blog->image
                );
            }

            if ($request->hasFile('gallery')) {
                $oldGallery = $blog->Blogimages;
                foreach ($oldGallery as $image) {
                    Storage::disk('public')->delete('images/galleries/' . ltrim($image->gallery, '/'));
                    $image->delete();
                }
                foreach ($request->file('gallery') as $gallery) {
                    $galleryName = $this->storeOptimizedImage($gallery, 'images/galleries');
                    $blog->Blogimages()->create(['gallery' => $galleryName]);
                }
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        // Update the other fields
        $blog->title = $request->input('title');
        $blog->author = $request->input('author');
        $blog->body = $request->input('body');
        $blog->slug = Str::of($request->input('title'))->slug();
        $blog->save();

        return redirect('blogs')->with('success', 'News post has been updated successfully');
    }




    public function destroy($id)
    {
        $blog = News::findOrFail($id);
        $image = $blog->image;
        $galleries = $blog->Blogimages;
        // delete the image file
        Storage::delete('public/images/news/'.$image);
        // delete the gallery files
        foreach($galleries as $gallery) {
            Storage::delete('public/images/galleries/'.$gallery->gallery);
        }
        $blog->Blogimages()->delete();
        $blog->delete();

        return back()
            ->with('success', 'News deleted successfully');
    }

    public function publish(Blog $blog): RedirectResponse
    {
        $blog->published_at = now();
        $blog->published_by = auth()->id();
        $blog->save();

        return back()->with('success', 'News published successfully');
    }
}
