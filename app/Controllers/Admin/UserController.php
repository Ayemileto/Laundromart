<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserBanReasonModel;
use App\Models\DepositModel;
use App\Models\InvestmentModel;
use App\Models\TransactionModel;
use App\Models\WithdrawalModel;

class UserController extends BaseController
{
    public function __construct()
    {
        // $this->DepositModel       = new DepositModel();
        // $this->InvestmentModel    = new InvestmentModel();
        // $this->TransactionModel   = new TransactionModel();
        // $this->WithdrawalModel    = new WithdrawalModel();
    }

################################################################
##########           FETCH ALL USER ACCOUNT           ##########
################################################################
    public function index($status)
    {
        $status = strtolower($status);
        $title = $current_nav = $status.'_users';


        if($status)
        {
            if($status == 'active' || $status == 'inactive')
            {
                $this->AuthModel->where('status', $status);
            }
            elseif($status == 'email_not_verified')
            {
                $this->AuthModel->where('email_verified', 'no');
            }
            elseif($status == 'banned')
            {
                $this->AuthModel->where('is_banned', 'yes');
            }
        }

        $this->AuthModel->where('is_staff', 'no');

        $data = [
            'view'              => 'admin/users/index',
            "parent_nav"        => "users",
            "current_nav"       => $current_nav ?? "users",

			'title'             => lang("Site.".$title),
            'meta_description'  => lang("Site.".$title),
            'users'             =>  $this->AuthModel->paginate(100),
            'pager'             => $this->AuthModel->pager
		];


        echo view(adminLayout(), $data);
    }

################################################################
##########          VIEW SPECIFIC USER ACCOUNT        ##########
################################################################
    public function view(int $id)
    {
        $this->AuthModel->where('is_staff', 'no');
        $user = $this->AuthModel->where('id', $id)->first();

        if(empty($user))
        {
            show_404();
        }

        $data = [
            'user'                => $user,
        ];
        
        echo view(adminTheme()."/admin/users/view", $data);
    }

    public function listUserSelect2()
    {// Search user in select2 dropdown
        $userList = [];

        if(!empty($this->request->getGet('term')))
        {
            $term = trim($this->request->getGet('term'));

            $users = $this->AuthModel->like('email', $term)->findAll();
        
            foreach($users as $user)
            {
                $userList[] = [
                    "id"    => $user['id'],
                    "text"  => $user['email'],
                ];        
            }
        }
        
        return $this->respond([
            "results"   => $userList
        ]);
    }
################################################################
##########     PERFORMING ACTIONS ON USER ACCOUNT     ##########
################################################################
    public function edit($id)
    {
        $this->AuthModel->where('is_staff', 'no');
        $user = $this->AuthModel->where('id', $id)->first();

        if(empty($user))
        {
            show_404();
        }

        $data = [
            'user'                => $user,
        ];
        
        echo view(adminTheme()."/admin/users/edit", $data);
    }

    public function update($id)
    {
        if(!$this->validate([
            "lastname"   => ['label' => 'Auth.fields.firstname', 'rules' => 'required|trim'],
            "username"   => ['label' => 'Username',          'rules' => 'required|trim|max_length[50]|is_unique[users.username,id,{id}]'],
            "email"      => ['label' => 'Email',             'rules' => 'required|trim|valid_email|is_unique[users.email,id,{id}]'], 
            "phone"      => ['label' => 'Auth.fields.phone',     'rules' => 'required|trim|is_unique[users.phone,id,{id}]'],
        ]))
        {
            return $this->fail($this->validator->getErrors());
		}
        else
        {
			if($this->AuthModel->updateUser($id, $this->request->getPost()))
			{
                return $this->respond([
                    "status"       => 200,
                    "error"        => null,
                    "messages"      => lang("Site.success"),
                    "redirect_to"  => "",
                ]);
			}
		}
        return $this->fail("An Error Occured");
    }

    public function markEmailAsVerified($id)
    {
        if($this->AuthModel->markEmailAsVerified($id))
        {
            return $this->respond([
                'status'    => 200,
                'error'     => NULL,
                'messages'  => lang('Site.success'),
            ]);
        }
        return $this->fail(lang('an_error_occurred'));
    }

    public function ban()
    {
        if($this->AuthModel->ban($this->request->getPost('user_id')))
        {
            if(!empty($this->request->getPost('reason')))
            {
                $UserBanReasonModel = new UserBanReasonModel();
                $UserBanReasonModel->insert(
                    [
                        'user_id'       => $this->request->getPost('user_id'),
                        'reason'        => $this->request->getPost('reason'),
                        'created_at'    => date('Y-m-d H:i:s')
                    ]
                );
            }

            return $this->respond([
                'status'    => 200,
                'error'     => NULL,
                'messages'  => lang('Site.success'),
            ]);
        }
        return $this->fail(lang('an_error_occurred'));
    }

    public function unban($id)
    {
        if($this->AuthModel->unban($id))
        {
            return $this->respond([
                'status'    => 200,
                'error'     => NULL,
                'messages'  => lang('Site.success'),
            ]);
        }
        return $this->fail(lang('an_error_occurred'));
    }

    public function delete($id)
    {
        $this->AuthModel->where('id', $id);
        if($this->AuthModel->delete())
        {
            return $this->respond([
                'status'    => 200,
                'error'     => NULL,
                'messages'  => lang('Site.success'),
            ]);
        }
        return $this->fail(lang('an_error_occurred'));
    }

################################################################
##########            CREATE USER ACCOUNT             ##########
################################################################
    public function create()
    {
        $title = lang('Site.create_user');

        $this->AuthModel->where('is_staff', 'no');

        $data = [
			'title'               => $title,
            'meta_description'    => $title,
            ];
        
        echo view(adminTheme()."/admin/users/create", $data);   
    }

    public function save()
    {
        if(!$this->validate([
            "lastname"   => ['label' => 'Auth.fields.firstname', 'rules' => 'required|trim'],
            "username"   => ['label' => 'Username',          'rules' => 'required|trim|max_length[50]|is_unique[users.username,id,{id}]'],
            "email"      => ['label' => 'Email',             'rules' => 'required|trim|valid_email|is_unique[users.email,id,{id}]'], 
            "phone"      => ['label' => 'Auth.fields.phone',     'rules' => 'required|trim|is_unique[users.phone,id,{id}]'],
        ]))
        {
            return $this->fail($this->validator->getErrors());
		}
        else
        {
			if($this->AuthModel->insert($this->request->getPost()))
			{
                return $this->respond([
                    "status"        => 200,
                    "error"         => null,
                    "messages"      => lang("Site.success"),
                    "redirect_to"   => "",
                ]);
			}
		}
        return $this->fail("An Error Occured");
    }
}