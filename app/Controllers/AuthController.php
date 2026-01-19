<?php namespace App\Controllers;
use App\Models\OrderModel;
use App\Models\UserVerificationModel;

use App\ThirdParty\Personal\Mailer;

class AuthController extends BaseController
{
    public function __construct()
    {
        $this->OrderModel       =  new OrderModel();
    }
#####################################
###           PROFILE             ###
#####################################
    public function index()
    {
        $user_id = $this->AuthModel->userId();

        $data = [
            "title"            => "My Profile",
            "meta_description" => "My Profile",
            "user"             => $this->AuthModel->where("id", $user_id)->first(),
            'total_orders'     => $this->OrderModel->where('affiliate_id', $user_id)->countAllResults(),
        ];

        echo view('backend/template/header', $data);
        echo view('backend/template/sidebar');
        echo view('backend/profile');
        echo view('backend/template/footer');
    }

#####################################
###            LOGIN              ###
#####################################
	public function login()
	{
		$data = [
            "view"             => "signin",
            'title'             => getSetting('seo_login_page_title'),
            'keywords'          => getSetting('seo_login_page_keywords'),
            'meta_description'  => getSetting('seo_login_page_description'),
            "next"             => $this->request->getGet("next") ?? fullURL(route_to("dashboard")),
		];

		echo view(authLayout(), $data);
    }
    
    
	public function do_login()
	{
        if(!$this->validate([
            "email"       => ['label' => 'Email',   'rules' => 'required|trim|valid_email'], 
            "password"    => ['label' => 'Password', 'rules' => 'required|trim'], 
        ]))
        {
            return $this->fail($this->validator->getErrors());  
        }
        else
        {
			$result   = $this->AuthModel->where("email", $this->request->getPost('email'))->first();

			if(!empty($result) && password_verify($this->request->getPost('password'), $result["password"]))
			{
                if($result["is_banned"] == "yes")
                {
                    return $this->fail(lang("Auth.user_banned_message"));
                }
                
                if($result["email_verified"] == "no")
                {
                    return $this->fail(lang("Auth.unverified_email_message", ['resend_link' => fullUrl(route_to('resend_verification_link'))]));
                }
                
                if($result["status"] == "inactive")
                {
                    return $this->fail(lang("Auth.invalid_login_details"));
                }

                $user_data["user_details"]["userid"]     = $result["id"];
				$user_data["user_details"]["email"]      = $result["email"];
				$user_data["user_details"]["avatar"]     = $result["avatar"];
                $user_data["user_details"]["username"]   = $result["username"];
                $user_data["user_details"]["firstname"]  = $result["firstname"];
                $user_data["user_details"]["lastname"]   = $result["lastname"];
				$this->session->set($user_data);

                $this->syncCartData($result["id"]);

				if(!empty($this->request->getPost('remember_me')) && $this->request->getPost('remember_me') == 1)
				{
					$ss = serialize([
						"U" => $result["id"],
						"E" => $result["email"],
						"P" => $result["password"]
					]);

					helper('cookie');
					set_cookie("Remember", $ss, 7776000);
				}
                
                if(!empty($this->request->getPost("next")) && $this->request->getPost("next") != fullUrl(route_to('home')))
                {
                    $redirect_to = $this->request->getPost("next"); 
                }
                else
                {
                    $redirect_to = (isStaff() || isSuperadmin()) ? fullURL(route_to("admin_dashboard")) : fullURL(route_to("user_dashboard"));
                }
 
                return $this->respond([
                    "status"        => 200,
                    "error"         => null,
                    "messages"      => lang("Auth.login_successful"),
                    "redirect_to"   => $redirect_to,
                ]);
			}
			else
			{
                return $this->fail(lang("Auth.invalid_login_details"));
			}
		}
    }
    

