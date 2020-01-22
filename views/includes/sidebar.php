<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo BASEPAGES?>index.php">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">ERP-SL</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="<?php echo BASEPAGES?>index.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product" aria-expanded="true" aria-controls="product">
    <i class="fas fa-fw fa-cubes"></i>
    <span>Product</span>
  </a>
  <div id="product" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?php echo BASEPAGES?>add-product.php">Add Product</a>
      <a class="collapse-item" href="<?php echo BASEPAGES?>manage-product.php">Manage Product</a>
    </div>
  </div>
</li>

<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#supplier" aria-expanded="true" aria-controls="supplier">
    <i class="fas fa-fw fa-briefcase"></i>
    <span>Supplier</span>
  </a>
  <div id="supplier" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?echo BASEPAGES?>add-supplier.php">Add Supplier</a>
      <a class="collapse-item" href="<?echo BASEPAGES?>manage-supplier.php">Manage Supplier</a>
    </div>
  </div>
</li>

<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#category" aria-expanded="true" aria-controls="category">
    <i class="fas fa-fw fa-lightbulb"></i>
    <span>Category</span>
  </a>
  <div id="category" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?echo BASEPAGES?>add-category.php">Add Category</a>
      <a class="collapse-item" href="<?echo BASEPAGES?>manage-category.php">Manage Category</a>
    </div>
  </div>
</li>


<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchases" aria-expanded="true" aria-controls="purchases">
    <i class="fas fa-fw fa-shopping-cart"></i>
    <span>Purchase</span>
  </a>
  <div id="purchases" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?echo BASEPAGES?>add-purchase.php">Add Purchase</a>
      <a class="collapse-item" href="<?echo BASEPAGES?>manage-purchase.php">Manage Purchase</a>
    </div>
  </div>
</li>

<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sales" aria-expanded="true" aria-controls="sales">
    <i class="fas fa-fw fa-shopping-cart"></i>
    <span>Sales</span>
  </a>
  <div id="sales" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?echo BASEPAGES?>add-sales.php">Add Sales</a>
      <a class="collapse-item" href="<?echo BASEPAGES?>manage-sales.php">Manage Sales</a>
    </div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->