module.exports = {
	all: {
		files:   {
			'js/js-comment-form-validation.min.js': [ 'js/js-comment-form-validation.js' ]
		},
		options: {
			sourceMap: true,
			mangle:    {
				except: [ 'jQuery' ]
			}
		}
	}
}
