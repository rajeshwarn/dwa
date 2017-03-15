<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


use App\Http\Requests;
use App\User;
use App\Movie;
use App\Options;
use App\RequestMov;
use Hash;
use Redirect;
use Validator;
use DB;
use Cookie;


class Admincontroller extends Controller
{
    public function index() {
    	return view('layout/admin/login');
    }

    public function dashboard() {
    	$title = "Dashboard Admin";

    	return view('layout/admin/dashboard') -> with('title', $title);
    }

    public function newuser() {

    	$title  = "Dashboard Admin - Admin List";

    	return view('layout/admin/newadmin') -> with('title', $title);
    }

    public function newmovie() {

    	$title  = "Dashboard Admin - Movie List";

    	return view('layout/admin/newmovie') -> with('title', $title);
    }

    public function allmovie() {
        
      $title  = "Dashboard Admin - Movie List";

      $total_item = count(Movie::all());

      if( isset($_GET['filter']) && isset($_GET['sort']) )
        {
          if( empty(trim($_GET['filter'])) OR empty(trim($_GET['sort'])) )
            {
              $movie = Movie::orderBy('id','desc') -> paginate(10);

              return view('layout/admin/movie') -> with(['movie' => $movie, 'total_item' => $total_item, 'title' => $title]);
            }
          else
            {
              $filter = $_GET['filter'];
              $sort = $_GET['sort'];

              $movie = Movie::orderBy($filter,$sort)->paginate(10);
              $movie->setPath('movie?filter=' . $filter . '&sort=' . $sort);

              return view('layout/admin/movie') -> with(['movie' => $movie, 'total_item' => $total_item, 'title' => $title]);
            }

        }
      else
        {
          if( isset($_GET['search']) && $_GET['search'] != null && $_GET['search'] != '' )
            {
              $search = trim($_GET['search']);

              $movie = Movie::where('title', 'LIKE', '%' . $search . '%') -> paginate(10);
              $count_mov = count($movie);

              if( $count_mov == 0 )
                {
                  $msg = "<div class='alert alert-danger'>No movie found. <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

                  return view('layout/admin/movie') -> with(['movie' => $movie, 'total_item' => $total_item, 'title' => $title, 'msg' => $msg]);
                }

              return view('layout/admin/movie') -> with(['movie' => $movie, 'total_item' => $total_item, 'title' => $title]);
            }
          else
            {
              $movie = Movie::orderBy('id','desc') -> paginate(10);

              return view('layout/admin/movie') -> with(['movie' => $movie, 'total_item' => $total_item, 'title' => $title]);
            }
        }

    }

    public function bestmovie() {

      $title  = "Dashboard Admin - Best Movie";

      $movie = Movie::where('category','NOT LIKE','%Best Movie%') -> get();
      $best_movie = Movie::where('category','LIKE','%Best Movie%') -> get();

      return view('layout/admin/bestmovie') -> with(['title' => $title, 'movie' => $movie, 'bestmovie' => $best_movie]);

    }

    public function comingsoon() {

      $title  = "Dashboard Admin - Coming Soon Movie";

      $movie = Movie::where('category','LIKE','%Coming Soon%') -> get();
      $comingsoonmovie = Movie::where('category','LIKE','%Coming Soon Selected%') -> get();

      return view('layout/admin/comingsoon') -> with(['title' => $title, 'movie' => $movie, 'comingsoonmovie' => $comingsoonmovie]);
    }

    public function allrequest() {

      $title = "Dashboard Admin - All Request Movie";

      $requestmov = RequestMov::orderBy('id','desc') -> paginate(20);

      return view('layout/admin/requestmovie') -> with(['title' => $title, 'requestmov' => $requestmov]);
    }  

