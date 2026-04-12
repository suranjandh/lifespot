<style>
    .message_box {
        border: 1px solid #8a8a8a;
        border-radius: 5px;
        overflow: auto;
        overflow-x: hidden;
        height: 80px;
        width: 100%;
    }

    [contentEditable=true]:empty:not(:focus):before {
        content: attr(data-text)
    }

    .btn-discard {
        background-color: #fafafa;
        color: black !important;
    }
</style>
<form>
    <div class="row d-flex justify-content-between">

        <input type="hidden" id="message_message_group_id"
               value="{{ $message_group_display ? $message_group->message_group_id : 0 }}">

        <input type="hidden" id="message_to_user" value="0">

        <!--<textarea class="typingBox form-control mx-5" name="" id="message_content" cols="30" rows="1"
                  placeholder="Start typing here..."></textarea>-->
        <div contenteditable="true" class="message_box form-control mx-5" name="" id="message_content"
             data-text="Start typing here..."></div>
    </div>

    <div class="row d-flex justify-content-end mr-md-4">


        <div class="file_uploader mt-3 mr-3" data-toggle="tooltip" title="Attach file">
            <label class="mb-0" for="message_attach_file">
                <i class="fas fa-paperclip fa-1x"></i>
            </label>
            <input id="message_attach_file" type="file"/>
        </div>

        <div class="file_uploader mt-3 mr-3" data-toggle="tooltip" title="Attach image">
            <label class="mb-0" for="message_attach_image">
                <i class="far fa-image fa-1x"></i>
            </label>
            <input id="message_attach_image" type="file"/>
        </div>

        <a class="btn btn-primary btn-rounded btn-sm msg-btn message_send_button"
           type="button">Send</a>
        <!-- <a class="btn btn-#fafafa grey lighten-5 btn-rounded btn-sm msg-btn reset_message">Discard</a> -->
        <a class="btn btn-discard btn-rounded btn-sm msg-btn reset_message">Discard</a>
    </div>

</form>