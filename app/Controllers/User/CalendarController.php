<?php namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\OrderShippingsModel;

class CalendarController extends BaseController
{
    public function __construct()
    {
        $this->OrderShippingsModel = new OrderShippingsModel();
    }

	public function index()
	{
        $data = [
            'view'              => 'user/calendar/index',
            'title'             => lang('Site.calendar'),
            'meta_description'  => lang('Site.calendar'),
        ];

        echo view(userLayout(), $data);
    }
    
    public function fetchItems()
    {
        $start = $this->request->getGet('start');
        $end   = $this->request->getGet('end');
        
        $pickups = $this->OrderShippingsModel
                        ->where('user_id', userId())
                        ->where("pickup_date >= '$start'")
                        ->where("pickup_date <= '$end'")
                        ->findAll();

        $deliveries = $this->OrderShippingsModel
                        ->where('user_id', userId())
                        ->where("delivery_date >= '$start'")
                        ->where("delivery_date <= '$end'")
                        ->findAll();
        
        $calendar = [];
        foreach($pickups as $pickup)
        {
            $pickup_date_time = $pickup['pickup_date'];
            if(!empty($pickup['pickup_time']))
            {
                $pickup_date_time .= ' '.$pickup['pickup_time'];
            }

            $calendar[] = [
                'start'             => $pickup_date_time,
                'url'               => fullUrl(route_to('user_route_order_details', $pickup['order_id'])),
                'backgroundColor'   => '#0073b7',
                'borderColor'       => '#0073b7',
                'textColor'         => '#ffffff'
            ];
            
        }

        foreach($deliveries as $delivery)
        {
            $delivery_date_time = $delivery['delivery_date'];
            if(!empty($delivery['delivery_time']))
            {
                $delivery_date_time .= ' '.$delivery['delivery_time'];
            }

            $calendar[] = [
                'start'             => $delivery_date_time,
                'url'               => fullUrl(route_to('user_route_order_details', $delivery['order_id'])),
                'backgroundColor'   => '#00a65a',
                'borderColor'       => '#00a65a',
                'textColor'         => '#ffffff'
            ];
        }
        
        return $this->respond($calendar);
    }
}
