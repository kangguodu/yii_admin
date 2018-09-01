<?php

$url = 'https://localhost:8082/mememanager2/web/index.php?r=store-user%2Findex&StoreUserSearch%5Bid%5D=&StoreUserSearch%5Bstore_id%5D=1&StoreUserSearch%5Bnickname%5D=&StoreUserSearch%5Bemail%5D=&StoreUserSearch%5Bmobile%5D=';

var_dump(urldecode($url));

$url2 = 'https://localhost:8082/mememanager2/web/index.php?r=store-user%2Findex&1%5BStoreUserSearch%5Bstore_id%5D%5D=10032';

var_dump(urldecode($url2));