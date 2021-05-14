<?php

namespace Modules\System\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\System\Entities\Newsletter;
use Stevebauman\Location\Facades\Location;
use Yajra\DataTables\DataTables;

class NewsletterController extends Controller
{
    public $model;
    public $data;
    public $base_view;
    public function __construct(Newsletter $newsletter)
    {
        $this->model = $newsletter;
        $this->data = [
            'base_route' => 'newsletter',
            'base_role'=>'newsletter',
            'panel_name' => 'Newsletter Subscription',
            'name' => 'newsletter',
            'columns' => $this->model->getColumns(),
            'icon' => '<i class="font-icon font-icon-contacts"></i>',
            'order_column' => 3,
            'order_by' => 'desc'
        ];
        $this->middleware('permission:newsletter-list|newsletter-delete', ['only' => ['index']]);
        $this->middleware('permission:newsletter-delete', ['only' => ['destroy']]);
        $this->middleware('permission:newsletter-show', ['only' => ['show']]);
        $this->base_view = 'system::newsletter';
    }

    public function index(Request $request)
    {
        $route = route($this->data['base_route'].'.data');
        return view(parent::LoadView($this->base_view.'.index'),compact('route'));
    }

    public function DatatableAjax(Request $request)
    {
        $users = $this->model::select(['id','email','ip','created_at']);
        $datatables =  DataTables::of($users)
            ->addColumn('action', function ($val) {
                $data = $this->data;
                return view($this->base_view.".components.action_buttons",compact('val','data'))->render();
            })
            ->editColumn('created_at', function ($val) {
                $created_at = Carbon::parse($val->created_at);
                return '<span class="label label-pill label-primary">'.date_format($created_at,'F d, Y g:i A').'</span>';
            })
            ->addIndexColumn()
            ->escapeColumns('created_at');
            return $datatables->make(true);
    }

    public function show(Request $request,$id)
    {
        $row = $this->model::find($id);
        unset($row['id']);
        $row_data = $row->toArray();
        if($row->ip){
            $ip_result = Location::get($row->ip);
            $country = $ip_result->countryName;
        }else{
            $country = null;
        }
        $modified_data = [
            'country' => $country,
            'created_at' => date('l M j, Y h:i A', strtotime($row->created_at)).' <b><i style="font-size: 12px; color: #ed1c24;">('. $row->created_at->diffForHumans().')</i></b>',
            'updated_at' => date('l M j, Y h:i A', strtotime($row->updated_at)).' <b><i style="font-size: 12px; color: #ed1c24;">('. $row->updated_at->diffForHumans().')</i></b>',
        ];
        $rows = array_merge($row_data,$modified_data);
        return view(parent::LoadView($this->base_view.'.show'),compact('rows'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
        $this->model::find($request->id)->delete();
        return true;
    }
}
