<?php

namespace Modules\Activity\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Container\Entities\Container;
use Yajra\DataTables\Facades\DataTables;

class ActivityController extends Controller
{
    public $model;
    public $data;
    public $base_view;
    public function __construct(Activity $activity)
    {
        $this->model = $activity;
        $this->middleware('permission:activity-list', ['only' => ['index','DatatableAjax','show']]);
        $this->middleware('permission:activity-delete', ['only' => ['destroy']]);
        $this->data = [
            'base_route' => 'activity',
            'base_role'=>'activity',
            'panel_name' => 'Activity',
            'name' => 'activity',
            'columns' => $this->model->getColumns(),
            'icon' => '<i class="font-icon font-icon-zigzag"></i>',
            'order_column' => 3,
            'order_by' => 'desc'
        ];
        $this->base_view = 'activity::activities';
    }

    public function index(Request $request)
    {
        $route = route($this->data['base_route'].'.data');
        return view(parent::LoadView($this->base_view.'.index'),compact('route'));
    }

    public function DatatableAjax(Request $request)
    {
        $all_data = $this->model::join('users','users.id','activity_log.causer_id')->select('users.name as user_name','activity_log.*');
        $datatables =  DataTables::of($all_data)
        ->addColumn('action', function ($val) {
            $data = $this->data;
            return view($this->base_view.".components.action_buttons",compact('val','data'))->render();
        })
        ->editColumn('created_at', function ($val) {
            $created_at = Carbon::parse($val->created_at);
            return '<span class="label label-pill label-primary">'.date_format($created_at,'F d, Y g:i A').'</span>';
        })
        ->addIndexColumn()
        ->escapeColumns('status');
        return $datatables->make(true);
    }

    public function destroy(Request $request)
    {
        if($this->model::find($request->id)->delete()){
            return true;
        }else{
            return false;
        }
    }

    public function show($id)
    {
        $log_data = Activity::where('activity_log.id',$id)->first();
        if($log_data){
            $log = $log_data->getChangesAttribute();
            return view(parent::LoadView($this->base_view.'.show'),compact('log','log_data'));
        }else{
            abort(404);
        }

    }
}
