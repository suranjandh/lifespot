<style>
    .scrollspy-example {
        height: 550px;
    }

    .fa-paperclip, .fa-image {
        color: gray;
    }

    .member-id-item:hover {
        color: #fff !important;
        background-color: rgb(58, 113, 183);
    }

    .selected-member, .selected-member:hover {
        color: #fff !important;
        background-color: rgb(58, 113, 183);
    }

    .msg-mem-board {
        /* width: 80%; */
        /* border: 1px solid green; */
        background-color: white;
    }

    .msg-center {
        height: 550px;
        margin-bottom: 150px;
    }

    .middleRow {
        height: 250px;
        padding-left: 25px;
    }

    /*.typingBox {
        !* margin-left: 25px; *!
        !* height: 200px; *!
        height: 75px;
        padding: 25px;
        resize: none;

    }*/

    .mem-msg-pic {
        /* position: absolute; */
        /* top: 30px; */
        /* left: 25px; */
        height: 60px;
        width: 60px;
        margin-left: 15px;
    }

    .mem-msg-pic-board {
        height: 60px;
        width: 60px;
        margin-left: 25px;
        margin-top: 15px;
    }

    .boxShape {
        border-radius: 5px;
    }

    @media (max-width: 800px) {
        .scrollspy-example {
            height: 100px;
        }

        .msg-center {
            height: 550px;
        }
    }

    .msg-shape {
        position: absolute;
        right: 15px;
        border-radius: 100%;
        height: 25px;
        width: 25px;
        background-color: orangered;
        color: white;
        float: right;
        text-align: center;
        padding-top: 1px;
    }

    .select-box-row {
        height: 10px;
        background-color: white;
    }

    .msg-tab-name {
        position: absolute;
        top: 30px;
        padding-left: 90px;
        font-weight: 400;
        font-size: 1rem;
        /* left: 25%; */
        /* margin-top: 20px;
        margin-left: 20px; */
    }

    .xmsg-btn-send {
        position: absolute;
        bottom: 15px;
        right: 45px;
    }

    .msg-btn {
        border-radius: 3px;
    }

    .V1msg-member-role {
        position: absolute;
        top: 1px;
        right: 5px;
        font-size: .8em;
        /* display:none; */
    }

    .msg-member-role {
        /* position: absolute;
        top: 1px;
        right: 5px; */
        font-size: .8rem;
        /* display:none; */
    }

    .file_uploader > input {
        display: none;
    }

    .fa-paperclip, .fa-image {
        cursor: pointer;
    }

    .message_image_img {
        width: 50px;
        height: auto;
    }

    .message_set_container {
        height: 280px;
        overflow: scroll;
        overflow-x: hidden;
    }

    .message-group-name {
        margin-left: 90px;
        font-weight: 400;
        font-size: 1rem;
    }

    .group-message-member-img {
        height: 45px;
        width: 45px;
    }

    .message_content {
        padding: 5px 15px;
    }

    .message_content_inner {
        margin: 0 10px;
        padding: 5px;
        background-color: rgba(138, 138, 138, 0.21);
        border-radius: 5px;
        /*text-align: justify;*/
        /*text-justify: inter-word;*/
        /*word-break: break-all;*/
        /*white-space: pre-wrap;*/
        word-wrap: normal;
    }

    .current_users_message .message_content_inner {
        background-color: rgba(11, 81, 197, 0.63);
        color: white;
    }

    .current_users_message .message_content_inner a {
        color: white;
    }

    .current_users_message span {
        float: right;
        font-size: 8px;
        margin-right: 10px;
    }

    .other_users_message span {
        float: left;
        font-size: 8px;
        margin-left: 10px;
    }

    #message_attachment_image_display {
        height: 50px;
        width: auto;
    }
</style>
<div class="container-fluid">
    <div class="row r1 mb-3 py-1">

        <div class="col-md-5 col-sm-12 c1">
            <form id="search-members">
                <input type="text" class="form-control" id="search_messages_member_card_set"
                       placeholder="Search members..."/>
            </form>
        </div>
        <div class="col-md-4 col-sm-12 c2">

            @php
            use App\Message;$message_obj = new Message();
            $message_enabled_users = $message_obj->get_message_enable_users_data();
            @endphp
            @if ($message_enabled_users)
                <select id="group_member_select_chat" class="mdb-select colorful-select dropdown-primary" multiple>
                    {{--@php

                    include 'cards/group_member_select.php';
                    @endphp--}}
                    @include('project.estates.messageCenterA.cards.group_member_select')
                </select>
                <button class="btn-save btn btn-primary btn-rounded btn-sm msg-btn">Text these members &nbsp;&nbsp;
                </button>

                <button class="btn-save btn btn-success btn-rounded btn-sm msg-btn add_to_my_message_groups">Add to My
                    Groups List
                </button>
            @endif

            <!-- Modal -->
            <div class="modal fade" id="myMessageGroupsCreate" tabindex="-1" role="dialog"
                 aria-labelledby="myGroupsLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myGroupsLabel">New Group Name</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="message_group_form">
                                <div class="md-form">
                                    <input type="hidden" id="message_group_members_user_ids" class="form-control">
                                    <input type="text" id="message_group_name" class="form-control">
                                    <label for="groupName_1">Group Name</label>
                                </div>

                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Add to My Groups</button>
                            </form>
                        </div>
                        <div class="xmodal-footer">

                        </div>
                    </div>
                </div>
            </div>



        </div>
        <div class="col-md-3 col-sm-12 c2">
            <select class="mdb-select do_not_initiate xmd-form colorful-select dropdown-primary " id="messages-groups-list" xmultiple
                    xsearchable="Search here..">
                <option value="" disabled selected>My Groups</option>
            </select>
        </div>
    </div>
    <div class="row msg-center">

        <!-- First column -->
        <div class="col-md-5 col-sm-12 msg-mem-list mem-list boxShape">
            <div class="scrollspy-example py-0 px-0" id="member-list">
                <div class="list-group multiple" id="messages-list-lab-left" role="tablist">
                    {{--@php include 'cards/message_list_tab_left.php' @endphp--}}
                    @include('project.estates.messageCenterA.cards.message_list_tab_left')
                </div>
            </div>
        </div>
        <!-- First column -->

        <!-- Second column -->
        <div class="col-md-7 col-sm-12 message-box-display">


            <!-- Content -->

        </div>
        <!-- Second column -->

    </div>
    <span style="color: white">Your message center will populate with the members who have setup LifeSpot accounts</span>
</div>


