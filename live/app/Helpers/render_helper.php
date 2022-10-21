<?php
if ( ! function_exists('render_frontend'))
{
    function render_frontend(string $name, array $data = [], array $options = [])
    {
        return view(
            'includes/layout',
            [
                'content' => view($name, $data, $options),
            ],
            $options
        );
    }
    function render_userboard(string $name, array $data = [], array $options = [])
    {
        return view(
            'users/includes/userlayout',
            [
                'content' => view($name, $data, $options),
            ],
            $options
        );
    }
}