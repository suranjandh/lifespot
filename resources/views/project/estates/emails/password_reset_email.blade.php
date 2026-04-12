<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .table_main{
            width: 800px;
            line-height: 1.5em;
            padding: 5px;
            font-size: 1.2em;
            color: #6a7178;
        }

        .table_head img{
            width: 600px ;
        }

        .table_foot img{
            width: 100px;
        }

        .table_para{
            text-align: justify;
        }
    </style>
</head>
<body>

<table class="table_main table_head">
    <tr>
        <td><img src="{{ Config::get('constants.PROJECT_LOGO_IMAGE_URL') }}lifeSpot.png"></td>
    </tr>
</table>

<table class="table_main">
    <tr>
        <td>Hi {{ $mail_settings['template_bindings']['first_name'] }} ,</td>
    </tr>
</table>


<table class="table_main table_para">
    <tr>
        <td>
            Reset your password, and we’ll get you on your way.<br>
            To change your LifeSpot password, click the link below:<br>
            {{$mail_settings['template_bindings']['password_reset_link']}}<br>
            This link will expire in one hour, so be sure to use it right away.<br>

        </td>
    </tr>
</table>

<table class="table_main table_foot">
    <tr>
        <td>
            Thank you for using LifeSpot!
            The LifeSpot team
        </td>
    </tr>
</table>

</body>
</html>




















