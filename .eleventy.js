const MarkdownIt = require('markdown-it');

const md = new MarkdownIt({
  html: true,
});

module.exports = function(eleventyConfig) {
  eleventyConfig.addFilter('markdown_it', function(value) {
    return md.render(value);
  });

  // pass some assets right through
  eleventyConfig.addPassthroughCopy('./admin');

  return {
    dir: {
      input: 'src',
    },
  };
};
