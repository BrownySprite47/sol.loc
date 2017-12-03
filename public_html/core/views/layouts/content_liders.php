<div class="container">
    <div id="filter" class="col-lg-12">
        <div class="row">
            <div class="form-group">
                <div class="col-lg-2">
                    <label>Выберите лидера</label>
                </div>
                <div class="col-lg-5">
                    <select id="filter_liders" data-live-search="true" class="selectpicker form-control" onchange="AjaxSendPostLiders();">
                        <option value="all">Все данные</option>
                        <?php foreach ($data['filter']['fio'] as $filter)
                            if ($filter['fio'] == "") {
                                continue;
                            }else{
                                echo '<option '. ($_POST['filter_liders'] == $filter['fio'] ? 'selected' : '') .' value="'.$filter['fio'].'">'.$filter['fio'].'</option>';
                            }?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.selectpicker').selectpicker('refresh');
    $('#filter_liders.selectpicker').selectpicker({ size: 4 });
</script>
<div class="container">
    <div id="content" class="col-lg-12">
        <div class="row">
            <div>&nbsp;</div>

            <!-- Блоки проектов -->

            <div class="list-group">
                <?php foreach ($data['lider'] as $lider): ?>
                    <div class="list-group-item col-lg-12">
                        <div class="col-lg-3">
                            <?php if (!empty($lider['image_name'])): ?>
                                <a target="_blank" href="/lider?id=<?= $lider['id_lid'] ?>" onclick="show(this);"><img class="liders_photo" src="/uploads/images/<?= $lider['image_name'] ?>" alt=""></a>                                
                            <?php else: ?>
                                <a target="_blank" href="/lider?id=<?= $lider['id_lid'] ?>" onclick="show(this);"><img class="liders_photo" src="/assets/images/img_not_found.png" alt=""></a>                                
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-3">
                            <div class="text">
                                <a target="_blank" href="/lider?id=<?= $lider['id_lid'] ?>" onclick="show(this);"><?= $lider['fio'] ?></a>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="text">
                                <?php if (!empty($lider['region'])): ?>
                                <p><span class="title">Регион:</span> <?= $lider['region'] ?></p>
                                <?php else: ?>
                                    <p><span class="title">Регион:</span> Не указано</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- <a target="_blank" href="<?= $lider['social'] ?>"><?= $lider['social'] ?></a> -->
                        
                        <div class="col-lg-2">
                            <p class="title">Проекты у лидера:</p>
                            <?php if (isset($lider['projects'])){
                                foreach ($lider['projects'] as $key => $value): ?>
                                    <div class="text">
                                        <a target="_blank" href="/project?id=<?= $value['id_proj'] ?>" onclick="show(this);"><?= $value['project_title'] ?></a>
                                    </div>
                                <?php endforeach; ?>
                            <?php }else{ ?>
                                <div class="text">
                                    <p>Нет проектов</p>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="col-lg-1">
                            <?php if ($_SESSION['role'] == 'admin'): ?>
                                <a href="/lider/edit?id=<?= $lider['id_lid'] ?>" class="btn btn-default edit_lid_admin">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                        <!-- <a target="_blank" href="<?= $lider['social'] ?>"><?= $lider['social'] ?></a> -->
                        <?php if(!empty($lider['i_can'])): ?>
                        <div class="col-lg-4">
                            <div class="text">

                                <p class="title">Могу поделиться:</p>
                                <p><?= $lider['i_can'] ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($lider['i_need'])): ?>
                        <div class="col-lg-4">
                            <div class="text">
                                <p class="title">Мне нужно:</p>
                                <p><?= $lider['i_need'] ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div id="navigation" class="col-lg-12">
        <nav class="nav_page" aria-label="Page navigation" style="text-align: center;">
            <ul class="pagination">

                <li <?= ($data['numpage'] <= 1 ? 'class="disabled"' : '') ?>>
                    <a href="javascript:void(0);" onclick="AjaxSendPostLiders(1); return up();" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php
                $limit = ($data['$countpages'] < 5) ? $data['$countpages'] : 5;
                $left = $data['numpage'] - 2;
                $right = $data['numpage'] + 2;

                if ($left < 1)            { $left = 1;            $right = $left + $limit - 1; }
                if ($right > $data['$countpages']) { $right = $data['$countpages']; $left = $right - $limit + 1; }
                ?>

                <?php for ($i = $left; $i <= $right; $i++): ?>
                    <li <?= ($data['numpage'] == $i ? 'class="active"' : '') ?>>
                        <a href="javascript:void(0);" onclick="AjaxSendPostLiders(<?= $i ?>); return up();"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <li <?= ($data['numpage'] == $data['$countpages'] ? 'class="disabled"' : '') ?>>
                    <a href="javascript:void(0);" onclick="AjaxSendPostLiders(<?= $data['$countpages'] ?>); return up();" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
</div>

<script>
    $('.selectpicker').selectpicker('refresh');
    $('#title.selectpicker').selectpicker({ size: 4 });
    $('#city.selectpicker').selectpicker({ size: 4 });
</script>
