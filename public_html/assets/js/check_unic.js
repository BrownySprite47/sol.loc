$(function() {
    //Название проекта
    $("#project_title").change(function(){
        var item = $('#project_title').val();
        $.ajax({
            url: "/ajax/ajax_check_unique_title",
            type: "GET",
            data: "project_title=" + item,
            cache: false,
            success: function(response){
                if(response == "project_title_exists"){
                    $("#project_title").removeClass().addClass("form-control inputRed");
                    $("#project_title_proj").html('Данный проект уже зарегистрирован');
                }else{
                    $("#project_title").removeClass('inputRed');
                    $("#project_title_proj").html('');
                }
            }
        });
    });

    $('#project_title').keyup(function(){
        $('#project_title').removeClass().addClass("form-control");
        $("#project_title_proj").html('');
    });


    //Сайт проекта
    $("#site").change(function(){
        var item = $('#site').val();
        $.ajax({
            url: "/ajax/ajax_check_unique_site",
            type: "GET",
            data: "site=" + item,
            cache: false,
            success: function(response){
                if(response == "project_title_exists"){
                    $("#site").removeClass().addClass("form-control inputRed");
                    $("#site_proj").html('Данный сайт уже зарегистрирован');
                }else{
                    $("#site").removeClass('inputRed');
                    $("#site_proj").html('');
                }
            }
        });
    });

    $('#site').keyup(function(){
        $('#site').removeClass().addClass("form-control");
        $("#site_proj").html('');
    });

    $(".edit#fio").change(function(){
        var item = $('.edit#fio').val();
        $.ajax({
            url: "/ajax/ajax_check_unique_fio",
            type: "GET",
            data: "fio_lid=" + item,
            cache: false,
            success: function(response){
                if(response == "lider_exists"){
                    $("#fio").removeClass().addClass("form-control inputRed");
                    $("#fio_lid").html('Данный лидер уже зарегистрирован');
                }else{
                    $("#fio").removeClass('inputRed');
                    $("#fio_lid").html('');
                }
            }
        });
    });

    $('#fio').keyup(function(){
        $('#fio').removeClass().addClass("form-control");
        $("#fio_lid").html('');
    });
});

