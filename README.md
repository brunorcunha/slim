# slim
Rest com SlimFramework

-HTTPD.CONF
LoadModule headers_module modules/mod_headers.so
<IfModule mod_headers.c>
    Header set Access-Control-Allow-Origin: *
    Header set Access-Control-Allow-Methods: "GET,POST,OPTIONS,DELETE,PUT"
    Header set Access-Control-Allow-Headers: Content-Type
</IfModule>

-HTTPD-VHOSTS.CONF
<VirtualHost *:80>
	ServerName slim
	DocumentRoot "c:/server/www/slim/public"
	<Directory  "c:/server/www/slim/public/">
		Options +Indexes +Includes +FollowSymLinks +MultiViews
		AllowOverride All
		Require local
	</Directory>
</VirtualHost>
