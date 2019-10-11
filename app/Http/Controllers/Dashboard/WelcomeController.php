<?php

namespace App\Http\Controllers\Dashboard;


use App\Category;
use App\Client;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $categories_count = Category::count();
        $products_count = Product::count();
        $clients_count = Client::count();
        $users_count = User::whereRoleIs('admin')->count();
        $sales_data = Order::selectRaw('year(created_at) year, monthname(created_at) month, SUM(price) sum' )
                      ->groupBY('year' , 'month')
                      ->orderByRaw('min(created_at) desc')
                      ->get();
                      
        

        return view('admin.welcome', compact('categories_count', 'products_count', 'clients_count', 'users_count', 'sales_data'));
    
    }//end of index
    
}//end of controller

