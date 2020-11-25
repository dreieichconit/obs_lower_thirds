  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="img/schlaffi.png" alt="Schlaffi" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">DCW Streamtool</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
	  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        
        </div>
        <div class="info">

		  
        </div>
      </div>
	  
	  
	  
	  <?php
	  /*
	  <!--<li class="nav-item">
            <a href="index.php?page=equipment" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                <?php echo($lang_sidebar_equipment_list); ?>
              </p>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a href="index.php?page=equipment&show_childs" class="nav-link">
              <i class="nav-icon fas fa-child"></i>
              <p>
                <?php echo($lang_sidebar_equipment_list_childs); ?>
              </p>
            </a>
          </li>-->
		   <li class="nav-item">
            <a href="index.php?page=equipment_add" class="nav-link">
              <i class="nav-icon fas fa-plus-circle"></i>
              <p>
                <?php echo($lang_sidebar_equipment_add); ?>
              </p>
            </a>
          </li>
		  
		   <li class="nav-item">
            <a href="index.php?page=equipment_barcodes" class="nav-link">
              <i class="nav-icon fas fa-barcode"></i>
              <p>
                <?php echo($lang_sidebar_equipment_barcodes); ?>
              </p>
            </a>
          </li>
	  */
	  ?>
	  
	  
	  
	  
	  
	  
	  
<?php //<span class="right badge badge-danger">New</span> ?>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
			 
			    <li class="nav-header">STREAMPLAN</li>
		
			
		    	<li class="nav-item">
            <a href="index.php?page=schedule&stream=1" class="nav-link">
              <i class="nav-icon fas fa-barcode"></i>
              <p>
                Stream 1
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="index.php?page=schedule&stream=2" class="nav-link">
              <i class="nav-icon fas fa-barcode"></i>
              <p>
                Stream 2
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="index.php?page=schedule_add" class="nav-link">
              <i class="nav-icon fas fa-plus-circle"></i>
              <p>
                Eintrag hinzufügen
              </p>
            </a>
          </li>
		
		  
		  
      
          
		  
		  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>