@if ($search_result)
    <ul id="guardian-member-list" style="width: 350px">
        <li style="width: 350px;background-color:  #2bbbad;color: white"><i class="fa fa-window-close guardian_prediction_close"></i></li>
        @foreach ($search_result as $member)
            @php
            $member_image =  Config::get('constants.DEFAULT_AVATAR_IMAGE_URL');

            if($member->member_is_dependent == 1 && $member && trim($member->member_image) != ''){
                $member_image =    Config::get('constants.DEPENDENT_PROFILE_IMG_URL') . '/' . $member->member_image.'?rand='.rand(1,1000) ;
            }elseif($member && trim($member->member_image) != ''){
                $member_image =  Config::get('constants.SITE_BASE_URL') . Config::get('constants.MEMBER_IMG_FOLDER') . '/' . $member->member_image.'?rand='.rand(1,1000) ;

            }
            @endphp
            <li class='guardian-member-search_li guardian_prediction_pet_add' data-member-id="{{$member->member_id}}" style="height: 65px;width: 350px;background-color: #2bbbad;color: white;border: dotted 1px white">
                <span><img src="{{$member_image}}" style="float: left;height: 40px;width: auto">
                    <span style="margin-left: 5px">{{ $member->member_first_name . ' ' . $member->member_last_name }}</span></span>

            </li>
        @endforeach
    </ul>
@endif
