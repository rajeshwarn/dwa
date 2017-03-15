@extends('indexadmin')

  @section('contentadmin')

    <section id="dashboard-admin-section">
      <div class="container-fluid">
        <div class="row admin-row">
          <div class="col-md-2 left-dashboard">

            <div class="admin-identity-wrap">
              <img src="{{ URL::to('resources/assets/img/default_profile.png') }}" class="admin-thumb" width="40px" height="40px">
              <h3 class="greet-welcome">Welcome back, <br> {{ session('user') }}</h3>
            </div>

            <nav id="admin-main-menu">
              <ul>
                <li class="selected"><a href="movie"><i class="fa fa-film" aria-hidden="true"></i> Movies</a>
                  <ul>
                    <li><a href="movie">Movie</a></li>
                    <li class="selected"><a href="new-movie">Add Movie</a></li>
                    <li><a href="best-movie">Best Movies</a></li>
                    <li><a href="coming-soon-movie">Coming Soon Movies</a></li>
                    <li><a href="request-movie">Request</a></li>
                    <li><a href="import">Import</a></li>
                  </ul>
                </li>

                @if( session('role') == 'super-administrator' )
                <li><a href="user"><i class="fa fa-user" aria-hidden="true"></i> Users</a></li>
                <li><a href="social-profiles"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
                @endif
              </ul>
            </nav>
          </div>

          <div class="col-md-10 right-dashboard">
            <h2 class="title">ADD NEW MOVIE</h2>

            @if(session() -> has('msg'))
              {!! session('msg') !!}
            @endif

            <form id="new-movie-imdb-form" action="post-new-movie/grab" method="POST">

              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group col-md-12">
                <label>Get Detail From IMDB, Set IMDB Link Here : </label>
                <input type="text" name="imdb-url" class="form-control imdb-link">
                <button type="button" class="btn btn-default btn-grab">Grab</button>
                <span class="loading-status"></span>
              </div>
            </form>

            <form id="new-movie-form" action="post-new-movie" method="POST" enctype="multipart/form-data">

              <div class="form-group col-md-12">
                <input type="checkbox" name="movie-check-featured" class="check-featured-input" value="false">
                <div class="check-featured-box"></div>
                <label for="movie-check-featured">Featured Movie</label>
                <br>
                <label>Title</label>
                <input type="text" name="movie-title" value="{{ old('movie-title') }}" class="form-control">
              </div>

              <div class="form-group col-md-3 rating-col">
                <label>Rating</label>
                <input type="text" name="movie-rating" value="{{ old('movie-rating') }}" class="form-control">

                <label>Year</label>
                <input type="text" name="movie-year" value="{{ old('movie-year') }}" class="form-control">
              </div>        

              <div class="form-group col-md-9">
                <label>Category</label>
                <ul class="category-list">
                <li class="cat-coming-soon"><input type="checkbox" name="movie-category[]" value="Coming Soon">Coming Soon</li>
                  <li><input type="checkbox" name="movie-category[]" value="Action">Action</li>
                  <li><input type="checkbox" name="movie-category[]" value="Adventure">Adventure</li>
                  <li><input type="checkbox" name="movie-category[]" value="Animation">Animation</li>
                  <li><input type="checkbox" name="movie-category[]" value="Biography">Biography</li>
                  <li><input type="checkbox" name="movie-category[]" value="Comedy">Comedy</li>
                  <li><input type="checkbox" name="movie-category[]" value="Crime">Crime</li>
                  <li><input type="checkbox" name="movie-category[]" value="Documentary">Documentary</li>
                  <li><input type="checkbox" name="movie-category[]" value="Drama">Drama</li>
                  <li><input type="checkbox" name="movie-category[]" value="Family">Family</li>
                  <li><input type="checkbox" name="movie-category[]" value="Fantasy">Fantasy</li>
                  <li><input type="checkbox" name="movie-category[]" value="Film-Noir">Film-Noir</li>
                  <li><input type="checkbox" name="movie-category[]" value="History">History</li>
                  <li><input type="checkbox" name="movie-category[]" value="Horror">Horror</li>
                  <li><input type="checkbox" name="movie-category[]" value="Music">Music</li>
                  <li><input type="checkbox" name="movie-category[]" value="Musical">Musical</li>
                  <li><input type="checkbox" name="movie-category[]" value="Mystery">Mystery</li>
                  <li><input type="checkbox" name="movie-category[]" value="Romance">Romance</li>
                  <li><input type="checkbox" name="movie-category[]" value="Sci-Fi">Sci-Fi</li>
                  <li><input type="checkbox" name="movie-category[]" value="Sport">Sport</li>
                  <li><input type="checkbox" name="movie-category[]" value="Thriller">Thriller</li>
                  <li><input type="checkbox" name="movie-category[]" value="War">War</li>
                  <li><input type="checkbox" name="movie-category[]" value="Western">Western</li>
                </ul>
              </div>  

              <div class="form-group col-md-9">
                <label>Description</label>
                <textarea class="form-control" name="movie-desc">{{ old('movie-desc') }}</textarea>
                <br>
                <label>Release Data</label>
                <input type="text" name="movie-release-date" value="{{ old('movie-release-date') }}" class="form-control">
                <p class="example">Example : 1 January 2016 (Indonesia)</p>
                <br>
                <label>Country</label>
                <input type="text" name="movie-country" value="{{ old('movie-country') }}" class="form-control">
                <p class="example">Example : country1,country2,country3</p>
                <br>
                <label>Actor</label>
                <input type="text" name="movie-actor" value="{{ old('movie-actor') }}" class="form-control">
                <p class="example">Example : actor1,actor2,actor3</p>
                <br>
                <label>Director</label>
                <input type="text" name="movie-director" value="{{ old('movie-director') }}" class="form-control">
                <p class="example">Example : director1,director2,director3</p>
                <br>
                <label>Movie Link 1 (Google Drive)</label>
                <input type="text" name="movie-link-gdrive" value="{{ old('movie-link-gdrive') }}" class="form-control">
                <p class="example">Example : https://drive.google.com/open?id=id_file</p>
                <br>
                <label>Movie Link 2 (Google Photos)</label>
                <input type="text" name="movie-link-picasa" value="{{ old('movie-link-picasa') }}" class="form-control">
                <p class="example">Example : https://photos.google.com/share/id_here/photo/id_here?key=id_here</p>
                <br>
                <label>Trailer Link (Youtube)</label>
                <input type="text" name="movie-link-trailer" value="{{ old('movie-link-trailer') }}" class="form-control">
                <p class="example">Example : http://youtube.com/embed/ID_TRAILER or https://www.youtube.com/watch?v=ID_TRAILER</p>
                <br>
                <label>Subtitle (Indo)</label>
                <input type="text" class="form-control" name="movie-subtitle">
                <!-- <input type="file" name="movie-subtitle-indo" accept=".srt,.vtt"> -->
              </div>

              <div class="form-group col-md-3 featured-image-col">
                <label>Quality</label>
                <select name="movie-quality" class="form-control">
                  <option value="1080p">1080p</option>
                  <option value="720p">720p</option>
                  <option value="360p">360p</option>
                  <option value="CAM">CAM</option>
                </select>
                <br>
                <label>Duration</label>
                <input type="text" name="movie-duration" class="form-control">
                <br>
                <label>Featured Image</label>
                <div class="preview-featured-image">
                  <img id="prev-img" src="">
                </div>
                <button type="button" class="btn-add-image">Set Featured Image</button>
                <input type="file" id="featured-image-input" accept="image/*" name="movie-featured-image" value="">

                <input type="hidden" name="featured-image-input-hidden" value="">
              </div>  

              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group col-md-12">
                <button type="submit" class="btn btn-default">Publish</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  @stop