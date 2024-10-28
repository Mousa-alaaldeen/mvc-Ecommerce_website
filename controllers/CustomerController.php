<?php

class CustomerController extends Controller {

    // Customer login & registration
    public function login()
    {
//        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            $username = $_POST['email'];
//            $password = $_POST['password'];
//
//            $customer = $this->model('Customer')->login($username, $password);
//
//            if ($customer) {
//                $_SESSION['customer_id'] = $customer->id;
//                header('Location: /customers/index');
//            } else {
//                $this->view('customers/login_and_register', ['error' => 'Invalid login']);
//            }
//        } else {
            $this->view('customers/login_and_register');
//        }
    }

    // Home page for customers
    public function index()
    {
//        $products = $this->model('Product')->getAllProducts();
//        $this->view('customers/index', ['products' => $products]);
        $this->view('customers/index');
    }

    // About Us page
    public function about()
    {
        $this->view('customers/about');
    }

    // Contact Us page
    public function contact()
    {
        $this->view('customers/contact');
    }

    // Products page
    public function shop()
    {
        $products = $this->model('Product')->getProducts();
        $this->view('customers/shop', ['products' => $products]);
//      $this->view('customers/shop');

    }

    // Product details page
    public function productDetails($id)
    {
        $product = $this->model('Product')->getProductById($id);
        $this->view('customers/product_details', ['product' => $product]);
    }

    // Cart page
    public function cart()
    {
        $cart = $_SESSION['cart'];
        $this->view('customers/cart', ['cart' => $cart]);
    }

    // Checkout page
    public function checkout()
    {
        $this->view('customers/checkout');
    }

    // Profile page for customer
    public function profile()
    {
//        $customer = $this->model('Customer')->getCustomerById($_SESSION['customer_id']);
//        $this->view('customers/profile', ['customer' => $customer]);
        $this->view('customers/profile');
    }

    // Customer logout
    public function logout()
    {
        unset($_SESSION['customer_id']);
        session_destroy();
        header('Location: /customers/login_and_register');
    }
}