    public function syncCartData($user_id)
    {
        // SYNC CART DATA STORED IN SESSION WITH DATABASE AFTER LOGIN    
        $shoppingCartModel = new \App\Models\ShoppingCartModel();
     
        if(!empty($this->session->get('cart')['items']))
        {
            // IF THERE ARE CART ITEMS STORED IN SESSION
            $to_insert = $to_update = [];

            foreach($this->session->get('cart')['items'] as $item)
            {
                // FOR EACH ITEM IN SESSION CART, CHECK IF THE ITEM ALREADY
                  //  EXIST IN DATABASE CART, AND ADD OR UPDATE IT.
                
                 $db_product = $shoppingCartModel
                        ->where('user_id', $user_id)
                        ->where('subscription_id', NULL)
                        ->where('product_id', $item['product_id'])
                        ->where('product_service', $item['product_service'])
                        ->first();

                if(empty($db_product))
                {
                    $to_insert[] =
                    [
                        'user_id'           => $user_id,
                        'product_id'        => $item['product_id'],
                        'product_service'   => $item['product_service'],
                        'quantity'          => $item['quantity'],
                    ];    
                }
                elseif($db_product['quantity'] != $item['quantity'])
                {
                    $to_update[] = [
                        'quantity'  => $item['quantity'],
                        'id'        => $db_product['id'],
                    ];
                }
            }

            if(!empty($to_insert))
            {
                $shoppingCartModel->insertBatch($to_insert);
            }
            
            if(!empty($to_update))
            {
                $shoppingCartModel->updateBatch($to_update, 'id');
            }
        }

        //FETCH SYNCED CART FROM DATABASE
        $cart_data = $shoppingCartModel
                        ->select('product_id, product_service, quantity')
                        ->where('user_id', $user_id)
                        ->where('subscription_id', NULL)
                        ->get()->getResultArray();


        $cart['cart']['items'] = $cart_data;
        $cart['cart']['total_items'] = count($cart_data);
        $this->session->set($cart);

        return true;
    }

#####################################
###           REGISTER            ###
#####################################
    public function register()
    {
		$data = [
            "view"              => "register",
            'title'             => getSetting('seo_register_page_title'),
            'keywords'          => getSetting('seo_register_page_keywords'),
            'meta_description'  => getSetting('seo_register_page_description'),
            "meta_description"  => "Create New Account",
		];

        echo view(authLayout(), $data);
    }

    public function do_register()
    {
        if(!$this->validate([
            "firstname"         => ['label' => 'Firstname',         'rules' => 'required|trim|max_length[50]'],
            "lastname"          => ['label' => 'Lastname',          'rules' => 'required|trim|max_length[50]'],
            "username"          => ['label' => 'Username',          'rules' => 'required|trim|max_length[50]|is_unique[users.username]'],
            "email"             => ['label' => 'Email',             'rules' => 'required|trim|valid_email|is_unique[users.email]'], 
            "phone"             => ['label' => 'Phone Number',      'rules' => 'required|trim|is_unique[users.phone]'], 
            "password"          => ['label' => 'Password',          'rules' => 'required|trim|min_length[8]'], 
            "confirm_password"  => ['label' => 'Confirm Password',  'rules' => 'required|trim|min_length[8]|matches[password]'], 
        ]))
        {
            return $this->fail($this->validator->getErrors());  
        }
        else
        {
            $insert_data = $this->request->getPost();

            $insert_data["password"]          = password_hash($insert_data["password"], PASSWORD_DEFAULT);

            if($this->AuthModel->insert($insert_data))
            {
                @sendVerifyAccountEMail($this->request->getPost("email"));

                return $this->respondCreated(
                    [
                        "status"         => 200,
                        "error"          => NULL,
                        "messages"       => "Registration Successful!!! Redirecting...",
                        "redirect_to"    => fullUrl(route_to("login")),
                    ]
                );
            }

            return $this->fail("Unknown Error");
        }
    }

#####################################
###   RESEND VERIFICATION EMAIL   ###
#####################################
    public function resend_verification_link()
    {
        $data = [
            "view"             => "resend_verification_email",
			"title"            => "Resend Verification Link",
            "meta_description" => "Resend Verification Link",
        ];

        echo view(authLayout(), $data);
    }

    public function do_resend_verification_link()
    {
        if(!$this->validate([
            "email"       => ['label' => 'Email',   'rules' => 'required|trim|valid_email'], 
        ]))
        {
            return $this->fail($this->validator->getErrors()); 
        }
        else
        {
            $result   = $this->AuthModel->where("email", $this->request->getPost('email'))->first();

            if(!empty($result["id"]))
            {                
                @sendVerifyAccountEMail($this->request->getPost("email"));

                return $this->respond(
                    [
                        "status"        => 200,
                        "error"         => NULL,
                        "messages"      => "Verification Link Resent!!! Redirecting...",
                        "redirect_to"   => fullUrl(route_to("login")),
                    ]
                );
            }
            else
            {
                return $this->failNotFound(["email" => lang("Auth.email_does_not_exist")]);
            }
        }
    }
#####################################
###        UPDATE ACCOUNT         ###
#####################################
	// public function updateuser()
	// {
	// 	$data = 
	// 	[
    //         "breadcrumb"       => ["Home" => base_url()],
	// 		"title"            => "Update User",
	// 		"meta_description" => "Update User Login Details",
	// 		"user_data"        => $this->AuthModel->where("id", $this->session->userid)->first(),
	// 	];

