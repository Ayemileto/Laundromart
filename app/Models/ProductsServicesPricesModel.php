<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsServicesPricesModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'products_services_prices';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
    protected $allowedFields        = ['product_id', 'service_id', 'price',
                                        'discount_price'
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
    

    public function getProductServices($product_id)
    {
        return $this->select('products_services_prices.*, product_services.name')
        ->where('products_services_prices.product_id', $product_id)
        ->join('product_services', 'product_services.id = products_services_prices.service_id')
        ->get()->getResultArray();
    }
}
