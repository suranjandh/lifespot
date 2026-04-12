<span id="member_error_message"></span>
<div id="Div1">
    <div class="seachAndSort white-text">
        <input type="text" id="search_members_cards_set" placeholder="Search members... ">
        <!--   <input type="text" placeholder="Sort members">
           <span>Key:  Shared Documents = <i class="far fa-file-alt mr-2"></i> Gifts = <i class="fas fa-gift"></i> ? ? =  Not joined LifeSpot</span>
    -->   </div>
    <br>

    <div id="members-content">

        {{--@php  include 'forms/memberForms/member_box_processor.php' @endphp
--}}
        @include('project.estates.forms.memberForms.member_box_processor')
    </div>

</div>
<!-- /End MODAL -->
<style>
    .memberFormStyles {
        background: white;
        padding: 20px;
        display: inline;
    }
</style>



