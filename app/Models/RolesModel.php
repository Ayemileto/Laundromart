<?php

namespace App\Models;

use CodeIgniter\Model;

class RolesModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'roles';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['name'];

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
    
    public function getRolesWithPermissions()
    {
        $query = "SELECT r.*, (SELECT GROUP_CONCAT(name) FROM permissions p WHERE 
            p.id IN (SELECT permission_id FROM roles_permissions rp WHERE 
            rp.role_id = r.id)) AS permissions  FROM roles r";
        
        return $this->query($query)->getResultArray();
    }
}
