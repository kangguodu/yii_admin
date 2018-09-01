<?php

use Yii;

return [
    'adminEmail' => 'admin@example.com',
    'content_common_start' => '<div class="row"><div class="col-md-12"><div class="box box-info"><div class="box-body pad">',
    'content_common_end' => '</div></div></div></div>',
    'content_list_start' => '<div class="row"><div class="col-md-12"><div class="box box-default">',
    'content_list_end' => '</div></div></div>',
    'meme_host' => 'https://localhost/memecoinsapi/public/',
    'member_avatar' => 'https://localhost/memecoinsapi/public/images/avatar/avatar.png',
    'active_form_config' => [
            'options' => [
                    'class' => 'form-horizontal'
            ],
            'fieldConfig' => [  
                 'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-2\">{error}</div>",
                 'labelOptions' => ['class' => 'col-lg-2 control-label'], 
       	 	],
    ],
    'form_upload_config' => [
            'options' => [
                   'class' => 'form-horizontal',
                   'enctype'=>'multipart/form-data'
            ],
            'fieldConfig' => [  
                 'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-2\">{error}</div>",
                 'labelOptions' => ['class' => 'col-lg-2 control-label'], 
            ],
    ],
    'search_form_config' => [
        'action' => ['index'],
        'method' => 'get',
         'options' => [
                    'class' => 'list-search-form'
            ],
            'fieldConfig' => [  //统一修改字段的模板
                 'template' => "{label}\n{input}\n",
                 'labelOptions' => ['class' => 'input-group-addon'],  //修改label的样式
                 'options' => [
                    'class' => 'input-group input-group-sm',
                ],
            ],
    ]
];
