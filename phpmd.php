<?php

function markdown($string)
  {
    $rules['sm'] = array(
    '/(#+)(.*)/e'                  => 'md_header(\'\\1\', \'\\2\')',     // headers
    '/\[([^\[]+)\]\(([^\)]+)\)/'   => '<a href=\'\2\'>\1</a>',           // links
    '/(\*\*|__)(.*?)\1/'           => '<strong>\2</strong>',             // bold
    '/(\*|_)(.*?)\1/'              => '<em>\2</em>',                     // emphasis
    '/\~\~(.*?)\~\~/'              => '<del>\1</del>',                   // del
    '/\:\"(.*?)\"\:/'              => '<q>\1</q>',                       // quote
    '/\n\*(.*)/e'                  => 'md_ulist(\'\\1\')',               // unorderd lists
    '/\n[0-9]+\.(.*)/e'            => 'md_olist(\'\\1\')',               // orderd lists
    '/\n&gt;(.*)/e'                => 'md_blockquote(\'\\1\')',          // blockquotes
    '/\n([^\n]+)\n/e'              => 'md_paragraph(\'\\1\')',           // add paragraphs
    '/<\/ul><ul>/'                 => '',                                // fix extra ul
    '/<\/ol><ol>/'                 => '',                                // fix extra ol
    '/<\/blockquote><blockquote>/' => "\n"                               // fix extra blockquote
    );

    $rules['html'] = array(
    '(\s(http(|s)://\S{0,64})\s)' => ' <a href=\'\1\'>\1</a> ',                                 // url
    '(\s([a-zA-Z0-9.,+_-]{0,63}[@][a-zA-Z0-9.,-]{0,254})\s)' => ' <a href="mailto:\1">\1</a> '  // mail
    );


    $string = "\n".$string."\n";
    foreach($rules as $rule)
      {
        foreach($rule as $regex => $replace)
          {
            $string = preg_replace($regex, $replace, $string);
          }
      }

    return trim($string);
  }

function md_header ($chars, $header)
  {
    $level = strlen ($chars);
    return sprintf ('<h%d>%s</h%d>', $level, trim ($header), $level);
  }

function md_ulist ($item)
  {
    return sprintf ("\n<ul>\n\t<li>%s</li>\n</ul>", trim ($item));
  }

function md_olist ($item)
  {
    return sprintf ("\n<ol>\n\t<li>%s</li>\n</ol>", trim ($item));
  }

function md_blockquote ($item)
  {
    return sprintf ("\n<blockquote>%s</blockquote>", trim ($item));
  }

function md_paragraph ($line)
  {
    $trimmed = trim ($line);
    if (strpos ($trimmed, '<') === 0)
      {
        return $line;
      }
    return sprintf ("\n<p>%s</p>\n", $trimmed);
  }

?>