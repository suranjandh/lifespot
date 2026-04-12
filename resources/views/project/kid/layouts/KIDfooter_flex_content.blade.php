<style>
.footer_container {
  /* padding: 30px; */
  /* max-width: 1400px; */
  /* margin: 40px auto 0 auto; */
  background-color: rgb(182, 184, 189);
 
}
.content_row {
  /* display: flex; */
}
.footer_header {
  /* color: rgb(58, 113, 183); */
  color: rgb(104, 99, 98);
  font-weight: 400;
  text-transform: uppercase;
  /* border-bottom: 5px solid rgba(104, 99, 98, .5); */
  border-bottom: 5px solid rgba(58, 113, 183, .2);
  border-radius: 15%;

}
.footer_header_lite{
  border-bottom: 5px solid rgba(58, 113, 183, .5);
  border-radius: 35%;
  margin: 10px 100px 0 100px;
  
}
.footer_links:hover {
  color: rgb(58, 113, 183);
  font-weight: 300;
  /* width: 50%; */
}
.info_col {
  padding: 0px 40px;
  /* box-sizing: border-box;
  flex-basis: 1; */
  /* flex-basis: 30%; */

}
.anchor-left {
  /* margin-left: 50px; */
}
.sub_footer {
  text-transform: uppercase;
  /* margin: 15px; */
  margin-left: 15px;
  /* padding: 0px 20px; */
  /* color: rgb(104, 99, 98); */
  /* color: rgb(128,128,128); */
  color: rgba(58, 113, 183, .9);
  font-weight: 500;
}
.faqHelp {
  margin-left: 20px;
}
.lower-footer {
  margin-left: 60px;
  padding-right: 100px;
}
.social-media-links {
  /* margin-right: 5px; */
}
.social-media {
text-align: center;
}
.little_footer {
  font-size: .8rem;
  font-weight: 100;
  color: rgb(104, 99, 98);
}
.socialMedia-text {
  /* color: rgb(128,128,128); */
  color: rgba(58, 113, 183, .9);
}

</style>

<div class="d-flex mediaQuery justify-content-around info_col mr-5">
  <div class="p-2">
    <a><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}lifespotLogo/logo_vectorJ.png" class="mb-2" height="60px;" alt=""></a>
  </div>
  <div class="p-2">
    <h6 class="footer_header">Our Company</h6>
    <div><a href="##" class="footer_links">About Us</a></div>
    <div><a href="##" class="footer_links">Careers</a></div>
    <div><a href="##" class="footer_links">Updates</a></div>
    <div><a href="##" class="footer_links">News</a></div>
    <div><a href="##" class="footer_links">Service Terms</a></div>
    <!-- <div><a href="##" class="footer_links">News</a></div> -->
  </div>
  <div class="p-2">
    <h6 class="footer_header">Getting Started</h6>
    <div><a href="#1" class="footer_links">Introducting LifeSpot</a></div>
    <div><a href="#2" class="footer_links">Pricing</a></div>
    <div><a href="#3" class="footer_links">Security</a></div>
    <div><a href="#4" class="footer_links">Privacy</a></div>
    <div><a href="#4" class="footer_links">WebSpot</a></div>
  </div>
  <div class="p-2">
    <h6 class="footer_header">Business Professionals</h6>
    <div><a href="#1" class="footer_links">LifeSpot Professional</a></div>
    <div><a href="#2" class="footer_links">Enterprise Solutions</a></div>
    <div><a href="#3" class="footer_links">Business Opportunities</a></div>
    <div><a href="#4" class="footer_links">Client Services</a></div>
  </div>
  <div class="p-2">
    <h6 class="footer_header">Helpful Links</h6>
    <div><a href="#1" class="footer_links">Help Videos</a></div>
    <div><a href="#2" class="footer_links">Planning Tools</a></div>
    <div><a href="#3" class="footer_links">Grow Your Estate</a></div>
    <div><a href="#4" class="footer_links">Affiliates</a></div>
  </div>
</div>
<hr class="footer_header_lite">

<div class="d-flex mediaQuery justify-content-between lower-footer xmx-5 xmt-3">
  <div class="d-flex mediaQuery faqHelp flex-row p-2">
    <a href="##"><p class="sub_footer">Help</p></a>
    <a href="##"><p class="sub_footer">FAQ</p></a>
    <a href="##"><p class="sub_footer">Contact</p></a>
  </div>

  <!-- Middle col -->
  <div class="p-2">
    <p class="socialMedia-text social-media xpt-1 xmr-4">Follow us on Social Media</p>
    <div class="d-flex mediaQuery flex-row justify-content-center">
    {{--@php include 'KIDsocialMedia.php';@endphp--}}
@include('project.kid.layouts.KIDsocialMedia')
      <!-- <a href="https://www.facebook.com/MyLifeSpot/" target="_blank"><i class="fab fa-facebook-f fa-2x socialMedia-text mr-3"></i></a>
      <a href="https://twitter.com/myprivatestate" target="_blank"><i class="fab fa-twitter fa-2x socialMedia-text mr-3"></i></a>
      <a><i class="fab fa-pinterest-p fa-2x socialMedia-text mr-3"></i></a>
      <a><i class="fab fa-youtube fa-2x socialMedia-text mr-3"></i></a>
      <a href="https://www.instagram.com/myprivatestate/" target="_blank"><i class="fab fa-instagram fa-2x socialMedia-text mr-3"></i></a>
      <a><i class="fab fa-linkedin-in fa-2x socialMedia-text mr-3"></i></a> -->
    </div>
  </div>
  <!-- <div></div> -->
  <!-- /Middle col -->

  <div class="xml-auto p-2">
    <p class="little_footer mb-1">LifeSpot © 2019 Copyright</p>
    <a href="https://www.xpirix.com/" target="_blank"  rel="noopener noreferrer"><img class="" src="../img/corpLogo.png" width="146px;" alt=""></a>
  </div>
  <!-- /3rd col -->
</div>
