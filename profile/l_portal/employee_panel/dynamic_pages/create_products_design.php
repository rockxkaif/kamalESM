<?php
    require_once("../../common_files/php/database.php");
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
			  <h5 class="my-3">UPLOAD FILES <i class="fa fa-circle-o-notch fa-spin float-end display-subject-loader d-none" style="font-size:18px"></i></h5>
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
					<div class="col-md-3 brands-list">
						<select name="brands" id="" required="required" class="form-select brands-name">
							<option>Choose Subject</option></select>
					</div>
					<div class="col-md-12"  align="center">
						<button class="btn btn-dark d-flex align-items-center flex-column justify-content-center my-3">
							<input type="file" name="pdf" required="required" class="form-control" id="">
							<span class="text-center">PDF-6</span>
						</button>
					</div>
					<div class="col-md-10 my-2">
						<button class="btn py-2 w-100">
							<div class="progress create-products-progress d-none">
								<div class="progress-bar"></div>
							</div>
						</button>
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn w-100 btn-danger">Submit</button>
					</div>
				</div>
			  </form>
		  </div>
  	</div>';
    ?>