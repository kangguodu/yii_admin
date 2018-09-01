<?php
use mdm\admin\components\MenuHelper;


$callback = function($menu){
    $data = $menu['data'];
    return [
        'label' => $menu['name'],
        'url' => [$menu['route']],
        'option' => $data,
        'icon' => $menu['data'],
        'items' => $menu['children'],
    ];
};

$items = MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback, true);
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <?php echo  dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $items
            ]
        ) ?>
    </section>
</aside>
