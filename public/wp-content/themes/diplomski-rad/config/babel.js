module.exports = {
	presets: [
		[ 'env', {
			targets: {
				browsers: [
					'last 4 versions',
					'> 1%'
				],
				uglify: true,
			},
			modules: false,
			useBuiltIns: true,
		} ],
	],
	plugins: [
		'transform-object-rest-spread',
	],
};
