    <div class="list-group-item content_lider_file file<?= $classCount; ?> checkSizeFile">
        <div class="form-group">
            <div class="col-xs-offset col-xs-1"><button onclick='AjaxCheckLiderDbFile("del", ".file<?= $classCount; ?>");' class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button></div>
            <label for="file<?= $counter; ?>" class="control-label col-xs-3">Выберите файл:</label>
            <div class="col-xs-6">
                <input type="file" name="file<?= $counter; ?>" id="file<?= $counter; ?>" value="">
                <progress id="progressbar_file<?= $counter; ?>" value="0" max="100" style="display: none;"></progress>
            </div>
            <input id="preview_file_<?= $counter ?>" type="text" name="filename" value="" style="display: none;">
        </div>
        <div class="form-group">
            <label for="description<?= $counter; ?>" class="control-label col-xs-4">Название:</label>
            <div class="col-xs-6">
                <input type="text" maxlength="150" name="description<?= $counter; ?>" class="form-control" id="description<?= $counter; ?>" placeholder="">
            </div>
            <!-- <button id="upload_<?= $counter; ?>">Загрузить</button> -->
        </div>
    </div>
 <script>
                $('#file<?= $counter; ?>').on('change', function() {
                    $('#progressbar_file<?= $counter; ?>').css('display', 'block');
                    $('#save_proj_id').attr('disabled',true);
                    var progressBar = $('#progressbar_file<?= $counter; ?>');
                    var file_data = $('#file<?= $counter; ?>').prop('files')[0];
                    var form_data = new FormData();
                    form_data.append('file', file_data);
//                    alert(form_data);
                    $.ajax({
                        url: '/ajax/upload_file',
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        // success: function(php_script_response){
                        //     $('#preview_file_<?= $counter; ?>').val(php_script_response);
                        // }
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
                              $('#preview_file_<?= $counter; ?>').val(json);
                              $('#progressbar_file<?= $counter; ?>').css('display', 'none');
                              $('#save_proj_id').removeAttr('disabled');
                            }
                            // alert(php_script_response);
                        }
                    });
                });
            </script>
    <script>
        function AjaxCheckLiderDbFile($check, $id){
            if ($check == false) {
                $(".check<?= $counter; ?>").remove();
            } else if ($check == 'del') {
                $($id).remove();
                $("head").append($("<style type='text/css'> #addFile {display: block;} </style>"));
            }
        }
    </script>
    <!-- <script src="../../../assets/js/check_unic.js"></script> -->

