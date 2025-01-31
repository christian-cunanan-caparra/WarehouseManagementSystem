<?php

namespace App\Controllers;

use App\Models\InventoryLogModel;

class InventoryLogController extends BaseController
{



 
    protected $InventoryLogModel;


    public function __construct()
    {
        $this->InventoryLogModel = new InventoryLogModel();
    }

    public function invent()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $role = session()->get('role');

        if ($role === 'Admin') {
            // Fetch all inventory logs
            $data['inventory_logs'] = $this->InventoryLogModel->findAll();

            // Pass the data to the view
            return view('inventory_log', $data); // View for Admin inventory logs
        } else {
            // Handle unauthorized access or redirect to a default page
            return redirect()->to('/login');
        }
    }
}
