const MarkdownIt = require('markdown-it');

const md = new MarkdownIt();

module.exports = function(eleventyConfig) {
  eleventyConfig.addFilter('md', (value) => md.render(value));

  return {
    dir: {
      input: 'src',
      data: '../_data'
    },
  };
};
