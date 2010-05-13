<?php
$constant1 = "#
# Apache/PHP/Drupal settings:
#

	# Protect files and directories from prying eyes.
<FilesMatch \".(engine|inc|info|install|module|profile|test|po|sh|.*sql|theme|tpl(\.php)?|xtmpl|svn-base)\$|^(code-style\.pl|Entries.*|Repository|Root|Tag|Template|all-wcprops|entries|format)\$\">
  Order allow,deny
</FilesMatch>

	# Don't show directory listings for URLs which map to a directory.
Options -Indexes

# Follow symbolic links in this directory.
Options +FollowSymLinks

# Make Drupal handle any 404 errors.
ErrorDocument 404 /index.php

# Force simple error message for requests for non-existent favicon.ico.
<Files favicon.ico>
  # There is no end quote below, for compatibility with Apache 1.3.
  ErrorDocument 404 \"The requested file favicon.ico was not found.
</Files>

# Set the default handler.
DirectoryIndex index.php

# Override PHP settings. More in sites/default/settings.php
# but the following cannot be changed at runtime.

# PHP 4, Apache 1.
<IfModule mod_php4.c>
  php_value magic_quotes_gpc                0
  php_value register_globals                0
  php_value session.auto_start              0
  php_value mbstring.http_input             pass
  php_value mbstring.http_output            pass
  php_value mbstring.encoding_translation   0
</IfModule>

# PHP 4, Apache 2.
<IfModule sapi_apache2.c>
  php_value magic_quotes_gpc                0
  php_value register_globals                0
  php_value session.auto_start              0
  php_value mbstring.http_input             pass
  php_value mbstring.http_output            pass
  php_value mbstring.encoding_translation   0
</IfModule>

# PHP 5, Apache 1 and 2.
<IfModule mod_php5.c>
  php_value magic_quotes_gpc                0
  php_value register_globals                0
  php_value session.auto_start              0
  php_value mbstring.http_input             pass
  php_value mbstring.http_output            pass
  php_value mbstring.encoding_translation   0
</IfModule>

# Requires mod_expires to be enabled.
<IfModule mod_expires.c>
  # Enable expirations.
  ExpiresActive On

  # Cache all files for 2 weeks after access (A).
  ExpiresDefault A1209600

  # Do not cache dynamically generated pages.
  ExpiresByType text/html A1
</IfModule>

