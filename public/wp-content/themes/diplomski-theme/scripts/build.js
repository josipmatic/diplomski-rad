'use strict';

// Do this as the first thing so that any code reading it knows the right env.
process.env.BABEL_ENV = 'production';
process.env.NODE_ENV = 'production';

// Makes the script crash on unhandled rejections instead of silently
// ignoring them. In the future, promise rejections that are not handled will
// terminate the Node.js process with a non-zero exit code.
process.on( 'unhandledRejection', err => {
	throw err;
} );

// Ensure environment variables are read.
require( '../config/env' );

const path = require( 'path' );
const chalk = require( 'chalk' );
const fs = require( 'fs-extra' );
const webpack = require( 'webpack' );
const config = require( '../config/webpack.config.prod' );
const paths = require( '../config/paths' );
const checkRequiredFiles = require( 'react-dev-utils/checkRequiredFiles' );
const formatWebpackMessages = require( 'react-dev-utils/formatWebpackMessages' );
const FileSizeReporter = require( 'react-dev-utils/FileSizeReporter' );
const flatten = require( 'array-flatten' );
const wpPot = require( 'wp-pot' );
const gettextParser = require( 'gettext-parser' );

const measureFileSizesBeforeBuild = FileSizeReporter.measureFileSizesBeforeBuild;
const printFileSizesAfterBuild = FileSizeReporter.printFileSizesAfterBuild;

// Warn and crash if required files are missing
if ( ! checkRequiredFiles( flatten( Object.values( paths.jsFiles ) ) ) ) {
	process.exit( 1 ); // eslint-disable-line no-process-exit
}

// First, read the current file sizes in build directory.
// This lets us display how much they changed later.
measureFileSizesBeforeBuild( paths.assetsBuild )
	.then( previousFileSizes => {
		// Remove all content but keep the directory so that
		// if you're in it, you don't end up in Trash
		fs.emptyDirSync( paths.assetsBuild );

		// Start the webpack build
		return build( previousFileSizes );
	} )
	.then(
		( { stats, previousFileSizes, warnings } ) => {
			if ( warnings.length ) {
				console.log( chalk.yellow( 'Compiled with warnings.\n' ) );
				console.log( warnings.join( '\n\n' ) );
				console.log(
					'\nSearch for the ' +
						chalk.underline( chalk.yellow( 'keywords' ) ) +
						' to learn more about each warning.'
				);
				console.log(
					'To ignore, add ' +
						chalk.cyan( '// eslint-disable-next-line' ) +
						' to the line before.\n'
				);
			} else {
				console.log( chalk.green( 'Compiled successfully.\n' ) );
			}

			console.log( 'File sizes after gzip:\n' );
			printFileSizesAfterBuild( stats, previousFileSizes, paths.assetsBuild );
			console.log();
		},
		err => {
			console.log( chalk.red( 'Failed to compile.\n' ) );
			console.log( ( err.message || err ) + '\n' );
			process.exit( 1 ); // eslint-disable-line no-process-exit
		}
	)
	.then(
		generatePotFile,
		err => {
			console.log( chalk.red( 'Failed to generate pot file.\n' ) );
			console.log( ( err.message || err ) + '\n' );
			process.exit( 1 ); // eslint-disable-line no-process-exit
		}
	)
	.then(
		compilePo2Mo,
		err => {
			console.log( chalk.red( 'Failed to compile languages files.\n' ) );
			console.log( ( err.message || err ) + '\n' );
			process.exit( 1 ); // eslint-disable-line no-process-exit
		}
	);

// Create the production build and print the deployment instructions.
function build( previousFileSizes ) {
	console.log( 'Creating an optimized production build...' );

	const compiler = webpack( config );
	return new Promise( ( resolve, reject ) => {
		compiler.run( ( err, stats ) => {
			if ( err ) {
				return reject( err );
			}
			const messages = formatWebpackMessages( stats.toJson( {}, true ) );
			if ( messages.errors.length ) {
				return reject( new Error( messages.errors.join( '\n\n' ) ) );
			}
			if ( process.env.CI && messages.warnings.length ) {
				console.log(
					chalk.yellow(
						'\nTreating warnings as errors because process.env.CI = true.\n' +
							'Most CI servers set it automatically.\n'
					)
				);
				return reject( new Error( messages.warnings.join( '\n\n' ) ) );
			}
			return resolve( {
				stats,
				previousFileSizes,
				warnings: messages.warnings,
			} );
		} );
	} );
}

function generatePotFile() {
	return new Promise( function( resolve, reject ) {
		console.log( 'Generating pot file...' );

		fs.ensureFile( paths.potFile, function( error ) {
			if ( error ) {
				return reject( error );
			}

			wpPot( {
				destFile: paths.potFile,
				domain: 'bojler-site',
				'package': 'Bojler Site',
				src: [
					'**/*.php',
					'!vendor/**',
					'!node_modules/**',
				],
				relativeTo: paths.projectRoot,
				team: 'Slicejack <info@slicejack.com>',
			} );

			console.log(
				chalk.green(
					'Pot file ' +
					chalk.cyan( path.relative( paths.projectRoot, paths.potFile ) ) +
					' is generated.'
				)
			);
			console.log();
			console.log();

			resolve();
		} );
	} );
}

function compilePo2Mo() {
	return new Promise( function( resolve, reject ) {
		console.log( 'Compiling languages files...' );
		console.log();

		fs.readdir( paths.languages, function( err, files ) {
			if ( err ) {
				return reject( err );
			}

			const poFiles = files
				.filter( function( file ) {
					if ( file.substr( -3 ) === '.po' ) {
						return true;
					}

					return false;
				} );

			if ( ! poFiles.length ) {
				console.log(
					chalk.yellow(
						'No ' +
						chalk.cyan( '.po' ) +
						' files in ' +
						chalk.cyan( 'languages/' )
					)
				);

				return resolve();
			}

			poFiles
				.forEach( function( file ) {
					console.log(
						'Parsing ' +
						chalk.cyan( file ) +
						' file...'
					);

					const poPath = path.resolve( paths.languages, file );
					const poContent = fs.readFileSync( poPath );
					const poJson = gettextParser.po.parse( poContent );

					const moFile = file.replace( /\.po$/i, '.mo' );

					console.log(
						'Compiling ' +
						chalk.cyan( moFile ) +
						' file...'
					);

					const moPath = path.resolve( paths.languages, moFile );
					const moContent = gettextParser.mo.compile( poJson );
					fs.writeFileSync( moPath, moContent );

					console.log(
						chalk.cyan( moFile ) +
						' file is compiled.'
					);
					console.log();
				} );

			console.log( chalk.cyan( 'All languages files are compiled.' ) );

			return resolve();
		} );
	} );
}
