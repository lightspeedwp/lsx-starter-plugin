#!/bin/bash

echo "* NANDOTESS LOCALHOST DEPLOY *";
cd ~/Sites-LightSpeed/@git/lsx-starter-plugin;
gulp compile-css;
gulp compile-js;
gulp wordpress-lang;

echo "* LSX.MAMP:8888 *";
rm -Rf ~/Sites-LightSpeed/@mamp/lsx.mamp/wp-content/plugins/lsx-starter-plugin;
rsync -a \
	--exclude='.git' \
	--exclude='.idea' \
	--exclude='node_modules' \
	--exclude='.DS_Store' \
	--exclude='.gitignore' \
	--exclude='gulpfile.js' \
	--exclude='package.json' \
	~/Sites-LightSpeed/@git/lsx-starter-plugin ~/Sites-LightSpeed/@mamp/lsx.mamp/wp-content/plugins;
