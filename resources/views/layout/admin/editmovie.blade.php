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
                <li class="selected"><a href="../movie"><i class="fa fa-user" aria-hidden="true"></i> Movies</a>
                  <ul>
                    <li class="selected"><a href="../movie">Movie</a></li>
                    <li><a href="../new-movie">Add Movie</a></li>
                    <li><a href="../best-movie">Best Movies</a></li>
                    <li><a href="../coming-soon-movie">Coming Soon Movies</a></li>
                    <li><a href="request-movie">Request</a></li>
                  </ul>
                </li>

                @if( session('role') == 'super-administrator' )
                <li><a href="../user"><i class="fa fa-user" aria-hidden="true"></i> Users</a></li>
                <li><a href=""><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
                @endif
              </ul>
            </nav>
          </div>

          <div class="col-md-10 right-dashboard">
            <h2 class="title">EDIT MOVIE</h2>

            @if(session() -> has('msg'))
              {!! session('msg') !!}
            @endif

            <div id="edit-movie-imdb-form">
              <div class="form-group col-md-12">
                <label>Get Detail From IMDB, Set IMDB Link Here : </label>
                <input type="text" name="imdb-url" class="form-control imdb-link">
                <button type="button" class="btn btn-default btn-grab">Grab</button>
                <span class="loading-status"></span>
              </div>
            </div>

            <div class="movie-link-wrap">
              @if( isset($prev_movie) AND $prev_movie != '' )
                <span class="prev-box"><a href="{{ URL::to('/dev-admin/edit-movie/' . $prev_movie ) }}" class="btn-prev-movie"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous Movie</a></span>
              @endif

              <span class="add-box"><a href="../new-movie" class="btn-add-new-movie">Add New</a></span>
              <span class="preview-box"><a href="{{ URL::to('/film/' . $movie->slug_id) }}" target="_blank" class="btn-preview-movie">Preview</a></span>

              @if( isset($next_movie) AND $next_movie != '' )
                <span class="next-box"><a href="{{ URL::to('/dev-admin/edit-movie/' . $next_movie ) }}" class="btn-next-movie">Next Movie <i class="fa fa-arrow-right" aria-hidden="true"></i></a></span>
              @endif
            </div>

            <form id="edit-movie-form" action="../post-edit-movie/{{ $movie->id }}" method="POST" enctype="multipart/form-data">

              <div class="form-group col-md-12">
                <?php
                  if( $movie -> featured == 1  )
                    { ?>
                      <input type="checkbox" name="movie-check-featured" class="check-featured-input" value="true" checked="checked">
                      <div class="check-featured-box" style="background-image: url('http://dewabioskop21.com/resources/assets/img/check-icon.png');"></div>
                      <label for="movie-check-featured">Featured Movie</label>
                    <?php }
                  else
                    { ?>
                      <input type="checkbox" name="movie-check-featured" class="check-featured-input" value="false">
                      <div class="check-featured-box"></div>
                      <label for="movie-check-featured">Featured Movie</label>
                    <?php } ?>
                <br>
                <label>Title</label>
                <input type="text" name="movie-title" value="{{ $movie->title or old('movie-title') }}" class="form-control">
              </div>

              <div class="form-group col-md-3 rating-col">
                <label>Rating</label>
                <input type="text" name="movie-rating" value="{{ $movie->rating or old('movie-rating') }}" class="form-control">

                <label>Year</label>
                <input type="text" name="movie-year" value="{{ $movie->year or old('movie-year') }}" class="form-control">
              </div>        

              <?php 
                $category_arr = explode(',', $movie->category);
              ?>

              <div class="form-group col-md-9">
                <label>Category</label>
                <ul class="category-list">
                  <li class="cat-coming-soon"><input type="checkbox" name="movie-category[]" value="Coming Soon" <?php if(in_array('Coming Soon', $category_arr)) { echo "checked='true'"; } ?>>Coming Soon</li>
                  <li><input type="checkbox" name="movie-category[]" value="Action" <?php if(in_array('Action', $category_arr)) { echo "checked='true'"; } ?> >Action</li>
                  <li><input type="checkbox" name="movie-category[]" value="Adventure" <?php if(in_array('Adventure', $category_arr)) { echo "checked='true'"; } ?> >Adventure</li>
                  <li><input type="checkbox" name="movie-category[]" value="Animation"  <?php if(in_array('Animation', $category_arr)) { echo "checked='true'"; } ?> >Animation</li>
                  <li><input type="checkbox" name="movie-category[]" value="Biography"  <?php if(in_array('Biography', $category_arr)) { echo "checked='true'"; } ?> >Biography</li>
                  <li><input type="checkbox" name="movie-category[]" value="Comedy"  <?php if(in_array('Comedy', $category_arr)) { echo "checked='true'"; } ?> >Comedy</li>
                  <li><input type="checkbox" name="movie-category[]" value="Crime"  <?php if(in_array('Crime', $category_arr)) { echo "checked='true'"; } ?> >Crime</li>
                  <li><input type="checkbox" name="movie-category[]" value="Documentary"  <?php if(in_array('Documentary', $category_arr)) { echo "checked='true'"; } ?> >Documentary</li>
                  <li><input type="checkbox" name="movie-category[]" value="Drama"  <?php if(in_array('Drama', $category_arr)) { echo "checked='true'"; } ?> >Drama</li>
                  <li><input type="checkbox" name="movie-category[]" value="Family"  <?php if(in_array('Family', $category_arr)) { echo "checked='true'"; } ?> >Family</li>
                  <li><input type="checkbox" name="movie-category[]" value="Fantasy"  <?php if(in_array('Fantasy', $category_arr)) { echo "checked='true'"; } ?> >Fantasy</li>
                  <li><input type="checkbox" name="movie-category[]" value="Film-Noir"  <?php if(in_array('Film-Noir', $category_arr)) { echo "checked='true'"; } ?> >Film-Noir</li>
                  <li><input type="checkbox" name="movie-category[]" value="History"  <?php if(in_array('History', $category_arr)) { echo "checked='true'"; } ?> >History</li>
                  <li><input type="checkbox" name="movie-category[]" value="Horror"  <?php if(in_array('Horror', $category_arr)) { echo "checked='true'"; } ?> >Horror</li>
                  <li><input type="checkbox" name="movie-category[]" value="Music"  <?php if(in_array('Music', $category_arr)) { echo "checked='true'"; } ?> >Music</li>
                  <li><input type="checkbox" name="movie-category[]" value="Musical"  <?php if(in_array('Musical', $category_arr)) { echo "checked='true'"; } ?> >Musical</li>
                  <li><input type="checkbox" name="movie-category[]" value="Mystery"  <?php if(in_array('Mystery', $category_arr)) { echo "checked='true'"; } ?> >Mystery</li>
                  <li><input type="checkbox" name="movie-category[]" value="Romance"  <?php if(in_array('Romance', $category_arr)) { echo "checked='true'"; } ?> >Romance</li>
                  <li><input type="checkbox" name="movie-category[]" value="Sci-Fi"  <?php if(in_array('Sci-Fi', $category_arr)) { echo "checked='true'"; } ?> >Sci-Fi</li>
                  <li><input type="checkbox" name="movie-category[]" value="Sport"  <?php if(in_array('Sport', $category_arr)) { echo "checked='true'"; } ?> >Sport</li>
                  <li><input type="checkbox" name="movie-category[]" value="Thriller"  <?php if(in_array('Thriller', $category_arr)) { echo "checked='true'"; } ?> >Thriller</li>
                  <li><input type="checkbox" name="movie-category[]" value="War"  <?php if(in_array('War', $category_arr)) { echo "checked='true'"; } ?> >War</li>
                  <li><input type="checkbox" name="movie-category[]" value="Western"  <?php if(in_array('Western', $category_arr)) { echo "checked='true'"; } ?> >Western</li>
                </ul>
              </div>  

              <div class="form-group col-md-9">
                <label>Description</label>
                <textarea class="form-control" name="movie-desc">{{ $movie->description or old('movie-desc') }}</textarea>
                <br>
                <label>Release Data</label>
                <input type="text" name="movie-release-date" value="{{ $movie->release_date or old('movie-release-date') }}" class="form-control">
                <p class="example">Example : 1 January 2016 (Indonesia)</p>
                <br>
                <label>Country</label>
                <input type="text" name="movie-country" value="{{ $movie->country or old('movie-country') }}" class="form-control">
                <p class="example">Example : country1,country2,country3</p>
                <br>
                <label>Actor</label>
                <input type="text" name="movie-actor" value="{{ $movie->actor or old('movie-actor') }}" class="form-control">
                <p class="example">Example : actor1,actor2,actor3</p>
                <br>
                <label>Director</label>
                <input type="text" name="movie-director" value="{{ $movie->director or old('movie-director') }}" class="form-control">
                <p class="example">Example : director1,director2,director3</p>
                <br>
                <label>Movie Link 1 (Google Drive)</label>
                <input type="text" name="movie-link-gdrive" value="{{ $movie->gdrive_link or old('movie-link-gdrive') }}" class="form-control">
                <p class="example">Example : https://drive.google.com/open?id=id_file</p>
                <br>
                <label>Movie Link 2 (Google Photos)</label>
                <input type="text" name="movie-link-picasa" value="{{ $movie->photo_google_link or old('movie-link-picasa') }}" class="form-control">
                <p class="example">Example : https://photos.google.com/share/id_here/photo/id_here?key=id_here</p>
                <br>
                <label>Trailer Link (Youtube)</label>
                <input type="text" name="movie-link-trailer" value="{{ $movie->trailer_link or old('movie-link-trailer') }}" class="form-control">
                <p class="example">Example : http://youtube.com/embed/ID_TRAILER or https://www.youtube.com/watch?v=ID_TRAILER</p>
                <br>
                <label>Subtitle (Indo)</label>
                <input type="text" class="form-control" name="movie-subtitle" value="{{ $movie->subtitle_indo or old('movie-subtitle') }}">
                  <!-- <input type="hidden" name="movie-subtitle-indo-old" value="{{ $movie->subtitle_indo }}"> -->
                <!-- <input type="file" name="movie-subtitle-indo" accept=".srt,.vtt"> -->
              </div>

              <?php
                $featured_image = $movie->featured_image;
              ?>

              <div class="form-group col-md-3 featured-image-col">
                <label>Quality</label>
                <select name="movie-quality" class="form-control">
                  <option value="1080p" <?php if($movie->quality == '1080p') { echo "selected"; } ?> >1080p</option>
                  <option value="720p" <?php if($movie->quality == '720p') { echo "selected"; } ?> >720p</option>
                  <option value="360p" <?php if($movie->quality == '360p') { echo "selected"; } ?> >360p</option>
                  <option value="CAM" <?php if($movie->quality == 'cam' OR $movie->quality == 'CAM') { echo "selected"; } ?> >CAM</option>
                </select>
                <br>
                <label>Duration</label>
                <input type="text" name="movie-duration" value="{{ $movie->duration or old('movie-duration') }}" class="form-control">
                <br>
                <label>Featured Image</label>
                <div class="preview-featured-image">
                  @if ( $featured_image != '' )
                    <img id="prev-img" src="{{ 'http://s1.dewabioskop21.com/' . $movie->featured_image }}" style="display:block">
                  @else
                    <img id="prev-img" src="">
                  @endif
                </div>
                <button type="button" class="btn-add-image">Set Featured Image</button>
                <input type="file" id="featured-image-input" accept="image/*" name="movie-featured-image" value="">

                <input type="hidden" name="featured-image-input-hidden" value="{{ $movie->featured_image or '' }}">
              </div>  

              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group col-md-12">
                <button type="submit" class="btn btn-default">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  @stop
