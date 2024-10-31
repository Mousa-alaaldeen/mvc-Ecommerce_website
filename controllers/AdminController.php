<?php
class AdminController extends Controller
{

    // Admin login
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['email'];
            $password = $_POST['password'];

            $admin = $this->model('Admin')->login($username, $password);

            if ($admin) {
                $_SESSION['admin_id'] = $admin->id;
                header('Location: /admin/dashboard');
            } else {
                $this->view('admin/login', ['error' => 'Invalid login']);
            }
        } else {
            $this->view('admin/login');
        }
    }

    // Admin dashboard
    public function dashboard()
    {
        $this->view('admin/dashboard');
    }

    // Manage categories
    public function manageCategory()
    {
        $categories = $this->model('Category')->getAllCategories();
        $this->view('admin/manage_category', ['categories' => $categories]);
    }


    // Manage products
    public function manageProducts()
    {
        $categories = $this->model('Category')->all();
        $products = $this->model('Product')->getAllProducts();
        $this->view('admin/manage_products', ['products' => $products, 'categories' => $categories]);
    }

    // Manage orders
    public function manageOrders()
    {
        $orders = $this->model('Order')->getAllOrders();
        $this->view('admin/manage_orders', ['orders' => $orders]);
    }



    //view Item
    public function viewProduct($id)
    {
        $product = $this->model('Product')->find($id);
        // var_dump($product);
        $this->view('admin/product_view', ['product' => $product]);

    }
  //view Item
  public function viewCustomer($id)
  {
      $customer = $this->model('Customer')->find($id);
      // var_dump($product);
      $this->view('admin/customer_view', ['customer' => $customer]);

  }

    // public function updateProduct($id,$data) {

    //     $product = $this->model('Product')->update($id);
    //    // var_dump($product);
    //     $this->view('admin/product_update',['product'=>$product]);

    // }
    public function editProduct($id)
    {
        $product = $this->model('Product')->find($id);
        $this->view('admin/product_edit', ['product' => $product]);
    }
    //edit Customer
    public function editCustomer($id)
    {
        $customer = $this->model('Customer')->find($id);
        $this->view('admin/Customer_edit', ['customer' => $customer]);
    }
    //update Customer
    
    public function updateCustomer($id)
    {
        $data = [
            'username' => $_POST['username'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'phone_number' => $_POST['phone_number'],
            'address' => $_POST['address'],
            'updated_at' => date('Y-m-d H:i:s')
        ];
    
        if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === 0) {
     
            $targetDir = __DIR__ . "/../public/uploads/";
            

            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            
            $targetFile = $targetDir . basename($_FILES['image_url']['name']);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($imageFileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES['image_url']['tmp_name'], $targetFile)) {
                   
                    $data['image_url'] = "/public/uploads/" . basename($_FILES['image_url']['name']);
                } else {
                    $_SESSION['message'] = "Error uploading image.";
                    return;
                }
            } else {
                $_SESSION['message'] = "Invalid image file type.";
                return;
            }
        } else {
           
            $customer = $this->model('Customer')->find($id);
            $data['image_url'] = $customer['image_url'];
        }
        $customer = $this->model('Customer')->find($id);
        if ($customer) {
            $this->model('Customer')->update($id, $data);
            $_SESSION['message'] = "Customer updated successfully!";
        } else {
            $_SESSION['message'] = "Customer not found!";
        }
        $customer = $this->model('Customer')->find($id);
        $this->view('admin/customer_edit', ['customer' => $customer]);
    }
    
    
    
    public function gitCategory()
    {
        $categories = $this->model('Product')->getProducts();
        $this->view('admin/product_edit', ['Product' => $categories]);

    }

    public function updateProduct($id)
    {
        //dd($id);
        $data = [
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'category_id' => $_POST['category_id'],
            'average_rating' => $_POST['average_rating'],
            'stock_quantity' => $_POST['stock_quantity'],
        ];
        $product = $this->model('Product')->find($id);
        //dd($product);
        $this->model('Product')->update($id, $data);
        $_SESSION['message'] = "Product updated successfully!";
        ;
        $this->view('admin/product_edit', ['product' => $product]);

        var_dump($_POST);
        exit;
    }
    //create Product
    public function createProduct()
    {
        $categories = $this->model('Category')->all();
        if (isset($_POST['product_name'], $_POST['price'], $_POST['description'], $_POST['category_id'], $_POST['stock_quantity'])) {

            $productData = [
                'product_name' => $_POST['product_name'],
                'price' => $_POST['price'],
                'description' => $_POST['description'],
                'category_id' => $_POST['category_id'],
                'average_rating' => $_POST['average_rating'] ?? 0,
                'stock_quantity' => $_POST['stock_quantity'],
            ];
            $productId = $this->model('Product')->create($productData);

            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }


            if ($productId && isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
                $imageName = basename($_FILES['image_url']['name']);
                $imagePath = $uploadDir . $imageName;


                if (move_uploaded_file($_FILES['image_url']['tmp_name'], $imagePath)) {
                    $imageData = [
                        'product_id' => $productId,
                        'image_url' => $imagePath,
                    ];


                    $this->model('ProductImage')->create($imageData);
                    $_SESSION['message'] = "Product created successfully!";
                } else {
                    $_SESSION['message'] = "Failed to upload image.";
                }
            } else {
                $_SESSION['message'] = "Failed to create product or upload image.";
            }
        } else {
            $_SESSION['message'] = "Please fill in all required fields.";
        }


        $products = $this->model('Product')->all();
        $this->view('admin/manage_products', ['products' => $products, 'categories' => $categories]);
    }

    //create Customer
    public function createCustomer()
    {
        if (isset($_POST['username'], $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $_POST['phone_number'])) {
            
            // Check if the email is already in use
            if ($this->model('Customer')->isEmailTaken($_POST['email'])) {
                echo json_encode(['emailTaken' => true]);
                exit();
            }
    
            $customerData = [
                'username' => $_POST['username'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'phone_number' => $_POST['phone_number'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
    
            $customerId = $this->model('Customer')->create($customerData);
    
            // Handle file upload
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
    
    
            $this->view('admin/manage_customers', ['customers' => $this->model('Customer')->all()]);
        } else {
            $_SESSION['message'] = "Please fill in all required fields.";
            $this->view('admin/manage_customers');
        }
    }
    
    //delete Customer
    public function deleteCustomer()
{
    $id = $_POST['id'] ?? null;

    if (!$id || !$this->model('Customer')->find($id)) {
        $_SESSION['error'] = "Customer not found!";
        header("Location: /admin/manage_customers");
        exit;
    }

    $this->model('Customer')->delete($id);

    $_SESSION['message'] = "Customer deleted successfully!";
    header("Location: /admin/manage_customers");
    exit;
}




    // Manage customers
    public function manageCustomers()
    {
        
        $customers = $this->model('Customer')->all();
        $this->view('admin/manage_customers', ['customers' => $customers]);
    }

    // Manage coupons
    public function manageCoupon()
    {
        $coupons = $this->model('Coupon')->getAllCoupons();
        $this->view('admin/manage_coupon', ['coupons' => $coupons]);
    }

    // Handle messages
    public function messages()
    {
        $messages = $this->model('Message')->getAllMessages();
        $this->view('admin/messages', ['messages' => $messages]);
    }

    // Account settings page
    public function accountSettings()
    {
        $admin = $this->model('Admin')->getAdminById($_SESSION['admin_id']);
        $this->view('admin/account_settings', ['admins' => $admin]);
    }

    // Admin logout
    public function logout()
    {
        unset($_SESSION['admin_id']);
        session_destroy();
        header('Location: /admin/login');
    }
}


