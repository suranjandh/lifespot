<style>
  .box-img-holder {
    width: 100%;
    height: auto;
    /* background-image: url("../img/impressiveSecurity.jpg"); */
    /* background-size: cover;
    background-repeat: no-repeat;
    background-position: 50% 50%; */
}
.text-holder {
  position: absolute;
  /* right: 2%; */
  left: 5%;
  top: 18%;
  max-width: 55%;
}


.img-text {
  font-weight: 500;
  font-size: 1.1rem;
  color: black;
  text-align: left;
  margin-top: -5px;
}
@media (max-width: 767px) {
  .text-holder {
    top: 0%;
    padding-bottom: 5px;
  }
  .img-text {
    font-weight: 400;
    font-size: .9rem;
  }
}
@media (max-width: 491px) {
  .img-text {
    font-size: .9rem;
    line-height: .9;
  }
  .text-holder {
    top: 0%;
    max-width: 55%;
  }
}
@media (max-width: 320px) {
  .img-text {
    font-size: .8rem;
    line-height: .8;
  }
  .text-holder {
    top: 0%;
    max-width: 65%;
  }
}

            
</style>
  <!--Card image-->
  <div class="view overlay hm-white-slight xbox-img-holder">
          <img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}security.jpg" class="img-fluid box-img-holder img-thumbnail" alt="">
              <a>
                  <div class="mask waves-light"></div>
              </a>

              <div class="carousel-caption text-holder">
              <div class="row">
                <div class="xcol-lg-6">
                <p class="img-text">LifeSpot offers you the unique opportunity to keep you most treasured information in a secure and most convenient manner. <br><br>
                It’s the most comprehensive platform allowing the ability to upload, store and share your documents without compromising privacy.  <a data-toggle="modal" data-target="#security-details"><u class="blue-text">More</u></a></p>
                </div>
                <!-- <div class="col-lg-6"></div> -->
              </div>
                
              </div>
              
        </div>
        <!--/.Card image-->

{{--
        @php include 'impressiveSecurity-inside.php'; @endphp--}}
@include('project.home.sections.impressiveSecurity-inside')