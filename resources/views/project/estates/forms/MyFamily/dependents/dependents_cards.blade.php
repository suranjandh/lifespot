<style>
    #dependents-content {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-auto-rows: 250px;
        /* grid-auto-rows: minmax(200px, auto); */
        grid-gap: 10px;
        /* max-width: 960px; */
        margin: 0 auto;

    }

    #dependents-content a {
        /* background: #3bbced; */
        /* padding: 10px; */
        /* background: #eee; */
        background: #fff;
        overflow: auto;
        border-radius: 5px;
        /* text-align: center; */
    }

    #dependents-content div:nth-child(even) {
        /* background: #777; */
        /* padding: 30px; */
    }


    .dependent-cardLayout{
        padding: 5px 20px ;
        position:relative;
        border: 1px solid #a4a4a4;
    }

    .dependent-cardLayout .dependent_relationship{
        color: grey;
        text-align: left;
        padding: 0;
        font-size: 1.3em;
    }

    .dependent-cardLayout .dependent_role{
        /* color: rgb(57, 122, 242); */
        color: rgb(58, 113, 183);
        text-align: right;
        padding: 0;
        font-size: 1.3em;
    }

    .dependent-cardLayout .dependent_image{
        height: 60%;
    }

    .dependent-cardLayout .dependent_image img{
        width: auto;
        height: 100%;
        max-width: 50%;
    }

    .dependent-cardLayout .dependent_name{
        text-align: left;
        font-size: 1.3em;
        color: darkgoldenrod;
        font-weight: bolder;
    }


    .dependent-cardLayout .icon_set_row{
        position:absolute;
        bottom:0;
    }

    .dependent-cardLayout .icon_set {
        float: left;
        margin-right: 20px;

    }

    #addNewdependent {
        color: rgb(57, 122, 242);
        text-align: center;
        padding: 15px;
        font-size: 1.4em;
    }

    .modal-position {
        margin-right: 50%;
    }

    .modal-size {
        width: 1000px;
    }
    @media (max-width: 1580px) {
        .dependent-cardLayout .dependent_relationship, .dependent-cardLayout .dependent_role, .dependent-cardLayout .dependent_name {
            font-size: 1.1em;
        }

    }

    @media (max-width: 980px) {
        .dependent-cardLayout .dependent_relationship, .dependent-cardLayout .dependent_role, .dependent-cardLayout .dependent_name {
            font-size: .9em;
        }
    }

    /* temporary fix for card width */
    @media (min-width:320px) {
    /* smartphones, iPhone, portrait 480x320 phones */
        #dependents-content {
            grid-template-columns: repeat(1, 1fr);
        }

    }
    @media (min-width:481px) {
     /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */
        #dependents-content {
            grid-template-columns: repeat(1, 1fr);
        }
    }
    @media (min-width:641px) {
    /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */
        #dependents-content {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (min-width:961px) {
    /* tablet, landscape iPad, lo-res laptops ands desktops */
        #dependents-content {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (min-width:1025px) {
    /* big landscape tablets, laptops, and desktops */
        #dependents-content {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    @media (min-width:1281px) {
    /* hi-res laptops and desktops */
        #dependents-content {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    /* temporary fix for card width */
</style>
<div id="dependents-cards" >
    
    <style>
        #dependents-edit{
            display: none;
        }
    </style>
    <div id="dependents-content" >
       {{-- @php
        if(isset($_POST->dependents_set)) {
            include 'dependent_box_processor2.php' ;
        }else{
            include 'dependent_box_processor.php' ;
        }
        @endphp--}}
        @include('project.estates.forms.MyFamily.dependents.dependent_box_processor')

    </div>
</div>
<style>
    .dependentFormStyles{
        background: white;
        padding: 20px;
        display: inline;
    }
</style>
<div id="dependents-edit" class="dependentFormStyles">
</div>
