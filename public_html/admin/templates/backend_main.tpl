{config_load file="config.conf"}<!DOCTYPE html>
<html lang="ru">
<head>
    <title>{if isset($aPageData.html_title)}{$aPageData.html_title}{/if}</title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{#PROJECT_BACKEND_URL#}images/favicon.ico" type="image/ico" />
    <link rel="stylesheet" href="{#PROJECT_BACKEND_URL#}css/main.css" />
    <link rel="stylesheet" href="{#PROJECT_BACKEND_URL#}css/jquery-ui.min.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="{#PROJECT_BACKEND_URL#}js/jquery-ui.min.js"></script>
    <script src="{#PROJECT_BACKEND_URL#}js/jquery.main.js"></script>
    
    {if isset($aPageData.java_scripts)}{foreach from=$aPageData.java_scripts item=item}<script src="{$item}"></script>{/foreach}{/if}
    <script src="{#PROJECT_BACKEND_URL#}js/fixed_menu.js"></script>
    <style type="text/css">
        #header-fixed, #header-fixed-fio {
            position: fixed;
            display: none;
            z-index: 9000;
        }
    </style>
</head>
<body>
    <!-- site -->
    <div class="site">
        <div class="site__layout">

            <table class="site__content">

                <tr>
                    <td>

                        <!-- left_aside -->
                        <aside class="left_aside active">
                            <div class="aside_content">
                            <div class="menu_btn active"></div>

{if isset($aMenu)}
<ul class="sub_menu">
{foreach from=$aMenu item=item}
{if isset($item.items)}
<li>
<a class="dropdown{if isset($item.active)} active open{/if}" href="#">{$item.menu_name}</a>
<ul>
{foreach from=$item.items item=i}
<li><a {if isset($i.active)}class="current" {/if}href="{$i.menu_url}">{$i.menu_name}</a></li>
{/foreach}
</ul>
</li>
{else}
<li><a {if isset($item.active)}class="current" {/if}href="{$item.menu_url}">{$item.menu_name}</a></li>
{/if}
{/foreach}
</ul>
{/if}
                            </div>
                        </aside>
                        <!-- /left_aside -->

                    </td>
                    <td style="border-left: 1px solid #e5e5e5; width: 100%;">
                        <div class="content">

                          {include file="`$sInnerPage`.tpl"}

                        </div>
                        {if $sInnerPage eq "backend_leaders_view" or $sInnerPage eq "backend_projects_view"}<div id="search_block"></div>{/if}
                    </td>
                </tr>
            </table>

        </div>
    </div>
    <!-- /site -->
<script type="text/javascript">fixTable();</script>
</body>
</html>