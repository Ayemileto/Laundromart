<?php
    function settings()
    {
        $cacheName = "settings";
        //CHECK IF A SETTING CACHE ALREADY EXIST AND RETURN IT.
        if(!$settingCache = cache($cacheName))
        {
            $AppSettingsModel = new \App\Models\AppSettingsModel();
            $settings         = $AppSettingsModel->select("key, value")
                                ->findAll();
            $settings = array_column($settings, "value", "key");

            cache()->save($cacheName, $settings, 86400);
            return $settings;
        }

        return $settingCache;
    }

    function getSetting($key)
    {
        return settings()[$key] ?? NULL;
    }

    function isEnabled($key)
    {
        $key = 'enable_'.$key;
        return strtolower(getSetting($key)) == 'yes' ? true : false;
    }

    function currency()
    {
        return getSetting('currency');
    }

    function siteName()
    {
        return getSetting('site_name');
    }

    function siteTitle()
    {
        return getSetting('site_title');
    }

    function siteTimezone()
    {
        return getSetting('timezone');
    }

    function siteLanguage()
    {
        return getSetting('default_language');
    }

    function formatMoney($amount)
    {
        $amount = (float) $amount;
        return currency().' '.number_format($amount, 2);
    }

    function getTax($amount)
    {
        if(getSetting('tax_type') == 'fixed')
        {
            return (float) getSetting('tax_amount');
        }

        if(getSetting('tax_amount') <= 0)
        { 
            return 0.00;
        }

        return number_format((getSetting('tax_amount')/100)*$amount, 2);
    }

    function shoppingCartCount()
    {
        $session    = \Config\Services::session();
        
        if(isset($session->get("cart")["total_items"]))
        {
            return $session->get("cart")["total_items"];
        }
        else
        {
            $cartModel = new \App\Models\ShoppingCartModel();
            return $cartModel->totalItemsInUserCart();
        }
    }
    
    function formatDateTime($dateTime)
    {
        return empty($dateTime) ? 'N/A' : formatDate($dateTime).' '.formatTime($dateTime);
    }
    
    function formatDate($dateTime)
    {
        return empty($dateTime) ? 'N/A' : date(getSetting('date_format'), strtotime($dateTime));
    }
    
    function formatTime($time)
    {
        return empty($time) ? 'N/A' : date(getSetting('time_format'), strtotime($time));
    }

    function getDaysLeft($subscription_date)
    {
        $date_diff = strtotime($subscription_date) - strtotime(date('Y-m-d H:i:s'));
        
        if($date_diff < 0)
        {
            return lang('Site.expired');
        }

        $days_left = round($date_diff / (60 * 60 * 24));
        if($days_left == 1)
        {
            return lang('Site.day_left');
        }

        return lang('Site.days_left', ['days_left' => $days_left]);
    }
    function currentUrl()
    {
        return str_replace('index.php/', '', current_url());
    }

    function previousUrl()
    {
        return str_replace('index.php/', '', previous_url());
    }

    function fullUrl($url)
    {
        return base_url().$url;
    }

    function getProductPriceRange($prices)
    {
        $prices = explode(';;', $prices);
        $min_price = $prices[0] ?? 0;
        $max_price = $prices[1] ?? 0;
        $min_discount_price = $prices[2] ?? 0;
        $max_discount_price = $prices[3] ?? 0;

        if($min_discount_price > 0 && $min_discount_price < $min_price)
        {
            $price_string = "<del>$min_price</del> ".formatMoney($min_discount_price);
        }
        else
        {
            $price_string = formatMoney($min_price);
        }

        if($max_price > $min_price)
        {
            if($max_discount_price > 0 && $max_discount_price < $max_price && $max_discount_price > $min_discount_price)
            {
                $price_string .= " - <del>".formatMoney($max_price)."</del> ".formatMoney($max_discount_price);
            }
            else
            {
                $price_string .= " - ".formatMoney($max_price);
            }
        }

        return $price_string;
    }

    function formatProductServicePrice($price, $discount_price = 0)
    {
        if(!empty($discount_price) && $discount_price > 0)
        {
            return "<del>$price</del> ".formatMoney($discount_price);
        }

        return formatMoney($price);
    }

    function formatProductServicePriceCart($price, $discount_price = 0)
    {
        if(!empty($discount_price) && $discount_price > 0)
        {
            return $discount_price;
        }

        return $price;
    }

    function activePageMenus($section = null)
    {
        $cacheName = "Page_Menus_".strtolower($section);

        // CHECK IF CACHE EXISTS
        if(!$menuCache = cache($cacheName))
        {
            $PageModel = new \App\Models\PageModel();
            $PageModel->where('status', 'active');
            
            if(strtolower($section) === 'top')
            {
                $PageModel->where('top_menu', 'yes');
            }

            if(strtolower($section) === 'bottom')
            {
                $PageModel->where('bottom_menu', 'yes');
            }
            
            $menus = $PageModel->findAll();
            cache()->save($cacheName, $menus, 86400);
            return $menus;
        }

        return $menuCache;
    } 