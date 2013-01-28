<?php
class csv
{
    static public function csvWriter($data,$csv_file){//無限にある場合は1行目のカラムを書出さない
        $fp = fopen( $csv_file, "a+" );
        
        /* ヘッダの作成例と出力 */
        $contents="";
        fputs($fp, $contents);
        
        foreach($data as $key => $val){
            $contents="";//初期化
            $contents .= "\"".$key."\",";//画像へのパス
            $contents .= "\"".$val."\"\n";//保存ディレクトリ
            /* ファイルに出力 */
            fputs($fp,mb_convert_encoding($contents,'UTF-8','UTF-8'));
        }
        fclose( $fp );
        //return $temp_filename;
    }

    static public function csvReader($csv_file){
        $finish_image = array();
        $fp = fopen( $csv_file, 'rb' );
        //$row = 0;
        //if($_POST['skip'] == "1")$row = 1;
        while($CSVRow=fgetcsv($fp,1000,",")){
            $finish_image[$CSVRow[0]] = $CSVRow[1];
            //$row++;
        }
        return $finish_image;
    }
}
?>