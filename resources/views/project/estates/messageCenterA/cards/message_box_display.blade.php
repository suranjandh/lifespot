<div id="Member 1" class="msg-mem-board msg-center groupEmail">
    <div class="row d-flex">
        <img src="" class="mem-msg-pic-board rounded-circle user_image" alt="">
        <h4 class="h4-responsive ml-3 mt-4 user_full_name"></h4>
    </div>
    <hr>
    <!-- //this img insert is just a temp holding spot until the live message center texts are active -->
    <!--<div class="row middleRow"><img src="../img/text_msg.png" width="95%" alt=""></div>-->
    <div class="message_set_container" >
       {{-- @php include 'messages_set.php'; @endphp--}}
        @include('project.estates.messageCenterA.cards.messages_set')
    </div>
    <hr>
    @php
    $message_group_display = false ;
    // include 'message_input_form.php';
    @endphp
    @include('project.estates.messageCenterA.cards.message_input_form')
</div>