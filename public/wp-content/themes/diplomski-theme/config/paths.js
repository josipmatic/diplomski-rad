'use strict';

const path = require( 'path' );
const fs = require( 'fs' );

// Make sure any symlinks in the project folder are resolved:
// https://github.com/facebookincubator/create-react-app/issues/637
const appDirectory = fs.realpathSync( process.cwd() );
const resolveApp = relativePath => path.resolve( appDirectory, relativePath );
const protocol = process.env.HTTPS === 'true' ? 'https' : 'http';

module.exports = {
	dotenv: resolveApp( '.env' ),
	assetsBuild: resolveApp( 'assets' ),
	jsVendorDir: resolveApp( 'source/js/vendor' ),
	jsFiles: {
		main: resolveApp( 'source/js/main.js' ),
		styles: [ resolveApp( 'source/js/styles.js' ) ],
	},
	projectPackageJson: resolveApp( 'package.json' ),
	assetsDev: resolveApp( 'source' ),
	yarnLockFile: resolveApp( 'yarn.lock' ),
	projectNodeModules: resolveApp( 'node_modules' ),
	projectRoot: appDirectory,
	devServerUrl: protocol + '://bojler-site.test:9000/',
	servedPath: '/',
	languages: resolveApp( 'languages/' ),
	potFile: resolveApp( 'languages/tech-city.pot' ),
};
