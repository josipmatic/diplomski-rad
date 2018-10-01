'use strict';

const autoprefixer = require( 'autoprefixer' );
const path = require( 'path' );
const webpack = require( 'webpack' );
const CaseSensitivePathsPlugin = require( 'case-sensitive-paths-webpack-plugin' );
const WatchMissingNodeModulesPlugin = require( 'react-dev-utils/WatchMissingNodeModulesPlugin' );
const eslintFormatter = require( 'react-dev-utils/eslintFormatter' );
const ModuleScopePlugin = require( 'react-dev-utils/ModuleScopePlugin' );
const clone = require( 'clone' );
const getClientEnvironment = require( './env' );
const paths = require( './paths' );
const providePluginsConfig = require( './providePlugins' );
const babelConfig = require( './babel' );

const publicPath = paths.devServerUrl;
const publicUrl = paths.devServerUrl;
// Get environment variables to inject into our app.
const env = getClientEnvironment( publicUrl );

const entry = clone( paths.jsFiles );
const addToEntries = [
	// Include an alternative client for WebpackDevServer. A client's job is to
	// connect to WebpackDevServer by a socket and get notified about changes.
	// When you save a file, the client will either apply hot updates (in case
	// of CSS changes), or refresh the page (in case of JS changes). When you
	// make a syntax error, this client will display a syntax error overlay.
	// Note: instead of the default WebpackDevServer client, we use a custom one
	// to bring better experience for Create React App users. You can replace
	// the line below with these two lines if you prefer the stock client:
	// require.resolve('webpack-dev-server/client') + '?/',
	// require.resolve('webpack/hot/dev-server'),
	require.resolve( 'webpack-dev-server/client' ) + '?' + publicUrl,
	require.resolve( 'webpack/hot/dev-server' ),
	// Errors should be considered fatal in development
	require.resolve( 'react-error-overlay' ),
];

const autoprefixerOptions = {
	browsers: [
		'last 4 versions',
		'> 1%',
	],
	flexbox: 'no-2009',
};

for ( const key of Object.keys( entry ) ) {
	if ( ! Array.isArray( entry[ key ] ) ) {
		entry[ key ] = [ entry[ key ] ];
	}

	entry[ key ].unshift( ...addToEntries );
}

