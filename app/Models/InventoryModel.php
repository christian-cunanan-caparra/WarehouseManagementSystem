<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryModel extends Model
{
    protected $table = 'inventory';
    protected $primaryKey = 'id';
    protected $allowedFields = ['item_name', 'stock_level', 'price'];

    // Enable automatic timestamping if needed
    protected $useTimestamps = true;
    
    // Function to get all inventory items with error handling
    public function getInventory()
    {
        // Start building the query
        $builder = $this->db->table($this->table);

        // Try to execute the query and catch any failures
        $query = $builder->get();

        if ($query) {
            // If query is successful, return the result
            return $query->getResult(); // Return result as an array of objects
        } else {
            // If query fails, log the error and return false
            log_message('error', 'Database query failed: ' . $this->db->error()['message']);
            return false; // Handle failure as needed
        }
    }

    // Function to update inventory by item ID
    public function updateInventory($id, $data)
    {
        // Ensure the data passed contains valid information
        if (empty($data) || !isset($data['stock_level'])) {
            log_message('error', 'Invalid data for inventory update.');
            return false;
        }

        // Start building the update query
        $builder = $this->db->table($this->table);
        $query = $builder->where('id', $id)->update($data);

        if ($query) {
            // Return true if the update is successful
            return true;
        } else {
            // Log error if the update failed
            log_message('error', 'Database update failed: ' . $this->db->error()['message']);
            return false;
        }
    }
}
