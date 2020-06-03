<?php

namespace App\Http\Controllers\Admin;

use App\BannedUser;
use App\FAQ;
use App\Feedback;
use App\Http\Controllers\Controller;

use App\Http\Requests\AdminBanRequest;
use App\Http\Requests\AdminUserRequest;
use App\Http\Requests\FAQRequest;
use App\Http\Requests\ReportUpdateRequest;
use App\Order;
use App\Report;
use App\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use App\Product;
use App\Admin;
use App\Genre;
use App\Platform;
use App\Category;
use App\Picture;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ProductAddRequest;
use Illuminate\Http\Request;
use Intervention\Image\Image;

class AdminController extends Controller {
    public function show() {
        $active_reports = Report::where('status', '=', 'false');

        $daily_orders = Order::where('date', '=', 'CURRENT_DATE');

        $daily_keys = [];
        foreach ($daily_orders as $daily_order) {
            foreach ($daily_order->keys as $key) {
                array_push($daily_keys, $key);
            }
        }

        $daily_keys_collection = collect($daily_keys);

        $monthly_orders = Order::where('date', '>=', 'cast(date_trunc(\'month\', CURRENT_DATE) as date)');

        $monthly_keys = [];
        foreach ($monthly_orders as $monthly_order) {
            foreach ($monthly_order->keys as $key) {
                array_push($monthly_keys, $key);
            }
        }

        $monthly_keys_collection = collect($monthly_keys);

        return view(
            'admin.pages.homepage',
            [
                'title' => 'Dashboard',
                'contents' => [
                    'Tasks to be done' => ['Active Reports: ' . $active_reports->count()],
                    'Daily Statistics' => [
                        'Transactions made: ' . $daily_keys_collection->count(),
                        'Money made: ' . $daily_keys_collection->sum(function ($daily_key) {
                            return $daily_key->price;
                        }) . ' US$'
                    ],
                    'Monthly Statistics' => [
                        'Transactions made: ' . $monthly_keys_collection->count(),
                        'Money made: ' . $monthly_keys_collection->sum(function ($monthly_key) {
                            return $monthly_key->price;
                        }) . ' US$'
                    ]
                ]
            ]
        );
    }

    public function productShow(Request $request) {

        if ($request->has('query')) {
            $query = implode(':* &', explode(' ', htmlentities($request->input('query'))));
            $products = Product::whereRaw("name_tsvector @@ to_tsquery('" . $query . ":*')")->get();
        } else {
            $products = Product::all();
        }

        $page = $request->has('page') ? $request->input('page') : 1;

        $products_paginated = $this->paginate($products, $page);

        $products_paginated->withPath('/admin/products');

        $products = Product::paginate(10);

        return view('admin.pages.products', [
            'products' => $products_paginated->items(),
            'title' => 'Products',
            'query' => ($request->has('query') ? $request->input('query') : ""),
            'links' => $products_paginated->links()

        ]);
    }

    public function productAdd(ProductAddRequest $request) {
        $this->authorize('admin', Admin::class);
        $product = new Product;

        $product->name = $request->get('gameName');
        $product->description = $request->get('gameDescription');
        $product->launch_date = Carbon::now();
        $category = Category::where('name', strtoupper($request->get('gameCategories')))->first();
        $product->category_id = $category->id;

        if ($request->file('img-upload') !== null) {

            $picture = $request->file('img-upload');
            $pictureORM = new Picture;
            $username = Auth::user()->username;
            $imgFinal = Image::make($picture->getRealPath());

            $hash = md5($username . now());
            $imgFinal->save('pictures/games/' . $hash . '.png');

            $pictureORM->url = $hash . '.png';
            $pictureORM->save();
            $product->picture_id = $pictureORM->id;
        }

        $product->save();


        $genres = explode(",", $request->get('gameGenres'));
        $platforms = explode(",", $request->get('gamePlatforms'));




        foreach ($genres as $genre) {

            $founded = Genre::where('name', strtoupper($genre))->first();
            $product->genres()->attach($founded->id);
        }

        foreach ($platforms as $platform) {
            $founded = Platform::where('name', strtoupper($platform))->first();

            $product->platforms()->attach($founded->id);
        }


        return redirect('/admin/products');
    }

