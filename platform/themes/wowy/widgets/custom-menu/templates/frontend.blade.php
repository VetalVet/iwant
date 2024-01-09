<ul>
    {{ $config['name'] }}
    {!!
        Menu::generateMenu(['slug' => $config['menu_id'], 'options' => ['class' => 'footer-list wow fadeIn animated mb-sm-5 mb-md-0']])
    !!}
</ul>