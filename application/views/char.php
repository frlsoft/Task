<?php
echo validation_errors();
$CI = get_instance();
$CI->load->helper('url','libchart/classes/libchart_helper');
$chart = new VerticalBarChart();

$dataSet = new XYDataSet();
$dataSet->addPoint(new Point("Jan 2005", 273));
$dataSet->addPoint(new Point("Feb 2005", 421));
$dataSet->addPoint(new Point("March 2005", 642));
$dataSet->addPoint(new Point("April 2005", 800));
$dataSet->addPoint(new Point("May 2005", 1200));
$dataSet->addPoint(new Point("June 2005", 1500));
$dataSet->addPoint(new Point("July 2005", 2600));
$dataSet->addPoint(new Point("Jul1y 2005", 2600));
$chart->setDataSet($dataSet);

$chart->setTitle("Monthly usage for www.example.com");

//$chart->render("http://127.0.0.1/code/imagedata/demo11221.png");