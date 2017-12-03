function AjaxSendPost($numpage = 1) {
    $.post(
        '/',
        {
            age: $('#age').val(),
            predmet: $('#predmet').val(),
            metapredmet: $('#metapredmet').val(),
            title: $('#title').val(),
            city: $('#city').val(),
            projects_on_page: $('#projects_on_page').val(),
            numpage: $numpage,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('#content-main').html(data);
    }
}
function AjaxSendPostRefresh($numpage = 1) {
    $.post(
        '/',
        {
            age: 'all',
            predmet: 'all',
            metapredmet: 'all',
            title: 'all',
            city: $('#city').val(),
            projects_on_page: $('#projects_on_page').val(),
            numpage: $numpage,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('#content-main').html(data);
    }
}

function isChecked($checkbox) {
    if($($checkbox).is(":checked")) {
        return '1';
    }else{
        return '0';
    }
}
//
function AjaxSendAddProject() {
    $.post(
        '/ajax/add_project',
        {
            project_title: $('#project_title').val(),
            short_title: $('#short_title').val(),
            project_description: $('#project_description').val(),
            site: $('#site').val(),
            id_lid: $('#id_lid').val(),

            'metapredmets[business]': isChecked("input#business"),
            'metapredmets[engineer]': isChecked("input#engineer"),
            'metapredmets[eq]': isChecked("input#eq"),
            'metapredmets[it_prof]': isChecked("input#it_prof"),
            'metapredmets[personal]': isChecked("input#personal"),
            'metapredmets[proforient]': isChecked("input#proforient"),

            'predmets[arts]': isChecked("input#arts"),
            'predmets[lingvistic]': isChecked("input#lingvistic"),
            'predmets[pedagogy]': isChecked("input#pedagogy"),
            'predmets[sport]': isChecked("input#sport"),
            'predmets[social]': isChecked("input#social"),
            'predmets[techno]': isChecked("input#techno"),
            'predmets[naturall]': isChecked("input#naturall"),

            'ages[r_00_07]': isChecked("input#r_00_07"),
            'ages[r_12_15]': isChecked("input#r_12_15"),
            'ages[r_16_18]': isChecked("input#r_16_18"),
            'ages[r_19_25]': isChecked("input#r_19_25"),
            'ages[r_08_11]': isChecked("input#r_08_11"),
            'ages[r_all_life]': isChecked("input#r_all_life"),
            'ages[r_others]': isChecked("input#r_others"),
            'ages[r_parents]': isChecked("input#r_parents"),
            'ages[r_teachers]': isChecked("input#r_teachers"),
            liders_photo: $('.liders_photo').attr('src'),

            method: $('#method').val(),
            author: $('#author').val(),
            level: $('#level').val(),
            stage_of_project: $('#stage_of_project').val(),
            author_location: $('#author_location').val(),
            start_year: $('#start_year').val(),
            offline_geography: $('#offline_geography').val(),

            'lider0[fio]': $('#fio0').val(),
            'lider1[fio]': $('#fio1').val(),
            'lider2[fio]': $('#fio2').val(),
            'lider3[fio]': $('#fio3').val(),
            'lider4[fio]': $('#fio4').val(),

            'lider0[role]': $('#role0').val(),
            'lider1[role]': $('#role1').val(),
            'lider2[role]': $('#role2').val(),
            'lider3[role]': $('#role3').val(),
            'lider4[role]': $('#role4').val(),

            'file0[name]': $('#preview_file_0').val(),
            'file1[name]': $('#preview_file_1').val(),
            'file2[name]': $('#preview_file_2').val(),
            'file3[name]': $('#preview_file_3').val(),
            'file4[name]': $('#preview_file_4').val(),

            'file0[description]': $('#description0').val(),
            'file1[description]': $('#description1').val(),
            'file2[description]': $('#description2').val(),
            'file3[description]': $('#description3').val(),
            'file4[description]': $('#description4').val(),

        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == "success_user") {
            $('.save_project').remove();
            $('#result_public').html("Проект успешно добавлен");
            
            // window.location.href = "/user";
            javascript:history.back();
        }
        if (data == "success_admin") {
            $('.save_project').remove();
            $('#result_public').html("Проект успешно добавлен");
            
            // window.location.href = "/admin";
            javascript:history.back();
        }
        else if(data == "empty"){
            $('#result_public').html("Укажите название проекта");
        }

        // else{
        //     $('#result_public').html(data);
        // }
    }
}

function AjaxSendAddLider() {
    $.post(
        '/ajax/add_lider',
        {
            familya: $('#familya').val(),
            name: $('#name').val(),
            otchestvo: $('#otchestvo').val(),
            city: $('#city').val(),
            telephone: $('#telephone').val(),
            email: $('#email').val(),
            region: $('#region').val(),
            birthday: $('#birthday').val(),
            social: $('#social').val(),
            contact_info: $('#contact_info').val(),
            reason: $('#reason').val(),
            i_can: $('#i_can').val(),
            i_need: $('#i_need').val(),
            id_lid: $('#id_lid').val(),
            liders_photo: $('.liders_photo').attr('src'),
            male_female: $('#male_female').val(),

            'file0[name]': $('#preview_file_0').val(),
            'file1[name]': $('#preview_file_1').val(),
            'file2[name]': $('#preview_file_2').val(),
            'file3[name]': $('#preview_file_3').val(),
            'file4[name]': $('#preview_file_4').val(),

            'file0[description]': $('#description0').val(),
            'file1[description]': $('#description1').val(),
            'file2[description]': $('#description2').val(),
            'file3[description]': $('#description3').val(),
            'file4[description]': $('#description4').val(),
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        // alert(data);
        if(data == "empty fio"){
            $('#result_public').html("Укажите ФИО лидера");
        }
        if (data == "success_user") {
            $('#result_public').html("Лидер успешно добавлен");
            $('#myModal').modal('show');
            $('.save_lider').remove();
            // window.location.href = "/user";
        }
        if (data == "success_admin") {
            $('#result_public').html("Лидер успешно добавлен");
            $('.save_lider').remove();
            // window.location.href = "/admin";
        }
        if (data == "empty email") {
            $('#result_public').html("Укажите email лидера");
            // window.location.href = "/admin";
        }
        
        // else{
        //     $('#result_public').html(data);
        // }


    }
}

function AjaxAddLider() {
    $.post(
        '/ajax/add_lider_to_project',
        {
            button: 'AddLider',
            counter: $('.checkSize').length,
            lider0: $('.lider0').length,
            lider1: $('.lider1').length,
            lider2: $('.lider2').length,
            lider3: $('.lider3').length,
            lider4: $('.lider4').length,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('.content_lider').last().after(data);
    }
}

function AjaxAddLiderFile() {
    $.post(
        '/ajax/add_lider_file_to_project',
        {
            button: 'AddFile',
            counter: $('.checkSizeFile').length,
            file0: $('.file0').length,
            file1: $('.file1').length,
            file2: $('.file2').length,
            file3: $('.file3').length,
            file4: $('.file4').length,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('.content_lider_file').last().after(data);
    }
}

function AjaxSendUpdateLider($status = '3') {
    $.post(
        '/ajax/edit_user',
        {
            id_lid: $('#id_lid').val(),
            familya: $('#familya').val(),
            name: $('#name').val(),
            otchestvo: $('#otchestvo').val(),
            city: $('#city').val(),
            telephone: $('#telephone').val(),
            email: $('#email').val(),
            region: $('#region').val(),
            birthday: $('#birthday').val(),
            social: $('#social').val(),
            contact_info: $('#contact_info').val(),
            img: $('#photoimg').val(),
            i_can: $('#i_can').val(),
            i_need: $('#i_need').val(),
            liders_photo: $('.liders_photo').attr('src'),
            male_female: $('#male_female').val(),

            'file0[name]': $('#preview_file_0').val(),
            'file1[name]': $('#preview_file_1').val(),
            'file2[name]': $('#preview_file_2').val(),
            'file3[name]': $('#preview_file_3').val(),
            'file4[name]': $('#preview_file_4').val(),

            'file0[description]': $('#description0').val(),
            'file1[description]': $('#description1').val(),
            'file2[description]': $('#description2').val(),
            'file3[description]': $('#description3').val(),
            'file4[description]': $('#description4').val(),
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == "success_user") {
            $('#result_public').html("Лидер успешно обновлен");
            $('.save_lider').remove();
            //if ($('#user_id').val() !== 'undefined') {
                //$id = $('#user_id').val();
                // window.location.href = "/user";
                javascript:history.back();
            //}
        }
        if (data == "success_admin") {
            $('#result_public').html("Лидер успешно обновлен");
            $('.save_lider').remove();
            //if ($('#user_id').val() !== 'undefined') {
                //$id = $('#user_id').val();
                // window.location.href = "/admin";
                javascript:history.back();
            //}
        }
        if(data == "empty fio"){
            $('#result_public').html("Укажите ФИО");
        }
        // else{
        //     $('#result_public').html(data);
        // }
    }
}


function AjaxSendUpdateProject() {
    $.post(
        '/ajax/update_project',
        {
            id_proj: $('#id_proj').val(),
            project_title: $('#project_title').val(),
            short_title: $('#short_title').val(),
            project_description: $('#project_description').val(),
            site: $('#site').val(),
            id_lid: $('#id_lid').val(),

            'metapredmets[business]': isChecked("input#business"),
            'metapredmets[engineer]': isChecked("input#engineer"),
            'metapredmets[eq]': isChecked("input#eq"),
            'metapredmets[it_prof]': isChecked("input#it_prof"),
            'metapredmets[personal]': isChecked("input#personal"),
            'metapredmets[proforient]': isChecked("input#proforient"),

            'predmets[arts]': isChecked("input#arts"),
            'predmets[lingvistic]': isChecked("input#lingvistic"),
            'predmets[pedagogy]': isChecked("input#pedagogy"),
            'predmets[sport]': isChecked("input#sport"),
            'predmets[social]': isChecked("input#social"),
            'predmets[techno]': isChecked("input#techno"),
            'predmets[naturall]': isChecked("input#naturall"),

            'ages[r_00_07]': isChecked("input#r_00_07"),
            'ages[r_12_15]': isChecked("input#r_12_15"),
            'ages[r_16_18]': isChecked("input#r_16_18"),
            'ages[r_19_25]': isChecked("input#r_19_25"),
            'ages[r_08_11]': isChecked("input#r_08_11"),
            'ages[r_all_life]': isChecked("input#r_all_life"),
            'ages[r_others]': isChecked("input#r_others"),
            'ages[r_parents]': isChecked("input#r_parents"),
            'ages[r_teachers]': isChecked("input#r_teachers"),

            liders_photo: $('.liders_photo').attr('src'),
            method: $('#method').val(),
            author: $('#author').val(),
            level: $('#level').val(),
            stage_of_project: $('#stage_of_project').val(),
            author_location: $('#author_location').val(),
            start_year: $('#start_year').val(),
            offline_geography: $('#offline_geography').val(),

            'lider0[fio]': $('#fio0').val(),
            'lider1[fio]': $('#fio1').val(),
            'lider2[fio]': $('#fio2').val(),
            'lider3[fio]': $('#fio3').val(),
            'lider4[fio]': $('#fio4').val(),

            'lider0[role]': $('#role0').val(),
            'lider1[role]': $('#role1').val(),
            'lider2[role]': $('#role2').val(),
            'lider3[role]': $('#role3').val(),
            'lider4[role]': $('#role4').val(),

            'file0[name]': $('#preview_file_0').val(),
            'file1[name]': $('#preview_file_1').val(),
            'file2[name]': $('#preview_file_2').val(),
            'file3[name]': $('#preview_file_3').val(),
            'file4[name]': $('#preview_file_4').val(),

            'file0[description]': $('#description0').val(),
            'file1[description]': $('#description1').val(),
            'file2[description]': $('#description2').val(),
            'file3[description]': $('#description3').val(),
            'file4[description]': $('#description4').val(),

        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == "success_user") {
            $('.save_project').remove();
            $('#result_public').html("Проект успешно обновлен");
            
            //if ($('#user_id').val() !== 'undefined') {
                //$id = $('#user_id').val();
                // window.location.href = "/user";
                javascript:history.back();
            //}
        }
        if (data == "success_admin") {
            $('.save_project').remove();
            $('#result_public').html("Проект успешно обновлен");
            
            //if ($('#user_id').val() !== 'undefined') {
                //$id = $('#user_id').val();
                // window.location.href = "/admin";
                javascript:history.back();
            //}
        }
        // else{
        //     $('#result_public').html(data);
        // }
    }
}
function AjaxSendPostLiders($numpage = 1) {
    $.post(
        '/filter',
        {
            filter_liders: $('#filter_liders').val(),
            numpage: $numpage,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('#content-main').html(data);
    }
}

