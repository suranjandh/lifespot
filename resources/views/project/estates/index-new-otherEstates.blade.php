<style>
    #other-estates-content {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-auto-rows: 250px;
        /* grid-auto-rows: minmax(200px, auto); */
        grid-gap: 10px;
        /* max-width: 960px; */
        margin: 0 auto;

    }

    #other-estates-content a {
        /* background: #3bbced; */
        /* padding: 10px; */
        /* background: #eee; */
        background: #fff;
        overflow: auto;
        border-radius: 5px;
        /* text-align: center; */
    }

    #other-estates-content div:nth-child(even) {
        /* background: #777; */
        /* padding: 30px; */
    }

    .other-estate-cardLayout {
        padding: 5px 20px ;
        position:relative;
    }


    .other-estate-cardLayout .estate_image{
        padding: 5px 0px ;
        position:relative;
    }

    .other-estate-cardLayout .estate_image{
        height: 60%;
    }

    .other-estate-cardLayout .estate_image img{
        width: auto;
        height: 100%;
        max-width: 50%;
    }



    .other-estate-cardLayout .estate_name{
        color: #ffd74c;
        font-weight: bolder;
        font-size: .8em;
        text-align: center;
        padding-left: 10px;
    }

    .other-estate-cardLayout .estate_member_role{
        font-size: 1em;
        text-align: center;
        position:absolute;
        left: 30%;
    }


    .other-estate-cardLayout .icon_set_row{
        position:absolute;
        bottom:0;
    }

    .other-estate-cardLayout .icon_set {
        float: left;
        margin-right: 20px;

    }


    .modal-position {
        margin-right: 50%;
    }

    .modal-size {
        width: 1000px;
    }

    .main_role{
        color: #0d5bdd;
    }


</style>

<div>


    <div class="seachAndSort white-text">
        <h2>Welcome {{auth()->user()->first_name}}</h2>

        <p>The following person or people have invited you to be a part of their estate.</p>

        <p>Click on the card(s) below for more information.</p>
        <input type="text" id="search_estate_cards_set" placeholder="Search estates... ">
        <!-- Sort other-estates by: <button class="btn btn-primary btn-small">Last Name</button>
        <span>Key:  Shared Documents = <i class="far fa-file-alt mr-2"></i> Gifts = <i class="fas fa-gift"></i> ? ? =  Not joined LifeSpot</span> -->
    </div>
    <br>

    <div id="other-estates-content">
        {{--@php include 'otherEstates/other_estate_cards.php' @endphp--}}
        @include('project.estates.otherEstates.other_estate_cards')
    </div>
</div>


