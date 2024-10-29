<?php
class AdminController extends Controller {

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
        $products = $this->model('Product')->getAllProducts();
        $this->view('admin/manage_products', ['products' => $products]);
    }

    // Manage orders
    public function manageOrders()
    {
        $orders = $this->model('Order')->getAllOrders();
        $this->view('admin/manage_orders', ['orders' => $orders]);
    }
    


    //view Item
    public function viewProduct($id) {
        $product = $this->model('Product')->find($id);
       // var_dump($product);
        $this->view('admin/product_view',['product'=>$product]);

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
public function gitCategory(){
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
       
        $data = [
            'product_name' => $_POST['product_name'],
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'category_id' => $_POST['category_id'],
            'average_rating' => $_POST['average_rating'] ?? 0, 
            'stock_quantity' => $_POST['stock_quantity'],
            'image_url' => $_POST['image_url'] ?? 'default.jpg', 
        ];
    
        $this->model('Product')->createProduct($data);
        $_SESSION['message'] = "Product created successfully!";
        header('Location: /admin/products_view');
        exit;
    }
    

    // Manage customers
    public function manageCustomers()
    {
        $customers = $this->model('Customer')->getAllCustomers();
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