# Various rewrite rules.
<IfModule mod_rewrite.c>
  RewriteEngine on

  # rewrite divx.com to www.divx.com
  RewriteCond %{HTTP_HOST} ^divx\.com\$ [NC]
  RewriteRule ^(.*)\$\$ http://www.divx.com/\$1 [L,R=301]

  # rewrite prod.divx.com to www.divx.com
  RewriteCond %{HTTP_HOST} ^prod.divx\.com\$ [NC]
  RewriteRule ^(.*)\$\$ http://www.divx.com/\$1 [L,R=301]

  ### BOOST START ###
  AddDefaultCharset utf-8
  <FilesMatch \"(\.html|\.html\.gz)\$\">
    <IfModule mod_headers.c>
      Header set Expires \"Sun, 19 Nov 1978 05:00:00 GMT\"
      Header set Cache-Control \"no-store, no-cache, must-revalidate, post-check=0, pre-check=0\"
    </IfModule>
  </FilesMatch>
  <IfModule mod_mime.c>
    AddCharset utf-8 .html
    AddCharset utf-8 .css
    AddCharset utf-8 .js
    AddEncoding gzip .gz
  </IfModule>
  <FilesMatch \"(\.html|\.html\.gz)\$\">
    ForceType text/html
  </FilesMatch>
  <FilesMatch \"(\.js|\.js\.gz)\$\">
    ForceType text/javascript
  </FilesMatch>
  <FilesMatch \"(\.css|\.css\.gz)\$\">
    ForceType text/css
  </FilesMatch>

  # GZIP - Cached css & js files
  RewriteCond %{HTTP:Accept-encoding} !gzip
  RewriteRule .* - [S=2]
  RewriteCond %{DOCUMENT_ROOT}/cache/gz/%{SERVER_NAME}%{REQUEST_URI}_\.css\.gz -s
  RewriteRule .* cache/gz/%{SERVER_NAME}%{REQUEST_URI}_\.css\.gz [L,QSA,T=text/css]
  RewriteCond %{DOCUMENT_ROOT}/cache/gz/%{SERVER_NAME}%{REQUEST_URI}_\.js\.gz -s
  RewriteRule .* cache/gz/%{SERVER_NAME}%{REQUEST_URI}_\.js\.gz [L,QSA,T=text/javascript]

  # NORMAL - Cached css & js files
  RewriteCond %{DOCUMENT_ROOT}/cache/%{SERVER_NAME}%{REQUEST_URI}_\.css -s
  RewriteRule .* cache/%{SERVER_NAME}%{REQUEST_URI}_\.css [L,QSA,T=text/css]
  RewriteCond %{DOCUMENT_ROOT}/cache/%{SERVER_NAME}%{REQUEST_URI}_\.js -s
  RewriteRule .* cache/%{SERVER_NAME}%{REQUEST_URI}_\.js [L,QSA,T=text/javascript]

  # Caching for anonymous users
  # Skip boost IF not get request OR uri has wrong dir OR cookie is set OR request came from this server OR https request
  RewriteCond %{REQUEST_METHOD} !^GET\$ [OR]
  RewriteCond %{REQUEST_URI} (^(admin|cache|misc|modules|sites|system|openid|themes|node/add))|(/(comment/reply|edit|user|user/(login|password|register))$) [OR]
  RewriteCond %{HTTP_COOKIE} DRUPAL_UID [OR]
  RewriteCond %{HTTPS} on
  RewriteRule .* - [S=3]

  # GZIP
  RewriteCond %{HTTP:Accept-encoding} !gzip
  RewriteRule .* - [S=1]
  RewriteCond %{DOCUMENT_ROOT}/cache/gz/%{SERVER_NAME}%{REQUEST_URI}_%{QUERY_STRING}\.html\.gz -s
  RewriteRule .* cache/gz/%{SERVER_NAME}%{REQUEST_URI}_%{QUERY_STRING}\.html\.gz [L,T=text/html]

  # NORMAL
  RewriteCond %{DOCUMENT_ROOT}/cache/%{SERVER_NAME}%{REQUEST_URI}_%{QUERY_STRING}\.html -s
  RewriteRule .* cache/%{SERVER_NAME}%{REQUEST_URI}_%{QUERY_STRING}\.html [L,T=text/html]

  ### BOOST END ###

	#############################################################################
  # DIVX.COM REDIRECTS
  #
  # The basic way this works is that RewriteCond with the hostname you are 
  # trying to redirect. For example, you can list several RewriteRules under
  # one RewriteCond for a particular host.
  #
  #
  # The ([^/]*[/]*) matches the following:
  #  ()     This means put the value of whatever is matched into a variable
  #         called \$1, \$2, etc for each matched value.  If nothing is matched
  #         then \$1 will be empty.
  #
  #  [^/]*  This means match 0 or more characters that are not a forward slash.  
  #         The * means 0 or more and the ^ is a \"not\" symbol.
  #
  #  [/]*   This means match 0 or more forward slashes (we only want to match one
  #         or zero).
  #
  # Note: We use ([^/]*[/]*) for matching with or without language.

  # Redirects for www

  RewriteCond %{HTTP_HOST} ^www\.divx\.com\$ [NC]\n
	### Catch All's for Electronics Section moved content ###
  RewriteRule ^([^/]*[/]*)products/software/(.+)$ http://www.divx.com/$1software/$2 [R=301,L]
  RewriteRule ^([^/]*[/]*)products/content/(.+)$ http://www.divx.com/$1movies/$2 [R=301,L]\n
  ### Rat King CSV Content Goes Under Here ###
";

$constant2 = "
  # End CSV Generated Content
  
  #
  # DIVX.COM README AND EULA REDIRECTS
  #

  #RewriteRule ^licensing/([^/]*)\$\$ http://download.divx.com/readme/$2 [R=301,L]
  #RewriteRule ^company/partner/indies/([^/]*)\$\$ http://download.divx.com/readme/\$2 [R=301,L]
  #RewriteRule ^company/partner/([^/]*)\$\$ http://download.divx.com/readme/\$2 [R=301,L]

  # END DIVX.COM REDIRECTS
  #############################################################################


  # Rewrite URLs of the form 'x' to the form 'index.php?q=x'.
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_URI} !=/favicon.ico
  RewriteRule ^(.*)\$ index.php?q=\$1 [L,QSA]

</IfModule>

  # \$Id: .htaccess,v 1.90.2.3 2008/12/10 20:04:08 goba Exp \$";
?>