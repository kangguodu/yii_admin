

```
cd /var/www/html/mememanager
sed -i "s|localhost:8082/memecoinsapi|services.memecoins.com.tw/memecoins|" config/params.php
sed -i "s|memecoinsapi|memecoins|" config/web.php
sed -i "s|localhost:8082|services.memecoins.com.tw|" config/web.php
sed -i "s|define('YII_DEBUG', true)|define('YII_DEBUG', false)|" web/index.php
sed -i "s|define('YII_ENV', 'dev')|define('YII_DEBUG', prod)|" web/index.php
sed -i "s|'username' => 'root'|'username' => 'memecoins'|" config/db.php
sed -i "s|'password' => 'wakasann'|'password' => 'B9g=cim01)G)'|" config/db.php
sed -i "s|localhost:8082/memecoinsapi|services.memecoins.com.tw/memecoins|" services/ImageToolService.php
```


添加App內頁Url

```
ALTER TABLE `banner` ADD `app_page` VARCHAR(255) NULL COMMENT 'App内页页面' AFTER `url`;
```


```
ce /var/www/html/memecoinsapi
sudo mkdir -p public/upload/avatar
sudo mkdir -p public/upload/notice
sudo mkdir -p public/upload/banner
sudo mkdir -p public/upload/activity
sudo mkdir -p public/upload/store
sudo mkdir -p public/upload/goods
mkdir -p public/upload/{avatar,notice,banner,activity,store,goods}
sudo chmod 777 public/upload/* -R
```

```
ALTER TABLE `banner` ADD `rank` INT NOT NULL DEFAULT '1' COMMENT '排序' AFTER `app_page`;
ALTER TABLE `store` ADD `status` INT NOT NULL DEFAULT '1' COMMENT '店家状态' AFTER `service`;
ALTER TABLE `store` CHANGE `avg_cost_high` `avg_cost_high` MEDIUMINT(8) NULL DEFAULT '0';
ALTER TABLE `store_user` ADD `created_at` DATETIME  NULL COMMENT '注册时间' AFTER `menus`, ADD `updated_at` DATETIME NULL COMMENT '更新时间' AFTER `created_at`;
ALTER TABLE `store_user` ADD `last_login` DATETIME NULL COMMENT '最后登录时间' AFTER `updated_at`;
```


```
php artisan db:seed --class=StoreCodes
```

beta

```
cd /var/www/html/mememanager
sed -i "s|localhost:8082|office.techrare.com|" config/params.php
sed -i "s|localhost:8082|office.techrare.com|" config/web.php
sed -i "s|'password' => 'wakasann'|'password' => 'tech123ABC'|" config/db.php
sed -i "s|localhost:8082|office.techrare.com|" services/ImageToolService.php
sed -i "s|office.techrare.com/memecoins-register-h5/#/register/|services.memecoins.com.tw/memecoins-register-h5/index.html#/register/|" models/ImageSign.php
```

#### 180827 ####

```
ALTER TABLE `image_sign` ADD `can_apply` TINYINT(1) NULL DEFAULT '1' COMMENT '顯示在 其他項目申請' AFTER `price`;
ALTER TABLE `image_sign` ADD `showat_download` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '顯示在下載區' AFTER `can_apply`;
```