    public function editmovie($id) {
      $title = "Edit Movie - Cinema";

      $movie = Movie::find($id);
      $count_all_movie = count(Movie::all());
      $movie_max_id = Movie::max('id');
      $movie_min_id = Movie::min('id');

      if( $id == $movie_max_id )
        {
          if( $count_all_movie != 0 OR $count_all_movie != 1 )
            {
              $prev_movie = Movie::where('id','<',$id) -> max('id');
              $next_movie = '';
            }
          else
            {
              $prev_movie = '';
            }
        }
      else if( $id == $movie_min_id )
        {
          if( $count_all_movie != 0 OR $count_all_movie != 1 )
            {
              $prev_movie = '';
              $next_movie = Movie::where('id','>',$id) -> min('id');
            }
          else
            {
              $next_movie = '';
            }
        }
      else
        {
          if( $count_all_movie != 0 OR $count_all_movie != 1 )
            {
              $prev_movie = Movie::where('id','<',$id) -> max('id');
              $next_movie = Movie::where('id','>',$id) -> min('id');
            }
          else
            {
              $prev_movie = '';
              $next_movie = '';
            }
        }

      return view('layout/admin/editmovie') -> with(['title' => $title, 'prev_movie' => $prev_movie, 'next_movie' => $next_movie , 'movie' => $movie]);
    }

    public function edituser($id) {

      $user = User::find($id);

      $title = "Edit User - " . $user -> name;

      return view('layout/admin/edituser') -> with(['title' => $title, 'user' => $user]);
    }

    public function storenewuser(Request $req) {

      $the_username = $req -> input('username');
      $the_email = $req -> input('user-email');
      $the_name = $req -> input('user-name');
      $the_password = Hash::make($req -> input('user-password'));
      $the_role = $req -> input('user-role');

      if( $req->input('username') == '' OR $req->input('user-password') == '' )
        {
          $msg = "<div class='alert alert-warning'>Username and password must be filled. <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

          return back() -> withInput() -> with('msg', $msg);
        }

      $check_username = count(User::where('username', $the_username)->get());

      if( $check_username != 0 )
        {
          $msg = "<div class='alert alert-danger'>That username was taken by other admin, please change your username. <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

          return back() -> withInput() -> with('msg', $msg);
        }

    	$user = new User();

    	$user -> username = $the_username;
    	$user -> email = $the_email;
    	$user -> name = $the_name;
    	$user -> password = $the_password;
      $user -> role = $the_role;

    	$user -> save();

      $msg = "<div class='alert alert-success'>User created <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

    	return Redirect::to('/dev-admin/edit-user/' . $user->id) -> with('msg', $msg);

    }

    public function updateuser(Request $req, $id) {

      $user = User::find($id);

      $the_email = $req -> input('user-email');
      $the_name = $req -> input('user-name');
      $the_role = $req -> input('user-role');

      $user -> email = $the_email;
      $user -> name = $the_name;

      if( $req -> input('user-password') != '' )
        {
          $the_password = Hash::make($req -> input('user-password'));
          $user -> password = $the_password;
        }

      $user -> role = $the_role;

      $user -> save();

      $msg = "<div class='alert alert-success'>User data updated <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

      return Redirect::to('/dev-admin/edit-user/' . $user->id) -> with('msg', $msg);

    }

