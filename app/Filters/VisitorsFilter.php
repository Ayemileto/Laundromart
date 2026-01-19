<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class VisitorsFilter implements FilterInterface
{
	/**
	 * Do whatever processing this filter needs to do.
	 * By default it should not return anything during
	 * normal execution. However, when an abnormal state
	 * is found, it should return an instance of
	 * CodeIgniter\HTTP\Response. If it does, script
	 * execution will end and that Response will be
	 * sent back to the client, allowing for error pages,
	 * redirects, etc.
	 *
	 * @param RequestInterface $request
	 * @param array|null       $arguments
	 *
	 * @return mixed
	 */
	public function before(RequestInterface $request, $arguments = null)
	{
        try
        {
            helper('cookie');
            if(empty(get_cookie("visited")))
            {
                $expires_at     = strtotime("tomorrow") - time();
                set_cookie("visited", "1", $expires_at);
                
                $x = new \App\Models\VisitorsModel();
                $y = $x->where("date", date("Y-m-d"))->first();
                
                if(!empty($y))
                {
                    $x->set("total_visitors", "total_visitors+1", FALSE);
                    $x->where("date", date("Y-m-d"));
                    $x->update();
                }
                else
                {
                    $x->insert(["total_visitors" => 1, "date" => date("Y-m-d")]);
                }
                return $request;
            }
        }
        catch(\CodeIgniter\Database\Exceptions\DatabaseException $e)
        {

        }
        catch (\Exception $e) {

        }
        return;
	}

	/**
	 * Allows After filters to inspect and modify the response
	 * object as needed. This method does not allow any way
	 * to stop execution of other after filters, short of
	 * throwing an Exception or Error.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param array|null        $arguments
	 *
	 * @return mixed
	 */
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		//
	}
}
