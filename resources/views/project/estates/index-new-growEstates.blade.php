<!-- ================= R E S O U R C E =================
  
  https://www.w3schools.com/howto/howto_js_sidenav.asp 

Sidenav overlay
Sidenave overlay without animation
Sidenav push (off-canvas)
Sidenave push w/opacity
Sidenav full-width

  ==================== R E S O U R C E ==============-->


<style>
    .growMyEstate_Color {
        background-color: rgb(58, 113, 183);
    }

    /* .GME_size {
      max-height: 900px;
    } */
    /* Slide Navigation */

    .sideDIYnav {
        height: 59%;
        height: 90%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
        /* margin-top: 125px; */
        margin-top: 90px;
        /* margin-left: 400px; */
        margin-left: 0px;
        z-index: 2;

    }

    .sideDIYnav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidePROnav {
        height: 59%;
        height: 90%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        right: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
        /* margin-top: 125px; */
        margin-top: 90px;
        /* margin-left: 400px; */
        margin-left: 0px;
        z-index: 2;

    }

    .sidePROnav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: white;
        /* color: rgb(124,252,0); */
        display: block;
        transition: 0.3s;
    }

    .sidenav a:hover {
        color: #f1f1f1;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    @media screen and (max-height: 250px) {
        .sidenav {
            padding-top: 15px;
        }

        .sidenav a {
            font-size: 18px;
        }
    }
</style>
<!-- Jumbotron -->
<div class="GME_size jumbotron text-center xgrowMyEstate_Color mdb-color lighten-2 white-text mx-2 mb-5">

    <!-- Title -->
    <h2 class="card-title h2">Helping You Grow and Protect Your Estate</h2>

    <!-- Subtitle -->
    <p class="my-4 h6">Powerful tools designed around helping you grow and protect your estate now and in the
        future.</p>

    <!-- Grid row -->
    <div class="row d-flex justify-content-center">

        <!-- Grid column -->
        <div class="col-xl-7 pb-2">

            <!-- <p class="card-text">LifeSpot's initial goal is too provide a secure solution to organize and share documents and asset informaiton with the important people in your life.</p> -->
            <p class="card-text"> Use this feature of LifeSpot to help you make sure you are staying current with the
                latest ideas in estate planning - stay connected and learn new ways to help you Grow Your Estate. Choose
                from the Do It Yourself option, working with a Professional, or maybe a combination of both options.</p>

        </div>
        <!-- Grid column -->

    </div>
    <!-- Grid row -->

    <hr class="my-4 rgba-white-light">

    <div class="pt-2">
        <button type="button" class="btn btn-outline-white" onclick="openDIYNav()">Do It Yourself<i
                    class="fas fa-wrench ml-1"></i></button>


        <!-- <h2>Animated Sidenav Example</h2>
        <p>Click on the element below to open the side navigation menu.</p>
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span> -->


        <button type="button" class="btn btn-outline-white" onclick="openProNav()">Professional <i
                    class="fab fa-hire-a-helper ml-1"></i></button>

    </div>
    <!-- Jumbotron -->

    <div class="card text-center mt-5">
        <div class="card-header black-text">
            Estate Analyzer
        </div>
        <div class="card-body">
            <h5 class="card-title">Estate Analysis</h5>
            <p class="card-text">From your LifeSpot data, you can quickly see an assement of your Estate and potential
                areas for improvement.</p>
            <a href="#!" class="btn btn-primary"> Run Analysis</a>
        </div>
        <div class="card-footer text-muted">
            Last Checked: 2 days ago
        </div>
    </div>

</div>
<div id="DIYSidenav" class="sideDIYnav sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeDIYNav()">&times;</a>
    <a href="{{url('home/advanced_markets')}}">Checklist</a>
    <a href="#">Taxes</a>
    <a href="#">Legality</a>
    <!-- <a href="#">Contact</a> -->
    <a href="{{url('home/advanced_resources')}}">Resources</a>
    <a href="#">Calculators</a>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- <p class="pink-text ml-5">Please remember: <br> Grow My Estate section under construction</p> -->
</div>

</div>
<div id="ProSidenav" class="sidePROnav sidenav">
    <h5 class="mx-4 mb-4" style="color:white;"><u>Let the Professionals Help</u></h5>
    <a href="javascript:void(0)" class="closebtn" onclick="closeProNav()">&times;</a>
    <!-- Button trigger modal -->
    <a data-toggle="modal" data-target="#affiliate_eMoney">
        <em style="color: white;">eMoney</em>
    </a>


</div>

<!--Modal: About Welcome Task-->
<div class="modal fade" id="affiliate_eMoney" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-fluid mt-0" role="document">

        <div class="modal-content">

            <div class="modal-body mb-0 p-0">

                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                    <iframe class="embed-responsive-item"
                            src="https://info.emoneyadvisor.com/freetrial?utm_source=adwords&utm_medium=ppc&utm_campaign=branded+hv&_bt=267796125076&_bk=emoney&_bm=e&_bn=g&gclid=CjwKCAiA767jBRBqEiwAGdAOr2DuW3JNV6Qu2yGTd5lXRllhZM3SD-QYYCYetQqWKloYjJkNZ4kTAxoCKYUQAvD_BwE"
                            allowfullscreen></iframe>
                </div>

            </div>

            <div class="modal-footer justify-content-around flex-column flex-md-row">
                {{--@php
                include '../includes/logoNav.php'; @endphp--}}

                @include('project.layouts.logoNav')
                <span class="mr-3 pink-text">One of our amazing affilates!</span>
                <span>Spread the word!</span>
                <div>
                    {{--@php
                    include '../includes/socialMedia.php';
                    @endphp--}}

                    @include('project.layouts.socialMedia')

                </div>
                <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">
                    Close
                </button>


            </div>

        </div>

    </div>
</div>
<!--Modal: About Welcome Task-->


<script>
    function openDIYNav() {
         document.getElementById("DIYSidenav").style.width = "370px";
     }
     function closeDIYNav() {
         document.getElementById("DIYSidenav").style.width = "0";
     }
     function openProNav() {
         document.getElementById("ProSidenav").style.width = "370px";
     }
     function closeProNav() {
         document.getElementById("ProSidenav").style.width = "0";
     }
</script>