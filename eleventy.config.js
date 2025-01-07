import esbuild from 'esbuild';
import markdownIt from 'markdown-it';

export default async function (eleventyConfig) {
  const env = process.env.ENVIRONMENT;
  const md = markdownIt({
    html: false,
    breaks: true,
    linkify: true,
  });

  eleventyConfig.addNunjucksFilter('md', markdownString => {
    return md.render(markdownString);
  });

  eleventyConfig.addFilter('dump', (...args) => {
    console.log(...args);
  });

  eleventyConfig.addFilter('toArray', object => Object.keys(object).map(k => object[k]));

  eleventyConfig.addTemplateFormats('css');
  eleventyConfig.addExtension('css', {
    outputFileExtension: 'css',
    compile: () => {
      esbuild.buildSync({
        entryPoints: ['./src/static/css/app.css'],
        bundle: true,
        minify: env === 'production',
        sourcemap: env !== 'production',
        outfile: './_site/build/app.css',
      });
    },
  });

  eleventyConfig.addTemplateFormats('js');
  eleventyConfig.addExtension('js', {
    outputFileExtension: 'js',
    compile: () => {
      esbuild.build({
        entryPoints: ['./src/static/js/app.js'],
        bundle: true,
        minify: env === 'production',
        sourcemap: env !== 'production',
        outfile: './_site/build/app.js',
        target: ['es2020'],
      });
    },
  });

  return {
    dir: {
      input: 'src',
    },
  };
}