    public function productAddForm() {
        $categories = Category::all();
        $genres = Genre::all();
        $platforms = Platform::all();

        return view('admin.pages.productAdd', ['categories' => $categories, 'genres' => $genres, 'platforms' => $platforms]);
    }

    public function productUpdateView($id) {

        $this->authorize('admin', Admin::class);

        $categories = Category::all();
        $genres = Genre::all();
        $platforms = Platform::all();

        $product = Product::findOrFail($id);


        return view('admin.pages.productEdit', ['data' => $product, 'categories' => $categories, 'genres' => $genres, 'platforms' => $platforms]);
    }

    public function productUpdate(ProductAddRequest $request, $id) {

        $this->authorize('admin', Admin::class);

        $product = Product::findOrFail($id);


        $product->name = $request->get('gameName');
        $product->description = $request->get('gameDescription');
        $product->launch_date = Carbon::now();
        $category = Category::where('name', strtoupper($request->get('gameCategories')))->first();
        $product->category_id = $category->id;

        if ($request->file('img-upload') !== null) {

            $picture = $request->file('img-upload');
            $pictureORM = new Picture;
            $username = Auth::user()->username;
            $imgFinal = Image::make($picture->getRealPath());

            $hash = md5($username . now());
            $imgFinal->save('pictures/games/' . $hash . '.png');

            $pictureORM->url = $hash . '.png';
            $pictureORM->save();
            $product->picture_id = $pictureORM->id;
        }

        $product->save();


        $genres = explode(",", $request->get('gameGenres'));
        $platforms = explode(",", $request->get('gamePlatforms'));

        $product->genres()->detach();
        $product->platforms()->detach();

        foreach ($genres as $genre) {

            $founded = Genre::where('name', strtoupper($genre))->first();

            $product->genres()->attach($founded->id);
        }

        foreach ($platforms as $platform) {

            $founded = Platform::where('name', strtoupper($platform))->first();

            $product->platforms()->attach($founded->id);
        }

        return redirect('/admin/products');
    }

    public function productDelete($id) {
        $this->authorize('admin', Admin::class);

        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back();
    }

    public function categoryShow()
    {
        $data = Category::all();

        return view('admin.pages.category', ['data' => $data]);
    }

    public function categoryAdd(Request $request) {
        $this->authorize('admin', Admin::class);

        if (!$request->has('category'))
            return response(400);

        $category = new Category;

        $category->name = $request->get('category');

        $category->save();

        return back();
    }

    public function categoryUpdate(Request $request, $id) {
        $this->authorize('admin', Admin::class);

        $category = Category::findOrFail($id);

        if (!$request->has('category'))
            return response(400);

        $category->name = $request->get('category');
        $category->save();

        return back();
    }

    public function categoryDelete(Request $request, $id) {
        $this->authorize('admin', Admin::class);

        $category = Category::findOrFail($id);

        try {
            $category->delete();
        } catch (QueryException $ex) {
            return redirect('/admin');
        }

        return back();
    }

    public function genreShow() {
        $this->authorize('admin', Admin::class);

        $data = Genre::all();

        return view('admin.pages.genres', ['data' => $data]);
    }

    public function genreAdd(Request $request) {
        $this->authorize('admin', Admin::class);

        if (!$request->has('genre'))
            return response(400);

        $genre = new Genre;

        $genre->name = $request->get('genre');

        $genre->save();

        return back();
    }

    public function genreUpdate(Request $request, $id) {
        $this->authorize('admin', Admin::class);

        $genre = Genre::findOrFail($id);

        if (!$request->has('genre'))
            return response(400);

        $genre->name = $request->get('genre');
        $genre->save();

        return back();
    }

    public function genreDelete(Request $request, $id) {
        $this->authorize('admin', Admin::class);

        $genre = Genre::findOrFail($id);
        $genre->delete();

        return back();
    }

    public function platformShow() {
        $data = Platform::all();

        return view('admin.pages.platform', ['data' => $data]);
    }

    public function platformAdd(Request $request) {
        if (!$request->has('platform'))
            response(400);

        $platform = new Platform;

        $platform->name = $request->get('platform');

        $platform->save();

        return back();
    }

