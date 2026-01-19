<?php namespace App\Controllers;

use App\Models\OfficeBranchesModel;

class HomeController extends BaseController
{
    private $SubscriptionModel;
    
    public function __construct()
    {
        $this->OfficeBranchesModel  = new OfficeBranchesModel();
    }

	public function index()
	{
        $data = [
            'view'                  => 'pages/homepage',
            'title'                 => getSetting('seo_homepage_title'),
            'keywords'              => getSetting('seo_homepage_keywords'),
            'meta_description'      => getSetting('seo_homepage_description'),
            'branches'              => $this->OfficeBranchesModel->where('status', 'active')->where('show_on_homepage', 'yes')->findAll(),
        ];

        echo view(frontLayout(), $data);
	}

    public function products()
	{
        $productModel = new \App\Models\ProductModel();
        $productModel->select("products.*,
            (SELECT CONCAT(MIN(psp.price),';;',MAX(psp.price),';;',
            MIN(psp.discount_price),';;',MAX(psp.discount_price))
            FROM products_services_prices psp WHERE psp.product_id = products.id)
                            as prices");
        $productModel->where('status', 'active');

        $data = [
            'view'                  => 'pages/products',
            'title'                 => getSetting('seo_product_page_title'),
            'keywords'              => getSetting('seo_product_page_keywords'),
            'meta_description'      => getSetting('seo_product_page_description'),
            'products'              => $productModel->paginate(15),
            'pager'                 => $productModel->pager,
        ];

        echo view(frontLayout(), $data);
    }
    
    public function product_services($product_id)
    { // used to load product services form in pop up modal
       $productModel = new \App\Models\ProductModel();
       $product = $productModel->where('id', $product_id)
                    ->where('status', 'active')
                    ->first();
        
        if(empty($product))
        {
            show_404();
        }

        
        $productsServicesPricesModel = new \App\Models\ProductsServicesPricesModel();
        $data = [
            'product'          => $product,
            'product_services' => $productsServicesPricesModel->getProductServices($product['id']),
        ];

        echo view(frontTheme().'/modals/product_services', $data);
    }

    public function select_product_services()
    { // Used to load select - option field with product services
       $product_id =  $this->request->getGet('product');

       if(empty($product_id) || !is_numeric($product_id))
       {
            echo "<option value=''></option>";
            exit;
       }

       $productModel = new \App\Models\ProductModel();
       $product = $productModel->where('id', $product_id)
                    ->where('status', 'active')
                    ->first();
        
        if(empty($product))
        {
            echo "<option value=''></option>";
            exit;
        }
        
        $productsServicesPricesModel = new \App\Models\ProductsServicesPricesModel();

        $data = [
            'product_services' => $productsServicesPricesModel->getProductServices($product['id']),
        ];

        echo view(frontTheme().'/forms/product_services', $data);
    }

    public function plans()
	{
        $planModel = new \App\Models\PlanModel();
        $planModel->where('status', 'active');

        $data = [
            'view'                  => 'pages/plans',
            'title'                 => getSetting('seo_plan_page_title'),
            'keywords'              => getSetting('seo_plan_page_keywords'),
            'meta_description'      => getSetting('seo_plan_page_description'),
            'plans'                 => $planModel->findAll(),
        ];

        echo view(frontLayout(), $data);
    }
    
    public function BranchLocator()
    {        
        $data = [
            'view'                  => 'pages/branch-locator',
            'title'                 => getSetting('seo_branch_locator_page_title'),
            'keywords'              => getSetting('seo_branch_locator_page_keywords'),
            'meta_description'      => getSetting('seo_branch_locator_page_description'),
            'branches'              => $this->OfficeBranchesModel->where('status', 'active')->findAll(),
        ];
        
        echo view(frontLayout(), $data);
    }
    
    public function ContactUs()
    {
        $data = [
            'view'                  => 'pages/contact-us',
            'title'                 => getSetting('seo_contact_page_title'),
            'keywords'              => getSetting('seo_contact_page_keywords'),
            'meta_description'      => getSetting('seo_contact_page_description'),
            'branches'              => $this->OfficeBranchesModel->where('status', 'active')->where('show_on_contact_page', 'yes')->findAll(),
        ];
        
        echo view(frontLayout(), $data);
    }

    public function SendContactMessage()
    {
        if(!$this->validate([
            "name"              => ['label' => 'Name',              'rules' => 'required|trim'],
            "email"             => ['label' => 'Email',             'rules' => 'required|trim|valid_email'], 
            "subject"           => ['label' => 'Subject',           'rules' => 'required|trim'],
            "message"           => ['label' => 'Message',           'rules' => 'required|trim'],
        ]))
        {
            return $this->fail($this->validator->getErrors());
        }

        $support_email = getSettings('support_email');

        if(empty($support_email) || !filter_var($support_email, FILTER_VALIDATE_EMAIL))
        {
            $support_email = null;
            $admin = $this->AuthModel->where('is_superadmin', 'yes')->first();

            if(!empty($admin))
            {
                $support_email = $admin['email'];
            }
        }

        if(!empty($support_email) && filter_var($support_email, FILTER_VALIDATE_EMAIL))
        {
            $email = $this->request->getPost('email');
            $name = $this->request->getPost('name');
            $subject = $this->request->getPost('subject');
            $message = $this->request->getPost('message');

            $message = "
                Name: $name \n
                Email: $email \n
                Subject: $subject \n
                Message: $message
            ";
            sendMail("Message from Contact Form", $message, $support_email);

                    
            return $this->respondCreated(
            [
                "status"         => 200,
                "error"          => NULL,
                "messages"       => lang('Site.success'),
            ]);
        }

        return $this->fail("Couldn't send your message due to System Misconfiguration.");
    }

    public function page($slug)
    {
        $PageModel = new \App\Models\PageModel();
        
        $slug = strtolower($slug);
        
        $page = $PageModel->where('slug', $slug)->where('status', 'active')->first();
        if(empty($page))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $data = [
            'view'    => "pages/page",
            'title'   => $page['title'],
            'content' => $page['content'],
        ];

        echo view(frontLayout(), $data);
    }
}
