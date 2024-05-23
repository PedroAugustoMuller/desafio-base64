<?php
$dirPath = './files';
$newPath = './images';

$files = scandir($dirPath);
foreach($files as $file)
{
    $filePath = $dirPath . '/' . $file;
    if(is_file($filePath))
    {
        $f = fopen($filePath, 'r');
        $contents = fread($f, filesize($filePath));
        fclose($f);
        $data = explode( ',', $contents );
        $fileName = basename($file, '.txt');
        $extension = preg_split('#(/|;)#',$data[0]);
        $newFPath = $newPath .'/'. $fileName .'.'. $extension[1];
        $nf = fopen($newFPath, 'w');
        fwrite( $nf, base64_decode( $data[ 1 ] ) );
        fclose($nf);
    }
}