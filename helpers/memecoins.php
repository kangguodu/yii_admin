<?php



function yesOrNoTypes(){
	return [
		'1' => '是',
		'0' => '否',
	];
}

function disableOrNotTypes(){
    return [
        '1' => '啟用',
        '0' => '禁用',
    ];
}

function getDisableOrNotTypeText($type){
    $types = disableOrNotTypes();
    return isset($types[$type])?$types[$type]:'';
}

function activityTypes(){
	return [
		'1' => '圖文',
		'2' => '網址'
	];
}

function getActityTypeText($type){
	$types = activityTypes();
	return isset($types[$type])?$types[$type]:'';
}

function activityPlatformTypes(){
	return [
		'1' => '會員',
		'2' => '店家',
		'3' => '網紅',
	];
}

function getActityPlatformText($type){
	$types = activityPlatformTypes();
	return isset($types[$type])?$types[$type]:'';
}

function bannerUseTypes(){
	return [
		'1' => '首頁滾動圖片',
		'2' => '首頁廣告位'
	];
}

function getBannerUseTypeText($type){
	$types = bannerUseTypes();
	return isset($types[$type])?$types[$type]:'';
}

function bannerTypes(){
	return [
		'1' => '活動',
		'2' => '指定店家',
		'3' => '宣傳',
		'4' => 'App 內頁',
	];
}

function getBannerTypeText($type){
	$types = bannerTypes();
	return isset($types[$type])?$types[$type]:'';
}

function storeTypeTypes(){
	return [
		'1' => '已發佈',
		'0' => '未發佈'
	];
}

function getstoreTypeTypesText($type){
	$types = storeTypeTypes();
	return isset($types[$type])?$types[$type]:'';
}

function withdrawTypes(){
    return [
        '1' => '店家提現',
        '2' => '網紅提現'
    ];
}

function getwithdrawTypeText($type){
    $types = withdrawTypes();
    return isset($types[$type])?$types[$type]:'';
}

function withdrawStatus(){
    return [
        '0' => '提現中',
        '1' => '提現完成',
        '2' => '提現失敗'
    ];
}

function getwithdrawStatusText($type){
    $types = withdrawStatus();
    return isset($types[$type])?$types[$type]:'';
}

function noticeTypes(){
    return [
        '1' => '活動消息',
        '3' => '系統消息',
    ];
}

function getNoticeTypeText($type){
    $types = noticeTypes();
    return isset($types[$type])?$types[$type]:'';
}

function noticeLogTypes(){
    return [
        2 => '活動消息',
        1 => '系統消息',
        3 => '錢包消息'
    ];
}

function getNoticeLogTypeText($type){
    $types = noticeLogTypes();
    return isset($types[$type])?$types[$type]:'';
}

function storeServices(){
	return [
		'1' => '停車場',
		'2' => '外帶',
		'3' => 'Wifi',
		'4' => '外送',
		'5' => '插座',
		'6' => '寵物友善',
		'7' => '空調',
		'8' => '嬰兒座椅'
	];
}

function storeUserPosition(){
	return [
		'店長' => '店長',
		'正職員工' => '正職員工',
		'工讀生' => '工讀生',
	];
}

function getStoreUserPositionText($type){
    $types = storeUserPosition();
    return isset($types[$type])?$types[$type]:'';
}

function storeUserMenus(){
	return [
		'1' => '結帳管理',
		'2' => '資料設定',
		'3' => '我的帳戶',
		'4' => '下載專區',
		'5' => '聯繫客服',
		'6' => '帳號管理',
	];
}

function getStoreUserMenusArray(){
	return [
        [
            "title" => "結帳管理",
            "img" => "assets/imgs/menu-1.png",
            "type" => 1,
            "checked" => true
        ],
        [
            "title" => "資料設定",
            "img" => "assets/imgs/menu-2.png",
            "type" => 2,
            "checked" => true
        ],
        [
            "title" => "我的帳戶",
            "img" => "assets/imgs/menu-3.png",
            "type" => 3,
            "checked" => true
        ],
        [
            "title" => "下載專區",
            "img" => "assets/imgs/menu-4.png",
            "type" => 4,
            "checked" => true
        ],
        [
            "title" => "聯繫客服",
            "img" => "assets/imgs/menu-5.png",
            "type" => 5,
            "checked" => true
        ],
        [
            "title" => "帳號管理",
            "img" => "assets/imgs/menu-6.png",
            "type" => 6,
            "checked" => true
        ],
	];
}


function getStoreUserMenusData(){
    return [
        [
            "title" => "結帳管理",
            "img" => "assets/imgs/menu-1.png",
            "type" => 1,
            "checked" => false
        ],
        [
            "title" => "資料設定",
            "img" => "assets/imgs/menu-2.png",
            "type" => 2,
            "checked" => false
        ],
        [
            "title" => "我的帳戶",
            "img" => "assets/imgs/menu-3.png",
            "type" => 3,
            "checked" => false
        ],
        [
            "title" => "下載專區",
            "img" => "assets/imgs/menu-4.png",
            "type" => 4,
            "checked" => false
        ],
        [
            "title" => "聯繫客服",
            "img" => "assets/imgs/menu-5.png",
            "type" => 5,
            "checked" => false
        ],
        [
            "title" => "帳號管理",
            "img" => "assets/imgs/menu-6.png",
            "type" => 6,
            "checked" => false
        ],
    ];
}


function showIndexFormatDatetime($date){
    if(empty($date)){
        return null;
    }else if($date == '0000-00-00 00:00:00'){
        return null;
    }else{
        return $date;
    }
}

function showStoreServicesHtml($service){
    $services = json_decode($service,TRUE);
    $html = '';
    if($services !== null && $services !== false){
        foreach($services as $value){
            $html .= '<span class="label label-success">'.$value['name'].'</span> &nbsp;&nbsp;';
        }
    }
    return $html;
}

function getOrderStatus(){
    return [
        '-1' => '已取消',
        '0' => '待處理',
        '1' => '已完成',
        '2' => '已退貨',
    ];
}

function getOrderStatusText($type){
    $types = getOrderStatus();
    return isset($types[$type])?$types[$type]:'';
}