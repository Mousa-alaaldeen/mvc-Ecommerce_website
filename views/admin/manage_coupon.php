<?php
require "views/partials/admin_header.php";

$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$filtered_coupons = array_filter($coupons, function ($coupon) use ($search_query) {
	return stripos($coupon['code'], $search_query) !== false;
});

if ($search_query === '') {
	$filtered_coupons = $coupons;
}

$items_per_page = 20;
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$current_page = max($current_page, 1);
$start_index = ($current_page - 1) * $items_per_page;
$paginated_coupons = array_slice($filtered_coupons, $start_index, $items_per_page);
$total_items = count($filtered_coupons);
$total_pages = ceil($total_items / $items_per_page);
?>

<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0 text-success">coupons</h1>
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

                            <!-- Create Button -->
							<div class="col-auto">
								<a class="btn btn-success text-white d-flex align-items-center rounded-pill px-3 py-2"
									href="#" data-bs-toggle="modal" data-bs-target="#createcouponModal">
									<i class="bi bi-plus-circle me-2"></i> Add New coupons
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

		
			<!-- Create coupon Modal -->
			<div class="modal fade" id="createCouponModal" tabindex="-1" aria-labelledby="createCouponModalLabel"
				aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<form id="createCouponForm" action="/admin/coupon_create" method="POST"
							enctype="multipart/form-data">
							<div class="modal-header p-0">
								<div
									class="w-100 bg-success text-white p-2 d-flex justify-content-between align-items-center">
									<h5 class="modal-title text-white" id="createCouponModalLabel">Create New coupon</h5>
									<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
							</div>
							<div class="modal-body">
								<div class="mb-3">
									<label for="code" class="form-label">Code</label>
									<input type="text" class="form-control" id="code" name="code"
										>
								</div>
								<div class="mb-3">
									<label for="discount" class="form-label">discount</label>
									<textarea class="form-control" id="discount" name="discount" rows="2"
										></textarea>
								</div>
								<div class="row mb-3">
									<div class="col">
										<label for="usage_limit" class="form-label">usage_limit</label>
										<input type="number" class="form-control" id="usage_limit" name="usage_limit" step="0.01"
											>
									</div>
									<div class="col">
										<label for="expiration_date" class="form-label">expiration date</label>
										<input type="number" class="form-control" id="expiration_date"
											name="expiration_date" >
									</div>
								</div>
			
							
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-success text-white">Save coupon</button>
								<button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Close</button>
							</div>
						</form>
					</div>
				</div>
			</div>
            
			<table class="table table-hover table-borderless shadow-sm rounded">
				<thead class="table-success">
					<tr class="text-center">
						<th>ID</th>
						<th>Code</th>
                        <th>Discount</th>
                        <th>usage_limit</th>
                        <th>Expiration Date</th>
                        <th>Created at </th>
                        <th>Updated at</th>
						<th>Actions</th>
					</tr>
				</thead>
                <tbody>
    <?php foreach ($paginated_coupons as $coupon): ?>
        <tr class="text-center">
            <td><?php echo htmlspecialchars($coupon['id']); ?></td>
            <td class="text-truncate" style="max-width: 150px;">
                <?php
                $formattedName = str_replace('-', ' ', strtolower($coupon['code']));
                $formattedName = ucwords($formattedName);
                echo $formattedName;
                
                ?>
                <td><?php echo htmlspecialchars($coupon['discount']); ?></td>
                <td><?php echo htmlspecialchars($coupon['usage_limit']); ?></td>
                <td><?php echo htmlspecialchars($coupon['expiration_date']); ?></td>
                <td><?php echo htmlspecialchars($coupon['created_at']); ?></td>
                <td><?php echo htmlspecialchars($coupon['updated_at']); ?></td>
            </td>
            <td>
            <div style="display: inline-flex; gap: 5px;">
    <a href="/admin/coupon_edit/<?= htmlspecialchars($coupon['id']); ?>" class="btn btn-success btn-sm"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
    <path d="M12 4.5C5.798 4.5 1 10.06 1 12s4.798 7.5 11 7.5S23 13.94 23 12 18.202 4.5 12 4.5zm0 11.5A4.501 4.501 0 017.5 12 4.501 4.501 0 0112 7.5 4.501 4.501 0 0116.5 12 4.501 4.501 0 0112 16zm0-7a2.5 2.5 0 100 5 2.5 2.5 0 000-5z"></path>
</svg>
</a>

<form action="/admin/deleteCoupon" method="POST" onsubmit="return confirm('Are you sure you want to delete this coupon? This action cannot be undone!')">
    <input type="hidden" name="id" value="<?= htmlspecialchars($coupon['id']); ?>">
    <button type="submit" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
  <path d="M6 6h12v2H6V6zm1 2v12c0 1.1.9 2 2 2h6c1.1 0 2-.9 2-2V8H7zm8 2v10h-2V10h2zm-4 0v10h2V10h-2zm-4 0v10h2V10H7z" fill="currentColor"/>
</svg>
</button>
</form>

</div>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

			</table>
			<nav class="app-pagination ">
				<ul class="pagination justify-content-center">
					<li class="page-item <?= $current_page <= 1 ? 'disabled' : '' ?>">
						<a class="page-link bg-primary text-white"
							href="?page=<?= $current_page - 1 ?>&search=<?= urlencode($search_query) ?>" tabindex="-1"
							aria-disabled="true">Previous</a>
					</li>
					<?php for ($page = 1; $page <= $total_pages; $page++): ?>
						<li class="page-item <?= $page == $current_page ? 'active' : '' ?>">
							<a class="page-link <?= $page == $current_page ? 'bg-success text-white' : 'bg-light text-dark' ?>"
								href="?page=<?= $page ?>&search=<?= urlencode($search_query) ?>"><?= $page ?></a>
						</li>
					<?php endfor; ?>
					<li class="page-item <?= $current_page >= $total_pages ? 'disabled' : '' ?>">
						<a class="page-link bg-primary text-white"
							href="?page=<?= $current_page + 1 ?>&search=<?= urlencode($search_query) ?>">Next</a>
					</li>
				</ul>
			</nav>
			
		</div>
	</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
