<div class="container">
    <div id="filter" class="col-lg-12">
        <div class="row">
            <div class="form-group">
                <div class="col-lg-1"></div>
                <div class="col-lg-2">
                    <label>Название проекта</label><br>
                    <select id="title" data-live-search="true" data-ajax="" class="selectpicker form-control" onchange="AjaxSendPost();">
                        <option value="all">Все данные</option>

                        <?php foreach ($data['filters']['titles'] as $filter)
                            echo '<option '. ($_POST['title'] == $filter['project_title'] ? 'selected' : '') .' value="'.$filter['project_title'].'">'.$filter['project_title'].'</option>'; ?>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label>Город</label><br>
                    <select id="city" data-live-search="true" class="selectpicker form-control" onchange="AjaxSendPostRefresh();">
                        <option value="all">Все данные</option>
                        <?php foreach ($data['filters']['cities'] as $filter)
                            if ($filter['author_location'] == "") {
                                continue;
                            }else{
                                echo '<option '. ($_POST['city'] == $filter['author_location'] ? 'selected' : '') .' value="'.$filter['author_location'].'">'.$filter['author_location'].'</option>';
                            }?>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label>Возраст</label><br>
                    <select id="age" class="selectpicker form-control" onchange="AjaxSendPost();">
                        <option value="all">Все данные</option>
                        <?php foreach ($data['dynamicFilter']['ages'] as $key => $value) {
                            echo '<option '. ($_POST['age'] == $key ? 'selected' : '') .'  value="'.$key.'">'.$value.'</option>';
                        }?>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label>Предмет</label><br>
                    <select id="predmet" class="selectpicker form-control" onchange="AjaxSendPost();">
                        <option value="all">Все данные</option>
                        <?php foreach ($data['dynamicFilter']['predmets'] as $key => $value) {
                            echo '<option '. ($_POST['predmet'] == $key ? 'selected' : '') .' value="'.$key.'">'.$value.'</option>';
                        }?>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label>Метапредмет</label><br>
                    <select id="metapredmet" class="selectpicker form-control" onchange="AjaxSendPost();">
                        <option value="all">Все данные</option>
                        <?php foreach ($data['dynamicFilter']['metapredmets'] as $key => $value) {
                            echo '<option '. ($_POST['metapredmet'] == $key ? 'selected' : '') .' value="'.$key.'">'.$value.'</option>';
                        }?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div id="content" class="col-lg-12">
        <div class="list-group projects_on_page">
            <div class="col-lg-9">&nbsp;</div>
            <div class="col-lg-2">Проектов на странице:</div>            
            <div class="col-lg-1">                
                <select onchange="AjaxSendPost()" id="projects_on_page" name="projects_on_page" class="selectpicker form-control">
                    <option <?= ($_POST['projects_on_page'] == '10') ? 'selected' : ''?> value="10">10</option>
                    <option <?= ($_POST['projects_on_page'] == '50') ? 'selected' : ''?> value="50">50</option>
                    <option <?= ($_POST['projects_on_page'] == '100') ? 'selected' : ''?> value="100">100</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div>&nbsp;</div>
            <?php if(!empty($_POST['title'] && ($_POST['title'] != 'all'))  || !empty($_POST['city'] && ($_POST['city'] != 'all')) || !empty($_POST['age'] && ($_POST['age'] != 'all')) || !empty($_POST['predmet'] && ($_POST['predmet'] != 'all')) || !empty($_POST['metapredmet'] && ($_POST['metapredmet'] != 'all'))): ?>
                <p style=""> По вашему запросу найдено: <?= count($data['all_projects']) ?> проектов</p>
            <?php endif; ?>
            <!-- Блоки проектов -->

            <div class="list-group">
                <?php foreach ($data['projects'] as $project): ?>
                    <div class="list-group-item col-lg-12">
                        <!-- <div class="col-lg-1"></div> -->
                        <div class="col-lg-3">
                        <div class="text">
                            <a target="_blank" href="/project?id=<?= $project['id_proj'] ?>" onclick="show(this);"><?= $project['project_title'] ?></a>
                        </div>
<!--                         <?php if (!empty($project['image_name'])): ?>
                            <a target="_blank" href="/project?id=<?= $project['id_proj'] ?>" onclick="show(this);"><img class="liders_photo" src="/uploads/images/<?= $project['image_name'] ?>" alt=""></a>                            
                        <?php else: ?>
                            <a target="_blank" href="/project?id=<?= $project['id_proj'] ?>" onclick="show(this);"><img class="liders_photo" src="/assets/images/img_not_found.png" alt=""></a>                            
                        <?php endif; ?>   -->                          
                        </div>
                        <div class="col-lg-2">
                            <?php if (!empty($project['author_location'])): ?>
                                <div class="text"><?= $project['author_location'] ?></div>
                            <?php else: ?>
                                <div class="text">Не указано</div>
                            <?php endif; ?> 
                        </div>
                        <div class="col-lg-2">
                            <?php if (!empty($project['ages'])): ?>
                                <?php foreach ($project['ages'] as $key => $value): ?>
                                    <div class="text"><?= $data['localizations']['ages'][$key] ?></div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text">Не указано</div>
                            <?php endif; ?>                             
                        </div>
                        <div class="col-lg-2">
                            <?php if (!empty($project['predmets'])): ?>
                                <?php foreach ($project['predmets'] as $key => $value): ?>
                                    <div class="text"><?= $data['localizations']['predmets'][$key] ?></div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text">Не указано</div>
                            <?php endif; ?>                             
                        </div>
                        <div class="col-lg-2">
                            <?php if (!empty($project['metapredmets'])): ?>
                                <?php foreach ($project['metapredmets'] as $key => $value): ?>
                                    <div class="text"><?= $data['localizations']['metapredmets'][$key] ?></div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text">Не указано</div>
                            <?php endif; ?>                             
                        </div>
                        <div class="col-lg-1">
                            <?php if ($_SESSION['role'] == 'admin'): ?>
                                <div class="text">
                                    <a href="/project/edit?id=<?= $project['id_proj'] ?>" class="btn btn-default">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php if (empty($data['projects'])): ?>
                    <div class="list-group-item col-lg-12">
                        <h4>Нет данных, удовлетворяющих условия заданного фильтра.</h4>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div id="navigation" class="col-lg-12">
        <nav class="nav_page" aria-label="Page navigation" style="text-align: center;">
            <ul class="pagination">

                <li <?= ($data['numpage'] <= 1 ? 'class="disabled"' : '') ?>>
                    <a href="javascript:void(0);" onclick="AjaxSendPost(1); return up();" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php
                $limit = ($data['countpages'] < 5) ? $data['countpages'] : 5;
                $left = $data['numpage'] - 2;
                $right = $data['numpage'] + 2;

                if ($left < 1)            { $left = 1;            $right = $left + $limit - 1; }
                if ($right > $data['countpages']) { $right = $data['countpages']; $left = $right - $limit + 1; }
                ?>

                <?php for ($i = $left; $i <= $right; $i++): ?>
                    <li <?= ($data['numpage'] == $i ? 'class="active"' : '') ?>>
                        <a href="javascript:void(0);" onclick="AjaxSendPost(<?= $i ?>); return up();"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <li <?= ($data['numpage'] == $data['countpages'] ? 'class="disabled"' : '') ?>>
                    <a href="javascript:void(0);" onclick="AjaxSendPost(<?= $data['countpages'] ?>); return up();" aria-label="Next">
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
