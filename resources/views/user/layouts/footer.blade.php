<!----------- Footer ------------>
<footer class="footer-bs footer">
      <div class="row">
            <div class="col-md-2 col-xs-12 footer-brand animated fadeInLeft">
                  <h2>Bydjfordjs</h2>
                  <p>Online promoters for Djs, get latest dj songs, podcast, videos, mixtapes.</p><br>
            </div>
            <div class="col-md-4  col-xs-12 footer-nav animated fadeInUp">
                  <h4>Links —</h4>
                  <div class="col-md-6 col-xs-6">
                        <ul class="pages">
                              <li><a href="{{ route('singles.index') }}">Singles</a></li>
                              <li><a href="{{ route('albums.index') }}">Albums</a></li>
                              <li><a href="{{ route('video.index') }}">Video</a></li>
                              <li><a href="{{ route('podcast.index') }}">Podcast</a></li>
                              <li><a href="{{ route('news.index') }}">News</a></li>
                        </ul>
                  </div>
                  <div class="col-md-6 col-xs-6">
                        <ul class="list">
                              <li><a href="{{ route('about') }}">About</a></li>
                              <li><a href="{{ route('contact.index') }}">Contact</a></li>
                              <li><a href="#">Terms & Condition</a></li>
                              <li><a href="#">Privacy Policy</a></li>
                        </ul>
                  </div>
            </div>
            <div class="col-md-2  col-xs-12 footer-social animated fadeInDown">
                  <h4>Follow Us</h4>
                  <ul>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">RSS</a></li>
                  </ul>
            </div>
            <div class="col-md-4 col-xs-12 footer-ns animated fadeInRight">
                  <h4>Subscribe to Newsletter</h4>

                  <div class="input-group">
                        {!! Form::open(['route' => 'subscribe']) !!}

                        <input class="form-control" placeholder="Enter your name .." type="text" name="name"/>

                        <input class="form-control" placeholder="Enter your email .." type="email" name="email"/>

                        {!! Form::submit('Subscribe', ['class' => 'btn btn-info']) !!}

                        {!! Form::close() !!}
                  </div><!-- /input-group -->
                  </p>
            </div>
      </div>
      <div class="row">
            <div class="col-md-12">
                  <p>© 2017 Bydjfordjs, All rights reserved</p>
            </div>
      </div>
</footer>

