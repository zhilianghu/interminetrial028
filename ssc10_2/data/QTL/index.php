<html>
<head>
<title>NAGRP Community Data Repository</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html">
<META NAME="AUTHOR" CONTENT="Zhiliang Hu">
<META NAME="description" CONTENT="NAGRP Research Community Data Repository">
<META NAME="keywords" CONTENT="NAGRP, NRSP8, NRSP-8, livestock animals, genome, genomics,
 gene, genetics, QTL, DNA, pig, swine, sow, boar, pork, chicken, cow, cattle, bovine,
 ovine, sheep, chick, chicken, hen, cock, broiler, fish, aquaculture">
<link href="/default/style.css" rel="stylesheet" type="text/css" />
<STYLE TYPE="text/css"><!--
BODY { max-width: 800px; margin:5px auto; font-size:10pt; }
TR.h  { background-color:#eee; height:1.8em; }
TD    { font-family:verdana,helvetica,arial,sans-serif;padding:2 8px;
        color:navy; font-size:10pt; vertical-align:middle;}
TD.hd { background-image:url('/icons/hbg.gif'); padding:4px;
        font-size:10pt;font-weight:bold;color:#fff; }
A     { vertical-align:text-top;text-decoration:none; color:#1234ed; }
A:visited { color:#4321de;}
IMG.w { width:19px; text-align:center; margin-right:4px; }
#INHE { color: inherit; }
#DIMC { color: #998877; }
-->
</STYLE>
</head>

<body>
<pre style='color:brown'>

This folder location is corresponding to that defined in the project.xml:

   &lt;property name="src.data.dir" location="/home/apache/intermine3/ssc10_2/data/QTL"/&gt;

</pre>
<table border='0' style="margin:0 3px;padding:0;" cellspacing=0 cellpadding=0>
<tr><td colspan=2>
<TABLE border=0 width="750" cellpadding=3 cellspacing=1 style='table-layout:fixed;'>
<TR><TD class="hd" width="500">Name</TD>
    <TD class="hd" width="90">Size</TD>
    <TD class="hd" width="160">Time Last Modified</TD>
</TR>
<?php
require_once("/home/apache/doc/default/php/format_bytes");
require_once("/home/apache/doc/default/php/getfoldersize.php");
$dir='.';
$files = scandir($dir);
$showed = 0;
$excl_pattn='index|HEAD|CITATION|CINOTE|LINKOUT|README|RELEASE|CONTACT|create|back|tmp|\.(php|html|gif|jpg|png|log|pl|sh)$';
foreach($files as $fname) {
  if ((preg_match("/txt/",$fname)) || (!preg_match("/^\.|index|^README$|^HEAD|CINOTE|back|\.sh$|\.php$|\.pl$|\.log$|~$|tmp/",$fname))) { #-- "/txt/": exception to hidding ".php" files
    $fcount=0;
    $ftime = date('Y-m-d H:i:s',filemtime("$fname"));
   #--
    $filtime = filemtime("$fname"); #-file create time
    $nowtime = time();
    $filaged = ((($nowtime - $filtime)/60)/60)/24;  #- file created xx days ago
    if ($filaged < 30) {                            #- Flag 'new' when created
      $flagnew = "<img src=\"/icons/newest.gif\">"; #- in 30 days
    } else { $flagnew=""; }                         #
   #--
    $fsize = format_bytes(filesize("$fname"));
    if (is_dir($fname)) {
      $ficon = "/icons/dir2.png";
      $fcount = GetFolderSize("$fname","$excl_pattn"); #- count number of files
      if ($fcount > 0) {
        $fsize = "<font style=\"color:#006400;\">$fcount files</font>";
      } else {
        $fsize = "<font style=\"color:#006400;\">0 file</font>";
      }
    } elseif ((is_file($fname)) || (is_link($fname))) {
      if (preg_match("/\.bin$/i","$fname")) {
        $ficon = "/icons/small/bin.png";
      } elseif (preg_match("/\.doc(x)?$/i","$fname")) {
        $ficon = "/icons/small/doc.png";
      } elseif (preg_match("/\.gff$/i","$fname")) {
        $ficon = "/icons/small/ods.png";
      } elseif (preg_match("/\.tar$/i","$fname")) {
        $ficon = "/icons/small/tar.png";
      } elseif (preg_match("/\.txt$|README$/","$fname")) {
        $ficon = "/icons/small/txt.png";
      } elseif (preg_match("/\.zip$|\.gz$/i","$fname")) {
        $ficon = "/icons/small/zip.png";
      } elseif (preg_match("/\.csv$/i","$fname")) {
        $ficon = "/icons/small/csv.png";
      } elseif (preg_match("/\.ppt$/i","$fname")) {
        $ficon = "/icons/small/ppt.png";
      } elseif (preg_match("/\.tgz$|\.gz$/i","$fname")) {
        $ficon = "/icons/small/tgz.png";
      } elseif (preg_match("/\.xls$/i","$fname")) {
        $ficon = "/icons/small/xls.png";
      } elseif (preg_match("/\.xlsx$/i","$fname")) {
        $ficon = "/icons/small/xls.png";
      } elseif (preg_match("/\.pdt$/i","$fname")) {
        $ficon = "/icons/book1_small.gif";
      } elseif (preg_match("/\.pdf$/","$fname")) {
        $ficon = "/icons/pdficon3.gif";
      } elseif (preg_match("/\.pdx$/","$fname")) {
        $ficon = "/icons/bookshlf_small.gif";
      } elseif (preg_match("/\.fa$/","$fname")) {
        $ficon = "/icons/small/fasta.png";
      } elseif (preg_match("/\.ht2$/","$fname")) {
        $ficon = "/icons/small/file.gif";
      } elseif (preg_match("/\.md5$/","$fname")) {
        $ficon = "/icons/checksum.png";
      } elseif (preg_match("/\.rdata$/","$fname")) {
        $ficon = "/icons/small/rdata.png";
      } elseif (!is_readable("$fname")) {
        $ficon = "/icons/small/nrd.png";
      } else {
        $ficon = "/icons/small/file.png";
      }
    } else {
      $ficon = "/icons/unknown.gif";
    }
    if (strlen($fname) > 50) {
      $shownm = substr("$fname",0,45) . "..."; 
    } else {
      $shownm = "$fname";
    }
    $shownm = preg_replace("/\.php$|\.html$/","","$shownm");
    print "<TR class='h'><TD><img class='w' src=\"$ficon\"> <a href=\"$fname\">$shownm</a> $flagnew</TD><TD align=\"right\">$fsize</TD><TD align=\"right\">$ftime</TD></TR>\n"; 
    $showed++;   
  }
} #- END 'foreach' file
?>
</TABLE>

</body>
</html>

