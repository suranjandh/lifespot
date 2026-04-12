<?php


$ESTATE_IMG_FOLDER = 'estate_images';
$PROFILE_IMG_FOLDER = 'profile_images';
$MEMBER_IMG_FOLDER = 'member_images';
$MESSAGE_ATTACHMENT_FOLDER = 'message_attachments';
$MESSAGE_IMG_FOLDER = 'message_images';
$PET_IMG_FOLDER = 'pet_images';
$SITE_IMG_FOLDER = 'site_images';
$DOCUMENT_FOLDER = 'documents';
$DEPENDENT_SCHOOL_IMG_FOLDER = 'dependent_images/school';
$DEPENDENT_MEDICAL_IMG_FOLDER = 'dependent_images/medical';
$SITE_IDLE_TIME_MINUTES = 15;
$LIB_VERSION = '?v=1.01.73';


return [
    'LIB_VERSION' => $LIB_VERSION,
    'SITE_BASE_URL' => env('APP_URL'),
    'SITE_INDEX_URL' => env('APP_URL') . 'estates/',
    'SITE_LOGOUT_URL' => env('APP_URL') . 'logout/',
    'SITE_LOGIN_URL' => env('APP_URL') . 'login/',
    'DOCUMENT_URL' => env('APP_URL') . 'documents/',
    'DOCUMENT_FOLDER' => $DOCUMENT_FOLDER,
    'MESSAGE_ATTACHMENT_FOLDER' => $MESSAGE_ATTACHMENT_FOLDER,
    'MESSAGE_ATTACHMENT_URL' => env('APP_URL') . $MESSAGE_ATTACHMENT_FOLDER . '/',
    'MESSAGE_IMG_FOLDER' => $MESSAGE_IMG_FOLDER,
    'MESSAGE_IMG_URL' => env('APP_URL') . $MESSAGE_IMG_FOLDER . '/',
    'MEMBER_IMG_URL' => env('APP_URL') . $MEMBER_IMG_FOLDER . '/',
    'MEMBER_IMG_FOLDER' => $MEMBER_IMG_FOLDER,
    'DEPENDENT_PROFILE_IMG_URL' => env('APP_URL') . $MEMBER_IMG_FOLDER . '/',
    'DEPENDENT_GUARDIAN_IMG_URL' => env('APP_URL') . 'dependent_images/guardian/',
    'DEPENDENT_SCHOOL_IMG_FOLDER' => $DEPENDENT_SCHOOL_IMG_FOLDER,
    'DEPENDENT_SCHOOL_IMG_URL' => env('APP_URL') . $DEPENDENT_SCHOOL_IMG_FOLDER . '/',
    'DEPENDENT_MEDICAL_IMG_FOLDER' => $DEPENDENT_MEDICAL_IMG_FOLDER,
    'DEPENDENT_MEDICAL_IMG_URL' => env('APP_URL') . $DEPENDENT_MEDICAL_IMG_FOLDER . '/',
    'PET_IMG_FOLDER' => $PET_IMG_FOLDER,
    'PET_IMG_URL' => env('APP_URL') . $PET_IMG_FOLDER . '/',
    'DEFAULT_AVATAR_IMAGE_URL' => env('APP_URL') . 'assets/img/defaultAvatar.jpeg',
    'PROJECT_LOGO_IMAGE_URL' => env('APP_URL') . 'assets/img/lifespotLogo/',
    'MDB' => [
        'SITE_MDB_URL' => env('APP_URL') . 'assets/MDB/MDB-Pro_4.8.5/',
        'SITE_MDB_JQUERY_URL' => env('APP_URL') . 'assets/MDB/MDB-Pro_4.8.5/js/jquery-3.4.1.min.js',
        'FONT_AWESOME_CSS_PATH' => 'https://use.fontawesome.com/releases/v5.8.2/css/all.css'
    ],
    'PROJECT_IMAGE_URL' => env('APP_URL') . 'assets/img/',
    'ESTATE_IMG_FOLDER' => $ESTATE_IMG_FOLDER,
    'ESTATE_IMG_URL' => env('APP_URL') . $ESTATE_IMG_FOLDER . '/',
    'PROFILE_IMG_FOLDER' => $PROFILE_IMG_FOLDER,
    'PROFILE_IMG_URL' => env('APP_URL') . $PROFILE_IMG_FOLDER . '/',
    'SITE_IMG_FOLDER' => $SITE_IMG_FOLDER,
    'SITE_IMG_URL' => env('APP_URL') . $SITE_IMG_FOLDER . '/',
    'SITE_IDLE_TIME_MINUTES' => $SITE_IDLE_TIME_MINUTES,
    'TAB_ESTATE_MEMBER'=>env('APP_URL').'estate/members',
    'TAB_KID_MEMBER'=>env('APP_URL').'kid/members'
];

