<?php

namespace App\Controllers;

use App\Models\InventoryModel;

class InventoryController extends BaseController
{
    protected $inventoryModel;

    public function __construct()
    {
        $this->inventoryModel = new InventoryModel();
    }

    public function update($id)
    {
        // Retrieve the inventory item by ID
        $inventoryItem = $this->inventoryModel->find($id);

        if (!$inventoryItem) {
            return redirect()->to('/employee_dashboard')->with('error', 'Item not found.');
        }

        // Get the input data from the form
        $stockLevel = $this->request->getPost('stock_level');

        // Update the inventory item with the new stock level
        $this->inventoryModel->update($id, ['stock_level' => $stockLevel]);

        // Redirect back to the employee dashboard or inventory management page with a success message
        return redirect()->to('/employee_dashboard')->with('success', 'Inventory updated successfully.');
    }
}
