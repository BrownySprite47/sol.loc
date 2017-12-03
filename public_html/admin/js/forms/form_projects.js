$(function(){

  $("#project_interview_date").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1
  });

  $("#project_create_date").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1
  });

  $("#project_start_date").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1,
      yearRange: "1900:+0"
  });

  $('#form_projects').on('keydown', function(e) {
    if(e.ctrlKey && (e.which == 83)) {
      e.preventDefault();
      $(this).submit();
      return false;
    }
  });

  $('#form_projects').submit ( function(){
    if(!bFormCheck)
  	{
  	  vServerFormCheck($(this));
  	}
    return bFormCheck;
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

var bFormCheck = false;

function vServerFormCheck(oForm)
{
  function vServerFormCheckSuccess(sResult)
  {
  	if(IsJsonString(sResult))
  	{
  	  var aData = JSON.parse(sResult);

  	  if(aData.result == 1)
  	  {
  	  	bFormCheck = true;
  	  	$('#form_projects').submit();
  	  }
  	  else
  	  {
  	  	aData.data.forEach(function(sItem)
  	    {
  	      oForm.find("input[name='" + sItem + "']").addClass('error');
        });
  	  }
  	}
  }

  $.ajax({
    type: "POST",
    url: "./index.php?module_name=projects&&action_name=form_check",
    data: oForm.serialize(),
    response: "text",
    success: vServerFormCheckSuccess
  });
}