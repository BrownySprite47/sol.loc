function up() {
    var top = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
    if(top > 0) {
        window.scrollBy(0,-100);
        var t = setTimeout('up()',5);
    } else clearTimeout(t);
    return false;
};



$('#upload').on('click', function() {
    var file_data = $('#sortpicture').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
//                    alert(form_data);
    $.ajax({
        url: '/ajax/upload_img',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(php_script_response){
            $('#preview').html(php_script_response);
        }
    });
});


$('.form_date').datetimepicker({
    language:  'ru',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});


$(document).ready(function(){
    $('.open-modal').click(function(){
        $('#myModal').modal('show');
    });
});

$('#addLider').click(function () {
    var count = $('.checkSize').length;
    if (count > 3) {
        AjaxAddLider();
        $("head").append($("<style type='text/css'> #addLider {display: none; }</style>"));
    }else {
        AjaxAddLider();
    }
});

$('#addFile').click(function () {
    var count = $('.checkSizeFile').length;
    if (count > 3) {
        AjaxAddLiderFile();
        $("head").append($("<style type='text/css'> #addFile {display: none; }</style>"));
    }else {
        AjaxAddLiderFile();
    }
});


$(document).ready(function(){
    $('.open-modal').click(function(){
        $('#myModal').modal('show');
    });
    var count = $('.checkSize').length;
    if (count == 5) {
        $("head").append($("<style type='text/css'> #addLider {display: none; }</style>"));
    }else if (count > 3) {
        AjaxAddLider();
        $("head").append($("<style type='text/css'> #addLider {display: none; }</style>"));
    }
});

$(document).ready(function(){
    $('.open-modal-recom').click(function(){
        $.post(
            '/ajax/create_recom',
            {
                id_lid: $('#id_lid_num').val(),
                reason: $('#textfield_recom').val(),
            },
            AjaxSuccess
        );

        function AjaxSuccess(data) {
            if (data = 'lider_recom_success') {
                $('#myModal').modal('show');
            }           
        }
        
    });
});
function AjaxSendStatusLider($status, $id_lid){
    $.post(
        '/ajax/check_status',
        {
            id_lid: $id_lid,
            status: $status,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data = 'lider_update_success') {
        $(".relat_box_lider_" + $id_lid).hide();
        $("#result_status").html('Ваши изменения сохранены!');
        // $(this).closest(".relat_box").remove();
        }
    }
}

function AjaxSendStatusProject($status, $id_proj){
    $.post(
        '/ajax/check_status',
        {
            id_proj: $id_proj,
            status: $status,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == 'project_update_success') {
            $(".relat_box_project_" + $id_proj).hide();
            $("#result_status").html('Ваши изменения сохранены!');
            
            //$(this).closest(".relat_box").remove();
        }
//                    alert(data);
    }
}

function AjaxSendStatusLiderRecommend($status, $id_lid_recom, $user_id, $exist){
    $.post(
        '/ajax/check_status',
        {
            id_lid_recom:   $id_lid_recom,
            user_id:  $user_id,
            exist:  $exist,
            status:   $status,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data = 'recom_update_success') {
            $(".relat_box_lider_" + $id_lid_recom).hide();
            // $(this).closest(".relat_box").remove();
            //alert(data);
        }else{
            $('#panel3').html(data);
            //alert(data);
        }
    }
}


function delete_lider($del_lid_id){
    $.post(
        '/ajax/delete_lider',
        {
            del_lid_id: $del_lid_id,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == "lider_deleted_admin") {
            $('.menu_edit').html('<h2>РЕДАКТИРОВАНИЕ ПРОЕКТА</h2><p class="del_btn_abs">Лидер успешно удален!</p>');
            $("#back_link").attr("href", "javascript:history.go(-2)");
        }if (data == "lider_deleted_user") {
            $('.menu_edit').html('<h2>РЕДАКТИРОВАНИЕ ПРОЕКТА</h2><p class="del_btn_abs">Лидер успешно удален!</p>');
            $("#back_link").attr("href", "javascript:history.go(-2)");
        }
   // else{
   //     alert(data);
   // }
    }
}

function delete_project($del_proj_id){
    $.post(
        '/ajax/delete_project',
        {
            del_proj_id: $del_proj_id,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == "project_deleted_admin") {
            // window.location.href = "/admin";
            $('.menu_edit').html('<h2>РЕДАКТИРОВАНИЕ ПРОЕКТА</h2><p class="del_btn_abs">Проект успешно удален!</p>');
            $("#back_link").attr("href", "javascript:history.go(-2)");
        }if (data == "project_deleted_user") {
            // window.location.href = "/user";
            $('.menu_edit').html('<h2>РЕДАКТИРОВАНИЕ ПРОЕКТА</h2><p class="del_btn_abs">Проект успешно удален!</p>');
            $("#back_link").attr("href", "javascript:history.go(-2)");
        }
//                    else{
//                        alert(data);
//                    }
    }
}                





$('#sortpicture').on('change', function() {
    $('#progressbar').css('display', 'block');
    $('#add_lid_btn').attr('disabled',true);
    $('#edit_lid_btn').attr('disabled',true);
    $('#save_btn').attr('disabled',true);
    var progressBar = $('#progressbar');
    var file_data = $('#sortpicture').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
//                    alert(form_data);
    $.ajax({
        url: '/ajax/upload_img',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        xhr: function(){
            var xhr = $.ajaxSettings.xhr(); // получаем объект XMLHttpRequest
            xhr.upload.addEventListener('progress', function(evt){ // добавляем обработчик события progress (onprogress)
              if(evt.lengthComputable) { // если известно количество байт
                // высчитываем процент загруженного
                var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
                // устанавливаем значение в атрибут value тега <progress>
                // и это же значение альтернативным текстом для браузеров, не поддерживающих <progress>
                progressBar.val(percentComplete).text('Загружено ' + percentComplete + '%');
              }
            }, false);
            return xhr;
          },
        success: function(json){
            if(json){
              $('#preview').html(json);
              $('#progressbar').css('display', 'none');
              $('#add_lid_btn').removeAttr('disabled');
              $('#edit_lid_btn').removeAttr('disabled');
              $('#save_btn').removeAttr('disabled');
            }
            // alert(php_script_response);
        }
    });
});

