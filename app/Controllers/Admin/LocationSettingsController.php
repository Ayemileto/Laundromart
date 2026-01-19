<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OfficeBranchesModel;
use App\Models\LocationsModel;

class LocationSettingsController extends BaseController
{
    public function __construct()
    {
        $this->OfficeBranchesModel      =  new OfficeBranchesModel();
        $this->LocationsModel           =  new LocationsModel();
    }

	public function index()
	{
        $data = [
            'view'              => 'admin/settings/location/index',
            "parent_nav"        => 'settings',
            "current_nav"       => 'location_settings',
    
            'title'             => lang('Site.location_settings'),
            'meta_description'  => lang('Site.location_settings'),
            'office_branches'   => $this->OfficeBranchesModel->findAll(),
            'locations'         => $this->LocationsModel->findAll(),
        ];
    
    
    
        echo view(adminLayout(), $data);
    }

    public function add()
    {
        echo view(adminTheme().'/admin/settings/location/add');
    }

    public function save()
    {        
        if($this->LocationsModel->insert($this->request->getPost()))
        {
            return $this->respondCreated([
                'status'      => 200,
                'error'       => null,
                'messages'    => 'success',
                // 'redirect_to' => '',
            ]);
        }

        return $this->fail('An Error Occured.');
    }

    public function edit()
    {
        $location = $this->LocationsModel->where('id', $id)->first();

        if(empty($location))
        {
            show_404();
        }

        $data = [
            'location' => $location
        ];
        
        echo view(adminTheme().'/admin/settings/location/edit', $data);
    }

    public function update()
    {
        $this->LocationsModel->set($this->request->getPost());
        $this->LocationsModel->where('id', $this->request->getPost('location_id'));
        if($this->LocationsModel->update())
        {
            return $this->respondCreated([
                'status'      => 200,
                'error'       => null,
                'messages'    => 'success',
                'redirect_to' => '',
            ]);
        }

        return $this->fail('An Error Occured.');
    }

    public function delete($id)
    {
        $this->LocationsModel->where('id', $id);
        if($this->LocationsModel->delete())
        {
            return $this->respondCreated([
                'status'      => 200,
                'error'       => null,
                'messages'    => 'success',
                'redirect_to' => '',
            ]);
        }

        return $this->fail('An Error Occured.');
    }

    public function addBranch()
    {
        echo view(adminTheme().'/admin/settings/location/add_branch');
    }

    public function saveBranch()
    {        
        if($this->OfficeBranchesModel->insert($this->request->getPost()))
        {
            return $this->respondCreated([
                'status'      => 200,
                'error'       => null,
                'messages'    => 'success',
                'redirect_to' => '',
            ]);
        }

        return $this->fail('An Error Occured.');
    }

    public function editBranch($id)
    {
        $branch = $this->OfficeBranchesModel->where('id', $id)->first();

        if(empty($branch))
        {
            show_404();
        }

        $data = [
            'branch' => $branch
        ];
        
        echo view(adminTheme().'/admin/settings/location/edit_branch', $data);
    }

    public function updateBranch()
    {
        $this->OfficeBranchesModel->set($this->request->getPost());
        $this->OfficeBranchesModel->where('id', $this->request->getPost('branch_id'));

        if($this->OfficeBranchesModel->update())
        {
            return $this->respondCreated([
                'status'      => 200,
                'error'       => null,
                'messages'    => 'success',
                'redirect_to' => '',
            ]);
        }

        return $this->fail('An Error Occured.');
    }

    public function deleteBranch($id)
    {
        $this->OfficeBranchesModel->where('id', $id);
        if($this->OfficeBranchesModel->delete())
        {
            return $this->respondCreated([
                'status'      => 200,
                'error'       => null,
                'messages'    => 'success',
                'redirect_to' => '',
            ]);
        }

        return $this->fail('An Error Occured.');
    }
}