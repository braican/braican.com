const MarkdownIt = require('markdown-it');
const esbuild = require('esbuild');

const md = new MarkdownIt();

module.exports = function (eleventyConfig) {
  // Filters.
  eleventyConfig.addFilter('md', value => md.render(value));

  // Static asset compilation (css and js).
  eleventyConfig.addWatchTarget('./src/static/**/*');
  eleventyConfig.on('afterBuild', () => {
    return esbuild.build({
      entryPoints: ['./src/static/styles/main.css', './src/static/js/main.js'],
      bundle: true,
      outdir: '_site/static',
      minify: process.env.ELEVENTY_ENV === 'production',
      sourcemap: process.env.ELEVENTY_ENV !== 'production',
      target: ['es2020', 'chrome60', 'edge16', 'firefox60', 'safari11'],
    });
  });

  return {
    dir: {
      input: 'src',
      data: '../_data',
    },
  };
};
