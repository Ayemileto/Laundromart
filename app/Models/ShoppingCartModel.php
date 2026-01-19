<?php

namespace App\Models;

use CodeIgniter\Model;

class ShoppingCartModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'shopping_cart';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
    protected $allowedFields        = [
                                        'user_id',
                                        'product_id',
                                        'product_service',
                                        'quantity',
                                        'subscription_id',
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
    
    public function totalItemsInUserCart()
    {
        $total_items = $this->where('user_id', userId())->countAllResults() ?? 0;

        $cart_data['cart']['total_items'] =  $total_items;
        
        $session    = \Config\Services::session();
        $session->set($cart_data);

        return $total_items;
    }
}
