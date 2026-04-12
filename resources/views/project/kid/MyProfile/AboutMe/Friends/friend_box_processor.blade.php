<style>
    #friend-content {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-auto-rows: 250px;
        /* grid-auto-rows: minmax(200px, auto); */
        grid-gap: 10px;
        /* max-width: 960px; */
        margin: 0 auto;

    }

    #friend-content a {
        /* background: #3bbced; */
        /* padding: 10px; */
        /* background: #eee; */
        background: #fff;
        overflow: auto;
        border-radius: 5px;
        /* text-align: center; */
    }

    #friend-content div:nth-child(even) {
        /* background: #777; */
        /* padding: 30px; */
    }

    .friend-cardLayout {
        padding: 5px 20px;
        position: relative;
        border: 1px solid #0b2a41;
    }

    .friend-cardLayout .friend_relationship {
        color: grey;
        text-align: left;
        padding: 0;
        font-size: 1.3em;
    }

    .friend-cardLayout .friend_role {
        /* color: rgb(57, 122, 242); */
        color: rgb(58, 113, 183);
        text-align: right;
        padding: 0;
        font-size: 1.3em;
    }

    .friend-cardLayout .friend_image {
        height: 60%;
    }

    .friend-cardLayout .friend_image img {
        width: auto;
        height: 100%;
        max-width: 50%;
    }

    .friend-cardLayout .friend_name {
        text-align: left;
        font-size: 1.3em;
        color: darkgoldenrod;
        font-weight: bolder;
    }

    .friend-cardLayout .icon_set_row {
        position: absolute;
        bottom: 0;
        width: 100%;
    }

    .friend-cardLayout .icon_set {
        float: left;
        margin-right: 20px;

    }

    #addNewFriend {
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
        .friend-cardLayout .friend_relationship, .friend-cardLayout .friend_role, .friend-cardLayout .friend_name {
            font-size: 1.1em;
        }

    }

    @media (max-width: 980px) {
        .friend-cardLayout .friend_relationship, .friend-cardLayout .friend_role, .friend-cardLayout .friend_name {
            font-size: .9em;
        }
    }


</style>
<!--<style>
    .member-cardLayout .img-fluid,.member-cardLayout .img-thumbnail{
        max-width: inherit;
    }
    .friend-cardLayout {
        border-radius: 10px;
        border: 1px solid #000000;
    }
</style>-->
<div id="friend-content">
    <a class="friend-cardLayout friend_content_box member_content_box"

       data-member-type="friend" data-member-member-id="0" data-member-id="0" id="addNewfriend">Add Friend <br>
        <i class="fas fa-plus fa-4x"></i>
    </a>
    @php
        //if(isset($have_header) && $have_header != true ) {
         //   include '../../../../lib/includes/header_include.php';
        //}

        $members_set = null;
        // $member_obj = new MemberModel();
        $members_set = auth()->user()->friends ; // $member_obj->get_friends_by_user_id($_SESSION->loggedInUser);
        $member_type = 'friend';
    @endphp
    @if ($members_set)
        @foreach ($members_set as $member)
            @php    //$member = $member_obj->clear_no_role_for_multi_roles($member);
                //$member = (array)$member;
                $name = $member->member_first_name . ' ' . $member->member_last_name;

            @endphp
            <a class="friend-cardLayout friend_content_box member_content_box sub_sub_category_key_friend_{{ $member->member_id }}"
               data-member-member-id="{{ $member->member_id }}" data-member-id="{{ $member->member_id }}"
               data-member-type="{{$member_type}}"
               style="overflow: hidden">
                <div class="row">
                    <div class="col-5 friend_relationship">
                    </div>
                    <div class="col-7 friend_role">

                    </div>
                </div>
                <div class="row justify-content-start friend_image">
                    @php
                        $member_image = trim($member->member_image) != '' ?  Config::get('constants.MEMBER_IMG_URL') . $member->member_image . '?rand=' . rand(1, 1000) : Config::get('constants.DEFAULT_AVATAR_IMAGE_URL');
                    @endphp
                    <img src="{{ $member_image }}" class="pic ximg-fluid rounded img-thumbnail friend-img"
                         alt="">
                </div>
                <div class="row justify-content-start friend_name">
                    {{ $name }}
                </div>
                <div class="d-flex justify-content-between row icon_set_row">
                </div>

            </a>
        @endforeach
    @endif
</div>
