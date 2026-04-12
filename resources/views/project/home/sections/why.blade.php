<style>
.img-container {
    width: 100%;
    height: 300px;
    /* background-image: url("../img/impressiveSecurity.jpg"); */
    /* background-size: cover;
    background-repeat: no-repeat;
    background-position: 50% 50%; */
}

.btnPosition {
    border-radius:10px;
    /* position: absolute; */
    /* left: 50%;
    bottom: 0; */
    margin: 0 auto;
}

.impressiveBlack-text{color: #7D8092;}

.panelBox{
  /* font-family: Roboto,sans-serif; */
  /* margin: 5px 0px 0 0px; */
  border: 1px solid rgba(174, 174, 174,0.4);
  border-radius: 2px;
  padding: 8px;
  font-weight: 300;
  color: black;
}

.panelFontStyle {
  /* font-family: Roboto,sans-serif; */
  font-weight: 300;
  color: black;
  /* color: rgb(174, 174, 174); */
}
/* 
Code help for toggle + & - https://stackoverflow.com/questions/34625699/jquery-spin-plus-to-minus-font-awesome-icon-on-accordion-section-click 
*/

.accordion-toggle {
  position: relative;
}
.accordion-toggle::before,
.accordion-toggle::after {
  content: '';
  display: block;
  position: absolute;
  top: 50%;
  right: 15px;
  width: 8px;
  height: 1px;
  margin-top: -2px;
  background-color: #000;
  -webkit-transform-origin: 50% 50%;
  -ms-transform-origin: 50% 50%;
  transform-origin: 50% 50%;
  -webkit-transition: all 0.25s;
  transition: all 0.25s;
}
.accordion-toggle::before {
  -webkit-transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  transform: rotate(-90deg);
  opacity: 0;
}
.accordion-toggle.collapsed::before {
  -webkit-transform: rotate(0deg);
  -ms-transform: rotate(0deg);
  transform: rotate(0deg);
  opacity: 1;
}
.accordion-toggle.collapsed::after {
  -webkit-transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  transform: rotate(-90deg);
}

/* font-colors rgb(57, 58, 58) */
.box-holder {
  position: absolute;
  right: 2%;
  left: 2%;
}

.box-img-holder {
  display: flex;
  flex-direction: column;
}

.text-in-box-img-holder {
  padding: 60px 0;
  font-size: 2.2rem;
  font-weight: 800;
}

.why-you-love-hidden-text {
  color: grey;
  padding: 5px 20px;
}


</style>
<!-- <script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.js"></script>
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
<!-- <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> -->

   <!-- <link href="../../css/bootstrap.min.css" rel="stylesheet"> -->

<!--Section: Additional features-->
<section id="additional-features">
  <div class="row">

    <!--First columnn: PROTECT LEGACY-->
    <div class="col-lg-6 col-sm-12 mb-3">
      <div class="card img-thumbnail pb-1">
        <!--Card image-->
        <div class="view overlay hm-white-slight box-img-holder">
          <img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}protectLegacy.jpg" class="img-fluid img-container img-thumbnail" alt="">
              <a>
                  <div class="mask waves-light"></div>
              </a>

              <div class="carousel-caption box-holder">
                <p class="text-in-box-img-holder black-text"><a><span class="white-text">Protect Your</span> <i class="fab fa-youtube"></i> <span class="black-text">Investments</span></a></p>
              </div>
              
        </div>
        <!--/.Card image-->
        <div class="panel-group" id="accordion-legacy" data-multi-expand="false">

          <div class="text-center"><a href="{{route('register')}}" class="btn btn-purple my-2 py-2 btnPosition" style="visibility:xhidden;"><span class="white-text">Start Now</span></a></div>

          <div class="panel panel-default panelBox">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed d-flex justify-content-between" data-toggle="collapse" href="#collapseOne-legacy">
                  <div class="d-flex justify-content-start">
                    <i class="fa fa-check black-text mx-2"></i>
                    <small class="panelFontStyle"> It’s Private</small>
                  </div>
                </a>
              </h5>
            </div>
            <div id="collapseOne-legacy" class="panel-collapse collapse" data-parent="#accordion-legacy">
              <div class="panel-body">
                <p class="why-you-love-hidden-text text-left">Grant members private access with a quick invitation and control their role and view at a moments notice if you need to make a change.
                </p>
              </div>
            </div>
            
          </div>
          <div class="panel panel-default panelBox">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed d-flex justify-content-between" data-toggle="collapse" href="#collapseTwo-legacy">
                  <div class="d-flex justify-content-start">
                    <i class="fa fa-check black-text mx-2"></i>
                    <small class="panelFontStyle"> Easy Accessibility</small>
                  </div>
                </a>
              </h5>
            </div>
            <div id="collapseTwo-legacy" class="panel-collapse collapse" data-parent="#accordion-legacy" >
              <div class="panel-body">
                <p class="why-you-love-hidden-text text-left">
                Access and amend on the fly with your iOS and Android mobile devices.
                Sharing and Planning ~ Organize and include your family and estate holders. Choose and edit what member sees of your selected information. Keep assets and most important treasures out of probate.
                </p>
              </div>
            </div>
          </div>
          <div class="panel panel-default panelBox">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed d-flex justify-content-between" data-toggle="collapse" href="#collapseThree-legacy">
                  <div class="d-flex justify-content-start">
                    <i class="fa fa-check black-text mx-2"></i>
                    <small class="panelFontStyle"> Sharing and Planning</small>
                  </div>
                </a>
              </h5>
            </div>
            <div id="collapseThree-legacy" class="panel-collapse collapse" data-parent="#accordion-legacy">
              <div class="panel-body">
                <p class="why-you-love-hidden-text text-left">
                Organize and include your family and estate holders. Choose and edit what member sees of your selected information. Keep assets and most important treasures out of probate.
                </p>
              </div>
            </div>
          </div>
          <div class="panel panel-default panelBox">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed d-flex justify-content-between" data-toggle="collapse" href="#collapseFour-legacy">
                  <div class="d-flex justify-content-start">
                    <i class="fa fa-check black-text mx-2"></i>
                    <small class="panelFontStyle"> Storage</small>
                  </div>
                </a>
              </h5>
            </div>
            <div id="collapseFour-legacy" class="panel-collapse collapse" data-parent="#accordion-legacy" >
              <div class="panel-body">
                <p class="why-you-love-hidden-text text-left">
                Secure storage for important Living Trust files and estate documents. All information is encrypted and securely stored in a vault that allows user to control and what member sees information and when.
                </p>
              </div>
            </div>
          </div>
          <div class="panel panel-default panelBox">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed d-flex justify-content-between" data-toggle="collapse"  href="#collapseFive-legacy">
                  <div class="d-flex justify-content-start">
                    <i class="fa fa-check black-text mx-2"></i>
                    <small class="panelFontStyle"> Business</small>
                  </div>
                </a>
              </h5>
            </div>
            <div id="collapseFive-legacy" class="panel-collapse collapse" data-parent="#accordion-legacy">
              <div class="panel-body">
                <p class="why-you-love-hidden-text text-left">
                Include your personal business documents to protect your family. Partnerships and important legal documents that your family should need.
                </p>
              </div>
            </div>
          </div>
          <div class="panel panel-default panelBox">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed d-flex justify-content-between" data-toggle="collapse" href="#collapseSix-legacy">
                  <div class="d-flex justify-content-start">
                    <i class="fa fa-check black-text mx-2"></i>
                    <small class="panelFontStyle"> Easy Upload</small>
                  </div>
                </a>
              </h5>
            </div>
            <div id="collapseSix-legacy" class="panel-collapse collapse" data-parent="#accordion-legacy">
              <div class="panel-body">
                <p class="why-you-love-hidden-text text-left">
                Upload photos and documents in a snap. Easy to upload and share with members.
                </p>
              </div>
            </div>
          </div>
          <div class="panel panel-default panelBox">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed d-flex justify-content-between" data-toggle="collapse" href="#collapseSeven-legacy">
                  <div class="d-flex justify-content-start">
                    <i class="fa fa-check black-text mx-2"></i>
                    <small class="panelFontStyle"> Protection</small>
                  </div>
                </a>
              </h5>
            </div>
            <div id="collapseSeven-legacy" class="panel-collapse collapse" data-parent="#accordion-legacy" >
              <div class="panel-body">
              <p class="why-you-love-hidden-text text-left">
              We will do our best to protect your information by encrypted data and a daily backup of your 
              information.   LifeSpots security standards require, minimum character requirements for your password, dual authentication 2X phone number text or email authentication.
                </p>
              </div>
            </div>
          </div>
          <div class="panel panel-default panelBox">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed d-flex justify-content-between" data-toggle="collapse" href="#collapseEight-legacy">
                  <div class="d-flex justify-content-start">
                    <i class="fa fa-check black-text mx-2"></i>
                    <small class="panelFontStyle"> WebSpot</small>
                  </div>
                </a>
              </h5>
            </div>
            <div id="collapseEight-legacy" class="panel-collapse collapse" data-parent="#accordion-legacy" >
              <div class="panel-body">
                <p class="why-you-love-hidden-text text-left">
                Sharable webpage to document your personal history with your family.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /card img-thumbnail -->
    </div>
    <!--/First columnn: PROTECT LEGACY-->

    <!--Second columnn: IMPRESSIVE SECURITY-->
    <div class="col-lg-6 col-sm-12 mb-3">
      <div class="card img-thumbnail pb-1">
