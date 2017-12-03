$(function(){
  $('#form_cities').submit ( function(){
    return bFormCheck($(this));
  });

});

function bFormCheck(oForm)
{
  var bResult = true;

  var oTempElement = oForm.find("input[name='city_name']");
  if(oTempElement.val() == "")
  {    bResult = false;
    oTempElement.addClass('error');
    oTempElement.next('p').html('Поле обязательно для заполнения');
    oTempElement.next('p').addClass('error_text');  }

  oTempElement = oForm.find("input[name='city_order']");
  if(oTempElement.val() == "")
  {
    bResult = false;
    oTempElement.addClass('error');
    oTempElement.next('p').html('Поле обязательно для заполнения');
    oTempElement.next('p').addClass('error_text');
  }

  return bResult;
}