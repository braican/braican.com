const MarkdownIt = require('markdown-it');
const CleanCSS = require('clean-css');
const util = require('util');

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

  eleventyConfig.addFilter('console', function(value) {
    return util.inspect(value);
  });

  // pass some assets right through
  eleventyConfig.addPassthroughCopy('./src/fonts');
  eleventyConfig.addPassthroughCopy('./build');

  // Add css watch target
  eleventyConfig.addWatchTarget('./build/main.css');
  eleventyConfig.setUseGitIgnore(false);

  return {
    dir: {
      input: 'src',
    },
  };
};
