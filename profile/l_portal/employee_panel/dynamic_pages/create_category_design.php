<?php
require_once("../../common_files/php/database.php");
echo '
       <div class="row animated fadeInDown">
           <div class="col-md-4 py-2 bg-white raounded-lg shadow-sm" style="height: auto;">
               <h5 class="my-3">
                   CREATE SEMESTER
                   <i class="fa fa-circle-o-notch fa-spin d-none float-end create-category-loader"></i> 
               </h5>
               <form action="" class="create-category-form">
                   <input type="text" class="form-control mb-3 input" placeholder="First Sem" style="background-color: #f9f9f9; border:none" required="required">
                   <div class="add-field-area mb-3"></div>
                   <button type="button" class="btn btn-primary mb-3 add-field-btn">
                       <i class="fa fa-plus"></i>
                       Add field
                   </button>
                   <button type="submit" class="btn btn-danger mb-3 create-btn">
                   Create
                   </button>
                   <div class="create-category-notice my-3"></div>
               </form>
           </div>
           <div class="col-md-2"></div>
           <div class="col-md-6 bg-white raounded-lg shadow-sm">
               <h5 class="my-3">SEMESTER LIST</h5>
               <hr>
               <div class="category-area overflow-auto" style="height:300px"></div>
           </div>
       </div>
';

?>