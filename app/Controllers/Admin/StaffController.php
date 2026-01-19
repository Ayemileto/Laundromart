<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Models\StaffRoleModel;

class StaffController extends BaseController
{
    public function __construct()
    {
        $this->RolesModel       = new RolesModel();
        $this->StaffRoleModel   = new StaffRoleModel();
    }

################################################################
##########           FETCH ALL STAFF ACCOUNT          ##########
################################################################
    public function index()
    {
        $data = [
            'view'              => 'admin/staffs/index',
            'parent_nav'        => 'staffs',
            'current_nav'       => 'staff_list',

			'title'             => lang('Site.staff_list'),
            'meta_description'  => lang('Site.staff_list'),
            'staffs'            =>  $this->AuthModel->where('is_staff', 'yes')
                                    ->select('users.*, (SELECT name FROM roles r WHERE r.id=(SELECT role_id FROM staff_roles sr WHERE sr.user_id = users.id)) AS role')
                                    ->findAll(),
		];

        echo view(adminLayout(), $data);
    }

################################################################
##########          VIEW SPECIFIC USER ACCOUNT        ##########
################################################################
    public function view($id)
    {
        $this->AuthModel->where('is_staff', 'yes');
        $staff = $this->AuthModel->where('id', $id)->first();

        if(empty($staff))
        {
            show_404();
        }

        $data = [
            'user'                => $staff,
        ];
        
        echo view(adminTheme().'/admin/users/view', $data);
    }

################################################################
##########             ADD STAFF ACCOUNT              ##########
################################################################
    public function add()
    {
        $data = [
			'title'            => lang('Site.add_staff'),
            'meta_description' => lang('Site.add_staff'),
            'roles'            =>  $this->RolesModel->findAll(),
		];


        echo view(adminTheme().'/admin/staffs/add', $data);
    }

    public function save()
    {
        if(!$this->validate([
            'user_id'           => ['label' => 'Auth.email',                    'rules' => 'required|trim|numeric'],
            'role'              => ['label' => 'Site.role',                     'rules' => 'required|trim|numeric']
        ]))
        {
            return $this->fail($this->validator->getErrors());
        }

        $this->AuthModel->set(['is_staff' => 'yes'])
        ->where('id', $this->request->getPost('user_id'))
        ->update();

        $this->updateStaffRole($this->request->getPost('user_id'), $this->request->getPost('role'));


        return $this->respondCreated(
        [
            'status'         => 200,
            'error'          => NULL,
            'messages'       => lang('Site.success'),
            'redirect_to'    => '',
        ]);
    }

################################################################
##########    PERFORMING ACTIONS ON STAFF ACCOUNT     ##########
################################################################
    
// EDIT STAFF ACCOUNT DETAILS
    public function edit($id)
    {
        $staff = $this->AuthModel->select('users.*, staff_roles.role_id')
                ->where('users.id', $id)
                ->where('is_staff', 'yes')
                ->join('staff_roles',
                'staff_roles.user_id = users.id', 'left')->first();

        if(empty($staff))
        {
            show_404();
        }

        $data = [
            'roles'         => $this->RolesModel->findAll(),
            'staff'         => $staff,
		];

        echo view(adminTheme().'/admin/staffs/edit', $data);
    }

// UPDATE STAFF ACCOUNT DETAILS
    public function update($id)
    {
        if($this->AuthModel->isSuperAdmin($id))
        {
            return $this->fail(lang('Site.that_action_cannot_be_performed_on_a_superadmin_account'));
        }

        if(!$this->validate([
            'firstname'         => ['label' => 'Auth.fields.firstname',         'rules' => 'required|trim|max_length[50]'],
            'lastname'          => ['label' => 'Auth.fields.lastname',          'rules' => 'required|trim|max_length[50]'],
            'email'             => ['label' => 'Auth.fields.email',             'rules' => 'required|trim|valid_email|is_unique[users.email,id,{id}]'],
            'phone'             => ['label' => 'Auth.fields.phone',             'rules' => 'required|trim|is_unique[users.phone,id,{id}]'],
        ]))
        {
            return $this->fail($this->validator->getErrors());
        }

        $this->AuthModel->set($this->request->getPost());
        $this->AuthModel->where('id', $this->request->getPost('id'));

        if(!empty($this->request->getPost('role')) && is_numeric($this->request->getPost('role')))
        {
            $this->updateStaffRole($this->request->getPost('id'), $this->request->getPost('role'));
        }
        
        return $this->respond(
            [
                'status'         => 200,
                'error'          => NULL,
                'messages'       => lang('Site.success'),
                'redirect_to'    => '',
            ]
        );
    }

// UPDATE STAFF ROLE
    public function updateStaffRole($staff_id, $role_id)
    {
        $insert_data = [
            'user_id' => $staff_id,
            'role_id' => $role_id,    
        ];

        $staff_role = $this->StaffRoleModel->where('user_id', $staff_id)->first();
        if(!empty($staff_role))
        {
            if($staff_role == $role_id)
            {
                return true;
            }

            $this->StaffRoleModel->set($insert_data);
            $this->StaffRoleModel->where('user_id', $staff_id);
            return $this->StaffRoleModel->update();
        }
        
        return $this->StaffRoleModel->insert($insert_data);
    }

// REMOVE USER FROM STAFF
    public function remove($id)
    {
        if($this->AuthModel->isSuperAdmin($id))
        {
            return $this->fail(lang('Site.that_action_cannot_be_performed_on_a_superadmin_account'));
        }

        $this->AuthModel->set(['is_staff' => 'no'])
            ->where('id', $id)->where('is_staff', 'yes');
        
        $this->AuthModel->update();

        $this->StaffRoleModel->where('user_id', $id)->delete();
    
        return $this->respond([
            'status'    => 200,
            'error'     => NULL,
            'messages'  => 'success',
        ]);
    }

// DELETE STAFF
    public function delete($id)
    {
        if($this->AuthModel->isSuperAdmin($id))
        {
            return $this->fail(lang('Site.that_action_cannot_be_performed_on_a_superadmin_account'));
        }

        $this->remove($id);

        $this->AuthModel->where('id', $id);
        if($this->AuthModel->delete())
        {
            return $this->respond([
                'status'    => 200,
                'error'     => NULL,
                'messages'  => 'success',
            ]);
        }
        return $this->fail(lang('Site.an_error_occured'));
    }
}