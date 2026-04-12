<style>
.data-background {
  background-image: url("{{Config::get('constants.PROJECT_IMAGE_URL')}}dataShareBackground.jpg");
  
  background-size: cover;
  background-repeat: no-repeat;
  background-position: 50% 50%;
  padding: 20px 0 0 0; 
}

.learnMore {
  position: absolute;
  bottom: 0;
  left: 40%;
  /* background-color: red; */
}

.blocktext {
  margin-left: auto;
    margin-right: auto;
    width: 18em
}
</style>
<!-- What type of data you can upload -->
<div class="container">

  <div class="row data-background">
    <div class="col-lg-4 col-sm-12 xtext-center mb-5">
    <hr>
      <div class="text-center">
      <a data-toggle="modal" data-target="#storeEstate"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}files2.png" alt=""></a>
      <br>
      <h4><a data-toggle="modal" data-target="#storeEstate">Files</a></h4>
      </div>


      <!-- <p>Store and preserve your most important documents</p>
      <ul>
        <li>~ Estate & medical documents. </li>
        <li>~ Novels, writings.</li>
        <li>~ Military records</li>
        <li>~ personal music recordings.</li>
        <li>~ even your mother’s favorite recipes. </li>
        <li>~ Snap a picture and upload from your mobile device.</li>
      </ul>
      <p>All accessible by LifeSpot in a moments notice. </p> -->


      <p class="">We are giving you the opportunity to build and save your Legacy. Store and preserve your most important documents, estate & medical documents, novels, military records, personal music recordings or even your mothers favorite recipes. All accessible in a moments notice. Create your LifeSpot!</p>
      <!-- <p>Word documents, excel sheets, PowerPoint presentations and other formats of files can be uploaded. Files may contain legal, financial...</p> -->
      <br>
      <a class="learnMore  blue-text" data-toggle="modal" data-target="#storeEstate">Learn More</a>
      <!-- <hr> -->
    </div>
    <div class="col-lg-4 col-sm-12 xtext-center mb-5">
    <hr>
      <div class="text-center">
      <a data-toggle="modal" data-target="#storeEstate"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}photos2.png" alt=""></a>
      <br>
      <h4><a data-toggle="modal" data-target="#storeEstate">Photos</a></h4>
      </div>



      <p>These are not day to day photos. Let LifeSpot keep memories in the family. Upload historical photos of relatives and tell their story. Leave heirlooms for that special family member and tag them with a photo of your wish or upload the photos of your assets for your records and access everything LifeSpot has to offer in a moments notice. Create your LifeSpot!</p>
      <br>
      <a class="learnMore blue-text" data-toggle="modal" data-target="#storeEstate">Learn More</a>
      <!-- <hr> -->
    </div>
    <div class="col-lg-4 col-sm-12 xtext-center mb-5">
    <hr>
      <div class="text-center">
      <a data-toggle="modal" data-target="#storeEstate"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}videos2.png" alt=""></a>
     <br>
     <h4><a data-toggle="modal" data-target="#storeEstate">Videos</a></h4>
      </div>



     <p>Let LifeSpot help you create a video diary, something you would want to share or keep private until the time is right. Maybe you just want to share and preserve family videos and share them with loved ones and view on a moments notice. Create your LifeSpot!</p>
     <br>
      <a class="learnMore  blue-text" data-toggle="modal" data-target="#storeEstate">Learn More</a>
      <!-- <hr> -->
    </div>
    </div>
  </div>

</div>
{{--

@php 
include'whatTypeData.php';
@endphp--}}
@include('project.home.sections.whatTypeData')
