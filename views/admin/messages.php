<?php
require "views/partials/admin_header.php";

$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$filtered_messages = array_filter($messages, function ($message) use ($search_query) {
    return stripos($message['content'], $search_query) !== false;
});


// Default to all messages if no search query is provided
if ($search_query === '') {
    $filtered_messages = $messages;
}

$items_per_page = 20;
$current_page = max(1, isset($_GET['page']) ? (int) $_GET['page'] : 1);
$start_index = ($current_page - 1) * $items_per_page;
$paginated_messages = array_slice($filtered_messages, $start_index, $items_per_page);
$total_items = count($filtered_messages);
$total_pages = ceil($total_items / $items_per_page);
?>

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0 text-success">messages</h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <form class="docs-search-form row gx-1 align-items-center" method="GET" action="">
                                    <div class="col-auto">
                                        <input type="text" id="search-docs" name="search"
                                            value="<?= htmlspecialchars($search_query) ?>"
                                            class="form-control search-docs" placeholder="Search">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn app-btn-secondary">Search</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal fade" id="editProfileModal" tabindex="-1"
                                aria-labelledby="editProfileModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="/admin/message_update/<?= htmlspecialchars($message['id']); ?>"
                                            method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editProfileModalLabel">Edit message</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>message ID</label>
                                                        <input type="text" class="form-control" name="id"
                                                            value="<?= htmlspecialchars($message['id']); ?>" readonly>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Customer ID</label>
                                                        <input type="text" class="form-control" name="customer_id"
                                                            value="<?= htmlspecialchars($message['customer_id']); ?>">
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        <label>Admin ID</label>
                                                        <textarea class="form-control" name="admin_id"
                                                            rows="2"><?= htmlspecialchars($message['admin_id']); ?></textarea>
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <label>Content</label>
                                                        <input type="text" class="form-control" name="content"
                                                            value="<?= htmlspecialchars($message['content']); ?>">
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <label>Status</label>
                                                        <input type="text" class="form-control" name="status"
                                                            value="<?= htmlspecialchars($message['status']); ?>">
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <label>Created At</label>
                                                        <input type="text" class="form-control" name="create_at"
                                                            value="<?= htmlspecialchars($message['created_at']); ?>">
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <label>Updated At</label>
                                                        <input type="text" class="form-control" name="updated_at"
                                                            value="<?= htmlspecialchars($message['updated_at']); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>




                            <!-- Create message Modal -->
                            <div class="modal fade" id="createmessageModal" tabindex="-1"
                                aria-labelledby="createmessageModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="/admin/message_create" method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createmessageModalLabel">Create New message
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="id" class="form-label">message ID</label>
                                                    <input type="text" class="form-control" id="id" name="id" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="customer_id" class="form-label">Customer ID</label>
                                                    <input type="text" class="form-control" id="customer_id"
                                                        name="customer_id" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="message_date" class="form-label">message Date</label>
                                                    <textarea class="form-control" id="message_date" name="message_date"
                                                        rows="2" required></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <input type="text" class="form-control" id="status" name="status"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="coupon_id" class="form-label">Coupon ID</label>
                                                    <input type="text" class="form-control" id="coupon_id"
                                                        name="message_id">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="total_amount" class="form-label">Total Amount</label>
                                                    <input type="text" class="form-control" id="total_amount"
                                                        name="total_amount" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save message</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-hover table-bmessageless shadow-sm rounded">
                <thead class="table-success">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Customer ID</th>
                        <th>Admin ID</th>
                        <th>Content</th>
                        <th>status</th>
                        <th>Created At</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($paginated_messages as $message): ?>
                        <tr class="text-center">
                            <td><?= htmlspecialchars($message['id']); ?></td>
                            <td><?= htmlspecialchars($message['customer_id']); ?></td>
                            <td><?= htmlspecialchars($message['admin_id']); ?></td>
                            <td><?= htmlspecialchars($message['content']); ?></td>
                            <td><?= htmlspecialchars($message['status']); ?></td>
                            <td><?= htmlspecialchars($message['created_at']); ?></td>
                            <td>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <style>

            </style>
            <div class="row">
                <div class="col">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <?php if ($current_page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link"
                                        href="?page=<?= $current_page - 1; ?>&search=<?= htmlspecialchars($search_query); ?>"
                                        aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php for ($page = 1; $page <= $total_pages; $page++): ?>
                                <li class="page-item <?= $page === $current_page ? 'active' : ''; ?>">
                                    <a class="page-link"
                                        href="?page=<?= $page; ?>&search=<?= htmlspecialchars($search_query); ?>"><?= $page; ?></a>
                                </li>
                            <?php endfor; ?>
                            <?php if ($current_page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link"
                                        href="?page=<?= $current_page + 1; ?>&search=<?= htmlspecialchars($search_query); ?>"
                                        aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<style>


      /* Apply a box-shadow and hover effect to each table row */
tr {
    background-color: #fff;
    transition: transform 0.2s, box-shadow 0.2s;
}

tr:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(25, 135, 84, 0.1);
}

/* Styling for table cells */
td {
    padding: 1rem;
    font-weight: 500;
    border: 1px solid #ddd;
}

/* Header styling similar to card header */
thead th {
    background: linear-gradient(135deg, #28a745, #34c759);
    color: white;
    font-weight: 600;
    text-align: center;
    padding: 1rem;
}

/* Focus effect for better readability */
td:hover {
    background-color: #f1f1f1;
}

/* Responsive padding for smaller screens */
@media (max-width: 768px) {
    td {
        padding: 0.75rem;
    }
}

    
    
    </style>


<?php
require "views/partials/admin_footer.php";
?>