<?php

// Create ZIP file
if(isset($_POST['submit'])){
 $zip = new ZipArchive();
 $filename = "./abstracts.zip";

 if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
  exit("cannot open <$filename>\n");
 }

 $dir = 'abstracts/';

 // Create zip
 createZip($zip,$dir);

 $zip->close();
}

// Create zip
function createZip($zip,$dir){
 if (is_dir($dir)){

  if ($dh = opendir($dir)){
   while (($file = readdir($dh)) !== false){
 
    // If file
    if (is_file($dir.$file)) {
     if($file != '' && $file != '.' && $file != '..'){
 
      $zip->addFile($dir.$file);
     }
    }else{
     // If directory
     if(is_dir($dir.$file) ){

      if($file != '' && $file != '.' && $file != '..'){

       // Add empty directory
       $zip->addEmptyDir($dir.$file);

       $folder = $dir.$file.'/';
 
       // Read data of the folder
       createZip($zip,$folder);
      }
     }
 
    }
 
   }
   closedir($dh);
  }
 }
}

// Download Created Zip file
if(isset($_POST['submit'])){
 
 $filename = "abstracts.zip";

 if (file_exists($filename)) {
  header('Content-Type: application/zip');
  header('Content-Disposition: attachment; filename="'.basename($filename).'"');
  header('Content-Length: ' . filesize($filename));

  flush();
  readfile($filename);
  // delete file
  unlink($filename);
 
 }
}




//THIS IS STACK OVERFLOW
//$dir = "abstracts";
//
//// Sort in ascending order - this is default
//$files = scandir($dir);
//
//
//$zipname = 'abstractFolder.zip';
//$zip = new ZipArchive;
//$zip->open($zipname, ZipArchive::CREATE);
//foreach ($files as $file) {
//  $zip->addFile($file);
//}
//$zip->close();
//header('Content-Type: application/zip');
//header('Content-disposition: attachment; filename='.$zipname);
//header('Content-Length: ' . filesize($zipname));
//readfile($zipname);



//THIS STACK OVER FLOW
//$zipname = 'abstractFolder.zip';
//$zip = new ZipArchive;
//$zip->open($zipname, ZipArchive::CREATE);
//$folder= "abstracts";
// $handle = opendir($folder);
//    while (false !== $f = readdir($handle)) {
//      if ($f != '.' && $f != '..') {
//        $filePath = "$folder/$f";
//        // Remove prefix from file path before add to zip.
//        //$localPath = substr($filePath, $exclusiveLength);
//        if (is_file($filePath)) {
//          $zip->addFile($filePath);
//      }
//     //       elseif (is_dir($filePath)) {
////          // Add sub-directory.
////          $zipFile->addEmptyDir($localPath);
////          self::folderToZip($filePath, $zipFile, $exclusiveLength);
////        }
//      }
//    }
//    closedir($handle); 
//



?>