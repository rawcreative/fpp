## Falcon Player V2 interface

[Falcon Player Website](http://falconchristmas.com)



### Installation

Checkout the V2 branch.

	sudo git remote add V2 https://github.com/rawcreative/fpp.git
	sudo git fetch V2
	sudo git checkout V2-ui


The v2 interface uses Composer, which is a PHP package and dependency manager. You will first need to install this on the pi using:
    
    curl -sS https://getcomposer.org/installer | php


To make it easy to switch between the v1 and v2 interfaces during development, install NGINX and PHP-fpm. This way we can simple stop apache and start nginx after changing branches, instead of having to manually edit the vhost files.

    sudo apt-get install nginx php5-fpm php5-mcrypt


Once installed, replace the contents of /etc/nginx/sites-available/default with below:

    server {
    	listen   80;
    
    	root /opt/fpp/www/public;
    	index index.html index.htm index.php;

    	# Make site accessible from http://localhost/
    	server_name localhost;

    	location / {
    		
    		try_files $uri $uri/ /index.php?$query_string;
    		
    	}

    	location /doc/ {
    		alias /usr/share/doc/;
    		autoindex on;
    		allow 127.0.0.1;
    		allow ::1;
    		deny all;
    	}

    
    	location ~ \.php$ {
    		fastcgi_split_path_info ^(.+\.php)(/.+)$;
    		fastcgi_pass unix:/var/run/php5-fpm.sock;
    		fastcgi_index index.php;
    		include fastcgi_params;
    	}
    }


Next, open /etc/php5/fpm/pool.d/www.conf and change the user and group to:

    user = pi
    group = pi


Next, stop apache and start Nginx & php-fpm:

	sudo service apache2 stop
	sudo service nginx start
	sudo service php5-fpm start

Once those are running, we now have to install the app dependencies:

	cd /opt/fpp/www
	sudo composer install

Composer will download all the required packages and generate the autoloader. Once it's finished you should be able to access the new interface just as normal

Just in case permissions are out of whack run:

	sudo chown -R pi:pi /opt/fpp/www



## Development

The v2 build uses modern front-end development build tools and dependency managers to streamline the development workflow. The current tooling used is:

 - Gulp for CSS and JS compilation, linting and building
 - Sass for CSS preprocessing
 - Bower for front-end package management
 
Since all of the production ready files are built using these tools, you will need to have them installed on your system to properly compile and build the project. The minimum requirement for this is having Node installed on your machine. Once you have node installed, installing the build tools is simple:

To install the required build tools, on the command line navigate to the www/ directory and type:

    npm install


If you do not have the bower package manager installed:
    
    npm install -g bower

Once Bower is installed, install the dependencies:

    bower install


Run 'gulp watch' to start watching the filesystem for changes in .scss and .js files. Gulp will automatically compile, lint and concat the files and place them in the proper directories.


.. more soon ..