	// 	echo view('template/header', $data);
	// 	echo view('auth/create_new_password');
	// 	echo view('template/footer');
	// }

	public function do_update()
	{
        if(!$this->validate([
            "firstname"  => ['label' => 'Auth.firstname', 'rules' => 'required|trim'],
            "lastname"   => ['label' => 'Auth.lastname', 'rules' => 'required|trim'],
            "phone"      => ['label' => 'Auth.phone',     'rules' => 'required|trim|is_unique[users.phone,id,{id}]'],
        ]))
        {
            return $this->fail($this->validator->getErrors());
		}
		elseif($this->AuthModel->userId() != $this->request->getPost('id'))
		{
			return $this->fail("An Error Occured");
		}
        else
        {
			$update_array = [
				"firstname" => $this->request->getPost('firstname'),
				"lastname"  => $this->request->getPost('lastname'),
				"phone"     => $this->request->getPost('phone'),
			];

			if($this->AuthModel->updateUser($this->AuthModel->userId(), $update_array))
			{
                return $this->respond([
                    "status"       => 200,
                    "error"        => null,
                    "messages"     => "Profile Updated Successfully",
                    "redirect_to"  => fullUrl(route_to("profile")),
                ]);
			}
		}
        return $this->fail("An Error Occured");
	}

    public function update_password()
    {
        if(!$this->validate([
            "old_password"         => ['label' => 'Old Password',           'rules' => 'required|trim'],
            "new_password"         => ['label' => 'New Password',           'rules' => 'required|trim'],
            "retype_new_password"  => ['label' => 'Retype New Password',    'rules' => 'required|trim|matches[new_password]'],
        ]))
        {
            return $this->fail($this->validator->getErrors());
        }

        $user   = $this->AuthModel->where("id", $this->AuthModel->userId())->first();
        if(!empty($user) && password_verify($this->request->getPost('old_password'), $user["password"]))
        {
            $update_array = [
                "password" => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT)
            ];

            if($this->AuthModel->updateUser($this->AuthModel->userId(), $update_array))
            {
				return $this->respond([
                    "status"       => 200,
                    "error"        => null,
                    "messages"     => lang("Auth.password_updated"),
                    "redirect_to"  => fullUrl(route_to("profile")),
                ]);
            }
            return $this->fail(lang("Auth.password_update_failed"));
        }

        return $this->fail(lang("Auth.invalid_password"));
    }

    public function update_profile_pic()
    {
        if(!$this->validate([
            "upload_picture"  => ['label' => 'General.upload_picture', 'rules' => 'is_image[upload_picture]|max_size[upload_picture,2048]'],
        ]))
        {
            return $this->fail($this->validator->getErrors());
        }

        $user   = $this->AuthModel->where("id", $this->AuthModel->userId())->first();

        if(!empty($user))
        {
            $file                   = $this->request->getFile('upload_picture');
            $update_array["avatar"] = $fileName = $this->AuthModel->userId()."_".$file->getRandomName();
            $file->move(APPPATH."../public/uploads/users/avatars/", $fileName);
            
            
            if($this->AuthModel->updateUser($this->AuthModel->userId(), $update_array))
            {
                if($user["avatar"])
                {
                    $old_fileName = $user["avatar"];
                    @unlink(APPPATH."../public/uploads/users/avatars/$old_fileName");
                }

                $_SESSION["user_details"]["avatar"] = $fileName;

                $image = \Config\Services::image()
                ->withFile(APPPATH."../public/uploads/users/avatars/$fileName")
                ->resize(125, 125, false)
                ->save(APPPATH."../public/uploads/users/avatars/$fileName");
            
                return $this->respond([
                    "status"       => 200,
                    "error"        => null,
                    "messages"     => lang("Profile Picture Successfully Updated"),
                    "redirect_to"  => fullUrl(route_to("profile")),
                ]);
            }
        }
        return $this->fail(lang("Unable to update your profile picture"));
    }

