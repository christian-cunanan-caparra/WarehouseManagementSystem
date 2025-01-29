<? namespace App\Models;

use CodeIgniter\Model;

class InventoryLogModel extends Model
{
    protected $table      = 'inventory_logs';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['product_id', 'action', 'quantity', 'created_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
