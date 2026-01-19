<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderShippingsModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'order_shippings';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
    protected $allowedFields        = [
                                        'user_id', 'order_id','location_id',
                                        'firstname', 'lastname', 'address',
                                        'address2', 'pickup_date', 'pickup_time',
                                        'delivery_date', 'delivery_time',
                                        'shipping_type', 'pickup_status',
                                        'pickup_message', 'delivery_status',
                                        'delivery_message'
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
