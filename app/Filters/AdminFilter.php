<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
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
        
        if(!isLoggedIn())
        {//REDIRECT TO LOGIN PAGE
            $login = fullUrl(route_to("login")."?next=".currentUrl());
            return redirect()->to($login);
        }
        
        if(isSuperAdmin())
        {
            return $request;
        }

        if(!empty($arguments[0]))
        {
            if($arguments[0] === 'dashboard')
            {
                return $request;
            }

            if(isStaff())
            {//CHECK IF THE PERSON IS A STAFF, AND GET PERMISSIONS
                helper('Permission');
                
                if(has_permission($arguments[0]))
                {
                    return $request;
                }
    
                // IF THE PERSON IS A STAFF BUT DOES'T HAVE THE PERMISSION, REDIRECT TO DMIN DASHBOARD
                $redirect_to = fullUrl(route_to('admin_dashboard'));
            }
            else
            { // IF THE PERSON IS NOT A STAFF, REDIRECT TO USER DASHBOARD
                $redirect_to = fullUrl(route_to('user_dashboard'));
            }
        }
        
        if($request->isAjax())
        {
            return json_encode([
                "status"        => 200,
                "error"         => null,
                "messages"      => lang("Site.access_denied"),
                "redirect_to"   => "",
            ]);
        }

        return redirect()->to($redirect_to)->with("alert-error", lang("Site.access_denied"));
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
