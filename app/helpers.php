<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * convert markdown to html
 * @param $markdown
 * @return string
 */
function parsedown($markdown)
{
    return app('parsedown')->text($markdown);
}

function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return Str::limit($excerpt, $length);
}

function html_to_markdown($html)
{
    $converter = app(\League\HTMLToMarkdown\HtmlConverter::class, ['options' => ['header_style' => 'atx']]);
    $markdown = $converter->convert($html);
    return $markdown;
}

function query_if($name, $value = null)
{
    $result = request()->query($name);
    return !empty($result) && $result == $value;
}
