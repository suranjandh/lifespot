        <!--Section: Contact-->
        <section id="contact">
            <div class="row">
                <!--First column-->
                <div class="col-md-8">
                    <div id="map-container" class="z-depth-1 wow fadeInUp" >
                                
<!-- Form contact -->
<form class="px-4 py-2">

<p class="h5 text-center  mb-4">Write to us</p>

<div class="md-form">
    <i class="fa fa-user prefix grey-text"></i>
    <input type="text" id="form3" class="form-control">
    <label for="form3">Your name</label>
</div>

<div class="md-form">
    <i class="fa fa-envelope prefix grey-text"></i>
    <input type="text" id="form2" class="form-control">
    <label for="form2">Your email</label>
</div>

<div class="md-form">
    <i class="fa fa-tag prefix grey-text"></i>
    <input type="text" id="form32" class="form-control">
    <label for="form34">Subject</label>
</div>

<div class="md-form">
    <i class="fas fa-pencil-alt prefix grey-text"></i>
    <textarea type="text" id="form8" class="md-textarea" style="height: 100px"></textarea>
    <label for="form8">Your message</label>
</div>

<div class="text-center">
    <button class="btn btn-primary btn-lg">Send <i class="fas fa-paper-plane ml-1"></i></button>
</div>

</form>
<!-- Form contact -->
                    </div>
                </div>
                <!--/First column-->

                <!--Second column-->
                <div class="col-md-4">
                    <ul class="text-center">
                        <li class="wow fadeInUp" data-wow-delay="0.2s"><a class="btn-floating btn-small mdb-color"><i class="fa fa-map-marker-alt white-text mt-2"></i></a>
                            <p>80112</p>
                        </li>

                        <li class="wow fadeInUp" data-wow-delay="0.3s"><a class="btn-floating btn-small mdb-color" data-toggle="modal" data-target="#contact-form"><i class="fa fa-phone  white-text mt-2"></i></a>
                            <p>720-336-9595</p>
                        </li>

                        <li class="wow fadeInUp" data-wow-delay="0.4s"><a class="btn-floating btn-small mdb-color" data-toggle="modal" data-target="#contact-form"><i class="fa fa-envelope white-text mt-2"></i></a>
                            <p>Contact@MyLifeSpot.com</p>
                        </li>
                        <li class="wow fadeInUp" data-wow-delay="0.4s"><a class="btn-floating btn-small mdb-color" data-toggle="modal" data-target="#contact-form"><i class="fa fa-envelope white-text mt-2"></i></a>
                            <p>Follow us on Social Media</p>
{{--
                            @php include '../includes/socialMedia.php';@endphp
--}}
                           @include('project.layouts.socialMedia')
                        </li>
                    </ul>
                    
                    
                </div>
                <!--/Second column-->
            </div>
        </section>
        <!--Section: Contact-->