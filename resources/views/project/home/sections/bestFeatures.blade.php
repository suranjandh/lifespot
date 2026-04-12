<style>
.theContainer {
  display: flex;
  flex-flow: row wrap;
  justify-content: space-around;
}
  .theBtn{
      /* height: 40px; */
      position: absolute;
      bottom: 12px;
      border-radius: 10px;
      align-self: baseline;
  }

  .img-tweak {
      /* height: 35%;
      width: 100%; */
  }

.maxImg-height {
    /* height: 233.33px; */
}
</style>
<div class="container">
<!--Card deck-->
<div class="card-deck">

    <!--Card-->
    <div class="card mb-4">

        <!--Card image-->
        <div class="view overlay">
            <img class="img-fluid" src="{{Config::get('constants.PROJECT_IMAGE_URL')}}cardPic-access.jpg" alt="Card image cap">
            <a>
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>
        <!--Card image-->

        <!--Card content-->
        <div class="card-body theContainer">

            <!--Title-->
            <h4 class="card-title">Access is Here</h4>

            <!--Text-->
            <p class="card-text pt-2 mb-5">With your LifeSpot account you now have complete access to view all your assets and documents important to your family. By giving member access to the most important people in your estate we make sure your members can take care of you. It’s a process that is easy to set up to help you protect your legacy.  
            </p>
            <a data-toggle="modal" data-target="#card-1" type="button" class="btn btn-primary btn-md theBtn">Read more</a>

            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
        </div>
        <!--Card content-->

    </div>
    <!--Card-->

    <!--Card-->
    <div class="card mb-4">

        <!--Card image-->
        <div class="view overlay">
            <img class="img-fluid" src="{{Config::get('constants.PROJECT_IMAGE_URL')}}cardPic-members.jpg" alt="Card image cap">
            <a>
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>
        <!--Card image-->

        <!--Card content-->
        <div class="card-body theContainer">
            <!--Title-->
            <h4 class="card-title">Estate Members</h4>

            <!--Text-->
            <p class="card-text pt-2 mb-5">With your LifeSpot account you now can give read only access to your estate to the most important people in your life. By signing up, you will be able to invite those you choose to take care of your estate when necessary. LifSpotTM a process that is easy to set up to help you protect your legacy.  
            </p>
            <a data-toggle="modal" data-target="#card-2" type="button" class="btn btn-primary btn-md theBtn">Read more</a>
            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
        </div>
        <!--Card content-->

    </div>
    <!--Card-->

    <!--Card-->
    <div class="card mb-4">

        <!--Card image-->
        <div class="view overlay">
            <img class="img-fluid" src="{{Config::get('constants.PROJECT_IMAGE_URL')}}feature_store.jpg" alt="Card image cap">
            <a>
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>
        <!--Card image-->

        <!--Card content-->
        <div class="card-body theContainer">
            <!--Title-->
            <h4 class="card-title">Documents, Save & Protect</h4>

            <!--Text-->
            <p class="card-text pt-0 mb-5">With your LifeSpot account you now have access to those important estate documents and assets. Only the most important people in your estate have viewable and read only copies when something is needed. It’s a process that is easy to upload and share.</p>
            <a data-toggle="modal" data-target="#card-3" type="button" class="btn btn-primary btn-md theBtn">Read more</a>
            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
        </div>
        <!--Card content-->

    </div>
    <!--Card-->

</div>
<!--Card deck-->

<!--Card group-->
<div class="card-deck">

    <!--Card-->
    <div class="card mb-4">

        <!--Card image-->
        <div class="view overlay">
            <img class="img-fluid" src="{{Config::get('constants.PROJECT_IMAGE_URL')}}feature_share.jpg" alt="Card image cap">
            <a>
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>
        <!--Card image-->

        <!--Card content-->
        <div class="card-body theContainer">
            <!--Title-->
            <h4 class="card-title">Estate Protection</h4>

            <!--Text-->
            <p class="card-text pt-2 mb-5">With your LifeSpot account you now have the protection to view property, investments, insurance and the locations of all your assets. It’s a process that is easy to set up to protect you and your estate.</p>
            <a data-toggle="modal" data-target="#card-4" type="button" class="btn btn-primary btn-md theBtn">Read more</a>
            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
        </div>
        <!--Card content-->

    </div>
    <!--Card-->

    <!--Card-->
    <div class="card mb-4">

        <!--Card image-->
        <div class="view overlay maxImg-height">
            <img class="img-fluid" src="{{Config::get('constants.PROJECT_IMAGE_URL')}}cardPic-growSm.jpg" alt="Card image cap">
            <a>
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>
        <!--Card image-->

        <!--Card content-->
        <div class="card-body theContainer">

            <!--Title-->
            <h4 class="card-title">LifeSpot Grows with You!</h4>

            <!--Text-->
            <p class="card-text pt-2 mb-5">With your LifeSpot account you now have access to view property, investments, insurance and the locations of all your assets. It’s a process that is easy to set up to help you grow and keep track of your investments.  
            </p>
            <a data-toggle="modal" data-target="#card-5" type="button" class="btn btn-primary btn-md theBtn">Read more</a>

            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
        </div>
        <!--Card content-->

    </div>
    <!--Card-->

    <!--Card-->
    <div class="card mb-4">

        <!--Card image-->
        <div class="view overlay">
            <img class="img-fluid" src="{{Config::get('constants.PROJECT_IMAGE_URL')}}cardPic-webspotSm.jpg" alt="Card image cap" class="img-height-adjust">
            <a>
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>
        <!--Card image-->

        <!--Card content-->
        <div class="card-body theContainer">
            <!--Title-->
            <h4 class="card-title">WebSpot</h4>

            <!--Text-->
            <p class="card-text pt-0 mb-5">Don’t' forget to check out "WebSpot" -- your own private website for blogging, journaling, and much more. Keep private with a security key that unlocks this part of your legacy.</p>
            <a data-toggle="modal" data-target="#card-6" type="button" class="btn btn-primary btn-md theBtn">Read more</a>
            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
        </div>
        <!--Card content-->

    </div>
    <!--Card-->

</div>
<!--Card deck-->
</div>

@php 
/*include'bestFeatures-more-card1.php';
include'bestFeatures-more-card2.php';
include'bestFeatures-more-card3.php';
include'bestFeatures-more-card4.php';
include'bestFeatures-more-card5.php';
include'bestFeatures-more-card6.php';*/
@endphp
@include('project.home.sections.bestFeatures-more-card1')
@include('project.home.sections.bestFeatures-more-card2')
@include('project.home.sections.bestFeatures-more-card3')
@include('project.home.sections.bestFeatures-more-card4')
@include('project.home.sections.bestFeatures-more-card5')
@include('project.home.sections.bestFeatures-more-card6')