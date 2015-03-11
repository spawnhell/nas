<?php
 return array(
     'controllers' => array(
         'invokables' => array(
             'Index\Controller\Index' => 'Index\Controller\IndexController',
         ),
     ),
     
     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'index_index' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/index/index[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Index\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'index' => __DIR__ . '/../view',
         ),
     ),
 );