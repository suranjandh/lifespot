    <style>
        .table_main{
            width: 800px;
            line-height: 1.5em;
            padding: 5px;
            font-size: 1.2em;
            color: #6a7178;
        }
        

        .table_para{
            text-align: justify;
        }
        .footer_email_style{
            color: #A9A9A9;
            font-size: .9rem;
        }
        .footer_center_email{
            text-align: center;
        }
    </style>
</head>
<body>

<table class="table_main table_head">
    <tr>
        <td><img style="width:150px" src="{{ Config::get('constants.PROJECT_LOGO_IMAGE_URL') }}lifeSpot.png"></td>
    </tr>
</table>

<table class="table_main">
    <tr>
        <td>Dear {{ $mail_settings['to_name'] }} ,</td>
    </tr>
</table>

<table class="table_main">
    <tr>
        <td>Congratulations on your new LifeSpot account.</td>
    </tr>
</table>

<table class="table_main table_para">
    <tr>
        <td>We are the only free platform that allows you control and immediate access to your estate files. Invite
            your first estate members, dependents and emergency contacts with a quick invitation at <a
                href="{{ Config::get('constants.SITE_BASE_URL') }}">LifeSpot.com.</a></td>
    </tr>
</table>

<table class="table_main table_para">
    <tr>
        <td>LifeSpot is a secure solution to safely store, edit and share important estate documents and assets with
            invited members only. We will take care of security while you take care of your estate.
        </td>
    </tr>
</table>

<table class="table_main">
    <tr>
        <td>Changes happen as soon as you click the button!</td>
    </tr>
</table>

<table class="table_main table_foot">
    <tr>
        <td>
            <img style="width:50px" src="{{ Config::get('constants.PROJECT_LOGO_IMAGE_URL') }}lifeSpot.png"><br>
            Headquarters<br>
            Denver, Colorado
        </td>
    </tr>
    <br>
    <tr>
        <td class="footer_center_email">
        <span class="footer_email_style mb-0">This email was intended for {{ $mail_settings['to_name'] }}
        <u><a class="footer_email_style" href="{{ Config::get('constants.SITE_BASE_URL') }}">Learn why we include this.</a></u></span>
        <p class="" ><img style="width:100px" src="{{ Config::get('constants.PROJECT_LOGO_IMAGE_URL') }}lifeSpot.png"></p>
            <span class="footer_email_style">2019 LifeSpot Corporation Denver, Colorado LifeSpot and the LifeSpot logo are registered trademarks of LifeSpot.</span>
        </td>
    </tr>
</table>
