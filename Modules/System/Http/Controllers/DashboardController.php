<?php

namespace Modules\System\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        return view("system::dashboard.index");
    }

    public function FetchSessionsViewsUsers()
    {
        try {
            $todays_data = Analytics::performQuery(
                Period::days(0),
                'ga:sessions',
                [
                    'metrics' => 'ga:sessions, ga:pageviews, ga:users',
                    'dimensions' => 'ga:yearMonth'
                ]
            )->totalsForAllResults;
            $previous = Analytics::performQuery(
                Period::days(1),
                'ga:sessions',
                [
                    'metrics' => 'ga:sessions, ga:pageviews, ga:users',
                    'dimensions' => 'ga:yearMonth'
                ]
            )->totalsForAllResults;
            $yesterdays_data['ga:sessions'] = $previous['ga:sessions'] - $todays_data['ga:sessions'];
            $yesterdays_data['ga:pageviews'] = $previous['ga:pageviews'] - $todays_data['ga:pageviews'];
            $yesterdays_data['ga:users'] = $previous['ga:users'] - $todays_data['ga:users'];
            $sessions_percent_change = GetPercentageIncDec($todays_data['ga:sessions'],$yesterdays_data['ga:sessions']);
            $users_percent_change = GetPercentageIncDec($todays_data['ga:users'],$yesterdays_data['ga:users']);
            $views_percent_change = GetPercentageIncDec($todays_data['ga:pageviews'],$yesterdays_data['ga:pageviews']);
            return response()->json(array(
                'success' => true,
                'sessions_view' => view("system::dashboard.ajax.session_today",compact('todays_data','yesterdays_data','sessions_percent_change'))->render(),
                'users_view' => view("system::dashboard.ajax.users_today",compact('todays_data','yesterdays_data','users_percent_change'))->render(),
                'page_view' => view("system::dashboard.ajax.page_views_today",compact('todays_data','yesterdays_data','views_percent_change'))->render()
            ), 200);
        } catch (\Exception $e) {
            return response()->json(array(
                'success' => false,
            ), 500);
        }

    }


    public function FetchTopReferrers(Request $request)
    {
        try{
            $data = Analytics::fetchTopReferrers(Period::days(30));
            return response()->json(array(
                'success' => true,
                'view' => view("system::dashboard.ajax.top_referrers",compact('data'))->render()
            ), 200);
        }catch (\Exception $e) {
            return response()->json(array(
                'success' => false,
            ), 500);
        }
    }

    public function FetchMostVisitedPage(Request $request)
    {
        try{
        $data = Analytics::fetchMostVisitedPages(Period::days(0),30);
        return response()->json(array(
            'success' => true,
            'view' => view("system::dashboard.ajax.most_visited_page",compact('data'))->render()
        ), 200);
        }catch (\Exception $e) {
            return response()->json(array(
                'success' => false,
            ), 500);
        }
    }

    public function FetchUserType(Request $request)
    {
        $data = Analytics::fetchUserTypes(Period::days(0));
        return $data;
    }

    public function FetchRealTimeUser(Request $request)
    {
        try{
            $data = Analytics::getAnalyticsService()->data_realtime->get('ga:'.env('ANALYTICS_VIEW_ID'), 'rt:activeVisitors')->totalsForAllResults['rt:activeVisitors'];
            return response()->json(array(
                'success' => true,
                'view' => view("system::dashboard.ajax.active_users",compact('data'))->render()
            ), 200);
        }catch (\Exception $e) {
            return response()->json(array(
                'success' => false,
            ), 500);
        }
    }



}
