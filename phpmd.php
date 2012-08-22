<?php

error_reporting(E_ALL);

function markdown($string)
  {
    $rules['sm'] = array(
    '/(#+)(.*)/e'                        => 'md_header(\'\\1\', \'\\2\')',     // headers
    '/\[([^\[]+)\]\(([^\)]+)\)/'         => '<a href=\'\2\'>\1</a>',           // links
    '/(\*\*\*|___)(.*?)\1/'              => '<em><strong>\2</strong></em>',    // bold emphasis
    '/(\*\*|__)(.*?)\1/'                 => '<strong>\2</strong>',             // bold
    '/(\*|_)([\w| ]+)\1/'                => '<em>\2</em>',                     // emphasis
    '/\~\~(.*?)\~\~/'                    => '<del>\1</del>',                   // del
    '/\:\"(.*?)\"\:/'                    => '<q>\1</q>',                       // quote
    '/\n([*]+)\s([[:print:]]*)/e'        => 'md_ulist(\'\\1\', \'\\2\')',      // unorderd lists
    '/\n[0-9]+\.(.*)/e'                  => 'md_olist(\'\\1\')',               // orderd lists
    '/\n&gt;(.*)/e'                      => 'md_blockquote(\'\\1\')',          // blockquotes
    '/\n([^\n]+)\n/e'                    => 'md_paragraph(\'\\1\')',           // add paragraphs
    '/<\/ul>(\s*)<ul>/'                  => '',                                // fix extra ul
    '/(<\/li><\/ul><\/li><li><ul><li>)/' => '</li><li>',                       // fix extra ul li
    '/(<\/ul><\/li><li><ul>)/'           => '',                                // fix extra ul li
    '/<\/ol><ol>/'                       => '',                                // fix extra ol
    '/<\/blockquote><blockquote>/'       => "\n"                               // fix extra blockquote
    );

    $rules['html'] = array(
    '(\s(http(|s)://\S{0,64})\s)'                        => ' <a href="\1">\1</a> ',         // url
    '(([a-zA-Z0-9.,+_-]{0,63}[@][a-zA-Z0-9.,-]{0,254}))' => ' <a href="mailto:\1">\1</a> ',  // mail
    '((\+)[0-9]{5,63})'                                  => ' <a href="tel:\0">call \0</a>'  // phone
    );

    $rules['tweet'] = array(
    '((@)(\S*))' => ' <a href=\'https://twitter.com/\3\'>\1</a> ',                          // user
    '((#)(\S*))' => ' <a href=\'https://twitter.com/#!/search/?src=hash&q=%23\3\'>\1</a> '  // hashtag
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

function md_ulist ($count, $string)
  {
    $return = trim($string);
    $count  = strlen($count);
    $i      = 0;
    while($i != $count)
      {
        $return = '<ul><li>'.$return.'</li></ul>';
        ++$i;
      }
    return $return;
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