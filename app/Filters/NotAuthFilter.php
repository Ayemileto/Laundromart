<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class NotAuthFilter implements FilterInterface
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
        helper('Auth');
        helper('Site');

        if(isLoggedIn())
        {//IF THERE IS A LOGGED IN USER, REDIRECT TO DASHBOARD
            if(!empty($request->getGet("next")))
            {
                $redirect_to = $request->getGet("next"); 
            }
            else
            {
                $redirect_to = (isStaff() || isSuperadmin()) ? fullURL(route_to("admin_dashboard")) : fullURL(route_to("user_dashboard"));
            }

            if($request->isAjax())
            {
                return json_encode([
                    "status"        => 200,
                    "error"         => null,
                    "messages"      => "A session is already active. Redirecting...",
                    "redirect_to"   => $redirect_to,
                ]);
            }

            return redirect()->to($redirect_to);
        }
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