    public function storenewmovie(Request $req) { 

      if( $req -> input('movie-category') == null )
        {
          $msg = "<div class='alert alert-warning'>Please check the category <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
          return back() -> withInput() -> with('msg', $msg);
        }

      $movie_check_featured = $req -> input('movie-check-featured');

      if( $movie_check_featured == 'true')
        {
          $the_featured_movie = 1;
          $max_featured_pos = DB::table('movie') -> max('featured_position');
          $the_featured_pos = $max_featured_pos + 1;
        }
      else
        {
          $the_featured_movie = 0;
          $the_featured_pos = 0;
        }

      $movie = new Movie();

      $the_title = trim($req -> input('movie-title'));
      $the_rating = $req -> input('movie-rating');
      $the_duration = $req -> input('movie-duration');
      $the_year = $req -> input('movie-year');
      $the_category = implode(',', $req -> input('movie-category'));
      $the_description = $req -> input('movie-desc');
      $the_release_date = $req -> input('movie-release-date');
      $the_country = $req -> input('movie-country');
      $the_actor = $req -> input('movie-actor');
      $the_director = $req -> input('movie-director');
      $the_gdrive_link = $req -> input('movie-link-gdrive');
      $the_photo_google_link = $req -> input('movie-link-picasa');
      $the_trailer_link = $req -> input('movie-link-trailer');
      $the_featured_image_grab = $req -> input('featured-image-input-hidden');
      $the_quality = $req -> input('movie-quality');
      $the_subtitle = $req -> input("movie-subtitle");

      $slug_title = str_replace('(', '', $the_title);
      $slug_title = str_replace(')', '', $slug_title);
      $slug_title = str_replace("'", '', $slug_title);
      $slug_title = str_replace(":", '', $slug_title);
      $slug_title = str_replace(".", ' ', $slug_title);
      $slug_title = str_replace("&", '', $slug_title);
      $slug_title = str_replace(",", '', $slug_title);
      $the_slug_id = str_replace(' ', '-', $slug_title);   

      $the_slug_explode = explode("-", $the_slug_id);

      foreach ($the_slug_explode as $key => $value) 
        {
          if( trim($value) == '' )
            {
              unset($the_slug_explode[$key]);
            }
        }

      $the_slug_id = implode("-", $the_slug_explode);

      $file = ['image' => $req -> file('movie-featured-image'), 'subtitle_indo' => $req -> file('movie-subtitle-indo')];
      $rules = ['image' => 'required|max:2000|mimes:jpeg,jpg,png,gif', 'subtitle_indo' => 'max:1000'];

      $dest_upload_subtitle = base_path() . "../resources/assets/other/subtitle";

      if( $req->file('movie-subtitle-indo') != null )
        {
          $subtitle_ext = $req -> file('movie-subtitle-indo') -> getClientOriginalExtension();
          $the_subtitle_indo = $req -> file('movie-subtitle-indo') -> getClientOriginalName();
        }
      else
        {
          $the_subtitle_indo = '';
        }

      $check = Validator::make($file, $rules);

      if( $check -> fails() )
        {
            if( $the_featured_image_grab == null OR $the_featured_image_grab == '' )
              {
                $geterror = $check -> errors() -> all();

                $msg = '';

                foreach ($geterror as $val) 
                  {
                      $msg = $msg . ' ' . $val;
                  }

                if( $req->file('movie-subtitle-indo') != null )
                  {
                    if( $subtitle_ext != 'srt' AND $subtitle_ext != 'vtt' )                
                      {
                        $msg = $msg . '<br>' . 'The Subtitle Indo must be a vtt or srt format';
                      }
                  }

                $msg = "<div class='alert alert-warning'>" . $msg . " <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

                return back() -> withInput() -> with('msg', $msg);
              }
            else
              {
                if( $req->file('movie-subtitle-indo') != null )
                  {
                    if( $subtitle_ext != 'srt' AND $subtitle_ext != 'vtt')                
                      {
                        $msg = $msg . '<br>' . 'The Subtitle Indo must be a vtt or srt format';
                        $msg = "<div class='alert alert-warning'>" . $msg . " <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

                        return back() -> withInput() -> with('msg', $msg);
                      }
                  } 
                                 
                if( $req->file('movie-subtitle-indo') != null )
                  {
                    $do = $req -> file('movie-subtitle-indo') -> move($dest_upload_subtitle, $the_subtitle_indo);
                  }

                $movie -> title = $the_title;
                $movie -> slug_id = $the_slug_id;
                $movie -> rating = $the_rating;
                $movie -> duration = $the_duration;
                $movie -> year = $the_year;
                $movie -> category = $the_category;
                $movie -> description = $the_description;
                $movie -> release_date = $the_release_date;
                $movie -> country = $the_country;
                $movie -> actor = $the_actor;
                $movie -> director = $the_director;
                $movie -> featured = $the_featured_movie;
                $movie -> featured_position = $the_featured_pos;
                $movie -> featured_image = $the_featured_image_grab;
                $movie -> quality = $the_quality;
                $movie -> gdrive_link = $the_gdrive_link;
                $movie -> photo_google_link = $the_photo_google_link;
                $movie -> trailer_link = $the_trailer_link;
                $movie -> subtitle_indo = $the_subtitle;

                $movie -> save();

                $msg = "<div class='alert alert-success'>Movie Published <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

                return Redirect::to('/dev-admin/edit-movie/' . $movie->id) -> with('msg', $msg);
              }
        }
      else
        {
            if( $req -> file('movie-featured-image') -> isValid() )
              {
                if( $req->file('movie-subtitle-indo') != null ) 
                  {
                    if( $subtitle_ext != 'srt' AND $subtitle_ext != 'vtt' )                
                      {
                        $msg = $msg . '<br>' . 'The Subtitle Indo must be a vtt or srt format';

                          $msg = "<div class='alert alert-warning'>" . $msg . " <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

                        return back() -> withInput() -> with('msg', $msg);
                      }
                  }
                else
                  {
                    $dest_upload = base_path() . "../s1";

                    $the_image_name = $req -> file('movie-featured-image') -> getClientOriginalName();

                    $do = $req -> file('movie-featured-image') -> move($dest_upload, $the_image_name);

                    if( $req->file('movie-subtitle-indo') != null )
                      {
                        $do2 = $req -> file('movie-subtitle-indo') -> move($dest_upload_subtitle, $the_subtitle_indo);
                      }

                    $movie -> title = $the_title;
                    $movie -> slug_id = $the_slug_id;
                    $movie -> rating = $the_rating;
                    $movie -> duration = $the_duration;
                    $movie -> year = $the_year;
                    $movie -> category = $the_category;
                    $movie -> description = $the_description;
                    $movie -> release_date = $the_release_date;
                    $movie -> country = $the_country;
                    $movie -> actor = $the_actor;
                    $movie -> director = $the_director;
                    $movie -> featured = $the_featured_movie;
                    $movie -> featured_position = $the_featured_pos;
                    $movie -> featured_image = $the_image_name;
                    $movie -> quality = $the_quality;
                    $movie -> gdrive_link = $the_gdrive_link;
                    $movie -> photo_google_link = $the_photo_google_link;
                    $movie -> trailer_link = $the_trailer_link;
                    $movie -> subtitle_indo = $the_subtitle;

                    $movie -> save();

                    $msg = "<div class='alert alert-success'>Movie Published <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

                    return Redirect::to('/dev-admin/edit-movie/' . $movie->id) -> with('msg', $msg);
                  }
              }
        }
    }

