
$(document).ready(function () {
    var set_site_fields_request;

    function set_site_fields() {
        if (set_site_fields_request) {
            set_site_fields_request.abort();
        }
        set_site_fields_request = $.ajax({
            type: "POST",
            url:SITE_BASE_URL+"project/kid/MyProfile/AboutMe/Site/processor.php",
            data: {
                action: 'read'
            },
            cache: false,
            success: function (data) {
                var result_set = $.parseJSON(data);
                if (result_set.error == 0) {
                    var result = result_set.result;
                    $('.bind_site_owner_name').html(result.site_owners);
                    $(".bind_site_name").html(result.site_name);
                }
            }
        });
    }

    set_site_fields();
});