// This is the development configuration.
// It is focused on developer experience and fast rebuilds.
// The production configuration is different and lives in a separate file.
module.exports = {
	// You may want 'eval' instead if you prefer to see the compiled output in DevTools.
	// See the discussion in https://github.com/facebookincubator/create-react-app/issues/343.
	devtool: 'cheap-module-source-map',
	// These are the "entry points" to our application.
	// This means they will be the "root" imports that are included in JS bundle.
	// The first two entry points enable "hot" CSS and auto-refreshes for JS.
	entry: entry,
	output: {
		// Next line is not used in dev but WebpackDevServer crashes without it:
		path: paths.assetsBuild,
		// Add /* filename */ comments to generated require()s in the output.
		pathinfo: true,
		// This does not produce a real file. It's just the virtual path that is
		// served by WebpackDevServer in development. This is the JS bundle
		// containing code from all our entry points, and the Webpack runtime.
		filename: 'assets/js/[name].js',
		// There are also additional JS chunk files if you use code splitting.
		chunkFilename: 'assets/js/[name].chunk.js',
		// This is the URL that app is served from. We use "/" in development.
		publicPath: publicPath,
		// Point sourcemap entries to original disk location
		devtoolModuleFilenameTemplate: info =>
			path.resolve( info.absoluteResourcePath ),
	},
	resolve: {
		// This allows you to set a fallback for where Webpack should look for modules.
		// We placed these paths second because we want `node_modules` to "win"
		// if there are any conflicts. This matches Node resolution mechanism.
		// https://github.com/facebookincubator/create-react-app/issues/253
		modules: [ 'node_modules', paths.projectNodeModules ].concat(
			// It is guaranteed to exist because we tweak it in `env.js`
			process.env.NODE_PATH.split( path.delimiter ).filter( Boolean )
		),
		// These are the reasonable defaults supported by the Node ecosystem.
		// We also include JSX as a common component filename extension to support
		// some tools, although we do not recommend using it, see:
		// https://github.com/facebookincubator/create-react-app/issues/290
		extensions: [ '.js', '.json', '.jsx' ],
		plugins: [
			// Prevents users from importing files from outside of src/ (or node_modules/).
			// This often causes confusion because we only process files within src/ with babel.
			// To fix this, we prevent you from importing files out of dev/ -- if you'd like to,
			// please link the files into your node_modules/ and let module-resolution kick in.
			// Make sure your source files are compiled, as they will not be processed in any way.
			new ModuleScopePlugin( paths.assetsDev ),
		],
	},
	module: {
		strictExportPresence: true,
		rules: [
			// TODO: Disable require.ensure as it's not a standard language feature.
			// We are waiting for https://github.com/facebookincubator/create-react-app/issues/2176.
			// { parser: { requireEnsure: false } },

			// First, run the linter.
			// It's important to do this before Babel processes the JS.
			{
				test: /\.(js|jsx)$/,
				enforce: 'pre',
				use: [
					{
						options: {
							formatter: eslintFormatter,
						},
						loader: require.resolve( 'eslint-loader' ),
					},
				],
				include: paths.assetsDev,
				exclude: paths.jsVendorDir,
			},
			// ** ADDING/UPDATING LOADERS **
			// The "file" loader handles all assets unless explicitly excluded.
			// The `exclude` list *must* be updated with every change to loader extensions.
			// When adding a new loader, you must add its `test`
			// as a new entry in the `exclude` list for "file" loader.

			// "file" loader makes sure those assets get served by WebpackDevServer.
			// When you `import` an asset, you get its (virtual) filename.
			// In production, they would get copied to the `build` folder.
			{
				exclude: [
					/\.html$/,
					/\.(js|jsx)$/,
					/\.css$/,
					/\.less$/,
					/\.s(a|c)ss$/,
					/\.json$/,
				],
				loader: require.resolve( 'file-loader' ),
				options: {
					name: 'assets/media/[name].[ext]',
				},
			},
			// Process JS with Babel.
			{
				test: /\.(js|jsx)$/,
				include: [
					paths.assetsDev,
					path.resolve( paths.projectNodeModules, 'bootstrap' ),
					path.resolve( paths.projectNodeModules, 'objectFitPolyfill' ),
				],
				loader: require.resolve( 'babel-loader' ),
				options: Object.assign( {

					// This is a feature of `babel-loader` for webpack (not Babel itself).
					// It enables caching results in ./node_modules/.cache/babel-loader/
					// directory for faster rebuilds.
					cacheDirectory: true,

					babelrc: false,
				}, babelConfig ),
			},
			// "postcss" loader applies autoprefixer to our CSS.
			// "css" loader resolves paths in CSS and adds assets as dependencies.
			// "style" loader turns CSS into JS modules that inject <style> tags.
			// In production, we use a plugin to extract that CSS to a file, but
			// in development "style" loader enables hot editing of CSS.
			{
				test: /\.css$/,
				use: [
					require.resolve( 'style-loader' ),
					{
						loader: require.resolve( 'css-loader' ),
						options: {
							importLoaders: 1,
							sourceMap: true,
						},
					},
					{
						loader: require.resolve( 'postcss-loader' ),
						options: {
							// https://webpack.js.org/guides/migrating/#complex-options
							ident: 'postcss',
							plugins: () => [
								require( 'postcss-flexbugs-fixes' ),
								autoprefixer( autoprefixerOptions ),
							],
							sourceMap: true,
						},
					},
				],
			},
			{
				test: /\.less$/,
				use: [
					require.resolve( 'style-loader' ),
					{
						loader: require.resolve( 'css-loader' ),
						options: {
							importLoaders: 1,
							sourceMap: true,
						},
					},
					{
						loader: require.resolve( 'postcss-loader' ),
						options: {
							// https://webpack.js.org/guides/migrating/#complex-options
							ident: 'postcss',
							sourceMap: true,
							plugins: () => [
								require( 'postcss-flexbugs-fixes' ),
								autoprefixer( autoprefixerOptions ),
							],
						},
					},
					{
						loader: require.resolve( 'less-loader' ),
						options: {
							sourceMap: true,
						},
					},
				],
			},
			{
				test: /\.s(a|c)ss$/,
				use: [
					require.resolve( 'style-loader' ),
					{
						loader: require.resolve( 'css-loader' ),
						options: {
							importLoaders: 1,
							sourceMap: true,
						},
					},
					{
						loader: require.resolve( 'postcss-loader' ),
						options: {
							// https://webpack.js.org/guides/migrating/#complex-options
							ident: 'postcss',
							sourceMap: true,
							plugins: () => [
								require( 'postcss-flexbugs-fixes' ),
								autoprefixer( autoprefixerOptions ),
							],
						},
					},
					{
						loader: require.resolve( 'sass-loader' ),
						options: {
							sourceMap: true,
						}
					},
				],
			},
			// ** STOP ** Are you adding a new loader?
			// Remember to add the new extension(s) to the "file" loader exclusion list.
		],
	},
	plugins: [
		// Makes some environment variables available to the JS code, for example:
		// if (process.env.NODE_ENV === 'development') { ... }. See `./env.js`.
		new webpack.DefinePlugin( env.stringified ),
		// This is necessary to emit hot updates (currently CSS only):
		new webpack.HotModuleReplacementPlugin(),
		// Watcher doesn't work well if you mistype casing in a path so we use
		// a plugin that prints an error when you attempt to do this.
		// See https://github.com/facebookincubator/create-react-app/issues/240
		new CaseSensitivePathsPlugin(),
		// If you require a missing module and then `npm install` it, you still have
		// to restart the development server for Webpack to discover it. This plugin
		// makes the discovery automatic so you don't have to restart.
		// See https://github.com/facebookincubator/create-react-app/issues/186
		new WatchMissingNodeModulesPlugin( paths.projectNodeModules ),
		// Moment.js is an extremely popular library that bundles large locale files
		// by default due to how Webpack interprets its code. This is a practical
		// solution that requires the user to opt into importing specific locales.
		// https://github.com/jmblog/how-to-optimize-momentjs-with-webpack
		// You can remove this if you don't use Moment.js:
		new webpack.IgnorePlugin( /^\.\/locale$/, /moment$/ ),
		new webpack.ProvidePlugin( providePluginsConfig ),
	],
	// Some libraries import Node modules but don't use them in the browser.
	// Tell Webpack to provide empty mocks for them so importing them works.
	node: {
		fs: 'empty',
		net: 'empty',
		tls: 'empty',
	},
	// Turn off performance hints during development because we don't do any
	// splitting or minification in interest of speed. These warnings become
	// cumbersome.
	performance: {
		hints: false,
	},
};
