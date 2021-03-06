$(function(){

  $("#project_interview_date").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1
  });

  $("#project_start_date").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1
  });

  $('#form_projects').submit ( function(){
    return bFormCheck($(this));
  });

  $('input.search_link_2').on('input', function(e){
        e.preventDefault();
        vSearch($(this).attr('id'), 2);
  });

  /*$('input.search_link_1').on('blur', function(e){
    $("#search_block").hide().html("");
  });*/

  $(document).mouseup(function (e){
        var div = $('#search_block');
        if (!div.is(e.target) && div.has(e.target).length === 0) {
            $("#search_block").hide().html("");
        }
  });

});

function bFormCheck(oForm)
{
  var bResult = true;

  var oTempElement = oForm.find("input[name='project_name']");
  if(oTempElement.val() == "")
  {
    bResult = false;
    oTempElement.addClass('error');
    oTempElement.next('p').html('Поле обязательно для заполнения');
    oTempElement.next('p').addClass('error_text');
  }

  return bResult;
}