<div class="container-fluid">
<div class="container-fluid bg-white shadow-sm mb-3 border-top py-3" style="margin-top:10px; width:98%">
    <?php
	$get_category_name = "SELECT * FROM category";
	$response = $db -> query($get_category_name);
	$multi_result = [];
	if($response)
	{
		while($data = $response -> fetch_assoc())
		{
			array_push($multi_result,$data["category_name"]);
		}
	}
echo '<div class="row animated slideInDown">
  		<div class="col-md-12 py-2 bg-white rounded-lg shadow-sm">
			  <h5 class="my-3">UPLOADED FILES <i class="fa fa-circle-o-notch fa-spin float-end display-subject-loader d-none" style="font-size:18px"></i></h5>
			  <form action="dynamic_pages/d.php" class="create-product-form" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
					<select class="form-select display-subject">
					<option>Choose Semester</option>';
					  for($i=0; $i<count($multi_result); $i++)
					  {
						  echo "<option>".$multi_result[$i]."</option>";
					  }
					echo '</select>
					</div>
					<div class="col-md-3"></div>
					<div class="col-md-3 brands-list d-none">

					</div>
					<div class="col-md-10 my-2 mt-4">
							<div class="progress create-subject-progress d-none mt-2">
								<div class="progress-bar"></div>
							</div>
					</div>
					<div class="col-md-2">
						<button type="submit" disabled="disabled" class="btn w-100 btn-danger btn-search mt-3">search</button>
					</div>
				</div>
			  </form>
		  </div>
  	</div>';
    ?>
    </div>
</div>
    <!-- <div class="container py-3">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="text-light">CATEGORY</h5>
                    <?php
                        $get_menu = "SELECT category_name FROM category";
                        $get_menu_response = $db -> query($get_menu);
                        if($get_menu_response)
                        {
                            while($nav = $get_menu_response -> fetch_assoc())
                            {
                                echo "<a class='d-block py-2 text-capetelize' href='#'>".$nav['category_name']."</a>";
                            }
                        }
                    ?>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <h5 class="text-light">POLICIES</h5>
                    <a href="#" class="d-block py-2">Privacy policy</a>
                    <a href="#" class="d-block py-2">Cookies Policy</a>
                    <a href="#" class="d-block py-2">Terms & Policy</a>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <h5 class="text-light">Contacts</h5>
                    <p class="text-light">Venue : aasaa</p>
                    <p class="text-light">Call : ddfgfhgthg</p>
                    <p class="text-light">Email : kjmbmnnbmm</p>
                    <p class="text-light">Website : bhbtfyheyf</p>
                </div>
            </div>
        </div> -->