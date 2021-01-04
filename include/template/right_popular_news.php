<?php
if(!isset($arData) || empty($arData))
    return;
?>
<h3>Популярные новости</h3>
<?php printTemplateHtml('news/list', $arData); ?>