    public function updatemovie($id, Request $req) { 

      $movie_check_featured = $req -> input('movie-check-featured');

      if( $movie_check_featured == 'true')
        {
          $checkmovie = Movie::find($id);

          if( $checkmovie -> featured_position != '' OR $checkmovie -> featured_position != 0 )
            {
              $the_featured_movie = 1;
              $the_featured_pos = $checkmovie -> featured_position;
            }
          else
            {
              $the_featured_movie = 1;
              $max_featured_pos = DB::table('movie') -> max('featured_position');
              $the_featured_pos = $max_featured_pos + 1;
            }
        }
      else
        {
          $the_featured_movie = 0;
          $the_featured_pos = 0;
        }

      $movie = Movie::find($id);    

      $the_title = trim($req -> input('movie-title'));

      $slug_title = str_replace('(', '', $the_title);
      $slug_title = str_replace(')', '', $slug_title);
      $slug_title = str_replace("'", '', $slug_title);
      $slug_title = str_replace(":", '', $slug_title);
      $slug_title = str_replace(".", ' ', $slug_title);
      $slug_title = str_replace("&", '', $slug_title);
      $slug_title = str_replace(",", '', $slug_title);
      $the_slug_id = str_replace(' ', '-', $slug_title);    

      $the_slug_explode = explode("-", $the_slug_id);

      foreach ($the_slug_explode as $key => $value) 
        {
          if( trim($value) == '' )
            {
              unset($the_slug_explode[$key]);
            }
        }

      $the_slug_id = implode("-", $the_slug_explode);

      $the_featured_image_grab = $req -> input('featured-image-input-hidden');
      $the_subtitle = $req -> input('movie-subtitle');

      if( $req -> input('movie-subtitle-indo-old') != null )
        {
          $file = ['image' => $req -> file('movie-featured-image')];
          $rules = ['image' => 'required|max:2000|mimes:jpeg,jpg,png,gif'];

          $the_subtitle_indo = $req -> input('movie-subtitle-indo-old');
        }
      else
        {
          $file = ['image' => $req -> file('movie-featured-image'), 'subtitle_indo' => $req -> file('movie-subtitle-indo')];
          $rules = ['image' => 'required|max:2000|mimes:jpeg,jpg,png,gif', 'subtitle_indo' => 'max:1000'];

          $dest_upload_subtitle = base_path() . "/resources/assets/other/subtitle";

          if( $req->file('movie-subtitle-indo') != null )
            {
              $subtitle_ext = $req -> file('movie-subtitle-indo') -> getClientOriginalExtension();
              $the_subtitle_indo = $req -> file('movie-subtitle-indo') -> getClientOriginalName();
            }
          else
            {
              $the_subtitle_indo = ''; 
            }
        }

      $check = Validator::make($file, $rules);

      if( $check -> fails() )
        {   
            if( $the_featured_image_grab == null OR $the_featured_image_grab == '' )
              {
                $geterror = $check -> errors() -> all();

                $msg = '';

                foreach ($geterror as $val) 
                  {
                      $msg = $msg . $val;
                  }

                if( isset($subtitle_ext) )  
                  {
                    if( $subtitle_ext != 'srt' AND $subtitle_ext != 'vtt'  )
                      {
                        $msg = $msg . '<br>' . 'The Subtitle Indo must be a vtt or srt format';
                      }
                  }

                $msg = "<div class='alert alert-warning'>" . $msg . " <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

                return back() -> withInput() -> with('msg', $msg);
              }
            else
              {
                if( isset($subtitle_ext) )
                  {
                    if( $subtitle_ext != 'srt' AND $subtitle_ext != 'vtt' )
                      {
                        $msg = 'The Subtitle Indo must be a vtt or srt format';

                        $msg = "<div class='alert alert-warning'>" . $msg . " <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

                        return back() -> withInput() -> with('msg', $msg);
                      }
                    else
                      {
                        // $do2 = $req -> file('movie-subtitle-indo') -> move($dest_upload_subtitle, $the_subtitle_indo);

                        $movie -> title = $req -> input('movie-title');
                        $movie -> slug_id = $the_slug_id;
                        $movie -> rating = $req -> input('movie-rating');
                        $movie -> duration = $req -> input('movie-duration');
                        $movie -> year = $req -> input('movie-year');
                        $movie -> category = implode(',', $req -> input('movie-category'));
                        $movie -> description = $req -> input('movie-desc');
                        $movie -> release_date = $req -> input('movie-release-date');
                        $movie -> country = $req -> input('movie-country');
                        $movie -> actor = $req -> input('movie-actor');
                        $movie -> director = $req -> input('movie-director');
                        $movie -> featured = $the_featured_movie;
                        $movie -> featured_position = $the_featured_pos;
                        $movie -> featured_image = $the_featured_image_grab;
                        $movie -> quality = $req -> input('movie-quality');
                        $movie -> gdrive_link = $req -> input('movie-link-gdrive');
                        $movie -> photo_google_link = $req -> input('movie-link-picasa');
                        $movie -> trailer_link = $req -> input('movie-link-trailer');
                        $movie -> subtitle_indo = $the_subtitle;

                        $movie -> save();

                        $msg = "<div class='alert alert-success'>Movie updated <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

                        return Redirect::to('/dev-admin/edit-movie/' . $id) -> with('msg', $msg);
                      }
                  }
                else
                  {
                    $movie -> title = $req -> input('movie-title');
                    $movie -> slug_id = $the_slug_id;
                    $movie -> rating = $req -> input('movie-rating');
                    $movie -> duration = $req -> input('movie-duration');
                    $movie -> year = $req -> input('movie-year');
                    $movie -> category = implode(',', $req -> input('movie-category'));
                    $movie -> description = $req -> input('movie-desc');
                    $movie -> release_date = $req -> input('movie-release-date');
                    $movie -> country = $req -> input('movie-country');
                    $movie -> actor = $req -> input('movie-actor');
                    $movie -> director = $req -> input('movie-director');
                    $movie -> featured = $the_featured_movie;
                    $movie -> featured_position = $the_featured_pos;
                    $movie -> featured_image = $the_featured_image_grab;
                    $movie -> quality = $req -> input('movie-quality');
                    $movie -> gdrive_link = $req -> input('movie-link-gdrive');
                    $movie -> photo_google_link = $req -> input('movie-link-picasa');
                    $movie -> trailer_link = $req -> input('movie-link-trailer');
                    $movie -> subtitle_indo = $the_subtitle;

                    $movie -> save();

                    $msg = "<div class='alert alert-success'>Movie updated <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

                    return Redirect::to('/dev-admin/edit-movie/' . $id) -> with('msg', $msg);
                  }
              }
        }
      else
        {
          if( isset($subtitle_ext) )
            {
              if( $subtitle_ext != 'srt' AND $subtitle_ext != 'vtt' )
                {
                  $msg = 'The Subtitle Indo must be a vtt or srt format';

                  $msg = "<div class='alert alert-warning'>" . $msg . " <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

                  return back() -> withInput() -> with('msg', $msg);
                }
              else
                {
                  if( $req -> file('movie-featured-image') -> isValid() )
                    {
                      $dest_upload = base_path() . "../s1";

                      $the_image_name = $req -> file('movie-featured-image') -> getClientOriginalName();

                      $do = $req -> file('movie-featured-image') -> move($dest_upload, $the_image_name);
                      $do2 = $req -> file('movie-subtitle-indo') -> move($dest_upload_subtitle, $the_subtitle_indo);

                      $movie -> title = $req -> input('movie-title');
                      $movie -> slug_id = $the_slug_id;
                      $movie -> rating = $req -> input('movie-rating');
                      $movie -> duration = $req -> input('movie-duration');
                      $movie -> year = $req -> input('movie-year');
                      $movie -> category = implode(',', $req -> input('movie-category'));
                      $movie -> description = $req -> input('movie-desc');
                      $movie -> release_date = $req -> input('movie-release-date');
                      $movie -> country = $req -> input('movie-country');
                      $movie -> actor = $req -> input('movie-actor');
                      $movie -> director = $req -> input('movie-director');
                      $movie -> featured = $the_featured_movie;
                      $movie -> featured_position = $the_featured_pos;
                      $movie -> featured_image = $the_image_name;
                      $movie -> quality = $req -> input('movie-quality');
                      $movie -> gdrive_link = $req -> input('movie-link-gdrive');
                      $movie -> photo_google_link = $req -> input('movie-link-picasa');
                      $movie -> trailer_link = $req -> input('movie-link-trailer');
                      $movie -> subtitle_indo = $the_subtitle;

                      $movie -> save();

                      $msg = "<div class='alert alert-success'>Movie Updated <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

                      return Redirect::to('/dev-admin/edit-movie/' . $id) -> with('msg', $msg);
                    }
                }
            }
          else
            {
              if( $req -> file('movie-featured-image') -> isValid() )
              {
                $dest_upload = base_path() . "../s1";

                $the_image_name = $req -> file('movie-featured-image') -> getClientOriginalName();

                $do = $req -> file('movie-featured-image') -> move($dest_upload, $the_image_name);

                $movie -> title = $req -> input('movie-title');
                $movie -> slug_id = $the_slug_id;
                $movie -> rating = $req -> input('movie-rating');
                $movie -> duration = $req -> input('movie-duration');
                $movie -> year = $req -> input('movie-year');
                $movie -> category = implode(',', $req -> input('movie-category'));
                $movie -> description = $req -> input('movie-desc');
                $movie -> release_date = $req -> input('movie-release-date');
                $movie -> country = $req -> input('movie-country');
                $movie -> actor = $req -> input('movie-actor');
                $movie -> director = $req -> input('movie-director');
                $movie -> featured = $the_featured_movie;
                $movie -> featured_position = $the_featured_pos;
                $movie -> featured_image = $the_image_name;
                $movie -> quality = $req -> input('movie-quality');
                $movie -> gdrive_link = $req -> input('movie-link-gdrive');
                $movie -> photo_google_link = $req -> input('movie-link-picasa');
                $movie -> trailer_link = $req -> input('movie-link-trailer');
                $movie -> subtitle_indo = $the_subtitle;

                $movie -> save();

                $msg = "<div class='alert alert-success'>Movie Updated <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

                return Redirect::to('/dev-admin/edit-movie/' . $id) -> with('msg', $msg);
              }
            }
        }
    }

