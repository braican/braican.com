const MarkdownIt = require('markdown-it');
const CleanCSS = require('clean-css');

const md = new MarkdownIt({
  html: true,
});

module.exports = function(eleventyConfig) {
  // A useful way to reference the context we are runing eleventy in
  const env = process.env.ELEVENTY_ENV;

  eleventyConfig.addFilter('markdown_it', function(value) {
    return md.render(value);
  });

  eleventyConfig.addFilter('cssmin', function(code) {
    return new CleanCSS({
      sourceMap: true,
    }).minify(code).styles;
  });

  // pass some assets right through
  eleventyConfig.addPassthroughCopy('./src/fonts');

  // For sourcemaps, only in development.
  if (env === 'development') {
    eleventyConfig.addPassthroughCopy('./src/styles');
    eleventyConfig.addPassthroughCopy({
      './src/_includes/build/main.css.map': 'styles/main.css.map',
    });
  }

  return {
    dir: {
      input: 'src',
    },
  };
};
