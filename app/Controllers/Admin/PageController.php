<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PageModel;

class PageController extends BaseController
{
    public function __construct()
    {
        $this->PageModel           =  new PageModel();
    }

	public function index()
	{
        $data = [
            'view'              => 'admin/pages/index',
            'current_nav'       => 'pages',
            'title'             => lang('Site.manage_pages'),
            'meta_description'  => lang('Site.manage_pages'),
            // 'payment_methods'   => $paymentGatewaysModel->findAll(),
            'pages'             => $this->PageModel->paginate(100),
            'pager'             => $this->PageModel->pager,
            'system_pages'      => ['home', 'product', 'plans'],
        ];

        echo view(adminLayout(), $data);
    } 

    public function create()
    {
        $data = [
            'view'              => 'admin/pages/create',
            'current_nav'       => 'pages',
            'title'             => lang('Site.create_page'),
            'meta_description'  => lang('Site.create_page'),
        ];

        echo view(adminLayout(), $data);
    }

    public function save()
    {
        if(!$this->validate([
            'name'            => ['label' => 'Site.name',   'rules' => 'trim|required|max_length[255]|is_unique[pages.name]'],
            'title'           => ['label' => 'Site.title',  'rules' => 'trim|max_length[255]'],
        ]))
        {
            return $this->fail($this->validator->getErrors());
        }
        
        $insert_data          = $this->request->getPost();
        $insert_data['slug']  = url_title($this->request->getPost('name'), '-', TRUE);
        
        if($this->PageModel->insert($insert_data))
        {
            $this->clearPageMenuCache();
            return $this->respondCreated([
                'status'      => 200,
                'error'       => null,
                'messages'    => 'success',
                'redirect_to' => fullUrl(route_to("admin_route_pages")),
            ]);
        }

        return $this->fail('An Error Occured.');
    }

    public function edit($id)
    {
        $data = [
            'view'              => 'admin/pages/edit',
            'current_nav'       => 'pages',
            'title'             => lang('Site.edit_page'),
            'meta_description'  => lang('Site.edit_page'),
            'page'              => $this->PageModel->where('id', $id)->first()
        ];

        echo view(adminLayout(), $data);
    }

    public function update($id)
    {
        if(!$this->validate([
            'name'            => ['label' => 'Site.name',   'rules' => 'trim|required|max_length[255]|is_unique[pages.name,id,{page_id}]'],
            'title'           => ['label' => 'Site.title',  'rules' => 'trim|max_length[255]'],
        ]))
        {
            return $this->fail($this->validator->getErrors());
        }
        
        $update_data          = $this->request->getPost();
        $update_data['slug']  = url_title($this->request->getPost('name'), '-', TRUE);
        
        $this->PageModel->set($update_data)->where('id', $this->request->getPost('page_id'));
        if($this->PageModel->update())
        {
            $this->clearPageMenuCache();
            return $this->respondCreated([
                'status'      => 200,
                'error'       => null,
                'messages'    => 'success',
                'redirect_to' => fullUrl(route_to("admin_route_pages")),
            ]);
        }

        return $this->fail('An Error Occured.');
    }

    public function delete($id)
    {
        $this->PageModel->where('id', $id);
        
        if($this->PageModel->delete())
        {
            $this->clearPageMenuCache();
            return $this->respond([
                'status'   => 200,
                'error'    => NULL,
                'messages' => 'success',
            ]);
        }
        return $this->fail('An Error Occurred.');
    }

    public function clearPageMenuCache()
    {
        cache()->delete('Page_Menus_top');
        cache()->delete('Page_Menus_bottom');            
    }
}
