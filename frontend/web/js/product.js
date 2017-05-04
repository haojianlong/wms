$('#supertype').change(function(){
        console.log('sdf');
        $.ajax({
            type : "get",
            url  :  '/product-type/names',
            dataType: 'JSON',
            data : {idParent : $(this).val()},
            success : function(response){
                var ddd = $("#subtype").val("0").trigger("change");
                $("#subtype option").remove();
                $("#subtype").append("<option value='0'>Please select...</option>");
                $.each(response, function(key,value){
                    $("#subtype").append("<option value='"+key+"'>"+value+"</option>");
                })
            }
        });

});