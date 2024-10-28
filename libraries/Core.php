<?php

class Core {
    protected $routes = [
        // Default route to customer index
        '' => 'CustomerController@index',  // This handles the root URL

        // Admin Routes
        'admin/login' => 'AdminController@login',
        'admin/dashboard' => 'AdminController@dashboard',
        'admin/manage_category' => 'AdminController@manageCategory',
        'admin/manage_products' => 'AdminController@manageProducts',
        'admin/manage_orders' => 'AdminController@manageOrders',
        'admin/manage_customers' => 'AdminController@manageCustomers',
        'admin/manage_coupon' => 'AdminController@manageCoupon',
        'admin/messages' => 'AdminController@messages',
        'admin/account_settings' => 'AdminController@accountSettings',
        'admin/logout' => 'AdminController@logout',
        'admin/product_view' => 'AdminController@viewProduct',

        // Super Admin Routes
        'super-admin/login' => 'SuperAdminController@login',
        'super-admin/dashboard' => 'SuperAdminController@dashboard',
        'super-admin/manage_category' => 'SuperAdminController@manageCategory',
        'super-admin/manage_products' => 'SuperAdminController@manageProducts',
        'super-admin/manage_orders' => 'SuperAdminController@manageOrders',
        'super-admin/manage_customers' => 'SuperAdminController@manageCustomers',
        'super-admin/manage_coupon' => 'SuperAdminController@manageCoupon',
        'super-admin/messages' => 'SuperAdminController@messages',
        'super-admin/account_settings' => 'SuperAdminController@accountSettings',
        'super-admin/logout' => 'SuperAdminController@logout',
        'super-admin/manage_admin' => 'SuperAdminController@manageAdmin',

        // Customer Routes
        'customers/login_and_register' => 'CustomerController@login',
        'customers/index' => 'CustomerController@index',
        'customers/about' => 'CustomerController@about',
        'customers/contact' => 'CustomerController@contact',
        'customers/shop' => 'CustomerController@shop',
        'customers/product_details' => 'CustomerController@productDetails',
        'customers/cart' => 'CustomerController@cart',
        'customers/checkout' => 'CustomerController@checkout',
        'customers/profile' => 'CustomerController@profile',
        'customers/logout' => 'CustomerController@logout',
    ];

    public function __construct() {
        $this->dispatch();
    }

    private function dispatch() {
        $url = $this->getUrl();
        
        // Split URL into parts
        $urlParts = explode('/', $url);
        $lastPart = end($urlParts);
    
        // Determine route path and optional ID
        if (ctype_digit($lastPart)) {
            $id = $lastPart;
            $routePath = implode('/', array_slice($urlParts, 0, -1)); // Remove last part for route path
        } else {
            $routePath = $url; // Use full URL as route path
            $id = null;         // No ID
        }
    
        if (isset($this->routes[$routePath])) {
            $route = explode('@', $this->routes[$routePath]);
            $controllerName = $route[0];
            $methodName = $route[1];
    
            if (file_exists('controllers/' . $controllerName . '.php')) {
                require_once 'controllers/' . $controllerName . '.php';
                $controller = new $controllerName;
    
                if (method_exists($controller, $methodName)) {
                    // Call the method with or without ID
                    if ($id !== null) {
                        $controller->$methodName($id);
                    } else {
                        $controller->$methodName();
                    }
                    return;
                } else {
                    die("ERROR: Method $methodName not found in $controllerName.");
                }
            } else {
                die("ERROR: Controller $controllerName not found.");
            }
        } else {
            die("ERROR: Route not found for URL '$url'.");
        }
    }
        

    private function getUrl() {
        $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        $url = trim($url, '/');  // Trim leading and trailing slashes

        if (strpos($url, '?') !== false) {
            $url = strstr($url, '?', true);  // Remove query strings for clean URL
        }

        return $url;
    }
}
