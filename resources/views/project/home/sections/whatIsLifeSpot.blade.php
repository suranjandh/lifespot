<style>
.card {
  text-align: center;
  border-radius: 3%;
}
.whatis-card {
  margin: 0 auto;
  padding: 15px;
}
@media (min-width: 992px){
  .whatis-card {
    max-width: 75%;
  }
}

.what-is-text-container {
  font-size: 1.2rem;
  color: grey;
}
.smaller-text {
  font-size: 1.0rem;
}

</style>

<div class="card z-depth-5 whatis-card">
  
  <div class="what-is-text-container mx-5 pb-3">
    <img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}lifespotLogo/logo_vectorJ.png" width="550px;" class="img-fluid my-4"  alt="">
    <p>A secure solution to safely store, edit and share important personal estate documents and assets with invited estate members. The only platform that allows you to control private access to your estate with a quick invitation.<br>
    <span class="text-muted smaller-text">LifeSpot a snapshot of your estate and our NEW <a href="{{url('home/webspot')}}"><u>WebSpot</u></a>, a sharable personal webpage to document your family history.</span>
    </p>
  </div>

</div>



  