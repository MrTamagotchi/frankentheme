module.exports = {
  'assets': {
    'app': [
      './resources/js/app.js',
      './resources/sass/style.scss'
    ]
  },

  'settings': {
    'browserSync': {
      'host': 'localhost',
      'port': 3000,
      'proxy': 'http://CHANGE-ME.PLEASE/',
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
