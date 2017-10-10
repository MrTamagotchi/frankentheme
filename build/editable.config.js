module.exports = {
  'assets': {
    'app': [
      './resources/js/app.js',
      './resources/sass/style.scss'
    ]
  },

  'externals': {
    'jquery': 'jQuery'
  },

  'settings': {
    'browserSync': {
      'host': 'localhost',
      'port': 3000,
      'proxy': 'http://gatsbymaze.loc:8888/',
      'files': [
        {
          match: ['../**/*.php'],
          fn: function(event, file) {
            if (event === 'change') {
              this.reload()
            }
          }
        }
      ]
    }
  }
}
