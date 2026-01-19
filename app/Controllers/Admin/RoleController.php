<?php namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\PermissionsModel;
use App\Models\RolesModel;
use App\Models\RolesPermissionsModel;

class RoleController extends BaseController
{
    private $PermissionsModel;
    private $RolesModel;
    private $RolesPermissionsModel;

    public function __construct()
    {
        $this->PermissionsModel = new PermissionsModel();
        $this->RolesModel = new RolesModel();
        $this->RolesPermissionsModel = new RolesPermissionsModel();
    }
################################################################
##########           FETCH ALL STAFF ACCOUNT          ##########
################################################################
    public function index()
    {

        $data = [
            "view"              => "admin/roles/index",
            "parent_nav"        => "staffs",
            "current_nav"       => "roles_and_permission",

            "title"            => lang("Site.roles_and_permission"),
            "meta_description" => lang("Site.roles_and_permission"),
            "roles"            => $this->RolesModel->getRolesWithPermissions(),
		];

        echo view(adminLayout(), $data);
    }
################################################################
##########                ADD NEW ROLE                ##########
################################################################
    public function add()
    {
        $permissions = $this->PermissionsModel->findAll();

        $data = [
			"title"            => lang("Site.add_role"),
            "meta_description" => lang("Site.add_role"),
            "permissions"      => array_column($permissions, 'id', 'name'),
		];

        echo view(adminTheme()."/admin/roles/add", $data);
    }

    public function save()
    {
        if(!$this->validate([
            "name"        => ['label' => 'Site.name', 'rules' => 'trim|required|max_length[255]|is_unique[roles.name]'],
            "permission"  => ['label' => 'Site.permission', 'rules' => 'required'],
        ]))
        {
            return $this->fail($this->validator->getErrors());
        }

        if($this->RolesModel->insert($this->request->getPost()))
        {
            $role_id = $this->RolesModel->insertId();
            $permissions = $this->request->getPost("permission");

            $insert_data = [];
            foreach($permissions as $permission_id)
            {
                $insert_data[] = [
                    "role_id"        => $role_id,
                    "permission_id"  => $permission_id
                ];
            }

            $this->RolesPermissionsModel->insertBatch($insert_data);
        
            return $this->respond([
                "status"        => 200,
                "error"         => null,
                "messages"      => lang('Site.success'),
                "redirect_to"   => '',
            ]);
        }
        
        return $this->fail("Unknown Error");
    }
################################################################
##########    PERFORMING ACTIONS ON STAFF ACCOUNT     ##########
################################################################
    public function edit($id)
    {
        $role = $this->RolesModel->where('id', $id)->first();

        if(empty($role))
        {
            return redirect()->to(previous_url())->with("alert-error", lang("Site.role_not_found"));    
        }
        $role_permissions = $this->RolesPermissionsModel->where('role_id', $id)->get()->getResultArray();
        $role_permissions = array_column($role_permissions, 'permission_id') ?? [];

        $permissions = $this->PermissionsModel->findAll();

        $data = [
			"title"            => lang("Site.edit_role"),
            "meta_description" => lang("Site.edit_role"),
            "permissions"      => array_column($permissions, 'id', 'name'),
            "role"             => $role,
            "role_permissions" => $role_permissions,
		];

        echo view(adminTheme()."/admin/roles/edit", $data);
    }

    public function update($id)
    {
        if(!$this->validate([
            "name"        => ['label' => 'Site.name', 'rules' => 'trim|required|max_length[255]|is_unique[roles.name,id,{id}]'],
            "permission"  => ['label' => 'Site.permission', 'rules' => 'required'],
        ]))
        {
            return $this->fail($this->validator->getErrors());
        }

        $role_id = $this->request->getPost('id');

        $this->RolesModel->set($this->request->getPost());
        $this->RolesModel->where('id', $role_id);
        if($this->RolesModel->update())
        {
            $this->RolesPermissionsModel->where('role_id', $role_id);
            $this->RolesPermissionsModel->delete();

            $permissions = $this->request->getPost("permission");
            
            $insert_data = [];
            foreach($permissions as $permission_id)
            {
                $insert_data[] = [
                    "role_id"        => $role_id,
                    "permission_id"  => $permission_id
                ];
            }

            $this->RolesPermissionsModel->insertBatch($insert_data);

            $cacheName = "Role_".$role_id."_permissions";
            cache()->delete($cacheName);            
        
            return $this->respond([
                "status"        => 200,
                "error"         => null,
                "messages"      => lang('Site.success'),
                "redirect_to"   => "",
            ]);
        }
        
        return $this->fail("Unknown Error");
    }

    public function delete($role_id)
    {
        $this->RolesModel->where('id', $role_id);
        $this->RolesModel->delete();

        $this->RolesPermissionsModel->where('role_id', $role_id);
        $this->RolesPermissionsModel->delete();

        $cacheName = "Role_".$role_id."_permissions";
        cache()->delete($cacheName);            

        return $this->respond([
            "status"        => 200,
            "error"         => null,
            "messages"      => lang('Site.success')
        ]);
    }
}