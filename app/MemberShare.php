<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberShare extends Model
{
    protected $table = 'members_share';

    protected $primaryKey = 'member_share_id';

    protected $guarded = ['member_share_id'];

    public $timestamps = false;

    public static function is_shared($member_share_to_member_id, $member_shared_member_id, $member_share_member_type)
    {
        $member_shared = MemberShare::where([
            'member_share_to_member_id' => $member_share_to_member_id,
            'member_shared_member_id' => $member_shared_member_id,
            'member_share_member_type' => $member_share_member_type
        ])->take(1)->get();
        if (count($member_shared)) {
            return true;
        } else {
            return false;
        }
    }

}
