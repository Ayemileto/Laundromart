<?php

namespace App\Models;

use CodeIgniter\Model;

class PlanModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'plans';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
    protected $allowedFields        = [ 'name',
                                        'tagline',
                                        'duration',
                                        'orders_per_month',
                                        'monthly_price',
                                        'quarterly_price',
                                        'semi_annually_price',
                                        'yearly_price',
                                        'features',
                                        'updated_at',
                                        'status',
                                        'created_at',
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
