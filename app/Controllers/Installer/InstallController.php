<?php

namespace App\Controllers\Installer;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class InstallController extends \CodeIgniter\Controller
{
    use ResponseTrait;

    public function index()
    {
        if(env('installer.finish'))
        {
            helper('Site');
            return redirect()->to(fullUrl(route_to('home')));
        }

        $data['step'] = env('installer.step') ?? 1;
        $data['progress'] = ($data['step'] / 4) * 100;

        echo view('installer/index', $data);
    }

    public function save()
    {
        $step = trim($this->request->getPost('step'));
        if($step == 1)
        {
            return $this->setupDatabase();
        }

        if($step == 2)
        {
            return $this->setupWebsite();
        }
        
        if($step == 3)
        {
            return $this->setupSuperAdmin();
        }
        
        if($step == 4)
        {
            if($this->setupData())
            {
                // DELETE THE INSTALLER
                // @unlink(APPPATH.'/Controllers/Installer');
                // @unlink(APPPATH.'/Views/Installer');
            }

            helper("Site");
            return $this->respondCreated([
                "status"            => 200,
                "error"             => null,
                "messages"          => "success",
                "redirect_to"       => fullUrl(route_to('home')), 
            ]);
        }

        return $this->fail(lang('Site.an_error_occurred'));
    }

    public function setupDatabase()
    {
        try{
            $custom = [
                'hostname'  => $this->request->getPost('database_host'),
                'username'  => $this->request->getPost('database_user'),
                'password'  => $this->request->getPost('database_password'),
                'database'  => $this->request->getPost('database_name'),
                'DBDriver'  => $this->request->getPost('database_driver'),
            ];
            $db = \Config\Database::connect($custom);
            
            $migrate = \Config\Services::migrations(null, $db);

            $migrate->ensureTable();
        }
        catch(\CodeIgniter\Database\Exceptions\DatabaseException $e)
        {
            return $this->fail($e->getMessage());
        }

        // IF NO EXCEPTION WAS THROWN WHILE CONNECTING TO THE DATABASE, SAVE DETIALS TO .ENV FILE
        $this->writeEnvFile(2);
        
        return $this->respondCreated([
            "status"                        => 200,
            "error"                         => null,
            "messages"                      => "success",
            "js_callback_function"          => 'nextStep',
            "js_callback_function_params"   => 2
        ]);
    }

    public function setupWebsite()
    {
        try{
            $migrate = \Config\Services::migrations();
            $migrate->latest();
        }
        catch(\CodeIgniter\Database\Exceptions\DatabaseException $e)
        {
            return $this->fail($e->getMessage());
        }

        $seeder = \Config\Database::seeder();
        try{ $seeder->call('AppSettingsSeed'); } catch(\Exception $e) {}
        try{ $seeder->call('PermissionSeed'); } catch(\Exception $e) {}
        try{ $seeder->call('PaymentGatewaySeed'); } catch(\Exception $e) {}
        try{ $seeder->call('ProductsServicesSeed'); } catch(\Exception $e) {}

        $update_data = [
                    [
                            "key"   => "site_name",
                            "value" => $this->request->getPost("site_name")
                    ],
                    [
                        "key"   => "site_title",
                        "value" => $this->request->getPost("site_title")
                    ]
                ];

        if(!empty($this->request->getFile('logo')) && $this->request->getFile('logo')->isValid())
        {
            $file     = $this->request->getFile('logo');
            $fileName = "logo.".$file->getExtension();
            $file->move(APPPATH."../public/assets/img/", $fileName);

            $image = \Config\Services::image()
            ->withFile(APPPATH."../public/assets/img/$fileName")
            ->resize(125, 125, false)
            ->save(APPPATH."../public/assets/img/$fileName");
            
            $update_data[] = [
                "key"       => "logo",
                "value"     => $fileName,
            ];
        }


        $AppSettingsModel = new \App\Models\AppSettingsModel();
        $AppSettingsModel->updateBatch($update_data, 'key');
        
        $this->writeEnvFile(3);
        
        return $this->respondCreated([
            "status"                        => 200,
            "error"                         => null,
            "messages"                      => "success",
            "js_callback_function"          => 'nextStep',
            "js_callback_function_params"   => 3
        ]);
    }

