<?php
require "views/partials/admin_header.php";
$items_per_page = 20;
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$current_page = max($current_page, 1);
$start_index = ($current_page - 1) * $items_per_page;
$paginated_products = array_slice($products, $start_index, $items_per_page);
$total_items = count($products);
$total_pages = ceil($total_items / $items_per_page);
?>
<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0 text-success">Products</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<div class="col-auto">
								<form class="docs-search-form row gx-1 align-items-center">
									<div class="col-auto">
										<input type="text" id="search-docs" name="searchdocs"
											class="form-control search-docs" placeholder="Search">
									</div>
									<div class="col-auto">
										<button type="submit" class="btn app-btn-secondary">Search</button>
									</div>
								</form>
							</div>
							<div class="col-auto">
								<select class="form-select w-auto">
									<option selected="" value="option-1">All</option>
									<option value="option-2">Text file</option>
									<option value="option-3">Image</option>
									<option value="option-4">Spreadsheet</option>
									<option value="option-5">Presentation</option>
									<option value="option-6">Zip file</option>
								</select>
							</div>
							<div class="col-auto">
								<a class="btn app-btn-primary" href="#"><svg width="1em" height="1em"
										viewBox="0 0 16 16" class="bi bi-upload me-2" fill="currentColor"
										xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd"
											d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
										<path fill-rule="evenodd"
											d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
									</svg>Upload File</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="">
				<table class="table table-hover table-borderless shadow-sm rounded">
					<thead class="table-success">
						<tr>
							<th>ID</th>
							<th>Product Image</th>
							<th class="text-start">Product Name</th>
							<th>Description</th>
							<th>Price</th>
							<th>Stock</th>
							<th>Rating</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($paginated_products as $product): ?>
							<tr class="text-center">
								<td><?php echo htmlspecialchars($product['product_id']); ?></td>
								<td>
									<img src='http://localhost/Ecommerce_website.github.io-/<?= !empty($product['image_url']) ? htmlspecialchars($product['image_url']) : 'path/to/default/image.jpg'; ?>'
										class="img-thumbnail" style="max-width: 100px;">
								</td>
								<td class="text-truncate " style="max-width: 150px;"> 
									<?php
									$formattedName = str_replace('-', ' ', strtolower($product['product_name']));
									$formattedName = ucwords($formattedName);
									echo $formattedName;
									?>
								</td>
								<td class="text-truncate" style="max-width: 150px;">
									<?php echo htmlspecialchars($product['description']); ?></td>
								<td>JD<?php echo number_format($product['price'], 2); ?></td>
								<td><?php echo (int) $product['stock_quantity']; ?></td>
								<td><?php echo number_format($product['average_rating'], 1); ?>/5</td>
								<td>
									<a href="/admin/product_view/<?= htmlspecialchars($product['product_id']); ?>"
										class="btn btn-success btn-sm">View</a>
									<a href="/admin/product_delete/<?= htmlspecialchars($product['product_id']); ?>"
										class="btn btn-danger btn-sm ms-2">Delete</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<nav class="app-pagination ">
				<ul class="pagination justify-content-center">
					<li class="page-item <?= $current_page <= 1 ? 'disabled' : '' ?>">
						<a class="page-link" href="?page=<?= $current_page - 1 ?>" tabindex="-1"
							aria-disabled="true">Previous</a>
					</li>
					<?php for ($page = 1; $page <= $total_pages; $page++): ?>
						<li class="page-item <?= $page == $current_page ? 'active' : '' ?>">
							<a class="page-link" href="?page=<?= $page ?>"><?= $page ?></a>
						</li>
					<?php endfor; ?>
					<li class="page-item <?= $current_page >= $total_pages ? 'disabled' : '' ?>">
						<a class="page-link" href="?page=<?= $current_page + 1 ?>">Next</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<?php require "views/partials/admin_footer.php"; ?>
</div>
<script src="assets/js/app.js"></script>
</body>

</html>