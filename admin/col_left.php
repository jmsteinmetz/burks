
    <!-- Start Sidebar -->
    <div id="sidebar"> 
      <div class="logo" style="padding:15px 0px 20px 0px; margin-left:-22px; height:62px">
	  <img src="../images/bmc-logo.png" width="213"  />
	  </div>
      <!-- Start Live Search  --><!-- End Live Search  --> 
      <!-- Start Content Nav  --> 
     <?php if(($_SESSION[content_manager] == "1") || ($_SESSION[super_admin] == "1")){?>
	  <span class="ul-header"><a id="toggle-pagesnav" href="#" class="toggle visible">Manage FAQ's</a></span>
      <ul style="display:block;" id="pagesnav">
<!--        <li><a class="icn_manage_pages" href="#">Manage FAQ's</a></li> 
-->        <li><a class="icn_manage_pages" href="news.php">List FAQ's</a></li>
        <li><a class="icn_add_pages" href="news_add.php">Add FAQ's</a></li>
      </ul>
      <span class="ul-header"><a id="toggle-pagesnav" href="#" class="toggle visible">Manage Testimonials</a></span>
      <ul style="display:block;" id="pagesnav">
<!--        <li><a class="icn_manage_pages" href="#">Manage FAQ's</a></li> 
-->        <li><a class="icn_manage_pages" href="testimonial.php">List Testimonial</a></li>
        <li><a class="icn_add_pages" href="testimonial_add.php">Add Testimonial</a></li>
      </ul>


      <!-- End Content Nav  --> 
      <!-- Start Comments Nav  --> 
      <span class="ul-header"><a id="toggle-userssnav" href="#" class="toggle visible">Manage Slider</a></span>
      <ul style="display:block;" id="userssnav">
<!--        <li><a class="icn_manage_pages" href="header_gallery.php">Header Gallery</a></li> 
-->        <li><a class="icn_manage_pages" href="banner_gallery.php">Manage Slider</a></li>
<!--        <li><a class="icn_manage_pages" href="right_gallery.php">Right Gallery</a></li> 
        <li><a class="icn_manage_pages" href="left_gallery.php">Left Gallery</a></li>
        <li><a class="icn_manage_pages" href="video_ad.php">Video Ad</a></li>
-->      </ul>
      <!-- End Comments Nav  --> 
      <!-- Start Users Nav  --> 
      <span class="ul-header"><a id="toggle-userssnav" href="#" class="toggle visible">Site Pages</a></span>
      <ul style="display:block;" id="userssnav">
        <!--<li><a class="icn_manage_users" href="#">Manage Users</a></li> -->
        <li><a class="icn_manage_pages" href="contents.php">List Pages</a></li>
		<li><a class="icn_add_pages" href="content_add.php">Add Page</a></li>
		<li><a class="icn_add_pages" href="sub_category.php">Add Sub Pages</a></li>
      </ul>
	  <?php }?>
	  <?php if(($_SESSION[user_manager] == "1") || ($_SESSION[super_admin] == "1")){?>
      <span class="ul-header"><a id="toggle-userssnav" href="#" class="toggle visible">General Settings</a></span>
      <ul style="display:block;" id="userssnav">
        <!--<li><a class="icn_manage_users" href="#">Manage Users</a></li> -->
        <li><a class="icn_add_users" href="settings.php">Settings</a></li>
		<li><a class="icn_add_users" href="user.php">Client Listing</a></li>
		<li><a class="icn_add_users" href="emp_listing.php">Employee Listing</a></li>
		<li><a class="icn_add_users" href="user_add.php">Add User</a></li>
		<?php if($_SESSION[super_admin] == "1"){?>	
		<li><a class="icn_add_users" href="admin_add.php">Add Administrator</a></li>
		<li><a class="icn_add_users" href="admin.php">Administrator Listing</a></li>
		<?php }?>
      </ul>
	  <?php }?>
      <!-- End Users Nav  --> 
      <!-- Start Gallery Nav  --> 
	  <?php if(($_SESSION[job_manager] == "1") || ($_SESSION[super_admin] == "1")){?>
	  
           <span class="ul-header"><a id="toggle-userssnav" href="#" class="toggle visible">Job Manager</a></span>
      <ul style="display:block;" id="userssnav">
        <!--<li><a class="icn_manage_users" href="#">Manage Users</a></li> -->
        <li><a class="icn_manage_pages" href="job_assign.php">Jobs</a></li>
		<li><a class="icn_manage_pages" href="job_completed.php">Completed Jobs</a></li>
		<li><a class="icn_manage_pages" href="resume.php">Resume</a></li>
        <li><a class="icn_manage_pages" href="search.php">Job Search</a></li>
		<li><a class="icn_manage_pages" href="job_interactions_view.php">Job Interactions</a></li>
      </ul>
		<?php }?>
	 <?php if($_SESSION[super_admin] == "1"){?>	
      <span class="ul-header"><a id="toggle-userssnav" href="#" class="toggle visible">Reports</a></span>
      <ul style="display:block;" id="userssnav">
        <!--<li><a class="icn_manage_users" href="#">Manage Users</a></li> -->
        <li><a class="icn_manage_pages" href="BACKUP_EMP_REPORTS.php">Employee Report</a></li>
	<li><a class="icn_manage_pages" href="user_reports.php">Client Report</a></li>
        <li><a class="icn_manage_pages" href="employee_work_report.php">Employee Work Report</a></li>
        <li><a class="icn_manage_pages" href="end_of_month_report.php">End of Month Report</a></li>
        
      </ul>
 		<?php }?>
      
    </div>
    <!-- End Sidebar  --> 
    <div style="height:50px; margin-left:230px; border-bottom:1px solid #dcdcdc;">
     <div class="h1"><img src="img/logo.png" /></div>
      <div class="newmsg">Hello <strong><?php echo $_SESSION[username]?></strong> | <a href="logout.php">Logout</a></div>
     </div>