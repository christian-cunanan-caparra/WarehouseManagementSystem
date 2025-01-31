<h3>Requesting New Products</h3>

            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= esc($product['name']) ?></td>
                            <td><?= esc($product['description']) ?></td>
                            <td><?= esc($product['price']) ?></td>
                            <td>
                                <form action="/admin/activate/<?= $product['id'] ?>" method="post" class="d-inline">
                                    <button type="submit" class="btn btn-activate btn-sm">
                                        <i class="fas fa-check"></i> Accept
                                    </button>
                                </form>
                                <form action="/admin/reject/<?= $product['id'] ?>" method="post" class="d-inline">
                                    <button type="submit" class="btn btn-reject btn-sm">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>