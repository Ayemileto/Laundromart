<?php
    function isLoggedIn()
    {
        $session    = \Config\Services::session();
        return (!empty($session->get("user_details")["userid"]) 
                && !empty($session->get("user_details")["email"]));
    }

    function userId()
    {
        $session    = \Config\Services::session();
        return $session->get("user_details")["userid"] ?? NULL;
    }

    function userName()
    {
        $session    = \Config\Services::session();
        return $session->get("user_details")["username"] ?? NULL;
    }

    function firstName()
    {
        $session    = \Config\Services::session();
        return $session->get("user_details")["firstname"] ?? NULL;
    }

    function lastName()
    {
        $session    = \Config\Services::session();
        return $session->get("user_details")["firstname"] ?? NULL;
    }

    function userEmail()
    {
        $session    = \Config\Services::session();
        return $session->get("user_details")["email"] ?? NULL;
    }
    
    function avatar()
    {
        $session    = \Config\Services::session();
        if(!isset($session->get("user_details")["avatar"]))
        {
            return base_url('assets/img/avatar.png');
        }

        return base_url('uploads/users/avatars/'.$session->get("user_details")["avatar"]);
    }

    function isStaff()
    {
        $AuthModel = new \App\Models\AuthModel();
        return $AuthModel->isStaff();
    }

    function isSuperAdmin()
    {
        $AuthModel = new \App\Models\AuthModel();
        return $AuthModel->isSuperAdmin();
    }