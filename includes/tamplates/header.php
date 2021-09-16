<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $function->getTitel($page_titel); ?></title>
    <link rel="stylesheet" href="<?php echo $css_path?>normalizieren.css">
    <link rel="stylesheet" href="<?php echo $css_path?>all.min.css">
    <link rel="stylesheet" href="<?php echo $css_path?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $css_path?>wieder.css">
    <link rel="stylesheet" href="<?php echo $css_path?>main.css">
</head>
<body <?php ;  if(isset($show_body_color)&&$show_body_color=="yes"){echo 'style="background-color: #222D32;"';}?>>
<div class="body">

