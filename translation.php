<?php
//yiic message ../vendor/dbrisinajumi/d2company/translation.php
return array(
    'sourcePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR ,  //root dir of all source
    'messagePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR .'messages',  //root dir of message translations
    'languages'  => array('lv','ru','lt'),  //array of lang codes to translate to, e.g. es_mx
    'fileTypes' => array('php',), //array of extensions no dot all others excluded
    //'exclude' => array('.svn',),  //list of paths or files to exclude
    'translator' => 'Yii::t',  //this is the default but lets be complete
);

?>
