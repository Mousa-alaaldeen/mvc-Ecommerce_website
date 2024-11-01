<?php
require "views/partials/admin_header.php";

$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$filtered_categories = array_filter($categories, function ($category) use ($search_query) {
	return stripos($category['category_name'], $search_query) !== false
		;
});

if ($search_query === '') {
	$filtered_categories = $categories;
}

$items_per_page = 20;
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$current_page = max($current_page, 1);
$start_index = ($current_page - 1) * $items_per_page;
$paginated_categories = array_slice($filtered_categories, $start_index, $items_per_page);
$total_items = count($filtered_categories);
$total_pages = ceil($total_items / $items_per_page);
?>

<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0 text-success">Categories</h1>
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
										<button type="submit" class="btn btn-primary">Search</button>
									</div>
								</form>
							</div>
							<div class="col-auto">
								<a class="btn btn-success" href="#" data-bs-toggle="modal" data-bs-target="#createcategoryModal">
									<i class="bi bi-plus-circle me-2"></i>Create
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<table class="table table-striped table-hover table-borderless shadow-sm rounded">
				<thead class="table-success">
					<tr class="text-center">
						<th>ID</th>
						<th>Image</th>
						<th>Category Name</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($paginated_categories as $category): ?>
						<tr class="text-center">
							<td><?= htmlspecialchars($category['id']); ?></td>
							<td>
								<img src='/public/images/<?= !empty($category['image_url']) ? htmlspecialchars($category['image_url']) : 'path/to/default/image.jpg'; ?>' 
									class="img-thumbnail rounded" style="max-width: 100px;">
							</td>
							<td class="text-truncate" style="max-width: 150px;">
								<?= ucwords(str_replace('-', ' ', strtolower($category['category_name']))); ?>
							</td>
							<td>
								<div class="d-flex align-items-center justify-content-center">
									<a href="/admin/category_edit/<?= htmlspecialchars($category['id']); ?>" class="btn btn-outline-success btn-sm me-2">View</a>
									<form action="/admin/deleteCategory" method="POST" onsubmit="return confirm('Are you sure you want to delete this category? This action cannot be undone!')">
										<input type="hidden" name="categoryId" value="<?= htmlspecialchars($category['id']); ?>">
										<button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
									</form>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<nav class="app-pagination">
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


<script src="assets/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   function confirmDelete(categoryId) {
      Swal.fire({
         title: 'Are you sure?',
         text: "This action cannot be undone!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
         if (result.isConfirmed) {
            window.location.href = `/admin/deleteCategory/${categoryId}`;
         }
      });
   }
</script>