    public function storebestmovie(Request $req, $id) {

      $movie = Movie::find($id);

      $old_cat = explode(',', $movie->category);
      array_push($old_cat, 'Best Movie');

      $new_cat = implode(',', $old_cat);

      $movie -> category = $new_cat;

      $movie -> save();

      $data = [ 'cat' => $new_cat ];

      return response() -> json($data);
    }

    public function storecomingsoonmovie(Request $req, $id) {

      $movie = Movie::find($id);

      $old_cat = explode(',', $movie->category);
      array_push($old_cat, 'Coming Soon Selected');

      $new_cat = implode(',', $old_cat);

      $movie -> category = $new_cat;

      $movie -> save();

      $data = [ 'cat' => $new_cat ];

      return response() -> json($data);

    }

    public function bulkmovie(Request $req) {
      $bulk_option = $req -> input('bulk-action');

      if( $bulk_option == '' OR $bulk_option == null )
        {
          return Redirect::to('/dev-admin/movie');
        }
      else if( $bulk_option == 'Delete Checked Item' )
        {
          $id_mov_arr = $req -> input('checkmovie');
          $count_mov = count($id_mov_arr);

          Movie::destroy($id_mov_arr);

          $msg = "<div class='alert alert-success'>" . $count_mov . " movie deleted <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

          return Redirect::to('/dev-admin/movie') -> with('msg', $msg);
        }
    }

