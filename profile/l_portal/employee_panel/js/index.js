$(document).ready(function () {
    $(".stock-update-btn").click(function () { 
        $(".stock-update-btn-menu").collapse('toggle');
    });
});

// start dynamic request

$(document).ready(function () {
    var active_link = $(".active").attr("access-link");
    dynamic_request(active_link);
    $(".collapse-item").each(function(){
        $(this).click(function(){
            var request_link = $(this).attr("access-link");
            dynamic_request(request_link);
        });
    });
});
// active tabs
$(document).ready(function(){
    var i;
    $(".collapse-item").each(function(){
        $(this).click(function(){
            for(i=0;i<$(".collapse-item").length;i++)
            {
                $(".collapse-item").removeClass("active");
            }
            $(this).addClass("active");
        });
    });
});

// dynamic request function definition

function dynamic_request(request_link)
{
    $.ajax({
        type: "POST",
        url: "dynamic_pages/"+request_link,
        xhr : function()
        {
            var request = new XMLHttpRequest();
            request.onprogress = function(e){
                var percentage = Math.floor(e.loaded*100/e.total);
                var loader = '<center><button class="btn btn-danger" style="font-size: 30px;"><i class="fa fa-circle-o-notch fa-spin"></i>Loading '+percentage+'%</button></center>';
                $(".page").html(loader);
            }
            return request;
        },
        beforeSend : function () { 
            var loader = '<center><button class="btn btn-danger" style="font-size: 30px;"><i class="fa fa-circle-o-notch fa-spin"></i></button></center>';
            $(".page").html(loader)
         },
        success: function (response) {
                $(".page").html(response);
                // create products
                $(".create-product-form").submit(function(e){
                    e.preventDefault();
                    if($(".display-subject").val() != "Choose Semester")
                    {
                        if($(".brands-name") != "Choose Subject")
                        {
                            $.ajax({
                                type : "POST",
                                url : "php/create_products.php",
                                /* url : "php/test.php", */
                                data : new FormData(this),
                                processData : false,
                                contentType : false,
                                catch : false,
                                xhr : function()
                                {
                                    var request = new XMLHttpRequest();
                                    request.upload.onprogress = function(e)
                                    {
                                        var percentage = Math.floor((e.loaded*100/e.total));
                                        $(".create-products-progress .progress-bar").css({
                                            width : percentage+"%",
                                        });
                                        $(".create-products-progress .progress-bar").html(percentage+"%");
                                    };
                                    return request;
                                },
                                beforeSend : function()
                                {
                                    $(".create-products-progress").removeClass("d-none");
                                },
                                success : function(response){
                                    if(response.trim() == "success")
                                    {
                                        alert(response);
                                        $(".create-products-progress").addClass("d-none");
                                        $(".create-products-progress .progress-bar").css({width:'0%'});
                                        $(".create-product-form").trigger('reset');
                                    }
                                    else{
                                        alert(response);
                                    }
                                },
                            });
                        }
                        else{
                            alert("please create subject related semester");
                        }
                    }
                    else{
                        alert(" Please first choose a semester !")
                    }
                });
                // end create products
                if(request_link == "create_category_design.php")
                {
                    category_list();
                }
                $(".add-field-btn").click(function(){
                    var placeholder = $(".input:first").attr("placeholder");
                    var input = document.createElement("INPUT");
                    input.type = "text";
                    input.className = "form-control input mb-3";
                    input.placeholder = placeholder;
                    input.style.background = "#f9f9f9";
                    input.style.border = "none";
                    input.required = "required";
                    $(".add-field-area").append(input);
                });
                $(".create-btn").click(function(e){
                    e.preventDefault();
                    var input = [];
                    var input_length = $(".input").length;
                    var i;
                    for(i=0;i<input_length;i++)
                    {
                        input[i] = document.getElementsByClassName("input")[i].value;
                    }
                    var object = JSON.stringify(input);
                    $.ajax({
                        type: "POST",
                        url: "php/create_category.php",
                        data: {
                            json_data : object
                        },
                        beforeSend : function(){
                            $(".create-category-loader").removeClass("d-none");
                        },
                        success: function (response) {
                            $(".create-category-loader").addClass("d-none");
                            if(response.trim() == "done")
                            {
                                category_list();
                                var notice = document.createElement("DIV");
                                notice.className = "alert alert-success";
                                notice.innerHTML = "<b>Success !</b>";
                                $(".create-category-notice").html(notice);
                                setTimeout(function(){
                                    $(".create-category-notice").html("");
                                    $(".create-category-form").trigger('reset');
                                },3000);
                            }
                            else{
                                var notice = document.createElement("DIV");
                                notice.className = "alert alert-warning";
                                notice.innerHTML = "<b>"+response+" !</b>";
                                $(".create-category-notice").html(notice);
                                setTimeout(function(){
                                    $(".create-category-notice").html("");
                                    $(".create-category-form").trigger('reset');
                                },3000);
                            }
                        }
                    });
                });

                // add brand field 
                $(".add-brand-btn").click(function(){
                    var placeholder = $(".brand-input:first").attr("placeholder");
                    var input = document.createElement("INPUT");
                    input.type = "text";
                    input.className = "form-control brand-input mb-3";
                    input.placeholder = placeholder;
                    input.style.background = "#f9f9f9";
                    input.style.border = "none";
                    input.required = "required";
                    $(".brand-field-area").append(input);
                });

                // create brands 
                
                $(".create-brand-btn").click(function(e){
                    e.preventDefault();
                    var category = $(".brand-category").val();
                    if(category == "Choose Semester")
                    {
                        var notice = document.createElement("DIV");
                        notice.className = "alert alert-warning";
                        notice.innerHTML = "<b>Please choose a semester !</b>";
                        $(".brand-field-notice").html(notice);
                        setTimeout(function(){
                        $(".brand-field-notice").html("");
                        },3000);
                    }
                    else{
                    var input = [];
                    var input_length = $(".brand-input").length;
                    var i;
                    for(i=0;i<input_length;i++)
                    {
                        input[i] = document.getElementsByClassName("brand-input")[i].value;
                    }
                    var object = JSON.stringify(input);
                    $.ajax({
                        type: "POST",
                        url: "php/create_brands.php",
                        data: {
                            category : category,
                            json_data : object
                        },
                        beforeSend : function(){
                            $(".brand-loader").removeClass("d-none");
                        },
                        success: function (response) {
                            $(".brand-loader").addClass("d-none");
                            if(response.trim() == "done")
                            {
                                var notice = document.createElement("DIV");
                                notice.className = "alert alert-success";
                                notice.innerHTML = "<b>Success !</b>";
                                $(".brand-field-notice").html(notice);
                                setTimeout(function(){
                                    $(".brand-field-notice").html("");
                                    $(".brand-form").trigger('reset');
                                },3000);
                            }
                            else{
                                var notice = document.createElement("DIV");
                                notice.className = "alert alert-warning";
                                notice.innerHTML = "<b>"+response+" !</b>";
                                $(".brand-field-notice").html(notice);
                                setTimeout(function(){
                                    $(".brand-field-notice").html("");
                                    $(".brand-form").trigger('reset');
                                },3000);
                            }
                        }
                    });
                }
                });

                // start display brands name
                $(document).ready(function () {
                    $(".display-brand").on("change",function(){
                        var slected_cat_name = $(this).val();
                        var all_option = $(this).html().replace("<option>Choose Category</option>").replace("<option>"+slected_cat_name+"</option>");

                        $.ajax({
                            type: "POST",
                            url: "php/display_brands.php",
                            data: {
                                category_name : slected_cat_name
                            },
                            beforeSend : function()
                            {
                                $(".display-brand-loader").removeClass("d-none");
                            },
                            success: function (response) {
                                if(response.trim() != "<b>no subject has been created yet in this semester</b>")
                                {
                                var table = document.createElement("TABLE");
                                table.width = "100%";
                                table.className = "table table-bordered text-center";
                                var th_cat = document.createElement("TH");
                                th_cat.height = "39";
                                var cat_text = document.createTextNode("Category Name");
                                th_cat.className = "bg-danger text-light";
                                th_cat.appendChild(cat_text);
                                table.appendChild(th_cat);
                                var th_brand = document.createElement("TH");
                                th_brand.height = "39";
                                var brand_text = document.createTextNode("Brand Name");
                                th_brand.className = "bg-danger text-light";
                                th_brand.appendChild(brand_text);
                                table.appendChild(th_brand);
                                var th_edit = document.createElement("TH");
                                th_edit.height = "38";
                                th_edit.innerHTML = "Edit";
                                th_edit.className = "bg-danger text-light";
                                table.appendChild(th_edit);
                                var th_delete = document.createElement("TH");
                                th_delete.height = "38";
                                th_delete.innerHTML = "Delete";
                                th_delete.className = "bg-danger text-light";
                                table.appendChild(th_delete);
                                $(".display-brand-loader").addClass("d-none");
                                /* console.log(response); */
                                var json_data = JSON.parse(response);
                                var i;
                                for(i=0; i<json_data.length; i++)
                                {
                                    var tr = document.createElement("TR");
                                    var td_cat = document.createElement("TD");
                                    var td_brands = document.createElement("TD");
                                    td_cat.innerHTML = "<select class='border p-2 w-75 dynamic-c-name' disabled='disabled'><option>"+json_data[i].category_name+"</option>"+all_option+"</select>";
                                    td_brands.innerHTML = json_data[i].brands;
                                    var td_edit = document.createElement("TD");
                                    td_edit.innerHTML = "<i class='fa fa-edit brand-edit' b-name='"+json_data[i].brands+"' c-name='"+json_data[i].category_name+"'></i><i class='fa fa-save d-none brand-save' b-name='"+json_data[i].brands+"' c-name='"+json_data[i].category_name+"'></i>";
                                    var td_delete = document.createElement("TD");
                                    td_delete.innerHTML = "<i class='fa fa-trash brand-delete' b-name='"+json_data[i].brands+"' c-name='"+json_data[i].category_name+"'></i>";
                                    table.append(tr);
                                    tr.append(td_cat);
                                    tr.append(td_brands);
                                    tr.append(td_edit);
                                    tr.append(td_delete);
                                    $(".brand-list-area").html(table);
                                    

                                    // delete brand
                                    $(".brand-delete").each(function(){
                                        $(this).click(function(){
                                            var delete_icon = this;
                                            var c_name = $(this).attr("c-name");
                                            var b_name = $(this).attr("b-name");
                                            $.ajax({
                                                type: "POST",
                                                url: "php/delete_brands.php",
                                                data: {c_name : c_name,b_name:b_name},
                                                success: function (response) {
                                                    if(response.trim() == "delete success")
                                                    {
                                                        var row = delete_icon.parentElement.parentElement;
                                                        row.remove();
                                                    }
                                                    else{
                                                        alert(response);
                                                    }
                                                }
                                            });
                                        });
                                    });

                                    // brand edit

                                    $(".brand-edit").each(function(){
                                        $(this).click(function(){
                                            var edit_icon = this;
                                            $(this).addClass("d-none");
                                            var c_name = $(this).attr("c-name");
                                            var b_name = $(this).attr("b-name");
                                            var row = this.parentElement.parentElement;
                                            var td = row.getElementsByTagName("TD");
                                            var select_tag = td[0].getElementsByClassName("dynamic-c-name")[0];
                                            select_tag.disabled = false;
                                            td[1].contentEditable = true;
                                            td[1].focus();
                                            var delete_icon = td[3].getElementsByClassName("brand-delete")[0];
                                            var save_icon = td[2].getElementsByClassName("brand-save")[0];
                                            $(save_icon).removeClass("d-none");
                                            save_icon.onclick = function()
                                            {
                                                $.ajax({
                                                    type: "POST",
                                                    url: "php/edit_brands.php",
                                                    data: {
                                                        previous_c_name:c_name,
                                                        previous_b_name:b_name,
                                                        c_name : select_tag.value,
                                                        b_name : td[1].innerHTML
                                                    },
                                                    success: function (response) {
                                                        if(response.trim() == "<b>success</b>")
                                                        {
                                                            $(save_icon).addClass("d-none");
                                                            $(edit_icon).removeClass("d-none");
                                                            td[1].contentEditable = false;
                                                            select_tag.disabled = true;
                                                            $(edit_icon).attr("c-name",select_tag.value);
                                                            $(edit_icon).attr("b-name",td[1].innerHTML);

                                                            $(save_icon).attr("c-name",select_tag.value);
                                                            $(save_icon).attr("b-name",td[1].innerHTML);

                                                            $(delete_icon).attr("c-name",select_tag.value);
                                                            $(delete_icon).attr("b-name",td[1].innerHTML);
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    });

                                }
                            }
                            else{
                                $(".brand-list-area").html(response);
                                $(".brand-list-area").css("color","red");
                                $(".display-brand-loader").addClass("d-none");
                            }
                        }
                        });
                    });
                });

                // start display subject
                $(document).ready(function () {
                    $(".display-subject").on("change",function(){
                        var slected_cat_name = $(this).val();
                        $.ajax({
                            type: "POST",
                            url: "php/display_subject.php",
                            data: {
                                category_name : slected_cat_name
                            },
                            beforeSend : function()
                            {
                                $(".display-subject-loader").removeClass("d-none");
                            },
                            success: function (response) {
                                if(response.trim() != "<b>no subject has been created yet in this semester</b>")
                                {
                                    var select = document.createElement("SELECT");
                                    select.name = "brands";
                                    select.required = "required";
                                    select.className = "form-select brands-name";
                                /* console.log(response); */
                                var json_data = JSON.parse(response);
                                var i;
                                for(i=0; i<json_data.length; i++)
                                {
                                    var option = document.createElement("OPTION");
                                    option.innerHTML = json_data[i].brands;
                                    select.append(option);
                                    $(".brands-list").html(select);
                                }
                                $(".display-subject-loader").addClass("d-none");
                                }
                            else{
                                $(".brands-list").html(response);
                                $(".brands-list").css("color","red");
                            }
                        }
                        });
                    });
                });
                // end display subject
        }

    });
}

// start code to show category on category list
$(document).ready(function(){
    category_list();
});
function category_list(){
    $.ajax({
        type: "POST",
        url: "php/category_list.php",
        success: function (response) {
            var category_list = JSON.parse(response);
            var i;
            for(i=0;i<category_list.length;i++)
            {
                var id = category_list[i].id;
                var name = category_list[i].category_name;
                var ul = document.createElement("UL");
                ul.className = "list-group";
                var li = document.createElement("LI");
                li.className = "list-group-item border-0 mb-3";
                ul.append(li);
                var div = document.createElement("DIV");
                div.className = "btn-group";
                li.append(div);
                var id_btn = document.createElement("BUTTON");
                id_btn.innerHTML = id;
                id_btn.className = "btn btn-danger id";
                div.append(id_btn);
                var name_btn = document.createElement("BUTTON");
                name_btn.innerHTML = name;
                name_btn.className = "btn btn-dark name";
                div.append(name_btn);
                var edit_btn = document.createElement("BUTTON");
                edit_btn.innerHTML = "<i class='fa fa-edit edit-icon'></i><i class='fa fa-save save-icon d-none'></i>";
                edit_btn.className = "btn btn-info";
                div.append(edit_btn);
                var delete_btn = document.createElement("BUTTON");
                delete_btn.innerHTML = "<i class='fa fa-trash delete-icon'></i>";
                delete_btn.className = "btn btn-danger";
                div.append(delete_btn);
                $(".category-area").append(ul);


                // start edit category name 
                    edit_btn.onclick = function()
                    {
                        var parent = this.parentElement;
                        var id = parent.getElementsByClassName("id")[0];
                        var cat_name = parent.getElementsByClassName("name")[0];
                        var save_icon = parent.getElementsByClassName("save-icon")[0];
                        var edit_icon = parent.getElementsByClassName("edit-icon")[0];
                        cat_name.contentEditable = true;
                        cat_name.focus();
                        $(save_icon).removeClass("d-none");
                        $(edit_icon).addClass("d-none");

                        $(save_icon).click(function(){
                            var changed_name = cat_name.innerHTML.trim();
                            $.ajax({
                                type: "POST",
                                url: "php/edit_category_name.php",
                                data: {
                                    id : id.innerHTML.trim(),
                                    changed_name : changed_name
                                },
                                success: function (response) {
                                    if(response.trim() == "success")
                                    {
                                        cat_name.contentEditable = false;
                                        $(save_icon).addClass("d-none");
                                        $(edit_icon).removeClass("d-none");
                                    }
                                    else{
                                        swal({
                                            text : response,
                                            icon : "warning",
                                        });
                                    }
                                }
                            });
                        });
                    }
                // end edit category name 

                // start delete caategory
                    delete_btn.onclick = function()
                    {
                        var parent = this.parentElement;
                        var id = parent.getElementsByClassName("id")[0].innerHTML.trim();
                        $.ajax({
                            type: "POST",
                            url: "php/delete_category_name.php",
                            data: {
                                id : id
                            },
                            catch : false,
                            success: function (response) {
                                if(response.trim() == "success")
                                {
                                    parent.parentElement.parentElement.remove();
                                }
                                else{
                                    swal({
                                        text : response,
                                        icon : "warning",
                                    });
                                }
                            }
                        });
                    }
                // end delete caategory
            }
        }
    });
}
// end code to show category on category list

