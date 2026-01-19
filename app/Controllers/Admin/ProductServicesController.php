<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductServicesModel;

class ProductServicesController extends BaseController
{
    public function __construct()
    {
        $this->ProductServicesModel  = new ProductServicesModel();
    }

	public function index()
	{
        $data = [
            "view"              => "admin/product_services/index",
            "parent_nav"        => "products",
            "current_nav"       => "product_services",

            "title"             => lang("Site.product_services"),
            "meta_description"  => lang("Site.product_services"),
            "product_services"   => $this->ProductServicesModel->findAll(),
        ];
    
        echo view(adminLayout(), $data);
	}

    public function add()
    {
        echo view(adminTheme().'/admin/product_services/add');
    }
    
    public function save()
    {
        if(!$this->validate([
            "name"            => ['label' => 'Site.service_name',   'rules' => 'trim|required|max_length[255]|is_unique[product_services.name]'], 
        ]))
        {
            return $this->fail($this->validator->getErrors());
        }
        else
        {
            if($this->ProductServicesModel->insert($this->request->getPost()))
            {
                return $this->respondCreated([
                    "status"      => 200,
                    "error"       => null,
                    "messages"    => "success",
                    "redirect_to" => "",
                ]);
            }

            return $this->fail("An Error Occured.");
        }
    }

    public function edit($id)
    {
        $data['service']    = $this->ProductServicesModel->where('id', $id)
                                    ->first();
        
        if(empty($data['service']))
        {
            show_404();
        }

        echo view(adminTheme().'/admin/product_services/edit', $data);
    }
    
    public function delete($id)
    {
        $this->ProductServicesModel->where("id", $id);
        if($this->ProductServicesModel->delete())
        {
            return $this->respond([
                "status"    => 200,
                "error"     => NULL,
                "messages"  => "success",
            ]);
        }
        return $this->fail("An Error Occurred.");
    }
}
