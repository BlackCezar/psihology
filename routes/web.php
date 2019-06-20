<?php

use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    $news = DB::table('pages')->paginate(10);
	return view('main', ['pages' => $news]);
});
Route::get('/questions', function () {
	$questions = DB::table('questions')->get();
    return view('question', ['questions' => $questions]);
});

Route::get('/reviews', function () {
	$reviews = DB::table('reviews')->get();
    return view('reviews', ['reviews' => $reviews]);
});
Route::get('/contact', function () {
	$reviews = DB::table('reviews')->get();
    return view('contact', ['reviews' => $reviews]);
});
Route::get('/page', function () {
	$page = DB::table('pages')->where('id', '=', $_GET['id'])->get();
	 return view('content', ['page' => $page[0]]);
});
Route::get('/admin/reviews/changeStatus', function() {
	if ($_GET['status'] == 'true') $_GET['status'] = 1;
	if ($_GET['status'] == 'false') $_GET['status'] = 0;	
	$array = array(
		'status' => $_GET['status']
	);
	$result = DB::table('reviews')->where('id', '=', $_GET['id'])->update($array);
	return $result;
});

Route::post('/admin/question/save', function() {
	$input = Request::all();
	$result = DB::table('questions')->where('id', '=', $input['id'])->update(array('ask' => $input['ask']));
});

Route::get('/admin/questions/changeStatus', function() {
	if ($_GET['status'] == 'true') $_GET['status'] = 1;
	if ($_GET['status'] == 'false') $_GET['status'] = 0;	
	$array = array(
		'status' => $_GET['status']
	);
	$result = DB::table('questions')->where('id', '=', $_GET['id'])->update($array);
	return $result;
});

Route::get('/about', function () {
	 return view('about');
});

Route::get('/news', function() {
	$news = DB::select('select * from `news`', [1]);
    return view('news', ['news' => $news]);
});

Route::get('/news/{id}', function($id) {
	$news = DB::table('news')->where('id', '=', $id)->get();
    return view('content', ['page' => $news[0]]);
});

Route::get('/admin', function() {
	if (Auth::check()) {
		return view('admin');
	} else return redirect('/login');
});
Route::get('/admin/questions', function() {
	if (Auth::check()) {
		$questions = DB::table('questions')->get();
		return json_encode($questions);
	} else return redirect('/login');
});
Route::get('/admin/pages', function() {
	if (Auth::check()) {
		$pages = DB::table('pages')->get();
		return json_encode($pages);
	} else return redirect('/login');	
});
Route::get('/admin/reviews', function() {
	if (Auth::check()) {
		$reviews = DB::table('reviews')->get();
		return json_encode($reviews);
	} else return redirect('/login');
});

// POSTSunc
Route::post('/admin/pages/add', function() {
	$input = Request::all();
	if ($input['status'] == 'true') $status = 1;
	if ($input['status'] == 'true') $status = 0;
	if (empty($input['img'])) $input['img'] = "";
	$array = array(
	'title' => $input['title'],
	'content' => $input['content'],
	'rubric' => $input['rubric'],
	'status' => $status,
	'img' => $input['img'],
	'id' =>  null
	);
	$id = DB::table('pages')->insertGetId($array);
	$input['id'] = $id;
	return json_encode($input);
});

Route::post('/admin/pages', function() {
	$input = Request::all();
	$array = array(
	'title' => $input['title'],
	'body' => $input['body']
	);
	$pages = DB::table('pages')->where('id',$input['id'])->update($array);
	return $pages;
});
Route::post('/admin/reviews/remove', function() {
	$input = Request::all();
	$result = DB::table('pages')->where('id', '=',$input['id'])->delete();
	return $result;
});
Route::post('/admin/pages/remove', function(Request $request) {
	$input = Request::all();
	$result = DB::table('pages')->where('id', '=',$input['id'])->delete();
	return $result;
});
Route::post('/admin/questions/remove', function(Request $request) {
	$input = Request::all();
	$result = DB::table('pages')->where('id', '=',$input['id'])->delete();
	return $result;
});
Route::post('/admin/reviews/add', function() {
	$input = Request::all();
	if (empty('subject')) $input['subject'] = "";
	$array = array(
	'name' => $input['name'],
	'email' => $input['email'],
	'subject' => $input['subject'],
	'msg' => $input['msg'],
	'id' => NULL
	);
	$id = DB::table('reviews')->insertGetId($array);
	$input['id'] = $id;
	return json_encode($input);
});

Route::post('/admin/questions/add', function() {
	$input = Request::all();
	if (empty('subject')) $input['subject'] = "";
	$array = array(
	'name' => $input['name'],
	'email' => $input['email'],
	'subject' => $input['subject'],
	'question' => $input['question'],
	'ask' => "",
	'id' => NULL
	);
	$id = DB::table('questions')->insertGetId($array);
	$input['id'] = $id;
	return json_encode($input);
});

Route::post('/admin/news', function() {
	$input = Request::all();
	$array = array(
	'title' => $input['title'],
	'body' => $input['body']
	);
	$pages = DB::table('news')->where('id',$input['id'])->update($array);
	return $pages;
});
Route::post('/admin/news/remove', function(Request $request) {
	$input = Request::all();
	$result = DB::table('news')->where('id', '=',$input['id'])->delete();
	return $result;
});

Auth::routes();
Route::get('/reg', function() {
	return view('admin/reg');
});
Route::get('/auth', function() {
	return view('admin/login');
});
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
