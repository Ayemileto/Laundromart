<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'users';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
                                        'firstname',
                                        'lastname',
                                        'username',
                                        'email', 
                                        'phone',
                                        'password',
                                        'verification_code',
                                        'created_at',
                                        'updated_at',
                                        'is_banned',
                                        'is_staff',
                                        'is_superadmin',
                                        'email_verified',
                                        'status',
                                        'avatar'
                                ];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
    protected $afterDelete          = [];
    

    public function updateUser($id, $update_array)
    {
        $this->set($update_array);
        $this->where('id', $id);
        return $this->update();        
    }

    public function isStaff()
    {
        $u = $this->select('is_staff')->where('id', userId())->first();
        
        if(empty($u))
        {
            return $this->logOut();
        }

        if($u['is_staff'] === 'yes')
        {
            return true;
        }
        return false;
    }

    function isSuperAdmin($user_id = null)
    {
        $user_id = is_numeric($user_id) ? $user_id : userId();

        $u = $this->select('is_superadmin')->where('id', $user_id)->first();
                
        if($user_id === null && empty($u))
        {
            return $this->logOut();
        }

        if($u['is_superadmin'] === 'yes')
        {
            return true;
        }
        return false;
    }

    public function markEmailAsVerified($id)
    {
        $this->set(['email_verified' => 'yes', 'status' => 'active']);
        $this->where('id', $id);
        return $this->update();
    }

    public function ban($id)
    {
        $this->set(['is_banned' => 'yes', 'status' => 'inactive']);
        $this->where('id', $id);
        return $this->update();
    }

    public function unban($id)
    {
        $this->set(['is_banned' => 'no', 'status' => 'active']);
        $this->where('id', $id);
        return $this->update();
    }

    public function getUserEmail($id)
    {
        $u = $this->select('email')->where('id', $id)->first();

        if(!empty($u['email']))
        {
            return $u['email'];
        }

        return null;
    }

    public function logOut()
    {
        $session    = \Config\Services::session();

        $session->remove('user_details');

		if (isset($_COOKIE['Remember']))
		{
			unset($_COOKIE['Remember']); 
			setcookie('Remember', null, -1, '/'); 
        }
        
        return redirect()->to(fullUrl(route_to('home')));
    }
}
