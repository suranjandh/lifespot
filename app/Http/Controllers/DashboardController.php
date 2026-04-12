<?php

namespace App\Http\Controllers;

use App\Activity;
use App\CalendarEvent;
use App\Helpers\Helper;
use App\Services\Pdf;
use App\Task;
use App\TaskKid;
use App\TaskSkip;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    protected $pdf;

    public function __construct(Pdf $pdf)
    {
        $this->middleware('auth');
        $this->pdf = $pdf;
    }

    public function check_session()
    {
        if (Auth::check()) {
            User::find(\auth()->user()->id)->update(['user_sessions_last_active' => time()]);
            return Helper::success_message("");
        } else {
            return Helper::error_message("Your session has expired. Please login again.");
        }
    }

    /*    private function switch_login($user_id)
        {
            $user = User::find($user_id);
            Auth::logout();
            Auth::login($user);
        }*/


    public function log_spouse_to_husband()
    {
        $user_obj = new User();
        $husband = $user_obj->get_users_husband_user_join_account();
        if ($husband) {
            $user = User::find($husband->id);
            $user->spouse_logged = \auth()->user()->id;
            $user->user_sessions_last_active = time();
            $user->save();
            Auth::logout();
            Auth::login($user);
        }
        return redirect()->route('estate_index');
    }

    public function switch_from_husband_to_spouse()
    {
        $user_spouse_id = \auth()->user()->spouse_logged;
        $user_spouse = User::find($user_spouse_id);
        if ($user_spouse) {
            $user = User::find(\auth()->user()->id);
            $user->spouse_logged = 0;
            $user->user_sessions_last_active = '';
            $user->save();
            Auth::logout();
            Auth::login($user_spouse);
        }
        return redirect()->route('estate_index');
    }

    public function index()
    {

        //$estate_found = Estate::where('estate_user_id', auth()->user()->id)->first();
        //$spouse_found = Spouse::all();
        // $data = compact('estate_found', 'spouse_found');
        $estate_found = auth()->user()->estate;
        $data = compact('estate_found');
        return view('project.estates.index', $data);
    }

    public function ajax_activity_log()
    {
        $activities = auth()->user()->activities;
        $inputs = Input::all();
        return view('project.estates.activity.activity_log', compact('activities', 'inputs'));
    }

    public function ajax_calendar_events()
    {
        $CalendarEvent = new CalendarEvent();
        $calendar_events = $CalendarEvent->calendar_events_set;
        return view('project.estates.events.calendar_events', compact('calendar_events'));
    }

    public function ajax_add_tasks()
    {
        $task = null;
        if (\auth()->user()->user_access == 1) {
            $task = new TaskKid();
        } else {
            $task = new Task();
        }
        $task_items = $task->tasks_on_dashboard();

        $out = (string)View::make('project.estates.tasks.task_panel', compact('task_items'));
        return Helper::success_message('', [
            'task_count' => count($task_items['task_messages']),
            'task_skip_count' => count($task_items['task_skip_messages']),
            'task_panel' => $out
        ]);
        // return view('project.estates.tasks.task_panel', compact('task_items'));
    }

    public function ajax_skip_task()
    {
        $task_skip_task_id = Input::get('task_skip_task_id');
        $task_skip_user_id = auth()->user()->id;
        $task_skip_sub_category = Input::get('task_skip_sub_category') ? Input::get('task_skip_sub_category') : '';
        $task_skip_status = 1; // skip
        $task_skip_data = compact('task_skip_task_id', 'task_skip_user_id', 'task_skip_sub_category', 'task_skip_status');
        $task_skip_search_data = compact('task_skip_task_id', 'task_skip_user_id', 'task_skip_sub_category');
        $task_skip = TaskSkip::where($task_skip_search_data)->get();
        if (count($task_skip) > 0) {
            TaskSkip::where($task_skip_search_data)->update($task_skip_data);
        } else {
            TaskSkip::create($task_skip_data);
        }

        return Helper::success_message('Task Skipped !');
    }

    public function ajax_delete_task()
    {
        $task_skip_task_id = Input::get('task_skip_task_id');
        $task_skip_user_id = auth()->user()->id;
        $task_skip_sub_category = Input::get('task_skip_sub_category') ? Input::get('task_skip_sub_category') : '';
        $task_skip_status = 2; // skip
        $task_skip_data = compact('task_skip_task_id', 'task_skip_user_id', 'task_skip_sub_category', 'task_skip_status');
        $task_skip_search_data = compact('task_skip_task_id', 'task_skip_user_id', 'task_skip_sub_category');
        $task_skip = TaskSkip::where($task_skip_search_data)->get();
        if (count($task_skip) > 0) {
            TaskSkip::where($task_skip_search_data)->update($task_skip_data);
        } else {
            TaskSkip::create($task_skip_data);
        }

        return Helper::success_message('Task Deleted !');
    }

    public function dashboard_counts()
    {
        $result = array(
            'total_member_count' => 0,
            'total_document_count' => 0
        );
        $members = \auth()->user()->members;
        $result['total_member_count'] = $members ? count($members) : 0;
        $documents = \auth()->user()->documents;
        $result['total_document_count'] = $documents ? count($documents) : 0;
        echo json_encode($result);
        die();
    }

    public function print_snapshot()
    {
        // beneficiary
        $print =  Input::get('print');
        $id = Input::get('id');
        $view = 'project.estates.Snapshots.cards.print.'.$print ;
        return response($this->pdf->generate($view,compact('id')), 200)->withHeaders([
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "{$this->pdf->action()}; filename='{$print}.pdf'",
        ]);
    }
}
