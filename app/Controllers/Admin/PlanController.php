<?php namespace App\Controllers\Admin;
use App\ThirdParty\Personal\Mailer;
use App\Controllers\BaseController;
use App\Models\PlanModel;

class PlanController extends BaseController
{
    public function __construct()
    {
        $this->PlanModel       = new PlanModel();
    }
    
############################
######## SUBSCRIPTION PLANS
############################
    public function index()
    {
        $plan = $this->PlanModel->findAll();
     
        $data = [
            "view"              => "admin/plans/index",
            "current_nav"       => "subscription_plans",

            "title"             => lang("Site.all_plans"),
            "meta_description"  => lang("Site.all_plans"),
            "plans"             => $plan,
        ];

        echo view(adminLayout(), $data);
    }

    public function view($id)
    {
        $data['plan'] = $this->PlanModel->where('id', $id)->first();

        echo view(adminTheme().'/admin/plans/view', $data);
    }


    public function add()
    {
        echo view(adminTheme().'/admin/plans/add');
    }

    public function save()
    {
        if(!$this->validate([
            "name"          => ['label' => 'Site.name',          'rules' => 'trim|required|max_length[25]|is_unique[plans.name]'], 
            "tagline"       => ['label' => 'Site.tagline',       'rules' => 'trim|required|max_length[50]'], 
            "monthly_price" => ['label' => 'Site.monthly_price', 'rules' => 'trim|required|numeric'], 
            "status"        => ['label' => 'Site.status',        'rules' => 'trim|required|in_list[active,inactive]'], 
            "features"      => ['label' => 'Site.features',      'rules' => 'required'], 
        ]))
        {
            return $this->fail($this->validator->getErrors());
        }
        else
        {
            $insert_data               = $this->request->getPost();
            $insert_data['features']   = implode(";;", $this->request->getPost('features'));

            if($this->PlanModel->insert($insert_data))
            {
                return $this->respondCreated([
                    "status"   => 200,
                    "error"    => null,
                    "messages"  => "success",
                    "redirect_to" => "",
                ]);
            }
            else
            {
                return $this->fail("An Error Occured.");
            }
        }        
    }


    public function edit($id)
    {
        $data = [
            "plan"              => $this->PlanModel->where("id", $id)->first(),
        ];

        echo view(adminTheme().'/admin/plans/edit', $data);
    }

    public function update($id)
    {
        if(!$this->validate([
            "name"     => ['label' => 'Site.name',        'rules' => 'trim|required|max_length[25]|is_unique[plans.name,id,{plan_id}]'], 
            "tagline"       => ['label' => 'Site.tagline',       'rules' => 'trim|required|max_length[50]'], 
            "monthly_price" => ['label' => 'Site.monthly_price', 'rules' => 'trim|required|numeric'], 
            "status"        => ['label' => 'Site.status',        'rules' => 'trim|required|in_list[active,inactive]'], 
            "features"      => ['label' => 'Site.features',      'rules' => 'required'], 
        ]))
        {
            return $this->fail($this->validator->getErrors());
        }
        else
        {            
            $insert_data               = $this->request->getPost();
            $insert_data['features']    = implode(";;", $this->request->getPost('features'));

            $this->PlanModel->set($insert_data)->where("id", $insert_data["plan_id"]);

            if($this->PlanModel->update())
            {
                return $this->respondCreated([
                    "status"   => 200,
                    "error"    => null,
                    "messages"  => "success",
                    "redirect_to" => "",
                ]);
            }
            else
            {
                return $this->fail("An Error Occured.");
            }
        }        
    }
    
    public function activate($id)
    {
        $this->PlanModel->set(["status" => "active"])->where("id", $id);
        if($this->PlanModel->update())
        {
            return $this->respondCreated([
                "status"   => 200,
                "error"    => null,
                "messages"  => "success",
                "redirect_to" => base_url().route_to("list_plan_admin"),
            ]);
        }
        
        return $this->fail("An Error Occured.");
    }

    public function deactivate($id)
    {
        $this->PlanModel->set(["status" => "inactive"])->where("id", $id);
        if($this->PlanModel->update())
        {
            return $this->respondCreated([
                "status"   => 200,
                "error"    => null,
                "messages"  => "success",
                "redirect_to" => base_url().route_to("list_plan_admin"),
            ]);
        }
    
        return $this->fail("An Error Occured.");
    }

    
    public function delete($id)
    {
        $this->PlanModel->where("id", $id);
        if($this->PlanModel->delete())
        {
            return $this->respond([
                "status"  => 200,
                "error"   => NULL,
                "messages" => "success",
                "redirect_to" => base_url().route_to("list_plan_admin"),
            ]);
        }
        return $this->fail("An Error Occurred.");
    }
}