<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AppSettingsModel;
use App\Models\PaymentGatewaysModel;
use App\Models\OfficeBranchesModel;
use App\Models\LocationsModel;

class AppSettingsController extends BaseController
{
    public function __construct()
    {
        $this->AppSettingsModel         =  new AppSettingsModel();
        $this->PaymentGatewaysModel     =  new PaymentGatewaysModel();
        $this->OfficeBranchesModel      =  new OfficeBranchesModel();
        $this->LocationsModel           =  new LocationsModel();
    }

	public function index()
	{
		//
    }
    

    public function settings($settingGroup)
    {
        $settingGroup = strtolower($settingGroup);
        $settings     = $this->AppSettingsModel->where('group', $settingGroup)
                                    ->findAll();
        $data = [
            'view'              => 'admin/settings/'.$settingGroup.'_settings',
            "parent_nav"        => 'settings',
            "current_nav"       => $settingGroup.'_settings',

            'title'             => lang('Site.'.$settingGroup.'_settings'),
            'meta_description'  => lang('Site.'.$settingGroup.'_settings'),
            'settings'          => array_column($settings, 'value', 'key'),
        ];

        echo view(adminLayout(), $data);
    }

    
    public function save()
    {
        $post = $this->request->getPost();
        
        $update_data = [];
        
        foreach($post AS $k => $v)
        {
            if($k == 'logo')
            {
                // WE USED AN INPUT FIELD FOR THE LOGO. THIS WILL HAVE AN EMPTY STRING VALUE IF WE DIDN'T CHANGE THE LOGO DURING THE PRESENT UPDATE.
                // WE DON'T WANT TO SAVE THIS EMPTY VALUE, SO WE CONTINUE HERE, AND CHECK IF THE LOGO FIELD CONTINS A VALID FILE AFTER THIS LOOP.
                continue; 
            }
            
            $update_data[] = [
                "key"   => $k,
                "value" => $v
            ];
        }

        if(!empty($this->request->getFile('logo')) && $this->request->getFile('logo')->isValid())
        {
            $update_data[] = 
            [
                'key'           => 'logo',
                'value'         => $this->uploadLogo()
            ];
        }

        if(!empty($this->request->getPost('timezone')) && $this->request->getPost('timezone') != app_timezone())
        {
            $this->updateEnvFile('app.AppTimezone', $this->request->getPost('timezone'));
        }

        $this->AppSettingsModel->updateBatch($update_data, 'key');
        cache()->delete('settings');
        
        return $this->respondCreated(
        [
            "status"         => 200,
            "error"          => NULL,
            "messages"       => "success",
            "redirect_to"    => "",
        ]);
    }

    public function uploadLogo()
    {
        if(!$this->validate([
            "logo"      => ['label' => 'Site.logo', 'rules' => 'is_image[logo]'],
        ]))
        {
            return $this->fail($this->validator->getErrors());
        }
        // DELETE OLD LOGO
        $old_logo = getSetting('logo');
        @unlink(APPPATH."../public/assets/img/$old_logo");

        // SAVE NEW LOGO
        $file       = $this->request->getFile('logo');
        $fileName   = 'logo.'.$file->getExtension();
        
        @unlink(APPPATH."../public/assets/img/$fileName"); // DELETE ANY FILE WITH THE FILENAME (IF ANY)
        $file->move(APPPATH."../public/assets/img/", $fileName);

        // RESIZE NEW LOGO
        $image = \Config\Services::image()
        ->withFile(APPPATH."../public/assets/img/$fileName")
        ->resize(55, 55, false)
        ->save(APPPATH."../public/assets/img/$fileName");

        return $fileName;
    }

    public function paymentSettings()
    {
        $payment_gateways = $this->PaymentGatewaysModel->findAll();
        
        $data = [
            'view'              => 'admin/settings/payment_settings',
            "parent_nav"        => 'settings',
            "current_nav"       => 'payment_settings',

            'title'             => lang('Site.payment_settings'),
            'meta_description'  => lang('Site.payment_settings'),
            'payment_gateways'  => $payment_gateways,
        ];

        
        $pg = [];
        foreach($payment_gateways as $p)
        {// GET THE NAME OF EACH PAYMENT GATEWAY AND SET IT AS THE KEY
            $pg[strtolower($p['name'])]   = $p;
        }


        echo view(adminLayout(), array_merge($data, $pg));
    }

    public function savePaymentSettings()
    {
        $data = [];
        foreach($this->request->getPost() as $post => $value)
        {
            $data = array_merge($data, [ "$post" => "$value" ]);
        }

        $this->PaymentGatewaysModel->set($data);
        $this->PaymentGatewaysModel->where('id', $this->request->getPost('id'));
        $this->PaymentGatewaysModel->update();

        return $this->respondCreated(
        [
            "status"         => 200,
            "error"          => NULL,
            "messages"       => "success",
            "redirect_to"    => "",
        ]);
    }
    
    public function saveDefaultGatewaySettings()
    {
        $this->PaymentGatewaysModel->set([
            'is_default'        => 'no'
        ]);
        $this->PaymentGatewaysModel->where('is_default', 'yes');
        $this->PaymentGatewaysModel->update();
        
        
        $this->PaymentGatewaysModel->set([
            'is_default'        => 'yes'
        ]);
        $this->PaymentGatewaysModel->where('id', $this->request->getPost('is_default'));
        $this->PaymentGatewaysModel->update();

        return $this->respondCreated(
        [
            "status"         => 200,
            "error"          => NULL,
            "messages"       => "success",
            "redirect_to"    => "",
        ]);
    }

    public function updateEnvFile($key, $value)
    {
        $env_file_path = APPPATH.'../.env';
        $default_env   = file($env_file_path);
        $new_env       = [];

        foreach($default_env as $m)
        {
            if(preg_match("/$key/", $m))
            {
                $m = "$key = $value\n";
            }
            
            $new_env[] = $m;
        }

        return file_put_contents($env_file_path, implode('', $new_env));
    }
}