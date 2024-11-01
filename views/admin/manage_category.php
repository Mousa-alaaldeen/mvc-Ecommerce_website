<?php
require "views/partials/admin_header.php";

$search = isset($_GET['search']) ? $_GET['search'] : '';
$filtered_categories = array_filter($categories, function ($category) use ($search) {
	return stripos($category['category_name'], $search) !== false
	;
});

if ($search === '') {
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
			<div class="row g-3 mb-4 align-items-center justify-content-between shadow-sm p-3 bg-light rounded">
				<div class="row g-3 mb-4 align-items-center justify-content-between">
					<div class="col-auto">
						<h1 class="app-page-title mb-0 text-success fw-bold"
							style="font-size: 2rem; text-shadow: 1px 1px 2px #d4edda;">
							<i class="fas fa-tags me-3"></i>Categories
						</h1>
					</div>
					<div class="col-auto">
						<div class="page-utilities">
							<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
								<div class="col-auto">
									<form class="docs-search-form row gx-1 align-items-center" method="GET" action="">
										<div class="col-auto">
											<input type="text" id="search-docs" name="search"
												value="<?php echo htmlspecialchars($search); ?>"
												class="form-control bg-light border-success rounded-pill"
												placeholder="Search Category....">
										</div>
										<div class="col-auto">
											<button type="submit" class="btn rounded-pill"
												style="background-color: #5bb377; border-color: #5bb377;">
												<i class="fas fa-search text-white"></i>
											</button>

										</div>
									</form>
								</div>
								<div class="col-auto">
									<a class="btn btn-success text-white d-flex align-items-center rounded-pill"
										href="#" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
										<i class="bi bi-plus-circle me-2"></i> Add New Category
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			  <!-- Create Category Modal -->
			  <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="createCategoryForm" action="/admin/category_create" method="POST"
                            enctype="multipart/form-data">
                            <div class="modal-header p-0">
                                <div
                                    class="w-100 bg-primary text-white p-2 d-flex justify-content-between align-items-center">
                                    <h5 class="modal-title text-white" id="createCategoryModalLabel">Create New Category
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="modal-body">

                                <div class="row mb-3">
                                
                                    <div class="col">
                                        <label for="category_name" class="form-label">category name</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name">
                                    </div>
                                </div>
                                <div class="row mb-3">
								<div class="mb-3">
									<label for="image_url" class="form-label">Category Image</label>
									<input type="file" class="form-control" id="image_url" name="image_url"
										accept="image/*" required>
								</div>
                                   
                                </div>

                              
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn app-btn-primary">Create Category</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
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
								<img src='/public/<?= !empty($category['image_url']) ? htmlspecialchars($category['image_url']) : 'path/to/default/image.jpg'; ?>'
									class="img-thumbnail rounded" style="width: 50px; height:35px; ">
							</td>
							<td class="text-truncate" style="max-width: 150px;">
								<?= ucwords(str_replace('-', ' ', strtolower($category['category_name']))); ?>
							</td>
							<td>
								<div class="d-flex align-items-center justify-content-center">
									<a href="/admin/category_edit/<?= htmlspecialchars($category['id']); ?>"
										class="btn btn-success btn-sm me-2"><i class="bi bi-pencil"></i></a>
									<form action="/admin/deleteCategory" method="POST"
										onsubmit="return confirm('Are you sure you want to delete this category? This action cannot be undone!')">
										<input type="hidden" name="categoryId"
											value="<?= htmlspecialchars($category['id']); ?>">
										<button type="submit" class="btn btn-danger btn-sm"><i
												class="bi bi-trash"></i></button>

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
							href="?page=<?= $current_page - 1 ?>&search=<?= urlencode($search) ?>" tabindex="-1"
							aria-disabled="true">Previous</a>
					</li>
					<?php for ($page = 1; $page <= $total_pages; $page++): ?>
						<li class="page-item <?= $page == $current_page ? 'active' : '' ?>">
							<a class="page-link <?= $page == $current_page ? 'bg-success text-white' : 'bg-light text-dark' ?>"
								href="?page=<?= $page ?>&search=<?= urlencode($search) ?>"><?= $page ?></a>
						</li>
					<?php endfor; ?>
					<li class="page-item <?= $current_page >= $total_pages ? 'disabled' : '' ?>">
						<a class="page-link bg-primary text-white"
							href="?page=<?= $current_page + 1 ?>&search=<?= urlencode($search) ?>">Next</a>
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

<script src="assets/js/app.js"></script>
<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">