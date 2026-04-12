<style>
    .message_content {
        padding: 5px 15px;
    }

    .message_content_inner {
        padding: 5px;
        background-color: rgba(138, 138, 138, 0.21);
        border-radius: 5px;
    }

    .current_users_message .message_content_inner{
        background-color: rgba(11, 81, 197, 0.63);
        color: white;
    }

    .current_users_message span{
        float: right;
        font-size: 8px;
        margin-right: 10px;
    }

    .other_users_message span{
        float: left;
        font-size: 8px;
        margin-left: 10px;
    }
</style>
@foreach ($messages_with_group as $message)
@include('group_message_single.php')
@endforeach
