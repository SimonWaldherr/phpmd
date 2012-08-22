#phpmd

convert md to html via php and regex

##SM

Markdown  | HTML              | Preview 
----------|-------------------|---------
`#Header` | `<h1>Header</h1>` | **Header** 
`[link](http://google.de/)` | `<a href="http://google.de/">link</a>` | [link](http://google.de/)
`***string***` | `<em><strong>string</strong></em>` | ***string***
`**string**` | `<strong>string</strong>` | **string**
`*string*` | `<em>string</em>` | *string*
`* list` | `<ul><li>list</li></ul>` | &bull; list
`1. list` | `<ol><li>list</li></ol>` | 1. list


##HTML

Markdown  | HTML              | Preview 
----------|-------------------|---------
`http://simon.waldherr.eu/` | `<a href="http://simon.waldherr.eu/">http://simon.waldherr.eu/</a>` | <http://simon.waldherr.eu/>
`mail@example.tld` | `<a href="mailto:mail@example.tld">mail@example.tld</a>` | <mail@example.tld>
`+491234567890` | `<a href="tel:+491234567890">call +491234567890</a>` | [call +491234567890](tel:+491234567890)


##TWEET

Markdown  | HTML              | Preview 
----------|-------------------|---------
`@simonwaldherr` | `<a href='https://twitter.com/simonwaldherr'>@simonwaldherr</a>` | [@simonwaldherr](https://twitter.com/simonwaldherr)
`#hashtag` | `<a href='https://twitter.com/#!/search/?src=hash&q=%23hashtag'>#hashtag</a>` | [\#hashtag](https://twitter.com/#!/search/?src=hash&q=%23hashtag)

##Info

Demo: [here](http://cdn.simon.waldherr.eu/projects/phpmd/)  
License: MIT  
Version: 0.1  
Date: August 2012