    public function bulkuser(Request $req) {
      $bulk_option = $req -> input('bulk-action');

      if( $bulk_option == '' OR $bulk_option == null )
        {
          return Redirect::to('/dev-admin/user');
        }
      else if( $bulk_option == 'Delete Checked Item' )
        {
          $id_mov_arr = $req -> input('checkuser');
          $count_mov = count($id_mov_arr);

          User::destroy($id_mov_arr);

          $msg = "<div class='alert alert-success'>" . $count_mov . " user deleted <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

          return Redirect::to('/dev-admin/user') -> with('msg', $msg);
        }
    }

    public function alluser() {
      $title  = "Dashboard Admin - User List";

      $user = User::orderBy('id','desc') -> paginate(10);
      
      return view('layout/admin/user') -> with(['title' => $title, 'user' => $user]);
    }

    public function settingsocial() {

      $title  = "Social Profile Setting";
      $social_fb = Options::where('item','facebook') -> first();
      $social_twitter = Options::where('item','twitter') -> first();

      $data = ['title' => $title, 'social_fb' => $social_fb, 'social_twitter' => $social_twitter];

      return view('layout/admin/social_profile_setting') -> with($data);
    }

    public function updatesocial(Request $req) {

      $title  = "Social Profile Setting";
      $the_facebook = $req -> input('facebook-profile');
      $the_twitter = $req -> input('twitter-profile');

      $social_arr = ['facebook' => $the_facebook, 'twitter' => $the_twitter];

      foreach ($social_arr as $item => $value) 
        {
          $get_social = Options::where('item',$item) -> first();
          $check_item = count($get_social);
      
          if( $check_item == 0 )
            {
              $social = new Options();

              $social -> item = $item;
              $social -> value = $value;

              $social -> save();
            }
          else
            {
              $get_social -> value = $value;
              
              $get_social -> save();
            }
        }

        $msg = "<div class='alert alert-success'>Social Profiles updated <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

        $data = ['title' => $title, 'msg' => $msg ];

        return Redirect::to('/dev-admin/social-profiles') -> with($data);
    }