#####################################
###       FORGOT PASSWORD         ###
#####################################
    public function forgot_password()
    {
        $data = [
            "view"             => "forgot_password",
			"title"            => "Forgot Password",
            "meta_description" => "Forgot Password",
            "redirect_to"      => fullUrl(route_to("login")),
		];

        echo view(authLayout(), $data);
    }

    public function do_forgot_password()
    {
        if(!$this->validate([
            "email"       => ['label' => 'Email',   'rules' => 'required|trim|valid_email'], 
        ]))
        {
            return $this->fail($this->validator->getErrors()); 
        }
        else
        {
            $result   = $this->AuthModel->where("email", $this->request->getPost('email'))->first();

            if(!empty($result["id"]))
            {    
                @sendResetPasswordEmail($email);

                return $this->respond(
                    [
                        "status"    => 200,
                        "error"     => NULL,
                        "messages"  => "success",
                    ]
                );
            }
            else
            {
                return $this->failNotFound(["email" => lang("Auth.email_does_not_exist")]);
            }
        }
    }

#####################################
###        RESET PASSWORD         ###
#####################################
    public function reset_password()
    {
        $data = [
            "view"             => "reset_password",
			"title"            => "Reset Password",
            "meta_description" => "Reset Password"
		];

        echo view(authLayout(), $data);
    }

    public function do_reset_password()
    {
        if(!$this->validate([
            "password"         => ['label' => 'Password',           'rules' => 'required|trim'], 
            "retype_password"  => ['label' => 'Retype Password',    'rules' => 'required|trim|matches[password]'], 
        ]))
        {
            return $this->fail($this->validator->getErrors()); 
        }
        else
        {
            $UserVerificationModel = new UserVerificationModel();
            $verify = $UserVerificationModel->where("id", $this->request->getPost("token_id"))
                        ->where("token", $this->request->getPost("token"))->first();
            
            if(!empty($verify) && $verify["expires_at"] > date("Y-m-d H:i:s"))
            {
                $password = password_hash($this->request->getPost("password"), PASSWORD_DEFAULT);
                if($this->AuthModel->updateUser($verify["user_id"], ["password" => $password]))
                {
                    $UserVerificationModel->where("id", $verify["id"])->delete();
                    
                    return $this->respond(
                        [
                            "status"    => 200,
                            "error"     => NULL,
                            "messages"  => lang("Auth.password_updated")
                        ]
                    );
                }
                else
                {
                    return $this->fail(lang("Auth.password_update_failed"));
                }
            }
            else
            {
                return $this->fail(lang("Auth.messages.invalid_token"));
            }
        }
    }

#####################################
###            VERIFY             ###
#####################################
    public function verify($verification_id, $token)
    {
        $UserVerificationModel = new UserVerificationModel();
        
        $verify = $UserVerificationModel->where("id", $verification_id)
                    ->where("token", $token)->first();
        
        if(empty($verify))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        elseif($verify["expires_at"] < date("Y-m-d H:i:s"))
        {
            $UserVerificationModel->where("id", $verify['id'])->delete();
            
            $data['message']    = "Sorry, the reset password link you clicked has expired.
                                    <br> Kindly generate a new link and try again.";
            return view('errors/html/error_410', $data);
        }
        else
        {
            if($verify["type"] == "verify_account" && $this->AuthModel->markEmailAsVerified($verify["user_id"]))
            {
                $UserVerificationModel->where("id", $verification_id)->delete();
                
                $user = $this->AuthModel->where('id', $verify["user_id"])->first();
                if(!empty($user))
                {
                    @sendWelcomeEmail($user['email']);
                }
                
                return redirect()->to(fullUrl(route_to("login")))->with("alert-success", lang("Auth.email_verified_successfully"));
            }

            if($verify["type"] == "reset_password")
            {
                $data = [
                    "view"             => "reset_password",
                    "title"            => "Reset Password",
                    "meta_description" => "Reset Password",
                    "token"            => $verify["token"],
                    "token_id"         => $verify["id"],
                ];

                echo view(authLayout(), $data);
            }
        }

        return redirect()->to(fullUrl(route_to("home")));
    }

#####################################
###            LOGOUT             ###
#####################################
	public function logout()
	{
        return $this->AuthModel->logOut();
	}
}
