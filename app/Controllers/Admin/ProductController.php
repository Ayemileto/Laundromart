<?php namespace App\Controllers\Admin;
use App\ThirdParty\Personal\Mailer;
use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\ProductServicesModel;
use App\Models\ProductsServicesPricesModel;

class ProductController extends BaseController
{
    public function __construct()
    {
        $this->ProductModel                 = new ProductModel();
        $this->ProductServicesModel         = new ProductServicesModel();
        $this->ProductsServicesPricesModel  = new ProductsServicesPricesModel();
    }

############################
######## PRODUCT
############################
    public function index()
    {
        $this->ProductModel->select("products.*,
                (SELECT CONCAT(MIN(psp.price),';;',MAX(psp.price),';;',
                MIN(psp.discount_price),';;',MAX(psp.discount_price))
                FROM products_services_prices psp WHERE psp.product_id = products.id)
                              as prices");

        $data = [
            'view'              => 'admin/products/index',
            'parent_nav'        => 'products',
            'current_nav'       => 'all_products',
            
            'title'             => lang('Site.all_products'),
            'meta_description'  => lang('Site.all_products'),
            'products'          => $this->ProductModel->paginate(20),
            'pager'             => $this->ProductModel->pager,
        ];

        echo view(adminLayout(), $data);
    }

    public function add()
    {
        $product_services = $this->ProductServicesModel->findAll();
        
        if(empty($product_services))
        {
            return view(adminTheme().'/admin/product_services/add');
        }

        
        $data = [
            'product_services'  => $product_services,
        ];

        return view(adminTheme().'/admin/products/add', $data);
    }

    public function save()
    {
        if(!$this->validate([
            'name'            => ['label' => 'Site.product_name',   'rules' => 'trim|required|max_length[50]|is_unique[products.name]'], 
            'description'     => ['label' => 'Site.description',    'rules' => 'trim|max_length[255]'], 
            'picture'         => ['label' => 'Site.picture',        'rules' => 'is_image[picture]|max_size[picture,2048]'], 
        ]))
        {
            return $this->fail($this->validator->getErrors());
        }
        else
        {
            $insert_data     = $this->request->getPost();
            $file            = $this->request->getFile('picture');
            
            $insert_data['file'] = $fileName = $file->getRandomName();
            $file->move(productImageUploadPath(), $fileName);
        
            $image = \Config\Services::image()
            ->withFile(productImageUploadPath()."/$fileName")
            ->resize(200, 200, false)
            ->save(productImageUploadPath()."/$fileName");

            if($this->ProductModel->insert($insert_data))
            {
                $product_id      = $this->ProductModel->insertId();
                $prices          = $insert_data['service_price'];
                $discount_prices = $insert_data['service_discount_price'];
                
                $service_prices = [];
                foreach($prices as $k => $v)
                {
                    if(!empty($v))
                    {
                        $service_prices[]   = [
                                            'product_id'      => $product_id,
                                            'service_id'      => $k,
                                            'price'           => $v,
                                            'discount_price'  => $discount_prices[$k] ?? NULL,
                                    ];
                    }
                }

                if(!empty($service_prices))
                {
                    $this->ProductsServicesPricesModel->insertBatch($service_prices);
                }
                
                return $this->respondCreated([
                    'status'      => 200,
                    'error'       => null,
                    'messages'    => 'success',
                    'redirect_to' => '',
                ]);
            }

            return $this->fail('An Error Occured.');
        }
    }

    public function edit($id)
    {        
        $data = [
            'title'             => lang('Site.edit_product'),
            'meta_description'  => lang('Site.edit_product'),
            'product'           => $this->ProductModel->where('id', $id)->first(),
            'product_services'  => $this->ProductServicesModel->findAll(),
            'product_prices'    => $this->ProductsServicesPricesModel->where('product_id', $id)->findAll()
        ];

        echo view(adminTheme().'/admin/products/edit', $data);
    }

    public function update($id)
    {
        $validates = [
            'name'            => ['label' => 'Site.product_name',   'rules' => 'trim|required|max_length[255]|is_unique[products.name,id,{product_id}]'], 
            'description'     => ['label' => 'Site.description',    'rules' => 'trim|max_length[255]'], 
        ];
        
        if(empty($this->request->getPost('use_previous_image')))
        {
            $validates['picture']  = ['label' => 'Site.upload_picture', 'rules' => 'is_image[picture]|max_size[picture,2048]']; 
        }

        if(!$this->validate($validates))
        {
            return $this->fail($this->validator->getErrors());
        }
        else
        {
            $insert_data     = $this->request->getPost();

            if(empty($this->request->getPost('use_previous_image')) && !empty($this->request->getFile('picture')))
            {
                $old_file   = $this->ProductModel->select('file')->where('id', $insert_data['product_id'])->first();
                
                if(!empty($old_file['file']))
                {
                    $old_fileName = $old_file['file'];
                    @unlink(productImageUploadPath().'/$old_fileName');
                }

                $file                           = $this->request->getFile('picture');
                
                $insert_data['file'] = $fileName = $file->getRandomName();
                $file->move(productImageUploadPath(), $fileName);
            }


            $this->ProductModel->set($insert_data)->where('id', $insert_data['product_id']);
            if($this->ProductModel->update())
            {
                $prices          = $insert_data['service_price'];
                $discount_prices = $insert_data['service_discount_price'];
                                
                $service_prices = [];
                foreach($prices as $k => $v)
                {
                    if(!empty($v))
                    {
                        $service_prices[]   = [
                                        'product_id'      => $insert_data['product_id'],
                                        'service_id'      => $k,
                                        'price'           => $v,
                                        'discount_price'  => $discount_prices[$k] ?? NULL,
                                ];
                    }
                }
            
                $this->ProductsServicesPricesModel->where('product_id', $insert_data['product_id']);
                $this->ProductsServicesPricesModel->delete();
                $this->ProductsServicesPricesModel->insertBatch($service_prices);
                
                return $this->respondCreated([
                    'status'   => 200,
                    'error'    => null,
                    'messages' => 'success',
                    'redirect_to' => '',
                ]);
            }
            else
            {
                return $this->fail('An Error Occured.');
            }
        }
    }
    
    public function activate($id)
    {
        $this->ProductModel->set(['status' => 'active'])->where('id', $id);
        if($this->ProductModel->update())
        {
            return $this->respondCreated([
                'status'   => 200,
                'error'    => null,
                'messages' => 'success'
            ]);
        }
        
        return $this->fail('An Error Occured.');
    }

    public function deactivate($id)
    {
        $this->ProductModel->set(['status' => 'inactive'])->where('id', $id);
        if($this->ProductModel->update())
        {
            return $this->respondCreated([
                'status'   => 200,
                'error'    => null,
                'messages' => 'success'
            ]);
        }
        
        return $this->fail('An Error Occured.');
    }


    public function delete($id)
    {
        $this->ProductsServicesPricesModel->where('product_id', $id);
        $this->ProductsServicesPricesModel->delete();

        $this->ProductModel->where('id', $id);
        if($this->ProductModel->delete())
        {
            return $this->respond([
                'status'   => 200,
                'error'    => NULL,
                'messages' => 'success',
            ]);
        }
        return $this->fail('An Error Occurred.');
    }
}
