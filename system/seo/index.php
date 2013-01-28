<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');

$uid = $con->base->getPath('uid',TRUE);//リダイレクトあり

require_once('user/logic.php');
$u_logic = new userLogic();
$user = $u_logic->getOneUser($uid);

if(!$user){
    require_once('fw/errorManager.php');
    errorManager::throwError(E_CMMN_USER_EXISTS);
}

$con->t->assign('user',$user);

require_once('fw/crawlerUtil.php');
$crawler_util = new crawlerUtil();
$crawler_util->setUserHtmlFiles($user[0]['col_directory']);

//$con->t->assign('html_files',$crawler_util->html_files);

require_once('seo/logic.php');//manager
$u_logic = new seoLogic();
$seo_tmp = $u_logic->getSeo($uid);
$seo = FALSE;
if($seo_tmp){
    foreach ($seo_tmp as $value){
        //$seo[$value['col_absolute_path']][] = array('sid'=>$value['_id'],'html_file'=>$value['col_html_file']);
        $seo[$value['col_absolute_html_file']] = $value;
    }
}

$new_html_files = array();

//SEOが設定されているかどうか
foreach ($crawler_util->html_files as $absolute_path => $html_files){
    foreach ($html_files as $key => $html_file){
        if($seo && array_key_exists($absolute_path.'/'.$html_file,$seo)){
            //seoデータあり
            $new_html_files[$absolute_path.'/'.$html_file] = $seo[$absolute_path.'/'.$html_file];
            //要素削除
            unset($seo[$absolute_path.'/'.$html_file]);
        }else{
            //seoデータなし
            $new_html_files[$absolute_path.'/'.$html_file] = FALSE;
        }
    }
    
}

$con->t->assign('html_files',$new_html_files);

//seoごみデータがあるか
if(count($seo) > 0){
    $con->t->assign('trash_seo',$seo);
}



$con->t->assign('seo',$seo);
$con->append();
?>
