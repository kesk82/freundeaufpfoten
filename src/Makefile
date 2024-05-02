export NODE_OPTIONS = --openssl-legacy-provider

build: clean
	npx webpack --mode=production --config=webpack.config.js

dev:
	npx webpack --mode=development --config=webpack.config.js --devtool=source-map --watch

clean:
	rm -f ../js/*.js
	rm -f ../js/*.map
	rm -f ../js/main.asset.php
	rm -f ../css/*.eot
	rm -f ../css/*.woff
	rm -f ../css/*.css
	rm -f ../css/*.map
	rm -f ../css/*.ttf
	rm -f ../css/*.woff2
