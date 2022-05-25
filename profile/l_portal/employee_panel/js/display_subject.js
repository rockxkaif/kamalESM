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
                $(".display-brand-loader").removeClass("d-none");
            },
            success: function (response) {
                if(response.trim() != "<b>no subject has been created yet in this semester</b>")
                {
                /* console.log(response); */
                var json_data = JSON.parse(response);
                var i;
                for(i=0; i<json_data.length; i++)
                {
                    $(".brands-name").html();
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