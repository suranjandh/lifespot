<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskSkip extends Model
{
    protected $table = 'task_skips';

    protected $primaryKey = 'task_skip_id';

    protected $guarded = ['task_skip_id'];

    public $timestamps = false ;


    public static function task_skip_keys($task_ids)
    {
        $task_only_skips = TaskSkip::whereIn('task_skip_task_id', $task_ids)
            ->where('task_skip_user_id', auth()->user()->id)
            ->where('task_skip_status', 1)
            ->get();
        $task_skips_plus_deletes = TaskSkip::whereIn('task_skip_task_id', $task_ids)
            ->where('task_skip_user_id', auth()->user()->id)
            ->get();
        $task_skip_keys = array(
            0=>array(),
            1=>array()
        );
        foreach ($task_skips_plus_deletes as $task_skip) {
            $task_skip_keys[0][] = $task_skip->task_skip_task_id . '||' . $task_skip->task_skip_sub_category;
        }
        foreach ($task_only_skips as $task_skip) {
            $task_skip_keys[1][] = $task_skip->task_skip_task_id . '||' . $task_skip->task_skip_sub_category;
        }
        return $task_skip_keys;
    }
}
