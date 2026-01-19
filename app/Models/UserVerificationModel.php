<?php

namespace App\Models;

use CodeIgniter\Model;

class UserVerificationModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'user_verifications';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
                                        'user_id',
                                        'type',
                                        'token',
                                        'created_at',
                                        'expires_at'
                                    ];

	// Dates
	protected $useTimestamps        = false;
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
    

    public function getVerifyAccountLink($email)
    {
        return $this->insertIfNoneExist($email, "verify_account");
    }

    public function getResetPasswordLink($email)
    {
        return $this->insertIfNoneExist($email, "reset_password");
    }

    public function insertIfNoneExist($email, $type)
    {
        $AuthModel = new AuthModel();
        $user   = $AuthModel->where("email", $email)->first();

        if(empty($user))
        {
            return;
        }
        
        //CHECK IF USER ALREADY GENERATED A LINK FOR THIS PURPOSE BEFORE.
        $verify = $this->where("user_id", $user['id'])->where("type", $type)->first();

        if(!empty($verify))
        {//IF USER ALREADY GENERATED A LINK, CHECK THE EXPIRY DATE
            if($verify["expires_at"] < date("Y-m-d H:i:s", strtotime("+1 HOUR")))
            {//IF THE OLD LINK HAS EXPIRED OR HAS LESS THAN 1 HOUR TO EXPIRE
                $this->where("id", $verify["id"])->delete();
            }
            else
            {
                return fullURL(route_to("verify_user", $verify["id"], $verify["token"]));
            }
        }
        
        return $this->generateNewLink($user['id'], $type);
    }

    public function generateNewLink($user_id, $type)
    {
        helper("text");
        $token = random_string('sha1');

        $insert_data = [
            "user_id"       => $user_id,
            "type"          => $type,
            "token"         => $token,
            "created_at"    => date("Y-m-d H:i:s"),
            "expires_at"    => date("Y-m-d H:i:s", strtotime("+1 DAY")),
        ];

        $this->insert($insert_data);
        return base_url().route_to("verify_user", $this->insertID(), $token);
    }
}
