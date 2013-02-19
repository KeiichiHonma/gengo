// JavaScript Document

/* --------------------------------------------------------------------- */
/* form                                                                  */
/* --------------------------------------------------------------------- */

flag = false;
function form_submit(obj) {
    if (flag) {
        obj.disabled=true;
    }
    flag = true;
    obj.submit;
}
function form_confirm(obj) {
    if (flag) {
        obj.disabled=true;
    }
    flag = true;
    document.forms.gengoForm.submit;
}

function form_regist() {
    if (flag) {
        return false;
    }
    flag = true;
    document.forms.gengoForm.operation.value = "regist";
    document.forms.gengoForm.submit;
}
function form_back() {
    if (flag) {
        return false;
    }
    flag = true;
    document.forms.gengoForm.operation.value = "back";
    document.forms.gengoForm.submit;
}

function checkForm(obj){
    string = word_trim(obj.value);
    
    if(string == ""){
        return false;
    }
    
    return true;
}

function checkLogForm(obj,obj2,obj3){
    string = word_trim(obj.value);
    string2 = word_trim(obj2.value);
    string3 = word_trim(obj3.value);
    
    if(string == "" || string2 == "" || string3 == ""){
        return false;
    }
    
    return true;
}

function form_search(obj) {
    if (flag) {
        obj.disabled=true;
    }
    flag = true;
    if (obj.keyword.value != '') {
        obj.submit;
    }
    
}

//trim
function word_trim(string){
    var ret = string;
    ret = ret.replace(/ /g,"");
    ret = ret.replace(/　/g,"");
    return ret;
}

/* --------------------------------------------------------------------- */
/* file+form処理                                                         */
/* settingは必須項目の配列                                               */
/* --------------------------------------------------------------------- */
var error_messege = "";
function form_file_regist(setting) {
    error_messege = "";
    for(var i=0; i<setting.length; i++)
    {
        r = checkValidateMust(setting[i][0],setting[i][1]);
    }
    //if(r == false){
        //window.alert(error_messege); // 入力漏れがあれば警告ダイアログを表示
        //return false;
    //}
    if(error_messege != ""){
        window.alert(error_messege); // 入力漏れがあれば警告ダイアログを表示
        return false;
    }
    if (flag) {
        return false;
    }
    flag = true;
    document.forms.gengoForm.operation.value = "regist";
    document.forms.gengoForm.submit;
}

function checkValidateMust(form_name,message){
    r = true;
    // 設定開始（必須にする項目を設定してください）
    if(document.forms.gengoForm[form_name].value == ""){ // 「お名前」の入力をチェック
        //window.alert(form_name);
        //return false;
        r = false;
    }
    // 設定終了
    if(r == false){
        //window.alert(message); // 入力漏れがあれば警告ダイアログを表示
        error_messege += message+"\n";
        return false; // 送信を中止
    }else{
        return true; // 送信を実行
    }
}