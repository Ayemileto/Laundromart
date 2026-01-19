<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentGatewaysModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'payment_gateways';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
    protected $allowedFields        = [ 'name',
                                        'payment_options',
                                        'public_key',
                                        'secret_key',
                                        'webhook_key',
                                        'extra_var',
                                        'extra_var2',
                                        'extra_var3',
                                        'is_enabled',
                                        'is_default',
                                        'currency',
                                        'created_at'
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
}