    public function platformUpdate(Request $request, $id) {

        if (!$request->has('platform'))
            response(400);

        $platform = Platform::findOrFail($id);
        $platform->name = $request->get('platform');

        $platform->save();

        return back();
    }

    public function platformDelete(Request $request, $id) {
        $platform = Platform::findOrFail($id);

        try {
            $platform->delete();
        } catch (QueryException $ex) {
            return redirect('/admin');
        }

        return back();
    }

    public function userShow(AdminUserRequest $request) {
        $this->authorize('admin', Admin::class);

        if ($request->has('query')) {
            $query = implode(':* &', explode(' ', htmlentities($request->input('query'))));
            $users = User::whereRaw("name_tsvector @@ to_tsquery('" . $query . ":*')")->get();
        } else {
            $users = User::all();
        }

        $page = $request->has('page') ? $request->input('page') : 1;

        $users_paginated = $this->paginate($users, $page);
        $users_paginated->withPath('/admin/user');

        return view('admin.pages.users', [
            'title' => 'Users',
            'users' => $users_paginated->items(),
            'query' => ($request->has('query') ? $request->input('query') : ""),
            'links' => $users_paginated->links()
        ]);
    }

    public function userUpdate(AdminBanRequest $request, $id) {
        User::findOrFail($id);

        $this->authorize('admin', Admin::class);

        if ($request->input('ban') == "1") {
            if (BannedUser::find($id) === null) {
                BannedUser::create([
                    'id' => $id
                ])->save();
            }
        } else {
            BannedUser::destroy($id);
        }

        return back();
    }

    public function allReports() {
        $this->authorize('admin', Admin::class);

        $reports = Report::orderBy('date', 'DESC')->get();
        $reports_paginated = $this->paginate($reports, Input::input('page', 1));
        $reports_paginated->withPath('/admin/user');

        return view('admin.pages.reports', [
            'title' => 'Reports',
            'reports' => $reports_paginated->items(),
            'links' => $reports_paginated->links()
        ]);
    }

    public function reportUpdate($reportId, ReportUpdateRequest $request) {
        $this->authorize('admin', Admin::class);

        $report = Report::findOrFail($reportId);

        $report->status = $request->input('status') == '1';
        $report->save();

        return back();
    }

    public function reportShow($reportId) {

    }

    public function reportMessage($reportId) {

    }

    public function transactionShow() {
        $this->authorize('admin', Admin::class);

        $transactions = Order::paginate();

        return view('admin.pages.transactions', [
            'title' => 'Transactions',
            'transactions' => $transactions->items(),
            'links' => $transactions->links()
        ]);
    }

    public function feedbackShow() {
        $this->authorize('admin', Admin::class);

        $feedback = Feedback::paginate();

        return view('admin.pages.feedback', [
            'title' => 'Feedback',
            'feedback' => $feedback->items(),
            'links' => $feedback->links()
        ]);
    }

    public function feedbackDelete($feedbackId) {
        $this->authorize('admin', Admin::class);

        Feedback::destroy($feedbackId);

        return back();
    }

    public function faqShow() {
        $this->authorize('admin', Admin::class);

        $faq = FAQ::orderBy('id', 'ASC')->paginate();

        return view('admin.pages.faq', [
            'title' => 'FAQ',
            'faq' => $faq->items(),
            'links' => $faq->links()
        ]);
    }

    public function faqAdd(FAQRequest $request) {
        $this->authorize('admin', Admin::class);

        FAQ::create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer')
        ])->save();

        return back();
    }

    public function faqUpdate(FAQRequest $request, $faqId) {
        $this->authorize('admin', Admin::class);

        $faq = FAQ::findOrFail($faqId);

        $faq->question = $request->input('question');
        $faq->answer = $request->input('answer');
        $faq->save();

        return back();
    }

    public function faqDelete($faqId) {
        $this->authorize('admin', Admin::class);

        FAQ::destroy($faqId);

        return back();
    }

    public function __construct() {
        $this->middleware('auth:admin');

        View::share('nav', 'dashboard');
    }

    /**
     * Generates a pagination of the items of an array or collection
     *
     * @param array|Collection      $items
     * @param int  $page
     * @param int   $perPage
     * @param array $options
     *
     * @return LengthAwarePaginator
     */
    public function paginate($items, $page = null, $perPage = 10, $options = []) {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}