<!--Card image-->
<div class="view overlay hm-white-slight box-img-holder">
          <img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}impressiveSecurity.jpg" class="img-fluid img-container img-thumbnail" alt="">
              <a>
                  <div class="mask waves-light"></div>
              </a>

              <div class="carousel-caption box-holder">
                <p class="text-in-box-img-holder black-text"><a><span class="black-text">Your LifeSpot</span> <i class="fab fa-youtube"></i> <span class="black-text">Journey</span></a></p>
              </div>
              
        </div>
        <!--/.Card image-->
        <div class="panel-group" id="accordion-journey">

          <div class="text-center"><a href="{{route('register')}}" class="btn btn-purple my-2 py-2 btnPosition" style="visibility:xhidden;"><span class="white-text">Start Now</span></a></div>

          <div class="panel panel-default panelBox">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed d-flex justify-content-between" data-toggle="collapse" href="#collapseOne-journey">
                  <div class="d-flex justify-content-start">
                    <i class="fa fa-check black-text mx-2"></i>
                    <small class="panelFontStyle"> Set up your profile</small>
                  </div>
                </a>
              </h5>
            </div>
            <div id="collapseOne-journey" class="panel-collapse collapse" data-parent="#accordion-journey">
              <div class="panel-body">
                <p class="why-you-love-hidden-text text-left">About me, your estate.
                </p>
              </div>
            </div>
            
          </div>
          <div class="panel panel-default panelBox">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed d-flex justify-content-between" data-toggle="collapse"  href="#collapseTwo-journey">
                  <div class="d-flex justify-content-start">
                    <i class="fa fa-check black-text mx-2"></i>
                    <small class="panelFontStyle"> Add Your family</small>
                  </div>
                </a>
              </h5>
            </div>
            <div id="collapseTwo-journey" class="panel-collapse collapse" data-parent="#accordion-journey">
              <div class="panel-body">
                <p class="why-you-love-hidden-text text-left">
                So important to add your beneficiaries and set up their roles in your estate.
                </p>
              </div>
            </div>
          </div>
          <div class="panel panel-default panelBox">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed d-flex justify-content-between" data-toggle="collapse"  href="#collapseThree-journey">
                  <div class="d-flex justify-content-start">
                    <i class="fa fa-check black-text mx-2"></i>
                    <small class="panelFontStyle"> Upload Documents</small>
                  </div>
                </a>
              </h5>
            </div>
            <div id="collapseThree-journey" class="panel-collapse collapse" data-parent="#accordion-journey">
              <div class="panel-body">
                <p class="why-you-love-hidden-text text-left">
                Add important documents, photos and decide what to share.
                </p>
              </div>
            </div>
          </div>
          <div class="panel panel-default panelBox">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed d-flex justify-content-between" data-toggle="collapse" href="#collapseFour-journey">
                  <div class="d-flex justify-content-start">
                    <i class="fa fa-check black-text mx-2"></i>
                    <small class="panelFontStyle"> Invite Members</small>
                  </div>
                </a>
              </h5>
            </div>
            <div id="collapseFour-journey" class="panel-collapse collapse" data-parent="#accordion-journey">
              <div class="panel-body">
                <p class="why-you-love-hidden-text text-left">
                Key members of your estate, best way to notify the members of their role.
                </p>
              </div>
            </div>
          </div>
          <div class="panel panel-default panelBox">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed d-flex justify-content-between" data-toggle="collapse"  href="#collapseFive-journey">
                  <div class="d-flex justify-content-start">
                    <i class="fa fa-check black-text mx-2"></i>
                    <small class="panelFontStyle"> Shared Information</small>
                  </div>
                </a>
              </h5>
            </div>
            <div id="collapseFive-journey" class="panel-collapse collapse" data-parent="#accordion-journey">
              <div class="panel-body">
                <p class="why-you-love-hidden-text text-left">
                Control individual sharing rights with members of your estate.
                </p>
              </div>
            </div>
          </div>
          <div class="panel panel-default panelBox">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed d-flex justify-content-between" data-toggle="collapse"  href="#collapseSix-journey">
                  <div class="d-flex justify-content-start">
                    <i class="fa fa-check black-text mx-2"></i>
                    <small class="panelFontStyle"> Emergency Contact List</small>
                  </div>
                </a>
              </h5>
            </div>
            <div id="collapseSix-journey" class="panel-collapse collapse" data-parent="#accordion-journey">
              <div class="panel-body">
              <p class="why-you-love-hidden-text text-left">
              Create your Emergency Contact List and share with your family and estate holders.
                </p>
              </div>
            </div>
          </div>
          <div class="panel panel-default panelBox">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed d-flex justify-content-between" data-toggle="collapse"  href="#collapseSeven-journey">
                  <div class="d-flex justify-content-start">
                    <i class="fa fa-check black-text mx-2"></i>
                    <small class="panelFontStyle"> Smart Board</small>
                  </div>
                </a>
              </h5>
            </div>
            <div id="collapseSeven-journey" class="panel-collapse collapse" data-parent="#accordion-journey">
              <div class="panel-body">
                <p class="why-you-love-hidden-text text-left">
                Will notify you of missing information and outdated documents.
                </p>
              </div>
            </div>
          </div>
          <div class="panel panel-default panelBox">
            <div class="panel-heading">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed d-flex justify-content-between" data-toggle="collapse"  href="#collapseEight-journey">
                  <div class="d-flex justify-content-start">
                    <i class="fa fa-check black-text mx-2"></i>
                    <small class="panelFontStyle"> User Dashboard</small>
                  </div>
                </a>
              </h5>
            </div>
            <div id="collapseEight-journey" class="panel-collapse collapse" data-parent="#accordion-journey">
              <div class="panel-body">
                <p class="why-you-love-hidden-text text-left">
                Will give you a snapshot of your estate.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /card img-thumbnail -->
    </div>
    </div>
    <!--/Second columnn: IMPRESSIVE SECURITY-->

  </div>
  <!--/.Row-->
</section>

{{--
@php
include'whatTypeData.php';
@endphp--}}
@include('project.home.sections.whatTypeData')