    public function openrequestmovie($id) {
      $requestmov = RequestMov::find($id);

      $requestmov -> status = 'viewed';

      $requestmov -> save();
    }

    public function markrequestmovie($id) {
      $requestmov = RequestMov::find($id);

      $requestmov -> status = 'viewed';

      $requestmov -> save();

      $msg = "<div class='alert alert-success'>Request Marked <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

      return Redirect::to('/dev-admin/request-movie') -> with('msg', $msg);
    }

    public function importmovie() {
    	$title  = "Import movie data";
    	return view("layout/admin/import") -> with('title', $title);
    }

    public function storeImportMovieData(Request $req) {
    	$fileCsv = $req -> file('import-movie-file');    	 

    	$tmpFile = $fileCsv->getPathName();

    	$fopen =  fopen($tmpFile, "r");
    		while( ($fetchCsv = fgetcsv($fopen, 1000, ",")) !== FALSE ) {

				$slug_title = str_replace('(', '', $fetchCsv[0]);
				$slug_title = str_replace(')', '', $slug_title);
				$slug_title = str_replace("'", '', $slug_title);
				$slug_title = str_replace(":", '', $slug_title);
				$slug_title = str_replace(".", ' ', $slug_title);
				$slug_title = str_replace("&", '', $slug_title);
				$slug_title = str_replace(",", '', $slug_title);
				$slug_title = str_replace("`", '', $slug_title);
				$slug_title = str_replace("?", '', $slug_title);
        $slug_title = preg_replace('/[^A-Za-z0-9-]+/', "", $slug_title);
				$the_slug_id = str_replace(' ', '-', $slug_title);   

				$the_slug_explode = explode("-", $the_slug_id);

				foreach ($the_slug_explode as $key => $value) {
					if( trim($value) == '' ) {
					  unset($the_slug_explode[$key]);
					}
				}

    			$data = array(
    				"slugID" => strtolower($the_slug_id),
    				"title" => htmlentities($fetchCsv[0], ENT_QUOTES),
    				"rating" => $fetchCsv[1],
    				"duration" => $fetchCsv[2],
    				"year" => $fetchCsv[3],
    				"category" => str_replace(" ", "", $fetchCsv[4]),
    				"description" => $fetchCsv[5],
    				"releaseDate" => $fetchCsv[6],
    				"country" => $fetchCsv[7],
    				"actor" => $fetchCsv[8],
    				"director" => $fetchCsv[9],
    				"thumbnail" => $fetchCsv[10],
    				"quality" => $fetchCsv[11],
    				"linkGdrive" => $fetchCsv[12],
    				"youtubeTrailer" => $fetchCsv[13],
    				"linkSubtitle" => $fetchCsv[14]
    			);

				  $checkMovie = Movie::where("slug_id", $data['slugID']) -> get() -> count();

  				if( $checkMovie == 0 ) {
  					$movie = new Movie();
  	    			$movie -> title = $data['title'];
  	                $movie -> slug_id = $data['slugID'];
  	                $movie -> rating = $data['rating'];
  	                $movie -> duration = $data['duration'];
  	                $movie -> year = $data['year'];
  	                $movie -> category = $data['category'];
  	                $movie -> description = $data['description'];
  	                $movie -> release_date = $data['releaseDate'];
  	                $movie -> country = $data['country'];
  	                $movie -> actor = $data['actor'];
  	                $movie -> director = $data['director'];
  	                $movie -> featured = 0;
  	                $movie -> featured_position = 0;
  	                $movie -> featured_image = $data['thumbnail'];
  	                $movie -> quality = $data['quality'];
  	                $movie -> gdrive_link = $data['linkGdrive'];
  	                $movie -> photo_google_link = "";
  	                $movie -> trailer_link = $data['youtubeTrailer'];
  	                $movie -> subtitle_indo = $data['linkSubtitle'];
  	                $movie->save();
  				}
    		}

    	fclose($fopen);

    	return redirect("dev-admin/import") -> with("msg","<div class='alert alert-success'>Success import.</div>");
    }


