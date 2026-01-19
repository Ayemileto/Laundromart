<?php
    function assetUrl($asset)
    {
        return base_url("assets/$asset");
        // return getSetting('asset_path').'/'.$asset;
    }

    function logo()
    {
        return assetUrl('img/'.getSetting('logo'));
    }
    
    function getUserImg($img = null)
    {
        if(!empty($img))
        {
            return base_url('uploads/users/avatars/'.$img);
        }

        return base_url('assets/img/avatar.png');
    }

    
    function uploadPath()
    {
        return '../'.getSetting('upload_path');
    }

    function productImageUploadPath()
    {
        return APPPATH.uploadPath().'/products';
    }

    function showProductImage($image)
    {
        return base_url(getSetting('upload_path')."/products/$image");
    }