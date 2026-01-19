<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RememberMeFilter implements FilterInterface
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
        helper('cookie');

		if(!isLoggedIn() && !empty(get_cookie("Remember")))
		{
            $x       = new AuthModel();

            $user      = unserialize(get_cookie("Remember"));
            $userid    = $user["U"];
            $email     = $user["E"];
            $password  = $user["P"];
            $result    = $x->where("id", $userid)
                                        ->where("email", $email)
                                        ->where("password", $password)
                                        ->first();
            if(!empty($result))
            {
                $user_data["user_details"]["userid"]     = $result["id"];
				$user_data["user_details"]["email"]      = $result["email"];
				$user_data["user_details"]["avatar"]     = $result["avatar"];
                $user_data["user_details"]["username"]   = $result["username"];
                $user_data["user_details"]["firstname"]  = $result["firstname"];
                $user_data["user_details"]["lastname"]   = $result["lastname"];
             
                $session = \Config\Services::session();
                $session->set($user_data);
            }
            else
            {
                unset($_COOKIE['Remember']); 
                setcookie('Remember', null, -1, '/'); 
            }
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