    public function setupSuperAdmin()
    {
        if(!$this->validate([
            "firstname"         => ['label' => 'Firstname',         'rules' => 'required|trim|max_length[50]'],
            "lastname"          => ['label' => 'Lastname',          'rules' => 'required|trim|max_length[50]'],
            "username"          => ['label' => 'Username',          'rules' => 'required|trim|max_length[50]|is_unique[users.username]'],
            "email"             => ['label' => 'Email',             'rules' => 'required|trim|valid_email|is_unique[users.email]'], 
            "phone"             => ['label' => 'Phone Number',      'rules' => 'required|trim|is_unique[users.phone]'], 
            "password"          => ['label' => 'Password',          'rules' => 'required|trim|min_length[8]'], 
            "confirm_password"  => ['label' => 'Confirm Password',  'rules' => 'required|trim|min_length[8]|matches[password]'], 
        ]))
        {
            return $this->fail($this->validator->getErrors());  
        }
        
        $AuthModel              = new \App\Models\AuthModel();
        $AuthModel->Insert([
            'firstname'         => $this->request->getPost("firstname"),
            'lastname'          => $this->request->getPost("firstname"),
            'username'          => $this->request->getPost("username"),
            'email'             => $this->request->getPost("email"),
            'phone'             => $this->request->getPost("phone"),
            'password'          => password_hash($this->request->getPost("password"), PASSWORD_DEFAULT),
            'status'            => "active",
            'email_verified'    => "yes",
            'is_staff'          => "yes",
            'is_superadmin'     => "yes",
            'created_at'        => date("Y-m-d H:i:s"),
        ]);

        $this->writeEnvFile(4);

        return $this->respondCreated([
            "status"                        => 200,
            "error"                         => null,
            "messages"                      => "success",
            "js_callback_function"          => 'nextStep',
            "js_callback_function_params"   => 4
        ]);
    }

    public function setupData()
    {
        $seeder = \Config\Database::seeder();
        
        if(!empty($this->request->getPost('users')))
        {
            try{ $seeder->call('UserSeed'); } catch(\Exception $e) {}
        }
        
        if(!empty($this->request->getPost('products')))
        {
            try{ $seeder->call('ProductsSeed'); } catch(\Exception $e) {}
            try{ $seeder->call('ProductsServicesPricesSeed'); } catch(\Exception $e) {}
        }

        if(!empty($this->request->getPost('subscription_plans')))
        {
            try{ $seeder->call('PlansSeed'); } catch(\Exception $e) {}
        }

        if(!empty($this->request->getPost('pages')))
        {
            try{ $seeder->call('PagesSeed'); } catch(\Exception $e) {}
        }

        return true;
    }

    public function writeEnvFile($nextStep)
    {
        $post = $this->request->getPost();
        $env_file_path = APPPATH.'../.env';

        if(!file_exists($env_file_path))
        {
            copy(APPPATH.'../env', $env_file_path);
        }
        
        $default_env   = file($env_file_path);
        $new_env       = [];
        
        foreach($default_env as $m)
        {
            if(preg_match('/installer.step/', $m))
            {
                $m = "installer.step = $nextStep\n";
            }

            if(!empty($post['database_host']) && preg_match('/database.default.hostname/', $m))
            {
                $m = "database.default.hostname = $post[database_host]\n";
            }

            if(!empty($post['database_name']) && preg_match('/database.default.database/', $m))
            {
                $m = "database.default.database = $post[database_name]\n";
            }

            if(!empty($post['database_user']) && preg_match('/database.default.username/', $m))
            {
                $m = "database.default.username = $post[database_user]\n";
            }

            if(!empty($post['database_password']) && preg_match('/database.default.password/', $m))
            {
                $m = "database.default.password = $post[database_password]\n";
            }

            if(!empty($post['database_driver']) && preg_match('/database.default.DBDriver/', $m))
            {
                $m = "database.default.DBDriver = $post[database_driver]\n";
            }

            
            if(!empty($post['site_url']) && preg_match('/app.baseURL/', $m))
            {
                $m = "app.baseURL = $post[site_url]\n";
            }
            
            if($nextStep == 4)
            {
                if(preg_match('/installer.finish/', $m))
                {
                    $m = "installer.finish = true\n";
                }

                if(preg_match('/CI_ENVIRONMENT/', $m))
                {
                    $m = "CI_ENVIRONMENT = production\n";
                }

                if(preg_match('/encryption.key/', $m))
                {
                    helper('text');
                    $encryption_key = str_shuffle(str_shuffle(
                        strtoupper(random_string('crypto', 28))
                        .random_string('crypto', 28)
                        .strtoupper(random_string('md5'))
                        .substr(str_shuffle(
                            "~`!@#$%^&*()_-+=|}{][:;?><,."
                            ."~`!@#$%^&*()_-+=|}{][:;?><,."
                            ."~`!@#$%^&*()_-+=|}{][:;?><,."
                            ), 0, 40)
                    ));

                    $m = "encryption.key = $encryption_key\n";
                }

            }

            $new_env[] = $m;
        }                    

        return file_put_contents($env_file_path, implode('', $new_env));
    }
}