    <div class="list-group-item content_lider lider<?= $classCount; ?> checkSize">
        <div class="form-group">
            <div class="col-xs-offset col-xs-1"><button onclick='AjaxCheckLiderDb("del", ".lider<?= $classCount; ?>");' class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button></div>
            <label for="fio<?= $counter; ?>" class="control-label col-xs-3">Фамилия Имя Отчество:</label>
            <div class="col-xs-6">
                <select data-live-search="true" class="selectpicker form-control" name="fio<?= $counter; ?>" id="fio<?= $counter; ?>">
                    <option value="">Не выбрано</option>
                    <?php foreach ($filters['fio'] as $filter){
                        echo '<option value="'.$filter['fio'].'">'.$filter['fio'].'</option>';
                    }?>
                </select>
                <p id='fio<?= $counter; ?>_lid' class='error'></p>
            </div>
        </div>
        <div class="form-group">
            <label for="role<?= $counter; ?>" class="control-label col-xs-4">Роль лидера в проекте:</label>
            <div class="col-xs-6">
                <input type="text" maxlength="150" name="role<?= $counter; ?>" class="form-control" id="role<?= $counter; ?>" placeholder="">
                <p id='role<?= $counter; ?>_lid' class='error'></p>
            </div>
        </div>
    </div>

    <script>
        $('.selectpicker').selectpicker('refresh');
        $('.selectpicker').selectpicker({ size: 4 });
    </script>
    <script>
        $('#fio<?= $counter; ?>').ready(function () {
            $('#fio<?= $counter; ?>').typeahead({
                source: function (query, result) {
                    $.ajax({
                        url: "../lib/typeahead.php",
                        data: 'fio=' + query,
                        dataType: "json",
                        type: "POST",
                        success: function (data) {
                            result($.map(data, function (item) {
                                return item;
                            }));
                        }
                    });
                }
            });
        });
    </script>
    <script>
        function AjaxCheckLiderDb($check, $id){
            if ($check == false) {
                $(".check<?= $counter; ?>").remove();
            } else if ($check == 'del') {
                $($id).remove();
                $("head").append($("<style type='text/css'> #addLider {display: block;} </style>"));
            }
        }
    </script>
    <script src="../../../assets/js/check_unic.js"></script>

