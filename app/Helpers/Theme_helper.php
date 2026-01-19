<?php

    function adminTheme()
    {
        return 'backend/'.getSetting('admin_theme').'_theme';
    }

    function adminLayout()
    {
        return adminTheme().'/layout';
    }

    
    function authTheme()
    {
        return 'auth/'.getSetting('auth_theme').'_theme';
    }

    function authLayout()
    {
        return authTheme().'/layout';
    }

    function userTheme()
    {
        return 'backend/'.getSetting('user_theme').'_theme';
    }

    function userLayout()
    {
        return userTheme().'/layout';
    }

    function frontTheme()
    {
        return 'frontend/'.getSetting('front_theme').'_theme';
    }

    function frontLayout()
    {
        return frontTheme().'/layout';
    }

    function mailTheme()
    {
        return 'email/'.getSetting('mail_template').'_theme';
    }

    function mailLayout()
    {
        return mailTheme().'/layout';
    }