    public function destroy($id) {
      Movie::destroy($id);

      $msg = "<div class='alert alert-success'>1 movie deleted <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

      return Redirect::to('/dev-admin/movie') -> with('msg', $msg);
    }

    public function destroyuser($id) {

      User::destroy($id);

      $msg = "<div class='alert alert-success'>1 User Deleted <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

      return Redirect::to('/dev-admin/user') -> with('msg', $msg); 

    }

    public function destroybestmovie($id) {
      $movie = Movie::find($id);

      $old_cat = explode(',', $movie->category);
      $key = array_search('Best Movie', $old_cat);
      array_splice($old_cat, $key, 1);

      $new_cat = implode(',', $old_cat);
      $movie -> category = $new_cat;

      $movie->save();

      return Redirect::to('/dev-admin/best-movie');
    }

    public function destroycomingsoonmovie($id) {
      $movie = Movie::find($id);

      $old_cat = explode(',', $movie->category);
      $key = array_search('Coming Soon Selected', $old_cat);
      array_splice($old_cat, $key, 1);

      $new_cat = implode(',', $old_cat);
      $movie -> category = $new_cat;

      $movie->save();

      return Redirect::to('/dev-admin/coming-soon-movie');
    }

    public function destroyrequestmovie($id) {

      RequestMov::destroy($id);

      $msg = "<div class='alert alert-success'>1 Request Movie Deleted <span class='btn-close-alert'><i class='fa fa-times' aria-hidden='true'></i></span></div>";

      return Redirect::to('/dev-admin/request-movie') -> with('msg', $msg); 
    }

    public function curl($url) {
      $ch = @curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      $head[] = "Connection: keep-alive";
      $head[] = "Keep-Alive: 300";
      $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
      $head[] = "Accept-Language: en-us,en;q=0.5";
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
      curl_setopt($ch, CURLOPT_ENCODING, '');
      curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($ch, CURLOPT_TIMEOUT, 60);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Expect:'
      ));
      $page = curl_exec($ch);
      curl_close($ch);
      return $page;
    }
}
