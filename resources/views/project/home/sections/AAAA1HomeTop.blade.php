<style>
.welcomePic {
  background-image: url('{{Config::get('constants.PROJECT_IMAGE_URL')}}waterBkgrnd.jpg');
  border-radius: 0 !important;
}
  .mpeLoginForm {
    
    width: 30%;
    float:right;
    margin-right: 10%;
    padding: 0 20px 2px 20px;
    display: show;
    height: 530px;
  }
  .montserrat {
  font-family: 'Raleway', sans-serif;
  font-weight: 300;
}

/*Media Querie*/
@media only screen and (min-width: 1000px){
  .mpeLoginForm{
    width: 40%;
  }
}
@media only screen and (min-width: 1200px){
  .mpeLoginForm{
    width: 35%;
  }
}
@media only screen and (min-width: 1500px){
  .mpeLoginForm{
    width: 30%;
  }
}
@media only screen and (max-width: 999px){
  .mpeLoginForm{
    width: 50%;
  }
}
@media only screen and (max-width: 900px){
  .mpeLoginForm{
    width: 60%;
  }
}
@media only screen and (max-width: 800px){
  .mpeLoginForm{
    width: 80%;
  }
}
@media only screen and (max-width: 650px){
  .mpeLoginForm{
    width: 90%;
  }
}
@media only screen and (max-width: 550px){
  .mpeLoginForm{
    width: 100%;
  }
}
@media only screen and (max-width: 364px){
  .mpeLoginForm{
    width: 120%;
  }
}
.myScrolBtn {
  position: absolute;
  top: 480px;
  right: 47.5%;
  border: 1px solid white;

}
    .fa-chevron-down{
        color: white;
    }
</style>

            
<!--Section: Live preview-->
<section class="">

    <!--Form without header-->
    <div class="card card-image welcomePic mt-5 pt-3">


        <div class="container smooth-scroll">
          <section class="text-center">
            <a href="#scrollToWhatIsIt" class="btn btn-floating btn-large clear myScrolBtn">

              <i  class="fas fa-chevron-down fa-2x"></i>
              <!-- <i class="fas fa-chevron-down"></i> -->
            </a>
          </section>
        </div>
        <div class="text-white xrgba-stylish-light py-5 pr-2 pl-5  z-depth-4">
        <form class="mpeLoginForm">
           <div class="navLoggedOut">
             <!--Header-->
             <img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}lifespotLogo/mainLogo.png" class="img-fluid text-center" height="00px;" alt="">
              <!--Body-->
              <h4 class="montserrat text-center white-text pt-3 mt-3 ml-5"><strong>Access your estate</strong>
              <div class="row no-gutters text-center xpt-5 xmt-5">
                <div class="col-lg-12 col-md-12 text-center">
                  <p class="montserrat xbtnColor d-inline-block xml-4"><a href="{{route('register')}}" class="btn btn-md xbtn-rounded btn-outline-white">Register</a></p>
                  <p class="montserrat xbtnColor d-inline-block xml-4"><a href="{{route('login')}}" class="btn btn-md xbtn-rounded btn-outline-white">Log in</a></p>
                  <p class="montserrat xbtnColor d-inline-block xml-4"><a  class="btn btn-md xbtn-rounded btn-outline-white" data-toggle="modal" data-target="#modalYT">Play Video</a></p>
                </div>
              </div>
              </h4>
           </div>


            <!--Grid row-->

        </form>

</section>
<!--Section: Dark Form-->


<!-- Button trigger modal-->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalYT">Launch modal</button> -->

<!--Modal: modalYT-->
<div class="modal fade" id="modalYT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">

    <!--Content-->
    <div class="modal-content">

      <!--Body-->
      <div class="modal-body mb-0 p-0">

        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/TSDIstPsJsw" allowfullscreen></iframe>
              </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-around flex-column flex-md-row">
       {{-- @php
        include '../includes/logoNav.php'
        ;@endphp

          --}}
        @include('project.layouts.logoNav')
          Spread the word!
        <div>
        {{--@php
        include '../includes/socialMedia.php';
        @endphp--}}
        @include('project.layouts.socialMedia')
        </div>
        <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>



      </div>

    </div>
    <!--/.Content-->

  </div>
</div>
<!--Modal: modalYT-->


