<?php
return [
    
    'gridViewSizes'=>[10 => 10, 25 => 25, 50 => 50, 100 => 100],
    'defaultGridPageSize'=>10,
    'import' =>[
        'customer'         => 'Customer',
        'product'          => 'Product',
        'customer group'   => 'Customer Group' ,
        'product group'    => 'Product Group' ,
        'product category' => 'Product Category' ,
        'supplier'         => 'Suppliers' ,
        'currency'         => 'Currencies' ,
    ],
    'phase' =>[
    	'A'   => 'A',
        'B'   => 'B' ,
        'C'   => 'C' ,
        'D'   => 'D' ,
        'E'   => 'E' ,
        'F'   => 'F' ,
    ],
    'customer' =>
    [
        'row' => '3',
        'tablename' => "customer",
        'column' =>"c_name,c_email,c_contact_no",
    ],
    'upload_config'=>[
        'productimage'=>[
            'upload_folder'=>'productimage',
            'file_name_element'=>'',
            'resize_arr'=>[
                'thumb'=>[
                    'height'=>60,
                    'width'=>60,
                    'folder_name'=>'thumb'
                ],
                'tile'=>[
                    'height'=>130,
                    'width'=>130,
                    'folder_name'=>'tile'
                ],
            ]
        ],
        'file'=>[
                    'upload_folder'=>'productimage',
                    'file_name_element'=>'',
                    'resize_arr'=>[
                        'thumb'=>[
                            'height'=>60,
                            'width'=>60,
                            'folder_name'=>'thumb'
                        ],
                        'tile'=>[
                            'height'=>130,
                            'width'=>130,
                            'folder_name'=>'tile'
                        ],
                    ]
                ],
                'video'=>[
                    'upload_folder'=>'productvideo',
                    'file_name_element'=>'',
                    
                ],
                 'profilepicture'=>[
                    'upload_folder'=>'profileimage',
                    'file_name_element'=>'',
                    
                ],

        ],

   
];
