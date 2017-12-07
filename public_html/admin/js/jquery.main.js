$(function(){

    $('.menu_btn').on('click', function(){
        if($(this).hasClass('active')){
            $('.left_aside').removeClass('active');
            $(this).removeClass('active').next('.sub_menu').hide();
            $('#my_content').css('padding-left', '36px');

        } else {
            $('.left_aside').addClass('active');
            $(this).addClass('active').next('.sub_menu').show();
            $('#my_content').css('padding-left', '270px');
        }
        $('#header-fixed').hide();
        $('#header-fixed-fio').hide();
        $(window).scroll();
    });

    $('input, textarea, select').focusout(function(){
        if($(this).hasClass('error')){
            $(this).next('p').html('');
            $(this).removeClass('error');
        }
    });

    $('input, textarea, select').keydown(function(){
        if($(this).hasClass('error')){
            $(this).next('p').html('');
            $(this).removeClass('error');
        }
    });

    $('.dropdown').on('click', function(){
        if ($(this).hasClass('active'))
        {
            $(this).removeClass('active');
            $(this).next('ul').hide();
        }
        else
        {
            $(this).addClass('active');
            $(this).next('ul').show();
        }
        return false;
    });

    $('.options_add').on('click', function(){
        var sClassName = $(this).attr('for');
        if($(this).hasClass('open'))
        {
            $(this).removeClass('open');
            $('.' + sClassName).fadeOut();
        }
        else
        {
            $(this).addClass('open');
            $('.' + sClassName).fadeIn(800);
        }

    });

    $('.options_add').not('.open').each(function(){
      $('.'+$(this).attr('for')).hide();
    });


    $('.has_info').on('click', function(){
      $(this).find('.popup_info').show();
    });

    $('.popup_info_link').focus(function(){
      $(this).parent().find('.popup_info').show();
    });

    $('.has_info').hover(function(){
      $(this).find('.popup_info').show();
    });

    $('.has_info').mouseleave(function(){
      $(this).find('.popup_info').hide();
    });

    $(document).keyup(function(e) {
      if(e.keyCode === 27)
      {
      	$('.popup_info').hide(); // esc
      }
    });

});

function IsJsonString(sText)
{
  try
  {
    JSON.parse(sText);
  }
  catch(e)
  {
    return false;
  }
  return true;
}

function vSetSearchData(sInputId, iContentId, iContentName = '')
{
  // console.log($iContentId);
  // alert($iContentId);
  if (iContentName != '') {
    $("#" + sInputId + "_tag").val(iContentId);
    $("#" + sInputId).val(iContentName);
  }else{
    $("#" + sInputId).val(iContentId);
  }
  
  $("#search_block").hide().html("");
}

function vSearch(sInputId, iTypeId)
{
  function vSearchSuccess(sResult)
  {
  	//рисуем таблицу

  	var sResultText = '<table class="form_table" style="width: 100%;"><tbody>';

  	if(IsJsonString(sResult))
  	{
  	  var aData = JSON.parse(sResult);

  	  

  	  aData.forEach(function(aItem)
  	  {

        if(aItem.content_odd == '1')
        {
          sClass = ' class="odd"';
        }

        else
        {
          sClass = '';
        }
        if(aItem.content_name_other != "")
        {
          aItem.content_name = aItem.content_name + " (" + aItem.content_name_other + ")";
        }
        if (aItem.content_tag == '1') {
          //console.log(aItem.content_name);
            sResultText = sResultText + '<tr' + sClass + '><td><p>' + aItem.content_name + '</p></td><td class="small"><a href="#" onclick="vSetSearchData(\'' + sInputId + '\', ' + aItem.content_id + ', \'' + aItem.content_name + '\'); return false;">выбрать</a></td></tr>';
        }else{
            sResultText = sResultText + '<tr' + sClass + '><td><a href="' + aItem.content_url + '" target="_blank">' + aItem.content_name + '</a></td><td class="small"><a href="#" onclick="vSetSearchData(\'' + sInputId + '\', ' + aItem.content_id + '); return false;">выбрать</a></td></tr>';

        }

      });
  	}
  	else
  	{
  	  sResultText = sResultText + '<tr><td>Ничего не найдено</td></tr>';
  	}

  	sResultText = sResultText + '</tbody></table>';
  	$("#search_block").html(sResultText);

  	$('#search_block').css({'top':$('#' + sInputId).offset().top + 28,'left':$('#' + sInputId).offset().left});
  	$('#search_block').show();
  }

  var sSearchText = $("#" + sInputId).val().trim();

  if(sSearchText.length > 2)
  {
  	//можно запускать поиск

  	$.ajax({
            type: "POST",
            url: "./index.php?module_name=search",
            data: "search_text=" + sSearchText + "&type_id=" + iTypeId,
            response: "text",
            success: vSearchSuccess
    });
  }
  else
  {
  	//строка короткая, искать нечего
  	$("#search_block").hide().html("");
  }
}