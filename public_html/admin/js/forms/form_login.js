$(function(){
  $('#form_login').submit ( function(){
    return bFormCheck($(this));
  });

});

function bFormCheck(oForm)
{
  var bResult = true;

  var oTempElement = oForm.find("input[name='backend_user_login']");
  if(oTempElement.val() == "")
  {    bResult = false;
    oTempElement.addClass('error');  }

  oTempElement = oForm.find("input[name='backend_user_password']");
  if(oTempElement.val() == "")
  {
    bResult = false;
    oTempElement.addClass('error');
  }

  return bResult;
}